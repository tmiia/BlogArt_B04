<?php
require_once 'back.php';


// Insertion classe Membre
require_once ROOT . '/CLASS_CRUD/membre.class.php';
// Instanciation de la classe membre
$newMembre = new MEMBRE();


// Gestion du $_SERVER["REQUEST_METHOD"] => En POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $accordMemb = intval($_POST['accordMemb']);
    $idStat = 4;


    $newMembre->create($_POST['prenom'], $_POST['nom'], $_POST['pseudo'], $_POST['motDePasse'], $_POST['email'], $accordMemb, $idStat);

    header("Location:". ROOTFRONT ."/connexion.php");
}

?>

<html>

<link href="./front/style.css" rel="stylesheet">
<?php require_once ROOT . '/front/includes/commons/imports.php'; 
require_once ROOT . '/front/includes/commons/headerFront.php';
?>

<body>

    <div id="main_inscription">

        <form class="form_inscription" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

            <h3><span>Inscription</span></h3>

            <div class="champs_inscription">
            
                <label>Email</label>   
                <input type="text" name="email" value=""/><br>

                <label>Prénom</label>
                <input type="text" name="prenom" value=""><br> 

                <label>Nom</label>
                <input type="text" name="nom" value=""><br>

                <label>Pseudo</label>
                <input type="text" name="pseudo" value=""><br>

                <label>Mot de passe</label>
                <input type="password" name="motDePasse" value=""><br>

                <input type="hidden" name="dtCreaMemb" id="dtCreaMemb" value="<?php if(isset($_GET['id'])) echo $_POST['dtCreaMemb']; ?>" tabindex="20" placeholder="" />
                
                <br><label>Acceptez vous les cookies ?</label><br>
                <fieldset>
                    <input type="radio" name="accordMemb" value="1" />
                        &nbsp;&nbsp;Oui&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="accordMemb" value="0" />
                        &nbsp;&nbsp;Non&nbsp;&nbsp;&nbsp;&nbsp;
                </fieldset>

                <div class="btn_inscription_connexion">
                    <a href="./front/home.php">Annuler</a>
                    <button type="submit">Inscription</button>
                </div>

            </div>
        
        </form>


    </div>
</body>

<?php require_once ROOT . '/front/includes/commons/footerFront.php';?>

</html>