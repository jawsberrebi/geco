<?php

require_once("config.php");
include('backend/recuperation_valeurs.php'); //Module de récupération de valeur
include('backend/affichage_valeurs.php');

if(!isset($_SESSION['userPatient'])) {

    session_destroy();
    header('Location:connexion?erreur=4.php');
    exit();

}

$id = $_SESSION['userPatient']['id_patient'];

include('backend/graphique_donnees.php');
include('backend/graphiques.php');

?>

<!DOCTYPE html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<html lang="fr">
    <head>
          <link rel="stylesheet" href="css/style_patient_1.css">
          <link rel="stylesheet" href="css/navbar_pro.css">
          <link rel="stylesheet" href="css/style_patient_2.css">
          <meta charset="utf-8" />
        <link rel="stylesheet" href="css/style_patient_3.css" />
        <title>Tableau de bord</title>
    </head>
    <header>
        <nav>
            <a href="#" class="nav-logo">Geco.</a>
    
            <ul>
              <li class="navbara"><a id="chiant" href="#tableaudebord"><strong>Tableau de bord</strong></a></li>
              <li><a class="bactive" a style="color:#37C394", font-size:2em; href="modifier_mon_compte.php" ><strong> Modifier mon compte</strong></a></li>
              <li><a href="backend/deconnexion.php" id="deconnexion"> <strong></strong> Déconnexion</strong></a></li>
            </ul>
    
        </nav>
    </header>
    
        </head>
        <body>

            
       

        <h1>Tableau de bord</h1>
        <div class="id">

            <div class="contenu_actif" data-anim="1">
                <div id="t">
                    

                    <div class="container">

                      <div class="container-onglets">
                          <div class="onglets active" data-anim="1">Vue d'ensemble</div>
                          <div class="onglets" data-anim="2">Rythme cardiaque</div>
                          <div class="onglets" data-anim="3">Niveau sonore</div>
                          <div class="onglets" data-amim="4">Gaz</div>
                        
                      </div>
                  
                      <div class="contenu activeContenu" data-anim="1">
                          <h3></h3>
                          <hr>
                          <div class="contenu_actif" data-anim="1">
                            <div id="table">
                                <div class="cadran">
                                    <div id="cadran_rouge">
                                        <p>Rythme cardiaque</p>
                                        <p>❤</p>
                                    </div>

                                    <?php 
                                        if(!isset($finalValues[0]['valeur'])){
                                            echo '<p></p>';
                                        }
                                        else{
                                           echo '<p class="valeurPHP">' . $finalValues[0]['valeur'] . ' <mark id="bpm">bpm</mark></p>';  
                                        }
                                    ?>
                                </div>
            
                                <div class="cadran">

                                    <div id="cadran_bleu">
                                        <p>Niveau sonore</p>
                                        <img src="images/b.png" width="50" height="50"/>
                                    </div>

                                    <?php 
                                        if(!isset($finalValues[1]['valeur'])){
                                            echo '<p></p>';
                                        }
                                        else{
                                           echo '<p class="valeurPHP">' . $finalValues[1]['valeur'] . ' <mark id="db">db</mark></p>';  
                                        }
                                    ?>
                                </div>
            
                                <div class="cadran">

                                    <div id="cadran_vert">
                                        <p>Gaz (CO2)</p>
                                        <img src="images/c.png" width="50" height="50"/>
                                    </div>

                                    <?php 
                                        if(!isset($finalValues[2]['valeur'])){
                                            echo '<p></p>';
                                        }
                                        else{
                                           echo '<p class="valeurPHP">' . $finalValues[2]['valeur'] . ' <mark id="pourcentage">%</mark></p>';  
                                        }
                                    ?>
                                </div>
                            </div>
                  
                      <div class="contenu" data-anim="2">
                          <div class="bloc_graphiques">
                            <div class="btngroupone">
                                <button class="choosebtn" onclick="drawChartYearCardiac()">Cette année</button>
                                <button class="choosebtn" onclick="drawChartMonthCardiac()">Ce mois-ci</button>
                                <button class="choosebtn" onclick="drawChartDayCardiac()">Aujourd'hui</button>
                            </div>

                            <div id="curve_chart_cardiac"></div>
                          </div>
                      </div>
                  
                      <div class="contenu" data-anim="3">
                          <h3></h3>
                          <hr>
                          <p></p>
                      </div>
                      <div class="contenu" data-anim="4">
                          <h3>uvcz</h3>
                      </div>
                    
                      </div>
                      <script src="Javascript/fenetre.js"></script>

            <div class="contenu_actif" data-anim="2">
                
            </div>

            <div class="contenu_actif" data-anim="3">
                
            </div>

            <div class="contenu_actif" data-anim="4">
             
            </div>

        </div>

   
    
</body>
</html>
