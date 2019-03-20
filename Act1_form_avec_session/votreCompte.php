<?php
	session_start();

	echo "Cette adresse n'existe pas encore<br>";
	echo "l'adresse ".$_SESSION['adrMail']." est enregistrée";
?>