<?php
include_once("config.php");

if (!isset($_POST['nom']) || !isset($_POST['prenom']) || !isset($_POST['email'])) {
    header('Location:modifier_mon_compte?erreur=1.php');
    exit();
}

$name = htmlspecialchars($_POST['nom']);
$firstName = htmlspecialchars($_POST['prenom']);
$userName = strtolower(substr($firstName, 0 , 1) . $name); //Générateur de nom d'utilisateur : 1ère lettre du prénom + nom. Remplacer $email par la variable contenant le prénom et $password par la variable contenant le nom.
$mail = htmlspecialchars($_POST['email']);
$phone = htmlspecialchars($_POST['telephone']);

if ($_SESSION['userAdmin']) {

    $adresse = htmlspecialchars($_POST['adresse']);
    $city = htmlspecialchars($_POST['ville']);
    $hospitalName = htmlspecialchars($_POST['nom_hopital']);

    $sql = "SELECT * FROM admin WHERE nom_hopital='".$hospitalName."'";
    $pre = $pdo->prepare($sql);
    $pre->execute();
    $user = current($pre->fetchAll(PDO::FETCH_ASSOC));
    $result= $user;
    if($result != 0) {
        header('Location:modifier_mon_compte?erreur=3.php');
        exit();
    }

    //############################" ULTRA CHECKPOINT, MODIFIER TOUT CE QUI EST REQUÊTE SQL POUR TERMINER LE POST MODIFIER MON COMPTE "########################
    //UPDATE INFOS BDD 

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

    header('Location:tableau_de_bord_personnel?confirmation=4.php');
    exit();

} elseif ($_SESSION['userPersonnel'] == 'infirmier') {

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

    header('Location:tableau_de_bord_personnel?confirmation=4.php');
    exit();

} elseif ($_SESSION['userPersonnel'] == 'medecin') {

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

    header('Location:tableau_de_bord_personnel?confirmation=4.php');
    exit();
} elseif ($_SESSION['userPatient']) {

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

    header('Location:tableau_de_bord_personnel?confirmation=4.php');
    exit();

} else {
    header('Location:tableau_de_bord_personnel?erreur=3.php');
    exit();
}

?>