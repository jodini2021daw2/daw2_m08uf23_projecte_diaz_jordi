<?php
	require 'vendor/autoload.php';
	use Laminas\Ldap\Ldap;
	use Laminas\Ldap\Attribute;
	
	ini_set('display_errors', 0);
	if ($_POST['uid'] && $_POST['ou']){

	$opcions = [
		'host' => 'zend-jodini.fjeclot.net',
		'username' => 'cn=admin,dc=fjeclot,dc=net',
		'password' => 'fjeclot',
		'bindRequiresDn' => true,
		'accountDomainName' => 'fjeclot.net',
		'baseDn' => 'dc=fjeclot,dc=net',		
	];
	
	$ldap = new Ldap($opcions);
	$ldap->bind();
	$dn='uid='.$_POST['uid'].',ou='.$_POST['ou'].',dc=fjeclot, dc=net';
	if ($ldap->delete($dn))	{
	    echo "<b>Entrada esborrada</b><br>";
	}  else echo "<b>Aquesta entrada no existeix</b><br>";
	}
?>

<html>
	<head>
		<title>ESBORRANT DADES D'USUARIS 
		</title>
	</head>
	<body>
		<form action="http://zend-jodini.fjeclot.net/proyecto_JordiDiaz/esborrar.php" method="POST">
		Unitat organitzativa: <input type="text" name="ou"><br>
		Usuari: <input type="text" name="uid"><br>
		<input type="submit"/>
		<input type="reset"/>
		</form>
	</body>
</html>
