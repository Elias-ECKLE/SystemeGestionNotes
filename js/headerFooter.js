
//header________________________________________________________________________________________________________________________________________________________

function AfficherImg_defaut(img_id,src){ //fct importante lorsqu'on a passé la souris sur une image et qu'on l'enleve, quelle image s'affiche ? celles en dessous


		switch(img_id){
			case "imageYoutube":
				img.src="images/LogosReseauxSociaux/logoYoutube.png"
				break;
			case "imageFacebook":
				img.src="images/LogosReseauxSociaux/logoFacebook.png"
				break;
			case "imageTwitter":
				img.src="images/LogosReseauxSociaux/logoTwitter.png"
				break;
			case "imageInstagram":
				img.src="images/LogosReseauxSociaux/logoInstagram.png"
				break;
			case "imageFlickr":
				img.src="images/LogosReseauxSociaux/logoFlickr.png"
				break;
			case "imageLinkedin":
				img.src="images/LogosReseauxSociaux/logoLinkedin.png"
				break;
			default : img.src=src;
	     }
	}



//Remplacer les images pas celles entourées lorsqu'on passe la souris dessus

function AfficherImg_cercle(img_id,src){

	img=document.getElementById(img_id);

		switch(img_id){
		case "imageYoutube":
			img.src="images/LogosReseauxSociaux_cercle/cercle_B/youtube/logoYoutube_cercleB.png"
			break;
		case "imageFacebook":
			img.src="images/LogosReseauxSociaux_cercle/cercle_B/facebook/logoFacebook_cercleB.png"
			break;
		case "imageTwitter":
			img.src="images/LogosReseauxSociaux_cercle/cercle_B/twitter/logoTwitter_cercleB.png"
			break;
		case "imageInstagram":
			img.src="images/LogosReseauxSociaux_cercle/cercle_B/instagram/logoInstagram_cercleB.png"
			break;
		case "imageFlickr":
			img.src="images/LogosReseauxSociaux_cercle/cercle_B/flickr/logoFlickr_cercleB.png"
			break;
		case "imageLinkedin":
			img.src="images/LogosReseauxSociaux_cercle/cercle_B/linkedin/logoLinkedin_cercleB.png"
			break;
		default : img.src=src;
	    }
	}









//footer____________________________________________________________________________________________________________________________________________________________



function AfficherImg_defautFooter(img_id,src){ //fct importante lorsqu'on a passé la souris sur une image et qu'on l'enleve, quelle image s'affiche ? celles en dessous

		img=document.getElementById(img_id);


		switch(img_id){
			case "imageYoutubeFooter":
				img.src="images/LogosReseauxSociaux/logoYoutube.png"
				break;
			case "imageFacebookFooter":
				img.src="images/LogosReseauxSociaux/logoFacebook.png"
				break;
			case "imageTwitterFooter":
				img.src="images/LogosReseauxSociaux/logoTwitter.png"
				break;
			case "imageInstagramFooter":
				img.src="images/LogosReseauxSociaux/logoInstagram.png"
				break;
			case "imageFlickrFooter":
				img.src="images/LogosReseauxSociaux/logoFlickr.png"
				break;
			case "imageLinkedinFooter":
				img.src="images/LogosReseauxSociaux/logoLinkedin.png"
				break;
			default : img.src=src;
	     }
	}
		



//Remplacer les images pas celles entourées lorsqu'on passe la souris dessus

function AfficherImg_cercleFooter(img_id,src){

	img=document.getElementById(img_id);



		switch(img_id){
		case "imageYoutubeFooter":
			img.src="images/LogosReseauxSociaux_cercle/cercle_B/youtube/logoYoutube_cercleB.png"
			break;
		case "imageFacebookFooter":
			img.src="images/LogosReseauxSociaux_cercle/cercle_B/facebook/logoFacebook_cercleB.png"
			break;
		case "imageTwitterFooter":
			img.src="images/LogosReseauxSociaux_cercle/cercle_B/twitter/logoTwitter_cercleB.png"
			break;
		case "imageInstagramFooter":
			img.src="images/LogosReseauxSociaux_cercle/cercle_B/instagram/logoInstagram_cercleB.png"
			break;
		case "imageFlickrFooter":
			img.src="images/LogosReseauxSociaux_cercle/cercle_B/flickr/logoFlickr_cercleB.png"
			break;
		case "imageLinkedinFooter":
			img.src="images/LogosReseauxSociaux_cercle/cercle_B/linkedin/logoLinkedin_cercleB.png"
			break;
		default : img.src=src;
	    }
	}




