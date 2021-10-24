<?php
include_once("config.php");

function passwordGenerator(PDO $pdo) : string
{
    $realpass = bin2hex(random_bytes(8));
    $compareQuery = 'SELECT Password FROM testuser';
    $pre = $pdo->prepare($compareQuery);
    $pre->execute();
    $compare = $pre->fetchAll(PDO::FETCH_ASSOC);

    foreach ($compare as $list_result) {

        while ($realpass == $list_result['Password']) {

            $realpass = bin2hex(random_bytes(8));
        }
    }

    return $realpass;
}
?>