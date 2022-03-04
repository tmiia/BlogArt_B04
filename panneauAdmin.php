<?php
////////////////////////////////////////////////////////////
//
//  Gestion des CRUD (PDO) - Modifié : 14 Juillet 2021
//
//  Script  : index1.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV

require_once __DIR__ . '/connect/config.php';  
require_once __DIR__ . '/util/utilErrOn.php';
require_once __DIR__ . '/front/includes/commons/imports.php';

	if(isset($_COOKIE['pseudoUser'])){
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <title>Gestion des CRUD</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />
	<link href="./front/style.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"></script>
</head>
<body>

	<div id="main_administration">

		<div class="admin_liens">
			<a class="accueil" href="/panneauAdmin.pnp">Accueil</a>
			<span>Gestion des articles</span>
			<ul>
				<li><a href="./back/article/article.php">Liste des articles</a></li>
				<li><a href="./back/article/createarticle.php">Créer un article</a></li>
			</ul>
			<span>Gestion des utilisateurs</span>
			<ul>
				<li><a href="./back/article/article.php">Liste des statuts</a></li>
				<li><a href="./back/membre/membre.php">Liste des membres</a></li>
				<li><a href="#">Gérer membre</a></li>
			</ul>
			<span>Gestion des Langues</span>
			<ul>
				<li><a href="./back/article/article.php">Gestion des langues</a></li>
				<li><a href="./back/langue/langue.php">Liste des langues</a></li>
				<li><a href="./back/langue//createLangue.php">Ajouter une langue</a></li>
			</ul>
			<span>Gestion des Thèmes</span>
			<ul>
				<li><a href="./back/article/article.php">Gestion des thèmes</a></li>
				<li><a href="./back/thematique/thematique.php">Liste des thématiques</a></li>
				<li><a href="./back/angle/angle.php">Liste des angles</a></li>
				<li><a href="./back/motcle/motcle.php">Liste des mots-clef</a></li>
			</ul>
			<span>Gestion des articles</span>
			<ul>
				<li><a href="./back/article/article.php">Liste des articles</a></li>
				<li><a href="./back/article/createarticle.php">Créer un article</a></li>
			</ul>
		</div>

		<div class="admin_body">
			<h1>Bienvenue sur votre panneau d'administration,</h1>
			<h2><?= $_COOKIE['pseudoUser'] ?></h2>
		</div>
</div>
<?php
require_once __DIR__ . '/front/includes/commons/footerback.php';
?>
</body>
</html>
<?php 
	}else{
		header('Location: ' . ROOTFRONT . '/front/home.php');
	}
?>