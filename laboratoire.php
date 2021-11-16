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


//RECUPERER DERNIERE VALEUR ENREGISTREE DES MESURES POUR COMPARER AVEC CELLE A ENTRER
$sql = "SELECT MAX(id_mesure) FROM mesure WHERE id_capteur = '".$idCapteur."'";
$pre = $pdo->prepare($sql);
$pre->execute();
$idCapteur = $pre->fetchAll(PDO::FETCH_ASSOC);


?>