<?php
try{
    // Connexion à la base
    $db = new PDO('mysql:host=localhost;dbname=pfa;port=3306', 'root','clubafricain');
    $db->exec('SET NAMES "UTF8"');
} catch (PDOException $e){
    echo 'Erreur : '. $e->getMessage();
    die();
}