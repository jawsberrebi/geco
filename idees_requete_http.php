<?php require_once "config.php"; ?>

<?php

////////// PARAMS

$freqCard = null;
$soundLevel = null;
$Co2Concentr = null;

// Complétez $url avec l'url cible (l'url de la page que vous voulez télécharger)
$url="";

// Complétez le tableau associatif $postFields avec les variables qui seront envoyées par POST au serveur
$postFields=array($freqCard, $soundLevel, $Co2Concentr);

// Tableau contenant les options de téléchargement
$options=array(
      CURLOPT_URL            => $url,       // Url cible (l'url de la page que vous voulez télécharger)
      CURLOPT_RETURNTRANSFER => true,       // Retourner le contenu téléchargé dans une chaine (au lieu de l'afficher directement)
      CURLOPT_HEADER         => false,      // Ne pas inclure l'entête de réponse du serveur dans la chaine retournée
      CURLOPT_FAILONERROR    => true,       // Gestion des codes d'erreur HTTP supérieurs ou égaux à 400
      CURLOPT_POST           => true,       // Effectuer une requête de type POST
      CURLOPT_POSTFIELDS     => $postFields // Le tableau associatif contenant les variables envoyées par POST au serveur
);

////////// MAIN

// Création d'un nouvelle ressource cURL
$CURL=curl_init();
// Erreur suffisante pour justifier un die()
if(empty($CURL)){die("ERREUR curl_init : Il semble que cURL ne soit pas disponible.");}

      // Configuration des options de téléchargement
      curl_setopt_array($CURL,$options);

      // Exécution de la requête
      $content=curl_exec($CURL);            // Le contenu téléchargé est enregistré dans la variable $content. Libre à vous de l'afficher.

      // Si il s'est produit une erreur lors du téléchargement
      if(curl_errno($CURL)){
            // Le message d'erreur correspondant est affiché
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