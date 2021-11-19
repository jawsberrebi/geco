<?php
include_once("config.php");
include('backend/fonctions.php');
?>

<?php
//$trame = $data_tab[1];
// décodage avec des substring
//$t = substr($trame,0,1);
//$o = substr($trame,1,4);
// …
// décodage avec sscanf
//list($t, $o, $r, $c, $n, $v, $a, $x, $year, $month, $day, $hour, $min, $sec) =
//sscanf($trame,"%1s%4s%1s%1s%2s%4s%4s%2s%4s%2s%2s%2s%2s%2s");
//echo("<br />$t,$o,$r,$c,$n,$v,$a,$x,$year,$month,$day,$hour,$min,$sec<br />");
?>

<?php

//mail(
//        'berjaws@gmail.com',
//        'test',
//        'test',
//        );


?>

<?php
//$handle = curl_init();

//$url = "http://projets-tomcat.isep.fr:8080/appService?ACTION=GETLOG&TEAM=9999";

////curl_setopt($handle, CURLOPT_URL, $url);

//curl_setopt($handle, CURLOPT_HEADER, FALSE);

//curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

//$output = curl_exec($handle);

//curl_close($handle);

//echo $output;

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


//for($n = 0; $n != -1; $n++) {

//    $trame = $data_tab[$n];

//    if(empty($data_tab[$n])) {
//        $trame = $data_tab[$n - 1];
//    }

//}




//$trame = $data_tab[0];
// décodage avec des substring
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




?>


<?php

////// POSTER EN PHP CURL
https://stackoverflow.com/questions/2138527/php-curl-http-post-sample-code
//
// A very simple PHP example that sends a HTTP POST to a remote site
//

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"http://www.example.com/tester.phtml");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
            "postvar1=value1&postvar2=value2&postvar3=value3");

// In real life you should use something like:
// curl_setopt($ch, CURLOPT_POSTFIELDS,
//          http_build_query(array('postvar1' => 'value1')));

// Receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec($ch);

curl_close ($ch);

// Further processing ...
if ($server_output == "OK") { ... } else { ... }
?>