<?php

	session_start();
	require("Act1_modele_sess_20190317.php");
	
	if(isset($_POST['envoyer'])){
		extract($_POST);
		$_SESSION['message']="saisie validée";
		$_SESSION['nom']=$nom;
		$_SESSION['prenom']=$prenom;
		$_SESSION['fonction']=$fonction;
		$_SESSION['adrMail']=$adrMail;
		$_SESSION['dateNaiss']=$dateNaiss;
		$_SESSION['pwd']=$pwd;
		$_SESSION['repeatPwd']=$repeatPwd;
		
		$tableauVal=getForm();
		if($adrMail!='' && $adrMail!='adresse mail'){
			if(verifAdrMailBDD($pdo,$adrMail)){
				$_SESSION['message']="inscription validée";	
				inscription($pdo);
				header('location:votreCompte.php');
			}else{
				$_SESSION['message']="l'adresse existe déja";
				header('location:Act1_form_inscription_sess_20190317.php');
			}
		}else{
			$_SESSION['message']="saisissez une adresse";
			header('location:Act1_form_inscription_sess_20190317.php');
		}
	}else{
		$_SESSION['nom']="nom";
		$_SESSION['prenom']="prenom";
		$_SESSION['fonction']="fonction";
		$_SESSION['adrMail']="adresse";
		$_SESSION['dateNaiss']="jj/mm/aaaa";
		$_SESSION['pwd']="";
		$_SESSION['repeatPwd']="";
		$tableau=["","","","","","",""];
		$_SESSION['message']="";
		require("Act1_form_inscription_sess_20190317.php");
		//header('location:Act1_form_inscription_sess_20190317.php');
	}

?>
