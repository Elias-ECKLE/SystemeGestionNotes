


<?php 

		session_start();

 ?>



<!DOCTYPE html>
<html>
<head>
	<title>Inscription</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/headerFooter.css">
	<link rel="stylesheet" type="text/css" href="css/inscription.css">

	<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="js/headerFooter.js"></script>
	<script type="text/javascript" src="js/inscription.js"></script>
</head>



<body>
	<?php

		include"headerFooter/header.php";
		include "php/inscriptionCode.php";

	?>

 

	<section id="section_FormInscription" name="section_FormInscription">


		 
    	<form method='POST' action='#'>
    		<fieldset>
				<div id="divForm">	
					<label for="input_nom"> Nom :</label>
					<br/>
					<input class="inputTaillePleine" placeholder="Nom" type="text" name="input_nom" id="input_nom" size=25 onchange="majInputLoginHidden(this.id)" 
							value="<?php if(isset($nom)){echo $nom;}?>" required>
					</input>
					<br/>
					<label for="input_prenom"> Prénom :</label>
					<br/>
					<input class="inputTaillePleine" placeholder="Prenom "name="input_prenom" id="input_prenom" size=25 
							value="<?php if(isset($prenom)){echo $prenom;}?>"  onkeypress="" required>
					</input>	
					<br/>
					<label for="input_login"> Mail :</label>
					<br/>
					<input class="inputTaillePleine" placeholder="Mail" type="text" name="input_login" id="input_login" required
							value="<?php if(isset($login)){echo $login;}?>" >
					<br/>
					<label for="input_psswd"> Mot de passe :</label>
					<br/>
					<input class="inputTaillePleine" placeholder="Mot de passe à 4 chiffres" type="number" name="input_psswd" id="input_psswd" 
							value="<?php if(isset($psswd)){echo $psswd;}?>" required>
					<label for="input_confirmPsswd"> Confirmer le mot de passe :</label>
					<br/>
					<input class="inputTaillePleine" placeholder="Confirmer le mot de passe " type="number" name="input_confirmPsswd" id="input_confirmPsswd" 
							value="<?php if(isset($psswdConfirm)){echo $psswdConfirm;}?>" required>
					<br/>
					<br/>
					<div id="divLabel_profil" >
						<label for="input_profil"> Profil à choisir :</label>
					</div>
					<div id="divInput_profil">
						<select  name="input_profil" id="input_profil"  value="<?php if(isset($_POST['input_profil'])){echo $_POST['input_profil'];}?>" required>
							<option value="etudiant">étudiant</option>
							<option value="professeur">professeur</option>
						</select>
					</div>
					 <div id="divSubmit">
			 		   	<input type="submit" name="boutonSubmit" id="boutonSubmit">
			 		 </div>
				</div>

				<div id="divAffichageErreurs">
					<?php

		  				if(isset($_POST["boutonSubmit"])){
						//php pour mail non valide :
		  					if((!$psswdEstConfirme) && (!$loginEstValide)){
								loginEtConfirmPsswdErreur();
							}
							else if(!$loginEstValide){
								loginSynthaxErreur();
							}

						//on ouvre du php pour executer le js qui indique à l'utilisateur qu'il y a un erreur dans les mots de passe entrés :
							else if(!$psswdEstConfirme){
								ConfirmPsswdErreur();
							}
				
		 				 }

		 				if($loginEstValide){
		 				 	if($loginEstExistant){
		 				 			loginExisteDeja();

		 				 	}
		 			    }


					?>
				</div>
		</fieldset>
	</form>



	</section>

	






	<?php

		include"headerFooter/footer.php";

	?>



	


	

</body>
</html>