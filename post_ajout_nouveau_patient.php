<?php
include_once("config.php");
include('backend/fonctions.php');

if (!isset($_POST['nom']) || $_POST['prenom']) {
    echo 'Veuillez rentrer les informations demand�es.';
}

$email = $_POST['nom'];
$password = $_POST['prenom'];
$realpass = passwordGenerator($pdo); //G�n�rateur de mot de passe al�atoire
$userName = strtolower(substr($email, 0 , 1) . $password); //G�n�rateur de nom d'utilisateur : 1�re lettre du pr�nom + nom. Remplacer $email par la variable contenant le pr�nom et $password par la variable contenant le nom.



$sql = 'INSERT INTO testuser(Email, Password) VALUES (:Email, :Password)';
$pre = $pdo->prepare($sql);
$pre->execute([
    'Email' => $email,
    'Password' => $password,
    ]);

header('Location:tableau_de_bord_personnel.php');
exit();
?>