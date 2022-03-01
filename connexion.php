<?php

require_once __DIR__ . '/back.php';

require_once __DIR__ . '/CLASS_CRUD/membre.class.php';
$monMembre = new MEMBRE();

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


    // fonction qui vérifie que l'utilisateur a bien tapé ce qui correspond au hash de la BDD
    password_verify($_POST['passMemb'], $passCrypt); // retourne un booleen

    connect_user($_POST['eMailMemb'], $_POST['passMemb']);

    if (password_verify($_POST['passMemb'], $passCrypt) === true) {
        setcookie('eMailMemb', $membre, time() + 3600);
        setcookie('pseudoMemb', $pseudo, time() + 3600);

        

    } else {
        echo('Mauvais mdp sorry');

    }
    if(isset($_COOKIE['eMailMemb'])) {  
        header("Location: index1.php");
        echo('bonjour ' . $_COOKIE['pseudoMemb'] . '<br>');
    } else {
        echo('Merci de vous connecter.');
    }


}

?>

<html>
<section class="form_connexion">

     <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

        <h2>Connexion</h2>

        <label>Pseudo</label>
        <input type="text" name="eMailMemb" value=""/><br>

        <label>Mot de passe</label>
        <input type="text" name="passMemb" value=""/><br>

        <button type="submit">Connexion</button>

     </form>

</section>

</html>