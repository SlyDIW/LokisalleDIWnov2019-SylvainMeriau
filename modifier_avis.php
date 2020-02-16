
<?php
require("include/call_db.php");
require("include/top_main.php");
if(isset($_GET['id_avis'])){
	$avis = $_GET['id_avis'];
	$requete = $db->query("SELECT avis.id_avis, avis.commentaire, avis.note, avis.date_enregistrement, membre.id_membre, membre.email, salle.id, salle.titre
            				FROM avis 
          					JOIN membre
            				ON avis.id_membre = membre.id_membre
            				JOIN salle
            				ON avis.id_salle = salle.id");
	$resultat = $requete->fetch(PDO::FETCH_ASSOC);
	$commentaire = $resultat['commentaire'];
	$note = $resultat['note'];
}
if($_POST){
	$requete = $db->prepare("UPDATE avis
							SET commentaire = :commentaire, note = :note
							WHERE id_avis = '$avis'");
	$requete->execute(array('commentaire' => $_POST["commentaire"],
							'note' => $_POST["note"],));
	$content .= "<br><p style='color:blue;font-style:bolder;text-align:center'><u>Modification enregistrée !</u></p>";
	header("Refresh:0.5; URL=gestion_avis.php");
}
?>
<h5><u>Modifier infos avis</u></h5>
	<div class="new"> 
		<form method="POST">
			<div class=center>
				<p>
					<label>Commentaire</label><br>
					<textarea name="commentaire" style="width: 30%" required><?php echo $commentaire ?></textarea>
				</p>
				<p>
					<label>Note</label><br>
					<input type="text" name="note" style="width: 25px" required value="<?php echo $note?>"> /5
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