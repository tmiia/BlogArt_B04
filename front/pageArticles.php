<?php
ini_set('display_errors','on');
ini_set('display_startup_errors','on');
error_reporting(E_ALL);
// Mode DEV
require_once '../connect/config.php';
require_once ROOT . '/util/utilErrOn.php';


// controle des saisies du formulaire
require_once ROOT . '/util/ctrlSaisies.php';

// Insertion classe Angle
require_once ROOT . '/class_crud/angle.class.php';

// Instanciation de la classe angle
$monAngle = new angle();

// Insertion classe Langue
require_once ROOT . '/class_crud/langue.class.php';

// // Instanciation de la classe langue
$maLangue = new langue();

require_once ROOT . '/class_crud/thematique.class.php';
// Instanciation de la classe MotCle
$maThematique = new thematique();
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php
    require_once ROOT . '/front/includes/commons/imports.php';


    ?>
    
    
</head>

<body>
<!-- HEADER -->
    <?php
        require_once ROOT . '/front/includes/commons/headerFront.php';
    ?>
<!------------>
<div id="main_page_articles">

    <div class="search">

    <a href="" class="search_butt">
    <span class="bar_search">Rechercher<img class="svg_search" src="<?=ROOTFRONT?>/front/assets/magnifying-glass-solid.jpg" alt=""></span>
    </a>

    </div>

    <!------------>
    
    <div class="tri_article">
        <div>
            <label>Trier par Langue :</label>
            <div class="theme_select_container" for="theme_select">
                <select name="Langue" id="Langue"  class="form-control form-control-create" onchange="change()">
                    <option value="-1">- - - Choisissez une langue - - -</option>
                        <?php
                            $allLangueAngle = $monAngle->get_AllLangues();

                            
                            if($allLangueAngle){
                                for ($i=0; $i < count($allLangueAngle); $i++){
                                    $value = $allLangueAngle[$i]['numLang'];
                        ?>
                            
                    <option value="<?php echo($value); ?>"> <?= $allLangueAngle[$i]['lib2Lang']; ?> </option>
                            
                    <?php
                        } // End of foreach
                        
                    }   // if ($result)
                    ?>
                </select>
            </div>
        </div>

        <div>

            <label>Trier par thématique :</label>
            
            <div class="theme_select_container" for="theme_select">
                <select name="thematique2" id="thematique2"  class="form-control form-control-create" onchange="change()">
                    <option style="text-align:center;" value='-1'>- - - Choisissez une thématique - - -</option>
                </select>
            </div>
        </div>
        
        <div>

            <label>Trier par date :</label>
                <div class="theme_select_container" for="date_select">
                        <select class="date_select" name="date" id="date_select">
                            
                            <option value="Croissant">Ordre croissant</option>
                            <option value="Décroissant">Ordre décroissant</option>
                        </select>
                </div>

                
        </div>

    </div>

    <!-- --------------------------------------------------------------- -->
    <!-- Début Ajax : Langue => Angle, Thématique + TJ Mots Clés -->
<!-- --------------------------------------------------------------- -->

    <!-- A faire dans un 3ème temps  -->

     <!-- Script JS/AJAX -->
  <script type='text/javascript'>
		function getXhr() {
      		var xhr = null;
			if(window.XMLHttpRequest){ // Firefox & autres
			   xhr = new XMLHttpRequest();
			}else
				if(window.ActiveXObject){ // IE / Edge
				   try {
						xhr = new ActiveXObject("Msxml2.XMLHTTP");
				   }catch(e){
						xhr = new ActiveXObject("Microsoft.XMLHTTP");
				   }
				}else{
				   alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest...");
				   xhr = false;
				}
        	return xhr;
		}	// End of function

		/**
		* Méthode appelée sur le click du bouton/listbox
		*/
		function change() {
			var xhr = getXhr();
            var xhr2 =getXhr();
			// On définit quoi faire quand réponse reçue
			xhr2.onreadystatechange = function() {
				// test si tout est reçu et si serveur est ok
                if(xhr2.readyState == 4 && xhr2.status == 200){
                    di2 = document.getElementById('thematique2');
                    di2.innerHTML = xhr2.responseText;
                }

			}
            xhr.onreadystatechange = function() {
				// test si tout est reçu et si serveur est ok
                if(xhr.readyState == 4 && xhr.status == 200){

                    di3 = document.getElementById('articles_list');
                    di3.innerHTML = xhr.responseText;
                }

			}
            // Traitement en POST
			xhr2.open("POST","<?=ROOTFRONT?>/front/includes/commons/ajaxThematiqueArticles.php",true);
			// pour le post
			xhr2.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
			// poster arguments : ici, numClas
			numThem2 = document.getElementById('Langue').options[document.getElementById('Langue').selectedIndex].value;
			// Recup numClas à classe (PK) à passer en "m" à etudiant (FK)
			xhr2.send("numThem2="+numThem2);

            // Traitement en POST
			xhr.open("POST","<?=ROOTFRONT?>/front/includes/commons/ajaxTriArticles.php",true);
			// pour le post
			xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
			// poster arguments : ici, numClas
            numThem = document.getElementById('thematique2')
            console.log(numThem);
			numThem = document.getElementById('thematique2').options[document.getElementById('thematique2').selectedIndex].value;
            console.log(numThem);
			// Recup numClas à classe (PK) à passer en "m" à etudiant (FK)
			xhr.send("numThem="+numThem);

		}	// End of function


  </script>

<!-- --------------------------------------------------------------- -->
    <!-- Fin Ajax : Langue => Angle, Thématique + TJ Mots Clés -->
<!-- --------------------------------------------------------------- -->



    <!------------>
    <div id="articles_list" class="articles">

            <?php
                require_once ROOT . '/class_crud/article.class.php';
                $monarticle = new article();

                $allarticle = $monarticle->get_Allarticles();

                for($i = 0; $i <count($allarticle); $i++){ ?>

                    <a class="article_recent" href="viewArticle.php?id=<?=$allarticle[$i]['numArt']?>">
                    <div class="article_illustration" style="background-image: url(<?=ROOTFRONT?>/uploads/<?=htmlspecialchars($allarticle[$i]['urlPhotArt']) ?>);"></div>
                    <div class="article_recent_top">
                        <h5><?= $allarticle[$i]['libTitrArt'] ?></h5>
                        <p><?= $allarticle[$i]['libChapoArt'] ?></p>
                    </div>
                    <div class="article_recent_bot">
                        <div class="article_like"><i class="fa fa-heart"></i></div>
                        <div class="article_btn">Consulter l'article</div>
                    </div>
                    </a>
                <?php 
                }
    ?>

    </div>


<!------------>
</div>

<!-- FOOTER -->
    <?php
    require_once ROOT . '/front/includes/commons/footerFront.php';
    ?>
<!---------- -->

</body>


</html>