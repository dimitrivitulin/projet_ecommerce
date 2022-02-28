<?php 
session_start();
// verifParam();
require "include.php";

// Stucturer la requête
$url = trim($_SERVER['PATH_INFO'],'/');//retire les espaces vides autour du slash
$url = explode('/',$url);// crée un tableau qui décompose l'url
$route = array("accueil",  "produits", "categorie", "page_produit", "panier", "supprimer", "actionInscription", "profil", "deconnexion", "actionConnexion", "updateProfil", "updateAction", "validationCommande");//les différentes routes

$action = $url[0]; //récupère l'action demandé par l'utilisateur

// Controller
if(!in_array($action,$route)){
  $title = "Page d'Erreur";
  $content = "<h1>URL introuvable !</h1>";//si la route n'est pas dans l'action on met une erreur
}else{
  
  $function ="display".ucwords($action); 
  $title = "Page ".$action;
  $content = $function();
}
require VIEWS.SP."templates".SP."default.php";
?>