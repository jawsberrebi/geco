<?php
include_once("config.php");

//######VERIFICATION DE CONNEXION POUR L'ADMINISTRATEUR######\\

//$sql = "SELECT * FROM admin WHERE nom_utilisateur='".$_POST['email_pseudo']."' AND mdp='".$_POST['password']."'";
//$pre = $pdo->prepare($sql);
//$pre->execute();
//$user = current($pre->fetchAll(PDO::FETCH_ASSOC)); //current prend la première ligne du tableau
//$_SESSION['userAdmin'] = $user; //on enregistre que l'utilisateur est connecté (on peut modif)

//if ($_SESSION['userAdmin'] != 0) {
//    header('Location:tableau_de_bord_personnel.php');
//    exit();

//}

//######VERIFICATION DE CONNEXION POUR LE PERSONNEL######\\

$sql = "SELECT * FROM personnel WHERE (nom_utilisateur='".$_POST['email_pseudo']."' OR mail='".$_POST['email_pseudo']."') AND mdp='".$_POST['password']."'";
$pre = $pdo->prepare($sql);
$pre->execute();
$user = current($pre->fetchAll(PDO::FETCH_ASSOC)); //current prend la première ligne du tableau
$_SESSION['userPersonnel'] = $user; //on enregistre que l'utilisateur est connecté (on peut modif)

//A LA FIN FAIRE

//foreach($user as $users){
//    if(password_verify($_POST['password'], $users['mdp'])){

//        $_SESSION['userPatient'] = $users;

//        header('Location:tableau_de_bord_patient.php'); //MODIF LA PAGE
//        exit();
//    }
//}

if ($_SESSION['userPersonnel'] != 0) {
    header('Location:tableau_de_bord_personnel.php');
    exit();

}

//######VERIFICATION DE CONNEXION POUR LE PATIENT######\\

$sql = "SELECT * FROM patient WHERE (nom_utilisateur='".$_POST['email_pseudo']."' OR mail='".$_POST['email_pseudo']."')";
$pre = $pdo->prepare($sql);
$pre->execute();
$user = $pre->fetchAll(PDO::FETCH_ASSOC);
var_dump($user);

foreach($user as $users){
    if(password_verify($_POST['password'], $users['mdp'])){

        $_SESSION['userPatient'] = $users;

        header('Location:tableau_de_bord_patient.php'); //MODIF LA PAGE
        exit();
    }
}

if (isset($_SESSION['userPatient'])) {
    header('Location:tableau_de_bord_patient.php'); //MODIF LA PAGE
    exit();

}
else {
    header('Location:connexion?erreur=1.php');
    exit();
}
?>