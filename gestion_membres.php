<?php
require("include/call_db.php");
require("include/top_main.php");

//BACK OFFICE GESTION DES MEMBRES  -----------------

function readMembre(){
    global $db;
    $sql = "SELECT * FROM membre";
    $requete = $db->query($sql, PDO::FETCH_ASSOC);
    $requete->execute();
    $result = $requete->fetchAll();
    $r = []; 
    foreach ($result as $row) {
        $membre["id_membre"] = $row["id_membre"] ;
        $membre["pseudo"] = $row["pseudo"] ;
        $membre["mdp"] = $row["mdp"] ;
        $membre["nom"] = $row["nom"] ;
        $membre["prenom"] = $row["prenom"] ;
        $membre["email"] = $row["email"] ;
        $membre["civilite"] = $row["civilite"] ;
        $membre["statut"] = $row["statut"] ;
        $membre["date_enregistrement"] = $row["date_enregistrement"] ;
        $r[] = $membre ; 
    }
    return $r;
}
$listeMembre = readMembre();
   	if($_POST){
		$pseudo = $_POST["pseudo"];
		$mdp = $_POST["mdp"];
		$nom = $_POST["nom"];
		$prenom = $_POST["prenom"];
		$email = $_POST["email"];
		$civilite = $_POST["civilite"];
		$statut = $_POST["statut"];
		$requete = $db->exec("INSERT INTO membre (pseudo, mdp, nom, prenom, email, civilite, statut) VALUES ('$pseudo', '$mdp', '$nom', '$prenom', '$email', '$civilite', '$statut')");
        header("Refresh:0;URL=gestion_membres.php");
	}
?>
<div>
    <table class="table table-striped table-bordered table-hover">    
        <tr align="center">
            <th>ID</th>
        	<th>Pseudo</th>
            <th>Password</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Civilité</th>
            <th>Statut</th>
            <th>Date enregistrement</th>
            <th width="100px">Actions</th>
        </tr>
<?php 
    foreach ($listeMembre as $affich){
        echo "<tr align='center'>";
            echo "<td class='align-middle'>" . $affich["id_membre"] . "</td>";
            echo "<td class='align-middle'>" . $affich["pseudo"] . "</td>";
            echo "<td class='align-middle'>" . $affich["mdp"] . "</td>";
            echo "<td class='align-middle'>" . $affich["nom"] . "</td>";
            echo "<td class='align-middle'>" . $affich["prenom"] . "</td>";
            echo "<td class='align-middle'>" . $affich["email"] . "</td>";
            echo "<td class='align-middle'>" . $affich["civilite"] . "</td>";
            echo "<td class='align-middle'>" . $affich["statut"] . "</td>";
            echo "<td class='align-middle'>" . $affich["date_enregistrement"] . "</td>";
            echo "<td class='align-middle'>" . "<a href='modifier_membre.php?id_membre=". $affich["id_membre"] ."'><img src='logos/modifier.png' width='20px'></a>" . " " . "<a href='deleted.php?id_membre=". $affich["id_membre"] ."'><img src='logos/supprimer.png' width='20px'></a>" ;
        echo "</tr>";
    }
?>
    </table>
</div>
<div class="new"> 
    <form method="POST">
        <div class="gauche">
            <p>
                <label>Pseudo </label><br>
                <input class="pseudo" type="text" name="pseudo" required>
            </p>
            <p>
                <label>Mot de passe</label><br>
                <input class="mdp" type="text" name="mdp" required>
            </p>
            <p>
                <label>Nom </label><br>
                <input class="nom" type="text" name="nom" required>
            </p>
            <p>
                <label>Prénom </label><br>
                <input class="prenom" type="text" name="prenom" required>
            </p>
        </div>
        <div class="droite">
            <p>
                <label>Email </label><br>
                <input  type="text" name="email" required >
            </p>
            <p>
                <label>Civilité </label><br>
                <select  class="civilite" name="civilite" required >
                    <option name="Mr">Mr</option>
                    <option name="Mme">Mme</option>
                </select>
            </p>
            <p>
                <label>Statut </label><br>
                <select  class="statut" name="statut" required >
                    <option name="user">user</option>
                    <option name="admin">admin</option>
                </select>
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