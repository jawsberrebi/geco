<?php
session_start();


try 
{
    $pdo = new PDO(
  'mysql:host=localhost;dbname=test;',
  'root',
  '',
  array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
);
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

//$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
?>