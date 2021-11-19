<?php

require_once("config.php");
include('backend/recuperation_valeurs.php'); //Module de récupération de valeur
include('backend/affichage_valeurs.php');

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

        <?php include("backend/fenetre_modale_tableau_de_bord.php"); ?>

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
                            <?php echo $finalValues[0]['valeur']; ?>
                        </p>
                    </div>

                    <div class="cadran">
                        <p id="text">
                            <?php echo $finalValues[1]['valeur']; ?>
                        </p>
                    </div>

                    <div class="cadran">
                        <p id="text">
                            <?php echo $finalValues[2]['valeur']; ?>
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