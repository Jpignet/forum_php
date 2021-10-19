<?php

require('actions/database.php');

// récupere les données d'une réponse qui se trouve dans la table ANSWERS qui  posséde comme identifiant de la question point ? 
$getAllAnswersOfThisQuestion = $bdd->prepare('SELECT id_auteur_answer, pseudo_auteur_answer, id_question, contenu_answer, date_publication_reponse, heure_publication_reponse FROM answers WHERE id_question = ? ORDER BY id DESC'); 
$getAllAnswersOfThisQuestion->execute(array($idOfTheQuestion));