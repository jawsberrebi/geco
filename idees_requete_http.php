<?php require_once "config.php"; ?>

<?php

////////// PARAMS

$freqCard = null;
$soundLevel = null;
$Co2Concentr = null;

// Compl�tez $url avec l'url cible (l'url de la page que vous voulez t�l�charger)
$url="";

// Compl�tez le tableau associatif $postFields avec les variables qui seront envoy�es par POST au serveur
$postFields=array($freqCard, $soundLevel, $Co2Concentr);

// Tableau contenant les options de t�l�chargement
$options=array(
      CURLOPT_URL            => $url,       // Url cible (l'url de la page que vous voulez t�l�charger)
      CURLOPT_RETURNTRANSFER => true,       // Retourner le contenu t�l�charg� dans une chaine (au lieu de l'afficher directement)
      CURLOPT_HEADER         => false,      // Ne pas inclure l'ent�te de r�ponse du serveur dans la chaine retourn�e
      CURLOPT_FAILONERROR    => true,       // Gestion des codes d'erreur HTTP sup�rieurs ou �gaux � 400
      CURLOPT_POST           => true,       // Effectuer une requ�te de type POST
      CURLOPT_POSTFIELDS     => $postFields // Le tableau associatif contenant les variables envoy�es par POST au serveur
);

////////// MAIN

// Cr�ation d'un nouvelle ressource cURL
$CURL=curl_init();
// Erreur suffisante pour justifier un die()
if(empty($CURL)){die("ERREUR curl_init : Il semble que cURL ne soit pas disponible.");}

      // Configuration des options de t�l�chargement
      curl_setopt_array($CURL,$options);

      // Ex�cution de la requ�te
      $content=curl_exec($CURL);            // Le contenu t�l�charg� est enregistr� dans la variable $content. Libre � vous de l'afficher.

      // Si il s'est produit une erreur lors du t�l�chargement
      if(curl_errno($CURL)){
            // Le message d'erreur correspondant est affich�
            echo "ERREUR curl_exec : ".curl_error($CURL);
      }

// Fermeture de la session cURL
curl_close($CURL);

?>

<?php

$username = "some-username";
$password = "some-password";
$remote_url = 'http://www.somedomain.com/path/to/file';

// Create a stream
$opts = array(
  'http'=>array(
    'method'=>"GET",
    'header' => "Authorization: Basic " . base64_encode("$username:$password")
  )
);

$context = stream_context_create($opts);

// Open the file using the HTTP headers set above
$file = file_get_contents($remote_url, false, $context);

print($file);



?>

<?php
$url = 'http://127.0.0.1/api/produits';
$data = array('name' => 'PEC', 'description' => 'Pencil 2H', 'price' => '2.25', 'category' => '9');

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === FALSE) { /* Handle error */ }

var_dump($result);

https://waytolearnx.com/2019/07/creer-et-utiliser-une-api-rest-en-php.html
?>