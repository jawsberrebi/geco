<?php  require_once "config.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/style_global.css">
        <link rel="stylesheet" href="css/style_connexion.css"/>
        <title>Connexion</title>
    </head>
    <body>

        <img src="images/image-vitrine.jpg" alt="image de description" id="image_connexion"
             style="width:50%; height:100vh; object-fit: cover;"/>

        <div id="box">

            <form action="verification.php" method="post">
                <h1 id="title_form">Connexion</h1>

                <input type="text" placeholder="Email ou nom d'utilisateur" name="email_pseudo" class="input_mail" required />

                <input type="password" placeholder="Mot de passe" name="password" required />

                <input type="submit" id='submit' value='Connexion' />

                <a href="mot_de_passe_oublie.php" id="password_lost">Mot de passe oublié ?</a>

                <?php if(isset($_GET['erreur'])){
                        $erreur = $_GET['erreur'];
                        if($erreur==1) {
                            echo '<p id="message_erreur">Nom d\'utilisateur ou mot de passe incorrect.</p>';
                        }
                        if($erreur==2) {
                            echo '<p id="message_erreur">Il faut d\'abord se connecter avant de pouvoir accéder à cette page.</p>';
                        }
                        if($erreur==3){
                            echo '<p id="message_erreur">Il faut d\'abord vous connecter avant de pouvoir accéder à cette page.</p>';
                        }
                        if($erreur==4){
                            echo '<p id="message_erreur">Vous n\'êtes pas autorisé à accéder à ces informations.</p>';
                        }
                    }

                ?>

                <p id="indication">Si vous n'avez pas de compte, veuillez contacter votre médecin.</p>

            </form>
        </div>
    </body>
</html>
