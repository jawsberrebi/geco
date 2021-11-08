<?php
include_once("config.php");

//$hashedEntry = password_hash($_POST['password'], PASSWORD_DEFAULT); //Hashage pour comparaison avec la BDD

//$hashedEntry = $_POST['password'];

//$hashedEntry = password_hash($_POST['password'], PASSWORD_DEFAULT); //Hashage pour comparaison avec la BDD

//$hashedEntry = $_POST['password'];

//######VERIFICATION DE CONNEXION POUR L'ADMINISTRATEUR######\\

$sql = "SELECT * FROM admin WHERE nom_utilisateur='".$_POST['email_pseudo']."' AND mdp='".$_POST['password']."'";
$pre = $pdo->prepare($sql);
$pre->execute();
$user = current($pre->fetchAll(PDO::FETCH_ASSOC)); //current prend la première ligne du tableau
$_SESSION['userAdmin'] = $user; //on enregistre que l'utilisateur est connecté (on peut modif)

if ($_SESSION['userAdmin'] != 0) {
    header('Location:tableau_de_bord_personnel.php');
    exit();

}

//######VERIFICATION DE CONNEXION POUR LE PERSONNEL######\\

$sql = "SELECT * FROM personnel WHERE (nom_utilisateur='".$_POST['email_pseudo']."' OR mail='".$_POST['email_pseudo']."') AND mdp='".$_POST['password']."'";
$pre = $pdo->prepare($sql);
$pre->execute();
$user = current($pre->fetchAll(PDO::FETCH_ASSOC)); //current prend la première ligne du tableau
$_SESSION['userPersonnel'] = $user; //on enregistre que l'utilisateur est connecté (on peut modif)

if ($_SESSION['userPersonnel'] != 0) {
    header('Location:tableau_de_bord_personnel.php');
    exit();

}

//######VERIFICATION DE CONNEXION POUR LE PATIENT######\\

$sql = "SELECT * FROM patient WHERE (nom_utilisateur='".$_POST['email_pseudo']."' OR mail='".$_POST['email_pseudo']."') AND mdp='".$_POST['password']."'";
$pre = $pdo->prepare($sql);
$pre->execute();
$user = current($pre->fetchAll(PDO::FETCH_ASSOC)); //current prend la première ligne du tableau
$_SESSION['userPatient'] = $user; //on enregistre que l'utilisateur est connecté (on peut modif)

if ($_SESSION['userPatient'] != 0) {
    header('Location:tableau_de_bord_patient.php'); //MODIF LA PAGE
    exit();

}

else {
    header('Location:connexion?erreur=1.php');
    exit();
}
?>