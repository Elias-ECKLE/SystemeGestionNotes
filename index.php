<!--
Au moins 2 étudiants peuvent se connecter pour afficher ses notes 

+prof ensemble avec input pour ajouter une nouvelle ligne 


Or il faut stocker ces nouvelles donnes 

On peut utiliser alors ce qu’on appelle la Persistence des donnés : fichiers textes ou xml (on peut le faire en js ou en html) mais pas très propre alors on va plutôt choisir la solution de la bdd


Cette nouvelle note va être stockée dans une table. C’est une autre forme de persistance des données 



La situation : 


    page d’accueil : on doit ajouter un formulaire qui permet de s’enregistrer : créer un compte ou de se connecter. On doit vérifier que cet utilisateur n’existe pas déjà en base : mail/passw1/passw2 numérique. Si titi existe déjà il faut le dire sinon proposer de créer un compte. Quand il va se créer il va falloir préciser s’il est étudiant ou professeur ( on récupère les login, password en bdd, profil) 


    On arrive à la page 2, on affiche les notes de l’étudiant si profil=étudiant
    En tant que profil=prof, on accède à tous les notes des étudiants triés et en dessous on a un formulaire qui permet d’ajouter une note à un étudiant. On va partir du principe que le prof ne crée pas d’étudiant mais n’ajoute que des notes. Comme il ajoute des notes, le plus simple c’est qu’il y a un champ déroulant des étudiants, champ déroulant des matières et enfin un champ vide ou on peut entrer une note entre 0 et 20 compris 
    Une fois soumis, on fait un insert into

-->




<?php session_start();require "php/loginCode.php";?>



<!DOCTYPE html>
<html>
<head>
	<title>Login Notes</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/headerFooter.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">

	<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="js/headerFooter.js"></script>
	<script type="text/javascript" src="js/login.js"></script>
</head>



<body onload="digitAleatoire(nbDivLigne,nbDivColonne,min, max), onloadInitVars()">

	<?php
		include"headerFooter/header.php";

	?>
 

	<section id="section_Digit" name="section_Digit">
		 <script>
    		document.write("<form method='POST' action='#'>");
    	</script>

		<article id="article_ChpLoginMDP">
			<input placeholder="Entrez votre login " type="text" name="input_login" id="input_login" size=25 onchange="majInputLoginHidden(this.id)" value="<?php if(isset($loginEntree)){echo $loginEntree;}?>" required>
			</input>
			<input placeholder="Entrez votre mot de passe "name="input_MDP" id="input_MDP" size=25 value="<?php if(isset($MDPEntree)){echo $MDPEntree;}?>"  onkeypress="" required>
			</input>	
			<input type="hidden" name="passageLoginEleve" value="" id="passageLoginEleve"></input>
			<input type="hidden" name="passageMDPEleve" value="" id="passageMDPEleve"></input>
			<input type="hidden" name="passageLoginProf" value="" id="passageLoginProf"></input>
			<input type="hidden" name="passageMDPProf" value="" id="passageMDPProf"></input>
			<script type="text/javascript">


			</script>
		</article>


		<article id="article_GrilleDigit">
			<script type="text/javascript">


				var k=0;

				for(i=0;i<nbDivLigne;i++){

					iTemp=i+1;
					document.write("<div id=div_ColonneDigit"+iTemp+">");
					for(j=0;j<nbDivColonne;j++){
						jTemp=j+1;
						document.write("<input type='button' onclick='majLoginMDP(this.id);' value='100' id='input_digit"+k+"' name=input_digit"+k+" ></input>");
						k++;
					}
	

					document.write("</div>");
				}
				document.write(
					" <div id=div_ColonneDigitDerniere> <input id='input_digitAnnuler' type='button' name='input_digitAnnuler' value='annuler' onclick=resetEntrees_Annuler('input_login','input_MDP')></input> <input id='input_digit9' type='button' onclick='majLoginMDP(this.id)' name='input_digit0' value='0'></input><input id=input_digitValider name='input_digitValider' type='submit'></input></div>");
			</script>
	
		</article>

		 <script>
    		document.write("</form>");
    	</script>




		<div id="divInscription">
			<a href="inscription.php">S'inscrire</a>
		</div>







    	<div id="divAffichageErreurs">
    		
    			<?php
	    			if(isset($_POST["input_digitValider"])){
							//si le mail est faux message d'erreur :
       					if(!$loginReussi){
       							erreurLogin();
       					}
       					if( $loginEntree && !$psswReussi){
 								erreurMDP();
       					}
       					if( !$loginEntree && !$psswReussi){
       							erreurLogin_MDP();
       					}
       		
					}
				?>
				
    	
    	</div>


	</section>










	<?php
		include("headerFooter/footer.php");

	?>



</body>
</html>