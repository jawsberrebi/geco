<?php

if(!isset($_GET['char'])){
    header('Location:../connexion?erreur=5.php');
    exit();
}

if(!isset($_GET['type'])){
    header('Location:../connexion?erreur=5.php');
    exit();
}

if(!isset($_GET['user'])){
    header('Location:../connexion?erreur=5.php');
    exit();
}

$type = $_GET['type'];

if($_GET['type'] == 'patient.php'){
    $sql = "SELECT mdp_final FROM patient WHERE mdp=:mdp";
    $dataBinded = array( //Databinding pour s�curiser failles SQL
        ':mdp' => $_GET['char'],
        );
    $pre = $pdo->prepare($sql);
    $pre->execute($dataBinded);
    $currentPassword = $pre->fetchAll(PDO::FETCH_ASSOC); //current prend la premi�re ligne du tableau
}
elseif($_GET['type'] == 'personnel.php'){
    

    $sql = "SELECT mdp_final FROM personnel WHERE mdp=:mdp";
    $dataBinded = array( //Databinding pour s�curiser failles SQL
        ':mdp' => $_GET['char'],
        );
    $pre = $pdo->prepare($sql);
    $pre->execute($dataBinded);
    $currentPassword = $pre->fetchAll(PDO::FETCH_ASSOC); //current prend la premi�re ligne du tableau
}
else{
    header('Location:../connexion?erreur=5.php');
    exit();
}

if(!empty($currentPassword[0]['mdp_final'])){
    header('Location:../connexion?erreur=5.php');
    exit();
}

?>