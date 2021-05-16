
<?php 

//quand on clique sur bouton envoyer alors :->


	 if(isset($_POST["input_digitValider"])){

   $loginReussi=false;
  $psswReussi=false;
		//BDD CONNEXION------------------------------------------------------------------------------------------------------------------------------------------------------!
		$servername = 'localhost';
    $username = 'root';
    $password = '';


        try{
            $conn = new PDO("mysql:host=$servername;dbname=systeme_notes_etudiants2", $username, $password);
             //On définit le mode d'erreur de PDO sur Exception
             $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             // echo 'Connexion réussie';


              //on récupère les différents mails dans un tableau :
               $sth = $conn->prepare("
	       		 			SELECT mail
	       		 			FROM  login");
	      	   $sth->execute();
	             /*Retourne un tableau associatif pour chaque entrée de notre table
	              *avec le nom des colonnes sélectionnées en clefs*/
	            $mailsArray = $sth->fetchAll();


              //on récupère les différents psswd dans un tableau :
               $sth = $conn->prepare("
	       		 			SELECT psswd
	       		 			FROM  login");
	      	   $sth->execute();
	            $psswdArray = $sth->fetchAll(PDO::FETCH_ASSOC);
	            
        	}


      	catch(PDOException $e){
       		echo "Erreur : " . $e->getMessage();
       	}




		//ON COMPARE LES INFOS, mot de passe et login et on précise si ce sont les mêmes ou non-----------------------------------------------------------------------------------------------------------------------------------------------       	
       	if( (!empty($_POST["input_login"])) && (!empty("input_MDP"))){


       		$loginEntree=$_POST["input_login"];
       		$psswdEntree=$_POST["input_MDP"];
       		$indexRetenu=0;
       		$i=0;


       		//on parcourt le tableau des mails, on vérifie si le mail entré est le même et si ouion stocke la position dans le tableau
       		foreach ($mailsArray as $key => $value) {
       			if($value[0]==$loginEntree){

       				$loginReussi=true;
       				echo "<script> console.log('mail valide') </script>";
       				$indexRetenu=$i;
       				break;
       			}
       			$i++;
       		}

       		//on récupère la position pour voir si le mot de passe à cet emplacmeent correspond au mail entré
       		if($psswdArray[$indexRetenu]['psswd']==$psswdEntree){

       				echo "<script> console.log('psswd valide') </script>";
       				$psswReussi=true;
       		}



       		// REDIRECTION VERS LA PAGE 2 -> si authentification réussie : login et psswd ------------------------------------------------------------------------------------------------
       		if($loginReussi && $psswReussi){

       			$_SESSION['mailUtilisateur']=$loginEntree;	
       			header("Location:page2.php");
       		}




       		//SI ERREURS  on vide les infos et on affiche des messages d'erreurs (voir index.php) --------------------------------------------------------------------------------------------------------------------------------------------------:
       		if(!$loginReussi){
       			$loginEntree="";

       		}
       		if( $loginEntree && !$psswReussi){
       			$psswdEntree="";
   
       		}
       		if( !$loginEntree && !$psswReussi){
       			$loginEntree="";
			     	$psswdEntree="";
		
       		}


       	}

}





//DIFFRENTES FONCTIONS PHP DE LA PAGE index.php--_____________________________________________________________________________________________________________________________________

function erreurLogin(){
    $loginEntree="";
    echo "<script>
             erreurLogin(document.getElementById('divAffichageErreurs'),document.getElementById('input_login'));
          </script>";

}

function erreurMDP(){
     $psswdEntree="";
     echo "<script>
               erreurMDP(document.getElementById('divAffichageErreurs'),document.getElementById('input_MDP'));
          </script>";
}

function erreurLogin_MDP(){
     $loginEntree="";
     $psswdEntree="";
     echo "<script>
                erreurLogin_MDP(document.getElementById('divAffichageErreurs'),document.getElementById('input_login'),document.getElementById('input_MDP'));
          </script>";
}







?>
​



 