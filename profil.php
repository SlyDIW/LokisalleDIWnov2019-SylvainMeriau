
<?php
require("include/call_db.php");
require("include/top_main.php");
?>
<h1 class="h5">Profil</h1>
<?php
	if (isset($_SESSION) && !empty($_SESSION)){
		echo "Bienvenue sur le profil de " . $_SESSION['pseudo'];
	}
?>