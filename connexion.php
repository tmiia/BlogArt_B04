<?php

require_once __DIR__ . '/back.php';

require_once __DIR__ . '/CLASS_CRUD/user.class.php';

$user = 'nom';
$motDePasse = 'password';

// INSCRIPTION : champ username / mdp
// qd utilisateur tape mdp > haché (nouvelle chaîne de chara unique)
// fonction php pour ça :

$passCrypt = password_hash($motDePasse, PASSWORD_DEFAULT);

// Gestion du $_SERVER["REQUEST_METHOD"] => En POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // fonction qui vérifie que l'utilisateur a bien tapé ce qui correspond au has de la BDD
    password_verify($_POST['motDePasse'], $passCrypt); // retourne un booleen

    connect_user($_POST['pseudo'], $_POST['motDePasse']);

    if (password_verify($_POST['motDePasse'], $passCrypt) === true) {
        setcookie('user', $user, time() + 3600);
    } else {
        echo('Mauvais mdp sorry');

    }
    if(isset($_COOKIE['user'])) {
        echo('bonjour' . $_COOKIE['user'] . '<br>');
    } else {
        echo('Merci de vous connecter.');
    }


}

?>

<html>
<body>

     <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

        <h2>Connexion</h2>

        <label>Pseudo</label>
        <input type="text" name="pseudo" value=""/><br>

        <label>Mot de passe</label>
        <input type="text" name="motDePasse" value=""/><br>

        <button type="submit">Connexion</button>

     </form>

</body>

</html>