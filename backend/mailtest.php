<?php

include('fonctions.php');

     #Adresse mail sur laquelle les informations du formulaire vont arriver

$mail_admin = "rd.berrebi@gmail.com";



     #Lorsqu'un utilisateur valide le formaire

$mail = 'yes';

$prenom = 'yes';

$email = "rd.berrebi@gmail.com";

$message = 'Hellooo';



     #Ajout des champs dans un tableau

$champs = array();

array_push($champs, $nom, $prenom, $email, $message);



     #Envoie des donn�es par mail

envoyer_donnees($mail_admin, $champs);






     /*

     * Fonction qui envoie par mail les informations saisies dans le formulaire

     * $mail : le mail qui va recevoir les donn�es

     * $donnees : la valeur des champs du formulaire

     */


?>