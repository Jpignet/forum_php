<?php

require('actions/database.php');

// Validation du formulaire
if(isset($_POST['validate'])) {      // isset = vérifier qu'un variable exisite --> ici on véfifie que l'utilisateur clique bien sur le bouton 

    if(!empty($_POST['pseudo']) AND !empty($_POST['password'])) {        // !empty = vérifier que les champs ne sont pas vide --> ici on véfifie que l'utilisateur clique bien sur le bouton 

        $user_pseudo = htmlspecialchars($_POST['pseudo']);      // htmlspecialchars --> permet de sécurisé l'injection d'élément
        $user_password = htmlspecialchars($_POST['password']);        // password_hash permet de crypter le mot de passe dans la base de donnée. il prende deux argument en entré 

        // Vérifier si l'utilisateur existe (si le pseudo est correct)
        $checkIfUserExists = $bdd->prepare('SELECT * FROM users WHERE pseudo = ?');
        $checkIfUserExists->execute(array($user_pseudo));

        if($checkIfUserExists->rowCount() > 0) {
            
            // Récupérer les données de l'utilisateur
            $usersInfos = $checkIfUserExists->fetch();

            // Vérifier si le mot de passe est correct
            if(password_verify($user_password, $usersInfos['mdp'])) {

                // Authetifier l'utilisateur sur le site et récupere ses données dans des variables globale session 
                $_SESSION['auth'] = true;
                $_SESSION['id'] = $usersInfos['id'];
                $_SESSION['lastname'] = $usersInfos['nom']; 
                $_SESSION['firstname'] = $usersInfos['prenom'];
                $_SESSION['pseudo'] = $usersInfos['pseudo'];

                // Redirige l'utilisateur vers la page d'acceuil 
                header('Location: index.php');

            }else{
                $errorMsg ="Votre mot de passe est incorect...";
            }

        }else{
            $errorMsg ="Votre pseudo est incorect...";
        }

    }else{
        $errorMsg ="Veuillez compléter tous champs...";
    }

}