<?php
if(!isset($_GET['id_patient']) && !isset($_GET['id_infirmier']) && !isset($_GET['id_medecin'])) {
    header('Location:../tableau_de_bord_personnel?erreur=4.php');
    exit();
}

if(isset($_GET['id_patient'])) {
    $id = $_GET['id_patient'];
}
elseif(isset($_GET['id_infirmier'])) {
    $id = $_GET['id_infirmier'];
}
elseif(isset($_GET['id_medecin'])) {
    $id = $_GET['id_medecin'];
}
?>