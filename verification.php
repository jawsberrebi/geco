<?php
include_once("config.php");

$sql = "SELECT * FROM testuser WHERE Email='".$_POST['email']."' AND Password='".$_POST['password']."'";
$pre = $pdo->prepare($sql);
$pre->execute();
$user = current($pre->fetchAll(PDO::FETCH_ASSOC));//current prend la premi�re ligne du tableau
$_SESSION['user'] = $user; //on enregistre que l'utilisateur est connect� (on peut modif)

if ($_SESSION['user'] != 0) {
    header('Location:tableau_de_bord_personnel.php');
    exit();


}

else {
    header('Location:connexion_incorrecte.php');
    exit();
}
?>