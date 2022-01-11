<meta charset="utf-8" />
<link rel="stylesheet" href="css/modal.css">
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="Javascript/modale.js"></script>

<?php if($_SESSION['userPersonnel']['type'] == 'admin' || $_SESSION['userPersonnel']['type'] == 'medecin') : ?>

<a href="ajout?type=patient" class="ajout" >Ajouter un nouveau patient</a> <br />

<a href="ajout?type=infirmier" class="ajout">Ajouter un nouvel infirmier</a> <br />

<?php if ($_SESSION['userPersonnel']['type'] == 'admin') : ?>

<a href="ajout?type=medecin" class="ajout">Ajouter un nouveau médecin</a> <br />

<a href="ajout?type=admin" class="ajout">Ajouter un nouvel administrateur</a> <br />

<?php endif; ?>
<?php endif; ?>

<!--<div id="myModal">
    <h3 id="title">Nouveau Patient</h3>
    <div id="content">
        
    </div>
</div>
<script src="Javascript/modale.js"></script>-->

<div id="myModal" class="modal">

        <div class="modal-content" id="content">

            <form action="post_ajout.php" method="post">

                <?php if($_GET['type'] == 'patient') : ?>

                <h1 id="title_form">Nouveau Patient</h1>

                <input name="type" value="patient" type="hidden"/>

                <?php endif; ?>

                <?php if($_GET['type'] == 'infirmier') : ?>

                <h1 id="title_form">Nouvel Infirmier</h1>

                <input name="type" value="infirmier" type="hidden" />

                <?php endif; ?>

                <?php if($_GET['type']=='medecin') : ?>

                <?php if($_SESSION['userPersonnel']['type'] == 'admin') : ?>

                <h1 id="title_form">Nouveau Médecin</h1>

                <input name="type" value="medecin" type="hidden" />

                <?php endif; ?>

                <?php if(isset($_SESSION['userPersonnel'])) : ?>

                <?php if($_SESSION['userPersonnel']['type'] != 'admin') : ?>

                <?php header('Location:tableau_de_bord_personnel?erreur=1.php');
                      exit();
                ?>

                <?php endif; ?>

                <?php endif; ?>

                <?php endif; ?>



                <?php if($_GET['type']=='admin') : ?>

                <?php if($_SESSION['userPersonnel']['type'] == 'admin') : ?>

                <h1 id="title_form">Nouvel Administrateur</h1>

                <input name="type" value="admin" type="hidden" />

                <?php endif; ?>

                <?php if(isset($_SESSION['userPersonnel'])) : ?>

                <?php if($_SESSION['userPersonnel']['type'] != 'admin') : ?>

                <?php header('Location:tableau_de_bord_personnel?erreur=1.php');
                      exit();
                ?>

                <?php endif; ?>

                <?php endif; ?>

                <?php endif; ?>



                <input type="text" placeholder="Nom*" name="nom" required />

                <input type="text" placeholder="Prénom*" name="prenom" required />

                <input type="email" placeholder="Email*" name="email" required />

                <input type="tel" placeholder="Numéro de téléphone" name="telephone" />

                <?php if($_GET['type']=='patient') : ?>

                <input type="text" placeholder="Adresse" name="adresse" />

                <textarea placeholder="Description" name="description"></textarea>

                <?php endif; ?>

                <input type="submit" id='submit' value='Sauvegarder' />


                <?php if(isset($_GET['erreur'])){
                          $error = $_GET['erreur'];
                          if($error==1){
                              echo '<p id="message_erreur">Il manque des informations. Veillez à rentrer toutes les informations marquées d\'un *.</p>';
                          }
                          if($error==2){
                              echo '<p id="message_erreur">L\'adresse email a déjà été utilisée. Veuillez entrer une autre adresse email.</p>';
                          }

                      }?>


                <a href="#" class="modal-close">&times;</a>
            </form>
        </div>
</div>

<script src="Javascript/modale.js"></script>