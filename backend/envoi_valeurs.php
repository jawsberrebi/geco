<?php

if(empty($_POST['valeur'])){
    header('Location:../tableau_de_bord_personnel?erreur=3.php');
}

if(!isset($_GET['id_patient'])){
    header('Location:../tableau_de_bord_personnel?erreur=3.php');
}



////// CR�ATION DE LA TRAME D'ENVOI

$beginingFrame = "1G5A1"; //D�but de la cha�ne o� on sp�cifie le nom du fichier log, et le type de requ�te voulue, ici requ�te en �criture
$valueSensorSensitivity = htmlspecialchars($_POST['type']); //Type de capteur

//Assignation du type de capteur pour la trame (on a assigne la valeur du int ou string correspondante � la valeur du type de capteur
if($valueSensorSensitivity == 'cardiaque'){
    $valueSensorSensitivity = 7;
}
elseif($valueSensorSensitivity == 'son'){
    $valueSensorSensitivity = 'A';
}
elseif($valueSensorSensitivity == 'gaz'){
    $valueSensorSensitivity = 4;
}
else{
    header('Location:../tableau_de_bord_personnel?erreur=3.php');
}

//ID du patient donn� par le $_GET['id_patient']
$valueSensitivity = htmlspecialchars($_POST['valeur']); //Valeur de la sensibilit� � envoyer
$timestampSensitivity = time(); //Timestamp de l'envoi

//Cr�ation du checksum
$brutChecksum = crc32($beginingFrame . $valueSensorSensitivity . $_GET['id_patient'] . $valueSensitivity . $timestampSensitivity);
$finalChecksum = $brutChecksum % 256; //Checksum de la trame (somme de tous les caract�res modulo 256)

//Date et heure de la trame
$daySensitivity = date('d');
$monthSensitivity = date('m');
$yearSensitivity = date('Y');
$hourSensitivity = date('H');
$minuteSensitivity = date('i');
$secondSensitivity = date('s');

//Concat�nation des variables pr�c�dentes en une trame finale pr�te � l'envoi
$finalFrame = $beginingFrame . $valueSensorSensitivity . $_GET['id_patient'] . $valueSensitivity . $timestampSensitivity . $finalChecksum . $yearSensitivity . $monthSensitivity . $daySensitivity . $hourSensitivity . $minuteSensitivity . $secondSensitivity;






echo $valueSensitivity;
echo $valueSensorSensitivity;

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://projets-tomcat.isep.fr:8080/appService/?ACTION=COMMAND&TEAM=G5A4&TRAME=' . $finalFrame,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

if($response = "Commande envoy�e"){
    if($valueSensorSensitivity == 7){
        header('Location:../profil?id_patient=' . $_GET['id_patient'] . '&confirmation=1.php');
    }
    elseif($valueSensorSensitivity == 'A'){
        header('Location:../profil?id_patient=' . $_GET['id_patient'] . '&confirmation=2.php');
    }
    elseif($valueSensorSensitivity == 4){
        header('Location:../profil?id_patient=' . $_GET['id_patient'] . '&confirmation=3.php');
    }
    else{
        header('Location:../tableau_de_bord_personnel?erreur=3.php');
    }
}
else{
    header('Location:../tableau_de_bord_personnel?erreur=3.php');
}

?>