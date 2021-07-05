<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
	session_start();
	
	if(isset($_POST['email']))
	{
	$wszystko_OK=true;
	//sprawdzenie nika
	$imie=$_POST['imie'];
	//sprawdzenie dlugosci nika
	if((strlen($imie)<3) || (strlen($imie)>20))
	{
		$wszystko_OK=false;
		$_SESSION['e_imie']="imie musi posiadać od 3 do 20 znaków!";
	
	}
	
	if(ctype_alnum($imie)==false)
	{
		$_wszystko_OK=false;
		$_SESSION['e_imie']="nick może skladać się tylko z liter i cyfr bez polskich znaków";
	}
	
	$nick=$_POST['nick'];
	//sprawdzenie dlugosci nika
	if((strlen($nick)<3) || (strlen($nick)>20))
	{
		$wszystko_OK=false;
		$_SESSION['e_nick']="nick musi posiadać od 3 do 20 znaków!";
	
	}
	
	if(ctype_alnum($nick)==false)
	{
		$_wszystko_OK=false;
		$_SESSION['e_nick']="nick może skladać się tylko z liter i cyfr bez polskich znaków";
	}
	
	// sprawdz poprawność e-mail
	$email = $_POST['email'];
	$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
	
	if((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
	{
		$wszystko_OK=false;
		$_SESSION['e_email']="Podaj poprawny format mail";
	}
	
	// sprawdz poprawność hasla
	$haslo1 = $_POST['haslo1'];
	$haslo2 = $_POST['haslo2'];
	
	
	If((strlen($haslo1)<=4) || (strlen($haslo1>20)))
	{
		$wszystko_OK=false;
		$_SESSION['e_haslo']="haslo moze miec od 4 do 20 znaków";
	}
	if($haslo1!=$haslo2)
	{
		$wszystko_OK=false;
		$_SESSION['e_haslo']="Podane hasła nie są identyczne";
	}
	
	$haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
	//echo $haslo_hash; exit(); - do sprawdzenia hashu hasła
	
	if(!isset($_POST['regulamin']))
	{	
	$wszystko_OK=false;
	$_SESSION['e_regulamin']="Zaakceptuj regulamin";
	}
	
	//recatpcha
	$sekret = "6Lfu758UAAAAABDpQ9yKFNVVL3TaYMK43JhB_DuC"; // podmieniony
	
	$sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);
	
	
	$odpowiedz = json_decode($sprawdz);
	
	if($odpowiedz -> success==false)
	{
	$wszystko_OK=false;
	$_SESSION['e_bot']="potwierdź ze nie jesteś z metalu (lub nie jesteś botem) :)";
	}
	
	require_once "connect.php";  // zmienic przy publikacji domeny
	
	mysqli_report(MYSQLI_REPORT_STRICT); //zamiast warningow to wyjatki rzucamy w ostrzezeniach
	
	try
	{
		$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
		if($polaczenie->connect_errno!=0)
				{
					throw new Exception(mysqli_connect_errno());
				}
				else 
				{
					//czy email juz istnieje
					$rezultat = $polaczenie->query("SELECT id FROM users WHERE mail='$email'");
					
					if(!$rezultat) throw new Exception($polaczenie->error);
					
					$ile_takich_maili = $rezultat->num_rows;
					
					if($ile_takich_maili>0)
					{
					$wszystko_OK=false;
					$_SESSION['e_email']="Istnieje już konto przypisane do tego adresu mail :/";
					}
					
										//czy nick juz istnieje
					$rezultat = $polaczenie->query("SELECT id FROM users WHERE nick='$nick'"); //???
					
					if(!$rezultat) throw new Exception($polaczenie->error);
					
					$ile_takich_nickow = $rezultat->num_rows;
					
					if($ile_takich_nickow>0)
					{
					$wszystko_OK=false;
					$_SESSION['e_nick']="Istnieje już gracz o takim nicku :/, wybierz inny";
					}
					
					$klucz=md5(mt_rand()); // generuje klucz random lub md5($_POST['nick'] + microtime())
					
					if($wszystko_OK==true)
					{
							//wszystkie testy zakończone, dodajemy gracza do bazy
					
						if($polaczenie->query("INSERT INTO users VALUES (NULL, '$imie', '$nick', '$email', '$haslo_hash', 2, 0, '$klucz')"))
						{
							$_SESSION['udanarejestracja']=true;

                            require 'PHPMailer/src/Exception.php';
                            require 'PHPMailer/src/PHPMailer.php';
                            require 'PHPMailer/src/SMTP.php';
							
						
							$mail = new PHPMailer(true);

							$mail->SMTPDebug = 2;                               // Enable verbose debug output

							$mail->isSMTP();                                      // Set mailer to use SMTP
							$mail->Host = 's75.linuxpl.com';  					// Specify main and backup SMTP servers
							$mail->SMTPAuth = true;                               // Enable SMTP authentication
							$mail->Username = 'b@dobrosielski.com.pl';                 // SMTP username
							$mail->Password = '3B1@3^@bgB#{74N';                           // SMTP password
							$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
							$mail->Port = 587;                                    // TCP port to connect to

							$mail->setFrom('b@dobrosielski.com.pl', 'Mailer');
							$mail->addAddress($email, $nick);     // Add a recipient // tu zmienialem
							$mail->addAddress('g8824@wp.pl');               // Name is optional
							$mail->addReplyTo('g8824@wp.pl', 'Information');
							//$mail->addCC('cc@example.com');
							//$mail->addBCC('bcc@example.com');

                            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
							//$mail->isHTML(true);                                  // Set email format to HTML

							$mail->Subject = 'Rejestracja bobrosielski.com.pl';
							$mail->Body    = 'Gratuluje zostales zarejestrowany:) <b> !!!!! </b> <br/>
							twoj klucz to:'.$klucz.'<br/>
							Prosze wprowadz klucz na stronie: 
							https://www.dobrosielski.com.pl/index2/klucz.php?email='.$email.'&klucz='.$klucz;
							//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
							
						//	('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);

							if(!$mail->send()) 
							{
								echo 'Message could not be sent.';
								echo 'Mailer Error: ' . $mail->ErrorInfo;
							} else 
								{
								echo 'Message has been sent';
                                    usleep(2000000);
                                    header('Location: witamy.php');
								}
							
							
						}
						else
						{
							throw new Exception($polaczenie->error);
						}
					}
					
					
					$polaczenie->close();
				}
	}
	catch(Exception $e)
	{
		echo '<span style="color; red;">Blad serwera (serwer error), prosimy o rejestracje w innym czasie" </span>';
	}
	
	echo '<br /> Informacja developerska;'.$e; // pozniej do wykreślenia
	
	
	}
?>

<!DOCTYPE HTML>

<html lang="pl">
<head>
	<meta charset="utf-8"/>
	
	<title> rejestracja </title>
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://kit.fontawesome.com/f30c7c0f9b.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Merriweather&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	
	<style>
		
		.error
		{
			color:red;
			margin-top: 10px;
			margin-bottom: 10px;
		}

		body{
			background-color: black;
			color: white;
		}
		
	
	</style>
	
	
</head>


<body>
	<div class="container border border-info p-4" style="background-color: grey; max-width: 400px;">

	<form method="post">
		<div class="form-group">
		<label for="imie">
		Imie: <br/> <input type="text" name="imie" class="form-control" placeholder="imie" /> <br />
		</label>
		</div>
		
		<?php
		
		if(isset($_SESSION['e_imie']))
		{
		echo'<div class="error">'.$_SESSION['e_imie'].'</div>';
		unset($_SESSION['e_imie']);
		}
		
		?>
		<div class="form-group">
		<label for="nick">
		Nick: <br/> <input type="text" name="nick" class="form-control" placeholder="imie"/> <br />
		</label>
		</div>

		<?php
		
		if(isset($_SESSION['e_nick']))
		{
		echo'<div class="error">'.$_SESSION['e_nick'].'</div>';
		unset($_SESSION['e_nick']);
		}
		
		?>
		<div class="form-group">
		<label for="email">
		E-mail: <br/> <input type="text" name="email" class="form-control" placeholder="email"  /> <br/>
		
		<?php
		
		if(isset($_SESSION['e_email']))
		{
		echo'<div class="error">'.$_SESSION['e_email'].'</div>';
		unset($_SESSION['e_email']);
		}
		
		?>
					
		<div class="form-group">
		<label for="password">			
		Password: <br/> <input type="password" name="haslo1" class="form-control" placeholder="password" /> <br/>
		</label>
		</div>
		
		<?php
		
		if(isset($_SESSION['e_haslo']))
		{
		echo'<div class="error">'.$_SESSION['e_haslo'].'</div>';
		unset($_SESSION['e_haslo']);
		}
		
		?>
		<div class="form-group">
		<label for="password">	
		Powtorz Password: <br/> <input type="password" name="haslo2" class="form-control" placeholder="password"/> <br/>
					
		<label>
		<input class="form-check-input" type="checkbox" name="regulamin"/> Akcpetuje regulamin </label>
					
		<?php
		
		if(isset($_SESSION['e_regulamin']))
		{
		echo'<div class="error">'.$_SESSION['e_regulamin'].'</div>';
		unset($_SESSION['e_regulamin']);
		}
		
		?>
					
		<div class="g-recaptcha" data-sitekey="6Lfu758UAAAAADElRQW_e5aorIQBGeQqVjYroRxi"></div>
		
		<?php
		
		if(isset($_SESSION['e_bot']))
		{
		echo'<div class="error">'.$_SESSION['e_bot'].'</div>';
		unset($_SESSION['e_bot']);
		}
		
		?>
		
		<br/>

		<input class="btn btn-primary" type="submit" value="Zarejestruj sie" />
		</form>

</div>

	
<br />



</body>
</html>