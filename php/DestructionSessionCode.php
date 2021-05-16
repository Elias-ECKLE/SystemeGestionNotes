
<?php 


	
	if( (isset($_SESSION["profil"]))){

		$profil=$_SESSION['profil'];


	}



	if(isset($_GET["validerDeconnection"])){

	//destruction de la session et redirection vers la page login.php
			unset($_SESSION);
			session_destroy();
			header("Location:index.php");

		

	}




//FUNCTION_____________________________________________________________________________________________________________________________________________________________________
	function stylePageEleve(){

		echo "<script>
					styleEleveConnecte();
				</script>";

	}

	function stylePageProf(){
		echo "<script>
					styleProfConnecte();
			</script>";
	}


?>
​



 