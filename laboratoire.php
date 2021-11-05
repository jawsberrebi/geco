<?php
include_once("config.php");
include('backend/fonctions.php');
?>


<?php
$handle = curl_init();

$url = "http://localhost:8081/geco/Test/serveur.php";

curl_setopt($handle, CURLOPT_URL, $url);

curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($handle);

curl_close($handle);

echo $output;
?>