<?php
//1- Connexion à notre BDD
$pdo = new PDO(
    "mysql:host=localhost;dbname=divani","root","",
    array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, //emet un avertissement sur les erreurs sql
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' //Utilise l'encodage utf8 lors des échanges avec la BDD 
    )
);
// var_dump($pdo);


//2-Déclarer une variable qui va afficher les messages
$content = '';
$content2 = '';

//Démarrer une SESSION
session_start();

//Fichier fonction qu'on inclut ici
require_once 'function.php';

define('URL', 'http://localhost/php/divani/');
define('RACINE', $_SERVER['DOCUMENT_ROOT'].'/php/divani/');

// define('RACINE',$_SERVER['DOCUMENT_ROOT'].'/php/projetboutique/');

?>