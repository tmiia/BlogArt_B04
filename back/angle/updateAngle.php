<?php
////////////////////////////////////////////////////////////
//
//  CRUD angle (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : updateangle.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once ROOT . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once ROOT . '/../../util/ctrlSaisies.php';

// Insertion classe angle
require_once ROOT . '/../../class_crud/angle.class.php';

// Instanciation de la classe angle
$monangle = new angle();

// Insertion classe angle
require_once ROOT . '/../../class_crud/angle.class.php';

// Instanciation de la classe angle
$monangle = new angle();

// Insertion classe Langue
require_once ROOT . '/../../class_crud/langue.class.php';

// Instanciation de la classe langue
$maLangue = new langue();

require_once ROOT . '/../../class_crud/thematique.class.php';
// Instanciation de la classe MotCle
$mathematique = new thematique();



// Gestion  erreurs de saisie
$erreur = false;



// Gestion du $_SERVER["REQUEST_METHOD"] => En POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $idAngl = $_POST['id'];


    if(isset($_POST['Submit'])){
        $Submit = $_POST['Submit'];
    } else {
        $Submit = "";
    }

    // ON VEUT REINITIALISER LA VALEUR

    if($_POST['Submit'] == 'Initialiser'){ 
        header("Location: updateangle.php?id=$idAngl");
        //$_POST['$libelle'];
    }

    // ON VEUT VALIDER LA MODIFICATION

    elseif($_POST['Submit'] == 'Valider'){
        if(isset($_POST['id'])){ 
            
            if(!empty($_POST['id'])){

                if(isset($_POST['libAngl']) && !empty($_POST['libAngl'])){
                    $clredid = ctrlSaisies($_POST['id']);
                    $clredlib = ctrlSaisies($_POST['libAngl']);
                    $clredlang = ctrlSaisies($_POST['Langue']);
            

                    // CLE PRIMAIRE

                    $monangle->update($clredlib, $clredlang, $clredid);
                    header("Location: ./angle.php");
                }
                else{
                    header("Location: updateangle.php?id=$idAngl&err=empty");
                }
            }
            else{
                $erreur = "Erreur";
            }
        }
        else{
            $erreur = "Erreur";
        }
    }
}
      // Fin if ($_SERVER["REQUEST_METHOD"] === "POST")
// Init variables form
include ROOT . '/initangle.php';
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
		include ROOT . '/front/includes/commons/navigationback.php';
	?>
    <h1>BLOGART22 Admin - CRUD angle</h1>
    <h2>Modification d'un angle</h2>
<?php
    // Modif : récup id à modifier
    
    if (isset($_GET['id']) and $_GET['id'] != '') {

        $id = ctrlSaisies(($_GET['id']));

        $query = (array)$monangle->get_1angle($id);

        if ($query) {
            $libAngl = $query['libAngl'];
            $numAngl = $query['numAngl']; 
            $numLang = $query['numLang']; 
            
        }   // Fin if ($query)

    }

    // id passé en GET




?>
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
            <option value="-1"><?php $oneLangue = $maLangue->get_1Langue($numLang); echo($oneLangue['lib1Lang']); ?></option>
                <?php
                $allLangue = $monangle->get_AllLangues();
                
                if($allLangue){
                for ($i=1; $i < count($allLangue); $i++){
                    $value = $allLangue[$i]['numLang'];
                ?>
                
                <option value="<?php echo($value); ?>"> <?= $allLangue[$i]['lib2Lang']; ?> </option>
                
                <?php
                    } // End of foreach
                }   // if ($result)
                ?>
            </select>

            </div>
        </div>
    <!-- FIN Listbox Langue -->
<!-- ---------------------------------------------------------------------- -->
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
require_once ROOT . '/footer.php';
?>
</body>
</html>
