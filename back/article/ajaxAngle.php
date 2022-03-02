<?php
/*
*   Script : ajaxEtudiant.php
*   Example : 2 listbox dynamiques liées via AJAX
*/
// Mode DEV

require_once ROOT . '/util/utilErrOn.php';

// connexion
require_once ROOT . '/CONNECT/database.php';

// Insertion classe Angle
require_once ROOT . '/CLASS_CRUD/angle.class.php';

// Instanciation de la classe angle
$monAngle = new ANGLE();

?>
<select name='angle' style='padding:2px; border:solid 1px black; color:steelblue; border-radius:5px;' >
    <option value="-1">- - - Choisissez un angle - - -</option>
        <?php
            $numLang = $_REQUEST["numLang"];
            if (isset($numLang)) {
                $allAngle = $monAngle->get_AllAnglesByLang($numLang);
                if($allAngle){
                    for ($i=0; $i < count($allAngle); $i++){
                        $value = $allAngle[$i]['numAngl'];
                    ?>
                    
                    <option value="<?php echo($value); ?>"> <?= $allAngle[$i]['libAngl']; ?> </option>
                    
                    <?php
                    }
                }else{ ?>
                    <option value='-1'>- - - Choisissez un angle - - -</option>
                <?php  }
                // if ($result)
            }
            ?>
</select>


<?php
