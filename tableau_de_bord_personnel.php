<?php  require_once "config.php";
//if (!isset($_SESSION['email'])
//{
	//echo('Il faut un email et un message pour soumettre le formulaire.');
    //return;
//} A TESTER
?>

<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/style_tableau_de_bord_personnel.css" />
</head>
<body>



    <h1>Tableau de bord</h1>

    <h2><?php echo 'Bonjour, ' . htmlspecialchars($_SESSION['user']['Email']) . ' vous êtes connecté'; ?></h2>

    <?php
    $sql = "SELECT * FROM testuser"; 
    $pre = $pdo->prepare($sql); 
    $pre->execute();
    $data = $pre->fetchAll(PDO::FETCH_ASSOC);
    ?>

    
    
    <table>
        <tr>
            <th>Id</th>
            <th>Nom du membre</th>
            <th>Type de membre</th>
            <th>Rythme cardiaque</th>
            <th>Niveau sonore</th>
            <th>Concentration en CO2</th>
        </tr>
        <?php foreach($data as $user) : ?>
        <tr>

            <td class="contenu_table">
                <?php echo $user['Email'] ?>
            </td>

        </tr>
        <?php endforeach; ?>
    </table>
    

        

</body>
</html>