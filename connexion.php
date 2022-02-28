<?php

require_once __DIR__ . '/back.php';

require_once __DIR__ . '/CLASS_CRUD/membre.class.php';
$monMembre = new MEMBRE();

$membre = 'pseudoMemb';
$motDePasse = 'passMemb';

// INSCRIPTION : champ username / mdp
// qd utilisateur tape mdp > haché (nouvelle chaîne de chara unique)
// fonction php pour ça :

$passCrypt = password_hash($motDePasse, PASSWORD_DEFAULT);

// Gestion du $_SERVER["REQUEST_METHOD"] => En POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // fonction qui vérifie que l'utilisateur a bien tapé ce qui correspond au hash de la BDD
    password_verify($_POST['passMemb'], $passCrypt); // retourne un booleen

    connect_user($_POST['pseudoMemb'], $_POST['passMemb']);

    if (password_verify($_POST['passMemb'], $passCrypt) === true) {
        setcookie('pseudoMemb', $membre, time() + 3600);
    } else {
        echo('Mauvais mdp sorry');

    }
    if(isset($_COOKIE['membre'])) {
        echo('bonjour' . $_COOKIE['membre'] . '<br>');
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
        <input type="text" name="pseudoMemb" value=""/><br>

        <label>Mot de passe</label>
        <input type="text" name="passMemb" value=""/><br>

        <button type="submit">Connexion</button>

     </form>

</body>

</html>