<?php

require('actions/database.php');

// Vérifier si l'id de la question est bien passé en paramétre dans l'URL
if(isset($_GET['id']) AND !empty($_GET['id'])){

    $idOfQuestion = $_GET['id'];

    // vérifier si la question existe 
    $checkIfQuestionExists = $bdd->prepare('SELECT * FROM questions WHERE id = ?');
    $checkIfQuestionExists->execute(array($idOfQuestion));

    if($checkIfQuestionExists->rowCount() > 0) {        //rowCount permet de calculer le nombre de requete supérieur a 0

        // Récupérer les données de la question 
        $questionInfos = $checkIfQuestionExists->fetch();
        if($questionInfos['id_auteur_question'] == $_SESSION['id']){
            
            $question_title = $questionInfos['titre'];
            $question_description = $questionInfos['description'];
            $question_content = $questionInfos['contenu_question'];

            // permet de supprimer les balises <br> dans le code html
            $question_description = str_replace('<br />', '', $question_description);
            $question_content = str_replace('<br />', '', $question_content);

        }else{
            $errorMsg = "Vous n'êtes pas l'auteur de cette question";
        }

    }else{
        $errorMsg = "Aucune question n'a été trouvée";
    }   

}else{
    $errorMsg = "Aucune question n'a été trouvée";
}
