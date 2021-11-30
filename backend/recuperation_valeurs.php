<?php

include_once("config.php");
include('fonctions.php');

$idPatient = $_SESSION['userPatient']['id_patient'];
$url = "http://projets-tomcat.isep.fr:8080/appService/?ACTION=GETLOG&TEAM=G5A4";

//R�cup�ration s�quence en hexad�cimal
$trame = getFrameValue($url);

//var_dump($trame);

//d�codage avec des substring
$t = substr($trame,0,1);
$o = substr($trame,1,4);

// $o = valeur de la trame

// d�codage avec sscanf
list($t, $o, $r, $c, $n, $v, $a, $x, $year, $month, $day, $hour, $min, $sec) =
sscanf($trame,"%1s%4s%1s%1s%2s%4s%4s%2s%4s%2s%2s%2s%2s%2s");
echo("<br />$t,$o,$r,$c,$n,$v,$a,$x,$year,$month,$day,$hour,$min,$sec<br />");

//1 - G5A4 - 1 - "inserer type sensor (1 caract�re) " - "logiquement id du patient (2 caract�res)" - "valeur sensibilit� (4 caract�res)" - "timestamp (4 caract�res)" - "checksum (2 caract�res)" - "ann�e (4 caract�res)" - "mois (2 caract�res)" - "jour (2 caract�res)" - "heure (2 caract�res)" - "minute (2 caract�res)" - "seconde (2 caract�res)"
//1G5A41A00004200088220211122150724

$numbTra = $t;
$idPage = $o;
$typeRequest = $r;
$typeSensor = $c;
$numbSensor = $n; //Num�ro d'appareil. Sera associ� � l'ID du patient
$value = $v;
$tim = $a;
$checkseum = $x;
$date = $day . '-' . $month . '-' . $year;
$dateTimestamp = strtotime($date);

//var_dump($typeSensor);
//var_dump($dateTimestamp);

$finalDate = date('Y-m-d', $dateTimestamp);

//var_dump($finalDate);

$finalTime = $hour . ':' . $min . ':' . $sec;

//var_dump($finalTime);

$finalDateTime = $finalDate . ' ' . $finalTime;

//var_dump($finalDateTime);


if(6 == 6){ //Si l'ID du patient correspond bien avec l'ID de l'appareil du patient, pour l'instant ne marche pas, mettre 00
    // Valeurs du simulateur, $typeSensor renvoie le type de capteur
    // 7 ---> fr�quence cardiaque
    // A ---> son
    // 4 --> gaz

    if($typeSensor == 7){ //Remplacer par 7 pour avoir le capteur fr�quence cardiaque

        //RECUPERE L'ID DU CAPTEUR � PARTIR DE L'ID PATIENT CORRESPONDANT

        $sql = "SELECT id_capteur FROM capteur WHERE id_patient = '".$idPatient."' AND type = 'frequenceCardiaque'";
        $pre = $pdo->prepare($sql);
        $pre->execute();
        $idCapteurTab = $pre->fetchAll(PDO::FETCH_ASSOC);
        $idCapteur = $idCapteurTab[0]['id_capteur'];

        //var_dump($idCapteur);


        //RECUPERER DERNIERE VALEUR ENREGISTREE DES MESURES POUR COMPARER AVEC CELLE A ENTRER
        $sql = "SELECT valeur FROM mesure ORDER BY id_capteur = '".$idCapteur."' DESC LIMIT 1";
        $pre = $pdo->prepare($sql);
        $pre->execute();
        $lastValueDataBase = $pre->fetchAll(PDO::FETCH_ASSOC);
        $lastValueDataBase = $lastValueDataBase[0]['valeur'];

        //var_dump($lastValueDataBase);

        if($value != $lastValueDataBase){ //SUPPRIMER le [0]['valeur']
            $sql = 'INSERT INTO mesure(valeur, date_heure, id_capteur) VALUES (:valeur, :date_heure, :id_capteur)';
            $pre = $pdo->prepare($sql);
            $pre->execute([
            'valeur' => $value,
            'date_heure' => $finalDateTime,
            'id_capteur' => $idCapteur, //Remplacer par $idCapteur
            ]);
        }

    
    }
    elseif($typeSensor == 'A'){ // Son

        //RECUPERE L'ID DU CAPTEUR � PARTIR DE L'ID PATIENT CORRESPONDANT

        $sql = "SELECT id_capteur FROM capteur WHERE id_patient = '".$idPatient."' AND type = 'niveauSonore'";
        $pre = $pdo->prepare($sql);
        $pre->execute();
        $idCapteurTab = $pre->fetchAll(PDO::FETCH_ASSOC);
        $idCapteur = $idCapteurTab[0]['id_capteur'];

        //var_dump($idCapteur);


        //RECUPERER DERNIERE VALEUR ENREGISTREE DES MESURES POUR COMPARER AVEC CELLE A ENTRER
        $sql = "SELECT valeur FROM mesure ORDER BY id_capteur = '".$idCapteur."' DESC LIMIT 1";
        $pre = $pdo->prepare($sql);
        $pre->execute();
        $lastValueDataBase = $pre->fetchAll(PDO::FETCH_ASSOC);
        $lastValueDataBase = $lastValueDataBase[0]['valeur'];

        //var_dump($lastValueDataBase);

        if($value != $lastValueDataBase){ //SUPPRIMER le [0]['valeur']
            $sql = 'INSERT INTO mesure(valeur, date_heure, id_capteur) VALUES (:valeur, :date_heure, :id_capteur)';
            $pre = $pdo->prepare($sql);
            $pre->execute([
            'valeur' => $value,
            'date_heure' => $finalDateTime,
            'id_capteur' => $idCapteur, //Remplacer par $idCapteur
            ]);
        }


    }
    elseif($typeSensor == 4){ //Gaz

        //RECUPERE L'ID DU CAPTEUR � PARTIR DE L'ID PATIENT CORRESPONDANT

        $sql = "SELECT id_capteur FROM capteur WHERE id_patient = '".$idPatient."' AND type = 'concentrationGaz'";
        $pre = $pdo->prepare($sql);
        $pre->execute();
        $idCapteurTab = $pre->fetchAll(PDO::FETCH_ASSOC);
        $idCapteur = $idCapteurTab[0]['id_capteur'];

        //var_dump($idCapteur);


        //RECUPERER DERNIERE VALEUR ENREGISTREE DES MESURES POUR COMPARER AVEC CELLE A ENTRER
        $sql = "SELECT valeur FROM mesure ORDER BY id_capteur = '".$idCapteur."' DESC LIMIT 1";
        $pre = $pdo->prepare($sql);
        $pre->execute();
        $lastValueDataBase = $pre->fetchAll(PDO::FETCH_ASSOC);
        $lastValueDataBase = $lastValueDataBase[0]['valeur'];

        //var_dump($lastValueDataBase);

        if($value != $lastValueDataBase){ //SUPPRIMER le [0]['valeur']
            $sql = 'INSERT INTO mesure(valeur, date_heure, id_capteur) VALUES (:valeur, :date_heure, :id_capteur)';
            $pre = $pdo->prepare($sql);
            $pre->execute([
            'valeur' => $value,
            'date_heure' => $finalDateTime,
            'id_capteur' => $idCapteur, //Remplacer par $idCapteur
            ]);
        }


    }
}






?>