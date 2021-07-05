<html lang="pl">
<head>
	<meta charset="utf-8"/>
	<meta http=equiv="X-UA-Compatible" content=IE=edge, chrome=1"/>
	<title> kontakt </title>
	<script src='https://www.google.com/recaptcha/api.js'></script>
	
	<style>
		
		.error
		{
			color:red;
			margin-top: 10px;
			margin-bottom: 10px;
		}
		
	
	</style>
	
	
</head>


<body>

	<form action="contact.php" method="post">
	
	Imie: * <br/> <input type="text" name="imie" /> <br /
	
	
	Nick: * <br/> <input type="text" name="nick" /> <br />

	
	E-mail: * <br/> <input type="text" name="email" /> <br/>
			
				
	wiadomość: * <br/> <textarea name="wiadomosc" rows='8' /> </textarea><br/>
	
</body>
</html>