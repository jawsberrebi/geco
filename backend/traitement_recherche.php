<?php


$searchResults = 'Jo';
if(isset($_POST['moteur_recherche']) && !empty($_POST['moteur_recherche'])) {

    $search = preg_replace('#[^a-z _!?0-9]#i', '', $_POST['moteur_recherche']);

    $requete = htmlspecialchars($_POST['moteur_recherche']);

    $sql = "SELECT prenom, nom FROM patient WHERE prenom, nom LIKE %'".$requete."'% ";
    $pre = $pdo->prepare($sql);
    $pre->execute();
    $searchResults = $pre->fetchAll(PDO::FETCH_ASSOC);
}


echo $searchResults;


?>