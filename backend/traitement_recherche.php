<?php
require_once "config.php";

if(isset($_GET['moteur_recherche']) && !empty($_GET['moteur_recherche'])) {
    $search = htmlspecialchars($_GET['moteur_recheche']);

    $sql = 'SELECT prenom, nom FROM patient WHERE prenom, nom LIKE "%'.$search.'%" ';
    $pre = $pdo->prepare($sql);
    $pre->execute();
    $searchResults = $pre->fetchAll(PDO::FETCH_ASSOC);

}



?>