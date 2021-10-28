<?php
include_once("config.php");
include('backend/fonctions.php');

if (!isset($_POST['nom']) || !isset($_POST['prenom']) || !isset($_POST['email'])) {
    header('Location:ajout?erreur=1.php');
    exit();
}

$name = htmlspecialchars($_POST['nom']);
$firstName = htmlspecialchars($_POST['prenom']);
$password = passwordGenerator($pdo, 8); //Générateur de mot de passe aléatoire
$userName = mb_strtolower(mb_substr($firstName, 0 , 1) . $name); //Générateur de nom d'utilisateur : 1ère lettre du prénom + nom. Remplacer $email par la variable contenant le prénom et $password par la variable contenant le nom.
$mail = htmlspecialchars($_POST['email']);
$phone = htmlspecialchars($_POST['telephone']);

if (htmlspecialchars($_POST['type']) == 'patient') {

    $description = htmlspecialchars($_POST['description']);
    $adresse = htmlspecialchars($_POST['adresse']);

    $sql = "SELECT * FROM patient WHERE mail='".$mail."'";
    $pre = $pdo->prepare($sql);
    $pre->execute();
    $user = current($pre->fetchAll(PDO::FETCH_ASSOC));
    $result= $user;
    if($result != 0) {
        header('Location:ajout?type=patient&erreur=2.php');
        exit();
    }

    //INSERER INFOS BDD

    $sql = 'INSERT INTO patient(prenom, nom, mail, tel, adresse, description, mdp, nom_utilisateur) VALUES (:prenom, :nom, :mail, :tel, :adresse, :description, :mdp, :nom_utilisateur)';
    $pre = $pdo->prepare($sql);
    $pre->execute([
        'prenom' => $firstName,
        'nom' => $name,
        'mail' => $mail,
        'tel' => $phone,
        'adresse' => $adresse,
        'description' => $description,
        'mdp' => $password,
        'nom_utilisateur' => $userName,
        ]);

    //DEVELOPPER FONCTIONNALITE D'ENVOI D'IDENTIFIANTS PAR MAIL ICI ET METTRE REDIRECTION VERS FORMULAIRE D'AJOUT SI ÇA MARCHE PAS, SI ÇA MARCHE REDIRIGER VERS LE TABLEAU DE BORD AVEC LE GET QUI AFFICHE MESSAGE DE CONFIRMATION

    header('Location:tableau_de_bord_personnel?confirmation=1.php');
    exit();

} elseif (htmlspecialchars($_POST['type']) == 'infirmier') {

    $sql = "SELECT * FROM personnel WHERE mail='".$mail."'";
    $pre = $pdo->prepare($sql);
    $pre->execute();
    $user = current($pre->fetchAll(PDO::FETCH_ASSOC));
    $result= $user;
    if($result != 0) {
        header('Location:ajout?type=infirmier&erreur=2.php');
        exit();
    }

    $sql = 'INSERT INTO personnel(prenom, nom, mail, tel, type, mdp, nom_utilisateur) VALUES (:prenom, :nom, :mail, :tel, :type, :mdp, :nom_utilisateur)';
    $pre = $pdo->prepare($sql);
    $pre->execute([
        'prenom' => $firstName,
        'nom' => $name,
        'mail' => $mail,
        'tel' => $phone,
        'type' => 'infirmier',
        'mdp' => $password,
        'nom_utilisateur' => $userName,
        ]);

    //DEVELOPPER FONCTIONNALITE D'ENVOI D'IDENTIFIANTS PAR MAIL ICI ET METTRE REDIRECTION VERS FORMULAIRE D'AJOUT SI ÇA MARCHE PAS, SI ÇA MARCHE REDIRIGER VERS LE TABLEAU DE BORD AVEC LE GET QUI AFFICHE MESSAGE DE CONFIRMATION

    header('Location:tableau_de_bord_personnel?confirmation=2.php');
    exit();

} elseif (htmlspecialchars($_POST['type']) == 'medecin') {

    $sql = "SELECT * FROM personnel WHERE mail='".$mail."'"; //UN INFIRMIER PEUT-IL AVOIR À LA FOIS UN COMPTE MEDECIN ET UN COMPTE INFIRMIER ?
    $pre = $pdo->prepare($sql);
    $pre->execute();
    $user = current($pre->fetchAll(PDO::FETCH_ASSOC));
    $result= $user;
    if($result != 0) {
        header('Location:ajout?type=medecin&erreur=2.php');
        exit();
    }

    $sql = 'INSERT INTO personnel(prenom, nom, mail, tel, type, mdp, nom_utilisateur) VALUES (:prenom, :nom, :mail, :tel, :type, :mdp, :nom_utilisateur)';
    $pre = $pdo->prepare($sql);
    $pre->execute([
        'prenom' => $firstName,
        'nom' => $name,
        'mail' => $mail,
        'tel' => $phone,
        'type' => 'medecin',
        'mdp' => $password,
        'nom_utilisateur' => $userName,
        ]);

    //DEVELOPPER FONCTIONNALITE D'ENVOI D'IDENTIFIANTS PAR MAIL ICI ET METTRE REDIRECTION VERS FORMULAIRE D'AJOUT SI ÇA MARCHE PAS, SI ÇA MARCHE REDIRIGER VERS LE TABLEAU DE BORD AVEC LE GET QUI AFFICHE MESSAGE DE CONFIRMATION

    header('Location:tableau_de_bord_personnel?confirmation=3.php');
    exit();

} else {
    header('Location:tableau_de_bord_personnel?erreur=3.php');
    exit();
}

//$sql = "SELECT * FROM testuser WHERE Email='".$_POST['nom']."'";
//$pre = $pdo->prepare($sql);
//$pre->execute();
//$user = current($pre->fetchAll(PDO::FETCH_ASSOC));
//$result= $user;
//if($result->results == 0) {
    //header('Location:ajout_patient?erreur=2.php');
    //exit();
//}

//$sql = 'INSERT INTO testuser(Email, Password) VALUES (:Email, :Password)';
//$pre = $pdo->prepare($sql);
//$pre->execute([
    //'Email' => htmlspecialchars($email),
    //'Password' => htmlspecialchars($password),
    //]);

//header('Location:tableau_de_bord_personnel?confirmation=1.php');
//exit();
?>