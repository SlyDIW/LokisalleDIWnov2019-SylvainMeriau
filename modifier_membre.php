
<?php
require("include/call_db.php");
require("include/top_main.php");
if(isset($_GET['id_membre'])){
	$id_membre = $_GET['id_membre'];
	$requete = $db->query("SELECT * FROM membre WHERE id_membre = '$id_membre' ");
	$resultat = $requete->fetch(PDO::FETCH_ASSOC);
	$pseudo = $resultat['pseudo'];
	$mdp = $resultat['mdp'];
	$nom = $resultat['nom'];
	$prenom = $resultat['prenom'];
	$email = $resultat['email'];
	$civilite = $resultat['civilite'];
	$statut = $resultat['statut'];
}
if($_POST){
	$requete = $db->prepare("UPDATE membre 
							SET pseudo = :pseudo, mdp = :mdp, nom = :nom, prenom = :prenom, email = :email, civilite = :civilite, statut = :statut 
							WHERE id_membre = '$id_membre'");
	$requete->execute(array(
		'pseudo'=> $_POST["pseudo"],
		'mdp'=> $_POST["mdp"],
		'nom' => $_POST["nom"],
		'prenom' => $_POST["prenom"],
		'email' => $_POST["email"],
		'civilite' => $_POST["civilite"],
		'statut' => $_POST["statut"],));
	$content .= "<br><p style='color:blue;font-style:bolder;text-align:center'><u>Modification enregistrée !</u></p>";
	header("Refresh:1; URL=gestion_membres.php");
}
?>
<h5><u>Modifier infos membre</u></h5>
	<div class="new"> 
		<form method="POST">
			<div class="gauche">
				<p>
					<label>Pseudo </label><br>
					<input type="text" name="pseudo" required value="<?php echo $pseudo ?>">
				</p>
				<p>
					<label>Password </label><br>
					<input  type="text" name="mdp" required value="<?php echo $mdp ?>">
				</p>
				<p>
					<label>Nom </label><br>
					<input  type="text" name="nom" required value="<?php echo $nom ?>">
				</p>
				<p>
					<label>Prénom </label><br>
					<input  type="text" name="prenom" required value="<?php echo $prenom ?>">
				</p>
			</div>
			<div class="droite">
				<p>
					<label>Email </label><br>
					<input  type="text" name="email" required value="<?php echo $email ?>">
				</p>
				<p>
					<label>Civilité </label><br>
				<select  class="civilite" name="civilite" required value="<?php echo $civilite ?>">
					<option name="Mr">Mr</option>
					<option name="Mme">Mme</option>
				</select>
				</p>
				<p>
					<label>Statut </label><br>
					<select  class="statut" name="statut" required value="<?php echo $statut ?>">
						<option name="user">user</option>
						<option name="admin">admin</option>
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