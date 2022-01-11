<?php
include_once("config.php");
include("backend/fonctions.php");

//Stopper injection
$email = htmlspecialchars($_POST['email']);

//######VERIFICATION DE CONNEXION POUR LE PERSONNEL######\\

$sql = "SELECT * FROM personnel WHERE mail=:mail";
$dataBinded = array( 
    ':mail' => $email,
    );
$pre = $pdo->prepare($sql);
$pre->execute($dataBinded);
$user = current($pre->fetchAll(PDO::FETCH_ASSOC)); //current prend la première ligne du tableau

if ($user != 0) {
    $newPassword = passwordGenerator($pdo, 8);
    $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $sql = "UPDATE personnel SET mdp = :mdp WHERE mail = '".$email."' ";
    $pre = $pdo->prepare($sql);
    $pre->execute([
        ':mdp' => $hashedNewPassword
    ]);

    //INSERER NOUVELLE FONCTION D'ENVOI DE MAIL

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


if ($user != 0) {
    $newPassword = passwordGenerator($pdo, 8);
    $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $sql = "UPDATE patient SET mdp = :mdp WHERE mail = '".$email."' ";
    $pre = $pdo->prepare($sql);
    $pre->execute([
        ':mdp' => $hashedNewPassword
    ]);

    //INSERER NOUVELLE FONCTION D'ENVOI DE MAIL

    exit();
}
else{
    header('Location:mot_de_passe_oublie?erreur=1.php');
    exit();
}

?>