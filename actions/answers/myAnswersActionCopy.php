<?php
require('actions/database.php');

// Vérifier si l'id de la question est rentrée dans l'URL
if(isset($_GET['id']) AND !empty($_GET['id'])){

    // Id de l'utilisateur
    $idOfAnswerUser = $_GET['id'];


    // Récupérer les question par defaut sans la recherche
    $getAllMyAnswers = $bdd->prepare('SELECT questions.id, questions.titre, questions.contenu_question, questions.date_publication_question, questions.pseudo_auteur_question, answers.id_question, answers.contenu_answer, answers.date_publication_reponse, answers.id_auteur_answer 
                                        FROM questions, answers 
                                            WHERE questions.id = answers.id_question 
                                                AND answers.id_auteur_answer = ?');
    $getAllMyAnswers->execute(array($idOfAnswerUser));


    if($getAllMyAnswers->rowCount() > 0) {
        
        // Récupére toutes les datas de la questions 
        $questionInfos = $getAllMyAnswers->fetch();

        //Stocker les datas de la question dans des variables propres
        $question_id = $questionInfos['id'];
        $question_title = $questionInfos['titre'];
        $question_content = $questionInfos['contenu_question'];
        $question_publication_date = $questionInfos['date_publication_question'];
        $question_pseudo_author = $questionInfos['pseudo_auteur_question'];

        $answer_contenu = $questionInfos['contenu_answer'];
        $answer_date_publication_reponse = $questionInfos['date_publication_reponse'];
        $answer_id_auteur = $questionInfos['id_auteur_answer'];

    }else{
        $errorMsg = "Aucune réponse publié";
    }



}