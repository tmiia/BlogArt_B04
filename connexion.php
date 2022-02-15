<?php

require_once __DIR__ . '/back.php';


// Gestion du $_SERVER["REQUEST_METHOD"] => En POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    connect_user($_POST['pseudo'], $_POST['motDePasse']);

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

        <button type="submit">Inscription</button>

     </form>

</body>

</html>