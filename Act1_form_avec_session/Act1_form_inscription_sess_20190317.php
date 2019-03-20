<!DOCTYPE html>
<html>
	<head>
		<title>enregistrement2</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="Act1_form_inscription.css">

	</head>
	<body>

		<?php
			if(!isset($_SESSION['message'])){
				session_start();
			}
			echo $_SESSION['message'];
		?>

		<form class="formulaire" method="POST" action="Act1_controleur_sess_20190317.php">
			<fieldset>
				<legend><h1>S'enregistrer</h1></legend>
				<input type="text" name="nom" value ="<?php echo $_SESSION['nom'] ?>" onclick="javascript:this.select()" required>
				<div id="messageNom"></div>
				<input type="text" name="prenom" value ="<?php echo $_SESSION['prenom'] ?>" onclick="javascript:this.select()" required>
				<div id="messagePrenom"></div>
				<input type="text" name="fonction" value ="<?php echo $_SESSION['fonction'] ?>" onclick="javascript:this.select()" required>
				<div id="messageFonction"></div>
				<input type="email" name="adrMail" value ="<?php echo $_SESSION['adrMail'] ?>" onclick="javascript:this.select()" required>
				<div id="messageAdrMail"></div>
				<input type="date" name="dateNaiss" value ="<?php echo $_SESSION['dateNaiss'] ?>" onclick="javascript:this.select()" required>
				<div id="messageDateNaiss"></div>
				<input type="password" name="pwd" value ="<?php echo $_SESSION['pwd'] ?>" onclick="javascript:this.select()" required>
				<div id="messagePwd"></div>
				<input type="password" name="repeatPwd" value ="<?php echo $_SESSION['repeatPwd'] ?>" onclick="javascript:this.select()" required>
				<div id="messageRepeatPwd"></div>
				<div class="formulaire_Boutons">		
					<input type="submit" name="envoyer" value="Envoyer">
					<input type="reset" name="effacer" value="Effacer">
				</div>
			</fieldset>
		</form>
		<a href="">je possède déja un compte</a>

		<script src="Act1_form_inscription.js"></script>

	</body>
</html>