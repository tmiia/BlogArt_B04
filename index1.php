<?php
////////////////////////////////////////////////////////////
//
//  Gestion des CRUD (PDO) - Modifié : 14 Juillet 2021
//
//  Script  : index1.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <title>Gestion des CRUD</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <style type="text/css">
		div {
			padding-top: 60px;
			padding-bottom: 40px;
			margin-bottom: 0px;
			margin-left: 60px;
		}
        span {
            background-color: yellow;
        }
		hr {
			border: none;
			height: 3px;
			/* Set the hr color */
			color: #333; /* old IE */
			background-color: #333; /* Modern Browsers */
		}
		.hr1 {
			width: 60%;
			background-color: #CCCCCC;	/* => grey */
		}
    </style>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"></script>
</head>
<body>
	<br />
	<h1>Panneau d'Admin : CRUD - BLOGART22 (ETUD)</h1>
	<small><span><i>CRUD fini et valide (reste à intégrer et à tester)</i></span></small>
	<br /><br /><hr />
	<p>
		<h2>Bienvenue, <?= $_COOKIE['pseudoMemb'] ?> </h2>
	</p>
	<hr class="hr1" />
	<div>
	CRUD :
	<a href="./back/angle/angle.php"><span>angle (*)</span></a>
	<br /><br />
	CRUD :
	<a href="./back/article/article.php"><span>article (*)</span></a>
	<br /><br />
	CRUD :
	<a href="./back/comment/comment.php"><span>commentaire (*)</span></a>
	<br /><br />
	CRUD :
	<a href="./back/commentplus/commentplus.php">Réponse sur commentaire</a>
	<br /><br />
	CRUD :
	<a href="./back/langue/langue.php"><span>Langue (*)</span></a>
	<br /><br />
	CRUD :
	<a href="./back/likeart/likeart.php"><span>Like article (*)</span></a>
	<br /><br />
	CRUD :
	<a href="./back/likecom/likecom.php"><span>Like commentaire (*)</span></a>
	<br /><br />
<!-- Membre (*) - reCaptcha à ajouter -->
	CRUD :
	<a href="./back/membre/membre.php"><span>Membre (*)</span></a>
	<br /><br />
	CRUD :
	<a href="./back/motcle/motcle.php"><span>Mot-clé (*)</span></a>
	<br /><br />
	CRUD :
	<a href="#">Mot-clé article => dans article</a>
	<br /><br />
	CRUD :
	<a href="./back/statut/statut.php"><span>Statut (*)</span></a>
	<br /><br />
	CRUD :
	<a href="./back/thematique/thematique.php"><span>Thématique (*)</span></a>
	<br /><br />
<!-- User (*) - reCaptcha à ajouter -->
	CRUD :
	<a href="./back/user/user.php"><span>User (*)</span></a>
	<br /><br /><hr class="hr1" /><br />
	Barre de recherche :
	<a href="./searchbar/barreF2.php"><span>CONCAT : Un SEUL Mot clé dans articles (*)</span></a>
	<br>(F1 en GET)
	<br /><br />
	Barre de recherche :
	<a href="./searchbar/barreCONCAT.php"><span>CONCAT : Mots clés dans articles & thématiques (*)</span></a>
	<br /><br />
	Barre de recherche :
	<a href="./searchbar/barreJOIN.php"><span>JOIN : Liste des Mots clés par article (*)</span></a>
	<br /><br />
	Barre de recherche :
	<a href="./searchbar/barreLes2.php"><span>Les 2 (CONCAT, JOIN) : Mots clés dans articles, thématiques & liste des Mots clés par article (*)</span></a>
	<br /><br />
	</div>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/footer.php';
?>
</body>
</html>
