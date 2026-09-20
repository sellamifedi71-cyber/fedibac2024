<?php

$cnx=mysqli_connect("localhost","root","","bdsellami");
$ch=$_POST["ch"];
$cc=$_POST["cc"];
$dl=$_POST["dl"];
$req="select * from habit where '$ch'=codehabit";
$res=mysqli_query($cnx,$req);
if(mysqli_num_rows($res)=0)
{echo(" habit inexistant");}
else{
	$req2="select * from habit where '$ch'=codehabit and disponible=N";
	$res2=mysqli_query($cnx,$req2);
	if(mysql_affected_rows($cnx)>0)
	{echo("habit deja loue");}
	else{
		$req4="select * from client where '$c'=cin";
			$res4=mysqli_query($cnx,$req4);
		if(mysqli_num_rows($res4)=0)
		{echo("client inexistant");}
	else{
		$req5="insert into location values('$d','$ch','$cc','$dl')";
		$res5=mysqli_query($cnx,$req5);
		
		
		
	}
	}
}