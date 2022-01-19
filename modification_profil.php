<?php
require_once "config.php";
include("backend/conditions_accès_page_personnel_et_admin.php");
include('backend/conditions_id.php');

if(isset($_SESSION['userPersonnel']) ) {
    if($_SESSION['userPersonnel']['type'] != 'medecin') {

        if($_SESSION['userPersonnel']['type'] != 'admin'){
            header('Location:tableau_de_bord_personnel?erreur=1.php');
            exit();
        }
    }
}

if(isset($_GET['id_patient'])){
    $sql = "SELECT * FROM patient WHERE id_patient='".$id."'";
    $pre = $pdo->prepare($sql);
    $pre->execute();
    $user = current($pre->fetchAll(PDO::FETCH_ASSOC)); 
}
elseif(isset($_GET['id_infirmier'])){
    $sql = "SELECT * FROM personnel WHERE id_personnel='".$id."'";
    $pre = $pdo->prepare($sql);
    $pre->execute();
    $user = current($pre->fetchAll(PDO::FETCH_ASSOC));
}
elseif(isset($_GET['id_medecin'])){
    $sql = "SELECT * FROM personnel WHERE id_personnel='".$id."'";
    $pre = $pdo->prepare($sql);
    $pre->execute();
    $user = current($pre->fetchAll(PDO::FETCH_ASSOC));
}

if($user['id_hopital'] != $_SESSION['userPersonnel']['id_hopital']){
    header('Location:tableau_de_bord_personnel?erreur=1.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/style_ajout.css" />
    <title>Modifier mon compte</title>
</head>
<body>

    <div id="box">

        <form action="backend/post_modification_profil.php" method="post">

            <h1 id="title_form">Modification du compte</h1>

            <input name="id" value="<?php echo $id ?>" type="hidden"/>

            <?php if (isset($_GET['id_patient'])) : ?>

            <input name="type" value="patient" type="hidden"/>

            <?php endif; ?>

            <?php if (isset($_GET['id_infirmier'])) : ?>

            <input name="type" value="infirmier" type="hidden"/>

            <?php endif; ?>

            <?php if (isset($_GET['id_medecin'])) : ?>

            <input name="type" value="medecin" type="hidden"/>

            <?php endif; ?>

            <!-- MODIFICATION DU NOM -->

            <input type="text" placeholder="Nom*" name="nom" required value="<?php echo $user['nom'] ?>" />

            <!-- MODIFICATION DU PR�NOM -->

            <input type="text" placeholder="Prénom*" name="prenom" value="<?php echo $user['prenom'] ?>" required />

            <!-- MODIFICATION DE L'ADRESSE EMAIL -->

            <input type="email" placeholder="Email*" name="email" value="<?php echo $user['mail'] ?>" required />

            <!-- MODIFICATION DU NUMÉRO DE TÉLÉPHONE -->

            <input type="tel" placeholder="Numéro de téléphone" name="telephone" value="<?php echo $user['tel'] ?>" />

            <!-- MODIFICATION DE L'ADRESSE -->

            <?php if (isset($_GET['id_patient'])) : ?>

            <input type="text" placeholder="Adresse" name="adresse" value="<?php echo $user['adresse'] ?>" />

            <textarea placeholder="Description" name="description" value="<?php echo $user['description'] ?>"></textarea>

            <?php endif; ?>

            <input type="submit" id='submit' value='Sauvegarder' />

            <?php if(isset($_GET['erreur'])){
                      $error = $_GET['erreur'];
                      if($error==1){
                          echo '<p id="message_erreur">Il manque des informations. Veillez à rentrer toutes les informations marquées d\'un *.</p>';
                      }
                      if($error==2){
                          echo '<p id="message_erreur">L\'adresse email a déjà été utilisée. Veuillez entrer une autre adresse email.</p>';
                      }
                      

                  }?>

            <p id="indication">Si vous modifiez le nom et/ou le prénom, le nom d'utilisateur de ce profil sera également modifié (de la manière : "première lettre du prénom + nom de famille").</p>


        </form>
    </div>


</body>
</html>