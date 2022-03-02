<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nous contacter</title>
</head>
<body>


    <?php
    require_once ROOT . 'front/includes/commons/headerFront.php';
    // require_once ROOT . '/includes/commons/navigationFront.php';
    require_once ROOT . 'front/includes/commons/imports.php';

    ?>

    <div id="contact_page">
        
    <h3><span>Nous contacter</span></h3>

        <form id="contact-mail" class="contact-mail-form" method="post" action="contact-form-process.php">
              
              <div class="form_top">
                <div>
                    <label for="Prenom">Prénom</label>
                    <input type="text" id="prenom" name="prenom" class="form-control" required="">
                </div>

                <div>
                    <label for="Nom">Nom</label>
                    <input type="text" id="nom" name="nom" class="form-control" required="">
                </div>
              </div>

              <div>
                  <label for="Email">Email</label>
                  <input type="email" id="Email" name="Email" class="form-control" required="">
              </div>
          
              <div>
                  <label for="Message">Message</label>
                  <textarea id="Message" name="Message" class="form-control" style="height:20vh" maxlength="3000" required=""></textarea>
              </div>
          
              <input type="submit" value="Envoyer" id="btn_submit">
          </form>

    </div>
    
    <?php
    require_once __DIR__ . 'front/includes/commons/footerFront.php';
    ?>
    
</body>
</html>