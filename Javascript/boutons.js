/* Fonction permettant de montrer la liste d'action après un clique sur le bouton*/
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Fonction permettant de fermer la liste d'action lors d'un clique en dehors de la liste
window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {

        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
        }
        }
    }
}