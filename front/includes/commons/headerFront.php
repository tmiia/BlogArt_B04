<link href="style.css" rel="stylesheet">
<?php require_once __DIR__ . '/imports.php'; ?>

<div id="navigation">
    
    <nav>
        <a href="home.php"><img src="../front/assets/logoAuBordDesRues.svg" alt="logoAuBordDesRues"></a>
        <div class="langues">
            <p>FR</p>
            <img src="../front/assets/fleche_bas.svg" alt="fleche_bas">
        </div>

        <a href="../front/pageArticles.php"><p>Articles</p></a>
        <a href="#"><p>Newsletter</p></a>
        <a href="#"><p>Contact</p></a>
    </nav>

    <div class="connect">
        <a href="../connexion.php"><p>Connexion</p></a>
        <a class="btn_inscription" href="../inscription.php"><p>Inscription</p></a>
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