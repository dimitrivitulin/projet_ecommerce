<?php

class DataLayer{

    private $connexion;

    function __construct(){
        try {
          $this->connexion = new PDO ("mysql:host=".HOST.";dbname=".DB_NAME,DB_USER,DB_PASSWORD);
          // echo "connexion à la base de données réussie";
        } catch (PDOException $th) {
          echo $th->getMessage();
        }
    }
    

/**
 * CRÉATION D'UN CLIENT EN BASE DE DONNÉES
 * fonction qui crée un client en base de données
 * @param sexe le genre du client
 * @param pseudo le pseudo du client
 * @param firstname le prénom du client
 * @param lastname le nom du client
 * @param telephone le téléphone du client
 * @param email l'email du client
 * @param password le mot de passe du client
 * @return TRUE en cas de création avec succèd d'un client
 * @return FALSE en cas d'échec de la création du client
 * @return NULL en cas d'échec de la création du client
 */

    function createCustomers($pseudo, $firstname, $lastname, $telephone, $email, $password){
        $sql = "INSERT INTO customers (pseudo, firstname, lastname, telephone, email, password) VALUES(:pseudo, :firstname, :lastname, :telephone, :email, :password)";
        try {
            $result  = $this->connexion->prepare($sql);
            $var = $result ->execute(array(
              ':pseudo' => $pseudo,
              ':firstname' => $firstname,
              ':lastname' => $lastname,
              ':telephone' => $telephone,
              ':email' => $email,//Unique en base de données
              ':password' =>sha1($password) //hachage du mot de passe
            ));
            // Si la connexion échoue erreur sinon ok
            if ($var) {
                return TRUE;
            }else{
                return FALSE;
              }
        } catch (PDOException $th) {
          return NULL;
        }
        
    }


/**
 * AUTHENTICATION D'UN CLIENT 
 * fonction qui vérifie l'email et le mot de passe du client
 * @param email l'email du client
 * @param password le mot de passe du client
 * @return TRUE en cas de la vérification avec succèd d'un client
 * @return FALSE en cas d'échec de la vérification du client
 * @return NULL en cas d'échec de la vérification du client
 */
    function login($email, $password){
        $sql = "SELECT *  FROM customers WHERE email = :email";
        try {
            $result = $this->connexion->prepare($sql);
            $result->execute(array(':email'=>$email));
            $data = $result->fetch(PDO::FETCH_ASSOC);
            
            // on vérifie si le mot de passe rentré par le client est le mêmme en BDD sinon erreur
            if($data && ($data['password'] == sha1($password))){
              unset($data['password']);//détruit le mot de passe dans le tableau à renvoyer pour des raisons de sécurité 
              return $data;
            }else{
                return FALSE;
            }
        } catch (PDOException $th) {
            return NULL;
        }
       
    }

    /**
 * CRÉATION d'UNE NOUVELLE COMMANDE
 * fonction qui créé une nouvelle commande
 * @param id_customers identification du client
 * @param id_product identifiant du produit de la commande
 * @param quantity nombre de produit commandé
 * @param price prix de la commande
 * @return TRUE si la commande est réalisée avec succès
 * @return FALSE si la commande a échouée
 * @return NULL en cas d'exception déclenchée
 */
    function createOrders($id_customers, $id_product, $quantity, $price){

        $sql = "INSERT INTO orders (id_customers, id_product, quantity, price) 
              VALUES (:id_customers, :id_product, :quantity, :price)";
        try{
            $result = $this->connexion->prepare($sql);
            $var = $result->execute(array(
              ':id_customers' => $id_customers,
              ':id_product' => $id_product,
              ':quantity' => $quantity,
              ':price' => $price
            ));
            if($var){
              return TRUE;
            }else{
                return FALSE;  
            }
          }catch (PDOException $th) {
              return NULL;
          } 
        
    }


// mettre à jours les informations du client
    function updateInfosCustomers($newInfos ){
        $sql = "UPDATE customers SET";//les infos changent en fonctions des informations du tableau

        try {
            foreach($newInfos as $key => $value){
              //mis à jour des différentes clés du tableau
            $sql .= " $key = '$value' ,"; //on définie la clé et la valeur des éléments à mettre à jour en base de données
            }
            $sql = substr($sql,0,-1);//enlève la dernière virgule
            $sql .= "WHERE id = :id"; //mis à jour par rapport à l'id
            $result = $this->connexion->prepare($sql);
            $var = $result->execute(array('id'=>$newInfos['id']));//exécute d'après l'identifiant demandé dans le tableau
            if($var){
                return TRUE;
            }else{
                return FALSE;  
          }
        } catch (PDOException $th) {
          return NULL;
      }
    }

       /**
 * CRÉATION d'UNE NOUVELLE COMMANDE
 * fonction qui créé une nouvelle commande
 * @param id identification du client
 * @return array tableau contenant l'utilisateur
 * @return NULL en cas d'exception déclenchée
 */
    function getCustomer($id){
      $sql = "SELECT * FROM customers WHERE id = ?";
      try {
        $result = $this->connexion->prepare($sql);
        $var = $result->execute(array($id));
        $data =$result->fetchAll(PDO::FETCH_ASSOC);
        if($data){
          unset($data[0]['password']);
          return $data[0];
        }else{
            return FALSE;  
        }
        
      }catch (PDOException $th) {
          return NULL;
      }    
    }
// Donne accès à toutes les catégories
    function getCategory(){
      $sql = "SELECT * FROM category";
      try {
        $result = $this->connexion->prepare($sql);
        $var = $result->execute();
        $data =$result->fetchAll(PDO::FETCH_ASSOC);
        if($data){
          return $data;
        }else{
            return FALSE;  
        }
        
      }catch (PDOException $th) {
          return NULL;
      }    
    }
// Donne accès à tous les produits
    function getProducts($limit = NULL, $category = NULL, $id = NULL){
      //limite le nb de produits à retourner & permet de choisir des produits par rapport à une categorie
      $sql = "SELECT * FROM product";
      try {
        if (!is_null($id)) {
          $sql .= ' WHERE id= '.$id;
        } //selectionne un produit d'après son id
        if (!is_null($category)) {
          $sql .= ' WHERE category_id = '.$category;
        }
        if (!is_null($limit)) {
            $sql .= ' LIMIT '.$limit;
        }

        $result = $this->connexion->prepare($sql);
        $var = $result->execute();
        $data =$result->fetchAll(PDO::FETCH_ASSOC);
        if($data){
          return $data;
        }else{
            return FALSE;  
        }
        
      }catch (PDOException $th) {
          return NULL;
      }    
    }
}


?>