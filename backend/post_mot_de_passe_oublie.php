<?php
include_once("config.php");
include("backend/fonctions.php");

//Stopper injection
$email = htmlspecialchars($_POST['email']);

//######VERIFICATION DE CONNEXION POUR LE PERSONNEL######\\

$sql = "SELECT * FROM personnel WHERE mail=:mail";
$dataBinded = array( //Databinding pour sécuriser failles SQL
    ':mail' => $email,
    );
$pre = $pdo->prepare($sql);
$pre->execute($dataBinded);
$user = current($pre->fetchAll(PDO::FETCH_ASSOC)); //current prend la première ligne du tableau

if ($user != 0) {
    $newPassword = passwordGenerator($pdo, 8);
    $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $sql = "UPDATE personnel SET mdp = :mdp WHERE mail = '".$user['mail']."' ";
    $pre = $pdo->prepare($sql);
    $pre->execute([
        ':mdp' => $hashedNewPassword
    ]);

    //INSERER NOUVELLE FONCTION D'ENVOI DE MAIL
}

/////
/////CHECKPOINT, À CONTINUER
/////


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
    if(password_verify($password, $users['mdp'])){

        $_SESSION['userPatient'] = $users;
        unset($_SESSION['userPersonnel']);
        header('Location:tableau_de_bord_patient.php'); //MODIF LA PAGE
        echo 'yes';
        exit();
    }
    else{
        header('Location:connexion?erreur=1.php');
        exit();
    }
}

if(!isset($_SESSION['userPatient']) && !isset($_SESSION['userPatient'])){
    header('Location:connexion?erreur=1.php');
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