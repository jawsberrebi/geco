<?php 
include("fonctions.php");

$email = htmlspecialchars($_POST['email']);
$lastName = htmlspecialchars($_POST['nom']);
$firstName = htmlspecialchars($_POST['prenom']);
$text = htmlspecialchars($_POST['message']);

$finalName = $firstName . ' ' . $lastName;

$champs = array();

array_push($champs, $finalName, $email, $text);

//Ici, j'ai inséré mon adresse email pour recevoir toutes les notifications mail.
//D'ordinaire, pour un déployement final, il faudrait remplacer le premier argument par la variable $email

sendingMail('rd.berrebi@gmail.com', $champs);

header('Location:../accueil.php');
exit();

?>