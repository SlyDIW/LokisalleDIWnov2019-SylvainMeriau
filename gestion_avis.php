<?php
require("include/call_db.php");
require("include/top_main.php");

//BACK OFFICE GESTION DES AVIS-----------------

function readCommande(){
    global $db;
    $sql = "SELECT avis.id_avis, avis.commentaire, avis.note, avis.date_enregistrement, membre.id_membre, membre.email, salle.id, salle.titre
            FROM avis 
            JOIN membre
            ON avis.id_membre = membre.id_membre
            JOIN salle
            ON avis.id_salle = salle.id
            ";
    $requete = $db->query($sql, PDO::FETCH_ASSOC);
    $requete->execute();
    $result = $requete->fetchAll();
    $r = [];   
    foreach ($result as $row) {
        $commande["id_avis"] = $row["id_avis"] ;
        $commande["commentaire"] = $row["commentaire"] ;
        $commande["note"] = $row["note"] ;                
        $commande["date_enregistrement"] = $row["date_enregistrement"] ;
        $commande["id_membre"] = $row["id_membre"] ;
        $commande["email"] = $row["email"] ;
        $commande["id"] = $row["id"] ;
        $commande["titre"] = $row["titre"] ;
        $r[] = $commande ; 
    }
    return $r;
}
$listeCommande = readCommande();
   	if(!empty ($_POST)){
		$commentaire = $_POST["commentaire"];
		$note = $_POST["note"];
		$requete = $db->exec("INSERT INTO avis (commentaire, note) VALUES ('$commentaire', '$note') ");
	}
?>
<div>
    <table class="table table-striped table-bordered table-hover">    
        <tr align="center">
            <th>ID avis</th>
            <th>ID membre</th>
            <th>ID salle</th>         
            <th>Commentaire</th>
            <th>Note</th>
            <th>Date d'enregistrement</th>
            <th width="100px">Actions</th>
        </tr>
<?php 
foreach ($listeCommande as $affich ){
    echo "<tr align='center'>";
        echo "<td class='align-middle'>" . $affich["id_avis"] . "</td>";
        echo "<td class='align-middle'>" . $affich["id_membre"] . " - " . $affich["email"] ."</td>";
        echo "<td class='align-middle'>" . $affich["id"] . " - " . $affich["titre"] . "</td>";
        echo "<td class='align-middle'>" . $affich["commentaire"] . "</td>";
        echo "<td class='align-middle'>" . $affich["note"] . "/5" . "</td>";
        echo "<td class='align-middle'>" . $affich["date_enregistrement"] . "</td>";
        echo "<td class='align-middle'>" . "<a href='modifier_avis.php?id_avis=". $affich["id_avis"] ."'><img src='logos/modifier.png' width='20px'></a>" . " " . "<a href='deleted.php?id_avis=". $affich["id_avis"] ."'><img src='logos/supprimer.png' width='20px'></a>" ;
    echo "</tr>";
}
?>
    </table>
</div>
<?php
    require("include/footer.php");
?>