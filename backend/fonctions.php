<?php
include_once("config.php");

function passwordGenerator(PDO $pdo, int $length) : string
{

    function randomizer(int $length) : string
    {
        $charList = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $finalChar = '';
        for($i=0; $i<$length; $i++){
            $finalChar .= $charList[rand(0, strlen($charList)-1)];
        }
        return $finalChar;
    }

    $realpass = randomizer(8);
    $compareQuery = 'SELECT mdp FROM patient';
    $pre = $pdo->prepare($compareQuery);
    $pre->execute();
    $compare = $pre->fetchAll(PDO::FETCH_ASSOC);

    foreach ($compare as $list_result) {

        while ($realpass == $list_result['mdp']) {

            $realpass = randomizer($length);
        }
    }

    $compareQuery = 'SELECT mdp FROM personnel';
    $pre = $pdo->prepare($compareQuery);
    $pre->execute();
    $compare = $pre->fetchAll(PDO::FETCH_ASSOC);

    foreach ($compare as $list_result) {

        while ($realpass == $list_result['mdp']) {

            $realpass = randomizer($length);
        }
    }

    return $realpass;
}
?>