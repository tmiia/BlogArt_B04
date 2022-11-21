<?php
////////////////////////////////////////////////////////////
//
//  CRUD statut (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : updateStatut.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once $_SERVER['DOCUMENT_ROOT'] . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once $_SERVER['DOCUMENT_ROOT'] . '/../../util/ctrlSaisies.php';

// Insertion classe Statut
require_once $_SERVER['DOCUMENT_ROOT'] . '/../../class_crud/statut.class.php';

// Instanciation de la classe Statut
$monStatut = new statut();


// Gestion des erreurs de saisie
$erreur = false;


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $idLib = $_POST['id'];

    if(isset($_POST['Submit'])){
        $Submit = $_POST['Submit'];
    } else {
        $Submit = "";
    }

    // ON VEUT REINITIALISER LA VALEUR

    if($_POST['Submit'] == 'Initialiser'){ 
        header("Location: updateStatut.php?id=$idLib");
        $_POST['$libelle'];
    }

    // ON VEUT VALIDER LA MODIFICATION

    elseif($_POST['Submit'] == 'Valider'){
        if(isset($_POST['id'])){ 
            
            if(!empty($_POST['id'])){

                if(isset($_POST['libStat']) && !empty($_POST['libStat'])){
                    $clredid = ctrlSaisies($_POST['id']);
                    $clredlib = ctrlSaisies($_POST['libStat']);
                    $monStatut->update($clredid,$clredlib);
                    header("Location: ./statut.php");
                }
                else{
                    header("Location: updateStatut.php?id=$idLib&err=empty");
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
include $_SERVER['DOCUMENT_ROOT'] . '/initStatut.php';
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <title>Admin - CRUD Statut</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../../front/style.css" rel="stylesheet">
</head>
<body>
    <?php
		include $_SERVER['DOCUMENT_ROOT'] . '/front/includes/commons/navigationback.php';
	?>
    <h1>BLOGART22 Admin - CRUD Statut</h1>
    <h2>Modification d'un statut</h2>
<?php
    // Modif : récup id à modifier

    if (isset($_GET['id']) and $_GET['id'] > 0) {

        $id = ctrlSaisies(($_GET['id']));

        $query = (array)$monStatut->get_1Statut($id);

        if ($query) {
            $libStat = $query['libStat'];
            $idStat = $query['idStat']; 
        }   // Fin if ($query)

    }

    // id passé en GET

?>
    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

      <fieldset>
        <legend class="legend1">Formulaire Statut...</legend>

        <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>" />

        <div class="control-group">
            <label class="control-label" for="libStat"><b>Nom :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="libStat" id="libStat" size="80" maxlength="80" value="<?= $libStat; ?>" />
        </div>

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
