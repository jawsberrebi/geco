<?php require_once "config.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/style_ajout.css" />
    <title>Ajouter un patient</title>
</head>
<body>

    <div id="box">

        <form action="post_ajout_nouveau_patient.php" method="post">
            <h1 id="title_form">Nouveau Patient</h1>

            <input type="text" placeholder="Nom*" name="nom" required />

            <input type="text" placeholder="Prénom*" name="prenom" required />

            <input type="email" placeholder="Email*" name="email" required />

            <input type="text" placeholder="Description" name="email" />

            <input type="submit" id='submit' value='Ajouter' />


            <?php if(isset($_GET['erreur'])){
                      $error = $_GET['erreur'];
                      if($error==1){
                          echo '<p id="message_erreur">Il manque des informations. Veillez à rentrer toutes les informations.</p>';
                      }
                      if($error==2){
                          echo '<p id="message_erreur">L\'adresse email a déjà été utilisée. Veuillez entrer une autre adresse email.</p>';
                      }
                  }?>



        </form>
    </div>
</body>
</html>