<link href="style.css" rel="stylesheet">
<?php require_once ROOT . '/imports.php'; 
require_once ROOT . '/../../../connect/config.php';
require_once ROOT . '/../../../class_crud/langue.class.php';
$maLangue = new langue();
?>

<div id="navigation">
    
    <nav>
        <a href="<?=ROOTFRONT?>/index.php"><img src="<?=ROOTFRONT?>/front/assets/logoAuBordDesRues.svg" alt="logoAuBordDesRues"></a>
            
              <select name="LangueNav" id="LangueNav"  class="langues">
                  <option value="-1"><?php echo('LANGUE'); ?><img src="<?=ROOTFRONT?>/front/assets/fleche_bas.svg" alt="fleche_bas"></option>
                  <?php
                  $allLangues = $maLangue->get_AllLangues();
                  
                  if($allLangues){
                    for ($i=0; $i < count($allLangues); $i++){
                        $langue = $allLangues[$i]['numLang'];
                  ?>
                  
                  <option class="allez" value="<?php echo($langue); ?>"> <?=$allLangues[$i]['numPays']; ?> </option>
                  
                  <?php
                  //
                      }
                       // End of foreach
                  }   // if ($result)
                  
                  ?>
              </select>
    
        
                
      

        <a href="<?=ROOTFRONT?>/front/pageArticles.php">articles</a>
        <a href="#">Newsletter</a>
        <a href="<?=ROOTFRONT?>/front/contact.php">Contact</a>
    </nav>

    <div class="connect">
        <?php if(isset($_COOKIE['eMailMemb']) || isset($_COOKIE['pseudoUser'])){?>  <a href="#"><?php if(isset($_COOKIE['pseudoMemb'])){ echo($_COOKIE['pseudoMemb']); } elseif(isset($_COOKIE['pseudoUser'])){ echo($_COOKIE['pseudoUser']); } ?></a> <?php } else{?>
        <a href="<?=ROOTFRONT?>/connexion.php">Connexion</a>
        <?php } if(isset($_COOKIE['eMailMemb']) || isset($_COOKIE['pseudoUser'])){ ?>
        <a class="btn_inscription" href="<?=ROOTFRONT?>/deconnexion.php">Déconnexion</a> <?php } else{ ?>
        <a class="btn_inscription" href="<?=ROOTFRONT?>/inscription.php">Inscription</a>
        <?php } ?>
    </div>
</div>



<script>
    window.onscroll = function() {myFunction()};
var navbar = document.getElementById("navigation");
var sticky = navbar.offsetTop;
function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}

</script>