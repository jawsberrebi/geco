<?php  require_once "config.php";?>

<html>
<head>
    <meta charset="utf-8" />
    <!-- importer le fichier de style -->
</head>
<body>
    <div>
        <!-- tester si l'utilisateur est connect� -->
        <h1><?php echo 'Bonjour, ' . $_SESSION['user']['Email'] . ' vous êtes connecté'; ?></h1>

    </div>



</body>
</html>