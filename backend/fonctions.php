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
<script src="Javascript/confirme_suppression.js"></script>

<div class="titre_profil">
    <h1>
        <?php echo $user['nom'] . ', ' . $user['prenom']; ?>
    </h1>

    <?php if((isset($_SESSION['userPersonnel']) && ($_SESSION['userPersonnel']['type'] == 'admin')) || (isset($_SESSION['userPersonnel']) && ($_SESSION['userPersonnel']['type'] == 'medecin'))) : ?>

    <?php if($type == 'patient') : ?>
    <a href="backend/suppression?id_patient=<?php echo $user['id_patient'] ?>" id="supprimer" onclick="Javascript: return confirme_suppression()">Supprimer 🗑 </a>

    <?php endif; ?>
    <?php endif; ?>
</div>

<?php if((isset($_SESSION['userPersonnel']) && ($_SESSION['userPersonnel']['type'] == 'admin')) || (isset($_SESSION['userPersonnel']) && ($_SESSION['userPersonnel']['type'] == 'medecin'))) : ?>

<?php if($type == 'infirmier') : ?>
<a href="backend/suppression?id_infirmier=<?php echo $user['id_personnel'] ?>" id="supprimer" onclick="Javascript: return confirme_suppression()">Supprimer 🗑 </a>

<?php endif; ?>
<?php endif; ?>

<?php if((isset($_SESSION['userPersonnel']) && ($_SESSION['userPersonnel']['type'] == 'admin'))) : ?>

<?php if($type == 'medecin') : ?>
<a href="backend/suppression?id_medecin=<?php echo $user['id_personnel'] ?>" id="supprimer" onclick="Javascript: return confirme_suppression()">Supprimer 🗑 </a>

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
                    if($_SESSION['userPersonnel']['type'] != 'infirmier'){
                        if($type == 'infirmier'){
                           echo '<a href="modification_profil?id_infirmier='. $user['id_personnel'] .'">AJOUTER</a>'; 
                        }
                        elseif($type == 'medecin'){
                           echo '<a href="modification_profil?id_medecin='. $user['id_personnel'] .'">AJOUTER</a>';
                        }
                        else{
                           echo '<a href="modification_profil?id_patient='. $user['id_patient'] .'">AJOUTER</a>'; 
                        }
                      
                    }
                    else{
                      echo 'N/A'; 
                    }
                      
                  }
                  else {
                      echo $user['mail'];
                  }

            ?>
        </td>
        <td>
            <?php if ($type == 'patient') : ?>
            <?php if($user['description'] == null) {
                    if($_SESSION['userPersonnel']['type'] != 'infirmier'){
                      echo '<a href="modification_profil?id_patient='. $user['id_patient'] .'">AJOUTER</a>';  
                    }
                    else{
                        echo 'N/A';
                    }
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
            <?php if($user['tel'] == 0) {
                    if($_SESSION['userPersonnel']['type'] != 'infirmier'){
                      if($type == 'infirmier'){
                          echo '<a href="modification_profil?id_infirmier='. $user['id_personnel'] .'">AJOUTER</a>'; 
                      }
                      elseif($type == 'medecin'){
                          echo '<a href="modification_profil?id_medecin='. $user['id_personnel'] .'">AJOUTER</a>';
                      }
                      else{
                          echo '<a href="modification_profil?id_patient='. $user['id_patient'] .'">AJOUTER</a>';
                      }  
                    }
                    else{
                        echo 'N/A';
                    }
                  }
                  else {
                      echo 0 . $user['tel'];
                  }

            ?>

        </td>

        <?php if($type == 'patient') : ?>
        <td>
            <?php if($user['adresse'] == null) {
                    if($_SESSION['userPersonnel']['type'] != 'infirmier'){
                      echo '<a href="modification_profil?id_patient='. $user['id_patient'] .'">AJOUTER</a>';  
                    }
                    else{
                        echo 'N/A';
                    }
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
                      $sql = "SELECT * FROM patient WHERE id_hopital = '".$_SESSION['userPersonnel']['id_hopital']."' ORDER BY id_patient DESC";
                      $pre = $pdo->prepare($sql);
                      $pre->execute();
                      $users = $pre->fetchAll(PDO::FETCH_ASSOC);?>

            <?php foreach($users as $user) : ?>

            <tr class="contenu_table" onclick="location.href='profil?id_patient=<?php echo $user['id_patient'] ?>' ">

                <td>
                    <?php echo $user['id_patient'] ?>
                </td>
                     <?php include("backend/affichage_valeurs.php"); ?>
                <td>
                    <?php echo $user['prenom'] . ' ' . $user['nom'] ?>
                </td>

                <td>
                    <?php echo 'Patient' ?>
                </td>

                <td>
                    <?php if(isset($finalValues[0]['valeur'])){
                            echo $finalValues[0]['valeur'];
                          }
                          else{
                              echo '';
                          }
                    ?>
                </td>

                <td>
                    <?php if(isset($finalValues[1]['valeur'])){
                            echo $finalValues[1]['valeur'];
                          }
                          else{
                              echo '';
                          }
                    ?>
                </td>

                <td>
                    <?php if(isset($finalValues[2]['valeur'])){
                            echo $finalValues[2]['valeur'];
                          }
                          else{
                              echo '';
                          }
                    ?>
                </td>

            </tr>

            <?php endforeach; ?>
            <?php endif; ?>



            <?php if ($querySearch == true) : ?>

            <?php
                if(isset($superVariableGet) && !empty($superVariableGet)) {
                $search = htmlspecialchars($superVariableGet);

                $sql = 'SELECT * FROM patient WHERE prenom LIKE "%'.$search.'%" OR nom LIKE "%'.$search.'%" AND id_hopital = "'.$_SESSION['userPersonnel']['id_hopital'].'" ORDER BY id_patient DESC';
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
                      $sql = "SELECT * FROM personnel WHERE type='infirmier' AND id_hopital = '".$_SESSION['userPersonnel']['id_hopital']."' ORDER BY id_personnel DESC";
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

                        $sql = 'SELECT * FROM personnel WHERE prenom LIKE ("%'.$search.'%" OR nom LIKE "%'.$search.'%") AND (type="infirmier") AND id_hopital = "'.$_SESSION['userPersonnel']['id_hopital'].'" ORDER BY id_personnel DESC';
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
                    $sql = "SELECT * FROM personnel WHERE type='medecin' AND id_hopital = '".$_SESSION['userPersonnel']['id_hopital']."' ORDER BY id_personnel DESC";
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
                $sql = 'SELECT * FROM patient WHERE (prenom LIKE ("%'.$search.'%") OR nom LIKE ("%'.$search.'%")) AND (id_hopital = "'.$_SESSION['userPersonnel']['id_hopital'].'") ORDER BY id_patient DESC';
                $pre = $pdo->prepare($sql);
                $pre->execute();
                $searchResults = $pre->fetchAll(PDO::FETCH_ASSOC);

                if(!empty($searchResults)) {
                    $isThereResult['patient'] = true;
                }elseif(empty($searchResults)){
                    $isThereResult['patient'] = false;
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

                $sql = 'SELECT * FROM personnel WHERE (type="infirmier") AND (prenom LIKE ("%'.$search.'%") OR nom LIKE ("%'.$search.'%")) AND (id_hopital = "'.$_SESSION['userPersonnel']['id_hopital'].'") ORDER BY id_personnel DESC';
                $pre = $pdo->prepare($sql);
                $pre->execute();
                $searchResults = $pre->fetchAll(PDO::FETCH_ASSOC);

                if(!empty($searchResults)) {
                    $isThereResult['infirmier'] = true;
                }elseif(empty($searchResults)){
                    $isThereResult['infirmier'] = false;
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

                $sql = 'SELECT * FROM personnel WHERE (type="medecin") AND (prenom LIKE "%'.$search.'%" OR nom LIKE "%'.$search.'%") AND (id_hopital = "'.$_SESSION['userPersonnel']['id_hopital'].'") ORDER BY id_personnel DESC';
                $pre = $pdo->prepare($sql);
                $pre->execute();
                $searchResults = $pre->fetchAll(PDO::FETCH_ASSOC);

                if(!empty($searchResults)) {
                    $isThereResult['medecin'] = true;
                }elseif(empty($searchResults)){
                    $isThereResult['medecin'] = false;
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

<?php

//Envoi d'indentifiants par mail
function sendingIdsMail($mail, $donnees) : void 
{
          $to = $mail;

          $subject = 'Vos identifiants GecoSensor';

          $message = '

          <html>

           <head>

           </head>

           <body>

               <p>Votre compte GecoSensor a bien été créée</p>

               <p>Voici vos identifiants</p></br>

               <ul>

                    <li>Adresse email : '.$donnees[0].'</li>

                    <li>Nom d\'utilisateur : '.$donnees[1].'</li>

               </ul></br>

                <p>Pour créer votre mot de passe, veuillez cliquer sur <a href="http://localhost:8081/geco/modification_mot_de_passe?char=' . $donnees[2] . '&user=' . $donnees[3] . '&type=' . $donnees[4] . '.php">ce lien</a> </p> 
                
               <p>Merci de les conserver précieusement et de ne les divulguer à personne</p>

           </body>

          </html>

          ';

          $headers[] = 'MIME-Version: 1.0';

          $headers[] = 'Content-type: text/html; charset=iso-8859-1';

          mail($to, $subject, $message, implode("\r\n", $headers));

     }

?>

<?php

//Envoi d'indentifiants par mail
function sendingLinkPassword($mail, $donnees) : void 
{
          $to = $mail;

          $subject = 'Lien de réinitialisation pour le mot de passe de votre compte GecoSensor';

          $message = '

          <html>

           <head>

           </head>

           <body>

               <p>Vous avez demandé à réinitialiser le mot de passe de votre compte GecoSensor.</p>

                <p>Pour réinitialiser votre mot de passe, veuillez cliquer sur <a href="http://localhost:8081/geco/modification_mot_de_passe?char=' . $donnees[0] . '&user=' . $donnees[1] . '&type=' . $donnees[2] . '.php">ce lien</a> </p> 
           </body>

          </html>

          ';

          $headers[] = 'MIME-Version: 1.0';

          $headers[] = 'Content-type: text/html; charset=iso-8859-1';

          mail($to, $subject, $message, implode("\r\n", $headers));

     }

?>

<?php 
//Réception de trames
function getFrameValue($url) : string
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://projets-tomcat.isep.fr:8080/appService/?ACTION=GETLOG&TEAM=G5A4");
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $data = curl_exec($ch);
    curl_close($ch);
    //echo "Raw Data:<br />";
    //var_dump($data);

    $data_tab = str_split($data,33);
    //echo "Tabular Data:<br />";
    for($i=0, $size=count($data_tab); $i<$size; $i++){
        //echo "Trame $i: $data_tab[$i]<br />";
    }

    end($data_tab);
    $lastValue = prev($data_tab);
    $trame = $lastValue;

    return $trame;
}

?>

<?php 
//Envoi de mails
function sendingMailAlert($mail, $typeSensor, $value, $patientName) : void
{
    $to = $mail;

    if($typeSensor == 'cardiaque'){
       $unit = 'bpm';
    }
    elseif($typeSensor == 'sonore'){
       $unit = 'dB';
    }
    elseif($typeSensor == 'de gaz'){
       $unit = '%';
    }
          $subject = 'Attention ! La valeur du capteur ' . $typeSensor . ' du patient ' . $patientName . ' semble anormale';



          $message = '

          <html>

           <head>

           </head>

           <body>

               <p>La valeur du capteur ' . $typeSensor . ' de ' . $patientName . ' a excédée le maximum déterminé.</p>

               <p>La dernière valeur enregistrée est de ' . $value . ' ' . $unit .'</p></br>

           </body>

          </html>

          ';



          $headers[] = 'MIME-Version: 1.0';

          $headers[] = 'Content-type: text/html; charset=iso-8859-1';

          //implode("\r\n", $headers)


          mail($to, $subject, $message);
}


?>