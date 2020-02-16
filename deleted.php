<?php
require "include/call_db.php";
  if($id_salle = $_GET['id_salle']) {
    $requete = $db->exec("DELETE FROM salle WHERE id = '$id_salle'");
    header("Refresh:0;URL=gestion_salles.php");
  }
  elseif($id_produit = $_GET['id_produit']) {
    $requete = $db->exec("DELETE FROM produit WHERE id_produit = '$id_produit'");
    header("Refresh:0;URL=gestion_produits.php");
  }
  elseif($id_membre = $_GET['id_membre']) {
    $requete = $db->exec("DELETE FROM membre WHERE id_membre = '$id_membre'");
    header("Refresh:0;URL=gestion_membres.php");
  }
  elseif($id_commande = $_GET['id_commande']) {
    $requete = $db->exec("DELETE FROM commande WHERE id_commande = '$id_commande'");
    header("Refresh:0;URL=gestion_commandes.php");
  }
  elseif($id_avis = $_GET['id_avis']) {
    $requete = $db->exec("DELETE FROM avis WHERE id_avis = '$id_avis'");
    header("Refresh:0;URL=gestion_avis.php");
  }
echo "<h1 style='color:red;'>La suppression a bien été effectuée</h1>";
?>
<?php
require("include/footer.php");
?>