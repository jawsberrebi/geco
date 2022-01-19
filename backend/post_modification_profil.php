<?php 
include_once("config.php");

if (!isset($_POST['nom']) || !isset($_POST['prenom']) || !isset($_POST['email'])) {
    header('modification_profil?erreur=1.php');
    exit();
}

////// RÉCUPÉRATION DES ÉLÉMENTS DE FORMULAIRE
$name = htmlspecialchars($_POST['nom']);
$firstName = htmlspecialchars($_POST['prenom']);
$userName = mb_strtolower(mb_substr($firstName, 0 , 1) . $name); //Générateur de nom d'utilisateur : 1ère lettre du prénom + nom. Remplacer $email par la variable contenant le prénom et $password par la variable contenant le nom.
$mail = htmlspecialchars($_POST['email']);
$phone = htmlspecialchars($_POST['telephone']);
$type = htmlspecialchars($_POST['type']);
$id = htmlspecialchars($_POST['id']);
$idHospital = $_SESSION['userPersonnel']['id_hopital'];

if($type == 'patient'){

    $adresse = htmlspecialchars($_POST['adresse']);
    $description = htmlspecialchars($_POST['description']);

    $sql = "SELECT * FROM patient WHERE mail='".$mail."' AND id_patient != '".$id."' ";
    $pre = $pdo->prepare($sql);
    $pre->execute();
    $user = current($pre->fetchAll(PDO::FETCH_ASSOC));
    $result= $user;
    if($result != 0) {
        header('Location:../modification_profil?id_patient=' . $id . '&erreur=2.php');
        exit();
    }

    $sql = " UPDATE patient SET prenom = :prenom, nom = :nom, mail = :mail, tel = :tel, adresse = :adresse, description = :description ,nom_utilisateur = :nom_utilisateur WHERE id_patient = '".$id."' AND id_hopital = '" . $idHospital ."'";
    $pre = $pdo->prepare($sql);
    $pre->execute([
        ':prenom' => $firstName,
        ':nom' => $name,
        ':mail' => $mail,
        ':tel' => $phone,
        ':adresse' => $adresse,
        ':description' => $description,
        ':nom_utilisateur' => $userName,
        ]);

    header('Location:../profil?id_patient=' . $id . '.php');
    exit();
    
}elseif($type == 'infirmier'){

    $sql = "SELECT * FROM personnel WHERE mail='".$mail."' AND id_personnel != '".$id."' ";
    $pre = $pdo->prepare($sql);
    $pre->execute();
    $user = current($pre->fetchAll(PDO::FETCH_ASSOC));
    $result= $user;
    if($result != 0) {
        header('Location:../modification_profil?id_infirmier=' . $id . '&erreur=2.php');
        exit();
    }

    $sql = "UPDATE personnel SET prenom = :prenom, nom = :nom, mail = :mail, tel = :tel, nom_utilisateur = :nom_utilisateur WHERE id_personnel = '".$id."' AND id_hopital = '" . $idHospital ."'";
    $pre = $pdo->prepare($sql);
    $pre->execute([
        ':prenom' => $firstName,
        ':nom' => $name,
        ':mail' => $mail,
        ':tel' => $phone,
        ':nom_utilisateur' => $userName,
        ]);

    header('Location:../profil?id_infirmier=' . $id . '.php');
    exit();
    
}elseif($type == 'medecin'){

    $sql = "SELECT * FROM personnel WHERE mail='".$mail."' AND id_personnel != '".$id."' ";
    $pre = $pdo->prepare($sql);
    $pre->execute();
    $user = current($pre->fetchAll(PDO::FETCH_ASSOC));
    $result= $user;
    if($result != 0) {
        header('Location:../modification_profil?id_medecin=' . $id . '&erreur=2.php');
        exit();
    }

    $sql = "UPDATE personnel SET prenom = :prenom, nom = :nom, mail = :mail, tel = :tel, nom_utilisateur = :nom_utilisateur WHERE id_personnel = '".$id."' AND id_hopital = '" . $idHospital ."'";
    $pre = $pdo->prepare($sql);
    $pre->execute([
        ':prenom' => $firstName,
        ':nom' => $name,
        ':mail' => $mail,
        ':tel' => $phone,
        ':nom_utilisateur' => $userName,
        ]);

    header('Location:../profil?id_medecin=' . $id . '.php');
    exit();
    
}else{

    header('Location:../tableau_de_bord_personnel?erreur=3.php');
    exit();
    
}

?>