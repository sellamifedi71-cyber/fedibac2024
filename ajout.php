<?php
$cnx=mysqli_connect("localhost","root","","bdsellami");
$c=$_POST["categorie"];
$d=$_POST["description"];
$taille="";
if(isset($_POST["r1"]))
{$taille="S";}
if(isset($_POST["r2"]))
{$taille="m";}
if(isset($_POST["r3"]))
{$taille="l";}
if(isset($_POST["r4"]))
{$taille="xl";}
$p=$_POST["p"];
$dis="N";
$req1="select * from habit h,location l where l.codeHab=h.codehab";
$res1=mysqli_query($cnx,$req1);
if(mysqli_num_rows($res1)>0)
{
	$dis="O";
}
$req2="insert into habit value('','$d','$taille','$p','$dis',$c)";
$res2=mysqli_query($cnx,$req2);
if(mysql_affected_rows($cnx)>0)
{echo("enregistrement avec succes");}
mysqli_close($cnx);
