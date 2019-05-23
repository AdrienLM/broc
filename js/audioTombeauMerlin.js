(function() {
	"use strict";
	window.addEventListener("DOMContentLoaded", initialiser);

	let tempsTotal = 76; /* DONNÉE À MODIFIER */
	let tempsPasseS = 0;
	let tempsPasseDS = 0;
	let tempsDePause = new Array(85, 289, 528, 765); /* DONNÉE À MODIFIER */
	let tempsDeDepart = new Array(97, 301, 528); /* DONNÉE À MODIFIER */
	let indiceParagrapheCourant = 0;
	let timerAffichage;
	let timerPause;
	let playerAudio;
	let tousLesSons;

	let divJeu;
	let divNarrateur;
	let btnDivNarrateur;
	let btnDivNarrateurImg;

		/* Variables images */
  let brouillard;
  let vivianeEtMerlin;


	let tableauParagraphes = new Array();
	tableauParagraphes.push(new Array("Voici l’un des lieux symbolique de l’amour inconditionnel liant Viviane et Merlin.",
																		"Mais avant d’en apprendre plus sur cet endroit, allons à la Fontaine de Barenton pour découvrir la rencontre de ces deux amants."));
	tableauParagraphes.push(new Array("Un beau jour de printemps, la fée Viviane se tenait assise sur une pierre.",
																		"Un jeune écuyer vint alors à sa rencontre.",
																		"Le bel homme, s’avérant magicien, donna à la jeune fille sa première leçon de magie.",
																		"La fée montra un talent certain en réussissant son premier sort, faisant apparaître une rivière fraîche et rapide.",
																		"Sans révéler son identité, l’écuyer partit sans un mot."));
	tableauParagraphes.push(new Array("Ce n’est que bien plus tard, alors que Viviane s’était entichée de ce bel homme, que ce dernier lui révéla sa véritable apparence.",
																		"Des traits plus âgés, plus sages, se cachaient derrière un masque magique. Pour la première fois, Viviane vit le vrai visage de son bien aimé Merlin."));
	tableauParagraphes.push(new Array("Amant mais également mentor de la fée, Merlin lui révéla tous ses secrets et lui apprit de nombreux sorts. Parmi ceux-ci se trouvait le sortilège permettant de garder un homme pour l’éternité.",
																		"Utilisant ce savoir, Viviane enferma Merlin dans neuf cercles d’air à l’aide d’un cercle de pierre.",
																		"Merlin, grand magicien, connaissait le sort qui l’attendait mais ne fit rien pour l’éviter.",
																		"Viviane a ainsi pu rester auprès de son bien-aimé jusqu’à la fin des temps.",
																		"Merlin est toujours en vie aux côtés de Viviane dans la caverne que l’on peut deviner sous nos pieds."));
	tableauParagraphes.push(new Array("Maintenant, testons ta mémoire."));


	/* Visualisation des éléments dans le DOM :
		<div nomJS="divPlayer" class="player">
			<span nomJS="containerTexte">Lecture : 0:00 / 2:02</span>
			<div nomJS="barreTemps" class="barreTemps">
				<div nomJS="divTempsPasse" class="tempsPasse"></div>
				<div nomJS="curseur" class="curseur"></div>
			</div>
		</div>
	*/
		/* Lecteur audio : créer les éléments, leurs attribuer un style (dynamique) et une calsse si besoin */
	let divPlayer = document.createElement("div");
	divPlayer.classList.add("player");
	let containerTexte = document.createElement("span");
	let barreTemps = document.createElement("div");
	barreTemps.classList.add("barreTemps");
	let divTempsPasse = document.createElement("div");
	divTempsPasse.classList.add("tempsPasse");
	divTempsPasse.style.width = "0";
	let curseur = document.createElement("div");
	curseur.classList.add("curseur");
	curseur.style.left = "0";

	function initialiser(evt) {
			/* Placer les éléments dans le DOM */
		containerTexte.appendChild(document.createTextNode("Lecture : 0:00 / "+transformerSecondesEnMinutesSecondes(tempsTotal)));
		divPlayer.appendChild(containerTexte);
		barreTemps.appendChild(divTempsPasse);
		barreTemps.appendChild(curseur);
		divPlayer.appendChild(barreTemps);
		document.getElementById("texte").insertBefore(divPlayer, document.getElementById("texte").querySelector("p"));

			/* Enregistrer les éléments du DOM nécessaire à la fonction initialiser */
		tousLesSons = document.querySelectorAll("audio");
		btnDivNarrateur = document.querySelector("#narrateur>div:last-child");
		btnDivNarrateurImg = btnDivNarrateur.querySelector("img");

			/* Ajouter les écouteurs d'événements */
		document.querySelector("#param>div:nth-child(2)").addEventListener("click", lancementSon);
		//btnDivNarrateur.addEventListener("click", lancerEnigme);
		btnDivNarrateur.addEventListener("click", lancerJeuBrouillard);
		//document.querySelector("#narrateur>div:last-child").addEventListener("click", paragrapheSuivantEvt);

	    /* Ecouteur animation début */
		window.addEventListener("resize", verifierHauteurDivNarrateurRedimension);
	  document.querySelector("#param>div:first-child>img").addEventListener("click", pleinEcran);
	  document.querySelector("#param>div:nth-child(2)").addEventListener("click", transitionDebut);

	    /* Enregistrer les autres éléments du DOM */
	  divNarrateur = document.getElementById("narrateur");
	  divJeu = document.getElementById("wrapperJeu");

			/* Placer les éléments du début */
		/*brouillard = creerImage("images/brouillardTombeauMerlin.png", "Brouillard épais", {"height" : "100%", "width" : "100%"});
	  divJeu.insertBefore(brouillard, divNarrateur);*/
	}

	let nbNuageBrouillard = 1;
	async function lancerJeuBrouillard(evt) {
		btnDivNarrateur.removeEventListener("click", lancerJeuBrouillard);
		divNarrateur.style.opacity = "1";
		divNarrateur.style.transition = "all 0.3s linear";
		divNarrateur.style.opacity = "0";
		for(let unBrouillard of document.querySelectorAll("#wrapperJeu .brouillard.niv1")) {
			unBrouillard.addEventListener("click", dissiperBrouillard);
			unBrouillard.style.cursor = "pointer";
		}
		await attendre(300);
		divNarrateur.style.display = "none";
	}
	async function dissiperBrouillard(evt) {
		$(this).fadeOut(500);
		await attendre(500);
		this.remove();
		nbNuageBrouillard = nbNuageBrouillard - 1;
		if(nbNuageBrouillard == 0) {
			btnDivNarrateur.addEventListener("click", paragrapheSuivantEvt);
			paragrapheSuivant();
			interrupteurInterfaceNarrateurJeu(0);
			divNarrateur.style.display = "flex";
			divNarrateur.style.opacity = "1";
			await attendre(300);
			divNarrateur.style.transition = "all 0.8s linear";
		}
	}


	function interrupteurInterfaceNarrateurJeu(numeroJeu) {
		if(divNarrateur.querySelector("h3").textContent == "Jeu") {
			btnDivNarrateur.addEventListener("click", paragrapheSuivantEvt);
			divNarrateur.querySelector("img").setAttribute("src", "images/casque.svg");
			divNarrateur.querySelector("img").setAttribute("alt", "Casque");
			divNarrateur.querySelector("h3").textContent = "Narrateur";
			divNarrateur.style.right = "10px";
			divNarrateur.style.top = "20px";
			divNarrateur.style.transform = "translate(0)";
			divNarrateur.style.width = "250px";
			btnDivNarrateur.querySelector("p").textContent = "Suivant";
		} else {
			supprimerParagraphesHistoire();
				/* Restyliser #narrateur pour le jeu */
			divNarrateur.querySelector("img").setAttribute("src", "images/console.svg");
			divNarrateur.querySelector("img").setAttribute("alt", "Manette de jeu");
			divNarrateur.querySelector("h3").textContent = "Jeu";
			btnDivNarrateur.querySelector("p").textContent = "Valider";
			divNarrateur.style.right = "50%";
			divNarrateur.style.top = "50%";
			divNarrateur.style.transform = "translateX(50%) translateY(-50%)";

			switch(numeroJeu) {
				case 1 :
					break;
				case 2 :
					break;
				default : break;
			}
		}
	}

	async function lancerEnigme(evt) {
		if(!playerAudio.paused) {
			playerAudio.pause();
			window.clearInterval(timerPause);
		}
		document.querySelector("#narrateur>div:last-child").removeEventListener("click", lancerEnigme);

		let divNarrateur = document.getElementById("narrateur");
		document.querySelector("#narrateur>div:first-child>img").setAttribute("src", "images/console.svg");
		document.querySelector("#narrateur>div:first-child>img").setAttribute("alt", "Manette de jeu");
		document.querySelector("#narrateur h3").textContent = "Jeu";
		document.querySelector(".histoire").remove();
		document.querySelector("#narrateur>div:last-child").style.display = "none";
		document.querySelector("#narrateur>div:last-child>p").textContent = "Suivant";
		let divReponses = document.createElement("div");
		divReponses.classList.add("divReponsesQuizz");
		divNarrateur.insertBefore(divReponses, btnDivNarrateur);
		divNarrateur.style.right = "50%";
		divNarrateur.style.top = "50%";
		divNarrateur.style.transform = "translateX(50%) translateY(-50%)";
		divNarrateur.style.width = "300px";


		let i=0;
		let nbChoisis = new Array();
		nbChoisis.push(4);
		let booleanEnigme = true;
		let rep;
		while(i <= 3) {
			let nbAleatoire = Math.floor(Math.random() * 4);
			for(let unNbChoisi of nbChoisis) {
				if(unNbChoisi == nbAleatoire) {
					booleanEnigme = false;
				}
			}
			if(booleanEnigme) {
				nbChoisis.push(nbAleatoire);
				i = i + 1;

				rep = document.createElement("button");
				switch(nbAleatoire) {
					case 0 : rep.textContent = "Morgane";
							divReponses.appendChild(rep);
							$(".divReponses>button:last-child").fadeIn(500);
							document.getElementById("playerAudioRep0").play();
						break;
					case 1 : rep.textContent = "Viviane";
							divReponses.appendChild(rep);
							$(".divReponses>button:last-child").fadeIn(500);
							document.getElementById("playerAudioRep1").play();
						break;
					case 2 : rep.textContent = "Guenièvre";
							divReponses.appendChild(rep);
							$(".divReponses>button:last-child").fadeIn(500);
							document.getElementById("playerAudioRep2").play();
						break;
					case 3 : rep.textContent = "Mélusine";
							divReponses.appendChild(rep);
							$(".divReponses>button:last-child").fadeIn(500);
							document.getElementById("playerAudioRep3").play();
						break;
				}
				await attendre(1500);
				rep.addEventListener("click", verificationReponse);
			}
			booleanEnigme = true;
		}
	}
	function verificationReponse(evt) {
		if(this.textContent == "Viviane") {
			document.querySelector("#narrateur>div:last-child").remove();
			document.querySelector("#narrateur>div:last-child").addEventListener("click", paragrapheSuivantEvt);
			document.querySelector("#narrateur>div:last-child").style.display = "flex";
			document.querySelector("#narrateur>div:first-child>img").setAttribute("src", "images/casque.svg");
			document.querySelector("#narrateur>div:first-child>img").setAttribute("alt", "Casque");
			document.querySelector("#narrateur h3").textContent = "Narrateur";
			document.getElementById("narrateur").style.right = "10px";
			document.getElementById("narrateur").style.top = "20px";
			document.getElementById("narrateur").style.transform = "translate(0)";
			document.getElementById("narrateur").style.width = "250px";

			paragrapheSuivant();
		} else {
			let message = document.createElement("p");
			message.textContent = this.textContent+" n'est pas la bien-aimée de Merlin. Réessaie."
			let nbAleatoireVerif;
			let lesReponses = document.querySelectorAll(".divReponses>button");
			switch(this.textContent) {
				case "Morgane" : this.remove();
						nbAleatoireVerif = Math.floor(Math.random() * 2) + 2;
						if(nbAleatoireVerif == 2) {
							for(let uneReponse of lesReponses) {
								if(uneReponse.textContent == "Guenièvre") {
									uneReponse.remove();
								}
							}
						} else {
							for(let uneReponse of lesReponses) {
								if(uneReponse.textContent == "Mélusine") {
									uneReponse.remove();
								}
							}
						}
					break;
				case "Guenièvre" : this.remove();
						nbAleatoireVerif = Math.floor(Math.random() * 4);
						while(nbAleatoireVerif == 2 || nbAleatoireVerif == 1) {
							nbAleatoireVerif = Math.floor(Math.random() * 4);
						}
						if(nbAleatoireVerif == 0) {
							for(let uneReponse of lesReponses) {
								if(uneReponse.textContent == "Morgane") {
									uneReponse.remove();
								}
							}
						} else {
							for(let uneReponse of lesReponses) {
								if(uneReponse.textContent == "Mélusine") {
									uneReponse.remove();
								}
							}
						}
					break;
				case "Mélusine" : this.remove();
						nbAleatoireVerif = Math.floor(Math.random() * 3);
						while(nbAleatoireVerif == 1) {
							nbAleatoireVerif = Math.floor(Math.random() * 3);
						}
						if(nbAleatoireVerif == 0) {
							for(let uneReponse of lesReponses) {
								if(uneReponse.textContent == "Morgane") {
									uneReponse.remove();
								}
							}
						} else {
							for(let uneReponse of lesReponses) {
								if(uneReponse.textContent == "Guenièvre") {
									uneReponse.remove();
								}
							}
						}
					break;
			}
			document.getElementById("narrateur").insertBefore(message, document.querySelector("#narrateur>div:nth-of-type(2)"));
		}
	}


	async function animations() {
		switch(indiceParagrapheCourant) {
			case 1 :
				vivianeEtMerlin = creerImage("images/merlinViviane.png", "Viviane sur les genoux de Merlin", {"position" : "absolute", "right" : "50%", "bottom" : "-10%", "height" : "80%"});
        divJeu.insertBefore(vivianeEtMerlin, divNarrateur);
        $("#jeu>img:first-of-type").fadeOut(1500);
				await attendre(1500);
				//brouillard.remove();
        $("#jeu>img:last-of-type").fadeIn(500);
				await attendre(500);
				break;
			case 3 :
				$("#jeu>img:last-of-type").fadeOut(500);
				await attendre(500);
				break;
			case 4 :
				$("#narrateur div:last-child img").replaceWith('<a href="lancementAventure.php"><img src="images/check.svg" alt="icone check" /></a>');
        $("#narrateur div:last-child p").text("Terminé");
        break;
			default : break;
		}
		playerAudio.currentTime = (tempsDeDepart[indiceParagrapheCourant - 1] / 10);
		tempsPasseDS = tempsDeDepart[indiceParagrapheCourant - 1];
		playerAudio.play();
		timerPause = window.setInterval(arretSon, 100);
		timerAffichage = window.setInterval(affichageTemps, 1000);
	}




/* FONCTIONS GÉNÉRALES */
  function creerImage(src, alt, styles) {
	    let img = document.createElement("img");
	    img.setAttribute("src", src);
	    img.setAttribute("alt", alt);
			if(styles != null) {
				for(let index in styles) {
		      eval("img.style."+index+" = styles[index]");
		    }
			}
	    return img;
	  }
	function attendre(temps) {
		return new Promise(function(resolve) {
			setTimeout(function () {
				resolve()
			}, temps);
		})
	}

	function paragrapheSuivantEvt(evt) {
		paragrapheSuivant();
	}
	function paragrapheSuivant() {
		if(!playerAudio.paused) {
			playerAudio.pause();
			window.clearInterval(timerPause);
		}
		indiceParagrapheCourant++;
		supprimerParagraphesHistoire();
		if(indiceParagrapheCourant <= tableauParagraphes.length) {
			for(let unParagrapheAAfficher of tableauParagraphes[indiceParagrapheCourant - 1]) {
				let baliseP = document.createElement("p");
				baliseP.classList.add("histoire");
				baliseP.appendChild(document.createTextNode(unParagrapheAAfficher));
				document.getElementById("narrateur").insertBefore(baliseP, document.querySelector("#narrateur>div:nth-of-type(2)"));
			}
		}
		verifierHauteurDivNarrateur();
		animations();
	}
	function supprimerParagraphesHistoire() {
		for(let unParagrapheASupprimer of document.querySelectorAll("#narrateur>p")) {
			unParagrapheASupprimer.remove();
		}
	}

  async function transitionDebut(evt) {
    this.removeEventListener("click", transitionDebut);
    let divTexte = document.getElementById("texte");
    divTexte.style.transform = "scale(0.7) translate(-40%, -35%)";
    divTexte.style.transition = "all 1s linear";
    document.querySelector("#param>div:last-child>p").textContent = "Son";
    document.querySelector("#param>div:last-child>img").setAttribute("src", "images/hautParleur1.svg");
    document.querySelector("#param>div:last-child>img").setAttribute("alt", "Haut parleur");
    document.querySelector("#param>div:nth-child(2)").remove();
    document.getElementById("retour").remove();
    let divCarte = document.getElementById("carte");
    divCarte.style.transform = "scale(0.6) translate(-255%, 40vh)";
    divCarte.style.transition = "all 1s linear";
    await attendre(500);
    $("#jeu").fadeIn(500);
    divJeu.style.display = "flex";
  }

  function affichageTemps() {
		tempsPasseS = Math.floor(playerAudio.currentTime);
			/* Arrêter le timer à la fin */
		if(tempsPasseS > tempsTotal) {
			window.clearInterval(timerAffichage);
		}
			/* Mettre à jour le texte affiché */
		containerTexte.textContent = "Lecture : "+transformerSecondesEnMinutesSecondes(tempsPasseS)+" / "+transformerSecondesEnMinutesSecondes(tempsTotal);
			/* Calculer le pourcentage de temps passé et agrandir/déplacer les éléments dynamiques en conséquence */
		let pourcentage = (tempsPasseS * 100 / tempsTotal);
		divTempsPasse.style.width = pourcentage+"%";
		curseur.style.left = pourcentage+"%";
	}
  function transformerSecondesEnMinutesSecondes(tempsInitial) {
		let minutes = Math.floor(tempsInitial / 60);
		let secondes = Math.floor(tempsInitial - 60 * minutes);
		let tempsTransforme;
		if(secondes<10) {
			tempsTransforme = minutes+":0"+secondes;
		} else {
			tempsTransforme = minutes+":"+secondes;
		}
		return tempsTransforme;
	}

  async function lancementSon(evt) {
		document.querySelector("#param>div:last-child").addEventListener("click", interrupteurSon);
		await attendre(1000);
			/* Lancer le son */
		playerAudio = document.getElementById("playerAudioConteur");
		playerAudio.play();
			/* Lancer les timers */
		timerAffichage = window.setInterval(affichageTemps, 1000);
		timerPause = window.setInterval(arretSon, 100);
	}
  function arretSon() {
		tempsPasseDS++;
		if(tempsPasseDS == tempsDePause[indiceParagrapheCourant]) {
			playerAudio.pause();
			window.clearInterval(timerAffichage);
			window.clearInterval(timerPause);
		}
	}

	function verifierHauteurDivNarrateurRedimension(evt) {
		verifierHauteurDivNarrateur();
	}
	function verifierHauteurDivNarrateur() {
		let hauteurDivNarrateur = divNarrateur.clientHeight;
		let hauteurElementsInternes = 0;
		for(let unElement of divNarrateur.querySelectorAll("div, .histoire")) {
			hauteurElementsInternes = hauteurElementsInternes + unElement.clientHeight;
		}
		if(hauteurElementsInternes > hauteurDivNarrateur) {
			divNarrateur.style.overflowY = "scroll";
		} else {
			divNarrateur.style.overflowY = "hidden";
		}
	}

    /* Paramètres */
  let booleanPleinEcran = false;
  function pleinEcran(evt) {
    if(!booleanPleinEcran) {
      booleanPleinEcran = true;
      let html = document.querySelector("html");
      if (html.requestFullscreen) {
        html.requestFullscreen();
      } else if (html.mozRequestFullScreen) { /* Firefox */
        html.mozRequestFullScreen();
      } else if (html.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
        html.webkitRequestFullscreen();
      } else if (html.msRequestFullscreen) { /* IE/Edge */
        html.msRequestFullscreen();
      }
    } else {
      booleanPleinEcran = false;
      if (document.exitFullscreen) {
        document.exitFullscreen();
      } else if (document.mozCancelFullScreen) { /* Firefox */
        document.mozCancelFullScreen();
      } else if (document.webkitExitFullscreen) { /* Chrome, Safari and Opera */
        document.webkitExitFullscreen();
      } else if (document.msExitFullscreen) { /* IE/Edge */
        document.msExitFullscreen();
      }
    }
  }
  function interrupteurSon(evt) {
		    for(let unSon of tousLesSons) {
		      if(unSon.volume == 1) {
		        unSon.volume = 0;
						document.querySelector("#param>div:last-child>img").setAttribute("src", "images/hautParleur.svg");
		      } else {
		        unSon.volume = 1;
						document.querySelector("#param>div:last-child>img").setAttribute("src", "images/hautParleur1.svg");
		      }
		    }
		  }
}());
