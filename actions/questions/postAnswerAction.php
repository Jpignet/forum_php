<?php

require('actions/database.php');

if(isset($_POST['validate'])){

    if(!empty($_POST['answer'])){

        $user_answer = nl2br(htmlspecialchars($_POST['answer']));
        $insert_answer = $bdd->prepare('INSERT INTO answers(id_auteur, pseudo_auteur, id_question, contenu) VALUES (?, ?, ?, ?)');
        $insert_answer->execute(array($_SESSION['id'], $_SESSION['pseudo'], $idOfTheQuestion, $user_answer));

    }

}

