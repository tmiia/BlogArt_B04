<?php
////////////////////////////////////////////////////////////
//
//  CRUD membre (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : updateMembre.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once ROOT . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once ROOT . '/../../util/ctrlSaisies.php';

// Mise en forme date
require_once ROOT . '/../../util/dateChangeFormat.php';

// Insertion classe Statut
require_once ROOT . '/../../class_crud/statut.class.php';

// Instanciation de la classe Statut
$monStatut = new statut();

// Insertion classe Membre
require_once ROOT . '/../../class_crud/membre.class.php';

// Instanciation de la classe Membre
$monMembre = new membre();


// Gestion des erreurs de saisie
$erreur = false;
// Init msg


// Gestion du $_SERVER["REQUEST_METHOD"] => En POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $idMemb = $_POST['id'];


    if(isset($_POST['Submit'])){
        $Submit = $_POST['Submit'];
    } else {
        $Submit = "";
    }

    // controle des saisies du formulaire

// ON VEUT REINITIALISER LA VALEUR

    if($_POST['Submit'] == 'Initialiser'){ 
        header("Location: updateMembre.php?id=$idMemb");
        $_POST['$libelle'];
    }

    // ON VEUT VALIDER LA MODIFICATION

    elseif($_POST['Submit'] == 'Valider'){

        if(isset($_POST['id'])){ 
            
            if(!empty($_POST['id'])){

                if((isset($_POST['prenomMemb']) && !empty($_POST['prenomMemb'])) && 
                (isset($_POST['nomMemb']) && !empty($_POST['nomMemb'])) && 
                (isset($_POST['pass1Memb']) && !empty($_POST['pass1Memb'])) &&
                (isset($_POST['pass2Memb']) && !empty($_POST['pass2Memb'])) && 
                (isset($_POST['eMail1Memb']) && !empty($_POST['eMail1Memb'])) && 
                (isset($_POST['eMail2Memb']) && !empty($_POST['eMail2Memb'])) && 
                (isset($_POST['accordMemb']) && !empty($_POST['accordMemb']))){


                    if ((($_POST['eMail1Memb']) == ($_POST['eMail2Memb'])) && (($_POST['pass1Memb']) == ($_POST['pass2Memb']))){
                        $numMemb = ctrlSaisies($_POST['id']);
                        $prenomMemb = ctrlSaisies($_POST['prenomMemb']);
                        $nomMemb = ctrlSaisies($_POST['nomMemb']);
                        $passMemb = ctrlSaisies($_POST['pass1Memb']);
                        $eMailMemb = ctrlSaisies($_POST['eMail1Memb']);
                        $idStat = ctrlSaisies(intval($_POST['idStat']));
                        $accordMemb = ctrlSaisies($_POST['accordMemb']);
            
                        
                    // CLE PRIMAIRE

                        $monMembre->update($numMemb, $prenomMemb, $nomMemb, $passMemb, $eMailMemb, $idStat);
                        
                        header("Location: ./membre.php");

                    }else{
                        header("Location: updateMembre.php?id=$idMemb&err=empty");
                    }
                }
                else{
                    header("Location: updateMembre.php?id=$idMemb&err=empty");
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

    // modification effective du membre



    // Gestion des erreurs => msg si saisies ko

            // CTRL saisies
            // VALIDITÉ MAIL

            // MAIL IDENTIQUE
            // TEST MODIF PASS





}   // Fin if ($_SERVER["REQUEST_METHOD"] === "POST")
// Init variables form
include ROOT . '/initMembre.php';
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <title>Admin - CRUD Membre</title>
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
        // Affichage pass
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
    <h1>BLOGART22 Admin - CRUD Membre</h1>
    <h2>Modification d'un membre</h2>
<?php
    // Modif : récup id à modifier

    if (isset($_GET['id']) and $_GET['id'] != '') {

        $id = ctrlSaisies(($_GET['id']));

        $query = (array)$monMembre->get_1Membre($id);
        //$queryStat = (array)$monMembre->get_1MembrebyStatut($_POST['idStat']);

        if ($query) {
            $prenomMemb = $query['prenomMemb'];
            $nomMemb = $query['nomMemb'];
            $pseudoMemb = $query['pseudoMemb'];
            $pass1Memb = $query['passMemb'];
            $pass2Memb = $query['passMemb'];
            $eMail1Memb = $query['eMailMemb'];
            $eMail2Memb = $query['eMailMemb'];
            $accordMemb = $query['accordMemb'];
            $dtCreaMemb = $query['dtCreaMemb'];
            $idStat = $query['idStat'];

        } 
        
       }// Fin if ($query)



    // id passé en GET




?>
    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

      <fieldset>
        <legend class="legend1">Formulaire Membre...</legend>

        <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>" />

        <div class="control-group">
            <label class="control-label" for="prenomMemb"><b>Prénom<span class="error">(*)</span> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="prenomMemb" id="prenomMemb" size="80" maxlength="80" value="<?= $prenomMemb; ?>" autocomplete="on" autofocus="autofocus" />
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="nomMemb"><b>Nom<span class="error">(*)</span> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="nomMemb" id="nomMemb" size="80" maxlength="80" value="<?= $nomMemb; ?>" autocomplete="on" />
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="pseudoMemb"><b>Pseudonyme :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="pseudoMemb" id="pseudoMemb" size="80" maxlength="80" value="<?= $pseudoMemb; ?>" disabled />
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="pass1Memb"><b>Mot passe<span class="error">(*)</span> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="password" name="pass1Memb" id="myInput1" size="80" maxlength="80" value="<?= $pass1Memb; ?>" autocomplete="on" />
            <br>
            <input type="checkbox" onclick="myFunction('myInput1')">
            &nbsp;&nbsp;
            <label><i>Afficher mot de passe</i></label>
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="pass2Memb"><b>Confirmez le mot passe<span class="error">(*)</span> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="password" name="pass2Memb" id="myInput2" size="80" maxlength="80" value="<?= $pass2Memb; ?>" autocomplete="on" />
            <br>
            <input type="checkbox" onclick="myFunction('myInput2')">
            &nbsp;&nbsp;
            <label><i>Afficher mot de passe</i></label>
        </div>
        <small class="error">*Champ obligatoire si nouveau passe</small><br>
        <br>
        <div class="control-group">
            <label class="control-label" for="eMail1Memb"><b>eMail<span class="error">(*)</span> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="email" name="eMail1Memb" id="eMail1Memb" size="80" maxlength="80" value="<?= $eMail1Memb; ?>" autocomplete="on" />
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="eMail2Memb"><b>Confirmez l'eMail<span class="error">(*)</span> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="email" name="eMail2Memb" id="eMail2Memb" size="80" maxlength="80" value="<?= $eMail2Memb; ?>" autocomplete="on" />
        </div>
        <small class="error">*Champ obligatoire si nouveau eMail</small><br>

        <br>
        <div class="control-group">
            <label class="control-label" for="accordMemb"><b>J'ai accepté que mes données soient conservées :</b></label>
            <div class="controls">
               <fieldset>
                  <input type="radio" name="accordMemb"
                  <?php if($accordMemb == 1) : ?> value="1" checked <?php endif; ?> />
                  &nbsp;&nbsp;Oui&nbsp;&nbsp;&nbsp;&nbsp; 
                  <input type="radio" name="accordMemb"
                  <?php if($accordMemb == 0) : ?> value="0" checked <?php endif; ?> />
                    &nbsp;&nbsp;Non&nbsp;&nbsp;&nbsp;&nbsp;
               </fieldset>
            </div>
        </div>
        <br><br>

<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- FK : Statut -->
<!-- --------------------------------------------------------------- -->
    <!-- Listbox statut -->
        <div class="control-group">
            <label class="control-label" for="LibTypStat"><b>Statut :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
                <input type="hidden" id="idStat" name="idStat" value="<?= isset($_GET['idStat']) ? $_GET['idStat'] : '' ?>" />


                <!-- Listbox statut => 2ème temps -->

                <select name="Statut" id="Statut"  class="form-control form-control-create">
                <option value="-1"><?php $oneStat = $monStatut->get_1Statut($idStat); echo($oneStat['libStat']); ?></option>
                <?php
                $result = $monStatut->get_AllStatuts();
                
                if($result){
                for ($i=1; $i < count($result); $i++){
                    $value = $result[$i]['idStat'];
                ?>
                
                <option value="<?= $value?>"> <?= $result[$i]['libStat']; ?> </option>
                <?php
                    } // End of foreach
                }   // if ($result)
                ?>
            </select>

        </div>
    <!-- FIN Listbox statut -->
<!-- --------------------------------------------------------------- -->
    <!-- FK : Statut -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
        <br>
        <div class="control-group">
            <label class="control-label" for="dtCreaMemb"><b>Date création :&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="dtCreaMemb" id="dtCreaMemb" value="<?= $dtCreaMemb; ?>" disabled />
        </div>
        <small>(Pour mémoire)</small><br>

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
require_once ROOT . '/footerMembre.php';

require_once ROOT . '/footer.php';
?>
</body>
</html>
