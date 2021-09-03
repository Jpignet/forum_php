<?php
session_start();

require('actions/database.php');

// Validation du formulaire
if(isset($_POST['validate'])) {      // isset = vérifier qu'un variable exisite --> ici on véfifie que l'utilisateur clique bien sur le bouton 

    if(!empty($_POST['pseudo']) AND !empty($_POST['lastname']) AND !empty($_POST['firstname']) AND !empty($_POST['password'])) {        // !empty = vérifier que les champs ne sont pas vide

        $user_pseudo = htmlspecialchars($_POST['pseudo']);      // htmlspecialchars --> permet de sécurisé l'injection d'élément
        $user_lastname = htmlspecialchars($_POST['lastname']);
        $user_firstname = htmlspecialchars($_POST['firstname']);
        $user_password = password_hash($_POST['password'], PASSWORD_DEFAULT);        // password_hash permet de crypter le mot de passe dans la base de donnée. il prende deux argument en entré 

        // Vérifier si l'utilisateur existe déja sur le site 
        $checkIfUserAlreadyExists = $bdd->prepare('SELECT pseudo FROM users WHERE pseudo = ?');     // On rechherche le pseudo dans la table User qui a été renseigner pour l'inscription    
        $checkIfUserAlreadyExists->execute(array($user_pseudo));

        if($checkIfUserAlreadyExists->rowCount() == 0) {

            // Insérer l'utilisateur dans la BDD
            $insertUserOnWebsite = $bdd->prepare('INSERT INTO users(pseudo, nom, prenom, mdp) VALUES(?, ?, ?, ?)');     //on insert l'utilisateur sur le site 
            $insertUserOnWebsite->execute(array($user_pseudo, $user_lastname, $user_firstname, $user_password));        // on insert tout les élements renseigné 

            // Récupére les informations de l'utilisateur
            $getInfoOfThisUserReq = $bdd->prepare('SELECT id, pseudo, nom, prenom FROM users WHERE nom = ? AND prenom = ? AND pseudo = ?');      // on récupére l'identifiant de l'utisateur qui posséde le nom / prenom / pseudo renseigner par l'utilisateur 
            $getInfoOfThisUserReq->execute(array($user_lastname, $user_firstname, $user_pseudo));        // on exécute la requéte 

            $usersInfos = $getInfoOfThisUserReq->fetch();

            // Authentifier l'utilisateur sur le site et récupere ses données dans des variables globale session 
            $_SESSION['auth'] = true;
            $_SESSION['id'] = $usersInfos['id'];
            $_SESSION['lastname'] = $usersInfos['nom']; 
            $_SESSION['firstname'] = $usersInfos['prenom'];
            $_SESSION['pseudo'] = $usersInfos['pseudo'];

            // On redirige l'utilisateur vers la page d'acceuil
            header('Location: index.php');

        }else{
            $errorMsg ="L'utilisateur existe déjà sur le site";
        }

    }else{
        $errorMsg ="Veuillez compléter tous champs...";
    }

}