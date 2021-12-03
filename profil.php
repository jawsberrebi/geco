<?php
require_once("config.php");
include('backend/conditions_accès_page_personnel_et_admin.php');
include('backend/fonctions.php');
include('backend/conditions_id.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/style_tableau_de_bord_personnel.css" />
        <link rel="stylesheet" href="css/navbar_pro.css">
        <title>Tableau de bord</title>
    </head>
    <header>
        <nav>
            <a href="#" class="nav-logo">Geco.</a>

            <ul>
            <li><a class="active" href="tableau_de_bord_personnel.php">Tableau de bord</a></li>
            <li><a href="modifier_mon_compte.php" id="profil">Modifier mon compte</a></li>
            <li><a href="deconnexion.php" id="deconnexion">Déconnexion</a></li>
            </ul>

        </nav>  
    </header>
    <body>

        <!--///////////////////////////////-->
        <!-- AFFICHAGE DES DONN�ES PATIENT -->
        <!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->

        <?php if(isset($_GET['id_patient'])) : ?>

        <?php $sql = "SELECT * FROM patient WHERE id_patient='".$id."'";
              $pre = $pdo->prepare($sql);
              $pre->execute();
              $userPatientProfil = current($pre->fetchAll(PDO::FETCH_ASSOC));
        ?>

        <?php if(isset($_SESSION['userPersonnel'])) : ?>

        <?php

            if ($userPatientProfil['id_hopital'] != $_SESSION['userPersonnel']['id_hopital']) {
                header('Location:tableau_de_bord_personnel?erreur=1.php');
                exit();
              }


        ?>

        <?php if ($userPatientProfil == null) {
                header('Location:tableau_de_bord_personnel?erreur=4.php');
                exit();
              }
        ?>

        <?php echo dataUserGenerator($userPatientProfil, 'patient'); ?>

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

                        <form method="post" action="backend/envoi_valeurs?id_patient=<?php echo $id ?>.php">
                            <input name="type" value="cardiaque" type="hidden"/>
                            <input type="range" min="0" max="100" id="curseur_rouge" name="valeur"/> <input type="submit" value="Envoyer" id="bouton_rouge"/>
                        </form>

                        <?php 
                            if(isset($_GET['confirmation'])){
                                if($_GET['confirmation'] == 1){
                                    echo '<p>La valeur de la sensibilité pour ce capteur a bien été modifiée</p>';
                                }
                            }
                        ?>
                    </div>

                    

                    <div class="cadran">
                        <p id="text">
                            Test
                        </p>

                        <form method="post" action="backend/envoi_valeurs?id_patient=<?php echo $id ?>.php">
                            <input name="type" value="son" type="hidden"/>
                            <input type="range" min="0" max="100" id="curseur_bleu" name="valeur"/> <input type="submit" value="Envoyer" id="bouton_bleu"/>
                        </form>

                        <?php 
                            if(isset($_GET['confirmation'])){
                                if($_GET['confirmation'] == 2){
                                    echo '<p>La valeur de la sensibilité pour ce capteur a bien été modifiée</p>';
                                }
                            }
                        ?>
                    </div>

                    <div class="cadran">
                        <p id="text">
                            Test
                        </p>
                        
                        <form method="post" action="backend/envoi_valeurs?id_patient=<?php echo $id ?>.php">
                            <input name="type" value="gaz" type="hidden"/>
                            <input type="range" min="0" max="100" id="curseur_vert" name="valeur"/> <input type="submit" value="Envoyer" id="bouton_vert"/>
                        </form>

                        <?php 
                            if(isset($_GET['confirmation'])){
                                if($_GET['confirmation'] == 3){
                                    echo '<p>La valeur de la sensibilité pour ce capteur a bien été modifiée</p>';
                                }
                            }
                        ?>
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

        <?php else : ?>
        <?php
                  header('Location:tableau_de_bord_personnel?erreur=1.php');
                  exit();
        ?>

        <?php endif; ?>
        <?php endif; ?>

        <!--///////////////////////////////-->
        <!-- AFFICHAGE DES DONN�ES INFIRMIER -->
        <!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->

        <?php if(isset($_GET['id_infirmier'])) : ?>

        <?php $sql = "SELECT * FROM personnel WHERE id_personnel='".$id."'";
              $pre = $pdo->prepare($sql);
              $pre->execute();
              $userInfirmierProfil = current($pre->fetchAll(PDO::FETCH_ASSOC));
        ?>

        <?php if((isset($_SESSION['userPersonnel']) && ($_SESSION['userPersonnel']['type'] == 'admin')) || (isset($_SESSION['userPersonnel']) && ($_SESSION['userPersonnel']['type'] == 'medecin'))) : ?>

        <?php

            if ($userInfirmierProfil['id_hopital'] != $_SESSION['userPersonnel']['id_hopital']) {
                header('Location:tableau_de_bord_personnel?erreur=1.php');
                exit();
            }


        ?>

        <?php if ($userInfirmierProfil == null) {
                header('Location:tableau_de_bord_personnel?erreur=4.php');
                exit();
              }
        ?>

        <?php echo dataUserGenerator($userInfirmierProfil, 'infirmier'); ?>

        <?php else : ?>
        <?php
                  header('Location:tableau_de_bord_personnel?erreur=1.php');
                  exit();
        ?>

        <?php endif; ?>

        

        <?php endif; ?>

        <!--///////////////////////////////-->
        <!-- AFFICHAGE DES DONN�ES M�DECIN -->
        <!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->

        <?php if(isset($_GET['id_medecin'])) : ?>

        <?php $sql = "SELECT * FROM personnel WHERE id_personnel='".$id."'";
              $pre = $pdo->prepare($sql);
              $pre->execute();
              $userMedecinProfil = current($pre->fetchAll(PDO::FETCH_ASSOC));
        ?>

        <?php if(isset($_SESSION['userPersonnel']) && $_SESSION['userPersonnel']['type'] == 'admin') :?>

        <?php

            if ($userMedecinProfil['id_hopital'] != $_SESSION['userPersonnel']['id_hopital']) {
                header('Location:tableau_de_bord_personnel?erreur=1.php');
                exit();
            }

        ?>

        <?php if ($userMedecinProfil == null) {
                header('Location:tableau_de_bord_personnel?erreur=4.php');
                exit();
              }
        ?>

        <?php echo dataUserGenerator($userMedecinProfil, 'medecin'); ?>

        <?php else : ?>
        <?php
                  header('Location:tableau_de_bord_personnel?erreur=1.php');
                  exit();
        ?>
        <?php endif; ?>

        <?php endif; ?>

    </body>
</html>