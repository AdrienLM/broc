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
    let brouillard;
    let vivianeEtMerlin;


	let tableauParagraphes = new Array();
	tableauParagraphes.push(new Array("Ce tombeau est l’un des lieux symbolique de l’amour inconditionnel liant Viviane et Merlin.", "Amant de la fée Viviane, Merlin était également son mentor.", "L’enchanteur a révélé tous ses secrets à la fée. Parmi ceux-ci se trouvait le sortilège permettant de garder un homme pour l’éternité."));
	tableauParagraphes.push(new Array("Utilisant ce savoir, Viviane a enfermé Merlin dans neuf cercles d’air à l’aide d’un cercle de pierre.", "Merlin, grand magicien, connaissait le sort qui l’attendait mais ne fit rien pour l’éviter.", "Viviane a ainsi pu rester auprès de son bien-aimé jusqu’à la fin des temps.", "Merlin est toujours en vie aux côtés de Viviane dans la caverne que l’on peut deviner sous nos pieds."));
	tableauParagraphes.push(new Array("L’enchanteur accorde encore aujourd’hui des souhaits aux passants.", "Pour cela, procurez vous différents éléments de la forêt : branches, fleurs, feuilles… et transformez les simplement. Tout ce dont vous avez besoin est de votre créativité.", "Il suffira de poser votre création sur le rocher, de faire un vœu et de remercier Merlin de bien vouloir l’exaucer."));

	/* Visualisation des éléments dans le DOM :
		<div nomJS="divPlayer" class="player">
			<span nomJS="containerTexte">Lecture : 0:00 / 2:02</span>
			<div nomJS="barreTemps" class="barreTemps">
				<div nomJS="divTempsPasse" class="tempsPasse"></div>
				<div nomJS="curseur" class="curseur"></div>
			</div>
		</div>
	*/
		/* Créer les éléments, leurs attribuer un style (dynamique) et une calsse si besoin */
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


		tousLesSons = document.querySelectorAll("audio");
			/* Ajouter les écouteurs d'événements */
		document.querySelector("#param>div:nth-child(2)").addEventListener("click", lancementSon);
		document.querySelector("#narrateur>div:last-child").addEventListener("click", lancerEnigme);
		//document.querySelector("#narrateur>div:last-child").addEventListener("click", paragrapheSuivantEvt);

		    /* Ecouteur animation début */
        document.querySelector("#param>div:first-child>img").addEventListener("click", pleinEcran);
        document.querySelector("#param>div:nth-child(2)").addEventListener("click", transitionDebut);

            /*  */
        divJeu = document.getElementById("jeu");
        divNarrateur = document.getElementById("narrateur");
        brouillard = document.createElement("img");
        brouillard.setAttribute("src", "images/brouillardTombeauMerlin.png");
        brouillard.setAttribute("alt", "Brouillard épais");
        brouillard.style.height = "100%";
        divJeu.insertBefore(brouillard, divNarrateur);
	}

	function interrupteurSon(evt) {
		for(let unSon of tousLesSons) {
			if(unSon.volume == 1) {
				unSon.volume = 0;
			} else {
				unSon.volume = 1;
			}
		}
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
		if(secondes<10) {
			var tempsTransforme = minutes+":0"+secondes;
		} else {
			var tempsTransforme = minutes+":"+secondes;
		}
		return tempsTransforme;
	}

	function arretSon() {
		tempsPasseDS++;
		if(tempsPasseDS == tempsDePause[indiceParagrapheCourant]) {
			playerAudio.pause();
			indiceParagrapheCourant++;
			window.clearInterval(timerAffichage);
			window.clearInterval(timerPause);
		}
	}

	function paragrapheSuivantEvt(evt) {
		paragrapheSuivant();
	}

	function paragrapheSuivant() {
		if(!playerAudio.paused) {
			playerAudio.pause();
			window.clearInterval(timerPause);
			indiceParagrapheCourant++;
		}
		let lesParagraphes = document.querySelectorAll("#narrateur>p");
		for(let unParagrapheAsupprimer of lesParagraphes) {
			unParagrapheAsupprimer.remove();
		}
		/*let baliseP = document.createElement("p");
			baliseP.classList.add("histoire");
			baliseP.appendChild(document.createTextNode(tableauParagraphes));
			document.getElementById("narrateur").insertBefore(baliseP, document.querySelector("#narrateur>div:nth-of-type(2)"));*/
		if(indiceParagrapheCourant < 4) {
			for(let unParagrapheAAfficher of tableauParagraphes[indiceParagrapheCourant - 1]) {
				let baliseP = document.createElement("p");
				baliseP.classList.add("histoire");
				baliseP.appendChild(document.createTextNode(unParagrapheAAfficher));/*.textContent = unParagrapheAAfficher;*/
				document.getElementById("narrateur").insertBefore(baliseP, document.querySelector("#narrateur>div:nth-of-type(2)"));
			}
		}
		animations();
	}


	async function animations() {
		switch(indiceParagrapheCourant) {
			case 1 : vivianeEtMerlin = document.createElement("img");
        			vivianeEtMerlin.setAttribute("src", "images/merlinViviane.png");
			        vivianeEtMerlin.setAttribute("alt", "Viviane sur les genous de Merlin");
			        vivianeEtMerlin.style.position = "absolute";
			        vivianeEtMerlin.style.height = "80%";
			        vivianeEtMerlin.style.bottom = "-10%";
			        vivianeEtMerlin.style.right = "30vw";
			        divJeu.insertBefore(vivianeEtMerlin, divNarrateur);
			        $("#jeu>img:first-of-type").fadeOut(1500);
					await attendre(1500);
					brouillard.remove();
			        $("#jeu>img:last-of-type").fadeIn(500);
					await attendre(500);
				break;
			case 3 : $("#jeu>img:last-of-type").fadeOut(500);
					await attendre(500);
				break;
			case 4 : $("#narrateur div:last-child img").replaceWith('<a href="lancementAventure.php"><img src="images/check.svg" alt="icone check" /></a>');
                    $("#narrateur div:last-child p").text("Terminé");
                break;
			default :
				break;
		}
		playerAudio.currentTime = (tempsDeDepart[indiceParagrapheCourant - 1] / 10);
		tempsPasseDS = tempsDeDepart[indiceParagrapheCourant - 1];
		playerAudio.play();
		timerPause = window.setInterval(arretSon, 100);
		timerAffichage = window.setInterval(affichageTemps, 1000);
	}


	async function lancerEnigme(evt) {
		if(!playerAudio.paused) {
			playerAudio.pause();
			window.clearInterval(timerPause);
			indiceParagrapheCourant++;
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
		divReponses.classList.add("divReponses");
		divNarrateur.appendChild(divReponses);
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

				switch(nbAleatoire) {
					case 0 : rep = document.createElement("button");
							rep.textContent = "Morgane";
							divReponses.appendChild(rep);
							$(".divReponses>button:last-child").fadeIn(500);
							document.getElementById("playerAudioRep0").play();
							await attendre(1500);
							rep.addEventListener("click", verificationReponse);
						break;
					case 1 : rep = document.createElement("button");
							rep.textContent = "Viviane";
							divReponses.appendChild(rep);
							$(".divReponses>button:last-child").fadeIn(500);
							document.getElementById("playerAudioRep1").play();
							await attendre(1500);
							rep.addEventListener("click", verificationReponse);
						break;
					case 2 : rep = document.createElement("button");
							rep.textContent = "Guenièvre";
							divReponses.appendChild(rep);
							$(".divReponses>button:last-child").fadeIn(500);
							document.getElementById("playerAudioRep2").play();
							await attendre(1500);
							rep.addEventListener("click", verificationReponse);
						break;
					case 3 : rep = document.createElement("button");
							rep.textContent = "Mélusine";
							divReponses.appendChild(rep);
							$(".divReponses>button:last-child").fadeIn(500);
							document.getElementById("playerAudioRep3").play();
							await attendre(1500);
							rep.addEventListener("click", verificationReponse);
						break;
				}
			}
			booleanEnigme = true;
		}
	}

	function attendre(temps) {
		return new Promise(function(resolve) {
			setTimeout(function () {
				resolve()
			}, temps);
		})
	}

	function verificationReponse(evt) {
		if(this.textContent == "Viviane") {
			document.querySelector("#narrateur>div:last-child").remove();
			document.querySelector("#narrateur>div:last-child").addEventListener("click", paragrapheSuivantEvt);
			document.querySelector("#narrateur>div:last-child").style.display = "block";
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






	    /* Animation début */
    async function transitionDebut(evt) {
        this.removeEventListener("click", transitionDebut);
        let divTexte = document.getElementById("texte");
        divTexte.style.transform = "scale(0.7) translate(-40%, -35%)";
        divTexte.style.transition = "all 1s linear";
        document.querySelector("#param>div:last-child>p").textContent = "Son";
        document.querySelector("#param>div:last-child>img").setAttribute("src", "images/hautParleur.svg");
        document.querySelector("#param>div:last-child>img").setAttribute("alt", "Haut parleur");
        document.querySelector("#param>div:nth-child(2)").remove();
        document.getElementById("retour").remove();
        let divCarte = document.getElementById("carte");
        divCarte.style.transform = "scale(0.6) translate(-255%, 40%)";
        divCarte.style.transition = "all 1s linear";
        await attendre(500);
        $("#jeu").fadeIn(500);
        divJeu.style.display = "flex";
    }

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

    function fondu() {
        $("#jeu").fadeIn(500);
        divJeu.style.display = "flex";
        /*divJeu.style.opacity = "1";
        divJeu.style.transition = "opacity 1s linear";*/
    }
}());