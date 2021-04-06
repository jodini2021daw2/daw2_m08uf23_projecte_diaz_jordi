<?php
	require 'vendor/autoload.php';
	use Laminas\Ldap\Attribute;
	use Laminas\Ldap\Ldap;
	
	
	ini_set('display_errors', 0);
	if ($_POST['uid'] && $_POST['ou']&& $_POST['select'] ){
	  
	
	$opcions = [
		'host' => 'zend-jodini.fjeclot.net',
		'username' => 'cn=admin,dc=fjeclot,dc=net',
		'password' => 'fjeclot',
		'bindRequiresDn' => true,
		'accountDomainName' => 'fjeclot.net',
		'baseDn' => 'dc=fjeclot,dc=net',		
	];
	#
	# Modificant l'entrada
	#
	$ldap = new Ldap($opcions);
	$ldap->bind();
	$dn='uid='.$_POST['uid'].',ou='.$_POST['ou'].',dc=fjeclot, dc=net';
	$entrada = $ldap->getEntry($dn);
	if ($entrada){
	    Attribute::setAttribute($entrada,$_POST['select'],$_POST['nuevovalor']);
		$ldap->update($dn, $entrada);
		echo "Atribut modificat"; 
	} else echo "<b>Aquesta entrada no existeix</b><br><br>";
	
	
	
	}
?>

<html>
	<head>
		<title>MODIFICANT DADES D'USUARIS
		</title>
	</head>
	<body>
		<form action="http://zend-jodini.fjeclot.net/proyecto_JordiDiaz/modificar.php" method="POST">
		Unitat organitzativa: <input type="text" name="ou"><br>
		Usuari: <input type="text" name="uid"><br>
		
		
 		<input type="text" name="nuevovalor"><br>
		<select name="select">
		<option value="uidNumber">uidNumber</option>
		<option value="gidNumber">gidNumber</option>
		<option value="homeDirectory">homeDirectory</option>
		<option value="Shell">Shell</option>
		<option value="cn">cn</option>
		<option value="sn">sn</option>
		<option value="givenName">givenName</option>
		<option value="postalAddress">postalAddress</option>
		<option value="mobile">mobile</option>
		<option value="telephoneNumber">telephoneNumber</option>
		<option value="title">title</option>
		<option value="description">description</option>
		</select>
		
		<input type="submit"/>
		<input type="reset"/>
		</form>
	</body>
</html>
