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
	<title> game </title>
	
</head>


<body>

<a href="panel.php">Ustawienia konta</a>
	
<?php
echo "<p> Witaj ".$_SESSION['user'].'![<a href="logout.php">Logout</a>]</p>';
echo "<p><b>imie</b>:".$_SESSION['imie'];
echo "<br/>";
echo "<b>mail</b>:".$_SESSION['mail']."</p>";

echo date('Y-m-d H:i:s')."<br>"
?>
	
	
	</form>

</body>
<html>