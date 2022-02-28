<?php

// function verifParam(){
//   if(isset($_POST) && sizeof($_POST)>0){ //vérifier qu'il y a bien un formulaire avec des infos
//     foreach ($_POST as $key => $value) {
//       $data = trim($value);
//       $data = stripslashes($data);//traite les antislashes;
//       $data = strip_tags($data);//supprime les balises html et php
//       $data = htmlspecialchars($data);//converti toutes les entitées en html
//       $_POST[key] = $data;
//     }

//   }
// }
function displayAccueil(){
  $result =  '<h1>Bienvenue sur la page d\'Accueil</h1>';
  $result .= '
  <form action="actionInscription" method="post">
      <h2>Inscription</h2>
      <input type="text" name="pseudo" id="" placeholder="Pseudo" required="required" value="Nicolas">
      <input type="text" name="firstname" id="" placeholder="Nom" required="required" value="Prévost">
      <input type="text" name="lastname" id="" placeholder="Prénom" required="required" value="Nicolas">
      <input type="email" name="email" id="" placeholder="Email" required="required"value="nicolas29@tmail.com">
      <input type="phone" name="telephone" id="" placeholder="Téléphone" required="required" value="0606060606">
      <input type="password" name="password" id="" placeholder="Mot de Passe" required="required" value="Nicolas2020">
      <input type="submit" value="S\'inscrire">
  </form>';

  return $result;
}
function displayActionInscription(){
  global  $model;
  $pseudo = $_POST["pseudo"];
  $firstname = $_POST["firstname"];
  $lastname = $_POST["lastname"];
  $email = $_POST["email"];
  $telephone = $_POST["telephone"];
  $password = $_POST["password"];
  
  $data = $model->createCustomers($pseudo, $firstname, $lastname, $telephone, $email, $password);
  if($data){//inscription réussie
    $data_customer = $model->login($email,$password);
      if($data_customer){
        $_SESSION["customer"] = $data_customer;
        return '<p>Inscription réussi '.$pseudo.', vous êtes bien connecté</p>'.displayProduits();
      }
  }else{//inscription échouée
      return '<p>Inscription échoué</p>'.displayProduits();
  }
}
function displayActionConnexion(){
  global  $model;
  $email = $_POST["email"];
  $password = $_POST["password"];
  $pseudo = $_POST["pseudo"];
  $data_customer = $model->login($email,$password);
  if($data_customer){
    $_SESSION["customer"] = $data_customer;
    return '<p>'.$pseudo.'Vous êtes bien connecté</p>'.displayProduits();
  }else{//inscription échouée
    return '<p>Authentification échouée</p>'.displayProduits();
  }
}
function displayDeconnexion(){
  unset($_SESSION["customer"]);
  return '<h1>Vous êtes bien déconnecté!</h1>'.displayProduits();
}
function displayProfil(){
    $result = '
    <ul>
      <li>Bienvenue sur votre profil '.$_SESSION["customer"]["pseudo"].'</li>
      <li>Nom: '.$_SESSION["customer"]["firstname"].'</li>
      <li>Prénom: '.$_SESSION["customer"]["lastname"].'</li>
      <li>Email: '.$_SESSION["customer"]["email"].'</li>
      <li>Adresse: '.$_SESSION["customer"]["adress"].'</li>
    </ul>
    <div>
    <a href="'.BASE_URL.SP."updateProfil".'" class="product-btn">Mettre à jour mes données</a>
    </div>
    
    ';
    return $result;  
}

function displayUpdateProfil(){
  $result = '
  <form  action="updateAction" method="post">
      <h2>Mettre à jour</h2>
      <label id="pseudo">Pseudo</label>
      <input type="text" id="pseudo" name="pseudo"  placeholder="Pseudo"  value="'.$_SESSION["customer"]["pseudo"].'">
      <label id="firstname">Nom</label>
      <input type="text" id="pseudo" name="firstname"  placeholder="Nom"  value="'.$_SESSION["customer"]["firstname"].'">
      <label id="lastname">Prénom</label>
      <input type="text" id="lastname" name="lastname" placeholder="Prénom"  value="'.$_SESSION["customer"]["lastname"].'">
      <label id="adress">Adresse</label>
      <input type="text" id="adress" name="adress"  placeholder="Adresse"  value="'.$_SESSION["customer"]["adress"].'">
      <label id="email">Email</label>
      <input type="email" id="email" name="email" placeholder="Email" value="'.$_SESSION["customer"]["email"].'">
      <label id="telephone">Téléphone</label>
      <input type="phone" id="telephone" name="telephone" placeholder="Téléphone"  value="'.$_SESSION["customer"]["telephone"].'">
      <input type="submit" value="Mettre à jour">
  </form>
  ';

  return $result; 
}
function displayUpdateAction(){
    global $model;
    $_POST["id"] = $_SESSION["customer"]["id"];
    // print_r($_POST["id"]);exit();
    $r = $model->updateInfosCustomers($_POST);//$r = valeur de retour
    if($r){
      $_SESSION["customer"]= $model->getCustomer($_SESSION["customer"]["id"]);
      $result = '<p>Mise à jour réussie</p>';
    }else{
      $result ='<p>Mise à jour échouée</p>';
    }
    return $result.displayProfil();
}
function displayProduits(){
  global $model;
  $dataProducts = $model->getProducts();
  $result = '<h1>Bienvenue sur la page Produits</h1>
  <div class="products">';
  foreach ($dataProducts as $key => $value) {
      $result .= '
      
          <div class="product">
          <img class="image-product" src="'.BASE_URL.SP."images".SP."produits".SP.$value["image"].'" alt="">
            <div class="product-description">
                  <h2 class="product-title">'.$value["name"].'</h2>
                  <p class="product-price">Prix: '.number_format($value["price"],2,',',' ') .' €</p>
                  <div class="product-btn-box">
                      <a href="'.BASE_URL.SP."panier".SP.$value["id"].'" class="product-btn">Mettre au panier</a>
                      <a href="'.BASE_URL.SP."page_produit".SP.$value["id"].'" class="product-btn">Voir le produit</a>
                  </div>
            </div>
          </div>
      ';
  }
  $result .= '</div>';


  return $result;
}

function displayCategorie(){
  global $model;
  global $url;
  global $category;
  $categoryId = $url[1];
  if(isset($categoryId) && is_numeric($categoryId) && $categoryId>0 && $categoryId< sizeof($category)+1){
  // on vérifie s'il y'a une id dans l'url, si c'est numérique si c'est supérieur à zéro et inférieur à la taille du tableau des catégories

  $result = '<h1>Bienvenue sur la Categorie '.$category[$url[1]-1]["name"].' </h1>
  <div class="products">';//va chercher la catégorie dans la variable categorie
  $dataProducts = $model->getProducts(null, $url[1]);//récupère la catgorie dans l'URL
  foreach ($dataProducts as $key => $value) {
    $result .= '
    
        <div class="product">
        <img class="image-product" src="'.BASE_URL.SP."images".SP."produits".SP.$value["image"].'" alt="">
          <div class="product-description">
                <h2 class="product-title">'.$value["name"].'</h2>
                <p class="product-price">Prix: '.number_format($value["price"],2,',',' ') .' €</p>
                <div class="product-btn-box">
                    <a href="'.BASE_URL.SP."panier".SP.$value["id"].'" class="product-btn">Mettre au panier</a>
                    <a href="'.BASE_URL.SP."page_produit".SP.$value["id"].'" class="product-btn">Voir le produit</a>
                </div>
          </div>
        </div>
    ';
  }
    $result .= '</div>';
  }else{
    $result = '<h1> URL incorrect! </h1>';
  }
  return $result;
}
function displayPage_produit(){
  global $model;
  global $url;
  global $category;
  $dataProducts = $model->getProducts(null, null, $url[1]);
  $result = '<h1>'.$dataProducts[0]["name"].'</h1>';
  $result .= '

    <div class="product-box">
        <div class="product-img">
          <img class="image-product" src="'.BASE_URL.SP."images".SP."produits".SP.$dataProducts[0]["image"].'" alt="">
        </div>
        <div class="product-description">
          <p class="product-description-text">'.$dataProducts[0]["description"].'</p>
          <p class="product-description-price">'.number_format($dataProducts[0]["price"],2,',',' ') .' €</p>
          <p class="product-description-category">Catégorie: '.$category[$dataProducts[0]["category_id"]-1]["name"].'</p>
          <div class="product-btn-box">
              <a href="'.BASE_URL.SP."produits".'" class="product-btn">Retour boutique</a>
              <a href="'.BASE_URL.SP."panier".SP.$dataProducts[0]["id"].'" class="product-btn">Mettre au panier</a>
          </div>
        </div>

    </div>

  ';
  return $result;
}
function displayPanier(){
 global $model;
 global $url;
 $dataProducts = $model->getProducts(null, null, $url[1]);
 if (isset( $url[1]) && is_numeric( $url[1])){
   $_SESSION["panier"][] = $dataProducts[0] ;//c'est un tableau qui remplit l'information sur l'id et qui rajoute les éléments sélectionnés à la suite
   header('Location:'.BASE_URL.SP."panier");
 }
 foreach($_SESSION["panier"] as $key => $link) 
 { 
   if($link === null) 
   { 
     unset($_SESSION["panier"][$key]); 
    } 
  } 
  if(sizeof($_SESSION["panier"]) == 0){
    header("Location: ".BASE_URL.SP."produits");
  }

  $result = '
  <h1>Bienvenue sur la page Panier</h1>
  <table>
  <thead>
  <tr>
  <th>#</th>
  <th>Nom du produit</th>
  <th>Description</th>
  <th>Image</th>
  <th>Prix</th>
  <th>Quantité</th>
  <th>Action</th>
  </tr>
  </thead>
  <tbody>
  
  ';
  $total_ht = 0;
  $cart = array_filter($_SESSION["panier"]);
  foreach ( $cart as $key => $value) {
    $total_ht += $value["price"];//additionne au fur et mesure de la boucle
    $result .= '<tr>
    <th>'.$value["id"].'</th>
    <td>'.$value["name"].'</td>
    <td>'.$value["description"].'</td>
    <td><img src="'.BASE_URL.SP."images".SP."produits".SP.$value["image"].'" width="100px"/></td>
    <td>'.number_format($value["price"],2,',',' ').'€</td>
    <td>1</td>
    <td><a href="'.BASE_URL.SP."supprimer".SP.$key.'" class="product-btn">Supprimer</a></td>
    </tr>
    
    ';
    
  }
  $total_tva = $total_ht*TVA/100;
  $total_price = $total_tva + $total_ht ;
  $result .='
  <tr>
  <td></td>
  <td></td>
  <td></td>
  <td>Prix Total (HT)</td>
  <td>'.number_format($total_ht,2,',',' ').'€</td>
  <td></td>
  </tr>
  <tr>
  <td></td>
  <td></td>
  <td></td>
  <td>TVA ('.TVA.'%)</td>
  <td>'.number_format($total_tva,2,',',' ').'€</td>
  <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td>Total(TCC)</td>
    <td>'.number_format($total_price,2,',',' ').'€</td>
    <td></td>
  </tr>
  ';

  $result .= '
  </tbody>
  </table>';

  $result .= '
  <a href="'.BASE_URL.SP."validationCommande".'" class="product-btn">Validation de votre commande</a>
  ';

  return $result;

}
function displaySupprimer(){
  global $url;

  //   //supprimer l'élement selon la clé de $_SESSION et non l'id
  if(isset($url[1]) && is_numeric($url[1])){
    $param = $url[1];
    unset($_SESSION["panier"][$param]);
    header("Location: ".BASE_URL.SP."panier");
  }
}
function displayValidationCommande(){
  global $model;
  if(isset($_SESSION["customer"])){//utilisateur connecté
    $dataCustomer = $_SESSION["customer"];
    foreach ($_SESSION["panier"] as $key => $value) {
      
      $r = $model->createOrders($dataCustomer["id"], $value["id"], 1, $value["price"]); //valeur de retour
      if($r){
      unset($_SESSION["panier"]);
      $result = "Validation de la commande réussie vous passer récupérer en magasin";
    }else{
      return  "Validation de la Commande échouée";
    }

    }
  }else{
    $result = '<p>Connectez-vous pour pouvoir valider votre commande</p>';
    $result .= displayAccueil();
  }
  return $result;
}
?>