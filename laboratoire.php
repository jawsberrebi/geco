<?php
include_once("config.php");
include('backend/fonctions.php');
?>

<?php
$sql = 'SELECT MAX(id_patient) FROM patient';
$pre = $pdo->prepare($sql);
$pre->execute();
$idPatientTab = $pre->fetchAll(PDO::FETCH_ASSOC);



$idPatient = $idPatientTab[0]['MAX(id_patient)'];

echo $idPatient;


$sql = 'INSERT INTO capteur(id_patient, type) VALUES (:id_patient, :type)';
$pre = $pdo->prepare($sql);
$pre->execute([
    'id_patient' => $idPatient,
    'type' => 'frequenceCardiaque',
    ]);
?>