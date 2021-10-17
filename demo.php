<?php
$eleve = ['nom' => 'Doe', 'prenom' => 'Marc', 'notes' => [10, 20, 15]];
$eleve['prenom'] = 'Jean';
$eleve['notes'][3] = 16;
print_r($eleve['notes']);