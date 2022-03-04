<?php

require_once 'back.php';

require_once ROOT . '/class_crud/membre.class.php';
$monMembre = new membre();

// INSCRIPTION : champ username / mdp
// qd utilisateur tape mdp > haché (nouvelle chaîne de chara unique)
// fonction php pour ça :



// Gestion du $_SERVER["REQUEST_METHOD"] => En POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $membre = $_POST['eMailMemb'];

    $pseudo = $monMembre->get_1MembreByEmail($membre)['pseudoMemb'];

    $motDePasse = $_POST['passMemb'];
    $passCrypt = password_hash($motDePasse, PASSWORD_DEFAULT);

    $monMembre->get_1MembreByEmail($_POST['eMailMemb']);


    // fonction qui vérifie que l'utilisateur a bien tapé ce qui correspond au hash de la bdd
    password_verify($_POST['passMemb'], $passCrypt); // retourne un booleen

    connect_user($_POST['eMailMemb'], $_POST['passMemb']);

    if (password_verify($_POST['passMemb'], $passCrypt) === true) {
        setcookie('eMailMemb', $membre, time() + 3000600);
        setcookie('pseudoMemb', $pseudo, time() + 30003600);

        if(isset($_COOKIE['eMailMemb'])) {  
            header("Location: /blogart22/front/pagearticles.php");
            echo('bonjour ' . $_COOKIE['pseudoMemb'] . '<br>');
        } else {
            echo('Merci de vous connecter.');
        }

    } else {
        echo('Mauvais mdp sorry');

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

        <h3><span>Connexion</span></h3>

        <div class="champs_connexion">
            <label>Adresse mail :</label><br>
            <input type="text" name="eMailMemb" value=""/><br>

            <label>Mot de passe :</label><br>
            <input type="text" name="passMemb" value=""/><br>
        
            <button type="submit">Se connecter</button>
        </div>
        
     </form>

</section>

<?php require_once ROOT . '/front/includes/commons/footerFront.php';?>

</html>