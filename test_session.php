
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
								<li class="profil">
								<a href="profil.php">Profil</a> 
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<br>

<!---------MENU NAVIGATION BACK OFFICE------------>

	<nav>
		<div id="nav_bo">
			<?php 
				if (isset($_SESSION) && !empty($_SESSION)) {
					echo '<li><a href="/lokisalle/profil.php">Profil</a></li>';
				}
				else{
					echo '<li><a href="/lokisalle/inscription.php">Inscription</a></li>';
				}
				if (isset($_SESSION) && !empty($_SESSION)) {
					echo '<li><a href="/lokisalle/connexion.php?action=deconnexion">Se deconnecter</a></li>';
				}
				else{
					echo '<li><a href="/lokisalle/connexion.php">Se connecter</a></li>';
				}

				if (isset($_SESSION['admin']) ) {
					if ($_SESSION['membre']['statut'] == "admin") {
						'<nav>';
							'<div id="nav_bo">';
							echo '<div class="nav_bo">';
								echo '<a href="gestion_salles.php">Gestion des salles</a>';
							echo '</div>';
							echo '<div class="nav_bo">';
								echo '<a href="gestion_produits.php">Gestion des produits</a>';
							echo '</div>';
							echo '<div class="nav_bo">';
								echo '<a href="gestion_membres.php">Gestion des membres</a>';
							echo '</div>';
							echo '<div class="nav_bo">';
								echo '<a href="gestion_avis.php">Gestion des avis</a>';
							echo '</div>';
							echo '<div class="nav_bo">';
								echo '<a href="gestion_commandes.php">Gestion des commandes</a>'; 
							echo '</div>';
							echo '<div class="nav_bo">';
								echo '<a href="statistiques.php">Statistiques</a> ';
							echo '</div>';	
			 				'</div>';
						'</nav>';
					}
				}
			?>

		 </div>
	</nav>
	</header>



	

