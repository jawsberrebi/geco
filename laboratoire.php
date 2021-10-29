<?php
include_once("config.php");
include('backend/fonctions.php');

echo passwordGenerator($pdo, 8);
?>

<h1>
    <?php echo $userPatient['nom'] . ', ' . $userPatient['prenom']; ?>
</h1>

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
        <td>
            <?php if($userPatient['tel'] == null) {
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