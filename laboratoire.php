<?php
include_once("config.php");
include('backend/fonctions.php');
?>

<?php
//
// A very simple PHP example that sends a HTTP POST to a remote site
//

//$ch = curl_init();

//curl_setopt($ch, CURLOPT_URL,"http://projets-tomcat.isep.fr:8080/appService/?ACTION=GETLOG&TEAM=G5A4");
//curl_setopt($ch, CURLOPT_HTTPGET, 1);
//curl_setopt($ch, CURLOPT_POSTFIELDS,
//            "postvar1=value1&postvar2=value2&postvar3=value3");

//// In real life you should use something like:
//// curl_setopt($ch, CURLOPT_POSTFIELDS, 
////          http_build_query(array('postvar1' => 'value1')));

//// Receive server response ...
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//$server_output = curl_exec($ch);

//curl_close ($ch);

//// Further processing ...
////if ($server_output == "OK") { ... } else { ... }
?>

<?php

//$check = crc32('1G5A1330100990001');
//var_dump($check);

//$deuxcheck = $check % 256;
//var_dump($deuxcheck);
//$curl = curl_init();

//curl_setopt_array($curl, array(
//  CURLOPT_URL => 'http://projets-tomcat.isep.fr:8080/appService/?ACTION=COMMAND&TEAM=G5A4&TRAME=1G5A43301009900017c20211108143513',
//  CURLOPT_RETURNTRANSFER => true,
//  CURLOPT_ENCODING => '',
//  CURLOPT_MAXREDIRS => 10,
//  CURLOPT_TIMEOUT => 0,
//  CURLOPT_FOLLOWLOCATION => true,
//  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//  CURLOPT_CUSTOMREQUEST => 'GET',
//));

//$response = curl_exec($curl);

//curl_close($curl);
//echo $response;

//1G5A43301009900017c20211108143513

//$check = crc32('1G5A1330100990001');
//var_dump($check);

//$deuxcheck = $check % 256;
//var_dump($deuxcheck);

//1 - G5A4 - 1 - "inserer type sensor (1 caract�re) " - "logiquement id du patient (2 caract�res)" - "valeur sensibilit� (4 caract�res)" - "timestamp (4 caract�res)" - "checksum (2 caract�res)" - "ann�e (4 caract�res)" - "mois (2 caract�res)" - "jour (2 caract�res)" - "heure (2 caract�res)" - "minute (2 caract�res)" - "seconde (2 caract�res)"
?>

<?php 

$test = "yes";

$pdo->quote($test);
echo $test;

?>


<?php

//////// POSTER EN PHP CURL
//https://stackoverflow.com/questions/2138527/php-curl-http-post-sample-code
////
//// A very simple PHP example that sends a HTTP POST to a remote site
////

//$ch = curl_init();

//curl_setopt($ch, CURLOPT_URL,"http://www.example.com/tester.phtml");
//curl_setopt($ch, CURLOPT_POST, 1);
//curl_setopt($ch, CURLOPT_POSTFIELDS,
//            "postvar1=value1&postvar2=value2&postvar3=value3");

//// In real life you should use something like:
//// curl_setopt($ch, CURLOPT_POSTFIELDS,
////          http_build_query(array('postvar1' => 'value1')));

//// Receive server response ...
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//$server_output = curl_exec($ch);

//curl_close ($ch);

//// Further processing ...
//if ($server_output == "OK") { ... } else { ... }
?>