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
include("backend/graphique_donnees.php");
include("backend/graphiques.php");
?>

<!DOCTYPE html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<html lang="fr">
<head>
    <link rel="stylesheet" href="css/style_patient_1.css">
    <link rel="stylesheet" href="css/navbar_pro.css">
    <link rel="stylesheet" href="css/style_patient_2.css">
    <link rel="stylesheet" href="css/style_patient_3.css" />

    <script src="Javascript/tabController.js"></script>

    <meta charset="utf-8" />
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

<body>

<h1>Tableau de bord</h1>
<div class="container">
    <div class="tab-bar">
        <button id="0" class="tab active" onclick="changeTab(0, 'vue-densemble')">Vue d'ensemble</button>
        <button id="1" class="tab" onclick="changeTab(1, 'rythme-cardiaque')">Rythme cardiaque</button>
        <button id="2" class="tab" onclick="changeTab(2, 'niveau-sonore')">Niveau sonore</button>
        <button id="3" class="tab" onclick="changeTab(3, 'gaz')">Gaz</button>
    </div>
    <div id="vue-densemble" class="tab-view">
        <div id="table">
            <div class="cadran">
                <div id="cadran_rouge">
                    <p>Rythme cardiaque</p>
                    <img src="images/heart.png" width="40" height="40" style="margin-top: "/>
                </div>

                <?php
                if(!isset($finalValues[0]['valeur'])){
                    echo '<p>n/a <mark id="bpm">bpm</mark></p>';
                }
                else{
                    echo '<p class="valeurPHP">' . $finalValues[0]['valeur'] . ' <mark id="bpm">bpm</mark></p>';
                }
                ?>
            </div>

            <div class="cadran">

                <div id="cadran_bleu">
                    <p>Niveau sonore</p>
                    <img src="images/sound-waves.png" width="40" height="40"/>
                </div>

                <?php
                if(!isset($finalValues[1]['valeur'])){
                    echo '<p>n/a <mark id="db">dB</mark></p>';
                }
                else{
                    echo '<p class="valeurPHP">' . $finalValues[1]['valeur'] . ' <mark id="db">dB</mark></p>';
                }
                ?>
            </div>

            <div class="cadran">

                <div id="cadran_vert">
                    <p>Gaz (CO2)</p>
                    <img src="images/co2.png" width="40" height="40"/>
                </div>

                <?php
                if(!isset($finalValues[2]['valeur'])){
                    echo '<p>n/a <mark id="pourcentage">%</mark></p>';
                }
                else{
                    echo '<p class="valeurPHP">' . $finalValues[2]['valeur'] . ' <mark id="pourcentage">%</mark></p>';
                }
                ?>
            </div>
        </div>
    </div>
    <div id="rythme-cardiaque" class="tab-view" style="display: none">
        <h1>Rythme cardiaque</h1>
        <div class="bloc_graphiques">
             <div class="filter-col">
                <button class="choosebtn btn-primary" onclick="drawChartYearCardiac()">Cette année</button>
                <button class="choosebtn btn-primary" onclick="drawChartMonthCardiac()">Ce mois-ci</button>
                <button class="choosebtn btn-primary" onclick="drawChartDayCardiac()">Aujourd'hui</button>
            </div>
            <div id="curve_chart_cardiac"></div>
        </div>
    </div>
    <div id="niveau-sonore" class="tab-view" style="display: none">
        <h1>Niveau sonore</h1>
        <div class="bloc_graphiques">
             <div class="filter-col">
                <button class="choosebtn btn-primary" onclick="drawChartYearSound()">Cette année</button>
                <button class="choosebtn btn-primary" onclick="drawChartMonthSound()">Ce mois-ci</button>
                <button class="choosebtn btn-primary" onclick="drawChartDaySound()">Aujourd'hui</button>
            </div>
            <div id="curve_chart_sound"></div>
        </div>
    </div>
    <div id="gaz" class="tab-view" style="display: none">
        <h1>Gaz</h1>
        <div class="bloc_graphiques">
        <div class="filter-col">
                <button class="choosebtn btn-primary" onclick="drawChartYearGas()">Cette année</button>
                <button class="choosebtn btn-primary" onclick="drawChartMonthGas()">Ce mois-ci</button>
                <button class="choosebtn btn-primary" onclick="drawChartDayGas()">Aujourd'hui</button>
        </div>
        <div id="curve_chart_gas"></div>
        </div>
    </div>
</div>
</body>
</html>
