<?php 
require_once "config.php"; 
?>

<?php

if($_GET['type'] != 'patient' && $_GET['type'] != 'infirmier' && $_GET['type'] != 'medecin') {
    header('Location:tableau_de_bord_personnel?erreur=2.php');
    exit();
}

//if(!isset($_SESSION['userAdmin']) ) {
//    header('Location:tableau_de_bord_personnel?erreur=1.php');
//    exit();
//}

if(isset($_SESSION['userPersonnel']) ) {
    if($_SESSION['userPersonnel']['type'] != 'medecin') {

        if($_SESSION['userPersonnel']['type'] != 'admin'){
            header('Location:tableau_de_bord_personnel?erreur=1.php');
            exit();
        }


    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/style_ajout.css" />

    <?php if($_GET['type'] == 'patient') : ?>

    <title>Ajouter un patient</title>

    <?php endif; ?>

    <?php if($_GET['type'] == 'infirmier') : ?>

    <title>Ajouter un infirmier</title>

    <?php endif; ?>

    <?php if($_GET['type']=='medecin') : ?>

    <title>Ajouter un médecin</title>

    <?php endif; ?>

</head>
<body>

    <div id="box">

        <form action="post_ajout.php" method="post">

            <?php if($_GET['type'] == 'patient') : ?>

            <h1 id="title_form">Nouveau Patient</h1>

            <input name="type" value="patient" type="hidden"/>

            <?php endif; ?>

            <?php if($_GET['type'] == 'infirmier') : ?>

            <h1 id="title_form">Nouvel Infirmier</h1>

            <input name="type" value="infirmier" type="hidden" />

            <?php endif; ?>

            <?php if($_GET['type']=='medecin') : ?>

            <?php if($_SESSION['userPersonnel']['type'] == 'admin') : ?>

            <h1 id="title_form">Nouveau Médecin</h1>

            <input name="type" value="medecin" type="hidden" />

            <?php endif; ?>

            <?php if(isset($_SESSION['userPersonnel'])) : ?>

            <?php if($_SESSION['userPersonnel']['type'] != 'admin') : ?>

            <?php header('Location:tableau_de_bord_personnel?erreur=1.php');
                  exit();
            ?>

            <?php endif; ?>

            <?php endif; ?>

            <?php endif; ?>

            <input type="text" placeholder="Nom*" name="nom" required />

            <input type="text" placeholder="Prénom*" name="prenom" required />

            <input type="email" placeholder="Email*" name="email" required />

            <input type="tel" placeholder="Numéro de téléphone" name="telephone" />

            <?php if($_GET['type']=='patient') : ?>

            <input type="text" placeholder="Adresse" name="adresse" />

            <textarea placeholder="Description" name="description"></textarea>

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



        </form>
    </div>

    
</body>
</html>