<?php
require("include/call_db.php");
require("include/top_main.php");
$content = "";
if(isset($_GET['action']) && $_GET['action'] == "deconnexion"){
    session_destroy();
    header("Refresh:0.5; URL=connection.php");
}
if (!empty($_POST)) {
    $pseudo = htmlentities($_POST['pseudo'], ENT_QUOTES);
    $mdp = htmlentities($_POST['mdp'], ENT_QUOTES);
    global $db;
    $sql =" SELECT *  
            FROM membre
            WHERE pseudo = '$pseudo' AND mdp = '$mdp'";
    $requete = $db->query($sql);
    $resultat = $requete->fetch(PDO::FETCH_ASSOC);
    if($resultat == false){
        $content = "mauvais ID ou MDP";
    }
    else{
        foreach ($resultat as $key => $value) {
            if($key == 'pseudo'){
                $content = "Bienvenue " . $value . " !";
                $_SESSION['pseudo'] = $pseudo;
            } 
        }
    }
    header("Refresh:2; URL=index.php");
} 
?>
<h1 class="h5">Connection :</h1>
<?php echo ($content); ?>
	<form method="POST">
	    <div class="form-row">
            <div class="form-group"> 
                <label for="pseudo"></label><br>
                <input type="text" name="pseudo" placeholder="Votre pseudo" class="form-control" required>
                <label for="mdp"></label><br>
                <input type="password" name="mdp" placeholder="Votre mot de passe" class="form-control" required>
			        <div class="d-flex justify-content-center">
                        <input class="btn btn-outline-secondary" type="submit" name="connection" value="Connection">
                    </div>
		    </div>
	   </div>
	</form>
<?php
    require("include/footer.php");
?>