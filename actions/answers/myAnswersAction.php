<?php
require('actions/database.php');

// Vérifier si l'id de la question est rentrée dans l'URL
if(isset($_GET['id_user']) AND !empty($_GET['id_user'])){

    // Id de l'utilisateur
    $idOfAnswerUser = $_GET['id_user'];

    // Récupérer les question par defaut sans la recherche
    $getAllMyAnswers = $bdd->prepare('SELECT questions.id, questions.id_auteur_question, questions.titre, questions.contenu_question, questions.date_publication_question, questions.pseudo_auteur_question, answers.id_question, answers.contenu_answer, answers.date_publication_reponse, answers.id_auteur_answer 
                                        FROM questions, answers 
                                            WHERE questions.id = answers.id_question 
                                                AND answers.id_auteur_answer = ?
                                                    ORDER BY answers.date_publication_reponse ASC');
    $getAllMyAnswers->execute(
        array(
            $idOfAnswerUser
            )
        );

}