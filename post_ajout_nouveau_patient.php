<?php
include_once("config.php");
include('backend/fonctions.php');

if (!isset($_POST['nom']) || !isset($_POST['prenom']) || !isset($_POST['email'])) {
    header('Location:ajout_patient?erreur=1.php');
    exit();
}

$email = $_POST['nom'];
$password = $_POST['prenom'];
$realpass = passwordGenerator($pdo); //G�n�rateur de mot de passe al�atoire
$userName = strtolower(substr($email, 0 , 1) . $password); //G�n�rateur de nom d'utilisateur : 1�re lettre du pr�nom + nom. Remplacer $email par la variable contenant le pr�nom et $password par la variable contenant le nom.


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