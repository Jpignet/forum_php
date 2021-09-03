<?php

require('actions/database.php');

// Validation du formulaire
if(isset($_POST['validate'])){

    // Vérifier si les champs sont remplie
    if(!empty($_POST['title']) AND !empty($_POST['description']) AND !empty($_POST['content'])){

        // Les données a faire passer dans la requête 
        $new_question_title = htmlspecialchars($_POST['title']);
        $new_question_description = nl2br(htmlspecialchars($_POST['description']));
        $new_question_content = nl2br(htmlspecialchars($_POST['content']));

        // Modifier les informations de la question qui posséde l'id rentré en paramétre dans l'URL
        $editQuestionOnWebite = $bdd->prepare('UPDATE questions SET titre = ?, description = ?, contenu = ? WHERE id = ?');    // met a jour la table question. met a our le titre le contenu la description qui posséde cette identifiant 
        $editQuestionOnWebite->execute(array($new_question_title, $new_question_description, $new_question_content, $idOfQuestion));

        // redirection vers la page d'affichage des question de l'utilisateur 
        header('Location: my-questions.php');

    }else{
        $errorMsg = "Veuillez compléter tous les champs...";
    }

}