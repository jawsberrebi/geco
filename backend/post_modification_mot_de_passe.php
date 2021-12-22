<?php 
require_once "config.php";

$idChar = htmlspecialchars($_POST['char']);
$username = htmlspecialchars($_POST['user']);
$firstPassword = htmlspecialchars($_POST['firstPassword']);
$secondPassword = htmlspecialchars($_POST['secondPassword']);
$type = htmlspecialchars($_POST['type']);

if(empty($type)){
    header('Location:../connexion?erreur=5.php');
    exit();

}


if($firstPassword != $secondPassword){
    header('Location:../modification_mot_de_passe?char=' . $idChar . '&user=' . $username . '&type=' . $type . '.php&erreur=1.php');
    exit();
}

if(empty($idChar)){
   
    header('Location:../modification_mot_de_passe?char=' . $idChar . '&user=' . $username . '&type=' . $type . '.php&erreur=1.php');
    exit();

    if(empty($username)){

        header('Location:../modification_mot_de_passe?char=' . $idChar . '&user=' . $username . '&type=' . $type . '.php&erreur=1.php');
        exit();
        
        if(empty($firstPassword)){

            header('Location:../modification_mot_de_passe?char=' . $idChar . '&user=' . $username . '&type=' . $type . '.php&erreur=2.php');
            exit();

            if(empty($secondPassword)){

                header('Location:../modification_mot_de_passe?char=' . $idChar . '&user=' . $username . '&type=' . $type . '.php&erreur=2.php');
                exit();
    
            }
        }
    } 
}

if($type == 'patient'){
    $sql = "SELECT mdp_final FROM patient WHERE mdp=:mdp AND nom_utilisateur=:nom_utilisateur";
    $dataBinded = array( 
        ':mdp' => $idChar,
        ':nom_utilisateur' => $username,
        );
    $pre = $pdo->prepare($sql);
    $pre->execute($dataBinded);
    $currentPassword = current($pre->fetchAll(PDO::FETCH_ASSOC));

    if(!empty($currentPassword[0]['mdp_final'])){
        header('Location:../connexion?erreur=5.php');
        exit();
    }
    else{
        $sql = "UPDATE patient SET mdp_final = :mdp_final WHERE mdp=:mdp AND nom_utilisateur=:nom_utilisateur";
        $pre = $pdo->prepare($sql);
        $pre->execute([
            ':mdp' => $idChar,
            ':nom_utilisateur' => $username,
            ':mdp_final' => $secondPassword,
            ]);
        header('Location:../connexion?confirmation=1.php');
        exit();
    }
}
elseif($type == 'personnel'){
    $sql = "SELECT mdp_final FROM patient WHERE mdp=:mdp AND nom_utilisateur=:nom_utilisateur";
    $dataBinded = array( 
        ':mdp' => $idChar,
        ':nom_utilisateur' => $username,
        );
    $pre = $pdo->prepare($sql);
    $pre->execute($dataBinded);
    $currentPassword = current($pre->fetchAll(PDO::FETCH_ASSOC));

    if(!empty($currentPassword[0]['mdp_final'])){
        header('Location:../connexion?erreur=5.php');
        exit();
    }
    else{
        $sql = "UPDATE personnel SET mdp_final = :mdp_final WHERE mdp=:mdp AND nom_utilisateur=:nom_utilisateur";
        $pre = $pdo->prepare($sql);
        $pre->execute([
            ':mdp' => $idChar,
            ':nom_utilisateur' => $username,
            ':mdp_final' => $secondPassword,
            ]);
        header('Location:../connexion?confirmation=1.php');
        exit();
    }
}
else{
    //header('Location:../connexion?erreur=5.php');
    //exit();
    echo 'ah';
}




?>