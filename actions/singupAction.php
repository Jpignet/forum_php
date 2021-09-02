<?php

require('actions/database.php');

if(isset($_POST['validate'])) {      // isset = vérifier qu'un variable exisite --> ici on véfifie que l'utilisateur clique bien sur le bouton 

    if(!empty($_POST['pseudo']) AND !empty($_POST['lastname']) AND !empty($_POST['firstname']) AND !empty($_POST['password'])) {        // !empty = vérifier que les champs ne sont pas vide --> ici on véfifie que l'utilisateur clique bien sur le bouton 

        $user_pseudo = htmlspecialchars($_POST['pseudo']);      // htmlspecialchars --> permet de sécurisé l'injection d'élément
        $user_lastname = htmlspecialchars($_POST['lastname']);
        $user_firstname = htmlspecialchars($_POST['firstname']);
        $user_password = password_hash($_POST['password'], PASSWORD_DEFAULT);        // password_hash permet de crypter le mot de passe dans la base de donnée. il prende deux argument en entré 

        $checkIfUserAlreadyExists = $bdd->prepare('SELECT pseudo FROM users WHERE pseudo = ?');      // permet de récupérer toute les informations demandé dans la table user 
        $checkIfUserAlreadyExists->execute(array($user_pseudo));

        if($checkIfUserAlreadyExists->rowCount() == 0) {

            $insertUserOnWebsite = $bdd->prepare('INSERT INTO users(pseudo, nom, prenom, mdp) VALUES(?, ?, ?, ?)');     //on insert l'utilisateur sur le site 
            $insertUserOnWebsite->execute(array($user_pseudo, $user_lastname, $user_firstname, $user_password));        // on insert tout les élements renseigné 

        }else{
            $errorMsg ="L'utilisateur existe déjà sur le site";
        }

    }else{
        $errorMsg ="Veuillez compléter tous champs...";
    }

}