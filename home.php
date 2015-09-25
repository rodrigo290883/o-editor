<?php 
	session_start();
	
	if(!isset($_SESSION["user"]))
	 {
	 	echo "<script>window.open('index.php','_self')</script>";
	 }
		error_reporting(0);
	$action = $_REQUEST["action"];
	$archivo = $_REQUEST["archivo"];
	$estado = "Editor HTML Js PHP";
	if($action == "abrir")
	{
		$file=fopen("../".$archivo,"rb");
		$registro = "";
		while(!feof($file))
		  {
		  $registro.= fgets($file);
		  }
		$permisos = substr(decoct(fileperms("../".$archivo)),3);
		fclose($file);
		$estado = "(".$permisos.")  Archivo Activo: ".$archivo;
	}
	else if($action == "nuevo")
	{
		$registro = "";
		$estado = "Archivo Nuevo";
	}
	
?>

<!--	
"Editor de Textos Online"

Autor: Rodrigo Lira Gonzalez 
Email: rodrigo290883@gmail.com
Version: 1.01
Libre Distribucion
-->


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="AUTHOR" content="Ing. Rodrigo Lira Gonzalez">
<title>Editor Online</title>
</head>

<script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
<script src="js/jqueryFileTree.js" type="text/javascript"></script>
<script src="js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
<script>
	var estatus = "<?php echo $action; ?>";
	$(document).ready( function() {
    	$('#tree').fileTree({script: 'connectors/jqueryFileTree.php' }, function(file) { 
				window.open("home.php?action=abrir&archivo="+file.substr(3),"_self");
		});
		$( ".boton" ).button();
		$( "#d_subir_archivo" ).dialog({ 
				autoOpen: false,
				modal: true,
				width: 550
			});
		$( "#guardar").click(function(){
			$.post('guardar_archivo.php',{ archivo: <?php echo "'".$archivo."'"; ?>, contenido: $("#page").val() }, function(data) { alert(data);});	
		});
		$( "#guardar_como").click(function(){
			var nombre = prompt("Escriba el nombre del archivo");
			$.post('guardar_archivo.php',{ archivo: nombre, contenido: $("#page").val() }, function(data) { alert(data);});	
		});
		$( "#mkdir").click(function(){
			var nombre = prompt("Escriba el nombre del directorio");
			$.get('crear_directorio.php',{ directorio: nombre }, function(data) { alert(data);});	
		});
		$( "#borrar").click(function(){
			if(confirm("En verdad deseas borrar el archivo: <?php echo $archivo; ?>" ))
			$.get('borrar_archivo.php',{ archivo: <?php echo "'".$archivo."'"; ?>}, function(data) { alert(data);});	
		});
		$( "#nuevo").click(function(){
			window.open("home.php?action=nuevo&archivo=files/inuse/nuevo.txt","_self");
		});
		$( "#probar").click(function(){
			if(estatus == "abrir")
				window.open("<?php echo "../".$archivo; ?>","_blank");
			else if( estatus == "nuevo" )
				alert("Primero se necesita guardar el archivo");
			else
				alert("Primero necesitas abrir un archivo");
		});
		$( "#upload").click(function(){
			$('#d_subir_archivo').dialog("open");
		});
		$( "#salir").click(function(){
			window.open('salir.php','_self');
		});
	});
</script>

<link rel="stylesheet" href="css/jquery-ui-1.8.16.custom.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/jqueryFileTree.css" type="text/css" media="all" />
<style>
	*	{
		padding:0px;
		margin:0px;
		top:0px;
		left:0px;
	}
	#tree	{ 	position:absolute; 
				left:-15%; 
				top:17%; 
				width:15%; 
				height:71%;
				border-top: solid 4px #BBF;
				border-left: solid 4px #BBF;
				border-bottom: solid 4px #CCF;
				border-right: solid 4px #CCF;
				background: #F0F0FF;
				overflow: auto;
				padding: 10px;
				z-index:2000;
				border-radius: 10px;
				transition: left 1s;
				-moz-transition: left 1s; /* Firefox 4 */
				-webkit-transition: left 1s; /* Safari and Chrome */
				-o-transition: left 1s; /* Opera */
			}
			
	#tree:hover	{ 	
				left:1%; 
				
			}
	#page{
				position:absolute;
				top:12%;
				width:90%;
				left:5%;
				height: 79%;
				border-top: solid 3px #BBB;
				border-left: solid 3px #BBB;
				border-bottom: solid 3px #CCC;
				border-right: solid 3px #CCC;
				background: #FFF;
				overflow: auto;
				padding: 10px 10px 10px 10px;
				z-index:2;
				border-radius: 10px;
				box-shadow: 0px 0px 25px #BBB;
				color:#333333;
			}
	body	{
				background-color:#DDDDDD;
	}
	
	#menu	{
				position:absolute;
				top:5px;;
				left:8%;
	}	
	
	#barra_estado	{
			position:absolute;
			font:Verdana, Arial, Helvetica, sans-serif;
			font-size:14px;
			font-weight:bold;
			color:#666666;
			top:95%;
			left:55%;
	}
	
</style>

<body>
	<div id="menu">
		<table>
			<tr>
			<td style="width:25%;">
				<img src="images/logo2.png" style="width:180px; " onclick="window.open('home.php?action=nuevo','_self')"/>
			</td>
			<td>
			<button class="boton" id="nuevo">Nuevo</button>	
			<button class="boton" id="guardar">Guardar</button>
			<button class="boton" id="guardar_como">Guardar como</button>		
			<button class="boton" id="probar">Probar</button>
			<button class="boton" id="borrar">Borrar</button>
			<button class="boton" id="mkdir">MkDir</button>
			<button class="boton" id="upload">UpLoad</button>
			<button class="boton" id="salir">Salir</button>
			</td></tr>
		</table>
	</div>
	<div id="tree" class="demo">
	</div>
	
	<textarea id="page" maxlength="1000000"><?php echo str_ireplace("</textarea>","&lt;/textarea>",$registro); ?></textarea>
	
	<div id="d_subir_archivo" class="dialogo" title="Enviar XML">
		<center>
			<form id="subir_archivo" method="post" action="upload_archivo.php" enctype="multipart/form-data">
				<input type="file" id="file" name="file" />
				<input type="text" name="path" value="" />
				<br /><br />
				<input form="subir_archivo" type="submit" value="enviar" class="boton"/>
			</form>
		</center>
	</div>
	<p id="barra_estado"><?php echo $estado ?></p>	
</body>
</html>
