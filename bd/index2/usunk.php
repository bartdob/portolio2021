<?php

	session_start();
	
	if(!isset($_SESSION['zalogowany'] )) // if doklecić do każej strony w której mozesz byc zalogowany
	{
		header('Location: Index.php');
		exit();
	}
?>


<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8"/>
	<meta http=equiv="X-UA-Compatible" content=IE=edge, chrome=1"/>
	<title> panel sterowania </title>
	<meta name="description" content="JA" />
	<meta name="keywords" content="coding" />
	<meta http-equiv="X-UA-Compatibile" content="IE=edge,chrome=1" />
	<link rel="stylesheet" href="style.css" type="text/css" />
	<link rel="stylesheet" href="css/fontello.css" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab" 
	rel="stylesheet" type='text/css'> 

	
</head>

<body>
<?php

$nick=$_SESSION['user'];
echo "nick: ".$nick;
echo "<br/>";

$email= $_SESSION['mail']; // może funckją post $_
echo "email: ".$email;
echo "<br/>";




require_once "connect.php";

$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);

if($email!=0 && $nick!=0)
{
	echo "nieznane konto";
}
else
{
	$rezultat = $polaczenie->query("SELECT id FROM users WHERE mail= '$email' AND nick ='$nick' AND aktiv = 1");
	if($rezultat<=0)
	{
	echo "upssss bład, cos poszlo nie tak jak trzeba :(";
	}
	else
	{
	$polaczenie->query("DELETE FROM users WHERE mail = '$email' and nick= '$nick' AND aktiv = 1 LIMIT 1");
	echo ":( Twoje konto zostalo usuniete";
	
	session_unset();

	}
}

$polaczenie-> close();

 
?>


</body>

<html>