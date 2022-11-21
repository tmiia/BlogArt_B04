<?php
////////////////////////////////////////////////////////////
//
//  CRUD angle (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : createangle.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once $_SERVER['DOCUMENT_ROOT'] . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once $_SERVER['DOCUMENT_ROOT'] . '/../../util/ctrlSaisies.php';

// Insertion classe angle
require_once $_SERVER['DOCUMENT_ROOT'] . '/../../class_crud/angle.class.php';

// Instanciation de la classe angle
$monangle = new angle();


// Gestion des erreurs de saisie
$erreur = false;

// Gestion du $_SERVER["REQUEST_METHOD"] => En POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $idAng = $_POST['id'];

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
    
        header("Location: ./createangle.php");
    }   // End of if ((isset($_POST["submit"])) ...
    
    if (((isset($_POST['libAngl'])) AND !empty($_POST['libAngl']))
            AND (!empty($_POST['Submit']) AND ($Submit === "Valider"))) {
            // Saisies valides
            $erreur = false;

            $libAngl = ctrlSaisies(($_POST['libAngl']));
            $numLang = $_POST['Langue'];
            $numAngl = $monangle->getNextNumAngl($numLang);

            $monangle->create($numAngl, $libAngl, $numLang);

            header("Location: ./angle.php");
        }   // Fin if ((isset($_POST['lib1Lang']))
        else {
            // Saisies invalides
            $erreur = true;
            $errSaisies =  "Erreur, la saisie est obligatoire !";
        }   
}  // Fin if ($_SERVER["REQUEST_METHOD"] == "POST")
// Init variables form
include $_SERVER['DOCUMENT_ROOT'] . '/initangle.php';
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <title>Admin - CRUD angle</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../../front/style.css" rel="stylesheet">
</head>
<body>
<?php
		include $_SERVER['DOCUMENT_ROOT'] . '/front/includes/commons/navigationback.php';
	?>
    <h1>BLOGART22 Admin - CRUD angle</h1>
    <h2>Ajout d'un angle</h2>

    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

      <fieldset>
        <legend class="legend1">Formulaire angle...</legend>

        <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>" />

        <div class="control-group">
            <label class="control-label" for="libAngl"><b>Libellé :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="libAngl" id="libAngl" size="80" maxlength="80" value="<?= $libAngl; ?>" tabindex="10" autofocus="autofocus" />
        </div>
        <br>
<!-- ---------------------------------------------------------------------- -->
<!-- ---------------------------------------------------------------------- -->
    <!-- Listbox Langue -->
        <br>
        <div class="control-group">
            <div class="controls">
            <label class="control-label" for="LibTypLang">
                <b>Quelle langue :&nbsp;&nbsp;&nbsp;</b>
            </label>


            <!-- Listbox langue => 2ème temps -->
            <select name="Langue" id="Langue"  class="form-control form-control-create">
                <option value="-1">- - - Choisissez une langue - - -</option>
                <?php
                $allLangue = $monangle->get_AllLangues();
                
                if($allLangue){
                for ($i=0; $i < count($allLangue); $i++){
                    $value = $allLangue[$i]['numLang'];
                ?>
                
                <option value="<?php echo($value); ?>"> <?= $value ." - " . $allLangue[$i]['lib2Lang']; ?> </option>
                
                <?php
                    } // End of foreach
                }   // if ($result)
                ?>
            </select>

            </div>
        </div>
    <!-- FIN Listbox Langue -->
<!-- ---------------------------------------------------------------------- -->
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
        </div>
        </div>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/footer.php';
?>
</body>
</html>
