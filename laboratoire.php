<?php

include('backend/fonctions.php');
$realpass = passwordGenerator($pdo);



$mdp = bin2hex(random_bytes(8));

$compareQuery = 'SELECT Password FROM testuser';
$pre = $pdo->prepare($compareQuery);
$pre->execute();
$compare = $pre->fetchAll(PDO::FETCH_ASSOC);



foreach ($compare as $list_result) {

    while ($mdp == $list_result['Password']) {

        $mdp = bin2hex(random_bytes(8));
    }
}

$Yes = "Lérôme";
$No = "Zacharia";

$userName = strtolower(substr($Yes, 0 , 1) . $No);

$email = 'berjaws@gmail.com';

$destinataires = "berjaws@gmail.com";
$sujet = "Bienvenue sur Tutovisuel";
$sujet = '=?UTF-8?B?'.base64_encode($sujet).'?=';

// Version MINE
$entetes = "MIME-Version: 1.0\n";

// en-têtes expéditeur
$entetes .= "From : berjaws@gmail.com\n";

// en-têtes adresse de retour
$entetes .= "Reply-to : berjaws@gmail.com\n";

// priorité urgente
$entetes .= "X-Priority : 1\n";

// type de contenu HTML
$entetes .= "Content-type: text/html; charset=utf-8\n";

// code de transportage
$entetes .= "Content-Transfer-Encoding: 8bit\n";

// message HTML
$message = '<h1> Titre </h1> <p> paragraphe contenant
une image : <img src="https://tutowebdesign.com/images/image.jpg" alt="" /> </p>';

$maybe = mail($destinataires, $sujet, $message, $entetes);
echo $maybe;
?>