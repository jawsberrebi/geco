<?php
if (!isset($_SESSION['userAdmin']) && !isset($_SESSION['userPersonnel'])) {

    if(isset($_SESSION['userPatient'])) {

        session_destroy();
        header('Location:connexion?erreur=4.php');
        exit();

    }

    session_destroy();
    header('Location:connexion?erreur=3.php');
    exit();
}

?>