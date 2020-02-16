
<?php
require("include/call_db.php");
require("include/top_main.php");
if(isset($_GET['id_salle'])){
	$id_salle = $_GET['id_salle'];
	$requete = $db->query("SELECT * FROM salle WHERE id = '$id_salle' ");
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
}
if($_POST){
	$requete = $db->prepare("UPDATE salle 
							SET titre = :titre, description = :description, photo = :photo, pays = :pays, ville = :ville, adresse = :adresse, cp = :cp, capacite = :capacite, categorie = :categorie 
							WHERE id = '$id_salle'");
	$requete->execute(array(
		'titre'=> $_POST["titre"],
		'description'=> $_POST["description"],
		'photo' => $_POST["photo"],
		'pays' => $_POST["pays"],
		'ville' => $_POST["ville"],
		'adresse' => $_POST["adresse"],
		'cp' => $_POST["cp"],
		'capacite' => $_POST["capacite"],
		'categorie' => $_POST["categorie"],));
	$content .= "<br><p style='color:blue;font-style:bolder;text-align:center'><u>Modification enregistrée !</u></p>";
	header("Refresh:1; URL=gestion_salles.php");
}
?>
<h5><u>Modifier la salle</u></h5>
	<div class="new"> 
		<form method="POST">
		<div class="gauche">
			<p>
				<label>Titre </label><br>
				<input class="titre" type="text" name="titre" required value="<?php echo $titre ?>">
			</p>
			<p>
				<label>Description </label><br>
				<input class="description" type="text" name="description" required value="<?php echo $description ?>">
			</p>
			<p>
				<label>Photo </label><br>
				<input type="file" name="photo" required value="<?php echo $photo ?>">
			</p>
			<p>
				<label>Capacité </label><br>
					<select class="capacite" name="capacite" required  value="<?php echo $capacite ?>">
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>5</option>
						<option>10</option>
						<option>20</option>
					<option>50</option>
					</select>
			</p>
			<p>
				<label>Catégorie </label><br>
					<select class="categorie" name="categorie" required value="<?php echo $categorie ?>">
						<option name="reunion">Reunion</option>
						<option name="bureau">Bureau</option>
						<option name="formation">Formation</option>
					</select>
			</p>
		</div>
		<div class="droite">
			<p>
				<label>Pays </label><br>
					<select class="pays" name="pays" required value="<?php echo $pays ?>">
						<option name="France">France</option>
						<option name="autre">Autre</option>
				</select>
			</p>
			<p>
				<label>Ville </label><br>
					<select class="ville" name="ville" required value="<?php echo $ville ?>">
						<option name="Paris">Paris</option>
						<option name="Lyon">Lyon</option>
						<option name="Marseille">Marseille</option>
					</select>
			</p>
			<p>
				<label>Adresse </label><br>
				<input class="adresse" type="text" name="adresse" required value="<?php echo $adresse ?>">
			</p>
			<p>
				<label>Code postal </label><br>
				<input class="cp" type="text" name="cp" required value="<?php echo $cp?>"> 
			</p>
			<p>
				<button type="submit" class="btn btn-secondary">ENREGISTRER</button>
			</p>
		</div>
		</form>
	<?php echo $content; ?>
</div>
<?php
require("include/footer.php");
?>