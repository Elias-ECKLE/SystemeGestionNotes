

<?php
  
  $nbChiffresPsswd=4; //le nb de chiffres max qu'on peut entrer
  $psswdEstConfirme=true;
  $loginEstValide=true;
  $etapeUneInscriptionValide=false;
  $etapeDeuxInscriptionValide =false;
  $etapeFinaleInscriptionValide=false;

  $loginEstExistant=false;





  //ON CHECK DANS UN PREMIER TPS SI TOUS LES IMPUTS SONT VALIDES ---------------------------------------------:

  //si on clique sur envoyer alors on vérifie si tous les inputs sont remplis
  if(isset($_POST["boutonSubmit"])){

      if(!empty($_POST['input_nom']) && !empty($_POST['input_prenom']) && !empty($_POST['input_login'])  && !empty($_POST['input_psswd']) &&
            !empty($_POST['input_confirmPsswd'] && !empty($_POST['input_profil'])) ){

          echo "<script> console.log('tous les inputs sont remplis')</script>";
          $nom=$_POST['input_nom'];
          $prenom=$_POST['input_prenom'];
          $login=$_POST['input_login'];
          $psswd=$_POST['input_psswd'];
          $psswdConfirm=$_POST['input_confirmPsswd'];
          $profil=$_POST['input_profil'];



        //ensuite on confirme s'il s'agit bien d'un mail entré  :
        if(filter_var($login, FILTER_VALIDATE_EMAIL)){
              $loginEstValide =true;
        }
        else{
             $login="";
             $loginEstValide=false;
        }


         //on vérifie que les psswd sont bien des entiers de 4 chiffres au max
        if(is_numeric($psswd) && is_numeric($psswdConfirm)){
             echo "<script>console.log('psswd est bien un élément numérique')</script>";

             if( (preg_match("/^\s*[0-9]+\s*$/", $psswd) && strlen($psswd)==$nbChiffresPsswd)     &&     (preg_match("/^\s*[0-9]+\s*$/", $psswdConfirm) && strlen($psswdConfirm)==$nbChiffresPsswd)){
                 echo "<script>console.log('psswd et psswdConfirm sont bien des entiers de quatre chiffres')</script>";
                

                 //on check si le psswd et le psswdConfirm sont bien les m^mes chiffres
                 if($psswd==$psswdConfirm){
                      echo "<script>console.log('le mot de passe est confirmé')</script>";
                        $etapeUneInscriptionValide=true;

                 }
                 else{
                  $psswd="";
                  $psswdConfirm="";
                  $psswdEstConfirme=false;
                 }
             }
             else{
                 $psswd="";
                 $psswdConfirm="";
                 $psswdEstConfirme=false;
             }

          }
          else{
               $psswd="";
               $psswdConfirm="";
                $psswdEstConfirme=false;
          }

      }

    }



    //UNE FOIS LES INFOS RENTRES ET VALIDES, ON SE CONNECTE A LA BDD ET ON REGARDE SI LE MAIL EXISTE DEJA OU PAS
    if($etapeUneInscriptionValide){

        //bdd connexion------------------------------------------------------------------------------------------------------------------------------------------------------!
        $servername = 'localhost';
        $username = 'root';
        $password = '';

        try{
            $conn = new PDO("mysql:host=$servername;dbname=systeme_notes_etudiants_Elias", $username, $password);
             //On définit le mode d'erreur de PDO sur Exception
             $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             // echo 'Connexion réussie';
             echo "<script> console.log('bdd connectee') </script>";

             //on récupère dans un tableau tous les emails des gens existants dans la bdd :
             $sth = $conn->prepare(" SELECT mail
                                    from login
                                                ");
             $sth->execute();
             $arrayMail= $sth->fetchAll();

             //puis on fusionne les deux tableaux pour faiciliter la comparaison du mail avec celui entré 
        }
        catch(PDOException $e){
          echo "Erreur : " . $e->getMessage();
        }


        //on check si le mail entré existe déjà dans la bdd ou non : 
        foreach ($arrayMail as $key => $value) {

          if($value['mail']==$login){
            $loginEstExistant=true;
          }
        }
        if(!$loginEstExistant){
          $etapeFinaleInscriptionValide =true;
        }
    }



    //UNE FOIS TOUTES LES ETAPES REUSSIES AVEC SUCCES, ON ENVOIE LES DONNEES VERS LA BDD ET ON VA A LA PAGE 2----------------------------------------------------------------
    if($etapeFinaleInscriptionValide){

        //on fait un premier insert into avec les informations qu'on a vers la table login : mail/profil/psswd
          
          $inject = $conn->prepare("INSERT INTO login 
                                    VALUES (:mail, :psswd, :profil)");
          $inject->execute(array(
              'mail' => $login,
              'psswd' => $psswd,
              'profil' => $profil
              ));
        


        //ensuite un deuxieme insert pour le :prenom/nom avec la table soit etudiant ou professeur

          if($profil=='etudiant'){
            //sauf que pour cela il me faut un code propre à l'étudiant ou le prof

              //pour cela je cherche la racine du code dans la bdd 
                  //import du dernier code etudiant en date
              $sth2= $conn->prepare("SELECT numEtudiant
                                     FROM etudiant
                                     order by numEtudiant desc
                                     limit 1");
              $sth2->execute();
              $arrayNumEtudiant=$sth2->fetchAll();
              $lastNumEtudiant=$arrayNumEtudiant[0]['numEtudiant'];

                //on incrémente le dernier primary key de la table dont on veut ajoyter une ligne:
              $newNumEtudiant=primaryKeyIncrmt($lastNumEtudiant);

              //enfin avec le numEtudiant incrémenté on a tous les éléments pour injecter dans la table
              $inject2 = $conn->prepare("INSERT INTO etudiant  
                                         VALUES ( :numEtudiant ,:nom, :prenom, :mail)");
              $inject2->execute(array(
                  'numEtudiant' => $newNumEtudiant,
                  'nom' => strtoupper($nom),
                  'prenom' => ucfirst($prenom),
                  'mail' => $login
                  
              ));
          }


          else if($profil=='professeur'){

                  //import du dernier code prof en date
              $sth2= $conn->prepare("SELECT numProf
                                     FROM professeur
                                     order by numProf desc
                                     limit 1");
              $sth2->execute();
              $arrayNumProf=$sth2->fetchAll();
              $lastNumProf=$arrayNumProf[0]['numProf'];

                //on incrémente le dernier primary key de la table dont on veut ajoyter une ligne:
              $newNumProf=primaryKeyIncrmt($lastNumProf);
            
               $inject2 = $conn->prepare("INSERT INTO professeur    
                                          VALUES ( :numProf ,:nom, :prenom, :mail)");
              $inject2->execute(array(
                  'numProf' => $newNumProf,
                  'nom' => strtoupper($nom),
                  'prenom' => ucfirst($prenom),
                  'mail' => $login
              ));
          }

          //pour terminer on stocke le mail dans une variable session et on va à la page 2
          $_SESSION['mailUtilisateur']=$login;  
          header("Location:page2.php");

    }







//FONCTIONS _________________________________________________________________________________________________________________________________________________________
function loginSynthaxErreur(){
  echo "<script>   mailErreur(document.getElementById('divAffichageErreurs'),document.getElementById('input_login'));   </script>";
}

function ConfirmPsswdErreur(){
  echo "<script>   psswdErreur(document.getElementById('divAffichageErreurs'),document.getElementById('input_psswd'),document.getElementById('input_confirmPsswd'));   </script>";
}
function  loginEtConfirmPsswdErreur(){
   echo "<script>   loginEtConfirmPsswdErreur(document.getElementById('divAffichageErreurs'),document.getElementById('input_login'), document.getElementById('input_psswd'),document.getElementById('input_confirmPsswd') );   </script>";
}
function loginExisteDeja(){
    echo "<script>   loginExisteDeja(document.getElementById('divAffichageErreurs'),document.getElementById('input_login'));   </script>";
}


function compteCree(){
  echo "<script>   compteCree(document.getElementById('divForm'),document.getElementById('divAffichageErreurs'));   </script>";
}


//etraire et incrémenter un à une primary key d'une table afin d'y rajouter une ligne
function primaryKeyIncrmt($lastNum){

    //on extrait les 4 premiers caractères du code pour en avoir la racine :
    $racineNum=substr($lastNum,0,4);
    $suffixeNum=substr($lastNum,-2);

    //on incremente le suffixe avec 1 :
    $incrmtSuffixeNum=$suffixeNum+1;

    //et on concatene les deux bouts pour obtenir le nouveau num
   //attention si inférieur à 10 il y a un zéro à mettre en plus; sinon simple concat
    if($incrmtSuffixeNum<10){
         $newNum=$racineNum.'0'.$incrmtSuffixeNum;
     }
    else{
         $newNum=$racineNum.$incrmtSuffixeNum;
    }

    return $newNum;

}

?>