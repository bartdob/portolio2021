 <?php

session_start();

if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalagowany'] == true))
{
	header('Location: gra:php');
	exit();
}

?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
<meta charset = "utf-8" />
<title> portfolio</title>
<meta name="description" content="JA" />
<meta name="keywords" content="coding" />
<meta http-equiv="X-UA-Compatibile" content="IE=edge,chrome=1" />
<link rel="stylesheet" href="style.css" type="text/css" />
<link rel="stylesheet" href="css/fontello.css" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Roboto+Slab" 
	rel="stylesheet" type='text/css'> 

<script type="text/javascript" src="timer.js"> </script>
<script type="text/javascript" src="geo.js"> </script>
	
</head>

<body onload="odliczanie();">

	<form action = "zaloguj.php" method="post">
	login:<input type="text" name="login"/>
	hasło:<input type="password" name="haslo"/> <br/>
	<input type="submit" value="Zaloguj się"/>	
	</form>
	<a href="rejestracja.php">Rejestracja</a>
	<a href="kontakt/kontaktf.php"> Formularz kontaktu</a>
<?php
	if(isset($_SESSION['blad'])) echo $_SESSION['blad'];
?>



<div id="container"> 
	
	<div class="rectangle"> 
		
		<div id="logo"> 
		<a href="index.html"></a>  </div>
		<div id="zegar"> 00:00:00</div>
		<div style="clear:both;"></div>
	</div>
	
	<div class="square"> 
		<div class="tail1">
		<a href="priv/kimjestem.html" class="tilelink"><i class="icon-user"></i> <br/> Kim jestem </a> 
		</div>
		<div class="tail11"> <a href="code.html" class="tilelink"><i class="icon-laptop"></i> <br/> code</a> </div>
		<div style="clear:both;">
		</div>
		
		<div class="tail2">
		<a href="priv/BDCV.pdf">
		<i class="icon-graduation-cap"></i> <br/> CV  </div>
		<div class="tail3">
		<a href="zainteresowania.html" class="tilelink"><i class="icon-wind"></i> <br/> hobby </a> </div>
		<div style="clear:both;"></div>
		
		<div class="tail4"> </br> <i> How embarrassing </br> <p> to be human. </br> <p> Kurt Vonnegut </br> </i></i> </div> 
	</div>
	
	<div class="square">
		<div class="tail5"> 
		Cześć!!!</br>
		<p>Mam na imię Bartosz,<p> a ta strona powstała jako mój projekt:).</p>
		<br/> </div>
		
		<div class="yt">
		<a href="https://www.youtube.com/channel/UCvgtXg-c3zNej7Ub9Fz-idQ"><i class="icon-youtube-squared"></i> </br> </a>  
		</div>
		
		<div class="fb"> <a href="priv/facebook.php">
		<i class="icon-facebook-squared"></i></br> </div>
		<div style="clear:both;"></div>
	</div>
	
	<div class="rectangle">Mail me<a href="mailto:g8824@wp.pl"><i class="icon-mail"></i> <br/> </a> 
	</div>
<footer>
2016 &copy; BD 

</footer>	
<button id="detect" onclik="function()"> Wykryj lokalizację </button>
<div id="map"> mapa 

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAUfr14f9gJ2gHrp84_KPr4m18a3hy5558&callback=initMap"
 type="text/javascript"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="geo.js"> </script>

</div>


</body>



</html>