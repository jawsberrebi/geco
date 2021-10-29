<?php
include_once("config.php");

//// GÉNÉRATEUR DE MOT DE PASSE ALÉATOIRE
function passwordGenerator(PDO $pdo, int $length) : string
{

    function randomizer(int $length) : string
    {
        $charList = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $finalChar = '';
        for($i=0; $i<$length; $i++){
            $finalChar .= $charList[rand(0, strlen($charList)-1)];
        }
        return $finalChar;
    }

    $realpass = randomizer(8);
    $compareQuery = 'SELECT mdp FROM patient';
    $pre = $pdo->prepare($compareQuery);
    $pre->execute();
    $compare = $pre->fetchAll(PDO::FETCH_ASSOC);

    foreach ($compare as $list_result) {

        while ($realpass == $list_result['mdp']) {

            $realpass = randomizer($length);
        }
    }

    $compareQuery = 'SELECT mdp FROM personnel';
    $pre = $pdo->prepare($compareQuery);
    $pre->execute();
    $compare = $pre->fetchAll(PDO::FETCH_ASSOC);

    foreach ($compare as $list_result) {

        while ($realpass == $list_result['mdp']) {

            $realpass = randomizer($length);
        }
    }

    return $realpass;
}

?>

<?php ////// GÉNÉRATEUR DE TABLEAU DE DONNÉES POUR LES PROFILS DES PATIENT, MÉDECINS, ET INFIRMIERS ?>

<?php function dataGenerator(array $user, string $type) : void {

?>

<h1>
    <?php echo $user['nom'] . ', ' . $user['prenom']; ?>
</h1>

<table class="donnees_utilisateur">
    <thead class="titrage_donnees">
        <tr>
            <th>ID</th>
            <th>EMAIL</th>
            <?php if ($type == 'patient') : ?>
            <th>DESCRIPTION</th>
            <?php endif; ?>
        </tr>
    </thead>

    <tr>
        <?php if($type == 'patient') : ?>
        <td>
            <?php echo $user['id_patient']; ?>
        </td>
        <?php endif; ?>

        <?php if(($type == 'infirmier') || ($type == 'medecin')) : ?>
        <td>
            <?php echo $user['id_personnel']; ?>
        </td>
        <?php endif; ?>

        <td>
            <?php if($user['mail'] == null) {
                      echo '<a>AJOUTER</a>';
                  }
                  else {
                      echo $user['mail'];
                  }

            ?>
        </td>
        <td>
            <?php if ($type == 'patient') : ?>
            <?php if($user['description'] == null) {
                      echo '<a href="">AJOUTER</a>';
                  }
                  else {
                      echo $user['description'];
                  }

            ?>
            <?php endif; ?>
        </td>
    </tr>
    <thead class="titrage_donnees">
        <tr>
            <th>TYPE D'UTILISATEUR</th>
            <th>TÉLÉPHONE</th>

            <?php if($type == 'patient') : ?>
            <th>ADRESSE</th>
            <?php endif; ?>

        </tr>
    </thead>
    <tr>
        <?php if($type == 'patient') : ?>
        <td>Patient</td>
        <?php endif; ?>

        <?php if($type == 'infirmier') : ?>
        <td>Infirmier</td>
        <?php endif; ?>

        <?php if($type == 'medecin') : ?>
        <td>Médecin</td>
        <?php endif; ?>

        <td>
            <?php if($user['tel'] == null) {
                      echo '<a>AJOUTER</a>';
                  }
                  else {
                      echo $user['tel'];
                  }

            ?>

        </td>

        <?php if($type == 'patient') : ?>
        <td>
            <?php if($user['adresse'] == null) {
                      echo '<a>AJOUTER</a>';
                  }
                  else {
                      echo $user['adresse'];
                  }

            ?>

        </td>
        <?php endif; ?>
    </tr>
</table>

<?php

}