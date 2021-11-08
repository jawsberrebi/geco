<meta charset="utf-8" />

<?php if($_SESSION['userAdmin'] || $_SESSION['userPersonnel']['type'] == 'medecin') : ?>

<a href="ajout?type=patient" class="ajout">Ajouter un nouveau patient</a> <br />

<a href="ajout?type=infirmier" class="ajout">Ajouter un nouvel infirmier</a> <br />

<?php if ($_SESSION['userAdmin']) : ?>

<a href="ajout?type=medecin" class="ajout">Ajouter un nouveau médecin</a> <br />

<?php endif; ?>
<?php endif; ?>