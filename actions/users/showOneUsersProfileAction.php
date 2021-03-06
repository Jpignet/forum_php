<?php

require('actions/database.php');

// Récupérer l'id de l'utilisateur
if(isset($_GET['id']) AND !empty($_GET['id'])){

    // Id de l'utilisateur
    $idOfUser = $_GET['id'];

    // Vérifier si l'utilisateur existe
    $checkIfUserExists = $bdd->prepare('SELECT pseudo, nom, prenom, date_inscription, nombre_question, nombre_reponse FROM users WHERE id = ?');
    $checkIfUserExists->execute(array($idOfUser));

    if($checkIfUserExists->rowCount() > 0){
        
        // Récupérer toutes les données de l'utilisateur
        $usersInfos = $checkIfUserExists->fetch();

        $user_pseudo = $usersInfos['pseudo'];
        $user_lastname = $usersInfos['nom'];
        $user_firstname = $usersInfos['prenom'];
        $user_date_inscription = $usersInfos['date_inscription'];
        $user_nombre_question = $usersInfos['nombre_question'];
        $user_nombre_reponse = $usersInfos['nombre_reponse'];

        // Récupérer toutes les questions publié par l'utilisateur
        $getHisQuestions = $bdd->prepare('SELECT * FROM questions WHERE id_auteur_question = ? ORDER BY id DESC');
        $getHisQuestions->execute(array($idOfUser));

    }else{
        $errorMsg="Aucun utilisateur trouvé";
    }

}else{

    $errorMsg="Aucun utilisateur trouvé";

}