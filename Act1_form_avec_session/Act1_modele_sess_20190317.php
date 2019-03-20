<?php
	
	const DB_HOST="localhost";
	const DB_USER="root";
	const DB_PWD="";
	const DB_BASENAME="NFA021_ACT1";

	$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
	try {
		$pdo = new PDO('mysql:host='.DB_HOST, DB_USER, DB_PWD,$options);
	}catch(PDOException $e){
    	$message="erreur de connexion";
	}
	
	$requete="USE ".DB_BASENAME;
	$resultRequete=$pdo->query($requete);

	function getForm():array{
		extract($_POST);
		$tableau =[$nom,$prenom,$fonction,$adrMail,$dateNaiss,$pwd,$repeatPwd];
		return $tableau;
	}

	function afficheSaisie($tableau){
		for($i=0;$i<count($tableau);$i++){
			echo $tableau[$i]."<br>";
		}
	}

	function formatDateForm(){
		$tabDate=explode("/",$_POST['dateNaiss']);
		return $tabDate[2]."-".$tabDate[1]."-".$tabDate[0];
	}

	function verifAdrMailBDD($pdo,$adresse):bool{
		$trouve=false;
		$message="non initialisé";
		try{
			$adresseQuote=$pdo->quote($adresse);
			echo $adresse."<br>";
			echo var_dump($pdo);
            $requete="SELECT USER_adresseMail FROM COMPTE_USER WHERE USER_adresseMail IN (".$adresseQuote.")";
            echo $requete."<br>";
            $resultRequete=$pdo->query($requete);   
        }catch (PDOException $e){
            $message="erreur de requête";
        }
        try{
            //recherche si le login saisi existe déja
            while(($res = $resultRequete->fetch()) && $trouve!=true){
        		$resultRequete->setFetchMode(PDO::FETCH_ASSOC);
                if($res['USER_adresseMail']===$adresse){
                    $trouve=true;
                    $message="l'adresse2  ".$res['USER_adresseMail']."  existe<br>";
                }else{
                    $trouve=false;
                    $message="OK, l'adresse2 ".$res['USER_adresseMail']."/".$adresse." n'existe pas<br>";
                }
            } 
        }catch (PDOException $e){
            $message="erreur retour de requête";
        }
        echo $message;
        return (!$trouve);
	}

	function inscription($pdo){
		//faire un extract en debut de script : extract ($_POST)
		$tabInfos=getForm();
		$nomQuote=$pdo->quote($tabInfos[0]);
		$prenomQuote=$pdo->quote($tabInfos[1]);
		$fonctionQuote=$pdo->quote($tabInfos[2]);
		$adrQuote=$pdo->quote($tabInfos[3]);
		$dtQuote=$pdo->quote(formatDateForm($tabInfos[4]));
		$pwdQuote=$pdo->quote(sha1($tabInfos[5]));

		$requete=<<<SQL
	        INSERT INTO COMPTE_USER (USER_nom, USER_prenom, USER_fonction,USER_adresseMail,USER_dateNaissance,USER_motDePasse) VALUES ($nomQuote,$prenomQuote,$fonctionQuote,$adrQuote,$dtQuote,$pwdQuote);
SQL;
		try{
			echo $requete;
			$pdo->prepare($requete)->execute();
		}catch(PDOException $e){
	        $message="erreur d'écriture";
	    }
	}

?>