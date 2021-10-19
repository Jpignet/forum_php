<?php

// Vérifier si l'utilisateur et authentifier sur le site
session_start();
if(!isset($_SESSION['auth'])){
    header('../../login.php');
}

require('../database.php');

// Vérifier si l'id est rentré en paramétre de l'URL
if(isset($_GET['id']) AND !empty($_GET['id'])){

    // L'id de la question en paramétre 
    $idOfTheQuestion = $_GET['id'];

    // Vérifier si la question existe 
    $checkIfQuestionExists = $bdd->prepare('SELECT id_auteur_question FROM questions WHERE id = ?', array($idOfTheQuestion)); // séléctionner toute les données dans notre table question qui posséde l'id rentré par l'utilisateur
    $checkIfQuestionExists->execute(array($idOfTheQuestion));

    if($checkIfQuestionExists->rowCount() > 0){

        // Récupéré les infos de la question 
        $questionInfos = $checkIfQuestionExists->fetch();
        if($questionInfos['id_auteur_question'] == $_SESSION['id']){
            
            // Supprimer la question en fonction de sont id rentré en pramètre
            $deleteThisQuestion = $bdd->prepare('DELETE FROM questions WHERE id = ?');
            $deleteThisQuestion->execute(array($idOfTheQuestion));

            // Rediriger l'utilisateur vers ses questions
            header('Location: ../../my-questions.php');

        }else{
            echo "Vous n'êtes pas l'auteur de cette question. Vous ne pouvez donc pas la supprimer.";
        }

    }else{
        echo "Aucune question n'a été trouvée";
    }

}else{
    echo "Aucune question n'a été trouvée";
}