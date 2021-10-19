<?php

require('actions/database.php');

// Récupérer les question par defaut sans la recherche
$getAllQuestions = $bdd->query('SELECT id, id_auteur_question, titre, description, pseudo_auteur_question, date_publication_question, heure_publication_question FROM questions ORDER BY id DESC LIMIT 0,5');

// Vérifier si un recherche a été rentrée par l'utilisateur 
if(isset($_GET['search']) AND !empty($_GET['search'])){

    // La recherche 
    $usersSearch = $_GET['search'];

    // On recherche les SELECT dans la table question dans les titre qui ressemble a notre recherche (recherche de mot clefs dans un titre d'une question ) 
    $getAllQuestions = $bdd->query('SELECT id, id_auteur_question, titre, description, pseudo_auteur_question, date_publication_question, heure_publication_question FROM questions WHERE titre LIKE "%'.$usersSearch.'%" ORDER BY id DESC');
}