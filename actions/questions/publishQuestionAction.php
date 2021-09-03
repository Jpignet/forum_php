<?php

require('actions/database.php');

// Valider le formulaire
if(isset($_POST['validate'])) {

    // Vérifier si les champs ne sont pas vide
    if(!empty($_POST['title']) AND !empty($_POST['description']) AND !empty($_POST['content'])) {
 
        // les données de la questions 
        $question_title = htmlspecialchars($_POST['title']);
        $question_desciption = nl2br(htmlspecialchars($_POST['description']));
        $question_content = nl2br(htmlspecialchars($_POST['content']));
        $question_date = date('d/m/Y');
        $question_id_author = $_SESSION['id'];
        $question_pseudo_author = $_SESSION['pseudo'];

        // Insérer la questions su le forum 
        $insertQuestionOnWebsite =$bdd->prepare('INSERT INTO questions(titre, description, contenu, id_auteur, pseudo_auteur, date_publication) VALUES(?, ?, ?, ?, ?, ?)');
        $insertQuestionOnWebsite->execute(
            array(
                $question_title, 
                $question_desciption, 
                $question_content, 
                $question_id_author, 
                $question_pseudo_author, 
                $question_date
            )
        );

        $successMsg = "Votre question a bien été publiée sur le forum";


    }else{
        $errorMsg = "Veuillez compléter tout les champs...";
    }

}
