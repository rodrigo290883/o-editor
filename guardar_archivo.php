<?php
	$archivo = $_REQUEST["archivo"];
	$contenido = $_REQUEST["contenido"];
	$contenido = stripslashes($contenido);
	if ($file=fopen("../".$archivo,"w+b"))
	{
		fputs($file,$contenido);
		fclose($file);
		echo "archivo guardado";
	}
	else
		echo "no se pudo guardar";
?>
