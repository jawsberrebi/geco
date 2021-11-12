<meta charset="utf-8" />

<h1>Tableau de bord</h1>

<?php if (isset($_SESSION['userPersonnel']) && $_SESSION['userPersonnel']['type'] == 'admin') : ?>

<h2 style="padding-left: 2%.">
    <?php echo 'Bonjour, ' . htmlspecialchars($_SESSION['userPersonnel']['nom_utilisateur']) . ' de ' . htmlspecialchars($_SESSION['userPersonnel']['nom_hopital']) . ', vous �tes connect�'; ?>
</h2>

<?php endif; ?>


<?php if (isset($_SESSION['userPersonnel']) && $_SESSION['userPersonnel']) : ?>

<h2 style="padding-left: 2%.">
    <?php echo 'Bonjour, ' . htmlspecialchars($_SESSION['userPersonnel']['nom_utilisateur']) . ' vous êtes connecté'; ?>
</h2>

<?php endif; ?>