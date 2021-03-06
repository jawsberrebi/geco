<?php
require_once "config.php";
include("backend/fonctions.php");
include("backend/conditions_accès_page_personnel_et_admin.php");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/style_tableau_de_bord_personnel.css" />
    <title>Tableau de bord</title>
    <link rel="stylesheet" href="css/navbar_pro.css">
</head>
<header>
    <nav>
        <a href="#" class="nav-logo">Geco.</a>

        <ul>
          <li><a class="active" href="tableau_de_bord_personnel.php">Tableau de bord</a></li>
          <li><a href="modifier_mon_compte.php" id="profil">Modifier mon compte</a></li>
          <li><a href="backend/deconnexion.php" id="deconnexion">Déconnexion</a></li>
        </ul>

    </nav>
</header>

<script src="Javascript/boutons.js"></script>

<body>
    <h1>
        Tableau de bord
    </h1>

    <?php if (!isset($_SESSION['userPersonnel'])) {

            header('Location:connexion?erreur=4.php');
            exit();

          }

    ?>
    <!-- FACTORISATION DES MESSAGES DU TABLEAU DE BORD -->
    <?php include("backend/messages_tableau_de_bord_personnel.php")?>

    <form method="get" id="recherche">
        <input type="search" name="moteur_recherche" placeholder="Chercher un membre" id="moteur_recherche" />
        <input type="submit" value="Rechercher" id="btn_recherche"/>
    </form>

    <?php if($_SESSION['userPersonnel']['type'] == 'medecin' || $_SESSION['userPersonnel']['type'] == 'admin') : ?>

    <div class="dropdown">
        <button onclick="myFunction()" class="dropbtn">Ajouter un membre</button>
        <div id="myDropdown" class="dropdown-content">
            <!-- FONCTIONNALITÉS ADMIN ET MÉDECIN -->
            <?php include("backend/fonctionnalités_admin_medecin_tableau_de_bord_personnel.php") ?>
        </div>
    </div>

    <?php endif; ?>


    

    <table>
        <thead>
            <tr>
                <th id="identifiant">Id</th>
                <th class="tab_personnel">Nom du membre</th>
                <th class="tab_personnel">Type de membre</th>
                <th class="tab_personnel1">Rythme cardiaque</th>
                <th class="tab_personnel1">Niveau sonore</th>
                <th class="tab_personnel1">Concentration en CO2</th>
            </tr>
        </thead>

        <!-- SI L'UTILISATEUR N'A RIEN RENTRÉ DANS LE CHAMP DE RECHERCHE, AFFICHER LA TABLE DE TOUS LES UTILISATEURS -->
        <?php if(!isset($_GET['moteur_recherche']) || empty($_GET['moteur_recherche'])) : ?>


        <!-- GÉNÉRATION DU TABLEAU DES PATIENTS -->
        <?php echo dataTableMembersGenerator($pdo, 'patient', false, ''); ?>

        <?php if($_SESSION['userPersonnel']['type'] == 'admin' || $_SESSION['userPersonnel']['type'] == 'medecin') : ?>

        <!-- GÉNÉRATION DU TABLEAU DES INFIRMIERS -->
        <?php echo dataTableMembersGenerator($pdo, 'infirmier', false, ''); ?>

        <?php endif; ?>
        
        <?php if($_SESSION['userPersonnel']['type'] == 'admin') : ?>

        <!-- GÉNÉRATION DU TABLEAU DES MÉDECINS -->
        <?php echo dataTableMembersGenerator($pdo, 'medecin', false, ''); ?>

        <?php endif; ?>


        <!-- SI L'UTILISATEUR A RENTRÉ QUELQUE CHOSE DANS LE CHAMP DE RECHERCHE, AFFICHER LA TABLE DE RÉSULTATS -->
        <?php else : ?>

        <?php if(isset($_SESSION['userPersonnel']) && $_SESSION['userPersonnel']['type'] == 'infirmier') : ?>

        <?php 
        $isThereResult['patient'] = dataResultsResearchTableMember($pdo, 'patient', $_GET['moteur_recherche']); 
        
        if(!$isThereResult['patient']) {
            echo '<p>Aucun résultat.</p>';
        }
        ?>

        <?php endif; ?>

        <?php if(isset($_SESSION['userPersonnel']) && $_SESSION['userPersonnel']['type'] == 'medecin') : ?>

        <?php
        $isThereResult = dataResultsResearchTableMember($pdo, 'patient', $_GET['moteur_recherche']);
        $isThereResult = dataResultsResearchTableMember($pdo, 'infirmier', $_GET['moteur_recherche']);

        if(!$isThereResult['patient']) {

            if(!$isThereResult['infirmier']) {

                echo '<p>Aucun résultat.</p>';

            }

        }
        ?>

        <?php endif; ?>

        <?php if(isset($_SESSION['userPersonnel']) && $_SESSION['userPersonnel']['type'] == 'admin') : ?>

        <?php
        $isThereResult = dataResultsResearchTableMember($pdo, 'patient', $_GET['moteur_recherche']);
        $isThereResult = dataResultsResearchTableMember($pdo, 'infirmier', $_GET['moteur_recherche']);
        $isThereResult = dataResultsResearchTableMember($pdo, 'medecin', $_GET['moteur_recherche']);

        if(!$isThereResult['patient']) {

            if(!$isThereResult['infirmier']) {

                if (!$isThereResult['medecin']) {
                    echo '<p>Aucun résultat.</p>';
                }

            }

        }

        ?>

        <?php endif; ?>

        <?php endif; ?>

    </table>
    
       
</body>
</html>