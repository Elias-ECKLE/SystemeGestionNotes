

//modification style et affichage d'un message si le mot de passe n'est pas confirmé ou ne respecte pas les critères nécessaires
function psswdErreur(objetDivErreurs,objetPsswd, objetPsswdConfirm){

	objetDivErreurs.innerHTML="mot de passe non valide ou mal confirmé";
	objetDivErreurs.style.color="red";
	objetDivErreurs.style.borderStyle="solid";
	objetDivErreurs.style.borderWidth="1px";
	objetDivErreurs.style.borderColor="red";
	objetDivErreurs.style.backgroundColor="#FFB6C1";


	objetPsswd.style.borderColor="red";
	objetPsswd.style.backgroundColor="#FFB6C1";

	objetPsswdConfirm.style.borderColor="red";
	objetPsswdConfirm.style.backgroundColor="#FFB6C1";

}


//modification style et afficgae message erreu mail non valide
function mailErreur(objetDivErreurs,objetLogin){

	objetDivErreurs.innerHTML="Le mail entré n'est pas valide";
	objetDivErreurs.style.color="red";
	objetDivErreurs.style.borderStyle="solid";
	objetDivErreurs.style.borderWidth="1px";
	objetDivErreurs.style.borderColor="red";
	objetDivErreurs.style.backgroundColor="#FFB6C1";


	objetLogin.style.borderColor="red";
	objetLogin.style.backgroundColor="#FFB6C1";

}


//modification style et affichage rreur à la fois mot de passe et login
function loginEtConfirmPsswdErreur(objetDivErreurs,objetLogin,objetPsswd, objetPsswdConfirm){
	objetDivErreurs.innerHTML="Le mail et le mot de passe présentent des erreurs";
	objetDivErreurs.style.color="red";
	objetDivErreurs.style.borderStyle="solid";
	objetDivErreurs.style.borderWidth="1px";
	objetDivErreurs.style.borderColor="red";
	objetDivErreurs.style.backgroundColor="#FFB6C1";

	objetLogin.style.borderColor="red";
	objetLogin.style.backgroundColor="#FFB6C1";

	objetPsswd.style.borderColor="red";
	objetPsswd.style.backgroundColor="#FFB6C1";

	objetPsswdConfirm.style.borderColor="red";
	objetPsswdConfirm.style.backgroundColor="#FFB6C1";

}


//modification style et affchugae erreur login exitse déjà dans la bdd
function loginExisteDeja(objetDivErreurs,objetLogin){

	objetDivErreurs.innerHTML="Le mail existe déjà. Veuillez en choisir un autre";
	objetDivErreurs.style.color="red";
	objetDivErreurs.style.borderStyle="solid";
	objetDivErreurs.style.borderWidth="1px";
	objetDivErreurs.style.borderColor="red";
	objetDivErreurs.style.backgroundColor="#FFB6C1";

	objetLogin.style.borderColor="red";
	objetLogin.style.backgroundColor="#FFB6C1";

}




function compteCree(objetDivForm,objetDivErreurs){

		console.log('compte crée');
	objetDivForm.style.display="none";
	objetDivErreurs.innerHTML="Votre compte a bien été crée. Vous allez être redirigé vers votre page de session";


}