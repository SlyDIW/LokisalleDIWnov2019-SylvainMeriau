<?php
require("include/call_db.php");
require("include/top_main.php");

//BACK OFFICE GESTION DES PRODUITS  -----------------

function readSalleProduit(){
    global $db;
    $sql = "SELECT * FROM salle JOIN produit ON produit.id_salle = salle.id ";
    $requete = $db->query($sql, PDO::FETCH_ASSOC);
    $requete->execute();
    $result = $requete->fetchAll();
    $r = []; 
    foreach ($result as $row) {
        $produit["id_produit"] = $row["id_produit"] ;
        $produit["id_salle"] = $row["id_salle"] ;
        $produit["titre"] = $row["titre"] ;
        $produit["photo"] = $row["photo"] ;
        $produit["date_arrivee"] = $row["date_arrivee"] ;
        $produit["date_depart"] = $row["date_depart"] ;
        $produit["prix"] = $row["prix"] ;
        $produit["etat"] = $row["etat"] ;
        $r[] = $produit ; 
    }
    return $r;
}
$listeSalleProduit = readSalleProduit();
if($_POST){
	$id_salle = $_POST["id_salle"];
	$date_arrivee = $_POST["date_arrivee"];
	$date_depart = $_POST["date_depart"];
	$prix = $_POST["prix"];
	$requete = $db->exec("INSERT INTO produit (id_salle, date_arrivee, date_depart, prix)
                        VALUES ('$id_salle', '$date_arrivee', '$date_depart', '$prix')");
    header("Refresh:0.1; URL=gestion_produits.php");
}
function readSalle(){
    global $db;
    $sql = "SELECT * FROM salle";
    $requete = $db->query($sql, PDO::FETCH_ASSOC);
    $requete->execute();
    $result = $requete->fetchAll();
    $r = []; 
    foreach ($result as $row){
        $salle["id"] = $row["id"] ;
        $salle["titre"] = $row["titre"] ;
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
?>
<div>
    <table class="table table-striped table-bordered table-hover">    
        <tr align="center">
            <th>ID</th>
            <th>Date d'arrivée</th>
            <th>Date de départ</th>         
            <th>ID Salle</th>
            <th>Prix</th>
            <th>Etat</th>
            <th width="100px">Actions</th>
        </tr>
<?php 
        foreach ($listeSalleProduit as $affich ){
            echo "<tr align='center'>";
                echo "<td class='align-middle'>" . $affich["id_produit"] . "</td>";
                echo "<td class='align-middle'>" . $affich["date_arrivee"] . "</td>";
                echo "<td class='align-middle'>" . $affich["date_depart"] . "</td>";
                echo "<td class='align-middle'>" . $affich["id_salle"] . " - " . $affich["titre"] . "<br>" . "<img src=photos_salles/". $affich["photo"] . " style='width:100px'>" . "</td>";
                echo "<td class='align-middle'>" . $affich["prix"] . "€</td>";
                echo "<td class='align-middle'>" . $affich["etat"] . "</td>";
                echo "<td class='align-middle'>" . "<a href='modifier_produit.php?id_produit=". $affich["id_produit"] ."'><img src='logos/modifier.png' width='20px'></a>" . " " . "<a href='deleted.php?id_produit=". $affich["id_produit"] ."'><img src='logos/supprimer.png' width='20px'></a>";
            echo "</tr>";
        }
?>
    </table>
</div>
<div class="new"> 
    <form action="#" method="POST">
        <div class="gauche">
            <p>
                <label>Date d'arrivée </label><br>
                <input class="date_arrivee" type="datetime-local" name="date_arrivee" required>
            </p>
            <p>
                <label>Description </label><br>
                <input class="date_depart" type="datetime-local" name="date_depart" required>
            </p>
        </div>
        <div class="droite">
            <p>
                <label>Salle </label><br>
                <select name="id_salle">
                    <?php 
                    foreach ($listeSalle as $affich){
                        echo "<option value='" . $affich["id"] . "'>" . $affich["id"] . " - " . $affich["titre"] . " - " . $affich["adresse"] . " " . $affich["cp"] . " " . $affich["ville"] . " - " . $affich["capacite"] . " personnes";
                        echo "</option>" ;
                    }
                    ?>
                </select>
            </p>
            <p>
                <label>Tarif </label><br>
                <input class="prix" type="text" name="prix" placeholder="Prix en euros €" required>
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