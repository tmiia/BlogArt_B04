<?php

require_once __DIR__ . '/back.php';


// Insertion classe Membre
require_once __DIR__ . '/CLASS_CRUD/membre.class.php';
// Instanciation de la classe membre
$newMembre = new MEMBRE();


// Gestion du $_SERVER["REQUEST_METHOD"] => En POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $accordMemb = intval($_POST['accordMemb']);
    $idStat = 4;


    $newMembre->create($_POST['prenom'], $_POST['nom'], $_POST['pseudo'], $_POST['motDePasse'], $_POST['email'], $accordMemb, $idStat);

    header("Location: http://localhost/GIT%20BLOGART/BlogArt/index1.php");
}

?>

<html>

<link href="./front/style.css" rel="stylesheet">
<?php require_once __DIR__ . '../front/includes/commons/imports.php'; 
require_once __DIR__ . '/front/includes/commons/headerFront.php';
?>

<body>

     <form class="form_inscription" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

        <h2>Formulaire d'inscription</h2>

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
        <input type="text" name="motDePasse" value=""><br>

        <input type="hidden" name="dtCreaMemb" id="dtCreaMemb" value="<?php if(isset($_GET['id'])) echo $_POST['dtCreaMemb']; ?>" tabindex="20" placeholder="" />

        <fieldset>
            <input type="radio" name="accordMemb" value="1" />
                &nbsp;&nbsp;Oui&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="accordMemb" value="0" />
                &nbsp;&nbsp;Non&nbsp;&nbsp;&nbsp;&nbsp;
        </fieldset>

        <button type="submit">Inscription</button>
    
        </div>
     </form>

     <a href="connexion.php">Connexion</a>

</body>

<?php require_once __DIR__ . '../front/includes/commons/footerFront.php';?>

</html>