(function() {
	"use strict";
	window.addEventListener("DOMContentLoaded", initialiser);

/* ! -> Données à modifier à automatiser */
	let tempsTotal = 84; /* DONNÉE À MODIFIER */ /* s ? */
	let tempsPasseS = 0;
	let tempsPasseDS = 0;
	let tempsDePause = new Array(80, 252, 369, 503, 690, 849); /* DONNÉE À MODIFIER */ /* ds ? */
	let tempsDeDepart = new Array(81, 252, 369, 503, 690); /* DONNÉE À MODIFIER */
	let indiceParagrapheCourant = 0;
	let timerAffichage;
	let timerPause;
	let playerAudio;
	let tousLesSons;

	let divJeu;
  let divNarrateur;
	let btnDivNarrateur;
	let btnDivNarrateurImg;

	let tableauChoix;
	let tableauChoixMots = { "A" : "", "P" : "", "C" : "", "Y" : ""};
	let chevalier;


	let interfaceChoixChevalier = document.createElement("div");
	let divChoixCheveuxG = document.createElement("div");
	let divChoixYeuxG = document.createElement("div");
	let divChoixPeauG = document.createElement("div");
	let divChoixArmureG = document.createElement("div");
	let divChoixCheveuxD = document.createElement("div");
	let divChoixYeuxD = document.createElement("div");
	let divChoixPeauD = document.createElement("div");
	let divChoixArmureD = document.createElement("div");



/* ! -> À automatiser */
	let tableauParagraphes = new Array();
	//tableauParagraphes.push(new Array("Au fond d’un lac vivaient sept fées, toutes sœurs.",
																		//"La plus jeune d’entre elles, romantique, imaginait la nuit le chevalier de ses rêves…"));
	tableauParagraphes.push(new Array("Par une journée ensoleillé, la benjamine partit se promener aux alentours du lac.",
																		"Cependant, alors qu’elle s’apprêtait à sortir du lac, son regard fut attiré par une silhouette.",
																		"Il s’agissait d’un magnifique jeune homme venu se baigner dans la forêt.",
																		"Il ne fallut pas plus d’un regard à la fée pour tomber sous son charme, tant il ressemblait à celui dont elle rêvait jours et nuits."));
	tableauParagraphes.push(new Array("Alors qu’elle observait le chevalier, l’une de ses sœurs sortit à son tour du lac et surprit son regard.",
																		"Contrariée par l’intérêt de sa benjamine pour cet homme, elle resta dans l’eau à les épier."));
	tableauParagraphes.push(new Array("La nuit venue, alors que la plus jeune fée dormait paisiblement, les six autres s’éclipsèrent discrètement.",
																		"Elles virent le chevalier marcher, un peu plus loin dans la forêt.",
																		"Elles s’approchèrent.",
																		"Et… Elles l’assassinèrent !"));
	tableauParagraphes.push(new Array("Le lendemain, la benjamine partit se promener dans les environs du lac comme à son habitude.",
																		"Sur son chemin, elle tomba sur le cadavre du chevalier. Désespérée, elle le prit dans ses bras et sanglota jusqu’au soir.",
																		"Sans un mot, la fée laissa là son bien aimé et repartit avec son épée en direction du lac."));
	tableauParagraphes.push(new Array("Lorsqu’elle retourna chez elle, ses six sœurs dormaient.",
																		"Elle en profita pour obtenir vengeance pour le chevalier, et trancha la gorge de ses sœurs.",
																		"Le sang coula à flot et se répandit dans l’eau, tant et si bien qu’il imprégna la terre et les roches l’entourant, les colorant de rouge."));

		/* Création du lecteur audio */
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

			/* Enregistrer les éléments du DOM nécessaire à la fonction initialiser */
		tousLesSons = document.querySelectorAll("audio");
		btnDivNarrateur = document.querySelector("#narrateur>div:last-child");
		btnDivNarrateurImg = btnDivNarrateur.querySelector("img");

			/* Ajouter les écouteurs d'événements */
		document.querySelector("#param>div:nth-child(2)").addEventListener("click", lancementSon);
		btnDivNarrateur.addEventListener("click", lancerJeuPersonnalisationChevalier);
		//document.querySelector("#narrateur>div:last-child").addEventListener("click", paragrapheSuivantEvt);

		  /* Ecouteur animation début */
    document.querySelector("#param>div:first-child>img").addEventListener("click", pleinEcran);
    document.querySelector("#param>div:nth-child(2)").addEventListener("click", transitionDebut);

      /* Enregistrer les autres éléments du DOM */
		divNarrateur = document.getElementById("narrateur");
    divJeu = document.getElementById("jeu");
	}

	function lancerJeuPersonnalisationChevalier(evt) {
		if(!playerAudio.paused) {
			playerAudio.pause();
			window.clearInterval(timerPause);
		}
		interrupteurInterfaceNarrateurJeu(1);
		btnDivNarrateur.removeEventListener("click", lancerJeuPersonnalisationChevalier);
		btnDivNarrateur.addEventListener("click", validationPersonnalisationChevalier);
	}

	function validationPersonnalisationChevalier(evt) {
		/*let divValidation = document.createElement("div");
		let p = document.createElement("p");
		p.textContent = "Ce choix vous convient-il ?";
		let btnOui = document.createElement("button");
		btnOui.textContent = "Oui";
		let btnNon = document.createElement("button");
		btnNon.textContent = "Non";*/
		interfaceChoixChevalier.remove();
		interrupteurInterfaceNarrateurJeu(0);
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
			btnDivNarrateur.style.justifyContent = "flex-start";
		} else {
			supprimerParagraphesHistoire();
			divNarrateur.querySelector("img").setAttribute("src", "images/console.svg");
			divNarrateur.querySelector("img").setAttribute("alt", "Manette de jeu");
			divNarrateur.querySelector("h3").textContent = "Jeu";
			btnDivNarrateur.querySelector("p").textContent = "Valider";
			btnDivNarrateur.style.justifyContent = "center";

			switch(numeroJeu) {
				case 1 :
						/* Restyliser #narrateur pour le jeu */
					divNarrateur.style.right = "50%";
					divNarrateur.style.top = "50%";
					divNarrateur.style.transition = "all 1s linear";
					divNarrateur.style.transform = "translateX(50%) translateY(-50%)";
					divNarrateur.style.width = "95%";
					divNarrateur.style.height = "95%";

						/* Créer le tableau des paramètres choisis */
					tableauChoix = {"C" : "O", "Y" : "B", "P" : "B", "A" : "B"};

						/* Ajouter l'interface */
					interfaceChoixChevalier.classList.add("interfaceChoixChevalier")
					divNarrateur.insertBefore(interfaceChoixChevalier, btnDivNarrateur);

						/* Créer les boutons de choix à gauche */
					let divChoixGauche = document.createElement("div");
					divChoixCheveuxG.dataset.parametre = "C";
					divChoixCheveuxG.dataset.couleur = "N";
					divChoixYeuxG.dataset.parametre = "Y";
					divChoixYeuxG.dataset.couleur = "V";
					divChoixPeauG.dataset.parametre = "P";
					divChoixPeauG.dataset.couleur = "N";
					divChoixArmureG.dataset.parametre = "A";
					divChoixArmureG.dataset.couleur = "V";
					interfaceChoixChevalier.appendChild(divChoixGauche);
					divChoixGauche.appendChild(divChoixCheveuxG);
					divChoixGauche.appendChild(divChoixYeuxG);
					divChoixGauche.appendChild(divChoixPeauG);
					divChoixGauche.appendChild(divChoixArmureG);

						/* Créer les boutons de choix à droite */
					let divChoixDroite = document.createElement("div");
					divChoixCheveuxD.dataset.parametre = "C";
					divChoixCheveuxD.dataset.couleur = "R";
					divChoixYeuxD.dataset.parametre = "Y";
					divChoixYeuxD.dataset.couleur = "M";
					divChoixPeauD.dataset.parametre = "P";
					divChoixPeauD.dataset.couleur = "M";
					divChoixArmureD.dataset.parametre = "A";
					divChoixArmureD.dataset.couleur = "R";
					interfaceChoixChevalier.appendChild(divChoixDroite);
					divChoixDroite.appendChild(divChoixCheveuxD);
					divChoixDroite.appendChild(divChoixYeuxD);
					divChoixDroite.appendChild(divChoixPeauD);
					divChoixDroite.appendChild(divChoixArmureD);

						/* Ajouter les boutons de choix */
					for(let i = 0 ; i < 8 ; i++) {
						let img;
						if(i < 4) {
							img = creerImage("images/flecheG.svg", "Flèche vers la gauche", null);
						} else {
							img = creerImage("images/flecheD.svg", "Flèche vers la droite", null);
						}

						let p = document.createElement("p");
						if(i == 0 || i == 5) {
							p.textContent = "Cheveux";
							if(i == 0) {
								divChoixCheveuxG.appendChild(img);
								divChoixCheveuxG.appendChild(p);
							} else {
								divChoixCheveuxD.appendChild(img);
								divChoixCheveuxD.appendChild(p);
							}
						} else if(i == 1 || i == 6) {
							p.textContent = "Yeux";
							if(i == 1) {
								divChoixYeuxG.appendChild(img);
								divChoixYeuxG.appendChild(p);
							} else {
								divChoixYeuxD.appendChild(img);
								divChoixYeuxD.appendChild(p);
							}
						} else if (i == 2 || i == 7) {
							p.textContent = "Peau";
							if(i == 2) {
								divChoixPeauG.appendChild(img);
								divChoixPeauG.appendChild(p);
							} else {
								divChoixPeauD.appendChild(img);
								divChoixPeauD.appendChild(p);
							}
						} else {
							p.textContent = "Armure";
							if(i == 3) {
								divChoixArmureG.appendChild(img);
								divChoixArmureG.appendChild(p);
							} else {
								divChoixArmureD.appendChild(img);
								divChoixArmureD.appendChild(p);
							}
						}
						img.addEventListener("click", changerApparence, false);
					}

						/* Ajouter l'image du chevalier */
					let divChevalier = document.createElement("div");
					chevalier = creerImage("images/aventure/miroirFees/chevalier/debout/A-B_P-B_C-O_Y-B", "Chevalier en armure bleue ayant une peau blanche, des cheveux roux et des yeux bleus", null);
					interfaceChoixChevalier.insertBefore(divChevalier, divChoixDroite);
			    divChevalier.appendChild(chevalier);
					break;
				default : break;
			}
		}
	}

	function changerApparence(evt) {
			/* Enregistrer le changement de choix dans la variable */
		tableauChoix[evt.target.parentNode.dataset.parametre] = evt.target.parentNode.dataset.couleur;
			/* Changer le lien vers l'image */
    chevalier.setAttribute("src", "images/aventure/miroirFees/chevalier/debout/A-"+tableauChoix["A"]+"_P-"+tableauChoix["P"]+"_C-"+tableauChoix["C"]+"_Y-"+tableauChoix["Y"]);
			/* Enregistrer le changement de choix sous forme de mots */
		switch(tableauChoix["A"]) {
			case "B" : tableauChoixMots["A"] = "bleue";
				break;
			case "R" : tableauChoixMots["A"] = "rouge";
				break;
			case "V" : tableauChoixMots["A"] = "verte";
				break;
		}
		switch(tableauChoix["P"]) {
			case "B" : tableauChoixMots["P"] = "blanche";
				break;
			case "M" : tableauChoixMots["P"] = "mate";
				break;
			case "N" : tableauChoixMots["P"] = "noire";
				break;
		}
		switch(tableauChoix["C"]) {
			case "J" : tableauChoixMots["C"] = "blonds";
				break;
			case "N" : tableauChoixMots["C"] = "noirs";
				break;
			case "O" : tableauChoixMots["C"] = "roux";
				break;
			case "R" : tableauChoixMots["C"] = "roses";
				break;
		}
		switch(tableauChoix["Y"]) {
			case "B" : tableauChoixMots["Y"] = "bleus";
				break;
			case "M" : tableauChoixMots["Y"] = "violets";
				break;
			case "N" : tableauChoixMots["Y"] = "noirs";
				break;
			case "V" : tableauChoixMots["Y"] = "verts";
				break;
		}
			/* Changer l'attribut alt de l'image */
    chevalier.setAttribute("alt", "Chevalier en armure "+tableauChoixMots["A"]+" ayant une peau "+tableauChoixMots["P"]+", des cheveux "+tableauChoixMots["C"]+" et des yeux "+tableauChoixMots["Y"]);
			/* Changer la couleur qu'indique chaque flèche */
		switch(evt.target.parentNode.dataset.parametre) {
			case "A" :
				switch(tableauChoix["A"]) {
					case "B" :
						divChoixArmureG.dataset.couleur = "V";
						divChoixArmureD.dataset.couleur = "R";
						break;
					case "R" :
						divChoixArmureG.dataset.couleur = "B";
						divChoixArmureD.dataset.couleur = "V";
						break;
					case "V" :
						divChoixArmureG.dataset.couleur = "R";
						divChoixArmureD.dataset.couleur = "B";
						break;
				}
				break;
			case "P" :
				switch(tableauChoix["P"]) {
					case "B" :
						divChoixPeauG.dataset.couleur = "N";
						divChoixPeauD.dataset.couleur = "M";
						break;
					case "M" :
						divChoixPeauG.dataset.couleur = "B";
						divChoixPeauD.dataset.couleur = "N";
						break;
					case "N" :
						divChoixPeauG.dataset.couleur = "M";
						divChoixPeauD.dataset.couleur = "B";
						break;
				}
				break;
			case "C" :
				switch(tableauChoix["C"]) {
					case "J" :
						divChoixCheveuxG.dataset.couleur = "R";
						divChoixCheveuxD.dataset.couleur = "N";
						break;
					case "N" :
						divChoixCheveuxG.dataset.couleur = "J";
						divChoixCheveuxD.dataset.couleur = "O";
						break;
					case "O" :
						divChoixCheveuxG.dataset.couleur = "N";
						divChoixCheveuxD.dataset.couleur = "R";
						break;
					case "R" :
						divChoixCheveuxG.dataset.couleur = "O";
						divChoixCheveuxD.dataset.couleur = "J";
						break;
				}
				break;
			case "Y" :
				switch(tableauChoix["Y"]) {
					case "B" :
						divChoixYeuxG.dataset.couleur = "V";
						divChoixYeuxD.dataset.couleur = "M";
						break;
					case "M" :
						divChoixYeuxG.dataset.couleur = "B";
						divChoixYeuxD.dataset.couleur = "N";
						break;
					case "N" :
						divChoixYeuxG.dataset.couleur = "M";
						divChoixYeuxD.dataset.couleur = "V";
						break;
					case "V" :
						divChoixYeuxG.dataset.couleur = "N";
						divChoixYeuxD.dataset.couleur = "B";
						break;
				}
				break;
		}
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
			case 1 :
          let vivianeEtMerlin = creerImage("images/merlinViviane.png", "Viviane sur les genous de Merlin", {"position" : "absolute", "height" : "80%", "bottom" : "-10%", "right" : "30vw"});
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

	/*async function lancerEnigme(evt) {
		if(!playerAudio.paused) {
			playerAudio.pause();
			window.clearInterval(timerPause);
			indiceParagrapheCourant++;
		}
		document.querySelector("#narrateur>div:last-child").removeEventListener("click", lancerEnigme);

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
	}*/

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
    document.querySelector("#param>div:last-child>img").setAttribute("src", "images/hautParleur.svg");
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
      } else {
        unSon.volume = 1;
      }
    }
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

	function attendre(temps) {
		return new Promise(function(resolve) {
			setTimeout(function () {
				resolve()
			}, temps);
		})
	}
}());
