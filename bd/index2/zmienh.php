<?php

	session_start();
	
	if(!isset($_SESSION['zalogowany'] )) // if dokleci� do ka�ej strony w kt�rej mozesz byc zalogowany
	{
		header('Location: Index.php');
		exit();
	}
	
	if((strlen($haslon)<=4) || (strlen($haslon>20)))
	{
		$wszystko_OK=false;
		$_SESSION['e_haslon']="haslo moze miec od 4 do 20 znakow";
	
	if($haslon!=$haslon1)
	{
		$wszystko_OK=false;
		$_SESSION['e_haslon']="Podane hasła nie są identyczne";
	}
	
	require_once "connect.php";
	$haslo_hash = password_hash($haslon, PASSWORD_DEFAULT);
	//echo $haslo_hash; exit(); - do sprawdzenia hashu has�a
	
	mysqli_report(MYSQLI_REPORT_STRICT);
	try
	{
	
	$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
	if($polaczenie->connect_errno!=0)
				{
					throw new Exception(mysqli_connect_errno());
				}
				else
	
	if($wszystko_OK==true)    //wszystkie testy zako�czone pozytywanie
	{	
					$polaczenie->query("UPDATE users SET haslo= '$haslo_hash' WHERE mail = '$email' AND aktiv=1 LIMIT 1");
					echo "udana zmiana hasła";
	}
	else
	{
	echo "upss, coś poszło nie tak...";
	}
	}

//$polaczenie->close();
	
?>


<!DOCTYPE HTML>

<html lang="pl">
<head>
	<meta charset="utf-8"/>
	<meta http=equiv="X-UA-Compatible" content=IE=edge, chrome=1"/>
	<title> panel sterowania - zmiana hasla	</title>
	<meta name="description" content="JA" />
	<meta name="keywords" content="coding" />
	<meta http-equiv="X-UA-Compatibile" content="IE=edge,chrome=1" />
	<link rel="stylesheet" href="style.css" type="text/css" />
	<link rel="stylesheet" href="css/fontello.css" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab" 
	rel="stylesheet" type='text/css'> 

	
</head>

<body>

Aby zmienić hasło proszę o wypełnienie poniższych pól:


<form method="post">

Stare haslo: <br/> <input type="password" name="haslo1" /> <br/> 
	
	<?php //potwierdzenie starego hasla
	
	if(isset($_SESSION['e_haslo']))
	{
	echo'<div class="error">'.$_SESSION['e_haslo'].'</div>';
	unset($_SESSION['e_haslo']);
	}
	
	?>
	
	
Nowe haslo: <br/> <input type="password" name="haslon" /> <br/>
	
	<?php // wprowadzanie nowego hasla 1
	
	if(isset($_SESSION['e_haslo']))
	{
	echo'<div class="error">'.$_SESSION['e_haslo'].'</div>';
	unset($_SESSION['e_haslo']);
	}
	
	?>
	
Powtórz nowe: <br/> <input type="password" name="haslon1" /> <br/>
	
	<?php // potwierdzania hasla 1
	
	if(isset($_SESSION['e_haslo']))
	{
	echo'<div class="error">'.$_SESSION['e_haslo'].'</div>';
	unset($_SESSION['e_haslo']);
	}
	
	?>
	
	<br/>
	<input type="submit" value="zmień hasło" />

</form>
	
	<br/>

</body>

</html>