<?php
////////////////////////////////////////////////////////////
//
//  CRUD article (PDO) - Modifié : 10 Juillet 2021
//
//  Script  : createarticle.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// insert dans TJ motclearticle
// upload image & insert path
//
// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';


// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe article
require_once __DIR__ . '/../../class_crud/article.class.php';

// Instanciation de la classe article
$monarticle = new article();

// Insertion classe angle
require_once __DIR__ . '/../../class_crud/angle.class.php';

// Instanciation de la classe angle
$monangle = new angle();

// Insertion classe Langue
require_once __DIR__ . '/../../class_crud/langue.class.php';

// Instanciation de la classe langue
$maLangue = new langue();

require_once __DIR__ . '/../../class_crud/thematique.class.php';
// Instanciation de la classe MotCle
$mathematique = new thematique();



// Gestion des erreurs de saisie
$erreur = false;

// Gestion du $_SERVER["REQUEST_METHOD"] => En POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $id = $_POST['id'];

    if(isset($_POST['Submit'])){
        $Submit = $_POST['Submit'];
    } else {
        $Submit = "";
    }
    // ON VEUT REINITIALISER LA VALEUR

    if($_POST['Submit'] == 'Initialiser'){ 
        header("Location: updateangle.php?id=$numAngl");
        $_POST['$libelle']; // jsp ce que c'est donc maybe à changer
    }


    // ON VEUT VALIDER LA MODIFICATION

    if ((isset($_POST["Submit"])) AND ($Submit === "Initialiser")) {
    
        header("Location: ./createarticle.php");
    }   // End of if ((isset($_POST["submit"])) ...
    
    if (((isset($_POST['libTitrArt'])) AND !empty($_POST['libTitrArt'])) 
            AND ((isset($_POST['libChapoArt'])) AND !empty($_POST['libChapoArt'])) AND ((isset($_POST['libAccrochArt'])) 
            AND !empty($_POST['libAccrochArt'])) AND ((isset($_POST['parag1Art'])) AND !empty($_POST['parag1Art'])) 
            AND ((isset($_POST['libSsTitr1Art'])) AND !empty($_POST['libSsTitr1Art'])) AND ((isset($_POST['parag2Art'])) 
            AND !empty($_POST['parag2Art'])) AND ((isset($_POST['libSsTitr2Art'])) AND !empty($_POST['libSsTitr2Art'])) 
            AND ((isset($_POST['parag3Art'])) AND !empty($_POST['parag3Art'])) AND ((isset($_POST['libConclArt'])) 
            AND !empty($_POST['libConclArt'])) AND  (!empty($_POST['Submit']) AND ($Submit === "Valider"))){
            // Saisies valides
            $erreur = false;
 
            $libTitrArt = ctrlSaisies(($_POST['libTitrArt']));
            $libAccrochArt = ctrlSaisies(($_POST['libAccrochArt']));
            $dtCreArt = ctrlSaisies(($_POST['dtCreArt']));
            $libChapoArt = ctrlSaisies(($_POST['libChapoArt']));
            $parag1Art = ctrlSaisies(($_POST['parag1Art']));
            $libSsTitr1Art = ctrlSaisies(($_POST['libSsTitr1Art']));
            $libSsTitr2Art = ctrlSaisies(($_POST['libSsTitr2Art']));
            $parag2Art = ctrlSaisies(($_POST['parag2Art']));
            $parag3Art = ctrlSaisies(($_POST['parag3Art']));
            $libConclArt = ctrlSaisies(($_POST['libConclArt']));
            
            $langue = ctrlSaisies($_POST['Langue']);

            $monfichier = ctrlSaisies($_FILES['nomImage']);
            $numAngl = ctrlSaisies($_POST['angle']);
            $numThem = ctrlSaisies($_POST['thematique']);

            require_once './ctrlerUploadImage.php';
            $monarticle->create($libTitrArt, $libChapoArt, $libAccrochArt, $parag1Art, $libSsTitr1Art, $parag2Art, $libSsTitr2Art, $parag3Art, $libConclArt, $nomImage, $numAngl, $numThem);

            header("Location: ./article.php");
        }   // Fin if ((isset($_POST['']))
        else {
            // Saisies invalides
            $erreur = true;
            $errSaisies =  "Erreur, la saisie est obligatoire !";
        }   

    // Gestion des erreurs => msg si saisies ko



    // Traitnemnt : upload image => Nom image à la volée


}   // Fin if ($_SERVER["REQUEST_METHOD"] == "POST")
// Init variables form
include __DIR__ . '/initarticle.php';

?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />    
    <title>Admin - CRUD article</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../../front/style.css" rel="stylesheet">
    <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</head>
<body>
    <?php
		include __DIR__ . '../../../front/includes/commons/navigationback.php';
	?>
    <h1>BLOGART22 Admin - CRUD article</h1>
    <h2>Ajout d'un article</h2>

    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8" id="chgLang">

      <fieldset>
        <legend class="legend1">Formulaire article...</legend>

        <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>" />

        <div class="control-group">
            <label class="control-label" for="libTitrArt"><b>Titre :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <input type="text" name="libTitrArt" id="libTitrArt" size="100" maxlength="100" value="<?php if(isset($_GET['id'])) echo $_POST['libTitrArt']; ?>" tabindex="10" placeholder="Sur 100 car." autofocus="autofocus" />
            </div>
        </div>
        <br>
        <div class="control-group">
            <div class="controls">
            <label class="control-label" for="DtCreA"><b>Date de création :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
                <input type="datetime-local" name="dtCreArt" id="dtCreArt" value="<?php if(isset($_GET['id'])) echo $_POST['dtCreArt']; ?>" tabindex="20" placeholder="" />
            </div>
        </div>
        <br>
        <div class="control-group">
            <label class="control-label" for="libChapoArt"><b>Chapeau :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <textarea name="libChapoArt" id="libChapoArt" rows="10" cols="100" value="<?php if(isset($_GET['id'])) echo $_POST['libChapoArt']; else echo $libChapoArt; ?>" tabindex="30" placeholder="Décrivez le chapeau. Sur 500 car." ></textarea>
            </div>
        </div>
        <br>
        <div class="control-group">
            <label class="control-label" for="libAccrochArt"><b>Accroche paragraphe 1 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <input type="text" name="libAccrochArt" id="libAccrochArt" size="100" maxlength="100" value="<?php if(isset($_GET['id'])) echo $_POST['libAccrochArt']; else echo $libAccrochArt; ?>" tabindex="40" placeholder="Sur 100 car." />
            </div>
        </div>
        <br>
        <div class="control-group">
            <label class="control-label" for="parag1Art"><b>Paragraphe 1 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <textarea name="parag1Art" id="parag1Art" rows="10" cols="100" value="<?php if(isset($_GET['id'])) echo $_POST['parag1Art']; else echo $parag1Art; ?>" tabindex="50" placeholder="Décrivez le premier paragraphe. Sur 1200 car." ></textarea>
            </div>
        </div>
        <br>
        <div class="control-group">
            <label class="control-label" for="libSsTitr1Art"><b>Sous-titre 1 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <input type="text" name="libSsTitr1Art" id="libSsTitr1Art" size="100" maxlength="100" value="<?php if(isset($_GET['id'])) echo $_POST['libSsTitr1Art']; else echo $libSsTitr1Art; ?>" tabindex="60" placeholder="Sur 100 car." />
            </div>
        </div>
        <br>
        <div class="control-group">
            <label class="control-label" for="parag2Art"><b>Paragraphe 2 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <textarea name="parag2Art" id="parag2Art" rows="10" cols="100" value="<?php if(isset($_GET['id'])) echo $_POST['parag2Art']; else echo $parag2Art; ?>" tabindex="70" placeholder="Décrivez le deuxième paragraphe. Sur 1200 car." ></textarea>
            </div>
        </div>
        <br>
        <div class="control-group">
            <label class="control-label" for="libSsTitr2Art"><b>Sous-titre 2 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <input type="text" name="libSsTitr2Art" id="libSsTitr2Art" size="100" maxlength="100" value="<?php if(isset($_GET['id'])) echo $_POST['libSsTitr2Art']; else echo $libSsTitr2Art; ?>" tabindex="80" placeholder="Sur 100 car." />
            </div>
        </div>
        <br>
        <div class="control-group">
            <label class="control-label" for="parag3Art"><b>Paragraphe 3 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <textarea name="parag3Art" id="parag3Art" rows="10" cols="100" value="<?php if(isset($_GET['id'])) echo $_POST['parag3Art']; else echo $parag3Art; ?>" tabindex="90" placeholder="Décrivez le troisième paragraphe. Sur 1200 car." ></textarea>
            </div>
        </div>
        <br>
        <div class="control-group">
            <label class="control-label" for="libConclArt"><b>Conclusion :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <textarea name="libConclArt" id="libConclArt" rows="10" cols="100" value="<?php if(isset($_GET['id'])) echo $_POST['libConclArt']; else echo $libConclArt; ?>" tabindex="100" placeholder="Décrivez la conclusion. Sur 800 car." ></textarea>
            </div>
        </div>
        <br>
        
        <div class="control-group">
            <label for="monficher" class="control-label">Ajouter une illustration</label>
            <div class="control">
                <input type="file" name="monfichier" id="monficher" accept=".jpg,.gif,.png,.jpeg" value="">
            </div>
        </div>

<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    
    <!-- Listbox Langue -->
        <br>
        <div class="control-group">
            <div class="controls">
                <label class="control-label" for="LibTypLang">
                    <b>Quelle langue :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
                </label>


                <!-- Listbox langue => 2ème temps -->

                <select name="Langue" id="Langue"  class="form-control form-control-create" onchange="change()">
                <option value="-1">- - - Choisissez une langue - - -</option>
                <?php
                $allLangueangle = $monangle->get_AllLangues();
                
                if($allLangueangle){
                for ($i=0; $i < count($allLangueangle); $i++){
                    $value = $allLangueangle[$i]['numLang'];
                ?>
                
                <option value="<?php echo($value); ?>"> <?=$allLangueangle[$i]['lib2Lang']; ?> </option>
                
                <?php
                    } // End of foreach
                }   // if ($result)
                ?>
            </select>
  

            </div>
        </div>
    <!-- FIN Listbox Langue -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->

<!-- --------------------------------------------------------------- -->
    <!-- FK : angle, Thématique + TJ Mots Clés -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- Listbox angle live share -->
        <br>
        <div class="control-group">
            <div class="controls">
                <label class="control-label" for="LibTypAngl">
                    <b>Quel angle :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
                </label>

                <!-- Listbox angle => 2ème temps -->

                <select name="angle" id="angle"  class="form-control form-control-create">
                <option value='-1'>- - - Aucun - - -</option>
                </select>

            </div>
        </div>
    <!-- FIN Listbox angle -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- Listbox Thématique -->
    <!-- Grp 7 -->
        <br>
        <div class="control-group">
            <div class="controls">
                <label class="control-label" for="LibTypThem">
                    <b>Quelle thématique :&nbsp;&nbsp;&nbsp;</b>
                </label>


                <!-- Listbox thematique => 2ème temps -->

                <select name="thematique" id="thematique"  class="form-control form-control-create">
                <option value='-1'>- - - Aucune - - -</option>
                </select>

            </div>
        </div>
    <!-- FIN Listbox Thématique -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->

<!-- --------------------------------------------------------------- -->
<!-- Drag and drop sur Mots clés -->
<!-- --------------------------------------------------------------- -->
   

<!-- 
    <br><br>
    <div class="controls">
        <label class="control-label" for="LibTypMotsCles1">
            <b>Choisissez les mots clés liés à l'article :&nbsp;&nbsp;&nbsp;</b>
        </label>
    </div> -->
    <!-- A faire dans un 2/3ème temps  -->

<!-- --------------------------------------------------------------- -->
<!-- End of Drag and drop sur Mots clés -->
<!-- --------------------------------------------------------------- -->

<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- Fin FK : angle, Thématique + TJ Mots Clés -->
<!-- --------------------------------------------------------------- -->

        <div class="control-group">
            <div class="error">
<?php
            if ($erreur) {
                echo ($errSaisies);
            } else {
                $errSaisies = "";
                echo ($errSaisies);
            }
?>
            </div>
        </div>

        <div class="control-group">
            <div class="controls">
                <br><br>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" value="Initialiser" style="cursor:pointer; padding:5px 20px; background-color:lightsteelblue; border:dotted 2px grey; border-radius:5px;" name="Submit" />
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" value="Valider" style="cursor:pointer; padding:5px 20px; background-color:lightsteelblue; border:dotted 2px grey; border-radius:5px;" name="Submit" />
                <br>
            </div>
        </div>
      </fieldset>
    </form>

<!-- --------------------------------------------------------------- -->
    <!-- Début Ajax : Langue => angle, Thématique + TJ Mots Clés -->
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
			xhr.onreadystatechange = function() {
				// test si tout est reçu et si serveur est ok
				if(xhr.readyState == 4 && xhr.status == 200){
					di = document.getElementById('angle');
					di.innerHTML = xhr.responseText;
				}
			}
            xhr2.onreadystatechange = function(){
                if(xhr.readyState == 4 && xhr.status == 200){
                    di2 = document.getElementById('thematique');
                    di2.innerHTML = xhr2.responseText;
                }
            }

			// Traitement en POST
			xhr.open("POST","<?=ROOTFRONT?>/back/article/ajaxAngle.php",true);
			// pour le post
			xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
			// poster arguments : ici, numClas
			numLang = document.getElementById('Langue').options[document.getElementById('Langue').selectedIndex].value;
			// Recup numClas à classe (PK) à passer en "m" à etudiant (FK)
			xhr.send("numLang="+numLang);

            // Traitement en POST
			xhr2.open("POST","<?=ROOTFRONT?>/back/article/ajaxThematique.php",true);
			// pour le post
			xhr2.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
			// poster arguments : ici, numClas
			numThem = document.getElementById('Langue').options[document.getElementById('Langue').selectedIndex].value;
			// Recup numClas à classe (PK) à passer en "m" à etudiant (FK)
			xhr2.send("numThem="+numThem);
		}	// End of function
  </script>

<!-- --------------------------------------------------------------- -->
    <!-- Fin Ajax : Langue => angle, Thématique + TJ Mots Clés -->
<!-- --------------------------------------------------------------- -->
    </div>
    </div>
<?php
require_once ROOT . '/footer.php';
?>
</body>
</html>
