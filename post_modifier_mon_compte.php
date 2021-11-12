<?php
include_once("config.php");

if (!isset($_POST['nom']) || !isset($_POST['prenom'])) {
    header('Location:modifier_mon_compte?erreur=1.php');
    exit();
}




////// R�CUP�RATION DES �L�MENTS DE FORMULAIRE
$name = htmlspecialchars($_POST['nom']);
$firstName = htmlspecialchars($_POST['prenom']);
$userName = mb_strtolower(mb_substr($firstName, 0 , 1) . $name); //G�n�rateur de nom d'utilisateur : 1�re lettre du pr�nom + nom. Remplacer $email par la variable contenant le pr�nom et $password par la variable contenant le nom.
$mail = htmlspecialchars($_POST['email']);
$phone = htmlspecialchars($_POST['telephone']);

/////////////                                                                   \\\\\\\\\\\\\\\\\\\\\\\\\\\\\
///////////// DANS LE CAS O� L'ADMIN ACC�DE � LA PAGE DE MODIFICATION DE COMPTE \\\\\\\\\\\\\\\\\\\\\\\\\\\\\
////////////                                                                     \\\\\\\\\\\\\\\\\\\\\\\\\\\\\
if ($_SESSION['userPersonnel']['type'] == 'admin') {

    $adresse = htmlspecialchars($_POST['adresse']);
    $city = htmlspecialchars($_POST['ville']);
    $hospitalName = htmlspecialchars($_POST['nom_hopital']);

    $sql = "SELECT * FROM personnel WHERE nom_hopital='".$hospitalName."' AND id_personnel != '".$_SESSION['userPersonnel']['id_personnel']."'"; //AJOUTER CONDITION POUR PAS REPERER ID ADMIN
    $pre = $pdo->prepare($sql);
    $pre->execute();
    $user = current($pre->fetchAll(PDO::FETCH_ASSOC));
    $result= $user;
    if($result != 0) {
        header('Location:modifier_mon_compte?erreur=3.php');
        exit();
    }

    $sql = "UPDATE personnel SET prenom = :prenom, nom = :nom, adresse = :adresse, ville = :ville, nom_hopital = :nom_hopital WHERE id_personnel = '".$_SESSION['userPersonnel']['id_personnel']."' ";
    $pre = $pdo->prepare($sql);
    $pre->execute([
        'prenom' => $firstName,
        'nom' => $name,
        'adresse' => $adresse,
        'ville' => $city,
        'nom_hopital' => $hospitalName,
        'mail' => $mail,
        'tel' => $phone
        ]);

    $_SESSION['userPersonnel']['prenom'] = $firstName;
    $_SESSION['userPersonnel']['nom'] = $name;
    $_SESSION['userPersonnel']['adresse'] = $adresse;
    $_SESSION['userPersonnel']['ville'] = $city;
    $_SESSION['userPersonnel']['nom_hopital'] = $hospitalName;
    $_SESSION['userPersonnel']['mail'] = $mail;
    $_SESSION['userPersonnel']['mail'] = $phone;

    header('Location:tableau_de_bord_personnel?confirmation=4.php');
    exit();


    /////////////                                                                                  \\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    ///////////// DANS LE CAS O� UN MEMBRE DU PERSONNEL ACC�DE � LA PAGE DE MODIFICATION DE COMPTE \\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    ////////////                                                                                    \\\\\\\\\\\\\\\\\\\\\\\\\\\\\

} elseif ($_SESSION['userPersonnel'] != 'admin') {

    //UPDATE INFOS BDD

    $sql = "SELECT * FROM personnel WHERE mail='".$mail."' AND id_personnel != '".$_SESSION['userPersonnel']['id_personnel']."'";
    $pre = $pdo->prepare($sql);
    $pre->execute();
    $user = current($pre->fetchAll(PDO::FETCH_ASSOC));
    $result= $user;
    if($result != 0) {
        header('Location:modifier_mon_compte?erreur=2.php');
        exit();
    }

    $sql = "UPDATE personnel SET prenom = :prenom, nom = :nom, mail = :mail, tel = :tel, nom_utilisateur = :nom_utilisateur WHERE id_personnel = '".$_SESSION['userPersonnel']['id_personnel']."' ";
    $pre = $pdo->prepare($sql);
    $pre->execute([
        'prenom' => $firstName,
        'nom' => $name,
        'mail' => $mail,
        'tel' => $phone,
        'nom_utilisateur' => $userName,
        ]);

    $_SESSION['userPersonnel']['prenom'] = $firstName;
    $_SESSION['userPersonnel']['nom'] = $name;
    $_SESSION['userPersonnel']['mail'] = $mail;
    $_SESSION['userPersonnel']['tel'] = $phone;
    $_SESSION['userPersonnel']['nom_utilisateur'] = $userName;

    header('Location:tableau_de_bord_personnel?confirmation=4.php');
    exit();

    /////////////                                                                      \\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    ///////////// DANS LE CAS O� UN PATIENT ACC�DE � LA PAGE DE MODIFICATION DE COMPTE \\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    ////////////                                                                        \\\\\\\\\\\\\\\\\\\\\\\\\\\\\

} elseif ($_SESSION['userPatient']) {

    $adresse = htmlspecialchars($_POST['adresse']);

    $sql = "SELECT * FROM patient WHERE mail='".$mail."' AND id_patient != '".$_SESSION['userPatient']['id_patient']."' ";
    $pre = $pdo->prepare($sql);
    $pre->execute();
    $user = current($pre->fetchAll(PDO::FETCH_ASSOC));
    $result= $user;
    if($result != 0) {
        header('Location:modifier_mon_compte?erreur=2.php');
        exit();
    }

    $sql = " UPDATE patient SET prenom = :prenom, nom = :nom, mail = :mail, tel = :tel, adresse = :adresse,nom_utilisateur = :nom_utilisateur WHERE id_patient = '".$_SESSION['userPatient']['id_patient']."' ";
    $pre = $pdo->prepare($sql);
    $pre->execute([
        'prenom' => $firstName,
        'nom' => $name,
        'mail' => $mail,
        'tel' => $phone,
        'adresse' => $adresse,
        'nom_utilisateur' => $userName,
        ]);

    $_SESSION['userPatient']['prenom'] = $firstName;
    $_SESSION['userPatient']['nom'] = $name;
    $_SESSION['userPatient']['mail'] = $mail;
    $_SESSION['userPatient']['tel'] = $phone;
    $_SESSION['userPatient']['adresse'] = $adresse;
    $_SESSION['userPatient']['nom_utilisateur'] = $userName;

    header('Location:tableau_de_bord_patient.php');
    exit();


    ////////////////// OU SINON REDIRECTION SI LE COMPTE N'EST PAS CONNECT� \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

} else {
    header('Location:tableau_de_bord_personnel?erreur=3.php');
    exit();
}

?>