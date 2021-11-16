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

end($data_tab);
$lastValue = prev($data_tab);
$trame = $lastValue;

var_dump($trame);

//d�codage avec des substring
$t = substr($trame,0,1);
$o = substr($trame,1,4);

// $o = valeur de la trame

// d�codage avec sscanf
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

var_dump($typeSensor);
var_dump($dateTimestamp);

$finalDate = date('d/m/Y', $dateTimestamp);

var_dump($finalDate);

$finalTime = $hour . ':' . $min . ':' . $sec;

var_dump($finalTime);

$finalDateTime = $finalDate . ' ' . $finalTime;

var_dump($finalDateTime);


// Pas besoin de r�cup�rer l'ID Patient ?

//$sql = 'SELECT id_patient FROM patient';
//$pre = $pdo->prepare($sql);
//$pre->execute();
//$idPatient = $pre->fetchAll(PDO::FETCH_ASSOC);



// Valeurs du simulateur, $c renvoie le type de capteur
// 7 ---> fr�quence cardiaque
//A ---> son
// 4 --> Gaz


$sql = "SELECT * FROM mesure";
$pre = $pdo->prepare($sql);
$pre->execute();
$valTest = $pre->fetchAll(PDO::FETCH_ASSOC); //current prend la premi�re ligne du tableau
$timed = $valTest; //on enregistre que l'utilisateur est connect� (on peut modif)
var_dump($timed);

if($typeSensor == 3){ //Remplacer par 7 pour avoir le capteur fr�quence cardiaque

    //$sql = "SELECT id_capteur FROM capteur WHERE id_patient = '".$_SESSION['userPatient']['id_patient']."' AND type = frequenceCardiaque";
    //$pre = $pdo->prepare($sql);
    //$pre->execute();
    //$idCapteur = $pre->fetchAll(PDO::FETCH_ASSOC);


    $sql = 'INSERT INTO mesure(valeur, date_heure, id_capteur) VALUES (:valeur, :date_heure, :id_capteur)';
    $pre = $pdo->prepare($sql);
    $pre->execute([
        'valeur' => $value,
        'date_heure' => $finalDateTime,
        'id_capteur' => 4, //Remplacer par $idCapteur
        ]);
}
elseif($typeSensor == 'A'){

    $sql = "SELECT id_capteur FROM capteur WHERE id_patient = '".$_SESSION['userPatient']['id_patient']."' AND type = niveauSonore";
    $pre = $pdo->prepare($sql);
    $pre->execute();
    $idCapteur = $pre->fetchAll(PDO::FETCH_ASSOC);

    //Mettre une condition pour comparer la derni�re valeur entr�e du patient dans les mesures 

    $sql = 'INSERT INTO mesure(valeur, date_heure, id_capteur) VALUES (:valeur, :date_heure, :id_capteur)';
    $pre = $pdo->prepare($sql);
    $pre->execute([
        'valeur' => $value,
        'date_heure' => $finalDateTime,
        'id_capteur' => $idCapteur,
        ]);


}
elseif($typeSensor == 4){

    $sql = "SELECT id_capteur FROM capteur WHERE id_patient = '".$_SESSION['userPatient']['id_patient']."' AND type = concentrationGaz";
    $pre = $pdo->prepare($sql);
    $pre->execute();
    $idCapteur = $pre->fetchAll(PDO::FETCH_ASSOC);


    $sql = 'INSERT INTO mesure(valeur, date_heure, id_capteur) VALUES (:valeur, :date_heure, :id_capteur)';
    $pre = $pdo->prepare($sql);
    $pre->execute([
        'valeur' => $value,
        'date_heure' => $finalDateTime,
        'id_capteur' => $idCapteur,
        ]);


}




?>