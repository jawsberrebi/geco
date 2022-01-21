<?php include_once("backend/config.php");

if (!isset($_SESSION['userPatient']) && !isset($_SESSION['userPersonnel'])) {
    header('Location:connexion?erreur=3.php');
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

        <form action="backend/post_modifier_mon_compte.php" method="post">

            <h1 id="title_form">Modifier mon compte</h1>

            


            <!-- MODIFICATION DU NOM -->

            <?php if (isset($_SESSION['userPersonnel'])) : ?>
            <?php if ($_SESSION['userPersonnel']) : ?>

            <input type="text" placeholder="Nom*" name="nom" required value="<?php echo $_SESSION['userPersonnel']['nom'] ?>" />

            <?php endif; ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['userPatient'])) : ?>
            <?php if ($_SESSION['userPatient']) : ?>

            <input type="text" placeholder="Nom*" name="nom" value="<?php echo $_SESSION['userPatient']['nom'] ?>" required />

            <?php endif; ?>
            <?php endif; ?>

            <!-- MODIFICATION DU PR�NOM -->

            <?php if (isset($_SESSION['userPersonnel'])) : ?>
            <?php if ($_SESSION['userPersonnel']) : ?>

            <input type="text" placeholder="Prénom*" name="prenom" value="<?php echo $_SESSION['userPersonnel']['prenom'] ?>" required />

            <?php endif; ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['userPatient'])) : ?>
            <?php if ($_SESSION['userPatient']) : ?>

            <input type="text" placeholder="Prénom*" name="prenom" value="<?php echo $_SESSION['userPatient']['prenom'] ?>" required />

            <?php endif; ?>
            <?php endif; ?>

            <!-- MODIFICATION DE L'ADRESSE EMAIL -->

            <?php if (isset($_SESSION['userPersonnel'])) : ?>
            <?php if ($_SESSION['userPersonnel']) : ?>

            <input type="email" placeholder="Email*" name="email" value="<?php echo $_SESSION['userPersonnel']['mail'] ?>" required />

            <?php endif; ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['userPatient'])) : ?>
            <?php if ($_SESSION['userPatient']) : ?>

            <input type="email" placeholder="Email*" name="email" value="<?php echo $_SESSION['userPatient']['mail'] ?>" required />

            <?php endif; ?>
            <?php endif; ?>

            <!-- MODIFICATION DU NUMÉRO DE TÉLÉPHONE -->

            <?php if (isset($_SESSION['userPersonnel'])) : ?>
            <?php if ($_SESSION['userPersonnel']) : ?>

            <input type="tel" placeholder="Numéro de téléphone" name="telephone" value="<?php echo $_SESSION['userPersonnel']['tel'] ?>" />

            <?php endif; ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['userPatient'])) : ?>
            <?php if ($_SESSION['userPatient']) : ?>

            <input type="tel" placeholder="Numéro de téléphone" name="telephone" value="<?php echo $_SESSION['userPatient']['tel'] ?>" />

            <?php endif; ?>
            <?php endif; ?>

            <!-- MODIFICATION DE L'ADRESSE -->

            <?php if (isset($_SESSION['userPatient'])) : ?>
            <?php if ($_SESSION['userPatient']) : ?>

            <input type="text" placeholder="Adresse" name="adresse" value="<?php echo $_SESSION['userPatient']['adresse'] ?>" /> <!-- LE PATIENT PEUT-IL MODIFIER SON ADRESSE ??? -->

            <?php endif; ?>
            <?php endif; ?>

            <input type="submit" id='submit' value='Sauvegarder' />

            

            <?php 
            if (!empty($_SESSION['userPersonnel'])){
                if ($_SESSION['userPersonnel']['type'] == 'admin'){
                    echo '<p id="indication">Si vous souhaitez modifier votre mot de passe et/ou votre nom d\'utilisateur, veuillez contacter Infinite Measures.</p>';
                }
            }
            ?>

            

            <?php if ((!empty($_SESSION['userPersonnel']) && ($_SESSION['userPersonnel']['type'] == 'medecin' || $_SESSION['userPersonnel']['type'] == 'infirmier')) || !empty($_SESSION['userPatient'])) : ?>

            <p id="indication">Si vous modifiez votre nom et/ou votre prénom, votre nom d'utilisateur sera également modifié (de la manière : "première lettre du prénom + nom de famille").</p>

            <p id="indication">Si vous souhaitez modifier votre mot de passe, veuillez vous rendre sur la page de connexion (section "mot de passe oublié").</p>

            <?php endif; ?>

            <?php if(isset($_GET['erreur'])){
                      $error = $_GET['erreur'];
                      if($error==1){
                          echo '<p id="message_erreur">Il manque des informations. Veillez à rentrer toutes les informations marquées d\'un *.</p>';
                      }
                      if($error==2){
                          echo '<p id="message_erreur">L\'adresse email a déjà été utilisée. Veuillez entrer une autre adresse email.</p>';
                      }
                      if ($_SESSION['userPersonnel']['type'] == 'admin') {
                          if($error==3){
                              echo '<p id="message_erreur">Ce nom d\'hôpital a déjà été attribué.</p>';
                          }
                      }

                  }?>



        </form>
    </div>


</body>
</html>