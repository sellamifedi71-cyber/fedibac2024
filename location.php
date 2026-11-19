<?php
declare(strict_types=1);require __DIR__.'/config.php';
$error='';$success=false;$ref=0;
if($_SERVER['REQUEST_METHOD']==='POST'){
 verify_csrf();$cin=trim((string)($_POST['cin']??''));$habit=filter_var($_POST['habit']??null,FILTER_VALIDATE_INT);$date=trim((string)($_POST['date']??''));$duration=filter_var($_POST['duree']??null,FILTER_VALIDATE_INT);
 $dateObj=DateTimeImmutable::createFromFormat('!Y-m-d',$date);$validDate=$dateObj&&$dateObj->format('Y-m-d')===$date&&$dateObj>=new DateTimeImmutable('today');
 if(!preg_match('/^[0-9]{8}$/',$cin)||!$habit||!$validDate||!in_array($duration,[1,2,3,4,5,6,7,8,9,10,11,12,13,14],true))$error='Vérifiez le CIN, la tenue, la date et la durée (1 à 14 jours).';
 else{
  $db->begin_transaction();
  try{
   $client=$db->prepare('SELECT cin FROM client WHERE cin=?');$client->bind_param('s',$cin);$client->execute();
   if(!$client->get_result()->fetch_assoc()){$error='Client introuvable. Choisissez un client enregistré.';$db->rollback();}
   else{
    $check=$db->prepare('SELECT codeHab FROM habit WHERE codeHab=? AND disponible=\'D\' FOR UPDATE');$check->bind_param('i',$habit);$check->execute();
    if(!$check->get_result()->fetch_assoc()){$error='Cette tenue n’est plus disponible.';$db->rollback();}
    else{
     $insert=$db->prepare('INSERT INTO location (dateLoc,codeHab,cin,duree) VALUES (?,?,?,?)');$insert->bind_param('sisi',$date,$habit,$cin,$duration);$insert->execute();
     $update=$db->prepare('UPDATE habit SET disponible=\'N\' WHERE codeHab=?');$update->bind_param('i',$habit);$update->execute();
     $ref=$habit;$db->commit();$success=true;
    }
   }
  }catch(Throwable $e){$db->rollback();if((int)$e->getCode()===1062)$error='Une location existe déjà pour cette tenue à cette date.';else throw $e;}
 }
}
$clients=$db->query('SELECT cin,nom FROM client ORDER BY nom');
$habits=$db->query('SELECT h.codeHab,h.description,h.taille,h.prix,c.libelle FROM habit h INNER JOIN categorie c ON c.codeCat=h.codeCat WHERE h.disponible=\'D\' ORDER BY c.libelle,h.description');
?><!doctype html><html lang="fr"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Louer une tenue — Fedi Élégance</title><link rel="stylesheet" href="fedi.css"></head><body><header><a class="brand" href="index.php"><span>F</span> Fedi Élégance</a><nav><a href="index.php">Accueil</a><a href="catalogue.php">Catalogue</a><a href="ajout.php">Ajouter une tenue</a></nav></header><main class="content"><p class="eyebrow">Location</p><h1>Réserver une tenue</h1><?php if($error):?><p class="alert"><?=h($error)?></p><?php endif;?><?php if($success):?><p class="success">Location enregistrée. Référence de la tenue : #<?=$ref?>.</p><?php endif;?><form method="post"><input type="hidden" name="csrf" value="<?=h(csrf())?>"><label for="cin">Client</label><select id="cin" name="cin" required><option value="">Choisir un client</option><?php while($c=$clients->fetch_assoc()):?><option value="<?=h($c['cin'])?>"><?=h($c['nom'].' — '.$c['cin'])?></option><?php endwhile;?></select><label for="habit">Tenue disponible</label><select id="habit" name="habit" required><option value="">Choisir une tenue</option><?php while($h=$habits->fetch_assoc()):?><option value="<?=(int)$h['codeHab']?>"><?=h($h['description'].' · '.$h['libelle'].' · taille '.$h['taille'].' · '.$h['prix'].' TND')?></option><?php endwhile;?></select><label for="date">Date de location</label><input id="date" name="date" type="date" min="<?=h(date('Y-m-d'))?>" required><label for="duree">Durée (jours)</label><input id="duree" name="duree" type="number" min="1" max="14" value="1" required><button class="button">Confirmer la location</button></form></main><footer>Fedi Élégance</footer></body></html>