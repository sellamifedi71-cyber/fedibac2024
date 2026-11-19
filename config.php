<?php
declare(strict_types=1);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
session_start();
try { $db = new mysqli('localhost','root','','bdsellami'); $db->set_charset('utf8mb4'); }
catch(mysqli_sql_exception $e) { http_response_code(500); exit('Connexion impossible. Importez bdsellami.sql et vérifiez config.php.'); }
function h(string $v): string { return htmlspecialchars($v,ENT_QUOTES|ENT_SUBSTITUTE,'UTF-8'); }
function csrf(): string { if(empty($_SESSION['csrf'])) $_SESSION['csrf']=bin2hex(random_bytes(32)); return $_SESSION['csrf']; }
function verify_csrf(): void { if(!is_string($_POST['csrf']??null)||!hash_equals($_SESSION['csrf']??'',$_POST['csrf'])) { http_response_code(419); exit('Formulaire expiré. Rechargez la page.'); } }
