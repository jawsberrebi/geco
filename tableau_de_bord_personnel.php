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

    <?php
    $sql = "SELECT * FROM testuser"; 
    $pre = $pdo->prepare($sql); 
    $pre->execute();
    $users = $pre->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <a href="deconnexion.php" id="deconnexion">Déconnexion</a>
   
    <table>
        <tr>
            <th>Id</th>
            <th>Nom du membre</th>
            <th>Type de membre</th>
            <th>Rythme cardiaque</th>
            <th>Niveau sonore</th>
            <th>Concentration en CO2</th>
        </tr>

        <?php foreach($users as $user) : ?>

        <tr class="contenu_table">

            <td>
                <?php echo $user['Email'] ?>
            </td>

            <td>
                <?php echo $user['Password'] ?>
            </td>

        </tr>

        <?php endforeach; ?>
    </table>

    <?php else : ?>

    <p id="message_erreur">Veuillez vous connecter si vous souhaitez accéder à votre tableau de bord. </p>

    <?php endif; ?>
    

        

</body>
</html>