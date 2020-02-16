
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8" />
	<title>Gestion Lokisalle</title>
	<meta name="description" content="location de salles de réunion, locations de bureaux, espaces co-working, à Paris, Lyon et Marseille">
	<meta name="category" content="location, salles de réunion, réunion, bureaux, espaces de travail, espaces co-working, Paris, Lyon, Marseille">
	<meta name="viewport" content="widht=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" href="" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
</head>

<body>
	<header>
		<!---------MENU NAVIGATION FRONT OFFICE------------>
		<nav>
			<div class="left">
				<div class="accueil">
					<a href="index.php">Lokisalle</a> 
				</div>
			</div>
			<div class="right">
				<div class="espace-membre">
					<ul>
						<li><a href="">Espace Membres</a>
							<ul>
								<li class="inscription">
									<a href="inscription.php">Inscription</a> 
								</li>
								<li class="connexion">
									<a href="connection.php">Connexion</a> 
								</li>
									<?php
										if (isset($_SESSION) && !empty($_SESSION)) {
											echo '<li class="profil">
												<a href="profil.php">Profil</a> 
													</li>';
										}
										if (isset($_SESSION) && !empty($_SESSION)) {
											echo '<li class="deconnection">
												<a href="connection.php?action=deconnexion">Deconnexion</a> 
												</li>';
										}
									?>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<hr>
		<br>

<!---------MENU NAVIGATION BACK OFFICE------------>

	<?php
	if (isset($_SESSION) && !empty($_SESSION)) {
		echo '<nav>
			<div id="nav_bo">
				<div class="nav_bo">
					<a href="gestion_salles.php">Gestion des salles</a> 
				</div>
				<div class="nav_bo">
					<a href="gestion_produits.php">Gestion des produits</a> 
				</div>
				<div class="nav_bo">
					<a href="gestion_membres.php">Gestion des membres</a> 
				</div>
				<div class="nav_bo">
					<a href="gestion_avis.php">Gestion des avis</a> 
				</div>
				<div class="nav_bo">
					<a href="gestion_commandes.php">Gestion des commandes</a> 
				</div>
				<div class="nav_bo">
					<a href="statistiques.php">Statistiques</a> 
				</div>	
			</div>			
		</nav>';
	}
	?>
</header>
	

