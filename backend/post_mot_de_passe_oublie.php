<?php
include_once("config.php");
include("fonctions.php");

//Stopper injection
$email = htmlspecialchars($_POST['email']);

//######VERIFICATION DE CONNEXION POUR LE PERSONNEL######\\

$sql = "SELECT * FROM personnel WHERE mail=:mail";
$dataBinded = array( 
    ':mail' => $email,
    );
$pre = $pdo->prepare($sql);
$pre->execute($dataBinded);
$user = $pre->fetchAll(PDO::FETCH_ASSOC); //current prend la première ligne du tableau

if ($user == true) {
    $userName = $user[0]['nom_utilisateur'];
    $newPassword = passwordGenerator($pdo, 8);
    $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $sql = "UPDATE personnel SET mdp = :mdp WHERE mail = '".$email."' ";
    $pre = $pdo->prepare($sql);
    $pre->execute([
        ':mdp' => $hashedNewPassword
    ]);

    $sql = "UPDATE personnel SET mdp_final = :mdp WHERE mail = '".$email."' ";
    $pre = $pdo->prepare($sql);
    $pre->execute([
        ':mdp' => ''
    ]);

    $champs = array();

    array_push($champs, $hashedNewPassword, $userName,'personnel');

    sendingLinkPassword('rd.berrebi@gmail.com', $champs);

    header('Location:../connexion?confirmation=2.php');
    exit();
}


//######VERIFICATION DE CONNEXION POUR LE PATIENT######\\

$sql = "SELECT * FROM patient WHERE mail=:mail";
$dataBinded = array(
    ':mail' => $email,
    );
$pre = $pdo->prepare($sql);
$pre->execute($dataBinded);
$user = $pre->fetchAll(PDO::FETCH_ASSOC);

if ($user == true) {
    $userName = $user[0]['nom_utilisateur'];
    $newPassword = passwordGenerator($pdo, 8);
    $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $sql = "UPDATE patient SET mdp = :mdp WHERE mail = '".$email."' ";
    $pre = $pdo->prepare($sql);
    $pre->execute([
        ':mdp' => $hashedNewPassword
    ]);

    $sql = "UPDATE patient SET mdp_final = :mdp WHERE mail = '".$email."' ";
    $pre = $pdo->prepare($sql);
    $pre->execute([
        ':mdp' => ''
    ]);

    $champs = array();

    array_push($champs, $hashedNewPassword, $userName,'patient');

    sendingLinkPassword('rd.berrebi@gmail.com', $champs);

    header('Location:../connexion?confirmation=2.php');
    exit();
}
else{
    header('Location:../mot_de_passe_oublie?erreur=1.php');
    exit();
}

?>