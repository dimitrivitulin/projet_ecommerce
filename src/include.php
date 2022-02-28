<?php

// print_r($_SERVER[REQUEST_URI]);exit();
define ("SRC", dirname(__FILE__));//renvoie au fichier dans lequel on est
define ("ROOT", dirname(SRC));//renvoie à la racine du projet
define ("SP", DIRECTORY_SEPARATOR);//créé le séparateur à l'aide d'une fonction php
define ("CONFIG",ROOT.SP."config");
define ("VIEWS",ROOT.SP."views");
define ("MODEL", ROOT.SP."model");
define ("BASE_URL",dirname(dirname($_SERVER['SCRIPT_NAME'])));
define ("TVA", 20);

//import du model

require CONFIG.SP."config.php";//import du fichier de connexion à la base de données
require MODEL.SP."DataLayer.class.php";

$model = new DataLayer();
$category = $model->getCategory();



// les fonctions appelées par le controller
require "functions.php";


?>
