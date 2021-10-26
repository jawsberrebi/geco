<?php
include_once("config.php");
include('backend/fonctions.php');

if (!isset($_POST['nom']) || !isset($_POST['prenom']) || !isset($_POST['email'])) {
    header('Location:ajout_patient?erreur=1.php');
    exit();
}

$name = htmlspecialchars($_POST['nom']);
$firstName = htmlspecialchars($_POST['prenom']);
$password = passwordGenerator($pdo); //Générateur de mot de passe aléatoire
$userName = strtolower(substr($firstName, 0 , 1) . $name); //Générateur de nom d'utilisateur : 1ère lettre du prénom + nom. Remplacer $email par la variable contenant le prénom et $password par la variable contenant le nom.
$mail = htmlspecialchars($_POST['email']);
$phone = htmlspecialchars($_POST['telephone']);

if (htmlspecialchars($_POST['type']) == 'patient') {

    $description = htmlspecialchars($_POST['description']);
    $adresse = htmlspecialchars($_POST['adresse']);

    $sql = "SELECT * FROM patient WHERE mail='".$mail."'";
    $pre = $pdo->prepare($sql);
    $pre->execute();
    $user = current($pre->fetchAll(PDO::FETCH_ASSOC));
    $result= $user;
    if($result->results == 0) {
        header('Location:ajout_patient?erreur=2.php');
        exit();
    }

    //INSERER INFOS BDD

} elseif (htmlspecialchars($_POST['type']) == 'infirmier') {

    //COMPLETER

} elseif (htmlspecialchars($_POST['type']) == 'medecin') {

    //COMPLETER

} else {
    header('Location:tableau_de_bord_personnel?erreur=3.php');
    exit();
}

$sql = "SELECT * FROM testuser WHERE Email='".$_POST['nom']."'";
$pre = $pdo->prepare($sql);
$pre->execute();
$user = current($pre->fetchAll(PDO::FETCH_ASSOC));
$result= $user;
if($result->results == 0) {
    header('Location:ajout_patient?erreur=2.php');
    exit();
}

$sql = 'INSERT INTO testuser(Email, Password) VALUES (:Email, :Password)';
$pre = $pdo->prepare($sql);
$pre->execute([
    'Email' => htmlspecialchars($email),
    'Password' => htmlspecialchars($password),
    ]);

header('Location:tableau_de_bord_personnel?confirmation=1.php');
exit();
?>