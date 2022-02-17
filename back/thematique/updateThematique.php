<?php
////////////////////////////////////////////////////////////
//
//  CRUD THEMATIQUE (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : updateThematique.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';
// Mise en forme date
require_once __DIR__ . '/../../util/dateChangeFormat.php';

// Insertion classe Thematique
require_once __DIR__ . '/../../CLASS_CRUD/thematique.class.php';

// Instanciation de la classe Thematique
$maThematique = new THEMATIQUE();


// Insertion classe Langue
require_once __DIR__ . '/../../CLASS_CRUD/langue.class.php';

// Instanciation de la classe Langue
$maLangue = new LANGUE();


// BBCode


// Gestion des erreurs de saisie
$erreur = false;

// Gestion du $_SERVER["REQUEST_METHOD"] => En POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    
    $idThem = $_POST['id'];


    if(isset($_POST['Submit'])){
        $Submit = $_POST['Submit'];
    } else {
        $Submit = "";
    }

    // ON VEUT REINITIALISER LA VALEUR

    if($_POST['Submit'] == 'Initialiser'){ 
        header("Location: updateThematique.php?id=$idThem");
        $_POST['$libelle'];
    }

    // ON VEUT VALIDER LA MODIFICATION

    elseif($_POST['Submit'] == 'Valider'){
        
        if(isset($_POST['id'])){ 
            
            if(!empty($_POST['id'])){

                if((isset($_POST['libThem']) && !empty($_POST['libThem']))){
                    $numThem = ctrlSaisies($_POST['id']);
                    $clredlib = ctrlSaisies($_POST['libThem']);
                    $clredlang = ctrlSaisies($_POST['Langue']);
            

                    // CLE PRIMAIRE

                    $maThematique->update($clredlib, $clredlang, $numThem);
                    header("Location: ./thematique.php");
                }
                else{
                    header("Location: updateThematique.php?id=$idThem&err=empty");
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
    // modification effective de la thématique

    // Gestion des erreurs => msg si saisies ko
   // Fin if ($_SERVER["REQUEST_METHOD"] === "POST")

// Init variables form
include __DIR__ . '/initThematique.php';
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <title>Admin - CRUD Thematique</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <h1>BLOGART22 Admin - CRUD Thematique</h1>
    <h2>Modification d'une Thematique</h2>
<?php
    // Modif : récup id à modifier

    if (isset($_GET['id']) and $_GET['id'] != '') {

        $id = ctrlSaisies(($_GET['id']));

        $query = (array)$maThematique->get_1Thematique($id);

        if ($query) {
            $libThem = $query['libThem'];
            $numThem = $query['numThem'];
            $numLang = $query['numLang'];
        }   // Fin if ($query)

    }

    // id passé en GET



?>
    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

      <fieldset>
        <legend class="legend1">Formulaire Thematique...</legend>

        <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>" />

        <div class="control-group">
            <label class="control-label" for="libThem"><b>Libellé :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="libThem" id="libThem" size="80" maxlength="80" value="<?= $libThem; ?>" placeholder="Titre de la thématique" autocomplete="on" autofocus="autofocus" />
        </div>
        <br><br>
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- FK : Langue -->
<!-- --------------------------------------------------------------- -->
    <!-- Listbox langue -->
        <div class="control-group">
            <label class="control-label" for="LibTypLang"><b>Langue :&nbsp;&nbsp;&nbsp;</b></label>
                <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>" />

                <!-- Listbox pays => 2ème temps -->

            <select name="Langue" id="Langue"  class="form-control form-control-create">
                <option value="-1"><?php $oneLang = $maLangue->get_1Langue($numLang); echo($oneLang['lib1Lang']); ?></option>
                <?php
                $result = $maLangue->get_AllLangues();
                
                if($result){
                for ($i=1; $i < count($result); $i++){
                    $value = $result[$i]['numLang'];
                ?>
                
                <option value="<?= $value?>"> <?= $result[$i]['lib1Lang']; ?> </option>
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
<?php
require_once __DIR__ . '/footerThematique.php';

require_once __DIR__ . '/footer.php';
?>
</body>
</html>
