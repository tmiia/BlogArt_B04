<link href="style.css" rel="stylesheet">
<?php require_once __DIR__ . '/imports.php'; 
require_once __DIR__ . '/../../../connect/config.php';
require_once __DIR__ . '/../../../class_crud/langue.class.php';
$maLangue = new langue();
?>

<div id="navigation">
    
    <nav>
        <a href="<?=$_SERVER['DOCUMENT_ROOT']?>/index.php"><img src="<?=$_SERVER['DOCUMENT_ROOT']?>/front/assets/logoAuBordDesRues.svg" alt="logoAuBordDesRues"></a>
            
              <select name="LangueNav" id="LangueNav"  class="langues">
                  <option value="-1"><?php echo('LANGUE'); ?><img src="<?=$_SERVER['DOCUMENT_ROOT']?>/front/assets/fleche_bas.svg" alt="fleche_bas"></option>
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
    
        
                
      

        <a href="<?=$_SERVER['DOCUMENT_ROOT']?>/front/pageArticles.php">articles</a>
        <a href="#">Newsletter</a>
        <a href="<?=$_SERVER['DOCUMENT_ROOT']?>/front/contact.php">Contact</a>
    </nav>

    <div class="connect">
        <?php if(isset($_COOKIE['eMailMemb']) || isset($_COOKIE['pseudoUser'])){?>  <a href="#"><?php if(isset($_COOKIE['pseudoMemb'])){ echo($_COOKIE['pseudoMemb']); } elseif(isset($_COOKIE['pseudoUser'])){ echo($_COOKIE['pseudoUser']); } ?></a> <?php } else{?>
        <a href="<?=$_SERVER['DOCUMENT_ROOT']?>/connexion.php">Connexion</a>
        <?php } if(isset($_COOKIE['eMailMemb']) || isset($_COOKIE['pseudoUser'])){ ?>
        <a class="btn_inscription" href="<?=$_SERVER['DOCUMENT_ROOT']?>/deconnexion.php">Déconnexion</a> <?php } else{ ?>
        <a class="btn_inscription" href="<?=$_SERVER['DOCUMENT_ROOT']?>/inscription.php">Inscription</a>
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