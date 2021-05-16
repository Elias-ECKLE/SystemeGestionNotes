


//sessionStorage.setItem("passageBoutonDeconnection","deconnection");
//document.getElementById('passageBoutonDeconnection').value=sessionStorage.getItem("passageBoutonDeconnection");



function styleEleveConnecte(){
	document.body.style.backgroundColor="#ADD8E6";
		console.log('eleve est connecté');

}

function styleProfConnecte(){
	document.body.style.backgroundColor="#A9A9A9";
		console.log('prof est connecté');

}




function erreurAjoutNote(inputErreur,objetDivErreurs){

	inputErreur.style.borderColor="red";
	inputErreur.style.backgroundColor="#FFB6C1";

	objetDivErreurs.innerHTML="Impossible d'ajouter la note -> Motif de note déjà saisi pour cette matière";
	objetDivErreurs.style.color="red";
	objetDivErreurs.style.borderStyle="solid";
	objetDivErreurs.style.borderWidth="1px";
	objetDivErreurs.style.borderColor="red";
	objetDivErreurs.style.backgroundColor="#FFB6C1";

}


function validationAjoutNote(objetDivErreurs){

	objetDivErreurs.innerHTML="La note a bien été ajoutée";
	objetDivErreurs.style.color="green";
	objetDivErreurs.style.borderStyle="solid";
	objetDivErreurs.style.borderWidth="1px";
	objetDivErreurs.style.borderColor="green";
	objetDivErreurs.style.backgroundColor="#32CD32";

}