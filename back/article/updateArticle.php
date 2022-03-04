<?php
////////////////////////////////////////////////////////////
//
//  CRUD ARTICLE (PDO) - Modifié : 10 Juillet 2021
//
//  Script  : updateArticle.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// => del + insert dans TJ motclearticle
// => upload image & update path si modif
//
// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

require_once __DIR__ . '/../../util/preparerTags.php';

// Init constantes
include __DIR__ . '/initConst.php';
// Init variables
include __DIR__ . '/initVar.php';

// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';
// Mise en forme date
require_once __DIR__ . '/../../util/dateChangeFormat.php';

// Insertion classe Article
require_once __DIR__ . '/../../CLASS_CRUD/article.class.php';

// Instanciation de la classe Article
$monArticle = new ARTICLE();

// Insertion classe MotCleArticle
require_once __DIR__ . '/../../CLASS_CRUD/motclearticle.class.php';

// Instanciation de la classe MotCleArticle
$monMotCleArticle = new MOTCLEARTICLE();

// Insertion classe MotCle
require_once __DIR__ . '/../../CLASS_CRUD/motcle.class.php';

// Instanciation de la classe MotCle
$monMotCle = new MOTCLE();

// Insertion classe Langue
require_once __DIR__ . '/../../CLASS_CRUD/langue.class.php';

// Instanciation de la classe langue
$maLangue = new LANGUE();

// Insertion classe Angle
require_once __DIR__ . '/../../CLASS_CRUD/angle.class.php';

// Instanciation de la classe angle
$monAngle = new ANGLE();

// Insertion classe them
require_once __DIR__ . '/../../CLASS_CRUD/thematique.class.php';

// Instanciation de la classe angle
$maThematique = new THEMATIQUE();


// Gestion des erreurs de saisie
$erreur = false;
// dossier images
$targetDir = TARGET;

// init mots cles
// Gestion du $_SERVER["REQUEST_METHOD"] => En POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $numArt = $_POST['id'];

    if(isset($_POST['Submit'])){
        $Submit = $_POST['Submit'];

    } else {
        $Submit = "";
    }
    // ON VEUT REINITIALISER LA VALEUR

    if($_POST['Submit'] == 'Initialiser'){ 
        header("Location: updateArticle.php?id=$numArt");
        $_POST['$libelle']; // jsp ce que c'est donc maybe à changer
    }


    // ON VEUT VALIDER LA MODIFICATION

    if ((isset($_POST["Submit"])) AND ($Submit === "Valider")) {
    
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
            $libChapoArt = ctrlSaisies(($_POST['libChapoArt']));
            $parag1Art = ctrlSaisies(($_POST['parag1Art']));
            $libSsTitr1Art = ctrlSaisies(($_POST['libSsTitr1Art']));
            $libSsTitr2Art = ctrlSaisies(($_POST['libSsTitr2Art']));
            $parag2Art = ctrlSaisies(($_POST['parag2Art']));
            $parag3Art = ctrlSaisies(($_POST['parag3Art']));
            $libConclArt = ctrlSaisies(($_POST['libConclArt']));
            
            // $langue = ctrlSaisies($_POST['Langue']);
            $monfichier = ctrlSaisies(($_POST['monfichier']));
            $numAngl = ctrlSaisies(($_POST['angle']));
            $numThem = ctrlSaisies(($_POST['thematique']));

           

            require_once './ctrlerUploadImage.php';
    
            $monArticle->update($numArt, $libTitrArt, $libChapoArt, $libAccrochArt, $parag1Art, $libSsTitr1Art, $parag2Art, $libSsTitr2Art, $parag3Art, $libConclArt, $nomImage, $numAngl, $numThem);
    
            header("Location: ./article.php");
        }   // Fin if ((isset($_POST['']))
        else {
            // Saisies invalides
            $erreur = true;
            $errSaisies =  "Erreur, la saisie est obligatoire !";
        }   
    }   // End of if ((isset($_POST["submit"])) ...
    

    // Gestion des erreurs => msg si saisies ko



    // Traitnemnt : upload image => Nom image à la volée

}   // Fin if ($_SERVER["REQUEST_METHOD"] === "POST")
// Init variables form
include __DIR__ . '/initArticle.php';
// En dur
// $urlPhotArt = "../uploads/imgArt2dd0b196b8b4e0afb45a748c3eba54ea.png";
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <title>Admin - CRUD Article</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../css/style.css" rel="stylesheet" type="text/css" />
<!--     <script src="./script_global.js"></script> -->
    <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</head>
<body>
    <h1>BLOGART22 Admin - CRUD Article</h1>
    <h2>Modification d'un article</h2>
<?php


    // Modif : récup id à modifier

    if (isset($_GET['id']) and $_GET['id'] != '') {

        $id = ctrlSaisies(($_GET['id']));

        $query = (array)$monArticle->get_1Article($id);

        if ($query) {
            $numArt = $query['numArt'];
            $libTitrArt = $query['libTitrArt'];
            $dtCreArt = $query['dtCreArt'];
            $libChapoArt = $query['libChapoArt'];
            $libAccrochArt = $query['libAccrochArt'];
            $parag1Art = $query['parag1Art'];
            $libSsTitr1Art = $query['libSsTitr1Art'];
            $libSsTitr2Art = $query['libSsTitr2Art'];
            $parag2Art = $query['parag2Art'];
            $parag3Art = $query['parag3Art'];
            $libConclArt = $query['libConclArt'];
            $urlPhotArt = $query['urlPhotArt'];
            $numAngl = $query['numAngl'];
            $numThem = $query['numThem'];
        } 
        
       }


    // id passé en GET






?>
    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8" id="chgLang">

      <fieldset>
        <legend class="legend1">Formulaire Article...</legend>

        <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>" />

        <div class="control-group">
            <label class="control-label" for="libTitrArt"><b>Titre :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <input type="text" name="libTitrArt" id="libTitrArt" size="100" maxlength="100" value="<?= $libTitrArt; ?>" tabindex="10" placeholder="Sur 100 car." autofocus="autofocus" />
            </div>
        </div>

        <br>
        <div class="control-group">
            <div class="controls">
            <label class="control-label" for="DtCreA"><b>Date de création :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="dtCreArt" id="dtCreArt" value="<?= $dtCreArt; ?>" tabindex="20" placeholder="" disabled />
            </div>
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="libChapoArt"><b>Chapeau :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <textarea name="libChapoArt" id="libChapoArt" rows="10" cols="100" tabindex="30" placeholder="Décrivez le chapeau. Sur 500 car." ><?= $libChapoArt; ?></textarea>
            </div>
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="libAccrochArt"><b>Accroche paragraphe 1 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <input type="text" name="libAccrochArt" id="libAccrochArt" size="100" maxlength="100" value="<?= $libAccrochArt; ?>" tabindex="40" placeholder="Sur 100 car." />
            </div>
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="parag1Art"><b>Paragraphe 1 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <textarea name="parag1Art" id="parag1Art" rows="10" cols="100" tabindex="50" placeholder="Décrivez le premier paragraphe. Sur 1200 car." ><?= $parag1Art; ?></textarea>
            </div>
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="libSsTitr1Art"><b>Sous-titre 1 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <input type="text" name="libSsTitr1Art" id="libSsTitr1Art" size="100" maxlength="100" value="<?= $libSsTitr1Art; ?>" tabindex="60" placeholder="Sur 100 car." />
            </div>
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="parag2Art"><b>Paragraphe 2 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <textarea name="parag2Art" id="parag2Art" rows="10" cols="100" tabindex="70" placeholder="Décrivez le deuxième paragraphe. Sur 1200 car." ><?= $parag2Art; ?></textarea>
            </div>
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="libSsTitr2Art"><b>Sous-titre 2 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <input type="text" name="libSsTitr2Art" id="libSsTitr2Art" size="100" maxlength="100" value="<?= $libSsTitr2Art; ?>" tabindex="80" placeholder="Sur 100 car." />
            </div>
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="parag3Art"><b>Paragraphe 3 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <textarea name="parag3Art" id="parag3Art" rows="10" cols="100" tabindex="90" placeholder="Décrivez le troisième paragraphe. Sur 1200 car." ><?= $parag3Art; ?></textarea>
            </div>
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="libConclArt"><b>Conclusion :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <textarea name="libConclArt" id="libConclArt" rows="10" cols="100" tabindex="100" placeholder="Décrivez la conclusion. Sur 800 car." ><?= $libConclArt; ?></textarea>
            </div>
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="urlPhotArt"><b>Importez l'illustration :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <input type="hidden" name="MAX_FILE_SIZE" id="MAX_FILE_SIZE" value="<?= MAX_SIZE; ?>" />
                <input type="file" name="monfichier" id="monfichier" accept=".jpg,.gif,.png,.jpeg" size="70" maxlength="70" value="<?= $urlPhotArt; ?>" tabindex="110" placeholder="Sur 70 car." title="Recherchez l'image à uploader !" />
                <p>
<?php              // Gestion extension images acceptées
                  $msgImagesOK = "&nbsp;&nbsp;>> Extension des images acceptées : .jpg, .gif, .png, .jpeg" . "<br>" .
                    "(lageur, hauteur, taille max : 80000px, 80000px, 200 000 Go)";
                  echo "<i>" . $msgImagesOK . "</i>";
?>
                </p>
                <p><b><i>Image actuelle :&nbsp;&nbsp;<img src="<?= $targetDir . htmlspecialchars($urlPhotArt); ?>" height="183" width="275" /></i></b></p>

            </div>
        </div>
        <br>
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
                        <option value="-1"><?= $maLangue -> get_1LangueByThemArticle($numArt)['lib1Lang'] ?></option>
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
    <!-- FIN Listbox Langue -->
<!-- --------------------------------------------------------------- -->

<!-- --------------------------------------------------------------- -->
    <!-- FK : Angle, Thématique + TJ Mots Clés -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- Listbox Angle live share -->
        <br>
        <div class="control-group">
            <div class="controls">
                <label class="control-label" for="LibTypAngl">
                    <b>Quel angle :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
                </label>

                <!-- Listbox angle => 2ème temps -->

                <select name="angle" id="angle"  class="form-control form-control-create">
                    <option value='-1'><?= $monAngle -> get_1Angle($numAngl)['libAngl'] ?></option>
                </select>

            </div>
        </div>
    <!-- FIN Listbox Angle -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- Listbox Thématique -->
        <br>
        <div class="control-group">
            <div class="controls">
                <label class="control-label" for="LibTypThem">
                    <b>Quelle thématique :&nbsp;&nbsp;&nbsp;</b>
                </label>

                <select name="thematique" id="thematique"  class="form-control form-control-create">
                    <option value='-1'><?=$maThematique->get_1Thematique($numThem)['libThem']; ?></option>
                </select>
                <!-- Listbox thematique => 2ème temps -->

            </div>
        </div>
    <!-- FIN Listbox Thématique -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- Drag and drop Mot Clé -->
<!-- --------------------------------------------------------------- -->

    <br><br>

    <div class="controls">
        <label class="control-label" for="LibTypMotsCles1">
            <b>Choisissez les mots clés liés à l'article :&nbsp;&nbsp;&nbsp;</b>
        </label>
    </div>
    <!-- A faire dans un 2/3ème temps  -->

<!-- --------------------------------------------------------------- -->
    <!-- FIN Drag and drop Mot Clé -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- Fin FK : Angle, Thématique + TJ Mots Clés -->
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
			xhr.onreadystatechange = function() {
				// test si tout est reçu et si serveur est ok
				if(xhr.readyState == 4 && xhr.status == 200){
					di = document.getElementById('angle');
					di.innerHTML = xhr.responseText;
				}
                if(xhr.readyState == 4 && xhr.status == 200){
                    di2 = document.getElementById('thematique');
                    di2.innerHTML = xhr2.responseText;
                }
			}

			// Traitement en POST
			xhr.open("POST","./ajaxAngle.php",true);
			// pour le post
			xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
			// poster arguments : ici, numClas
			numLang = document.getElementById('Langue').options[document.getElementById('Langue').selectedIndex].value;
			// Recup numClas à classe (PK) à passer en "m" à etudiant (FK)
			xhr.send("numLang="+numLang);

            // Traitement en POST
			xhr2.open("POST","./ajaxThematique.php",true);
			// pour le post
			xhr2.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
			// poster arguments : ici, numClas
			numThem = document.getElementById('Langue').options[document.getElementById('Langue').selectedIndex].value;
			// Recup numClas à classe (PK) à passer en "m" à etudiant (FK)
			xhr2.send("numThem="+numThem);
		}	// End of function
  </script>

<!-- --------------------------------------------------------------- -->
    <!-- Fin Ajax : Langue => Angle, Thématique + TJ Mots Clés -->
<!-- --------------------------------------------------------------- -->

<?php
require_once __DIR__ . '/footerArticle.php';

require_once __DIR__ . '/footer.php';
?>
</body>
</html>
