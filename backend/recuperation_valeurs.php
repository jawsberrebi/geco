<?php

include_once("config.php");
include('fonctions.php');


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://projets-tomcat.isep.fr:8080/appService/?ACTION=GETLOG&TEAM=G5A4");
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$data = curl_exec($ch);
curl_close($ch);
echo "Raw Data:<br />";
var_dump($data);

$data_tab = str_split($data,33);
echo "Tabular Data:<br />";
for($i=0, $size=count($data_tab); $i<$size; $i++){
    echo "Trame $i: $data_tab[$i]<br />";
}

$lastValue = end($data_tab);
$trame = $lastValue;

//for($n = 0; $n != -1; $n++) {

//    $trame = $data_tab[$n];

//    if(empty($data_tab[$n])) {
//        $trame = $data_tab[$n - 1];
//    }

//}

//set_time_limit(60);
//$start = time();

//for ($i = 0; $i < 59; ++$i) {

//    if(!empty($trame[i])){
//        $trame = $data_tab[i];
//    }
//    else{
//        $i = $i - 1;
//        $trame = $data_tab[$i];
//    }

//    time_sleep_until($start + $i + 1);
//}


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
$numbSensor = $n;
$value = $v;
$tim = $a;
$checkseum = $x;
$date = $day . '-' . $month . '-' . $year;
$dateTimestamp = strtotime($date);

// Pas besoin de récupérer l'ID Patient ?
//$sql = 'SELECT id_patient FROM patient';
//$pre = $pdo->prepare($sql);
//$pre->execute();
//$idPatient = $pre->fetchAll(PDO::FETCH_ASSOC);



// Valeurs du simulateur, $c renvoie le type de capteur
// 7 ---> fréquence cardiaque
//A ---> son
// 4 --> Gaz

//if($c == 7){

//    $sql = "SELECT id_capteur FROM capteur WHERE id_patient = '".$_SESSION['userPatient']['id_patient']."' AND type = frequenceCardiaque";
//    $pre = $pdo->prepare($sql);
//    $pre->execute();
//    $idCapteur = $pre->fetchAll(PDO::FETCH_ASSOC);


//    $sql = 'INSERT INTO mesure(valeur, date, id_capteur) VALUES (:valeur, :date, :id_capteur)';
//    $pre = $pdo->prepare($sql);
//    $pre->execute([
//        'valeur' => $value,
//        'date' => $dateTimestamp,
//        'id_capteur' => $idCapteur,
//        ]);
//}
//elseif($c == 'A'){

//    $sql = "SELECT id_capteur FROM capteur WHERE id_patient = '".$_SESSION['userPatient']['id_patient']."' AND type = niveauSonore";
//    $pre = $pdo->prepare($sql);
//    $pre->execute();
//    $idCapteur = $pre->fetchAll(PDO::FETCH_ASSOC);


//    $sql = 'INSERT INTO mesure(valeur, date, id_capteur) VALUES (:valeur, :date, :id_capteur)';
//    $pre = $pdo->prepare($sql);
//    $pre->execute([
//        'valeur' => $value,
//        'date' => $dateTimestamp,
//        'id_capteur' => $idCapteur,
//        ]);


//}
//elseif($c == 4){

//    $sql = "SELECT id_capteur FROM capteur WHERE id_patient = '".$_SESSION['userPatient']['id_patient']."' AND type = concentrationGaz";
//    $pre = $pdo->prepare($sql);
//    $pre->execute();
//    $idCapteur = $pre->fetchAll(PDO::FETCH_ASSOC);


//    $sql = 'INSERT INTO mesure(valeur, date, id_capteur) VALUES (:valeur, :date, :id_capteur)';
//    $pre = $pdo->prepare($sql);
//    $pre->execute([
//        'valeur' => $value,
//        'date' => $dateTimestamp,
//        'id_capteur' => $idCapteur,
//        ]);


//}




?>