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

//1G5A43301009900017c20211108143513

?>