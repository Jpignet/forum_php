<?php
try{
    $bdd = new PDO( 'mysql:host=localhost;dbname=forum;charset=UTF8', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(Exception $e){
    die('Une erreur a été trouvé : ' . $e->getMessage());
}
