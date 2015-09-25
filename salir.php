<?php
	session_start();
	session_destroy();
	echo "<script>alert('Adios');window.open('index.php','_self')</script>";
?>