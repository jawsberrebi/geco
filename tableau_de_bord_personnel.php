<?php  require_once "config.php";
//if (!isset($_SESSION['email'])
//{
	//echo('Il faut un email et un message pour soumettre le formulaire.');
    //return;
//} A TESTER
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/style_tableau_de_bord_personnel.css" />
</head>
<body>

    <?php if ($_SESSION) : ?> 

    <h1>Tableau de bord</h1>

    <h2><?php echo 'Bonjour, ' . htmlspecialchars($_SESSION['user']['Email']) . ' vous êtes connecté'; ?></h2>

    <a href="deconnexion.php" id="deconnexion">Déconnexion</a><br />

    <a href="ajout_patient?type=patient" class="ajout">Ajouter un nouveau patient</a><br />

    <a href="ajout_patient?type=infirmier" class="ajout">Ajouter un nouvel infirmier</a>

    <?php if(isset($_GET['confirmation'])){
              $confirmation = $_GET['confirmation'];
              if($confirmation==1) {
                  echo '<p>Un nouveau patient a bien été ajouté à la liste.</p>';
              }
          }?>

    <?php
    $sql = "SELECT * FROM testuser"; 
    $pre = $pdo->prepare($sql); 
    $pre->execute();
    $users = $pre->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <!-- Pour rediriger chaque lien vers patient correspondant, voir sur OpenClassroom modification page-->

    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nom du membre</th>
                <th>Type de membre</th>
                <th>Rythme cardiaque</th>
                <th>Niveau sonore</th>
                <th>Concentration en CO2</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($users as $user) : ?>

            <tr class="contenu_table" data-href="https://www.google.com/" onclick="location.href='https://www.franceculture.fr'">

                <td>
                    <?php echo $user['Email'] ?>
                </td>

                <td>
                    <?php echo $user['Password'] ?>
                </td>

            </tr>

            <?php endforeach; ?>
        </tbody>
    </table>

    <?php else : ?>

    <?php 
    header('Location:connexion?erreur=2.php');
    exit(); ?>

    <?php endif; ?>
    

        

</body>
</html>