<?php
require('actions/database.php');

// Récupérer les question par defaut sans la recherche
$getAllMyQuestions = $bdd->prepare('SELECT id, titre, id_auteur_question, description FROM questions WHERE id_auteur_question = ? ORDER BY id DESC');
$getAllMyQuestions->execute(array($_SESSION['id']));

if(isset($_GET['search']) AND !empty($_GET['search'])) {

    $usersSearch = $_GET['search'];

    $getAllMyQuestions = $bdd->query('SELECT id, id_auteur_question, titre, description, pseudo_auteur_question, date_publication_question, heure_publication_question FROM questions WHERE titre LIKE "%'.$usersSearch.'%" ORDER BY id DESC');
    
    if($getAllMyQuestions->rowCount() == 0) {
        $errorMsg ="Aucune question ne correpond à votre recherche";
    }
}
