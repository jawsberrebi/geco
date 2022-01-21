<!DOCTYPE html>
<html lang="fr">
<head>
    <link href='https://fonts.googleapis.com/css?family=Urbanist' rel='stylesheet'>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <link rel="stylesheet" href="css/accueil.css">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gecosensor - Accueil</title>
</head>

<body>

	<header>
		<h2><a href="#">Website Logo</a></h2>
		<nav>

			<li><a href="#">Accueil</a></li>
			<li><a href="#section1">GecoSensor</a></li>
			<!--<li><a href="#section2">Equipe</a></li>-->
			<li><a href="#section3">FAQ</a></li>
            <li><a href="#">Jeu ludique</a></li>
            <li><a href="#section4">Contacter</a></li>
            <li><a href="connexion.php">Connexion</a></li>
		</nav>
	</header>


	<section class="image-vitrine">
		<div class="background-image" style="background-image: url(images/image-vitrine.jpg);"></div>
		<h1>GecoSensor</h1>
		<h3>Page d'Accueil</h3>
		<a href="" class="btn">Voir GecoSensor</a>
	</section>


	<section class="our-work" id="section1">
		<br/>
		<br/>
		<br/>
        <div class="div-categoryContainer">
     
            <img src="images/a.PNG" class="picture-right" alt="cadran bpm">
           
            <div class="paragraph-left">
              <h2>GecoSensor</h2>
			  <br/>
			  <br/>
              <p>Prenez en charge votre santé grâce à la technologie GecoSensor.<br><br>Grâce à la technologie GecoSensor, vous disposez d'un suivi continu de votre fréquence cardiaque vous permettant de visualiser les battements de votre cœur et d'être immédiatement pris en charge en cas d’alerte.</p>
            </div>

			<img src="images/b3.PNG" class="picture-left" alt="cadran son">
           
            <div class="paragraph-right">
			  <br/>
			  <br/>
              <p>Notre technologie tire profit de tous ses sens afin de déterminer le niveau sonore environnant. Lorsque le niveau de décibels atteint un stade où votre audition risque d’être affectée, vous en êtes alerté.   </p>
            </div>

			<img src="images/c3.PNG" class="picture-right" alt="cadran gaz">
           
            <div class="paragraph-left"></div>
			  <br/>
			  <br/>
              <p>Une bonne santé passe aussi par un environnement sain. Le taux de CO2 dans l'air est mesuré en permanence et vous notifie lorsque les mesures atteignent des niveaux dangereux.<br><br><strong> Un contrôle continu par les services de santé</strong><br>Vos référents médicaux ont accès à vos données. Ils peuvent donc vous suivre à tout moment et réagir immédiatemment en cas d'alerte en contactant les services appropriés.</p>
            </div>
          </div>
	</section>
	
    

	<!--<section class="features" id="section2">
		<h3 class="title">Equipe</h3>
		<p>GecoSensor, c'est une équipe de 6 jeunes ingénieurs dynamiques et passionés qui travaillent ensemble pour vous proposer un outil de santé.</p>
		<hr>

		<ul class="grid">
			<li>
				<img src="images/d.PNG">
				<h4>Richard Berrebi</h4>
			</li>
			<li>
				<img src="images/d.PNG">
				<h4>Tristan Brankovic</h4>
			
			</li>
			<li>
				<img src="images/d.PNG">
				<h4>Jérémie Hérault</h4>
			
			</li>
			<li>
				<img src="images/d.PNG">
				<h4>Chloé Guertault</h4>
			
			</li>
			<li>
				<img src="images/d.PNG">
				<h4>Shiraze Chebira</h4>
				
			</li>
			<li>
				<img src="images/d.PNG">
				<h4>Clément Da Cruz</h4>
			
			</li>
        </ul>
	</section>-->


	<section class="reviews" id="section3">
		<h3 class="title">FAQ</h3>
		<br/>
		<p><strong>Quels sont les bénéfices, ensuite, en terme de suivi médical ? </strong>
			<br/>
		Vos référents médicaux ont également accès à vos données. Ils peuvent donc vous suivre à tout moment et réagir immédiatemment en cas d'alerte.</p>
		<br/>
		<p><strong>Quelles sont les indicateurs santé disponible grâce au produit ? </strong>
			<br/>
		Sur votre tableau de bord, vous pouvez accéder et afficher les indicateurs de santé suivant : rythme cardiaque, niveau sonore et concentration en C02 .</p>
	</section>


	<section class="contact" id="section4">
		<h3 class="title">Contacter</h3>	
		<p>Pour plus d'informations concernant le fonctionnement du produit ou pour toute autre question, n'hésitez pas à nous contacter.</p>
		<hr>

		<form action="backend/post_email.php" method="POST">
			<label for="email">Adresse email :</label><br />
			<input type="email" name="email" id="email" placeholder="Email"><br />
			
			<label for="prenom">Prénom :</label><br />
			<input type="text" name="prenom" id="prenom" placeholder="Prénom" /><br />

			<label for="nom">Nom :</label><br />
			<input type="text" name="nom" id="nom" placeholder="Nom" /><br />

			<label for="message">Message :</label><br />
			<textarea name="message" id="message"></textarea><br />

			<input type="submit" name="envoyer" value="Envoyer" id="envoyer"/>
		</form>
	</section>

	<footer>
		<p id="copyright_text">Copyright © 2021 Geco</p>
		<ul>
			<li><a href="CGU.html">CGU</a></li>
		</ul>
		
	</footer>


</body>

</html>