<?php  require_once "config.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/style_connexion.css"/>
        <title>Connexion</title>
    </head>
    <body>

        <img src="images/image-vitrine.jpg" alt="image de description" id="image_connexion" />

        <div id="box">

            <form action="post_mot_de_passe_oublie.php" method="post">
                <h1 id="title_form">Mot de passe oublié</h1>

                <input type="email" placeholder="Email" name="email" class="input_mail" required />

                <input type="submit" id='submit' value='Réinitialiser le mot de passe' />

                <?php if(isset($_GET['erreur'])){
                        $erreur = $_GET['erreur'];
                        if($erreur==1) {
                            echo '<p id="message_erreur">Nom d\'utilisateur ou mot de passe incorrect.</p>';
                        }
                        if($erreur==2) {
                            echo '<p id="message_erreur">Il faut d\'abord se connecter avant de pouvoir acc�der � cette page.</p>';
                        }
                        if($erreur==3){
                            echo '<p id="message_erreur">Il faut d\'abord vous connecter avant de pouvoir acc�der � cette page.</p>';
                        }
                        if($erreur==4){
                            echo '<p id="message_erreur">Vous n\'�tes pas autoris� � acc�der � ces informations.</p>';
                        }
                    }
                     
                ?>

                <p id="indication">Entrez votre adresse email pour pouvoir réinitialiser votre mot de passe. Le nouveau mot de passe vous sera envoyé par mail. </p>

            </form>
        </div>
    </body>
</html>