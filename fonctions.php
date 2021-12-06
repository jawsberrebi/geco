<?php
include_once("config.php");


//// GÉNÉRATEUR DE MOT DE PASSE AL�ATOIRE
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


<?php ////// GÉNÉRATEUR DE DONNÉES POUR LES PROFILS DES PATIENT, MÉDECINS, ET INFIRMIERS ?>

<?php function dataUserGenerator(array $user, string $type) : void {

?>

<meta charset="utf-8" />
<h1>
    <?php echo $user['nom'] . ', ' . $user['prenom']; ?>
</h1>

<?php if((isset($_SESSION['userAdmin']) && $_SESSION['userAdmin']) || (isset($_SESSION['userPersonnel']) && ($_SESSION['userPersonnel']['type'] == 'medecin'))) : ?>

<?php if($type == 'patient') : ?>
<a href="backend/suppression?id_patient=<?php echo $user['id_patient'] ?>" id="supprimer">Supprimer 🗑 </a>

<?php endif; ?>
<?php endif; ?>

<?php if((isset($_SESSION['userAdmin']) && $_SESSION['userAdmin']) || (isset($_SESSION['userPersonnel']) && ($_SESSION['userPersonnel']['type'] == 'medecin'))) : ?>

<?php if($type == 'infirmier') : ?>
<a href="backend/suppression?id_infirmier=<?php echo $user['id_personnel'] ?>" id="supprimer">Supprimer 🗑 </a>

<?php endif; ?>
<?php endif; ?>

<?php if(isset($_SESSION['userAdmin'])) : ?>

<?php if($type == 'medecin') : ?>
<a href="backend/suppression?id_medecin=<?php echo $user['id_personnel'] ?>" id="supprimer">Supprimer 🗑 </a>

<?php endif; ?>
<?php endif; ?>

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
                      echo '<a href="">AJOUTER</a>';
                  }
                  else {
                      echo $user['tel'];
                  }

            ?>

        </td>

        <?php if($type == 'patient') : ?>
        <td>
            <?php if($user['adresse'] == null) {
                      echo '<a href="">AJOUTER</a>';
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
?>


<?php //// GÉNÉRATEUR DE TABLEAU DE MEMBRES (POUR LE TABLEAU DE BORD DU PERSONNEL ?>

<?php
function dataTableMembersGenerator(PDO $pdo, string $userType, bool $querySearch, string $superVariableGet) : void {

?>

        <tbody>

            <!-- SI ON VEUT GÉNÉRER UNE TABLE DE PATIENTS-->
            <?php if ($userType == 'patient') : ?>
            <?php if ($querySearch == false) : ?>
            <?php
                      $sql = "SELECT * FROM patient ORDER BY id_patient DESC";
                      $pre = $pdo->prepare($sql);
                      $pre->execute();
                      $users = $pre->fetchAll(PDO::FETCH_ASSOC);?>

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
            <?php endif; ?>



            <?php if ($querySearch == true) : ?>

            <?php
                if(isset($superVariableGet) && !empty($superVariableGet)) {
                $search = htmlspecialchars($superVariableGet);

                $sql = 'SELECT * FROM patient WHERE prenom LIKE "%'.$search.'%" OR nom LIKE "%'.$search.'%" ORDER BY id_patient DESC';
                $pre = $pdo->prepare($sql);
                $pre->execute();
                $searchResults = $pre->fetchAll(PDO::FETCH_ASSOC);

                }

            ?>

            <?php foreach($searchResults as $user) : ?>

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
            <?php endif; ?>

            <?php endif; ?>





            <!-- SI ON VEUT GÉNÉRER UNE TABLE D'INFIRMIERS-->
            <?php if ($userType == 'infirmier') : ?>
            <?php
                      $sql = "SELECT * FROM personnel WHERE type='infirmier' ORDER BY id_personnel DESC";
                      $pre = $pdo->prepare($sql);
                      $pre->execute();
                      $users = $pre->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <?php foreach($users as $user) : ?>

            <tr class="contenu_table" onclick="location.href='profil?id_infirmier=<?php echo $user['id_personnel'] ?>'">

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




            <?php if ($querySearch == true) : ?>
            <?php if ($userType == 'infirmier') : ?>

            <?php
                    if(isset($superVariableGet) && !empty($superVariableGet)) {
                        $search = htmlspecialchars($superVariableGet);

                        $sql = 'SELECT * FROM personnel WHERE prenom LIKE ("%'.$search.'%" OR nom LIKE "%'.$search.'%") AND (type="infirmier") ORDER BY id_personnel DESC';
                        $pre = $pdo->prepare($sql);
                        $pre->execute();
                        $searchResults = $pre->fetchAll(PDO::FETCH_ASSOC);

                    }
            ?>

            <?php foreach($searchResults as $user) : ?>

            <tr class="contenu_table" onclick="location.href='profil?id_infirmier=<?php echo $user['id_personnel'] ?>'">

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
            <?php endif; ?>


            <!-- SI ON VEUT GÉNÉRER UNE TABLE DE MÉDECINS-->
            <?php if ($userType == 'medecin') : ?>
            <?php
                    $sql = "SELECT * FROM personnel WHERE type='medecin' ORDER BY id_personnel DESC";
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

<?php


}
?>


<?php //// GÉNÉRATEUR DE RÉSULTATS DE TABLEAU DE MEMBRES (POUR LE TABLEAU DE BORD DU PERSONNEL) ?>
<?php
function dataResultsResearchTableMember(PDO $pdo, string $userType, string $superVariableGet) : array {

    $isThereResult = [
        'patient' => false,
        'infirmier' => false,
        'medecin' => false
        ];
    
?>

    <tbody>


        <?php if($userType == 'patient') : ?>

        <?php
            if(isset($superVariableGet) && !empty($superVariableGet)) {
                $search = htmlspecialchars($superVariableGet);

                $sql = 'SELECT * FROM patient WHERE prenom LIKE "%'.$search.'%" OR nom LIKE "%'.$search.'%" ORDER BY id_patient DESC';
                $pre = $pdo->prepare($sql);
                $pre->execute();
                $searchResults = $pre->fetchAll(PDO::FETCH_ASSOC);

                if(!empty($searchResults)) {
                    $isThereResult['patient'] = true;
                }

            }

        ?>

        <?php foreach($searchResults as $user) : ?>

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





        <?php elseif($userType == 'infirmier') : ?>

        <?php
            if(isset($superVariableGet) && !empty($superVariableGet)) {
                $search = htmlspecialchars($superVariableGet);

                $sql = 'SELECT * FROM personnel WHERE (type="infirmier") AND (prenom LIKE "%'.$search.'%" OR nom LIKE "%'.$search.'%") ORDER BY id_personnel DESC';
                $pre = $pdo->prepare($sql);
                $pre->execute();
                $searchResults = $pre->fetchAll(PDO::FETCH_ASSOC);

                if(!empty($searchResults)) {
                    $isThereResult['infirmier'] = true;
                }

            }

        ?>

        <?php foreach($searchResults as $user) : ?>

        <tr class="contenu_table" onclick="location.href='profil?id_infirmier=<?php echo $user['id_personnel'] ?>'">

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



        <?php elseif ($userType == 'medecin') : ?>

        <?php
            if(isset($superVariableGet) && !empty($superVariableGet)) {
                $search = htmlspecialchars($superVariableGet);

                $sql = 'SELECT * FROM personnel WHERE (type="medecin") AND (prenom LIKE "%'.$search.'%" OR nom LIKE "%'.$search.'%") ORDER BY id_personnel DESC';
                $pre = $pdo->prepare($sql);
                $pre->execute();
                $searchResults = $pre->fetchAll(PDO::FETCH_ASSOC);

                if(!empty($searchResults)) {
                    $isThereResult['medecin'] = true;
                }

            }
        ?>

        <?php foreach($searchResults as $user) : ?>

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

<?php
    return $isThereResult;
}

?>