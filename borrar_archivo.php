<?php
	$archivo = $_REQUEST["archivo"];
	if(unlink('../'.$archivo))
		echo "Archivo Borrado";
	else
		echo "No se pudo Borrar, probablemente, algun otro software lo esta usando";
?>