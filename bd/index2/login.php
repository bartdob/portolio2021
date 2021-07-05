 <?php

session_start();

if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalagowany'] == true))
{
	header('Location: gra:php');
	exit();
}

?>

<!DOCTYPE html>
<html>
<head>

	<title></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<style type="text/css">
		body{
			background-color: grey;
		}
	</style>
</head>
<body>
<div class="container border border-info p-4 m-3 bg-secondary" style="max-width: 400px;">
	<form action = "zaloguj.php" method="post">
	<div class="form-group">
		<label for="Email">Email address</label>
	<input type="email" name="login" class="form-control" aria-describedby="emailHelp" placeholder="Enter email"/>
	<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
	</div>
	<div class="form-group">
		 <label for="Password1">Password</label>
	hasło:<input type="password" name="haslo" class="form-control" placeholder="Password"/> <br/>
	 <div class="form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
	<button type="submit" class="btn btn-primary mt-3">Zaloguj</button>
	</div>
	</form>
</div>

<div class="container border border-info p-4 m-3 bg-secondary" style="max-width: 400px;">
	<p>nie masz konta? Zarejestruj się :D</p>
	<a class="btn btn-info" href="rejestracja.php" role="button">Rejestracja</a>
</div>

<?php
	if(isset($_SESSION['blad'])) echo $_SESSION['blad'];
?>

</body>
</html>