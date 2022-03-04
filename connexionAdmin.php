<?php
require_once './CONNECT/database.php';
require_once ROOT . '/back.php';

require_once ROOT . '/CLASS_CRUD/membre.class.php';
$monMembre = new MEMBRE();

// INSCRIPTION : champ username / mdp
// qd utilisateur tape mdp > haché (nouvelle chaîne de chara unique)
// fonction php pour ça :



// Gestion du $_SERVER["REQUEST_METHOD"] => En POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $pseudo = $_POST['pseudoUser'];
    $motDePasse = $_POST['passUser'];
    // $passCrypt = password_hash($motDePasse, PASSWORD_DEFAULT);

    if($pseudo != NULL and $motDePasse != NULL){
        echo("dedaaaaaans");
        connect_user($pseudo, $motDePasse);
    }
    else{
        echo("mauvais mdp connard");
    }

}

?>

<html>

<link href="./front/style.css" rel="stylesheet">
<?php require_once ROOT . '/front/includes/commons/imports.php'; 
require_once ROOT . '/front/includes/commons/headerFront.php';
?>

<section class="form_connexion">

     <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

        <h3><span>Connexion Administrateur</span></h3>

        <div class="champs_connexion">
            <label>Pseudo :</label><br>
            <input type="text" name="pseudoUser" value=""/><br>

            <label>Mot de passe :</label><br>
            <input type="text" name="passUser" value=""/><br>
        
            <button type="submit">Se connecter</button>
        </div>
        
     </form>

</section>

<?php require_once ROOT . '/front/includes/commons/footerFront.php';?>

</html>