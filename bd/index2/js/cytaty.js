function Cytaty()
{

var cytaty = ["To, że milczę, nie znaczy, że nie mam nic do powiedzenia.",
			  "Lepiej zaliczać się do niektórych, niż do wszystkich.",
			  "How embarrassing to be human",
			  "Życie jest jak jazda na rowerze. Żeby utrzymać równowagę, musisz być w ciągłym ruchu.",
			  "Dla całego świata możesz być nikim, dla kogoś możesz być całym światem."
			 ];

var authors =["Jonathan Carroll", "Andrzej Sapkowski", "Kurt Vonnegut", "Albert Einstein", "Mały Książę"];

var cytat;
var kolejnyCytat;


function getRandomInt(min, max) {
	kolejnyCytat = parseInt(Math.random() * (max - min) + min);
   	return kolejnyCytat;
}	

getRandomInt(0, cytaty.length);


cytat = document.getElementById("cytat")
cytat.innerHTML = cytaty[kolejnyCytat];

cytat = document.getElementById("authors")
cytat.innerHTML = authors[kolejnyCytat];
}

Cytaty();