function creerUnCookie(nomCookie, valeurCookie,dureeJours) {
    console.log("Ecire Cookie : " + nomCookie);
    // Si le nombre de jour est spécifié
    if (dureeJours) {
        var date = new Date();
        // Converti le nombre de jours spécifiés en millisecondes
        date.setTime(date.getTime()+ (dureeJours * 24*60*60*1000));
        var expire = "; expires=" + date.toGMTString();
    }
    else 
        var expire= "";// Si aucune valeur de jour n'est spécifiée 
 
    document.cookie = nomCookie + "=" + valeurCookie + expire + ";path=/";
}

function lireUnCookie(nomCookie) {
    console.log("Lire Cookie : " + nomCookie);


    // Ajoute le signe égale virgule au nom pour la recherche dans le tableau contenant tous les 
    // coolies
    var nomFormate = nomCookie + "=";
    // Tableau contenant tous les cookies
    var tableauCookies = document.cookie.split(";");
    console.log("Les cookies : ");
    console.log(tableauCookies);
    for (let i = 0; i < tableauCookies.length; i++) {
        var cookieTrouve = tableauCookies[i];
        // Tant que l'on trouve un espace on le supprime
        while (cookieTrouve.charAt(0) == ' ') {
            cookieTrouve = cookieTrouve.substring(1, cookieTrouve.length);
        }
        if (cookieTrouve.indexOf(nomFormate) == 0) {
            return cookieTrouve.substring(nomFormate.length);
        }

    }
    // On retourne une valeur null dans le cas au aucun cookie n'est trouvé
    return null;
    
}

// Création d'une fonction que l'on va associer au bouton OUI de notre MODAL 
function accepterLeDisclaimer() {
    creerUnCookie("eu-diclaimer-vapobar", "ejD86j7ZXF3x", 1);
    var cookie= lireUnCookie("eu-diclaimer-vapobar");
    alert(cookie);
}
console.log("PRGM PRINCIPAL 1");
$(document).ready(function() {
    console.log("PRGM PRINCIPAL 2");
    if (lireUnCookie("eu-diclaimer-vapobar") != "ejD86j7ZXF3x")  {
        console.log("Modal");
        document.getElementById("actionDisclaimer").addEventListener("click", accepterLeDisclaimer);
        $("#monModal").modal({
            escapeClose: false,
            clickClose: false,
            showClose: false
        });
    }
    }   
)


