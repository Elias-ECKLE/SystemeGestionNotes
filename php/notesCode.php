
<?php 

	

	if( (isset($_SESSION["mailUtilisateur"]))){

		$mailUtilisateur=$_SESSION["mailUtilisateur"];
		$estProfilEtudiant=false;
		$estProfilProfesseur=false;





		//on appelle la BDD : CONNEXION et on récupère toutes les infos nécessaires aved des requetes------------------------------------------------------------------------------------------
		$servername = 'localhost';
        $username = 'root';
        $password = '';


		 try{
               $conn = new PDO("mysql:host=$servername;dbname=systeme_notes_etudiants2", $username, $password);
                //On définit le mode d'erreur de PDO sur Exception
               $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               // echo 'Connexion réussie';


              //on récupère le profil de l'utilisateur
               $sth = $conn->prepare(" SELECT profil
										from login
										where mail= :mailUtilisateur");
               $sth->bindValue('mailUtilisateur', $mailUtilisateur);
	      	   $sth->execute();
	             /*Retourne un tableau associatif pour chaque entrée de notre table
	              *avec le nom des colonnes sélectionnées en clefs*/
	           $profilUtilisateur= $sth->fetch();
	            //on récupère le mot en question qu'on veut
	           $profil=$profilUtilisateur[0];
	           $_SESSION['profil']=$profil;



	           //on récupère le nb de matières présentes
	           $sth= $conn->query("SELECT DISTINCT matiere.libelleMatiere as matiere
							 from matiere");
	           $sth->execute();
	           $nbMatieres=$sth->rowCount();
	           //on récupère les intitulés de chaque matiere 
	           $arrayIntitulesMatiere=$sth->fetchAll();


	    }
        

      	catch(PDOException $e){
       		echo "Erreur : " . $e->getMessage();
       	}

  	










       	//EN FONCTION DU PROFIL ON RECUPERE DES INFOS DIFFERENTES---------------------------------------------------------------------------------------------------------
	    if($profil=='etudiant'){	//si le prodil est étudiant alors on va cherche des infos dans la table etudiante...
	         //on récupère le nom et le prénom
	        $sth2 = $conn->prepare(" SELECT nom, prenom
									 from etudiant
									 where mail= :mailUtilisateur");
	        $sth2->bindValue('mailUtilisateur', $mailUtilisateur);
	      	$sth2->execute();
	        $nomPrenomUtilisateur= $sth2->fetchAll();
	        $estProfilEtudiant=true;



	         //on récupère le prefixe du mail pour obtenir un nom servant à chercher un avatar :
	         $prefixeMailEtudiant=stristr($mailUtilisateur,'@',true);

	         //on récupère les notes de l'étudiant en question 
	         $sth3 = $conn->prepare("SELECT matiere.libelleMatiere as matiere, note.sujetNote as sujetNote, note.valeurNote as note, note.coeffNote as coeffNote
											from matiere, note, etudiant
											where matiere.numMatiere=note.numMatiere
											and etudiant.numEtudiant=note.numEtudiant
											and etudiant.mail= :mailUtilisateur"
											);
	         $sth3->bindValue('mailUtilisateur', $mailUtilisateur);
	      	 $sth3->execute();
	         $arrayNotesEtudiant= $sth3->fetchAll();



	         //on récupère les moyennes de chaque matière de l'étudiant :
	         $sth4=$conn->prepare("SELECT matiere.libelleMatiere as matiere,avg(note.valeurNote)as moyenneNotes
										from etudiant,note, matiere
										where note.numEtudiant=etudiant.numEtudiant
										and note.numMatiere=matiere.numMatiere
										and etudiant.mail= :mailUtilisateur
										group by matiere.libelleMatiere");
	         $sth4->bindValue('mailUtilisateur', $mailUtilisateur);
	         $sth4->execute();
	         $arrayNotesMoyenne=$sth4->fetchAll();
	           	 	

	         //on rcupère le nb de notes de l'étudiant pour vérifier s'il en a :
	         $sth5=$conn->prepare("SELECT count(note.valeurNote) as nbLignesNotes
										from etudiant,note, matiere
										where note.numEtudiant=etudiant.numEtudiant
										and note.numMatiere=matiere.numMatiere
										and etudiant.mail= :mailUtilisateur
										");
	         $sth5->bindValue('mailUtilisateur', $mailUtilisateur);
	         $sth5->execute();
	         $arrayNbNotes=$sth5->fetchAll();
	         $nbNotesEtudiant=$arrayNbNotes[0]['nbLignesNotes'];

	           	 	
			//moyenne finale
			$nbMatieresActives=0;
			$sommeMoyennes=0;
			foreach ($arrayNotesMoyenne as $key => $value) {

				 	$sommeMoyennes=$value['moyenneNotes']+$sommeMoyennes;

					if($sommeMoyennes>=$value['moyenneNotes']){
						$nbMatieresActives++;
					}
					  
			}
			if($nbMatieresActives>0){
					$moyenneGenerale=$sommeMoyennes/$nbMatieresActives;
			}
			else{
					$moyenneGenerale=0;
			 }

		}





	           if($profil=='professeur'){ // si professeur, on pioche dans professeur

	           	   $sth2 = $conn->prepare(" SELECT nom, prenom
											from professeur
											where mail= :mailUtilisateur");
	           	   $sth2->bindValue('mailUtilisateur', $mailUtilisateur);
	      	  	   $sth2->execute();
	           	   $nomPrenomUtilisateur= $sth2->fetchAll();
	           	   $estProfilProfesseur=true;



	           	   //on va chercher les notes et inofs de chaque etudiant et les mettre dans un tableau afn de les afficher les uns à la suite dans la page

	           	   		//pour cela il me faut alors d'abord la clé primaire de chaque étudiant et le nb d'étudiants présent
	           	    $sth3= $conn->prepare("SELECT numEtudiant
                                     FROM etudiant
                                     order by numEtudiant desc
                                     limit 1");
            		$sth3->execute();
              		$arrayNumEtudiant=$sth3->fetchAll();
             		 $lastNumEtudiant=$arrayNumEtudiant[0]['numEtudiant'];

   						//on sépare la racine du nb :
             		 $racineNum=substr($lastNumEtudiant,0,4);
    				 $lastSuffixeNum=substr($lastNumEtudiant,-2);
    				 $incrmtSuffixeNum=0;

    				 //reste du code dans la page2.php

    			








    			//FORMULAIRE D4AJOUT DE NOTES -------------------------------------------------------------------------------------------------------------------------------
    				 //on cherche la liste des étudiants par leur mail :


    				$sth4= $conn->prepare("SELECT mail as mail
										  from etudiant");
            		$sth4->execute();
              		$arrayMailsEtudiants=$sth4->fetchAll();


              		//ON VERIFIE SI LE FOMR EST ENVOYE ET BIEN REMPLI :------------------------------------------------------------------------------
              		if(isset($_POST['boutonSubmit_AjoutNotes'])){


              			if(!empty($_POST['selectMail']) && !empty($_POST['selectMatiere']) && !empty($_POST['inputSujetNote']) && !empty($_POST['inputValeurNote']) ){
              						echo "<script> console.log('test')</script>";
              				if(is_numeric($_POST['inputValeurNote'])){

              					$sujetNoteEstExistant=false;
              					//on remplace les posts par des variables :
              					$intituleMatiereSelected=$_POST['selectMatiere'];
              					$mailEtudiantSelected=$_POST['selectMail'];
              					$sujetNote=$_POST['inputSujetNote'];
              					$valeurNote=$_POST['inputValeurNote'];


              					//dans un premier tps on check si le sujetNote existe déjà pas :
              					$sth5= $conn->prepare("SELECT sujetNote
													  from note, etudiant, matiere
													  where etudiant.numEtudiant=note.numEtudiant
													  and matiere.numMatiere=note.numMatiere
													  and etudiant.mail= :mail
													  and matiere.libelleMatiere= :intituleMatiere");

              					$sth5->bindValue('mail', $mailEtudiantSelected);
              					$sth5->bindValue('intituleMatiere', $intituleMatiereSelected);
            					$sth5->execute();
              					$arraySujetsNotesExistantsEtudiant=$sth5->fetchAll();
              		

              					//on compare le sujetnote entré avec ceux existants:
              					foreach ($arraySujetsNotesExistantsEtudiant as $key => $value) {
              						
              						if($value['sujetNote']==$sujetNote){ //si le meme motif existe déjàn alors on ne peut pas ajouter une note :
              							$sujetNoteEstExistant=true;
              						}
              					}



              					if(!$sujetNoteEstExistant){

	              					//on cherche le code matiere correspondant à l'intitulé :		
	    							$sth6= $conn->prepare("SELECT numMatiere 
											 			   from matiere
											 			   where matiere.libelleMatiere= :intituleMatiere");
	    							$sth6->bindValue('intituleMatiere', $intituleMatiereSelected);
	            					$sth6->execute();
	              					$arrayNumMatiere=$sth6->fetchAll();
	              					$numMatiere=$arrayNumMatiere[0]['numMatiere'];

	              					var_dump($numMatiere);
	              					

	              					//on cherche le code etudiant correspondant à l'adresse mail :
	              					$sth7= $conn->prepare("SELECT numEtudiant
											 			   from etudiant
											 			   where etudiant.mail= :mail");
	    							$sth7->bindValue('mail', $mailEtudiantSelected);
	            					$sth7->execute();
	              					$arrayNumEtudiant=$sth7->fetchAll();
	              					$numEtudiant=$arrayNumEtudiant[0]['numEtudiant'];
	              					var_dump($numEtudiant);


	              					//on cherche le code de la dernière note pour l'incrémenter
	              					 $sth8= $conn->prepare("SELECT idNote
														    from note
														    group by idNote DESC
															limit 1");
            						 $sth8->execute();
              						 $arrayNumNote=$sth8->fetchAll();
             						 $lastNumNote=$arrayNumNote[0]['idNote'];
               							 //on incrémente le dernier primary key de la table dont on veut ajoyter une ligne:
             						 $newNumNote=primaryKeyIncrmt($lastNumNote);



	              					//on envoie les données vers la bdd :
	              					$inject = $conn->prepare("INSERT INTO note
 															  VALUES (:idNote, :sujetNote, :valeurNote, 1, :numEtudiant, :numMatiere)");
        							  $inject->execute(array(
             					 			'idNote' => $newNumNote,
              								'sujetNote' => $sujetNote,
              							    'valeurNote' => $valeurNote,
              							    'numEtudiant' => $numEtudiant,
              							    'numMatiere' => $numMatiere
             							 ));
        

	              				}



              				}
         

              			}

              		}




    			}







































}




	//FONCTIONS________________________________________________________________________________________________________________________________________________________________
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

function primaryKeyIncrmt($lastNum){

    //on extrait les 4 premiers caractères du code pour en avoir la racine :
    $racineNum=substr($lastNum,0,3);
    $suffixeNum=substr($lastNum,-2);


    //on incremente le suffixe avec 1 :
    $incrmtSuffixeNum=$suffixeNum+1;

    //et on concatene les deux bouts pour obtenir le nouveau num
   //attention si inférieur à 10 il y a un zéro à mettre en plus; sinon simple concat
         $newNum=$racineNum.$incrmtSuffixeNum;
    

    return $newNum;

}



?>
​



 