
<?php
require("include/call_db.php");
require("include/top_main.php");
if(isset($_GET['id_produit'])){
	$id_produit = $_GET['id_produit'];
	$requete = $db->query("SELECT salle.titre, salle.photo, produit.id_produit, produit.id_salle, produit.date_arrivee, produit.date_depart, produit.prix, produit.etat  
							FROM salle 
							JOIN produit 
							ON produit.id_salle = salle.id  
							WHERE produit.id_produit = '$id_produit'");
	$resultat = $requete->fetch(PDO::FETCH_ASSOC);
	$date_arrivee = $resultat['date_arrivee'];
	$date_depart = $resultat['date_depart'];
	$id_salle = $resultat['id_salle'];  $titre = $resultat['titre'];   $photo = $resultat['photo'];
	$prix = $resultat['prix'];
	$etat = $resultat['etat'];
}
if($_POST){
	$requete = $db->prepare("UPDATE salle 
							JOIN produit 
							ON produit.id_salle = salle.id SET date_arrivee = :date_arrivee, date_depart = :date_depart, id_salle = :id_salle, prix = :prix, etat = :etat 
							WHERE produit.id_produit = '$id_produit'");
	$requete->execute(array(
		'date_arrivee'=> $_POST["date_arrivee"],
		'date_depart'=> $_POST["date_depart"],
		'id_salle' => $_POST["id_salle"],
		'prix' => $_POST["prix"],
		'etat' => $_POST["etat"],));
	$content .= "<br><p style='color:blue;font-style:bolder;text-align:center'><u>Modification enregistrée !</u></p>";
	header("Refresh:1; URL=gestion_produits.php");
}
?>
<h5><u>Modifier Produit</u></h5>
	<div class="new"> 
		<form method="POST">
			<div class="gauche">
				<p>
					<label>Date d'arrivée </label><br>
					<input type="datetime-local" name="date_arrivee" required value="<?php echo $date_arrivee?>"> 
				</p>
				<p>
					<label>Date de départ </label><br>
					<input type="datetime-local" name="date_depart" required value="<?php echo $date_depart?>"> 
				</p>
			</div>
			<div class="droite">
				<p>
					<label>ID Salle </label><br>
					<input  type="text" name="id_salle" required value="<?php echo $id_salle ?>">
				</p>
				<p>
					<label>Prix </label><br>
					<input  type="text" name="prix" required value="<?php echo $prix ?>">
				</p>
				<p>
					<label>Etat </label><br>
					<select  class="etat" name="etat" required value="<?php echo $etat ?>">
						<option name="libre">Libre</option>
						<option name="reservé">Réservé</option>
					</select>
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