<?php
include_once("config.php");
include('backend/fonctions.php');

if (!isset($_POST['nom']) || !isset($_POST['prenom']) || !isset($_POST['email'])) {
    header('Location:ajout_patient?erreur=1.php');
    exit();
}

$name = $_POST['nom'];
$firstName = $_POST['prenom'];
$password = passwordGenerator($pdo); //Générateur de mot de passe aléatoire
$userName = strtolower(substr($firstName, 0 , 1) . $name); //Générateur de nom d'utilisateur : 1ère lettre du prénom + nom. Remplacer $email par la variable contenant le prénom et $password par la variable contenant le nom.

if ($_POST['type'] == 'patient') {

} elseif ($_POST['type'] == 'infirmier') {

} elseif ($_POST['type'] == 'medecin') {

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