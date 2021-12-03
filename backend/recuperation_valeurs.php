<?php

include_once("config.php");
include('fonctions.php');

$idPatient = $_SESSION['userPatient']['id_patient'];
$url = "http://projets-tomcat.isep.fr:8080/appService/?ACTION=GETLOG&TEAM=G5A4";
//Récupération séquence en hexadécimal
$trame = getFrameValue($url);

//var_dump($trame);

//décodage avec des substring
$t = substr($trame,0,1);
$o = substr($trame,1,4);

// $o = valeur de la trame

// décodage avec sscanf
list($t, $o, $r, $c, $n, $v, $a, $x, $year, $month, $day, $hour, $min, $sec) =
sscanf($trame,"%1s%4s%1s%1s%2s%4s%4s%2s%4s%2s%2s%2s%2s%2s");
echo("<br />$t,$o,$r,$c,$n,$v,$a,$x,$year,$month,$day,$hour,$min,$sec<br />");

$numbTra = $t;
$idPage = $o;
$typeRequest = $r;
$typeSensor = $c;
$numbSensor = $n; //Numéro d'appareil. Sera associé à l'ID du patient [RÉGLER CE SOUCI : PEU D'ESPACE DANS LA TRAME, ON PEUT FAIRE ÇA QUE SUR 2 CARACTERES GRAND MAX]
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
    // 7 ---> fréquence cardiaque
    // A ---> son
    // 4 --> gaz

    if($typeSensor == 7){ //Remplacer par 7 pour avoir le capteur fréquence cardiaque

        //RECUPERE L'ID DU CAPTEUR À PARTIR DE L'ID PATIENT CORRESPONDANT

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


            //Envoi de l'alerte mail
            if($value > 120){
                //Préparation du mail pour l'envoi de l'alerte

                $sql = "SELECT prenom, nom, id_hopital FROM patient WHERE id_patient = '".$idPatient."'";
                $pre = $pdo->prepare($sql);
                $pre->execute();
                $infos = $pre->fetchAll(PDO::FETCH_ASSOC);

                $firstName= $infos[0]['prenom'];
                $lastName = $infos[0]['nom'];
                $idHospital = $infos[0]['id_hopital'];

                $sql = "SELECT mail FROM personnel WHERE id_hopital = '".$idHospital."'";
                $pre = $pdo->prepare($sql);
                $pre->execute();
                $mails = $pre->fetchAll(PDO::FETCH_ASSOC);

                //On envoie à  tous le personnel de l'hôpital correspondant 
                foreach($mails as $mail){
                    sendingMailAlert($mail['mail'], 'cardiaque', $value, $firstName . $lastName);
                }
                
            }
            
        }


    }
    elseif($typeSensor == 'A'){ // Son

        //RECUPERE L'ID DU CAPTEUR À PARTIR DE L'ID PATIENT CORRESPONDANT

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

            //Envoi de l'alerte mail
            if($value > 70){
                //Préparation du mail pour l'envoi de l'alerte

                $sql = "SELECT prenom, nom, id_hopital FROM patient WHERE id_patient = '".$idPatient."'";
                $pre = $pdo->prepare($sql);
                $pre->execute();
                $infos = $pre->fetchAll(PDO::FETCH_ASSOC);

                $firstName= $infos[0]['prenom'];
                $lastName = $infos[0]['nom'];
                $idHospital = $infos[0]['id_hopital'];

                $sql = "SELECT mail FROM personnel WHERE id_hopital = '".$idHospital."'";
                $pre = $pdo->prepare($sql);
                $pre->execute();
                $mails = $pre->fetchAll(PDO::FETCH_ASSOC);

                //On envoie à  tous le personnel de l'hôpital correspondant 
                foreach($mails as $mail){
                    sendingMailAlert($mail['mail'], 'sonore', $value, $firstName . $lastName);
                }
                
            }
        }

    }
    elseif($typeSensor == 4){ //Gaz

        //RECUPERE L'ID DU CAPTEUR À PARTIR DE L'ID PATIENT CORRESPONDANT

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

            //Envoi de l'alerte mail
            if($value > 1.3){
                //Préparation du mail pour l'envoi de l'alerte

                $sql = "SELECT prenom, nom, id_hopital FROM patient WHERE id_patient = '".$idPatient."'";
                $pre = $pdo->prepare($sql);
                $pre->execute();
                $infos = $pre->fetchAll(PDO::FETCH_ASSOC);

                $firstName= $infos[0]['prenom'];
                $lastName = $infos[0]['nom'];
                $idHospital = $infos[0]['id_hopital'];

                $sql = "SELECT mail FROM personnel WHERE id_hopital = '".$idHospital."'";
                $pre = $pdo->prepare($sql);
                $pre->execute();
                $mails = $pre->fetchAll(PDO::FETCH_ASSOC);

                //On envoie à  tous le personnel de l'hôpital correspondant 
                foreach($mails as $mail){
                    sendingMailAlert($mail['mail'], 'de gaz', $value, $firstName . $lastName);
                }
                
            }
        }

        //INSÉRER LA FONCTION MAIL POUR L'ENVOI D'ALERTE
    }
}
?>