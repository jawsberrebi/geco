<?php

     #Adresse mail sur laquelle les informations du formulaire vont arriver

     $mail_admin = "berjaws@gmail.com";



     #Lorsqu'un utilisateur valide le formaire

     $nom = 'yes';

     $prenom = 'yes';

     $email = htmlspecialchars($_POST['email']);

     $message = htmlspecialchars($_POST['message']);



     #Ajout des champs dans un tableau

     $champs = array();

     array_push($champs, $nom, $prenom, $email, $message);



     #Envoie des données par mail

     envoyer_donnees($mail_admin, $champs);



     #Redirection

     header('Location:../form/form.html');

     exit;



     /*

     * Fonction qui envoie par mail les informations saisies dans le formulaire

     * $mail : le mail qui va recevoir les données

     * $donnees : la valeur des champs du formulaire

     */


?>