
<?php
require("include/call_db.php");
require("include/top_main.php");
if(isset($_GET['id_commande'])){
	$commande = $_GET['id_commande'];
	$requete = $db->query("SELECT commande.id_commande, membre.id_membre, membre.email, produit.id_produit, salle.titre, produit.date_arrivee, produit.date_depart, produit.prix, commande.date_enregistrement
        FROM commande 
        JOIN produit 
        ON commande.id_produit = produit.id_produit
        JOIN membre 
        ON commande.id_membre = membre.id_membre
        JOIN salle
        ON produit.id_salle = salle.id
        WHERE commande.id_commande = '$commande' ");
	$resultat = $requete->fetch(PDO::FETCH_ASSOC);
	$prix = $resultat['prix'];
	$date_enregistrement = $resultat['date_enregistrement'];
}
if($_POST){
	$requete = $db->prepare("
		UPDATE commande 
		JOIN produit 
		ON commande.id_produit 
		SET prix = :prix, date_enregistrement = :date_enregistrement 
		WHERE id_commande = '$commande'
		");
	$requete->execute(array('prix' => $_POST["prix"],'date_enregistrement' => $_POST["date_enregistrement"],));
	$content .= "<br><p style='color:blue;font-style:bolder;text-align:center'><u>Modification enregistrée !</u></p>";
	header("Refresh:0.5; URL=gestion_commandes.php");
}
?>
<h5><u>Modifier infos commande</u></h5>
	<div class="new"> 
		<form method="POST">
			<div class=center>
				<p>
					<label>Prix </label><br>
					<input  type="text" name="prix" required value="<?php echo $prix .'€' ?>">
				</p>
				<p>
					<label>Date d'enregistrement  </label><br>
					<input type="datetime-local" name="date_enregistrement" required value="<?php echo $date_enregistrement?>"> 
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