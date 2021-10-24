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

$text =
    'Bonjour, voici vos identifiants GecoSensor :<br />
    Nom d\'utilisateur : ' . $userName . '<br />
    Mot de passe : ' . $realpass . '<br />
    Ne communiquez ces identifiants à personne.';
$text = str_replace("\n.", "\n..", $text);


mail($email, 'Vos identifiants GecoSensor',$text);


?>