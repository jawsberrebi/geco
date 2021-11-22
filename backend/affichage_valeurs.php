<?php 
include_once("config.php");

$patientId = $_SESSION['userPatient']['id_patient'];
//var_dump($patientId);

$sql = "SELECT id_capteur FROM capteur WHERE id_patient = '".$patientId."'";
$pre = $pdo->prepare($sql);
$pre->execute();
$sensorId = $pre->fetchAll(PDO::FETCH_ASSOC);

//var_dump($sensorId[0]['id_capteur']);

$sql = "SELECT valeur FROM patient p JOIN capteur c ON '".$patientId."' = c.id_patient JOIN mesure m ON c.id_capteur = m.id_capteur WHERE m.id_capteur = '".$sensorId[0]['id_capteur']."'";
$pre = $pdo->prepare($sql);
$pre->execute();
$cardiacValues = $pre->fetchAll(PDO::FETCH_ASSOC);
$finalValues[0] = end($cardiacValues);
//var_dump($cardiacValues);
//var_dump($finalValues);


$sql = "SELECT valeur FROM patient p JOIN capteur c ON '".$patientId."' = c.id_patient JOIN mesure m ON c.id_capteur = m.id_capteur WHERE m.id_capteur = '".$sensorId[1]['id_capteur']."'";
$pre = $pdo->prepare($sql);
$pre->execute();
$soundValues = $pre->fetchAll(PDO::FETCH_ASSOC);
$finalValues[1] = end($soundValues);
//var_dump($soundValues);
//var_dump($finalValues);

$sql = "SELECT valeur FROM patient p JOIN capteur c ON '".$patientId."' = c.id_patient JOIN mesure m ON c.id_capteur = m.id_capteur WHERE m.id_capteur = '".$sensorId[2]['id_capteur']."'";
$pre = $pdo->prepare($sql);
$pre->execute();
$gasValues = $pre->fetchAll(PDO::FETCH_ASSOC);
$finalValues[2] = end($gasValues);
//var_dump($gasValues);
//var_dump($finalValues);

?>