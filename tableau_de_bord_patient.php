<?php

require_once "config.php";

if(!isset($_SESSION['userPatient'])) {

    session_destroy();
    header('Location:connexion?erreur=4.php');
    exit();

}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/style_tableau_de_bord_personnel.css" />
        <title>Tableau de bord</title>
    </head>

    <body>

        <h1>Tableau de bord</h1>

        <a href="modifier_mon_compte.php" id="modification_compte">Modifier mon compte</a><br />

        <a href="deconnexion.php" id="deconnexion">Déconnexion</a><br />

        <div class="tableau_onglets">

            <div class="groupe_onglets">
                <div class="onglet_actif" data-anim="1">Vue d'ensemble</div>
                <div class="onglet" data-anim="2">Rythme cardiaque</div>
                <div class="onglet" data-anim="3">Niveau sonore</div>
                <div class="onglet" data-anim="4">Concentration CO2</div>
            </div>

            <div class="contenu_actif" data-anim="1">
                <div id="table">
                    <div class="cadran">
                        <p id="text">
                            Test
                        </p>
                    </div>

                    <div class="cadran">
                        <p id="text">
                            Test
                        </p>
                    </div>

                    <div class="cadran">
                        <p id="text">
                            Test
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="contenu_actif" data-anim="2">
                
            </div>

            <div class="contenu_actif" data-anim="3">
                
            </div>

            <div class="contenu_actif" data-anim="4">
             
            </div>

        </div>

    </body>
</html>