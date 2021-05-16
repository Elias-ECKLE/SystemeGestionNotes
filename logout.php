


<?php

	session_start();
?>




<!DOCTYPE html>
<html>
<head>
	<title>Code Digit</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/headerFooter.css">
	<link rel="stylesheet" type="text/css" href="css/logout.css">

	<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="js/headerFooter.js"></script>
	<script type="text/javascript" src="js/logout.js"></script>
</head>



<body onload="digitAleatoire(nbDivLigne,nbDivColonne,min, max), onloadInitVars()">
	

	<?php
		include"headerFooter/header.php";
		include "php/DestructionSessionCode.php";


		if($profil=='etudiant'){
			stylePageEleve();

		}
		if($profil=='professeur'){
			stylePageProf();
		}


	?>



	<section id=sectionLogOut>
		<form method="GET" action="#">
			<input type="hidden" name="passageBoutonDeconnection" id="passageBoutonDeconnection" value="">
			<div id="divBoutonSubmit"><input type="submit"  value="Se déconnecter" name="validerDeconnection" id="validerDeconnection"></div>
		</form>

	</section>







	<?php
		include"headerFooter/footer.php";
	?>
















</body>
</html>