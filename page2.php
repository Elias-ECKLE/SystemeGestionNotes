<?php 
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Page de session</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/notes.css">
		<link rel="stylesheet" type="text/css" href="css/headerFooter.css">

	<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="js/headerFooter.js"></script>
	<script type="text/javascript" src="js/notes.js"></script>
</head>




<body>
	


	<?php
		include 'headerFooter/header.php';
		include 'php/notesCode.php';
	?>



	 
	<section>
		<div id="MessageBienvenueDiv">

			<?php
				if( (isset($_SESSION["mailUtilisateur"]))){

					//on AFFICHE UN MESSAGE DE BIENVENUE à l'utilisateur -------------------------------------------------------------------------:
					if($estProfilProfesseur || $estProfilEtudiant){
						$messageBienvenue= "Bonjour ".$nomPrenomUtilisateur[0]['prenom']." ".$nomPrenomUtilisateur[0]['nom'];
						echo "<br/>";
						echo "<br/>";
						echo  "<center>".$messageBienvenue."</center>";
			
					}
				}
					?>
		</div>


		<div id="tableau">
			<?php
					// APPLICATION DU STYLE+ CONTENU PAGE en fct du profil -------------------------------------------------------------------------------------------------------
					if($estProfilEtudiant){

						stylePageEleve();//backgroundColo
						?>

						<!-- On affiche une image du personnage -->
						<div id="divAvatarEtudiant">	
							<?php echo "<img src='images/avatarsEtudiants/avatar_".$prefixeMailEtudiant."' alt='avatar :".$nomPrenomUtilisateur[0]['prenom']."_".$nomPrenomUtilisateur[0]['nom']."'"?>
						</div>
					</div>

									<!--on construit le tableau dynamique :-->
						<div id='tableauNotes'>	
							<?php if($nbNotesEtudiant>0){ ?>
										<div id="ligneEntete" class="ligne">	
											<div class='colonne' id="cellule1">Matière : </div>
											<div class='colonne' id="cellule2">Notes : </div>
											<div class='colonne' id="cellule3">Moyenne : </div>
										</div>
										<?php
											for($i=0;$i<$nbMatieres;$i++){

												$nbLigne=$i+1;
												echo "<div class='ligne' id=ligne".$nbLigne." >";
													echo"<div class='colonne' id=cellule1>".$arrayIntitulesMatiere[$i]['matiere'].": </div>";
													echo"<div class='colonne' id=cellule2>";
														foreach ($arrayNotesEtudiant as $key => $value) {
															
															if($arrayIntitulesMatiere[$i]['matiere']==$value['matiere']){
																echo $value['sujetNote']." : ".$value['note'];
																echo "<br/>";
															}
														}

													echo"</div>";
													echo"<div class='colonne' id=cellule3>";

														foreach ($arrayNotesMoyenne as $key => $value) {
															
															if($arrayIntitulesMatiere[$i]['matiere']==$value['matiere']){
																echo $value['moyenneNotes'];
																echo "<br/>";
															}
														}
													"</div>";
												echo "</div>";
												echo "</div>";
											}
										?>
										<div class='ligne' id="ligneBasDePage">
											<div class='colonne' id="cellule1"></div>
											<div class='colonne' id="cellule2">Moyenne générale</div>
											<div class='colonne' id="cellule3"> <b><?php echo $moyenneGenerale;?></b></div>
											
										</div>
							 <?php 
								}
								else{

								echo "Vous n'avez aucunes notes pour le moment. Vous venez sûrement de créer votre compte. <br/>";
								echo "Veuillez revenir plus tard";
								}

							  ?>

							</div>
					

					<?php
							
					}

					if($estProfilProfesseur){

						stylePageProf();?>
						<?php

							for($i=0;$i<$lastSuffixeNum;$i++){

								$incrmtSuffixeNum=$i+1;
									
				    			if($incrmtSuffixeNum<10){
				        			$newNum=$racineNum.'0'.$incrmtSuffixeNum;
				     			}
				    			else{
				        			 $newNum=$racineNum.$incrmtSuffixeNum;
				   				}

				   				//nom et prénom de chaque étudiant :
				   			     $sth2 = $conn->prepare(" SELECT nom, prenom
														  from etudiant
														  where etudiant.numEtudiant= :numEtudiant");
	           	  				 $sth2->bindValue('numEtudiant', $newNum);
	      	  	  				 $sth2->execute();
	           					 $nomPrenomUtilisateur= $sth2->fetchAll();

				   				//requete  des notes de chaque étudiant :
				   				 $sth3 = $conn->prepare("SELECT matiere.libelleMatiere as matiere, note.sujetNote as sujetNote, note.valeurNote as note, note.coeffNote as coeffNote
															from matiere, note, etudiant
															where matiere.numMatiere=note.numMatiere
															and etudiant.numEtudiant=note.numEtudiant
															and etudiant.numEtudiant= :numEtudiant"
															);
					           	 $sth3->bindValue('numEtudiant', $newNum);
					      	  	 $sth3->execute();
					           	 $arrayNotesEtudiant= $sth3->fetchAll();
					           	   		 
					           	   		 
				   				//requete des moyennes 
				   				$sth4=$conn->prepare("SELECT matiere.libelleMatiere as matiere,avg(note.valeurNote)as moyenneNotes
														from etudiant,note, matiere
														where note.numEtudiant=etudiant.numEtudiant
														and note.numMatiere=matiere.numMatiere
														and etudiant.numEtudiant= :numEtudiant
														group by matiere.libelleMatiere");
					           	$sth4->bindValue('numEtudiant', $newNum);
					            $sth4->execute();
					           	$arrayNotesMoyenne=$sth4->fetchAll();

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
					         
					    
		
					

							?>
									<div id='tableauNotesProf'>	

										<div id="ligneNomPrenom">
											<?php 
												echo "<b>".$nomPrenomUtilisateur[0]['prenom']." ".$nomPrenomUtilisateur[0]['nom']."</b>";
											?>
										</div>
										<div id="ligneEntete" class="ligne">	
											<div class='colonne' id="cellule1">Matière : </div>
											<div class='colonne' id="cellule2">Notes : </div>
											<div class='colonne' id="cellule3">Moyenne : </div>
										</div>
										<?php
											for($j=0;$j<$nbMatieres;$j++){

												$nbLigne=$i+1;
												echo "<div class='ligne' id=ligne".$nbLigne." >";
													echo"<div class='colonne' id=cellule1>".$arrayIntitulesMatiere[$j]['matiere'].": </div>";
													echo"<div class='colonne' id=cellule2>";
														foreach ($arrayNotesEtudiant as $key => $value) {
															
															if($arrayIntitulesMatiere[$j]['matiere']==$value['matiere']){
																echo $value['sujetNote']." : ".$value['note'];
																echo "<br/>";
															}
														}

													echo"</div>";
													echo"<div class='colonne' id=cellule3>";

														foreach ($arrayNotesMoyenne as $key => $value) {
															
															if($arrayIntitulesMatiere[$j]['matiere']==$value['matiere']){
																echo round($value['moyenneNotes'],1);
																echo "<br/>";
															}
														}
													"</div>";
												echo "</div>";
												echo "</div>";
											}
										?>
										<div class='ligne' id="ligneBasDePage">
											<div class='colonne' id="cellule1"></div>
											<div class='colonne' id="cellule2">Moyenne générale</div>
											<div class='colonne' id="cellule3"> <b><?php echo $moyenneGenerale;?></b></div>
											
										</div>

							</div>

					
					<?php
						}

					}



				


			?>


		</div>
	</section>


<?php
		if($estProfilProfesseur){
?>
	<section>
		<div id="divFormAjoutNotes">
			<form method="POST" action=#>
				<fieldset>
					<legend>Ajouter une note à un étudiant :</legend>

					<select id="selectMail" name="selectMail" required>
						<?php
							for($i=0;$i<$lastSuffixeNum;$i++){
								echo "<option  selected value=".$arrayMailsEtudiants[$i]['mail'].">".$arrayMailsEtudiants[$i]['mail']."</option>";
							}
						?>
					</select>
					<select id="selectMatiere" name="selectMatiere">
						<?php
							for($i=0;$i<$nbMatieres;$i++){
								echo "<option selected value=".$arrayIntitulesMatiere[$i]['matiere'].">".$arrayIntitulesMatiere[$i]['matiere']."</option>";
							}
						?>
					</select>
					<input type="text" name="inputSujetNote" id="inputSujetNote"  placeholder="Saisir le motif de la note" size=25 required>
					<input type="number" name="inputValeurNote" id="inputValeurNote"  placeholder="Saisir la valeur de la note" size=25 required  min=0 max=20>
					<br/>
					<center><input type="submit" id="boutonSubmit_AjoutNotes" name="boutonSubmit_AjoutNotes"></center>
				</fieldset>
			</form>
		</div>	
	</section>

	<?php
	}
	?>
















		<section id="sectionDeco">
			<div id="lienDeco">
				<a href="logout.php">Aller sur la page de déconnection </a>
			</div>
		</section>





	<?php
		include 'headerFooter/footer.php';
	?>






</body>
</html>

