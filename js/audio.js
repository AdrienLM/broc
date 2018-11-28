(function() {
	"use strict";
	window.addEventListener("DOMContentLoaded", initialiser);

	var tempsTotal = 99;
	var tempsPasse = 0;
	var timer;

	/* Visualisation des éléments dans le DOM :
		<div nomJS="player" class="player">
			<span nomJS="containerTexte">Lecture : 0:00 / 2:02</span>
			<div nomJS="barreTemps" class="barreTemps">
				<div nomJS="divTempsPasse" class="tempsPasse"></div>
				<div nomJS="curseur" class="curseur"></div>
			</div>
		</div>
	*/
		/* Créer les éléments, leurs attribuer un style (dynamique) et une calsse si besoin */
	var player = document.createElement("div");
	player.classList.add("player");
	var containerTexte = document.createElement("span");
	var barreTemps = document.createElement("div");
	barreTemps.classList.add("barreTemps");
	var divTempsPasse = document.createElement("div");
	divTempsPasse.classList.add("tempsPasse");
	divTempsPasse.style.width = "0";
	var curseur = document.createElement("div");
	curseur.classList.add("curseur");
	curseur.style.left = "0";

	function initialiser(evt) {
			/* Placer les éléments dans le DOM */
		containerTexte.appendChild(document.createTextNode("Lecture : "+transformerSecondesEnMinutesSecondes(tempsPasse)+" / "+transformerSecondesEnMinutesSecondes(tempsTotal)));
		player.appendChild(containerTexte);
		barreTemps.appendChild(divTempsPasse);
		barreTemps.appendChild(curseur);
		player.appendChild(barreTemps);
		document.getElementById("texte").insertBefore(player, document.getElementById("texte").querySelector("p"));
			/* Lancer le timer */
		timer = window.setInterval(timer, 1000);
	}

	function timer() {
		tempsPasse++;
			/* Mettre à jour le texte affiché */
		containerTexte.textContent = "Lecture : "+transformerSecondesEnMinutesSecondes(tempsPasse)+" / "+transformerSecondesEnMinutesSecondes(tempsTotal);
			/* Calculer le pourcentage de temps passé et agrandir/déplacer les éléments dynamiques en conséquence */
		var pourcentage = (tempsPasse * 100 / tempsTotal);
		divTempsPasse.style.width = pourcentage+"%";
		curseur.style.left = pourcentage+"%";
			/* Arrêter le timer */
		if(tempsPasse == tempsTotal) {
			window.clearInterval(timer);
		}
	}

	function transformerSecondesEnMinutesSecondes(tempsInitial) {
		var minutes = Math.floor(tempsInitial / 60);
		var secondes = tempsInitial - 60 * minutes;
		if(secondes<10) {
			var tempsTransforme = minutes+":0"+secondes;
		} else {
			var tempsTransforme = minutes+":"+secondes;
		}
		return tempsTransforme;
	}
}());