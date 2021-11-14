<!DOCTYPE html>
<html>
<head>
    <link href='https://fonts.googleapis.com/css?family=Urbanist' rel='stylesheet'>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Responsive Landing Page Template With Flexbox</title>

	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/accueil.css">

</head>

<body>

	<header>
		<h2><a href="#">Website Logo</a></h2>
		<nav>

			<li><a href="#">Accueil</a></li>
			<li><a href="#">GecoSensor</a></li>
			<li><a href="#">Equipe</a></li>
			<li><a href="#">FAQ</a></li>
            <li><a href="#">Jeu ludique</a></li>
            <li><a href="#">Contacter</a></li>
            <li><a href="#">Connexion</a></li>
		</nav>
	</header>


	<section class="image-vitrine">
		<div class="background-image" style="background-image: url(images/image-vitrine.jpg);"></div>
		<h1>GecoSensor</h1>
		<h3>Page d'Accueil</h3>
		<a href="http://ledesignerduweb.fr/" class="btn">Voir GecoSensor</a>
	</section>


	<section class="our-work">
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
	
    

	<section class="features">
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
	</section>


	<section class="reviews">
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


	<section class="contact">
		<h3 class="title">Contacter</h3>	
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id felis et ipsum bibendum ultrices. Morbi vitae pulvinar velit. Sed aliquam dictum sapien, id sagittis augue malesuada eu.</p>
		<hr>

		<form>

			<label for="email">Adresse email :</label>
			<input type="email" name="email" id="email" placeholder="Email">
			
			<label for="prenom">Prénom :</label>
			<input type="text" name="prenom" id="prenom" placeholder="Prénom" />

			<label for="nom">Nom :</label>
			<input type="text" name="nom" id="nom" placeholder="Nom" />

			<label for="sujet">Sujet : </label>
			<input type="text" name="sujet" id="sujet" placeholder="Sujet" />

			<label for="message">Message :</label>
			<textarea name="message" id="message"></textarea>
		</form>
	</section>


</body>

</html>
