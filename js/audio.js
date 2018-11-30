(function() {
	"use strict";
	window.addEventListener("DOMContentLoaded", initialiser);

	let tempsTotal = 84; /* DONNÉE À MODIFIER */
	let tempsPasseS = 0;
	let tempsPasseDS = 0;
	let tempsDePause = new Array(85, 289, 528, 760); /* DONNÉE À MODIFIER */
	let tempsDeDepart = new Array(157, 301, 561, 774); /* DONNÉE À MODIFIER */
	let indiceParagrapheCourant = 0;
	let timerAffichage;
	let timerPause;
	let playerAudio;

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
			/* Ajouter les écouteurs d'événements */
		document.querySelector("#param>div:nth-child(2)").addEventListener("click", lancementSon);
		document.querySelector("#narrateur>div:last-child").addEventListener("click", lancerEnigme);
		//document.querySelector("#narrateur>div:last-child").addEventListener("click", paragrapheSuivant);
	}

	function lancementSon(evt) {
		window.setTimeout(timerLancementSon, 1000);
	}

	function timerLancementSon() {
			/* Lancer le son */
		playerAudio = document.getElementById("playerAudioConteur");
		playerAudio.play();
			/* Lancer les timers */
		timerAffichage = window.setInterval(affichageTemps, 1000);
		timerPause = window.setInterval(pause, 100);
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

	function pause() {
		tempsPasseDS++;
		if(tempsPasseDS == tempsDePause[indiceParagrapheCourant]) {
			playerAudio.pause();
			indiceParagrapheCourant++;
			window.clearInterval(timerAffichage);
			window.clearInterval(timerPause);
		}
	}

	function paragrapheSuivant(evt) {
		if(!playerAudio.paused) {
			playerAudio.pause();
		}
		playerAudio.currentTime = (tempsDeDepart[indiceParagrapheCourant - 1] / 10);
		tempsPasseDS = tempsDeDepart[indiceParagrapheCourant - 1];
		playerAudio.play();
		timerAffichage = window.setInterval(affichageTemps, 1000);
		timerPause = window.setInterval(pause, 100);
	}

	function lancerEnigme(evt) {
		if(!playerAudio.paused) {
			playerAudio.pause();
		}
		let divNarrateur = document.getElementById("narrateur");
		document.querySelector("#narrateur>div:first-child>img").setAttribute("src", "images/manette.svg");
		document.querySelector("#narrateur>div:first-child>img").setAttribute("alt", "Manette de jeu");
		document.querySelector("#narrateur h3").textContent = "Jeu";
		document.querySelector(".histoire").remove();
		document.querySelector("#narrateur>div:last-child").style.display = "none";
		document.querySelector("#narrateur>div:last-child>p").textContent = "Suivant";

		let i=0;
		let nbChoisis = new Array();
		nbChoisis.push(4);
		let booleanEnigme = true;
		let rep;
		while(i < 3) {
			let nbAleatoire = Math.floor(Math.random() * 3);
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
							rep.style.opacity = "0";
							divNarrateur.appendChild(rep);
							rep.style.transition = "opacity 1s linear";
							document.getElementById("playerAudioRep0").play();
							window.setTimeout(attendre, 1500);
							rep.addEventListener("click", verificationReponse);
						break;
					case 1 : rep = document.createElement("button");
							rep.textContent = "Viviane";
							rep.style.opacity = "0";
							divNarrateur.appendChild(rep);
							rep.style.transition = "opacity 1s linear";
							document.getElementById("playerAudioRep1").play();
							window.setTimeout(attendre, 1500);
							rep.addEventListener("click", verificationReponse);
						break;
					case 2 : rep = document.createElement("button");
							rep.textContent = "Guenièvre";
							rep.style.opacity = "0";
							divNarrateur.appendChild(rep);
							rep.style.transition = "opacity 1s linear";
							document.getElementById("playerAudioRep2").play();
							window.setTimeout(attendre, 1500);
							rep.addEventListener("click", verificationReponse);
						break;
					case 3 : rep = document.createElement("button");
							rep.textContent = "Mélusine";
							rep.style.opacity = "0";
							divNarrateur.appendChild(rep);
							rep.style.transition = "opacity 1s linear";
							document.getElementById("playerAudioRep3").play();
							window.setTimeout(attendre, 1500);
							rep.addEventListener("click", verificationReponse);
						break;
				}
			}
			booleanEnigme = true;
		}
	}

	function attendre() {
		let attendre;
	}

	function verificationReponse(evt) {
		if(this.textContent == "Viviane") {
			document.querySelector("#narrateur>div:last-child").addEventListener("click", paragrapheSuivant);
			document.querySelector("#narrateur>div:last-child").style.display = "block";
			document.querySelector("#narrateur>div:first-child>img").setAttribute("src", "images/casque.svg");
			document.querySelector("#narrateur>div:first-child>img").setAttribute("alt", "Casque");
			document.querySelector("#narrateur h3").textContent = "Narrateur";
		}
	}

	/*let divNarrateur = document.getElementById("narrateur");
		document.querySelector("#narrateur>div:first-child>img").setAttribute("src", "images/manette.svg");
        document.querySelector("#narrateur>div:first-child>img").setAttribute("alt", "Manette de jeu");
        document.querySelector("#narrateur h3").textContent = "Jeu";
        let paragraphes = document.getElementsByClassName("histoire");
        for(let unParagraphe of paragraphes) {
        	unParagraphe.remove();
        }
        document.querySelector("#narrateur>div:last-child").style.display = "none";
        document.querySelector("#narrateur>div:last-child>p").textContent = "Suivant";


    /* Boucle se répétant autant de fois qu'il y a de mots à trouver dans le paragraphe */
                //for (i = 1 ; i <= unNbMotsATrouver ; i++) {
                        /* Choisir aléatoirement l'indice d'un vers */
                    //var indiceVersAleatoire = Math.floor(Math.random() * (finParagraphe - debutParagraphe)) + debutParagraphe;
                        /* Connaître le nombre de mots dans le vers choisi aléatoirement */
                    //nbMotsDansLeVers = mots[indiceVersAleatoire].length;
                        /* Prendre aléatoirement l'indice d'un mot dans le vers */
                    //var indiceMotAleatoire = Math.floor(Math.random() * (nbMotsDansLeVers - 1));
                        /* Filtrer les mots à trouver */
                    //if(mots[indiceVersAleatoire][indiceMotAleatoire] == "_____" | mots[indiceVersAleatoire][indiceMotAleatoire].toUpperCase() == "A" | mots[indiceVersAleatoire][indiceMotAleatoire].toUpperCase() == "AN" | mots[indiceVersAleatoire][indiceMotAleatoire].toUpperCase() == "I" | mots[indiceVersAleatoire][indiceMotAleatoire].toUpperCase() == "THE" | mots[indiceVersAleatoire][indiceMotAleatoire].toUpperCase() == "*****") {
                            /* Si le mot a déjà été sélectionné, faire un sorte d'en prendre un autre à la place */
                    /*    i = i - 1;
                    } else {
                            /* Sinon, l'ajouter aux mots à trouver (avec l'indice du vers dans lequel il a été pris et l'indice du mot au sein du vers) et le remplacer par "_____" dans les mots à afficher */
                       /* motsATrouver.push(mots[indiceVersAleatoire][indiceMotAleatoire]);
                        motsATrouver.push(indiceVersAleatoire);
                        motsATrouver.push(indiceMotAleatoire);
                        mots[indiceVersAleatoire][indiceMotAleatoire] = "_____";
                    }
                }





	/*<div id="narrateur" />
                   <div>
                        <img src="images/casque.svg" />
                        <h3>Narrateur</h3> 
                   </div>
                   <p class="histoire">Pour acquérir le droit d’arpenter cet endroit, il te faudra répondre à une question...</p>
                   <p class="histoire">Quelle est la bien aimée de Merlin ?</p>
                   <div>
                       <img src="images/flecheD.svg" />
                       <p>Répondre</p>
                   </div>
                </div>*/

}());