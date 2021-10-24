<?php
include_once("config.php");
include('backend/fonctions.php');

if (!isset($_POST['nom']) || !isset($_POST['prenom']) || !isset($_POST['email'])) {
    header('Location:connexion?erreur=1.php');
    exit();
}

$email = $_POST['nom'];
$password = $_POST['prenom'];
$realpass = passwordGenerator($pdo); //Générateur de mot de passe aléatoire
$userName = strtolower(substr($email, 0 , 1) . $password); //Générateur de nom d'utilisateur : 1ère lettre du prénom + nom. Remplacer $email par la variable contenant le prénom et $password par la variable contenant le nom.



$sql = 'INSERT INTO testuser(Email, Password) VALUES (:Email, :Password)';
$pre = $pdo->prepare($sql);
$pre->execute([
    'Email' => htmlspecialchars($email),
    'Password' => htmlspecialchars($password),
    ]);

header('Location:tableau_de_bord_personnel?confirmation=1.php');
exit();
?>