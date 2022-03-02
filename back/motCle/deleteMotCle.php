<?php
////////////////////////////////////////////////////////////
//
//  CRUD MOTCLE (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : deleteMotCle.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once ROOT . '/util/utilErrOn.php';

// controle des saisies du formulaire
require_once ROOT . '/util/ctrlSaisies.php';

// Insertion classe MotCle
require_once ROOT . '/CLASS_CRUD/motcle.class.php';
// Instanciation de la classe MotCle
$monMotCle = new MOTCLE();

// Insertion classe MotCle
require_once ROOT . '/CLASS_CRUD/motclearticle.class.php';
// Instanciation de la classe MotCle
$monMotCleArt= new MOTCLEARTICLE();

// Insertion classe MotCle
require_once ROOT . '/CLASS_CRUD/langue.class.php';
// Instanciation de la classe MotCle
$maLangue= new LANGUE();



// Gestion du $_SERVER["REQUEST_METHOD"] => En POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if(isset($_POST['Submit'])){
        $Submit = $_POST['Submit'];
    } else {
        $Submit = "";
    }

    if ((isset($_POST["Submit"])) AND ($Submit === "Annuler")) {
    
        header("Location: ./motcle.php");
} 

    if (((isset($_POST["Submit"])) AND ($Submit === "Valider"))) {
        $nbMotCleArt = $monMotCleArt->get_AllArtsByNumMotCle($_POST["id"]);
        //print_r($nbMembre);
        //print_r($monMembre->get_AllMembersByStat($_POST["id"]));
        if ($nbMotCleArt < 1) {
                $monMotCle->delete($_POST["id"]);
                header("Location: ./motcle.php");
            } else {
                header("Location: motcle.php?errCIR=1");
        }
    }

}



    // controle des saisies du formulaire

    // modif effective de la MotCle






   // Fin if ($_SERVER["REQUEST_METHOD"] === "POST")
// Init variables form
include ROOT . '/back/motCle/initMotCle.php';
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <title>Admin - CRUD Mot Clé</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../css/style.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        #p1 {
            max-width: 600px;
            width: 600px;
            max-height: 200px;
            height: 200px;
            border: 1px solid #000000;
            background-color: whitesmoke;
            /* Coins arrondis et couleur cadre */
            border: 2px solid grey;
            -moz-border-radius: 8px;
            -webkit-border-radius: 8px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <h1>BLOGART22 Admin - CRUD Mot Clé</h1>
    <h2>Suppression d'un Mot Clé</h2>
<?php
    // Supp : récup id à supprimer
    if (isset($_GET['id']) and $_GET['id'] > 0) {

        $id = ctrlSaisies(($_GET['id']));

        $query = (array)$monMotCle->get_1MotCle($id);

        if ($query) {
            $libMotCle = $query['libMotCle'];
            $numMotCle = $query['numMotCle']; 
            $numLang = $query['numLang']; 
        }   
    }
    // id passé en GET







?>
    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

      <fieldset>
        <legend class="legend1">Formulaire Mot Clé...</legend>

        <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>" />

        <div class="control-group">
            <label class="control-label" for="libMotCle"><b>Libellé :&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="libMotCle" id="libMotCle" size="80" maxlength="100" value="<?= $libMotCle; ?>" disabled />
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
                <input type="hidden" id="idLang" name="idLang" value="<?= isset($_GET['idLang']) ? $_GET['idLang'] : '' ?>" />


                <!-- Listbox langue disabled => 2ème temps -->
                <select name="Langue" id="Langue"  class="form-control form-control-create">

                <?php
                $oneLang = $maLangue->get_1Langue($numLang);
                
                ?>
                
                <option value="<?= ($oneLang['numLang']); ?>"> <?= $oneLang['lib1Lang']; ?> </option>
            </select>

        </div>
    <!-- FIN Listbox langue -->
<!-- --------------------------------------------------------------- -->
    <!-- FK : Langue -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
        <div class="control-group">
            <div class="controls">
                <br><br>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" value="Annuler" style="cursor:pointer; padding:5px 20px; background-color:lightsteelblue; border:dotted 2px grey; border-radius:5px;" name="Submit" />
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" value="Valider" style="cursor:pointer; padding:5px 20px; background-color:lightsteelblue; border:dotted 2px grey; border-radius:5px;" name="Submit" />
                <br>
            </div>
        </div>
      </fieldset>
    </form>
<?php
require_once ROOT . '/back/motCle/footerMotCle.php';

require_once ROOT . '/back/motCle/footer.php';
?>
</body>
</html>
