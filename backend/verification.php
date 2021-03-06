<?php
include_once("config.php");

//Stopper injection
$usernameEmail = htmlspecialchars($_POST['email_pseudo']);
$password = htmlspecialchars($_POST['password']);


//######VERIFICATION DE CONNEXION POUR LE PERSONNEL######\\

$sql = "SELECT * FROM personnel WHERE (nom_utilisateur=:nom_utilisateur OR mail=:mail)";
$dataBinded = array( //Databinding pour sécuriser failles SQL
    ':mail' => $usernameEmail,
    ':nom_utilisateur' => $usernameEmail,
    );
$pre = $pdo->prepare($sql);
$pre->execute($dataBinded);
$user = $pre->fetchAll(PDO::FETCH_ASSOC);
$_SESSION['userPersonnel'] = $user; //on enregistre que l'utilisateur est connecté (on peut modif)


foreach($user as $users){
    if(password_verify($password, $users['mdp_final'])){

        $_SESSION['userPersonnel'] = $users;

        header('Location:../tableau_de_bord_personnel.php'); //MODIF LA PAGE
        exit();
    }
    else{
        header('Location:../connexion?erreur=1.php');
        exit();
    }
}

//if ($_SESSION['userPersonnel'] != 0) {
//    header('Location:../tableau_de_bord_personnel.php');
//    exit();

//}

//######VERIFICATION DE CONNEXION POUR LE PATIENT######\\

$sql = "SELECT * FROM patient WHERE (nom_utilisateur=:nom_utilisateur OR mail=:mail)";
$dataBinded = array( //Databinding pour sécuriser failles SQL
    ':mail' => $usernameEmail,
    ':nom_utilisateur' => $usernameEmail,
    );
$pre = $pdo->prepare($sql);
$pre->execute($dataBinded);
$user = $pre->fetchAll(PDO::FETCH_ASSOC);


foreach($user as $users){
    if(password_verify($password, $users['mdp_final'])){

        $_SESSION['userPatient'] = $users;
        unset($_SESSION['userPersonnel']);
        header('Location:../tableau_de_bord_patient.php'); //MODIF LA PAGE
        exit();
    }
    else{
        header('Location:../connexion?erreur=1.php');
        exit();
    }
}

if(!isset($_SESSION['userPatient']) && !isset($_SESSION['userPatient'])){
    header('Location:../connexion?erreur=1.php');
    exit();
}

//if (isset($_SESSION['userPatient'])) {
//    header('Location:tableau_de_bord_patient.php'); //MODIF LA PAGE
//    exit();

//}
//else {
//    header('Location:connexion?erreur=1.php');
//    exit();
//}
?>