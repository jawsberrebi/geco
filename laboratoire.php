<?php
include_once("config.php");
include('backend/fonctions.php');

echo passwordGenerator($pdo, 8);
?>