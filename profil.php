<?php
require_once "config.php";

if (!isset($_SESSION['userAdmin']) && !isset($_SESSION['userPersonnel'])) {

    if(isset($_SESSION['userPatient'])) {

        session_destroy();
        header('Location:connexion?erreur=4.php');
        exit();

    }

    session_destroy();
    header('Location:connexion?erreur=3.php');
    exit();
}

if(!isset($_GET['id_patient']) && !isset($_GET['id_infirmier']) && !isset($_GET['id_medecin'])) {
    header('Location:tableau_de_bord_personnel?erreur=4.php');
    exit();
}

if(isset($_GET['id_patient'])) {
    $id = $_GET['id_patient'];
}
elseif(isset($_GET['id_infirmier'])) {
    $id = $_GET['id_infirmier'];
}
elseif(isset($_GET['id_medecin'])) {
    $id = $_GET['id_medecin'];
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

        <!--///////////////////////////////-->
        <!-- AFFICHAGE DES DONNÉES PATIENT -->
        <!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->

        <?php if(isset($_GET['id_patient'])) : ?>

        <?php $sql = "SELECT * FROM patient WHERE id_patient='".$id."'";
              $pre = $pdo->prepare($sql);
              $pre->execute();
              $userPatient = current($pre->fetchAll(PDO::FETCH_ASSOC));
        ?>

        <?php if(isset($_SESSION['userPersonnel']) || isset($_SESSION['userAdmin'])) : ?>

        <?php if ($userPatient == null) {
                header('Location:tableau_de_bord_personnel?erreur=4.php');
                exit();
              }
        ?>

        <h1><?php echo $userPatient['nom'] . ', ' . $userPatient['prenom']; ?></h1>

        <table class="donnees_utilisateur">
            <thead class="titrage_donnees">
                <tr>
                    <th>ID</th>
                    <th>EMAIL</th>
                    <th>DESCRIPTION</th>
                </tr>
            </thead>

                <tr>
                    <td>
                        <?php echo $userPatient['id_patient'] ?>
                    </td>

                    <td>
                        <?php if($userPatient['mail'] == null) {
                                echo '<a>AJOUTER</a>';
                              }
                              else {
                                  echo $userPatient['mail'];
                              }

                        ?>
                    </td>
                    <td>
                        <?php if($userPatient['description'] == null) {
                                  echo '<a href="">AJOUTER</a>';
                              }
                              else {
                                  echo $userPatient['description'];
                              }

                        ?>
                    </td>
                </tr>
            <thead class="titrage_donnees">
                <tr>
                    <th>TYPE D'UTILISATEUR</th>
                    <th>TÉLÉPHONE</th>
                    <th>ADRESSE</th>
                </tr>
            </thead>
                <tr>
                    <td>Patient</td>
                    <td><?php if($userPatient['tel'] == null) {
                                echo '<a>AJOUTER</a>';
                              }
                              else {
                                  echo $userPatient['tel'];
                              }

                        ?>
                    
                    </td>

                    <td>
                        <?php if($userPatient['adresse'] == null) {
                                  echo '<a>AJOUTER</a>';
                              }
                              else {
                                  echo $userPatient['adresse'];
                              }

                        ?>

                    </td>
                </tr>  
        </table>

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

        <?php endif; ?>
        <?php endif; ?>

        <!--///////////////////////////////-->
        <!-- AFFICHAGE DES DONNÉES INFIRMIER -->
        <!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->

        <!--///////////////////////////////-->
        <!-- AFFICHAGE DES DONNÉES MÉDECIN -->
        <!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->

    </body>
</html>