<?php
include_once("config.php");

if (!isset($_POST['nom']) || !isset($_POST['prenom']) || !isset($_POST['email'])) {
    header('Location:../modifier_mon_compte?erreur=1.php');
    exit();
}

////// RÉCUPÉRATION DES ÉLÉMENTS DE FORMULAIRE
$name = htmlspecialchars($_POST['nom']);
$firstName = htmlspecialchars($_POST['prenom']);
$userName = mb_strtolower(mb_substr($firstName, 0 , 1) . $name); //Générateur de nom d'utilisateur : 1ère lettre du prénom + nom. Remplacer $email par la variable contenant le prénom et $password par la variable contenant le nom.
$mail = htmlspecialchars($_POST['email']);
$phone = htmlspecialchars($_POST['telephone']);


if(isset($_SESSION['userPersonnel'])){
    /////////////                                                                   \\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    ///////////// DANS LE CAS OÙ L'ADMIN ACCÈDE À LA PAGE DE MODIFICATION DE COMPTE \\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    ////////////                                                                     \\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    if ($_SESSION['userPersonnel']['type'] == 'admin') {

        $sql = "SELECT * FROM personnel WHERE mail='".$mail."' AND id_personnel != '".$_SESSION['userPersonnel']['id_personnel']."'"; //AJOUTER CONDITION POUR PAS REPERER ID ADMIN
        $pre = $pdo->prepare($sql);
        $pre->execute();
        $user = current($pre->fetchAll(PDO::FETCH_ASSOC));
        $result= $user;
        if($result != 0) {
            header('Location:../modifier_mon_compte?erreur=2.php');
            exit();
        }

        $sql = "UPDATE personnel SET prenom = :prenom, nom = :nom, mail = :mail, tel = :tel WHERE id_personnel = '".$_SESSION['userPersonnel']['id_personnel']."' ";
        $pre = $pdo->prepare($sql);
        $pre->execute([
            ':prenom' => $firstName,
            ':nom' => $name,
            ':mail' => $mail,
            ':tel' => $phone
            ]);

        $_SESSION['userPersonnel']['prenom'] = $firstName;
        $_SESSION['userPersonnel']['nom'] = $name;
        $_SESSION['userPersonnel']['mail'] = $mail;
        $_SESSION['userPersonnel']['tel'] = $phone;

        header('Location:../tableau_de_bord_personnel?confirmation=4.php');
        exit();


        /////////////                                                                                  \\\\\\\\\\\\\\\\\\\\\\\\\\\\\
        ///////////// DANS LE CAS OÙ UN MEMBRE DU PERSONNEL ACCÈDE À LA PAGE DE MODIFICATION DE COMPTE \\\\\\\\\\\\\\\\\\\\\\\\\\\\\
        ////////////                                                                                    \\\\\\\\\\\\\\\\\\\\\\\\\\\\\

    } elseif ($_SESSION['userPersonnel'] != 'admin') {

        //UPDATE INFOS BDD

        $sql = "SELECT * FROM personnel WHERE mail='".$mail."' AND id_personnel != '".$_SESSION['userPersonnel']['id_personnel']."'";
        $pre = $pdo->prepare($sql);
        $pre->execute();
        $user = current($pre->fetchAll(PDO::FETCH_ASSOC));
        $result= $user;
        if($result != 0) {
            header('Location:../modifier_mon_compte?erreur=2.php');
            exit();
        }

        $sql = "UPDATE personnel SET prenom = :prenom, nom = :nom, mail = :mail, tel = :tel, nom_utilisateur = :nom_utilisateur WHERE id_personnel = '".$_SESSION['userPersonnel']['id_personnel']."' ";
        $pre = $pdo->prepare($sql);
        $pre->execute([
            ':prenom' => $firstName,
            ':nom' => $name,
            ':mail' => $mail,
            ':tel' => $phone,
            ':nom_utilisateur' => $userName,
            ]);

        $_SESSION['userPersonnel']['prenom'] = $firstName;
        $_SESSION['userPersonnel']['nom'] = $name;
        $_SESSION['userPersonnel']['mail'] = $mail;
        $_SESSION['userPersonnel']['tel'] = $phone;
        $_SESSION['userPersonnel']['nom_utilisateur'] = $userName;

        header('Location:../tableau_de_bord_personnel?confirmation=4.php');
        exit();

        /////////////                                                                      \\\\\\\\\\\\\\\\\\\\\\\\\\\\\
        ///////////// DANS LE CAS OÙ UN PATIENT ACCÈDE À LA PAGE DE MODIFICATION DE COMPTE \\\\\\\\\\\\\\\\\\\\\\\\\\\\\
        ////////////                                                                        \\\\\\\\\\\\\\\\\\\\\\\\\\\\\

    } 

}
elseif(isset($_SESSION['userPatient'])){
    if ($_SESSION['userPatient']) {

        $adresse = htmlspecialchars($_POST['adresse']);

        $sql = "SELECT * FROM patient WHERE mail='".$mail."' AND id_patient != '".$_SESSION['userPatient']['id_patient']."' ";
        $pre = $pdo->prepare($sql);
        $pre->execute();
        $user = current($pre->fetchAll(PDO::FETCH_ASSOC));
        $result= $user;
        if($result != 0) {
            header('../Location:modifier_mon_compte?erreur=2.php');
            exit();
        }

        $sql = " UPDATE patient SET prenom = :prenom, nom = :nom, mail = :mail, tel = :tel, adresse = :adresse,nom_utilisateur = :nom_utilisateur WHERE id_patient = '".$_SESSION['userPatient']['id_patient']."' ";
        $pre = $pdo->prepare($sql);
        $pre->execute([
            ':prenom' => $firstName,
            ':nom' => $name,
            ':mail' => $mail,
            ':tel' => $phone,
            ':adresse' => $adresse,
            ':nom_utilisateur' => $userName,
            ]);

        $_SESSION['userPatient']['prenom'] = $firstName;
        $_SESSION['userPatient']['nom'] = $name;
        $_SESSION['userPatient']['mail'] = $mail;
        $_SESSION['userPatient']['tel'] = $phone;
        $_SESSION['userPatient']['adresse'] = $adresse;
        $_SESSION['userPatient']['nom_utilisateur'] = $userName;

        header('Location:../tableau_de_bord_patient.php');
        exit();

    }
}
else {
    ////////////////// OU SINON REDIRECTION SI LE COMPTE N'EST PAS CONNECTÉ \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    header('Location:../tableau_de_bord_personnel?erreur=3.php');
    exit();
}

?>