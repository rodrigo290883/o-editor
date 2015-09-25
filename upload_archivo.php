<?php
	$archivo = $_FILES["file"]["name"];
	$ubicacion = $_REQUEST["path"];
	rename($_FILES["file"]["tmp_name"],"../".$ubicacion."/".$archivo);
	chmod("../".$ubicacion."/".$archivo,0777);
	echo "<script language='javascript'>window.open('index.php','_self');</script>";
?>