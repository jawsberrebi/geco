<?php
include_once("config.php");

if (!isset($_POST['nom']) || $_POST['prenom']) {
    echo 'Veuillez rentrer les informations demandées.';
}

$email = $_POST['nom'];
$password = $_POST['prenom'];

$sql = 'INSERT INTO testuser(Email, Password) VALUES (:Email, :Password)';
$pre = $pdo->prepare($sql);
$pre->execute([
    'Email' => $email,
    'Password' => $password,
    ]);

header('Location:tableau_de_bord_personnel.php');
exit();
?>