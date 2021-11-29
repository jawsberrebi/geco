<?php

if(empty($_POST['valeur'])){
    header('Location:tableau_de_bord_personnel.php');
}

$valueSensitivity = htmlspecialchars($_POST['valeur']);
$valueSensorSensitivity = htmlspecialchars($_POST['type']);

echo $valueSensitivity;
echo $valueSensorSensitivity;



$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://projets-tomcat.isep.fr:8080/appService/?ACTION=COMMAND&TEAM=G5A4&TRAME=1G5A43301009900017c20211108143513',
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

?>