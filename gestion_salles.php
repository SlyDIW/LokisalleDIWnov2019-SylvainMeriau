<?php
require("include/call_db.php");
require("include/top_main.php");

//BACK OFFICE GESTION DES SALLES  -----------------

function readSalle(){
    global $db;
    $sql = "SELECT * FROM salle";
    $requete = $db->query($sql, PDO::FETCH_ASSOC);
    $requete->execute();
    $result = $requete->fetchAll();
    $r = []; 
    foreach ($result as $row) {
        $salle["id"] = $row["id"] ;
        $salle["titre"] = $row["titre"] ;
        $salle["description"] = $row["description"] ;
        $salle["photo"] = $row["photo"] ;
        $salle["pays"] = $row["pays"] ;
        $salle["ville"] = $row["ville"] ;
        $salle["adresse"] = $row["adresse"] ;
        $salle["cp"] = $row["cp"] ;
        $salle["capacite"] = $row["capacite"] ;
        $salle["categorie"] = $row["categorie"] ;
         $r[] = $salle ; 
    }
    return $r;
}
$listeSalle = readSalle();
if (!empty ($_POST)){
	$titre = $_POST['titre'];
	$description = $_POST['description'];
	$photo = $_POST['photo'];
	$pays = $_POST['pays'];
	$ville = $_POST['ville'];
	$adresse = $_POST['adresse'];
	$cp = $_POST['cp'];
	$capacite = $_POST['capacite'];
	$categorie = $_POST['categorie'];
	$requete = $db->prepare("INSERT INTO  `salle` (`id`, `titre`, `description`, `photo`, `pays`, `ville`, `adresse`, `cp`, `capacite`, `categorie`) 
							VALUES (NULL,'$titre', '$description', '$photo', '$pays', '$ville', '$adresse','$cp', '$capacite', '$categorie')");
	$requete->execute();
	$requete->closeCursor();
	header("Refresh:0;URL=gestion_salles.php");
}
?>
<div>
<table class="table table-striped table-bordered table-hover">    
    <tr align="center">
        <th>ID</th>
        <th>Titre</th>
        <th>Description</th>
        <th>Photo</th>
        <th>Pays</th>
        <th>Ville</th>
        <th>Adresse</th>
        <th>CodePostal</th>
        <th>Capacité</th>
        <th>Catégorie</th>
        <th width="100px">Actions</th>
    </tr>
<?php 
foreach ($listeSalle as $affich){
    echo "<tr align='center'>";
        echo "<td class='align-middle'>" . $affich["id"] . "</td>";
        echo "<td class='align-middle'>" . $affich["titre"] . "</td>";
        echo "<td class='align-middle'>" . $affich["description"] . "</td>";
        echo "<td class='align-middle'>" . "<img src ='" . "photos_salles/" . $affich["photo"] . "' width='100px'>" ."</td>";
        echo "<td class='align-middle'>" . $affich["pays"] . "</td>";
        echo "<td class='align-middle'>" . $affich["ville"] . "</td>";
        echo "<td class='align-middle'>" . $affich["adresse"] . "</td>";
        echo "<td class='align-middle'>" . $affich["cp"] . "</td>";
        echo "<td class='align-middle'>" . $affich["capacite"] . "</td>";
        echo "<td class='align-middle'>" . $affich["categorie"] . "</td>";
        echo "<td class='align-middle'>" . "<a href='produit.php?id_salle=". $affich["id"] ."'><img src='logos/loupe.png' width='20px'></a>" ." ". "<a href='modifier.php?id_salle=". $affich["id"] ."'><img src='logos/modifier.png' width='20px'></a>" . " " . "<a href='deleted.php?id_salle=".$affich["id"] ."'><img src='logos/supprimer.png' width='20px'></a>";
    echo "</tr>";
}
?>   
</table>
</div>
<hr>	
<h5>Enregistrer une nouvelle salle</h5>
	<div class="new"> 
		<form method="POST">
		<div class="gauche">
			<p>
				<label>Titre </label><br>
					<input class="titre" type="text" name="titre" required>
			</p>
			<p>
				<label>Description </label><br>
					<input class="description" type="text" name="description" required>
			</p>
			<p>
				<label>Photo </label><br>
					<input type="file" name="photo" required>
			</p>
			<p>
				<label>Capacité </label><br>
					<select class="capacite" name="capacite">
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
					<select class="categorie" name="categorie">
						<option>reunion</option>
						<option>bureau</option>
						<option>formation</option>
					</select>
			</p>
		</div>
		<div class="droite">
			<p>
				<label>Pays </label><br>
					<select class="pays" name="pays">
						<option>France</option>
						<option>Autre</option>
					</select>
			</p>
			<p>
				<label>Ville </label><br>
					<select class="ville" name="ville">
						<option >Paris</option>
						<option >Lyon</option>
						<option >Marseille</option>
					</select>
			</p>
			<p>
				<label>Adresse </label><br>
				<input class="adresse" type="text" name="adresse" required>
			</p>
			<p>
				<label>Code postal </label><br>
					<input class="cp" type="text" name="cp" required> 
			</p>
			<p>
				<button type="submit" class="btn btn-secondary">ENREGISTRER</button>
			</p>
		</div>
		</form>
	</div>
<?php
	require("include/footer.php");
?>