<?php
/*
*   Script : ajaxEtudiant.php
*   Example : 2 listbox dynamiques liées via AJAX
*/
// Mode DEV

// connexion
require_once __DIR__ . '/../../../connect/database.php';

// Insertion classe Angle
require_once ROOT . '/class_crud/angle.class.php';

// Instanciation de la classe angle
$monAngle = new angle();

require_once ROOT . '/class_crud/thematique.class.php';
// Instanciation de la classe MotCle
$maThematique = new thematique();


?>
<select name='thematique' id='thematique' style='padding:2px; border:solid 1px black; color:steelblue; border-radius:5px;' >
    <option value="-1">- - - Choisissez une thématique - - -</option>
        <?php
            $numThem =  $_REQUEST["numThem2"];
            
            if (isset($numThem)) {
                $allThem = $maThematique->get_AllThematiquesByLang($numThem);
                if($allThem){
                    for ($i=0; $i < count($allThem); $i++){
                        $value = $allThem[$i]['numThem'];
                    ?>
                    
                    <option value="<?php echo($value); ?>"> <?php echo($allThem[$i]['libThem']); ?> </option>
                    
                    <?php
                    }
                }else{ ?>
                    <option value='-1'>lalala</option>
                <?php  }
                // if ($result)
            }
            ?>
</select>


<?php
