<?php

class login{

    //initialisation des variables
    protected $localhost = 'localhost';
    protected $username = 'root';
    protected $password = '';
    protected $bdd = 'login';
    protected $connect;
    //les erreurs sont contenues dans un tableau
    public $errors = array();

    //le constructeur
    function __construct(){
        $this->connect =  new PDO('mysql:host=localhost; dbname=login; port=3308' , $this->username, $this->password);
    
    }


    //controle des données utilisateur
        protected function checkInput($var){
            //htmlspecialchars : Convertit les caractères spéciaux en entités HTML
            $var = htmlspecialchars($var);
            //trim — Supprime les espaces en début et fin de chaîne 
            $var = trim($var);
            //stripslashes — Supprime les antislashs d'une chaîne \..
            $var = stripslashes($var);
            //retourne la variable qui a été filtrée
            return $var;
        }

        public function insertIntoTb($username, $password){
            //variable nom de l'utilisateur
            $username = $this->checkInput($username);
            $password = $this->checkInput($password);
        
            //vérification des erreurs
            if($this->checkErrors($username, $password)) $this->errors =['Afficher le message de succès'];

            //méthode pour l'insertion dans la base de données
            $this->inserBDD($username, $password);

        }

        protected function checkErrors($username, $password){
            //limiter la chaine de caractère à 15
            if(strlen($username) > 15 || strlen($username) < 4){
                //array_push — Empile un ou plusieurs éléments à la fin d'un tableau
                array_push($this->errors , 'Username doit être compris entre 4 et 15 caractères');
                return false;
            }
            //limiter la chaine de caractère à 15
            if(strlen($password) < 4 || strlen($password) > 8){
                //array_push — Empile un ou plusieurs éléments à la fin d'un tableau
                array_push($this->errors , 'Password doit être compris entre 4 et 8 caractères');
                return false;
            }
            return true;
        }

        protected function inserBDD($username, $password){
            $sql = $this->connect->prepare("INSERT INTO user(username , password) VALUES ('".$username."', '".$password."')");

            // On éxecute la requête «$sql»:
            $sql->execute(array(
                'username' => $username,
                'password' => $password
            ));  
                        
        }
}



?>