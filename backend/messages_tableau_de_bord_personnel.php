<?php


//// MESSAGES DE CONFIRMATION
if(isset($_GET['confirmation'])) {
    $confirmation = $_GET['confirmation'];
    if($confirmation==1) {
        echo '<p>Un nouveau patient a bien �t� ajout� � la liste.</p>';
    }
    elseif($confirmation==2) {
                  echo '<p>Un nouvel infirmier a bien �t� ajout� � la liste.</p>';
    }
    elseif($confirmation==3) {
                  echo '<p>Un nouveau m�decin a bien �t� ajout� � la liste.</p>';
    }
    elseif($confirmation==4) {
        echo '<p>Vos informations ont bien �t� modifi�es.</p>';
    }
}

//// MESSAGES D'ERREUR
if(isset($_GET['erreur'])){
    $erreur = $_GET['erreur'];
    if($erreur==1) {
        echo '<p class="message_erreur">Vous n\'�tes pas autoris� � acc�der � ces informations.</p>';
    }
    elseif($erreur==2) {
        echo '<p class="message_erreur">Veuillez cliquer sur le bon bouton renvoyant au formulaire d\'ajout correspondant.</p>';
    }
    elseif($erreur==3) {
        echo '<p class="message_erreur">Il y a eu une erreur lors de l\'envoi des informations. Veuillez r�essayer.</p>';
    }
    elseif($erreur==4) {
        echo '<p class="message_erreur">La page que vous essayez d\'afficher n\'existe pas.</p>';
    }
}
?>