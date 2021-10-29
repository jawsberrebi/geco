<?php  require_once "config.php";

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

    <h1>Tableau de bord</h1>

    <?php if (isset($_SESSION['userAdmin']) && $_SESSION['userAdmin']) : ?>

    <h2><?php echo 'Bonjour, ' . htmlspecialchars($_SESSION['userAdmin']['nom_utilisateur']) . ' de ' . htmlspecialchars($_SESSION['userAdmin']['nom_hopital']) . ', vous êtes connecté'; ?></h2>

    <?php endif; ?>


    <?php if (isset($_SESSION['userPersonnel']) && $_SESSION['userPersonnel']) : ?>

    <h2><?php echo 'Bonjour, ' . htmlspecialchars($_SESSION['userPersonnel']['nom_utilisateur']) . ' vous êtes connecté'; ?></h2>

    <?php endif; ?>

    <a href="modifier_mon_compte.php" id="modification_compte">Modifier mon compte</a><br />

    <a href="deconnexion.php" id="deconnexion">Déconnexion</a><br />

    <?php if($_SESSION['userAdmin'] || $_SESSION['userPersonnel']['type'] == 'medecin') : ?>

    <a href="ajout?type=patient" class="ajout">Ajouter un nouveau patient</a><br />

    <a href="ajout?type=infirmier" class="ajout">Ajouter un nouvel infirmier</a><br />

    <?php if ($_SESSION['userAdmin']) : ?>

    <a href="ajout?type=medecin" class="ajout">Ajouter un nouveau médecin</a> <!-- Modifier URL-->

    <!-- Y AJOUTER LA CONFIRMATION DE CRÉATION DE COMPTE MÉDECIN-->

    <?php endif; ?>

    <?php if(isset($_GET['confirmation'])){
              $confirmation = $_GET['confirmation'];
              if($confirmation==1) {
                  echo '<p>Un nouveau patient a bien été ajouté à la liste.</p>';
              }
              elseif($confirmation==2) {
                  echo '<p>Un nouvel infirmier a bien été ajouté à la liste.</p>';
              }
              elseif($confirmation==3) {
                  echo '<p>Un nouveau médecin a bien été ajouté à la liste.</p>';
              }
          }?>

    <?php endif; ?>

    <?php if(isset($_GET['confirmation'])){
              $confirmation = $_GET['confirmation'];
              
              if($confirmation==4) {
                  echo '<p>Vos informations ont bien été modifiées.</p>';
              }
          }?>

    <?php if(isset($_GET['erreur'])){
              $erreur = $_GET['erreur'];
              if($erreur==1) {
                  echo '<p class="message_erreur">Vous n\'êtes pas autorisé à accéder à ces informations.</p>';
              }
              elseif($erreur==2) {
                  echo '<p class="message_erreur">Veuillez cliquer sur le bon bouton renvoyant au formulaire d\'ajout correspondant.</p>';
              }
              elseif($erreur==3) {
                  echo '<p class="message_erreur">Il y a eu une erreur lors de l\'envoi des informations. Veuillez réessayer.</p>';
              }
              elseif($erreur==4) {
                  echo '<p class="message_erreur">La page que vous essayez d\'afficher n\'existe pas.</p>';
              }
          }?>

    <!-- Pour rediriger chaque lien vers patient correspondant, voir sur OpenClassroom modification page-->

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