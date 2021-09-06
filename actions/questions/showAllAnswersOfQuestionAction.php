<?php

require('actions/database.php');

// récupere les données d'une réponse qui se trouve dans la table ANSWERS qui  posséde comme identifiant de la question point ? 
$getAllAnswersOfThisQuestion = $bdd->prepare('SELECT id_auteur, pseudo_auteur, id_question, contenu FROM answers WHERE id_question = ? ORDER BY id DESC'); 
$getAllAnswersOfThisQuestion->execute(array($idOfTheQuestion));