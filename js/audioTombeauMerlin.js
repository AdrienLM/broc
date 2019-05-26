(function() {
	"use strict";
	window.addEventListener("DOMContentLoaded", initialiser);

	let tempsTotal = 86; /* DONNÉE À MODIFIER */ /* s */
	let tempsPasseS = 0;
	let tempsPasseDS = 0;
	let tempsDePause = new Array(39, 168, 370, 539, 749, 840, 859); /* DONNÉE À MODIFIER */ /* ds */
	let tempsDeDepart = new Array(39, 168, 370, 539, 749, 840); /* DONNÉE À MODIFIER */ /* ds */
	let indiceParagrapheCourant = 0;
	let timerAffichage;
	let timerPause;
	let playerAudio;
	let tousLesSons;

	let divJeu;
	let divNarrateur;
	let btnDivNarrateur;
	let btnDivNarrateurImg;

	let nbNuageBrouillard;


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
																		"Merlin, grand magicien, connaissait le sort qui l’attendait mais ne fit rien pour l’éviter."));
	tableauParagraphes.push(new Array("Viviane a ainsi pu rester auprès de son bien-aimé jusqu’à la fin des temps.",
																		"Merlin est toujours en vie aux côtés de Viviane dans la caverne que l’on peut deviner sous nos pieds."));
	tableauParagraphes.push(new Array("Maintenant, testons ta mémoire."));

	let questionsReponsesQuizz = {
		"enigmes" : [
		{"question" : "Quel est le nom de la bien-aimée de Merlin ?",
			"audioQuestion" : "merlinQ1/questBienAimeMerlin",
			"reponse1" : "Viviane",
			"audioRep1" : "merlinQ1/viviane",
			"reponse2" : "Morgane",
			"audioRep2" : "merlinQ1/morgane",
			"reponse3" : "Guenièvre",
			"audioRep3" : "merlinQ1/guenievre",
			"reponse4" : "Mélusine",
			"audioRep4" : "merlinQ1/melusine"
		},
		{"question" : "La première fois qu’il a rencontré Viviane, Merlin avait prit l’apparence d’un…",
			"audioQuestion" : "merlinQ2/questApparence",
			"reponse1" : "Écuyer",
			"audioRep1" : "merlinQ2/ecuyer",
			"reponse2" : "Magicien",
			"audioRep2" : "merlinQ2/magicien",
			"reponse3" : "Prince",
			"audioRep3" : "merlinQ2/prince",
			"reponse4" : "Chevalier",
			"audioRep4" : "merlinQ2/chevalier"
		},
		{"question" : "Le premier sort qu’a lancé Viviane a fait apparaître…",
			"audioQuestion" : "merlinQ3/questPremierSort",
			"reponse1" : "Une rivière",
			"audioRep1" : "merlinQ3/riviere",
			"reponse2" : "Une forêt",
			"audioRep2" : "merlinQ3/foret",
			"reponse3" : "Un château",
			"audioRep3" : "merlinQ3/chateau",
			"reponse4" : "Un tombeau",
			"audioRep4" : "merlinQ3/tombeau"
		},
		{"question" : "Dans combien de cercles d’air Merlin a t-il été enfermé ?",
			"audioQuestion" : "merlinQ4/questCercleDAir",
			"reponse1" : "9",
			"audioRep1" : "merlinQ4/9",
			"reponse2" : "3",
			"audioRep2" : "merlinQ4/3",
			"reponse3" : "12",
			"audioRep3" : "merlinQ4/12",
			"reponse4" : "7",
			"audioRep4" : "merlinQ4/7"
		},
		{"question" : "Combien de temps Merlin restera t-il enfermé ?",
			"audioQuestion" : "merlinQ5/questTemps",
			"reponse1" : "Jusqu’à la fin des temps",
			"audioRep1" : "merlinQ5/finDesTemps",
			"reponse2" : "500 ans",
			"audioRep2" : "merlinQ5/500Ans",
			"reponse3" : "1 000 ans",
			"audioRep3" : "merlinQ5/1000Ans",
			"reponse4" : "On en sait pas",
			"audioRep4" : "merlinQ5/saisPas"
		},
	]};

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
		nbNuageBrouillard = document.getElementsByClassName("brouillard").length;

			/* Ajouter les écouteurs d'événements */
		document.querySelector("#param>div:nth-child(2)").addEventListener("click", lancementSon);
		btnDivNarrateur.addEventListener("click", lancerJeuBrouillard);

	    /* Ecouteur animation début */
		window.addEventListener("resize", verifierHauteurDivNarrateurRedimension);
	  document.querySelector("#param>div:first-child>img").addEventListener("click", pleinEcran);
	  document.querySelector("#param>div:nth-child(2)").addEventListener("click", transitionDebut);

	    /* Enregistrer les autres éléments du DOM */
	  divNarrateur = document.getElementById("narrateur");
	  divJeu = document.getElementById("wrapperJeu");
	}

	async function lancerJeuBrouillard(evt) {
		if(!playerAudio.paused) {
			playerAudio.pause();
			window.clearInterval(timerPause);
		}
		btnDivNarrateur.removeEventListener("click", lancerJeuBrouillard);
		divNarrateur.style.opacity = "1";
		divNarrateur.style.transition = "all 0.3s linear";
		divNarrateur.style.opacity = "0";
		//Sélecteur à revoir
		for(let unBrouillard of document.querySelectorAll("#wrapperJeu .brouillard")) {
			unBrouillard.addEventListener("click", dissiperBrouillard);
			unBrouillard.style.cursor = "pointer";
		}
		await attendre(300);
		divNarrateur.style.display = "none";
	}
	async function dissiperBrouillard(evt) {

		//temps + actions à revoir (son, etc.)
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
			verifierHauteurDivNarrateur();
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
			divNarrateur.style.width = "22%";
			btnDivNarrateur.querySelector("p").textContent = "Suivant";
		} else {
			supprimerParagraphesHistoire();
				/* Restyliser #narrateur pour le jeu */
			divNarrateur.querySelector("img").setAttribute("src", "images/console.svg");
			divNarrateur.querySelector("img").setAttribute("alt", "Manette de jeu");
			divNarrateur.querySelector("h3").textContent = "Jeu";
			divNarrateur.style.right = "50%";
			divNarrateur.style.top = "50%";
			divNarrateur.style.transform = "translateX(50%) translateY(-50%)";

			if(numeroJeu == 1) {
				btnDivNarrateur.style.display = "none";
				btnDivNarrateur.querySelector("p").textContent = "Recommencer";
				divNarrateur.style.width = "45%";
				afficherEnigme();
			}
		}
	}

	let numeroEnigme = 0;
	async function lancerEnigmes(evt) {
		if(!playerAudio.paused) {
			playerAudio.pause();
			window.clearInterval(timerPause);
		}
		btnDivNarrateur.removeEventListener("click", lancerEnigmes);
		divNarrateur.querySelector("h3").textContent = "Narrateur";
		interrupteurInterfaceNarrateurJeu(1);
	}
	function verificationReponse(evt) {
		if(this.textContent == questionsReponsesQuizz["enigmes"][numeroEnigme]["reponse1"]) {
			numeroEnigme = numeroEnigme + 1;
			effacerEnigme();
		} else {
			divNarrateur.querySelector(".divReponsesQuizz").remove();
			let message = document.createElement("p");
			message.textContent = "Dommage ! "+this.textContent+" n'est pas la bonne réponse. Recommence !";
			message.classList.add("messageQuizz");
			divNarrateur.insertBefore(message, btnDivNarrateur);
			btnDivNarrateur.style.display = "flex";
			numeroEnigme = 0;
			btnDivNarrateur.addEventListener("click", lancerEnigmes);
		}
	}
	function effacerEnigme() {
		for(let unP of document.querySelectorAll("#narrateur>p")) {
			unP.remove();
		}
		divNarrateur.querySelector(".divReponsesQuizz").remove();
		if(numeroEnigme != questionsReponsesQuizz["enigmes"].length - 1) {
			afficherEnigme();
		} else {
			let message = document.createElement("p");
			message.textContent = "Bravo ! Tu as terminé le quizz !";
			message.classList.add("messageQuizz");
			divNarrateur.insertBefore(message, btnDivNarrateur);
			$("#narrateur div:last-child img").replaceWith('<a href="lancementAventure.php"><img src="images/check.svg" alt="icone check" /></a>');
			$("#narrateur div:last-child p").text("Terminé");
			btnDivNarrateur.style.display = "flex";
		}
	}
	async function afficherEnigme() {
		let divReponses = document.createElement("div");
		divReponses.classList.add("divReponsesQuizz");
		divNarrateur.insertBefore(divReponses, btnDivNarrateur);

		let debutCheminSons = "./sons/aventureTombeauMerlinV2/";
		let extension;
		if (document.getElementById("playerAudioConteur").canPlayType('audio/mpeg;')) {
			extension = ".mp3";
		} else {
			extension = ".ogg";
		}

		let affichageNumQuestion = document.createElement("p");
		affichageNumQuestion.textContent = "Question "+(numeroEnigme + 1)+"/"+questionsReponsesQuizz["enigmes"].length;
		affichageNumQuestion.classList.add("numeroQuestionQuizz");
		divNarrateur.insertBefore(affichageNumQuestion, divReponses);
		let question = document.createElement("p");
		question.textContent = questionsReponsesQuizz["enigmes"][numeroEnigme]["question"];
		question.classList.add("questionQuizz");
		divNarrateur.insertBefore(question, divReponses);
		let audio = new Audio(debutCheminSons+questionsReponsesQuizz["enigmes"][numeroEnigme]["audioQuestion"]+extension);
		await lancerAudioEnigme(audio, false);


			/* Intégrer les réponses dans un ordre aléatoire */
		let i=0;
		let nbChoisis = new Array();
		nbChoisis.push(4);
		let booleanEnigme = true;
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
				let rep = document.createElement("button");
				switch(nbAleatoire) {
					case 0 :
						rep.textContent = questionsReponsesQuizz["enigmes"][numeroEnigme]["reponse1"];
						divReponses.appendChild(rep);
						audio = new Audio(debutCheminSons+questionsReponsesQuizz["enigmes"][numeroEnigme]["audioRep1"]+extension);
						break;
					case 1 :
						rep.textContent = questionsReponsesQuizz["enigmes"][numeroEnigme]["reponse2"];
						divReponses.appendChild(rep);
						audio = new Audio(debutCheminSons+questionsReponsesQuizz["enigmes"][numeroEnigme]["audioRep2"]+extension);
						break;
					case 2 :
						rep.textContent = questionsReponsesQuizz["enigmes"][numeroEnigme]["reponse3"];
						divReponses.appendChild(rep);
						audio = new Audio(debutCheminSons+questionsReponsesQuizz["enigmes"][numeroEnigme]["audioRep3"]+extension);
						break;
					case 3 :
						rep.textContent = questionsReponsesQuizz["enigmes"][numeroEnigme]["reponse4"];
						divReponses.appendChild(rep);
						audio = new Audio(debutCheminSons+questionsReponsesQuizz["enigmes"][numeroEnigme]["audioRep4"]+extension);
						break;
				}
				$(".divReponses>button:last-child").fadeIn(200);
				await lancerAudioEnigme(audio, true);
				rep.addEventListener("click", verificationReponse);
				verifierHauteurDivNarrateur();
			}
			booleanEnigme = true;
		}

	}

	function lancerAudioEnigme(audio, reponse) {
		return new Promise(async function(resolve) {
			audio.preload = "metadata";
			await metadataCharge(audio);
			audio.play();
			if(reponse && audio.duration * 1000 <= 200) {
				await attendre(200);
			} else {
				await attendre((audio.duration * 1000) + 20);
			}
			resolve();
		})
	}
	function metadataCharge(audio) {
		return new Promise(function(resolve) {
			audio.onloadedmetadata = function () {
				resolve()
			};
		})
	}

let vivianeEtMerlin;
	async function animations() {
		lancerTimersAnimation();
		switch(indiceParagrapheCourant) {
			case 1 :
				vivianeEtMerlin = creerImage("images/merlinViviane.png", "Viviane sur les genoux de Merlin", {"position" : "absolute", "right" : "50%", "bottom" : "-10%", "height" : "80%", "animation" : "fonduEntrant 1s linear"});
        divJeu.insertBefore(vivianeEtMerlin, divNarrateur);
        //$("#jeu>img:first-of-type").fadeOut(1500);
				//await attendre(1500);
				await attendre(500);
				break;
			case 3 :
				$("#wrapperJeu>img:last-of-type").fadeOut(3000);
				//vivianeEtMerlin.style.animation = "fonduSortant 3s linear";
				//vivianeEtMerlin.classList.add("fonduSortant");
				await attendre(3000);
				vivianeEtMerlin.style.opacity = "0";
				break;
			case tableauParagraphes.length :
				btnDivNarrateur.querySelector("p").textContent = "Répondre";
				btnDivNarrateur.removeEventListener("click", paragrapheSuivantEvt);
				btnDivNarrateur.addEventListener("click", lancerEnigmes);
				//-> Fin
				/*$("#narrateur div:last-child img").replaceWith('<a href="lancementAventure.php"><img src="images/check.svg" alt="icone check" /></a>');
        $("#narrateur div:last-child p").text("Terminé");*/
        break;
			default : break;
		}
	}
	function lancerTimersAnimation() {
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
				divNarrateur.insertBefore(baliseP, document.querySelector("#narrateur>div:nth-of-type(2)"));
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
		for(let unElement of divNarrateur.querySelectorAll("div, p")) {
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
