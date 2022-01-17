<?php 
$patientId = $id;

$sql = "SELECT id_capteur FROM capteur WHERE id_patient = '".$patientId."'";
$pre = $pdo->prepare($sql);
$pre->execute();
$sensorId = $pre->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM mesure WHERE id_capteur = '".$sensorId[0]['id_capteur']."' ";
$pre = $pdo->prepare($sql);
$pre->execute();
$cardiacValuesPlot = $pre->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM mesure WHERE id_capteur = '".$sensorId[1]['id_capteur']."' ";
$pre = $pdo->prepare($sql);
$pre->execute();
$soundValuesPlot = $pre->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM mesure WHERE id_capteur = '".$sensorId[2]['id_capteur']."' ";
$pre = $pdo->prepare($sql);
$pre->execute();
$gasValuesPlot = $pre->fetchAll(PDO::FETCH_ASSOC);

//$patientId = $id;

//$sql = "SELECT id_capteur FROM capteur WHERE id_patient = '".$patientId."'";
//$pre = $pdo->prepare($sql);
//$pre->execute();
//$sensorId = $pre->fetchAll(PDO::FETCH_ASSOC);

//$sql = "SELECT * FROM mesure WHERE id_capteur = '".$sensorId[0]['id_capteur']."' AND date_heure LIKE '2021%' "; //METTRE date('Y') dedans
//$pre = $pdo->prepare($sql);
//$pre->execute();
//$cardiacValuesPlotYear = $pre->fetchAll(PDO::FETCH_ASSOC);


// Algorythme de tri [À VÉRIFIER]
foreach($cardiacValuesPlot as $cardiacValuesPlotReach){
    $maxYearCardiacValuesPlotFinal = 0;
    $maxMonthCardiacValuesPlotFinal = 0;
    $maxDayCardiacValuesPlotFinal = 0;
    $dateTimeCardiacValues = date_parse($cardiacValuesPlotReach['date_heure']);
    $maxYearCardiacValuesPlot = $dateTimeCardiacValues['year'];
    $maxMonthCardiacValuesPlot = $dateTimeCardiacValues['month'];
    $maxDayCardiacValuesPlot = $dateTimeCardiacValues['day'];

    if($maxYearCardiacValuesPlot > $maxYearCardiacValuesPlotFinal){
        $maxYearCardiacValuesPlotFinal = $maxYearCardiacValuesPlot;
    }
    if($maxMonthCardiacValuesPlot > $maxMonthCardiacValuesPlotFinal){
        $maxMonthCardiacValuesPlotFinal = $maxMonthCardiacValuesPlot;
    }
    if($maxDayCardiacValuesPlot > $maxDayCardiacValuesPlotFinal){
        $maxDayCardiacValuesPlotFinal = $maxDayCardiacValuesPlot;
    }
}

foreach($soundValuesPlot as $soundValuesPlotReach){
    $maxYearSoundValuesPlotFinal = 0;
    $maxMonthSoundValuesPlotFinal = 0;
    $maxDaySoundValuesPlotFinal = 0;
    $dateTimeSoundValues = date_parse($soundValuesPlotReach['date_heure']);
    $maxYearSoundValuesPlot = $dateTimeSoundValues['year'];
    $maxMonthSoundValuesPlot = $dateTimeSoundValues['month'];
    $maxDaySoundValuesPlot = $dateTimeSoundValues['day'];

    if($maxYearSoundValuesPlot > $maxYearSoundValuesPlotFinal){
        $maxYearSoundValuesPlotFinal = $maxYearSoundValuesPlot;
    }
    if($maxMonthSoundValuesPlot > $maxMonthSoundValuesPlotFinal){
        $maxMonthSoundValuesPlotFinal = $maxMonthSoundValuesPlot;
    }
    if($maxDaySoundValuesPlot > $maxDaySoundValuesPlotFinal){
        $maxDaySoundValuesPlotFinal = $maxDaySoundValuesPlot;
    }
}

?>