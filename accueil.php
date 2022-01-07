<!DOCTYPE html>
<html>
<head>
    <link href='https://fonts.googleapis.com/css?family=Urbanist' rel='stylesheet'>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gecosensor - Accueil</title>

	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <link rel="stylesheet" href="css/accueil.css">

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
     
            <img src="images/a.PNG" class="picture-right">
           
            <div class="paragraph-left">
              <h2>GecoSensor</h2>
			  <br/>
			  <br/>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmo tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.  </p>
            </div>

			<img src="images/b.PNG" class="picture-left">
           
            <div class="paragraph-right">
			  <br/>
			  <br/>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmo tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.  </p>
            </div>

			<img src="images/c.PNG" class="picture-right">
           
            <div class="paragraph-left"></div>
			  <br/>
			  <br/>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmo tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.  </p>
            </div>
          </div>
	</section>
	
    

	<!--<section class="features" id="section2">
		<h3 class="title">Equipe</h3>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id felis et ipsum bibendum ultrices. Morbi vitae pulvinar velit. Sed aliquam dictum sapien, id sagittis augue malesuada eu.</p>
		<hr>

		<ul class="grid">
			<li>
				<img src="images/d.PNG">
				<h4>Membre 1</h4>
			</li>
			<li>
				<img src="images/d.PNG">
				<h4>Membre 2</h4>
			
			</li>
			<li>
				<img src="images/d.PNG">
				<h4>Membre 3</h4>
			
			</li>
			<li>
				<img src="images/d.PNG">
				<h4>Membre 4</h4>
			
			</li>
			<li>
				<img src="images/d.PNG">
				<h4>Membre 5</h4>
				
			</li>
			<li>
				<img src="images/d.PNG">
				<h4>Membre 6</h4>
			
			</li>
        </ul>
	</section>-->


	<section class="reviews" id="section3">
		<h3 class="title">FAQ</h3>
		<br/>
		<p><strong>Question 1 ? </strong>
			<br/>
		Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id felis et ipsum bibendum ultrices. Morbi vitae pulvinar velit. Sed aliquam dictum sapien, id sagittis augue malesuada eu.</p>
		<br/>
		<p><strong>Question 2 ? </strong>
			<br/>
		Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id felis et ipsum bibendum ultrices. Morbi vitae pulvinar velit. Sed aliquam dictum sapien, id sagittis augue malesuada eu.</p>
	</section>


	<section class="contact" id="section4">
		<h3 class="title">Contacter</h3>	
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id felis et ipsum bibendum ultrices. Morbi vitae pulvinar velit. Sed aliquam dictum sapien, id sagittis augue malesuada eu.</p>
		<hr>

		<form>

			<label for="email">Adresse email :</label><br />
			<input type="email" name="email" id="email" placeholder="Email"><br />
			
			<label for="prenom">Prénom :</label><br />
			<input type="text" name="prenom" id="prenom" placeholder="Prénom" /><br />

			<label for="nom">Nom :</label><br />
			<input type="text" name="nom" id="nom" placeholder="Nom" /><br />

			<label for="sujet">Sujet : </label><br />
			<input type="text" name="sujet" id="sujet" placeholder="Sujet" /><br />

			<label for="message">Message :</label><br />
			<textarea name="message" id="message"></textarea><br />

			<input type="submit" name="envoyer" value="Envoyer" id="envoyer"/>
		</form>
	</section>


</body>

</html>
