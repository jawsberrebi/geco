<?php 
include("fonctions.php");

$email = htmlspecialchars($_POST['email']);
$lastName = htmlspecialchars($_POST['nom']);
$firstName = htmlspecialchars($_POST['prenom']);
$text = htmlspecialchars($_POST['message']);

$finalName = $firstName . ' ' . $lastName;

$champs = array();

array_push($champs, $finalName, $email, $text);

sendingMail('rd.berrebi@gmail.com', $champs);

header('Location:../accueil.php');
exit();

?>