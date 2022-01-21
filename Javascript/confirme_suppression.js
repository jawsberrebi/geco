function confirme_suppression(){
    var result = confirm("Voulez-vous vraiment supprimer ce profil ?");
    if (result == true) {
        alert("Le profil va bien se supprimer.");
        return true;
    }
    else {
        alert("Suppression annulée.");
        return false;
    }
}