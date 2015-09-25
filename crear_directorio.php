<?php
	$directorio = $_REQUEST["directorio"];
	
	if(mkdir("../".$directorio))
		echo "Directorio creado";
	else
		echo "El directorio no pudo ser creado"
?>