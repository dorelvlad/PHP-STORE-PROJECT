<?php
	session_start(); 
	session_destroy(); //distrug sesiunea
	$_SESSION['logat'] = 0; //setez variabila de sesiune, in care tinem pt valoarea 1 faptul ca sunt logat, la valoarea 0
	header("location:index.php"); //redirect catre formularul de login
?>