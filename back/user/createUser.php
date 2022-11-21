<?php
////////////////////////////////////////////////////////////
//
//  CRUD user (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : createUser.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Algorithme de hachage fort et irréversible
// password_hash()
// https://www.php.net/manual/fr/function.password-hash.php
//

// Mode DEV
require_once $_SERVER['DOCUMENT_ROOT'] . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once $_SERVER['DOCUMENT_ROOT'] . '/../../util/ctrlSaisies.php';

// Insertion classe User
require_once $_SERVER['DOCUMENT_ROOT'] . '/../../class_crud/user.class.php';

// Instanciation de la classe User
$monUser = new user();
// Instanciation de la classe User
// Insertion classe Statut
require_once $_SERVER['DOCUMENT_ROOT'] . '/../../class_crud/statut.class.php';

// Instanciation de la classe Statut
$monStatut = new statut();


// Gestion des erreurs de saisie
$erreur = false;
// init msg erreur


// Gestion du $_SERVER["REQUEST_METHOD"] => En POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if(isset($_POST['Submit'])){
        $Submit = $_POST['Submit'];
    } else {
        $Submit = "";
    }

    if (isset($_POST["Submit"]) AND $Submit === "Initialiser") {
    
            header("Location: ./user.php");
    }   // End of if ((isset($_POST["submit"])) ...
        
    if((isset($_POST['prenomUser']) && !empty($_POST['prenomUser'])) && 
    (isset($_POST['nomUser']) && !empty($_POST['nomUser'])) && 
    (isset($_POST['eMail1User']) && !empty($_POST['eMail1User'])) && 
    (isset($_POST['eMail2User']) && !empty($_POST['eMail2User'])) && 
    (isset($_POST['pass1User']) && !empty($_POST['pass1User'])) && 
    (isset($_POST['pass2User']) && !empty($_POST['pass2User'])) && 
    (isset($_POST['pseudoUser']) && !empty($_POST['pseudoUser'])) && 
    (!empty($_POST['Submit'])) && ($Submit === "Valider")) {

        if ($_POST['eMail1User'] == $_POST['eMail2User'] && $_POST['pass1User'] == $_POST['pass2User']){
            // Saisies valides
            $erreur = false;
    
            $prenomUser = ctrlSaisies(($_POST['prenomUser']));
            $nomUser = ctrlSaisies(($_POST['nomUser']));
            $pseudoUser = ctrlSaisies(($_POST['pseudoUser']));
            $passUser = ctrlSaisies(($_POST['pass1User']));
            $eMailUser = ctrlSaisies(($_POST['eMail1User']));
            $idStat = $_POST['Statut'];


            $monUser->create($pseudoUser, $passUser, $nomUser, $prenomUser, $eMailUser, $idStat);
    
            header("Location: ./user.php");
        }
        }
          // Fin if ((isset($_POST['libStat']))
        else {
            // Saisies invalides
            $erreur = true;
            $errSaisies =  "Erreur, la saisie est obligatoire !";
        }   // End of else erreur saisies



    // controle des saisies du formulaire

    // création effective du user



    // Gestion des erreurs => msg si saisies ko




        // CTRL saisies
        // PSEUDO : valide, longueur: 6 mini, 70 maxi



        // VALIDITÉ MAIL
        // 1ère mail == valide
        // 2ème mail == valide
        // 2 mails identiques




        // PASS VALIDE
        // majuscules, minuscules, chiffres, car. spéciaux
        // 2 mails identiques



}   // Fin if ($_SERVER["REQUEST_METHOD"] == "POST")
// Init variables form
include $_SERVER['DOCUMENT_ROOT'] . '/initUser.php';
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
    <h2>Ajout d'un user : Inscription</h2>

    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

      <fieldset>
        <legend class="legend1">Formulaire User...</legend>

        <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>" />

        <div class="control-group">
            <label class="control-label" for="pseudoUser"><b>Pseudonyme<span class="error">(*)</span> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="pseudoUser" id="pseudoUser" size="80" maxlength="80" value="<?php if(isset($_POST['pseudoUser'])) echo $_POST['pseudoUser']; ?>" placeholder="6 car. minimum" autocomplete="on" autofocus="autofocus" />
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="pass1User"><b>Mot passe<span class="error">(*)</span> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="password" name="pass1User" id="myInput1" size="80" maxlength="80" value="<?php if(isset($_POST['pass1User'])) echo $_POST['pass1User']; ?>" autocomplete="on" />
            <br>
            <input type="checkbox" onclick="myFunction('myInput1')">
            &nbsp;&nbsp;
            <label><i>Afficher mot de passe</i></label>
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="pass2User"><b>Confirmez la Mot passe<span class="error">(*)</span> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="password" name="pass2User" id="myInput2" size="80" maxlength="80" value="<?php if(isset($_POST['pass2User'])) echo $_POST['pass2User']; ?>" autocomplete="on" />
            <br>
            <input type="checkbox" onclick="myFunction('myInput2')">
            &nbsp;&nbsp;
            <label><i>Afficher mot de passe</i></label>
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="prenomUser"><b>Prénom<span class="error">(*)</span> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="prenomUser" id="prenomUser" size="80" maxlength="80" value="<?php if(isset($_POST['prenomUser'])) echo $_POST['prenomUser']; ?>" autocomplete="on" />
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="nomUser"><b>Nom<span class="error">(*)</span> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="nomUser" id="nomUser" size="80" maxlength="80" value="<?php if(isset($_POST['nomUser'])) echo $_POST['nomUser']; ?>" autocomplete="on" />
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="eMail1User"><b>eMail<span class="error">(*)</span> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="email" name="eMail1User" id="eMail1User" size="80" maxlength="80" value="<?php if(isset($_POST['eMail1User'])) echo $_POST['eMail1User']; ?>" autocomplete="on" />
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="eMail2User"><b>Confirmez l'eMail<span class="error">(*)</span> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="email" name="eMail2User" id="eMail2User" size="80" maxlength="80" value="<?php if(isset($_POST['eMail2User'])) echo $_POST['eMail2User']; ?>" autocomplete="on" />
        </div>
        <i><div class="error"><br>*&nbsp;Champs obligatoires</div></i>

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
                <option value="-1">- - - Choisissez un statut - - -</option>
                <?php
                $allStatuts = $monStatut->get_AllStatuts();
                
                if($allStatuts){
                for ($i=0; $i < count($allStatuts); $i++){
                    $value = $allStatuts[$i]['idStat'];
                ?>
                
                <option value="<?php echo($value); ?>"> <?= $value . " - " . $allStatuts[$i]['libStat']; ?> </option>
                
                <?php
                    } // End of foreach
                }   // if ($result)
                ?>
            </select>
            <!-- Listbox statut => 2ème temps -->

        </div>
    <!-- FIN Listbox statut -->
<!-- --------------------------------------------------------------- -->
    <!-- FK : Statut -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->

        <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" />

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
require_once $_SERVER['DOCUMENT_ROOT'] . '/footerUser.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/footer.php';
?>
    <!-- ================================================== -->
    <!-- Le javascript                                      -->
    <!-- ================================================== -->
    <script type="text/javascript">

        grecaptcha.ready(function(){
            grecaptcha.execute('<?= SITE_KEY ?>', {action: 'homepage'})
            .then(function(token){
                //console.log(token);
                document.getElementById('g-recaptcha-response').value=token;
            });
        });
    </script>
</body>
</html>
