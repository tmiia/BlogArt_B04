<?php

require_once __DIR__ . '/back.php';


// Gestion du $_SERVER["REQUEST_METHOD"] => En POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    insert_user($_POST['email'], $_POST['prenom'], $_POST['nom'], $_POST['pseudo'], $_POST['motDePasse']);

}

?>

<html>
<body>

     <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

        <h2>Inscription</h2>
        
        <label>Email</label>
        <input type="text" name="email" value=""/><br>

        <label>Prénom</label>
        <input type="text" name="prenom" value=""><br> 

        <label>Nom</label>
        <input type="text" name="nom" value=""><br>

        <label>pseudo</label>
        <input type="text" name="pseudo" value=""><br>

        <label>Mot de passe</label>
        <input type="text" name="motDePasse" value=""><br>

        <input type="hidden" id="idStat" name="idStat" value="<?php $idStat = 1; ?>" />


        <button type="submit">Inscription</button>

     </form>

     <a href="connexion.php">Connexion</a>

</body>

</html>