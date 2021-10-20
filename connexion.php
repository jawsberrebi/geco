<?php  require_once "config.php"; 


?>


<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/style.css"/>
        <title>Authentification</title>
    </head>
    <body>

        <img src="images/image-vitrine.jpg" alt="image de description" id="image_connexion" />

        <div id="box">



            <form action="verification.php" method="POST">
                <h1 id="title_form">Connexion</h1>

                <input type="text" placeholder="Email ou nom d'utilisateur" name="email" required />

                <input type="password" placeholder="Mot de passe" name="password" required />

                <input type="submit" id='submit' value='Connexion' />

                <a href="" id="password_lost">Mot de passe oublié ?</a>

                <p id="indication">Si vous n'avez pas de compte, veuillez contacter votre médecin.</p>

                <?php
                    if(isset($_GET['erreur'])){
                        $err = $_GET['erreur'];
                        if($err==1 || $err==2)
                            echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                    }
                ?>

            </form>
        </div>
    </body>
</html>