<?php
////////////////////////////////////////////////////////////
//
//  CRUD article (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : article.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Mise en forme date
require_once __DIR__ . '/../../util/dateChangeFormat.php';

// Insertion classe article
require_once __DIR__ . '/../../class_crud/article.class.php';

// Instanciation de la classe article
$monarticle = new article();

// Insertion classe angle
require_once __DIR__ . '/../../class_crud/angle.class.php';

// Instanciation de la classe angle
$monangle = new angle();

// Insertion classe thematique
require_once __DIR__ . '/../../class_crud/thematique.class.php';
// Instanciation de la classe MotCle
$mathematique = new thematique();


?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
	<title>Admin - CRUD article</title>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <style type="text/css">
        .error {
            padding: 2px;
            border: solid 0px black;
            color: red;
            font-style: italic;
            border-radius: 5px;
        }
    </style>
</head>
<body>
	<h1>BLOGART22 Admin - CRUD article</h1>

	<hr />
	<h2>Nouvel article :&nbsp;<a href="./createarticle.php"><i>Créer un article</i></a></h2>
    <hr />
	<h2>Tous les articles</h2>

	<table border="3" bgcolor="aliceblue">
    <thead>
        <tr>
            <th>&nbsp;N°&nbsp;</th>
            <th>&nbsp;Date&nbsp;</th>
            <th>&nbsp;Titre&nbsp;</th>
            <th>&nbsp;Chapeau&nbsp;</th>
            <th>&nbsp;Accroche&nbsp;</th>
            <th>&nbsp;angle&nbsp;</th>
            <th>&nbsp;Thématique&nbsp;</th>
            <th colspan="2">&nbsp;Action&nbsp;</th>
        </tr>
    </thead>
    <tbody>
<?php
    // Appel méthode : Get tous les articles en bdd
    $allarticles = $monarticle->get_Allarticles();
    
    // Boucle pour afficher
    for($i =0; $i < count($allarticles); $i++){
    //foreach($all as $row) {

?>
        <tr>
		<td><h4>&nbsp; <?= $allarticles[$i]['numArt']; ?> &nbsp;</h4></td>

        <td>&nbsp; <?= $allarticles[$i]['dtCreArt']; ?> &nbsp;</td>

        <td>&nbsp; <?=  $allarticles[$i]['libTitrArt']; ?> &nbsp;</td>

        <td>&nbsp; <?= $allarticles[$i]['libChapoArt']; ?> &nbsp;</td>

        <td>&nbsp; <?=  $allarticles[$i]['libAccrochArt']; ?> &nbsp;</td>

        <td>&nbsp; <?= $monangle->get_1angle($allarticles[$i]['numAngl'])['libAngl'] ; ?> &nbsp;</td>

        <td>&nbsp; <?= $mathematique->get_1thematique($allarticles[$i]['numThem'])['libThem']; ?> &nbsp;</td>

		<td>&nbsp;&nbsp;<a href="./updatearticle.php?id=<?=$allarticles[$i]['numArt']; ?>"><i><img src="./../../img/valider-png.png" width="20" height="20" alt="Modifier article" title="Modifier article" /></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
		<br /></td>
		<td>&nbsp;&nbsp;<a href="./deletearticle.php?id=<?=$allarticles[$i]['numArt']; ?>"><i><img src="./../../img/supprimer-png.png" width="20" height="20" alt="Supprimer article" title="Supprimer article" /></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
		<br /></td>
        </tr>
<?php
	 }	// End of foreach
?>
    </tbody>
    </table>
    <br/>
<?php
require_once __DIR__ . '/footer.php';
?>
</body>
</html>
