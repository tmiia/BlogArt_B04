<?php
/*
*   Script : ajaxEtudiant.php
*   Example : 2 listbox dynamiques liées via AJAX
*/
// Mode DEV

require_once $_SERVER['DOCUMENT_ROOT'] . '/../../util/utilErrOn.php';

// connexion
require_once $_SERVER['DOCUMENT_ROOT'] . '/../../connect/database.php';

// Insertion classe angle
require_once $_SERVER['DOCUMENT_ROOT'] . '/../../class_crud/angle.class.php';

// Instanciation de la classe angle
$monangle = new angle();

?>
<select name='angle' style='padding:2px; border:solid 1px black; color:steelblue; border-radius:5px;' >
    <option value="-1">- - - Choisissez un angle - - -</option>
        <?php
            $numLang = $_REQUEST["numLang"];
            if (isset($numLang)) {
                $allangle = $monangle->get_AllanglesByLang($numLang);
                if($allangle){
                    for ($i=0; $i < count($allangle); $i++){
                        $value = $allangle[$i]['numAngl'];
                    ?>
                    
                    <option value="<?php echo($value); ?>"> <?= $allangle[$i]['libAngl']; ?> </option>
                    
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
