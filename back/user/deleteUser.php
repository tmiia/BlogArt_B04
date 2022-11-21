<?php
////////////////////////////////////////////////////////////
//
//  CRUD user (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : deleteUser.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once ROOT . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once ROOT . '/../../util/ctrlSaisies.php';

// Insertion classe User
require_once ROOT . '/../../class_crud/user.class.php';

// Instanciation de la classe User
$monUser = new user();
// Instanciation de la classe User

require_once ROOT . '/../../class_crud/statut.class.php';

// Instanciation de la classe User
$monStatut = new statut();

// Gestion du $_SERVER["REQUEST_METHOD"] => En POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if(isset($_POST['Submit'])){
        $Submit = $_POST['Submit'];
    } else {
        $Submit = "";
    }

    if ((isset($_POST["Submit"])) AND ($Submit === "Annuler")) {
    
        header("Location: ./user.php");
} 

    if (((isset($_POST["Submit"])) AND ($Submit === "Valider")) AND ($_POST['Statut'] != 1)) {
       
            $monUser->delete($_POST['id1']);
            header("Location: ./user.php");
   
    
    } else {
            header("Location: user.php?errCIR=1");
        
    }

    // controle CIR

    // delete effective du user

}   // Fin if ($_SERVER["REQUEST_METHOD"] === "POST")
// Init variables form
include ROOT . '/initUser.php';
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <title>Admin - CRUD User</title>
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
            /* Coins arrondis et couleur du cadre */
            border: 2px solid grey;
            -moz-border-radius: 8px;
            -webkit-border-radius: 8px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <h1>BLOGART22 Admin - CRUD User</h1>
    <h2>Suppression d'un user</h2>
<?php
    // Supp : récup id à supprimer
    // id passé en GET
    if (isset($_GET['id1']) and $_GET['id1'] > '') {

        $id = ctrlSaisies(($_GET['id1']));
        $query = $monUser->get_1User($id);

        if ($query) {
            $prenomUser = $query['prenomUser'];
            $nomUser = $query['nomUser']; 
            $pseudoUser = $query['pseudoUser']; 
            $eMail1User = $query['eMailUser']; 
            $idStat = $query['idStat']; 
            $pass1User = $query['passUser'];
        }   
    }




?>
    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

      <fieldset>
        <legend class="legend1">Formulaire User...</legend>

        <input type="hidden" id="id1" name="id1" value="<?= isset($_GET['id1']) ? $_GET['id1'] : '' ?>" />
        <input type="hidden" id="id2" name="id2" value="<?= isset($_GET['id2']) ? $_GET['id2'] : '' ?>" />

        <div class="control-group">
            <label class="control-label" for="pseudoUser"><b>Pseudonyme :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="pseudoUser" id="pseudoUser" size="80" maxlength="80" value="<?php echo($pseudoUser); ?>" disabled />
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="pass1User"><b>Mot passe :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="password" name="pass1User" id="pass1User" size="80" maxlength="80" value="<?php echo($pass1User); ?>" disabled />
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="prenomUser"><b>Prénom :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="prenomUser" id="prenomUser" size="80" maxlength="80" value="<?php echo($prenomUser); ?>" disabled />
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="nomUser"><b>Nom :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="nomUser" id="nomUser" size="80" maxlength="80" value="<?php echo($nomUser); ?>" disabled />
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="eMail1User"><b>eMail :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="email" name="eMail1User" id="eMail1User" size="80" maxlength="80" value="<?php echo($eMail1User); ?>" disabled />
        </div>

<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- FK : Statut -->
<!-- --------------------------------------------------------------- -->
    <!-- Listbox statut -->
        <br><br>
        <div class="control-group">
            <label class="control-label" for="LibTypStat"><b>Statut :&nbsp;&nbsp;&nbsp;</b></label>
                <input type="hidden" id="idStat" name="idStat" value="<?= isset($_GET['idStat']) ? $_GET['idStat'] : '' ?>" />

                <select name="Statut" id="Statut"  class="form-control form-control-create">
                <?php
                    $oneStat = $monStatut->get_1Statut($idStat);
                ?>
                <option value="<?= ($oneStat['idStat']); ?>"> <?= $oneStat['libStat']; ?> </option>                

            </select>
                <!-- Listbox statut disabled => 2ème temps -->

        </div>

    <!-- FIN Listbox statut -->
<!-- --------------------------------------------------------------- -->
    <!-- FK : Statut -->
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
require_once ROOT . '/footerUser.php';

require_once ROOT . '/footer.php';
?>
</body>
</html>
