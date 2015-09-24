<?php
	 session_start();
	 
	 if(isset($_SESSION["user"]))
	 {
	 	echo "<script>window.open('home.php','_self')</script>";
	 }
	 else
	 {
	 	if(isset($_REQUEST["login"]))
		{
			$pass = $_REQUEST["pass"];
			$pass = sha1($pass);
			if($pass == "be3f9b1c6c75ee0282d1acbe261d28e2aa33e07b")
			{
				$_SESSION["user"] = "Usuario";
				echo "<script>window.open('home.php','_self')</script>";
			}
			else
				echo "<script>alert('Clave Incorrecta');window.open('index.php','_self')</script>";
		}
	 }
?>
<html>
<head>
  <title>o-Editor</title>
</head>

<style>
	
	*	{
		font:Verdana, Arial, Helvetica, sans-serif;
		font-size:20px;
	}	
	
	#fondo1	{
		background:url(images/fondo1.png);
		width:100%;
		min-height:700px; 
		height:100%;
				opacity:0.6;
		background-repeat:repeat; 
		z-index:0; 
		position:absolute; 
		top:0px; 
		left:0px;
	}
	#fondo2	{
		background:url(images/fondo2.png);
		width:100%;
		min-height:700px; 
		height:100%;
		opacity:0.5;
		background-repeat:repeat; 
		z-index:-3; 
		position:absolute; 
		top:0px; 
		left:0px;
	}
	#fondo3	{
		background:url(images/fondo3.png);
		width:100%;
		min-height:700px; 
		height:100%;
		opacity:0.5;
		background-repeat:repeat; 
		z-index:-3; 
		position:absolute; 
		top:0px; 
		left:0px;
	}

	
	body	{
				background-color:#DDDDDD;
	}
	
	#logo	{
		position:absolute;
		top:35%;
		left:25%;
		
	}
	#div_login	{
		position:absolute;
		top:35%;
		right:15%;
		width:30%;
	}
	#div_login td	{
	padding:10px;
	
	}

	#div_login input	{
		border-radius:5px;
		height:30px;
	
	}
</style>

<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery.spritely-0.4.js"></script>

<script>
$(function() 
	{	
			
			$('#fondo2').pan({fps: 24, speed: 1, dir: 'left'}).css({ "opacity": "0.5" });
			$('#fondo3').pan({fps: 24, speed: 1, dir: 'right'}).css({ "opacity": "0.5" });						
		
	});
</script>

<body>
	<div id="fondo1">
	</div>
	<div id="fondo2">
	</div>
	<div id="fondo3">
	</div>
	
	<div id="logo">
		<img src="images/logo2.png">
	</div>
	<div id="div_login">
	<form>
		<input type="hidden" name="login" value='si'>
		<table>
			<tr><td colspan="2">Introduce la clave:</td></tr>
			<tr>
				<td>Clave:</td>
				<td><input name='pass' type="password"></td>
			</tr>
			<tr><td colspan="2"><center><input type="submit" value="Entrar"></center></td></tr>
		</table>
	</form>
	</div>
</body>
</html>
