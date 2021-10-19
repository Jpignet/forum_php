<?php
    require('actions/users/securityAction.php');
    require('actions/answers/myAnswersAction.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php'; ?>
<body>
    <?php include 'includes/navbar.php'; ?>

    <br><br>

    <?php
        while($question = $getAllMyAnswers->fetch()) {
            ?>

                <div class="container">
                    <div class="card">
                        <div class="card-header">
                            <div class="container">
                                <strong>Question de <a href="profile.php?id=<?= $question['id_auteur_question']; ?>">
                                    @<?= $question['pseudo_auteur_question']; ?></a>
                                    , le <?= $question['date_publication_question']; ?>
                                </strong>
                                <br><br>
                                <div class="card">
                                    <div class="card-header">
                                        <i>Titre : </i><?php echo $question['titre']; ?>
                                    </div>
                                    <div class="card-body">
                                        <i>Contenu : </i><?php echo $question['contenu_question']; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <strong>
                                    Ma réponse, le <?= $question['date_publication_reponse']; ?>
                                </strong>
                                <br><br>
                                <div class="card">
                                    <?php echo $question['contenu_answer']; ?>   
                                </div>
                                <br>
                                <a href="article.php?id=<?php echo $question['id']; ?>" class="btn btn-primary">Go Topic</a>
                            </div>
                        </div>
                    </div>
                    <br><br>
                </div>
            <?php
        }
    ?>

        <br><br>
   
</body>
</html>