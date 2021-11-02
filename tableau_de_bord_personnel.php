<?php
require_once "config.php";
include("backend/conditions_accès_page_personnel_et_admin.php");

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

        <tbody>

            <?php
            $sql = "SELECT * FROM patient";
            $pre = $pdo->prepare($sql);
            $pre->execute();
            $users = $pre->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <?php foreach($users as $user) : ?>

            <tr class="contenu_table" onclick="location.href='profil?id_patient=<?php echo $user['id_patient'] ?>' ">

                <td>
                    <?php echo $user['id_patient'] ?>
                </td>

                <td>
                    <?php echo $user['prenom'] . ' ' . $user['nom'] ?>
                </td>

                <td>
                    <?php echo 'Patient' ?>
                </td>

            </tr>

            <?php endforeach; ?>

            <?php if($_SESSION['userAdmin'] || $_SESSION['userPersonnel']['type'] == 'medecin') : ?>

            <?php
                      $sql = "SELECT * FROM personnel WHERE type='infirmier'";
                      $pre = $pdo->prepare($sql);
                      $pre->execute();
                      $users = $pre->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <?php foreach($users as $user) : ?>

            <tr class="contenu_table" data-href="https://www.google.com/" onclick="location.href='profil?id_infirmier=<?php echo $user['id_personnel'] ?>'">

                <td>
                    <?php echo $user['id_personnel'] ?>
                </td>

                <td>
                    <?php echo $user['prenom'] . ' ' . $user['nom'] ?>
                </td>

                <td>
                    <?php echo 'Infirmier' ?>
                </td>

                <td>
                    <?php echo 'N/A' ?>
                </td>

                <td>
                    <?php echo 'N/A' ?>
                </td>

                <td>
                    <?php echo 'N/A' ?>
                </td>

            </tr>

            <?php endforeach; ?>

            <?php endif; ?>

            <?php if($_SESSION['userAdmin']) : ?>

            <?php
                      $sql = "SELECT * FROM personnel WHERE type='medecin'";
                      $pre = $pdo->prepare($sql);
                      $pre->execute();
                      $users = $pre->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <?php foreach($users as $user) : ?>

            <tr class="contenu_table" data-href="https://www.google.com/" onclick="location.href='profil?id_medecin=<?php echo $user['id_personnel'] ?>'">

                <td>
                    <?php echo $user['id_personnel'] ?>
                </td>

                <td>
                    <?php echo $user['prenom'] . ' ' . $user['nom'] ?>
                </td>

                <td>
                    <?php echo 'Médecin' ?>
                </td>

                <td>
                    <?php echo 'N/A' ?>
                </td>

                <td>
                    <?php echo 'N/A' ?>
                </td>

                <td>
                    <?php echo 'N/A' ?>
                </td>

            </tr>

            <?php endforeach; ?>

            <?php endif; ?>

        </tbody>
    </table>


    
</body>
</html>