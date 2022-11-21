<?php
////////////////////////////////////////////////////////////
//
//  CRUD thematique (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : createthematique.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once $_SERVER['DOCUMENT_ROOT'] . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once $_SERVER['DOCUMENT_ROOT'] . '/../../util/ctrlSaisies.php';

// Insertion classe thematique

// Instanciation de la classe thématique

require_once $_SERVER['DOCUMENT_ROOT'] . '/../../class_crud/thematique.class.php';
// Instanciation de la classe MotCle
$mathematique = new thematique();

require_once $_SERVER['DOCUMENT_ROOT'] . '/../../class_crud/langue.class.php';
// Instanciation de la classe langue

$maLangue = new langue();


// BBCode


// Gestion des erreurs de saisie
$erreur = false;

// Gestion du $_SERVER["REQUEST_METHOD"] => En POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Opérateur ternaire
    // $Submit = isset($_POST['Submit']) ? $_POST['Submit'] : '';

    // La même chose en version if / else pour + de clarté :
    if(isset($_POST['Submit'])){
        $Submit = $_POST['Submit'];
    } else {
        $Submit = "";
    }

    if ((isset($_POST["Submit"])) AND ($Submit === "Initialiser")) {
    
            header("Location: ./createthematique.php");
    }   // End of if ((isset($_POST["submit"])) ...
        
    if (((isset($_POST['libThem'])) AND (!empty($_POST['libThem']))
        AND (!empty($_POST['Submit'])) AND ($Submit === "Valider"))) {
            // Saisies valides
            $erreur = false;
    
            $libThem = ctrlSaisies(($_POST['libThem']));
            $numLang = $_POST['Langue'];
            $numThem = $mathematique->getNextNumThem($numThem);
    
            $mathematique->create($numThem, $libThem, $numLang);
    
            header("Location: ./thematique.php");
        }   // Fin if ((isset($_POST['libStat']))
        else {
            // Saisies invalides
            $erreur = true;
            $errSaisies =  "Erreur, la saisie est obligatoire !";
        }   // End of else erreur saisies

    // insertion effective du statut

    // Gestion des erreurs => msg si saisies ko

}  // Fin if ($_SERVER["REQUEST_METHOD"] == "POST")
// Init variables form
include $_SERVER['DOCUMENT_ROOT'] . '/initthematique.php';
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <title>Admin - CRUD thematique</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../../front/style.css" rel="stylesheet">
</head>
<body>
<?php
		include ROOT . '/front/includes/commons/navigationback.php';
	?>
    <h1>BLOGART22 Admin - CRUD thematique</h1>
    <h2>Ajout d'une thematique</h2>

    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

      <fieldset>
        <legend class="legend1">Formulaire thematique...</legend>

        <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>" />

        <div class="control-group">
            <label class="control-label" for="libThem"><b>Libellé :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="libThem" id="libThem" size="80" maxlength="80" value="<?= $libThem; ?>" placeholder="Titre de la thématique" autocomplete="on" autofocus="autofocus" />
        </div>
        <br>
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- FK : Langue -->
<!-- --------------------------------------------------------------- -->
    <!-- Listbox langue -->
        <br>
        <div class="control-group">
            <label class="control-label" for="LibTypLang"><b>Quelle langue :&nbsp;&nbsp;&nbsp;</b></label>
                <input type="hidden" id="idTypLang" name="idTypLang" value="<?= $numLang; ?>" />

                <!-- Listbox langue => 2ème temps -->
                <select name="Langue" id="Langue"  class="form-control form-control-create">
                <option value="-1">- - - Choisissez une langue - - -</option>
                <?php
                $allLang = $maLangue->get_AllLangues();
                
                if($allLang){
                for ($i=0; $i < count($allLang); $i++){
                    $value = $allLang[$i]['numLang'];
                ?>
                
                <option value="<?php echo($value); ?>"> <?= $allLang[$i]['lib1Lang']; ?> </option>
                
                <?php
                    } // End of foreach
                }   // if ($result)
                ?>
            </select>
        </div>
    <!-- FIN Listbox langue -->
<!-- --------------------------------------------------------------- -->
    <!-- FK : Langue -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
        <div class="control-group">
            <div class="error">
<?php
            if ($erreur) {
                echo ($errSaisies);
            }
            else {
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
        </div>
        </div>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/footer.php';
?>
</body>
</html>


