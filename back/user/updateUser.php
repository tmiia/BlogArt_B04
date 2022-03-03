<?php
////////////////////////////////////////////////////////////
//
//  CRUD USER (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : updateUser.php  -  (ETUd)  BLOGART22
//
////////////////////////////////////////////////////////////

// Algorithme de hachage fort et irréversible
// password_hash()
// https://www.php.net/manual/fr/function.password-hash.php
//

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe User
require_once __DIR__ . '/../../CLASS_CRUD/user.class.php';

// Instanciation de la classe User
$monUser = new USER();



// Gestion des erreurs de saisie
$erreur = false;
// init msg erreur


// Gestion du $_SERVER["REQUEST_METHOD"] => En POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $idStat = $_POST['id'];


    if(isset($_POST['Submit'])){
        $Submit = $_POST['Submit'];
    } else {
        $Submit = "";
    }

    // controle des saisies du formulaire

// ON VEUT REINITIALISER LA VALEUR

    if($_POST['Submit'] == 'Initialiser'){ 
        header("Location: updateUser.php?id=$idStat");
        $_POST['$libelle'];
    }

    // ON VEUT VALIDER LA MODIFICATION

    elseif($_POST['Submit'] == 'Valider'){

        if(isset($_POST['id'])){ 
            
            if(!empty($_POST['id'])){

                if((isset($_POST['pseudoUser']) && !empty($_POST['pseudoUser'])) && 
                (isset($_POST['pass1User']) && !empty($_POST['pass1User'])) &&
                (isset($_POST['pass2User']) && !empty($_POST['pass2User'])) && 
                (isset($_POST['nomUser']) && !empty($_POST['nomUser'])) && 
                (isset($_POST['prenomUser']) && !empty($_POST['prenomUser'])) && 
                (isset($_POST['eMail1User']) && !empty($_POST['eMail1User'])) && 
                (isset($_POST['eMail2User']) && !empty($_POST['eMail2User']))){


                    if ((($_POST['eMail1User']) == ($_POST['eMail2User'])) && (($_POST['pass1User']) == ($_POST['pass2User']))){
                        $numUser = ctrlSaisies($_POST['id']);
                        $prenomUser = ctrlSaisies($_POST['prenomUser']);
                        $nomUser = ctrlSaisies($_POST['nomUser']);
                        $passUser = ctrlSaisies($_POST['pass1User']);
                        $eMailUser = ctrlSaisies($_POST['eMail1User']);
                        $idStat = ctrlSaisies(intval($_POST['idStat']));
                        $accordUser = ctrlSaisies($_POST['accordUser']);
            
                        
                    // CLE PRIMAIRE

                        $monUser->update($pseudoUser, $passUser, $nomUser, $prenomUser, $emailUser, $idStat);
                        
                        header("Location: ./user.php");

                    }else{
                        header("Location: updateUser.php?id=$idUser&err=empty");
                    }
                }
                else{
                    header("Location: updateUser.php?id=$idUser&err=empty");
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

    // modification effective du user



    // Gestion des erreurs => msg si saisies ko



}   // Fin if ($_SERVER["REQUEST_METHOD"] === "POST")
// Init variables form
include __DIR__ . '/initUser.php';
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
        .error {
            padding: 2px;
            border: solid 0px black;
            color: red;
            font-style: italic;
            border-radius: 5px;
        }
    </style>
    <script>
        // Afficher pass
        function myFunction(myInputPass) {
            var x = document.getElementById(myInputPass);
            if (x.type === "password") {
              x.type = "text";
            } else {
              x.type = "password";
            }
        }
    </script>
</head>
<body>
    <h1>BLOGART22 Admin - CRUD User</h1>
    <h2>Modification d'un user</h2>
<?php
    // Modif : récup id à 
    
    
    if (isset($_GET['id']) and $_GET['id'] != '') {

        $id = ctrlSaisies(($_GET['id']));

        $query = (array)$monUser->get_1Membre($id);
        //$queryStat = (array)$monMembre->get_1MembrebyStatut($_POST['idStat']);

        if ($query) {
            $pseudoUser = $query['pseudoUser'];
            $pass1User = $query['passUser'];
            $pass2User = $query['passUser'];
            $nomUser = $query['nomUser'];
            $prenomUser = $query['prenomUser'];
            $eMail1User = $query['emailUser'];
            $eMail2User = $query['emailUser'];
            $idStat = $query['idStat'];

        } 
        
       }// Fin if ($query)
    // id passé en GET







?>
    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

      <fieldset>
        <legend class="legend1">Formulaire User...</legend>

        <input type="hidden" id="id1" name="id1" value="<?= isset($_GET['id1']) ? $_GET['id1'] : '' ?>" />
        <input type="hidden" id="id2" name="id2" value="<?= isset($_GET['id2']) ? $_GET['id2'] : '' ?>" />

        <div class="control-group">
            <label class="control-label" for="pseudoUser"><b>Pseudonyme :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="pseudoUser" id="pseudoUser" size="80" maxlength="80" value="<?= $pseudoUser; ?>" disabled="disabled" />
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="pass1User"><b>Mot passe<span class="error">(*)</span> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="password" name="pass1User" id="myInput1" size="80" maxlength="80" value="<?= $pass1User; ?>" autocomplete="on" />
            <br>
            <input type="checkbox" onclick="myFunction('myInput1')">
            &nbsp;&nbsp;
            <label><i>Afficher mot de passe</i></label>
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="pass2User"><b>Confirmez la Mot passe<span class="error">(*)</span> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="password" name="pass2User" id="myInput2" size="80" maxlength="80" value="<?= $pass2User; ?>" autocomplete="on" />
            <br>
            <input type="checkbox" onclick="myFunction('myInput2')">
            &nbsp;&nbsp;
            <label><i>Afficher mot de passe</i></label>
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="prenomUser"><b>Prénom<span class="error">(*)</span> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="prenomUser" id="prenomUser" size="80" maxlength="80" value="<?= $prenomUser; ?>" autocomplete="on" />
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="nomUser"><b>Nom<span class="error">(*)</span> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="nomUser" id="nomUser" size="80" maxlength="80" value="<?= $nomUser; ?>" autocomplete="on" />
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="eMail1User"><b>eMail<span class="error">(*)</span> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="email" name="eMail1User" id="eMail1User" size="80" maxlength="80" value="<?= $eMail1User; ?>" autocomplete="on" />
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="eMail2User"><b>Confirmez l'eMail<span class="error">(*)</span> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="email" name="eMail2User" id="eMail2User" size="80" maxlength="80" value="<?= $eMail2User; ?>" autocomplete="on" />
        </div>
        <div class="error"><i>
            <small>Champ obligatoire si nouveau eMail</small>
            <br>*&nbsp;Champs obligatoires
        </i></div>

<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- FK : Statut -->
<!-- --------------------------------------------------------------- -->
    <!-- Listbox statut -->
        <br><br>
        <div class="control-group">
            <label class="control-label" for="LibTypStat"><b>Statut :&nbsp;&nbsp;&nbsp;</b></label>
                <input type="hidden" id="idStat" name="idStat" value="<?= isset($_GET['idStat']) ? $_GET['idStat'] : '' ?>" />

                <input type="text" name="idStat" id="idStat" size="5" maxlength="5" value="<?= $idStat; ?>" autocomplete="on" />

                <!-- Listbox statut => 2ème temps -->

        </div>
    <!-- FIN Listbox statut -->
<!-- --------------------------------------------------------------- -->
    <!-- FK : Statut -->
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
require_once __DIR__ . '/footerUser.php';

require_once __DIR__ . '/footer.php';
?>
</body>
</html>
