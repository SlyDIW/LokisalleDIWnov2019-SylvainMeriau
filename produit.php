<?php
require("include/call_db.php");
require("include/top_main.php");
if(isset($_GET['id_salle'])){
	$id_salle = $_GET['id_salle'];
	$requete = $db->query("SELECT salle.id, salle.titre, salle.description, salle.photo, salle.pays, salle.ville, salle.adresse, salle.cp, salle.capacite, salle.categorie, produit.date_arrivee, produit.date_depart, produit.prix, avis.note
							FROM salle 
							LEFT JOIN produit 
							ON produit.id_salle = salle.id 
							LEFT JOIN avis 
							ON avis.id_salle = salle.id
							WHERE id = '$id_salle'");
	$resultat = $requete->fetch(PDO::FETCH_ASSOC);
	$titre = $resultat['titre'];
	$description = $resultat['description'];
	$photo = $resultat['photo'];
	$pays = $resultat['pays'];
	$ville = $resultat['ville'];
	$adresse = $resultat['adresse'];
	$cp = $resultat['cp'];
	$capacite = $resultat['capacite'];
	$categorie = $resultat['categorie'];
	$date_arrivee = $resultat['date_arrivee'];
	$date_depart = $resultat['date_depart'];
	$prix = $resultat['prix'];
	$note = $resultat['note'];
}
else{
	$requete = $db->query("SELECT * FROM produit
							JOIN salle 
							ON salle.id = produit.id_salle 
							LEFT JOIN avis 
							ON avis.id_salle = salle.id");
	$resultat = $requete->fetch(PDO::FETCH_ASSOC);
	$titre = $resultat['titre'];
	$description = $resultat['description'];
	$photo = $resultat['photo'];
	$pays = $resultat['pays'];
	$ville = $resultat['ville'];
	$adresse = $resultat['adresse'];
	$cp = $resultat['cp'];
	$capacite = $resultat['capacite'];
	$categorie = $resultat['categorie'];
	$date_arrivee = $resultat['date_arrivee'];
	$date_depart = $resultat['date_depart'];
	$prix = $resultat['prix'];
	$note = $resultat['note'];
}
?>
<!---------FICHE PRODUIT----------->
<div class="produit">
<br>
	<div class="entete">
		<div class="row">
			<h3><?php echo $titre ?></h3>
				<div><b>note : </b><?php echo $note ?> /5
				</div>
		</div>
		<button class="btn btn-primary">Réserver cette salle</button>
	</div>
<hr>
<div class="presentation">
	<img src="photos_salles/<?php echo $photo ?>" style="width:30%;height:30%">			
	<div class="col">
		<label>Description</label>
			<p><?php echo $description ?></p>
	</div>
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10500.476401074793!2d2.2896391838076977!3d48.855939236824476!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e2964e34e2d%3A0x8ddca9ee380ef7e0!2sTour%20Eiffel!5e0!3m2!1sfr!2sfr!4v1580809129619!5m2!1sfr!2sfr" width="30%" frameborder="0" style="border:0";>
	</iframe><br>
	</div>
<hr>
	<label>Informations complémentaires</label>
		<div class="details">
			<div>
				<p><label>Arrivée : </label><?php echo  " " . $date_arrivee ?> 
				</p>
				<p><label>Départ : </label><?php echo " " . $date_depart ?> 
				</p>
				</div>
				<div>
					<p><label>Capacité : </label> <?php echo $capacite ?>
					</p>
					<p><label>Catégorie : </label> <?php echo $categorie ?>
					</p>
				</div>
				<div>
					<p><label>Adresse : </label> <?php echo $adresse . ",".$cp . " " . $ville ?>
					</p>
					<p><label>Tarif : </label> <?php echo $prix ?> Prix
					</p>
				</div>			
			</div>
<!--<h4>Autres produits</h4>
<hr>
	<div class="autresproduits">
		<img src="">
		<img src="">
		<img src="">
		<img src="">
	</div> -->
	<div class="pied">
		<a href="">Déposer un commentaire et une note</a>
		<a href="index.php">Retour vers le catalogue</a>
	</div>
</div>
<?php
	require("include/footer.php");
?>