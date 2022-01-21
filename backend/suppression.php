<?php
include_once("config.php");
include("conditions_accès_page_personnel_et_admin.php");

if(isset($_SESSION['userPersonnel'])) {
    if($_SESSION['userPersonnel']['type'] != 'medecin' && $_SESSION['userPersonnel']['type'] != 'admin') {
        header('Location:../tableau_de_bord_personnel?erreur=1');
        exit();
    }
}

include('conditions_id.php');


if(isset($_GET['id_patient'])) {

    $sql = "DELETE FROM patient WHERE id_patient='".$id."'";
    $pre = $pdo->prepare($sql);
    $pre->execute();

    header('Location:../tableau_de_bord_personnel?confirmation=5.php');
    exit();
}
elseif(isset($_GET['id_infirmier'])) {
    $sql = "DELETE FROM personnel WHERE id_personnel='".$id."'";
    $pre = $pdo->prepare($sql);
    $pre->execute();

    header('Location:../tableau_de_bord_personnel?confirmation=5.php');
    exit();
}
elseif(isset($_GET['id_medecin'])) {

    if($_SESSION['userPersonnel']['type'] != 'admin') {

        header('Location:../tableau_de_bord_personnel?erreur=1');
        exit();
    }

    $sql = "DELETE FROM personnel WHERE id_personnel='".$id."'";
    $pre = $pdo->prepare($sql);
    $pre->execute();

    header('Location:../tableau_de_bord_personnel?confirmation=5.php');
    exit();
}


?>