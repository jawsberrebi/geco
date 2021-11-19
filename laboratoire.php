<?php
include_once("config.php");
include('backend/fonctions.php');
?>

<?php
$sql = "SELECT id_capteur FROM capteur WHERE id_patient = 5 AND type = 'frequenceCardiaque'";
$pre = $pdo->prepare($sql);
$pre->execute();
$idCapteurTab = $pre->fetchAll(PDO::FETCH_ASSOC);
$idCapteur = $idCapteurTab[0]['id_capteur'];

var_dump($idCapteur);

//RECUPERER DERNIERE VALEUR ENREGISTREE DES MESURES POUR COMPARER AVEC CELLE A ENTRER
//$sql = "SELECT MAX(id_mesure) FROM mesure WHERE id_capteur = '".$idCapteur."'";
$sql = "SELECT valeur FROM mesure ORDER BY id_capteur = '".$idCapteur."' DESC LIMIT 1";
$pre = $pdo->prepare($sql);
$pre->execute();
$idCapteur = $pre->fetchAll(PDO::FETCH_ASSOC);

var_dump($idCapteur[0]['valeur']);

$sql = "SELECT id_capteur FROM capteur WHERE id_patient = 5 AND type = 'frequenceCardiaque'";
$pre = $pdo->prepare($sql);
$pre->execute();
$idCapteurTab = $pre->fetchAll(PDO::FETCH_ASSOC);

var_dump($idCapteurTab);

$idCapteur = $idCapteurTab[0]['id_capteur'];

var_dump($idCapteur);

?>