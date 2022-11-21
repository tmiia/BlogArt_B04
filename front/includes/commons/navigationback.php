<div id="main_administration">

		<div class="admin_liens">
			<a class="accueil" href="<?=$_SERVER['DOCUMENT_ROOT']?>/panneauAdmin.php">Accueil</a>
			<span>Gestion des articles</span>
			<ul>
				<li><a href="<?=$_SERVER['DOCUMENT_ROOT']?>/back/article/article.php">Liste des articles</a></li>
				<li><a href="<?=$_SERVER['DOCUMENT_ROOT']?>/back/article/createArticle.php">Créer un article</a></li>
			</ul>
			<span>Gestion des utilisateurs</span>
			<ul>
				<li><a href="<?=$_SERVER['DOCUMENT_ROOT']?>/back/statut/statut.php">Liste des statuts</a></li>
				<li><a href="<?=$_SERVER['DOCUMENT_ROOT']?>/back/membre/membre.php">Liste des membres</a></li>
			</ul>
			<span>Gestion des Langues</span>
			<ul>
				<li><a href="<?=$_SERVER['DOCUMENT_ROOT']?>/back/langue/langue.php">Liste des langues</a></li>
				<li><a href="<?=$_SERVER['DOCUMENT_ROOT']?>/back/langue/createLangue.php">Ajouter une langue</a></li>
			</ul>
			<span>Gestion des Thèmes</span>
			<ul>
				<li><a href="<?=$_SERVER['DOCUMENT_ROOT']?>/back/thematique/thematique.php">Liste des thématiques</a></li>
				<li><a href="<?=$_SERVER['DOCUMENT_ROOT']?>/back/angle/angle.php">Liste des angles</a></li>
				<li><a href="<?=$_SERVER['DOCUMENT_ROOT']?>/back/motCle/motCle.php">Liste des mots-clef</a></li>
			</ul>
			<span>Gestion des likes</span>
			<ul>
				<li><a href="<?=$_SERVER['DOCUMENT_ROOT']?>/back/likeArt/likeArt.php">Liste des likes d'articles</a></li>
				<li><a href="<?=$_SERVER['DOCUMENT_ROOT']?>/back/likeCom/likeCom.php">Liste des likes de commentaire</a></li>
			</ul>
		</div>

        <div class="admin_body">