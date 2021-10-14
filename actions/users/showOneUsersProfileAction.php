<?php

require('actions/database.php');

// Récupérer l'id de l'utilisateur
if(isset($_GET['id']) AND !empty($_GET['id'])){

    // Id de l'utilisateur
    $idOfUser = $_GET['id'];

    // Vérifier si l'utilisateur existe
    $checkIfUserExists = $bdd->prepare('SELECT pseudo, nom, prenom, date_inscription FROM users WHERE id = ?');
    $checkIfUserExists->execute(array($idOfUser));

    if($checkIfUserExists->rowCount() > 0){
        
        // Récupérer toutes les données de l'utilisateur
        $usersInfos = $checkIfUserExists->fetch();

        $user_pseudo = $usersInfos['pseudo'];
        $user_lastname = $usersInfos['nom'];
        $user_firstname = $usersInfos['prenom'];
        $user_date_inscription = $usersInfos['date_inscription'];

        // Récupérer toutes les questions publié par l'utilisateur
        $getHisQuestions = $bdd->prepare('SELECT * FROM questions WHERE id_auteur = ? ORDER BY id DESC');
        $getHisQuestions->execute(array($idOfUser));

    }else{
        $errorMsg="Aucun utilisateur trouvé";
    }

}else{

    $errorMsg="Aucun utilisateur trouvé";

}