<?php

require('actions/database.php');

// Vérifier si l'id de la question est rentrée dans l'URL
if(isset($_GET['idquestion']) AND !empty($_GET['idquestion'])){
    
    // Récupérer l'id de la question 
    $idOfTheQuestion = $_GET['idquestion'];
    $checkIfQuestionExists = $bdd->prepare('SELECT * FROM questions WHERE id = ?');
    $checkIfQuestionExists->execute(array($idOfTheQuestion));

    if($checkIfQuestionExists->rowCount() > 0) {
        
        // Récupére toutes les datas de la questions 
        $questionInfos = $checkIfQuestionExists->fetch();

        //Stocker les datas de la question dans des variables propres
        $question_title = $questionInfos['titre'];
        $question_content = $questionInfos['contenu_question'];
        $question_id_author = $questionInfos['id_auteur_question'];
        $question_pseudo_author = $questionInfos['pseudo_auteur_question'];
        $question_publication_date = $questionInfos['date_publication_question'];
        $question_publication_heure = $questionInfos['heure_publication_question'];



    }else{
        $errorMsg = "Aucune question n'a été troubé";
    }

}else{
    $errorMsg = "Aucune question n'a été trouvé";
}