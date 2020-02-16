
<?php
require("include/call_db.php");
require("include/top_main.php");
if(isset($_POST['envoyer'])){
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $email = htmlspecialchars($_POST['email']);
    $mdp = sha1($_POST['mdp']);
    $mdp2 = sha1($_POST['mdp2']);
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $civilite = htmlspecialchars($_POST['civilite']);
    if(!empty($_POST['pseudo']) AND !empty($_POST['email']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])){
        $pseudolength = strlen($pseudo);
        if($pseudolength <= 20) {
            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $reqmail = $db->prepare("SELECT * FROM membre WHERE email = ?");
                $reqmail->execute(array($email));
                $mailexist = $reqmail->rowCount();
                    if($mailexist == 0) {
                        if($mdp == $mdp2) {
                            $requete = $db->exec("INSERT INTO membre (pseudo, mdp, nom, prenom, email, civilite, statut)
                                VALUES('$pseudo', '$mdp', '$nom', '$prenom', '$email', '$civilite', '0')");
                            $message = "Compte créé ! <a href='connection.php'>Me connecter</a>";
                        } 
                        else {
                            $message = "Vos mots de passe ne correspondent pas !";
                        }
                    } 
                        else {
                        $message = "Adresse mail déjà utilisée !";
                        }
            } 
                        else {
                        $message = "Votre adresse mail n'est pas valide !";
                        }
        } 
                        else {
                        $message = "Votre pseudo ne doit pas dépasser 20 caractères !";
                        }
    }
                        else {
                        $message = "Tous les champs doivent être complétés !";
                        }
}
?>
<div class="formulaire">
    <form action="#" method="POST">
        <div class="form-row">
            <div class="form-group">    
                <h3 class="h5">Inscription :</h3>
                    <label for="pseudo"></label><br>
                        <input type="text" name="pseudo" placeholder="Votre pseudo" class="form-control" required>
                    <label for="mdp"></label><br>
                        <input type="password" name="mdp" placeholder="Votre mot de passe" class="form-control" required>
                    <label for="mdp2"></label><br>
                        <input type="password" name="mdp2" placeholder="Vérifiez mot de passe" class="form-control" required>
                    <label for="nom"></label><br>
                        <input type="text" name="nom" placeholder="Votre nom" class="form-control" required>
                    <label for="prenom"></label><br>
                        <input type="text" name="prenom" placeholder="Votre prénom" class="form-control" required>
                    <label for="mail"></label><br>
                        <input type="mail" name="email" placeholder="Votre E-mail" class="form-control" required><br>
                    <select class="form-control" name="civilite" style="font-size: 12px">
                        <option value="m" style="font-size: 12px">Homme</option>
                        <option value="f" style="font-size: 12px">Femme</option>
                    </select><br>
                    <div class="d-flex justify-content-center">
                        <input class="btn btn-outline-secondary" type="submit" name="envoyer" value="Envoyer">
                    </div>
            </div>
        </div>
    </form>
<?php
if(isset($message)) {
    echo '<font color="red">'.$message."</font>";
}
?>
</div>
<?php
require("include/footer.php");
?>