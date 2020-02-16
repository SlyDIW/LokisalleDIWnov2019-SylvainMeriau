<!-- Filtre de tri -->
	<div id="content">
		<aside id="filtre" style="width: 230px;">
			<table class="table table-bordered table-hover">
				<thead>
					<tr><th name="categorie">Catégorie</th></tr></thead>
				<tr>
					<td><a name="reunion" href="">Réunion</a> 
					</td>
				</tr>
				<tr>
					<td><a name="bureau" href="">Bureau</a> 
					</td>
				</tr>
				<tr>
					<td><a name="formation"href="">Formation</a> 
					</td>
				</tr>
			</table>
		<br>
			<table class="table table-bordered table-hover">
				<thead>
					<tr name="ville"><th>Ville</th></tr></thead>
				<tr>
					<td><a name="Paris"href="">Paris</a> 
					</td>
				</tr>
				<tr>
					<td><a name="Lyon" href="">Lyon</a> 
					</td>
				</tr>
				<tr>
					<td><a name="Marseille" href="">Marseille</a> 
					</td>
				</tr>
			</table>
					<FORM><b>Capacité </b>&nbsp;
						<SELECT name="capacite" size="1">
							<OPTION name="1" >1</OPTION>
							<OPTION name="2" >2</OPTION>
							<OPTION name="3">3</OPTION>
							<OPTION name="5">5</OPTION>
							<OPTION name="10">10</OPTION>
							<OPTION name="20">20</OPTION>
						</SELECT>
					</FORM>
			<br>
			<b>Prix</b>
				<form name="prix">
    				<input type="range" name="amountRange" min="100" max="5000" value="2500" oninput="this.form.amountInput.value=this.value"></input><br>
   					<output type="number" name="amountInput" min="100" max="5000" value="2500" oninput="this.form.amountRange.value=this.value."></output> &nbsp; €
  				</form>
  			<br>
				<form>
					<div class="form-group">
   						<label for="arrivee">Date d'arrivée :</label>
    					<input class="form-control" id="arrivee" type="datetime-local" name="date_arrivee" min="2020-01-01T08:00" max="2021-12-30T14:00">
    				</div>
    			</form>
			<br>
    			<form>
    				<div class="form-group">
    					<label for="depart">Date de départ :</label>
    					<input class="form-control" id="depart" type="datetime-local" name="date-depart" min="2020-01-01T18:00" max="2021-12-30T22:00">
    				</div>
    			</form>
    		<br>
			<p class="nombre-resultat">nombre résultats du filtre de recherche (afficher row count)
			</p>
		</aside>

<!-- Affichage resultats filtre de tri -->

<?php
	function viewProduitSalle(){
			global $db;
				$sql = "SELECT * FROM produit
				JOIN salle ON salle.id = produit.id_salle 
				LEFT JOIN avis ON avis.id_salle = salle.id
				";

    		$requete = $db->query($sql, PDO::FETCH_ASSOC);
  			$requete->execute();
   			$result = $requete->fetchAll();
    		$r = []; 

    	foreach ($result as $row) {
     		$produit["id_produit"] = $row["id_produit"] ;
            $produit["titre"] = $row["titre"] ;
            $produit["photo"] = $row["photo"] ;
            $produit["description"] = $row["description"] ;
            $produit["date_arrivee"] = $row["date_arrivee"] ;
            $produit["date_depart"] = $row["date_depart"] ;
            $produit["prix"] = $row["prix"] ;
            $produit["note"] = $row["note"] ;
            $r[] = $produit ; 
        }
        return $r;
	}
		$viewProduit = viewProduitSalle();
?>
		<div id="view" class="row">
			<?php
				foreach ($viewProduit as $view) {
					echo "<div class='vue-produit' class='col' style='width:240px'>";
						echo "<img src=photos_salles/" . $view["photo"] . " style='width:230px'>" . "<br>";				
						echo "<a class='d-flex justify-content-end' href='produit.php?id_produit=". $view["id_produit"] ."'><img src='logos/loupe.png' width='20px'> Voir produit </a>" ." ";
						echo "<p><span class='titre'>" . $view["titre"] . " - ". $view["prix"] . "€ /jour" . "<br>" . "</span>" . "<br>";
						echo "<span class='description'>" . $view["description"] . "<br>" . "</span></p>" ;
						echo "<p class='dates'>Libre " . "du : " . $view["date_arrivee"] . " au ";
						echo $view["date_depart"] . "<br>" . "</p>";
						echo "<span class='note' class='d-flex justify-content-start'>" . "note : " . $view["note"] . " /5" ."</span>";
					echo "</div>";
				}
			?>
		</div>
	</div>
