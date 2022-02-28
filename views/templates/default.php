<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo BASE_URL?>/src/css/style.css">
  <title><?php echo $title ?></title>
</head>
<body>
  <header>
    <div class="topbar">
      <div class="logo">
        <img src="src/images/site/logo.JPG" alt="">
      </div>
      <ul class="topbar-menu">
          <li><a href="<?php echo BASE_URL.SP."accueil" ?>">Accueil</a></li>
          <li><a href="<?php echo BASE_URL.SP."produits" ?>">Produits</a></li>
          <li class="dropdown-menu-box">
            <a class="dropdown-menu" href="#">Catégories</a>
            <ul class="dropdown-menu-list">
              <?php
                  foreach ($category as $key => $value) {
                    echo '<li>
                            <a href="'.BASE_URL.SP."categorie".SP.$value["id"].'">'.$value["name"].'</a>
                          </li>';
                  }
              ?>

            </ul>
          </li>
          <li><a href="<?php echo BASE_URL.SP."panier" ?>">Panier</a></li>
          <?php if(!isset($_SESSION["customer"])): ?>
          <li>
              <form action="actionConnexion" method="post">
                <input type="email" name="email" placeholder="Email" required="required">
                <input type="password" name="password"  placeholder="mot de passe" required="required">
                <button type="submit" >Connexion</button>
              </form>
          </li>
          <li><a href="<?php echo BASE_URL.SP."accueil"?>">Inscription</a></li>
          <?php endif;?>
          <?php if(isset($_SESSION["customer"])): ?>
            <li><a href="<?php echo BASE_URL.SP."profil"?>">Profil</a></li>
            <li><a href="<?php echo BASE_URL.SP."deconnexion"?>">Déconnexion</a></li>
          <?php endif;?>  

      </ul>
    </div>
  </header>
  <main>
    <?php echo $content ?>
  
  </main>



</body>
</html>