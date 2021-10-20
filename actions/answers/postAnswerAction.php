<?php

require('actions/database.php');

if(!empty($_SESSION['id'])){

    if(isset($_POST['validate'])){

        if(!empty($_POST['answer'])){

            $user_answer = nl2br(htmlspecialchars($_POST['answer']));
            $user_date_answer = date('d/m/Y');
            $user_heure_answer = date('H:i:s');
            
            $insert_answer = $bdd->prepare('INSERT INTO answers(id_auteur_answer, pseudo_auteur_answer, id_question, contenu_answer, date_publication_reponse, heure_publication_reponse) VALUES (?, ?, ?, ?, ?, ?)');
            $insert_answer->execute(array($_SESSION['id'], $_SESSION['pseudo'], $idOfTheQuestion, $user_answer, $user_date_answer, $user_heure_answer));

        }

    }
    
}else{
    $errorMsg = "Veuillez vous authentifier"; // rajout pour message d'erreur 
}
