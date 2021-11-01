<?php
require_once "config.php";
include("backend/fonctions.php");
include("backend/conditions_accès_page_personnel_et_admin.php");
include("backend/traitement_recherche.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/style_tableau_de_bord_personnel.css" />
    <title>Tableau de bord</title>
</head>
<body>

    <?php if (!isset($_SESSION['userAdmin']) && !isset($_SESSION['userPersonnel'])) {

            header('Location:connexion?erreur=4.php');
            exit();

          }

    ?>

    <!-- MESSAGE D'ACCUEIL-->
    <?php include("backend/message_accueil_tableau_de_bord.php"); ?>
    <!-- OPTION CONNEXION/DECONNEXION -->
    <?php include("backend/fenetre_modale_tableau_de_bord.php"); ?>
    <!-- FONCTIONNALITÉS ADMIN ET MÉDECIN -->
    <?php include("backend/fonctionnalités_admin_medecin_tableau_de_bord_personnel.php") ?>
    <!-- FACTORISATION DES MESSAGES DU TABLEAU DE BORD -->
    <?php include("backend/messages_tableau_de_bord_personnel.php")?>

    <form action="tableau_de_bord_personnel.php" method="post">
        <input type="search" name="moteur_recherche" placeholder="Chercher un membre" id="moteur_recherche" />
        <input type="submit" value="Rechercher"/>
        <!-- AJOUTER UN FILTRE DE RECHERCHE EN FONCTIONNALITÉ SUPPLÉMENTAIRE -->
    </form>




    

    <table>
        <thead>
            <tr>
                <th>Id          </th>
                <th>Nom du membre           </th>
                <th>Type de membre                                              </th>
                <th>Rythme cardiaque            </th>
                <th>Niveau sonore           </th>
                <th>Concentration en CO2            </th>
            </tr>
        </thead>

        <!-- SI L'UTILISATEUR N'A RIEN RENTRÉ DANS LE CHAMP DE RECHERCHE, AFFICHER LA TABLE DE TOUS LES UTILISATEURS -->
        <?php if(!isset($_POST['moteur_recherche']) || empty($_POST['moteur_recherche'])) : ?>



        <!-- GÉNÉRATION DU TABLEAU DES PATIENTS -->
        <?php echo dataTableMembersGenerator($pdo, 'patient'); ?> 


        <?php if($_SESSION['userAdmin'] || $_SESSION['userPersonnel']['type'] == 'medecin') : ?>

        <!-- GÉNÉRATION DU TABLEAU DES INFIRMIERS -->
        <?php echo dataTableMembersGenerator($pdo, 'infirmier'); ?>

        <?php endif; ?>


        
        <?php if($_SESSION['userAdmin']) : ?>

        <!-- GÉNÉRATION DU TABLEAU DES MÉDECINS -->
        <?php echo dataTableMembersGenerator($pdo, 'medecin'); ?>

        <?php endif; ?>


        <!-- SI L'UTILISATEUR N'A RIEN RENTRÉ DANS LE CHAMP DE RECHERCHE, AFFICHER LA TABLE DE TOUS LES UTILISATEURS -->
        <?php else : ?>

        <?php echo $searchResults; ?>

        <?php endif; ?>

    </table>


    
        

</body>
</html>