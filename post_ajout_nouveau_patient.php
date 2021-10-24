<?php
include_once("config.php");
include('backend/fonctions.php');

if (!isset($_POST['nom']) || $_POST['prenom']) {
    echo 'Veuillez rentrer les informations demandées.';
}

$email = $_POST['nom'];
$password = $_POST['prenom'];
$realpass = passwordGenerator($pdo); //Générateur de mot de passe aléatoire
$userName = strtolower(substr($email, 0 , 1) . $password); //Générateur de nom d'utilisateur : 1ère lettre du prénom + nom. Remplacer $email par la variable contenant le prénom et $password par la variable contenant le nom.



$sql = 'INSERT INTO testuser(Email, Password) VALUES (:Email, :Password)';
$pre = $pdo->prepare($sql);
$pre->execute([
    'Email' => $email,
    'Password' => $password,
    ]);

header('Location:tableau_de_bord_personnel.php');
exit();
?>