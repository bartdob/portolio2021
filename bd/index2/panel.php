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
echo "<p> Witaj ".$_SESSION['user'].'<a href="logout.php">Logout</a>]</p>';
echo "<p><b>imie</b>:".$_SESSION['imie'];
echo "<br/>";
echo "<b>mail</b>:".$_SESSION['mail']."</p>";
?>



<div id="container"> 
	
	<div class="rectangle"> 
		
		<div id="logo1"> 
		<a href="zmienh.php">zmien haslo</a> </p>
		<a href="usunk.php">usun konto</a> </p>
		<a href= "index.html">home</a>
		<a href="search/search.php">dobierz kite</a></div>
		<div style="clear:both;"></div>
		
	</div>

</body>

</html>