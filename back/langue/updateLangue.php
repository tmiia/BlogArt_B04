<?php
////////////////////////////////////////////////////////////
//
//  CRUD LANGUE (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : updateLangue.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe Langue
require_once __DIR__ . '/../../CLASS_CRUD/langue.class.php';

// Instanciation de la classe langue
$maLangue = new LANGUE();


// Gestion des erreurs de saisie
$erreur = false;

// Gestion du $_SERVER["REQUEST_METHOD"] => En POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $idLang = $_POST['id'];

    if(isset($_POST['Submit'])){
        $Submit = $_POST['Submit'];
    } else {
        $Submit = "";
    }

    // ON VEUT REINITIALISER LA VALEUR

    if($_POST['Submit'] == 'Initialiser'){ 
        header("Location: updateLangue.php?id=$idLang");
        // $_POST['$libelle'];
    }

    // ON VEUT VALIDER LA MODIFICATION

    elseif($_POST['Submit'] == 'Valider'){
        if(isset($_POST['id'])){ 
            
            if(!empty($_POST['id'])){

                if(isset($_POST['lib1Lang']) and isset($_POST['lib2Lang']) and isset($_POST['Pays']) && !empty($_POST['lib1Lang']) and !empty($_POST['lib2Lang']) and !empty($_POST['Pays']) ){
                    $clredid = ctrlSaisies($_POST['id']);
                    $clredlib1 = ctrlSaisies($_POST['lib1Lang']);
                    $clredlib2 = ctrlSaisies($_POST['lib2Lang']);
                    $clredPays = ctrlSaisies($_POST['Pays']);

                    // CLE PRIMAIRE

                    $maLangue->update($clredlib1, $clredlib2, $clredPays, $clredid);
                    header("Location: ./langue.php");
                }
                else{
                    header("Location: updateLangue.php?id=$idLang&err=empty");
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
include __DIR__ . '/initLangue.php';
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <title>Admin - CRUD Langue</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <h1>BLOGART22 Admin - CRUD Langue</h1>
    <h2>Modification d'une langue</h2>
    
<?php
    // Modif : récup id à modifier

    if (isset($_GET['id']) and $_GET['id'] != '') {

        $id = ctrlSaisies(($_GET['id']));

        $query = $maLangue->get_1Langue($id);

        if ($query) {
            $lib1Lang = $query['lib1Lang'];
            $lib2Lang = $query['lib2Lang'];
            $numLang = $query['numLang'];
        }   // Fin if ($query)

    }

    // id passé en GET

?>
    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

      <fieldset>
        <legend class="legend1">Formulaire Langue...</legend>

        <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>" />

        <div class="control-group">
            <label class="control-label" for="lib1Lang"><b>Libellé court :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="lib1Lang" id="lib1Lang" size="80" maxlength="80" value="<?= $lib1Lang; ?>" tabindex="10" autofocus="autofocus" /><br><br>
        </div>
        <div class="control-group">
            <label class="control-label" for="lib2Lang"><b>Libellé long :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="lib2Lang" id="lib2Lang" size="80" maxlength="80" value="<?= $lib2Lang; ?>" tabindex="20" />
        </div>
        <br>
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- Listbox Pays -->
        <br>
        <div class="control-group">
            <div class="controls">
            <label class="control-label" for="LibTypPays">
                <b>Quel pays :&nbsp;&nbsp;&nbsp;</b>
            </label>
            
            <!-- Listbox pays => 2ème temps -->

            <select name="Pays" id="Pays"  class="form-control form-control-create">
                <option value="-1">- - - Choisissez un pays - - -</option>
                <?php
                $result = $maLangue->get_AllPays();
                
                if($result){
                for ($i=1; $i < count($result); $i++){
                    $value = $result[$i]['numPays'];
                ?>
                
                <option value="<?= $value?>"> <?= $result[$i]['frPays']; ?> </option>
                <?php
                    } // End of foreach
                }   // if ($result)
                ?>
            </select>
        </div>
    </div>

    <!-- FIN Listbox Pays -->
<!-- --------------------------------------------------------------- -->
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
<?php
require_once __DIR__ . '/footerLangue.php';

require_once __DIR__ . '/footer.php';
?>
</body>
</html>
