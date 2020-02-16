<?php
require("include/call_db.php");
require("include/top_main.php");

//BACK OFFICE GESTION DES COMMANDES-----------------

function readCommande(){
    global $db;
    $sql = "SELECT commande.id_commande, membre.id_membre, membre.email, produit.id_produit, salle.titre, produit.date_arrivee, produit.date_depart, produit.prix, commande.date_enregistrement
            FROM commande 
            JOIN produit 
            ON commande.id_produit = produit.id_produit
            JOIN membre 
            ON commande.id_membre = membre.id_membre
            JOIN salle
            ON produit.id_salle = salle.id
            ";
    $requete = $db->query($sql, PDO::FETCH_ASSOC);
    $requete->execute();
    $result = $requete->fetchAll();
    $r = [];   
    foreach ($result as $row) {
        $commande["id_commande"] = $row["id_commande"] ;
        $commande["id_membre"] = $row["id_membre"] ;
        $commande["email"] = $row["email"] ;
        $commande["id_produit"] = $row["id_produit"] ;
        $commande["titre"] = $row["titre"] ;
        $commande["date_arrivee"] = $row["date_arrivee"] ;
        $commande["date_depart"] = $row["date_depart"] ;
        $commande["prix"] = $row["prix"] ;
        $commande["date_enregistrement"] = $row["date_enregistrement"] ;
         $r[] = $commande ; 
    }
    return $r;
}
$listeCommande = readCommande();
    if($_POST){
		$id_membre = $_POST["id_membre"];
		$id_produit = $_POST["id_produit"];
		$prix = $_POST["prix"];
		$date_enregistrement = $_POST["date_enregistrement"];
		$requete = $db->exec("INSERT INTO commande (id_membre, id_produit, prix, date_enregistrement) VALUES ('$id_membre', '$id_produit', '$prix', '$date_enregistrement') ");
	}
?>
<div>
    <table class="table table-striped table-bordered table-hover">    
        <tr align="center">
            <th>ID commande</th>
            <th>ID membre</th>
            <th>ID produit</th>         
            <th>Prix</th>
            <th>Date d'enregistrement</th>
            <th width="100px">Actions</th>
        </tr>
<?php 
    foreach ($listeCommande as $affich ){
        echo "<tr align='center'>";
            echo "<td class='align-middle'>" . $affich["id_commande"] . "</td>";
            echo "<td class='align-middle'>" . $affich["id_membre"] . " - " . $affich["email"] ."</td>";
            echo "<td class='align-middle'>" . $affich["id_produit"] . " - " . $affich["titre"] . "<br>" . $affich["date_arrivee"] . " au " . $affich["date_depart"] . "</td>";
            echo "<td class='align-middle'>" . $affich["prix"] . "€</td>";
            echo "<td class='align-middle'>" . $affich["date_enregistrement"] . "</td>";
            echo "<td class='align-middle'>" . "<a href='modifier_commande.php?id_commande=". $affich["id_commande"] ."'><img src='logos/modifier.png' width='20px'></a>" . " " . "<a href='deleted.php?id_commande" . $affich["id_commande"] ."'><img src='logos/supprimer.png' width='20px'></a>" ;
        echo "</tr>";
    }
?>
    </table>
</div>
<?php
    require("include/footer.php");
?>