<?php 
require_once "backend/config.php";
include("backend/modification_mot_de_passe_conditions.php")
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/style_ajout.css" />
</head>
<body>

    <div id="box">

        <form action="backend/post_modification_mot_de_passe.php" method="post">

            <h1 id="title_form">Création d'un mot de passe</h1>

            <input type="hidden" value="<?php echo $_GET['char'] ?>" name="char" required/>

            <?php if($type == 'patient.php') :?>

            <input type="hidden" value="patient" name="type" required/>

            <?php endif; ?>

            <?php if($type == 'personnel.php') :?>

            <input type="hidden" value="personnel" name="type" required/>

            <?php endif; ?>

            <input type="hidden" value="<?php echo $_GET['user'] ?>" name="user" required/>

            <input type="password" placeholder="Créez votre mot de passe*" name="firstPassword" maxlength="8" required />

            <input type="password" placeholder="Répétez le mot de passe*" name="secondPassword" maxlength="8" required />

            <input type="submit" id='submit' value='Sauvegarder' />


            <?php if(isset($_GET['erreur'])){
                      $error = $_GET['erreur'];
                      if($error==1){
                          echo '<p id="message_erreur">Les deux mots de passe ne correspondent pas.</p>';
                      }
                      if($error==2){
                          echo '<p id="message_erreur">Des informations manquent.</p>';
                      }

                  }?>



        </form>
    </div>

    
</body>
</html>