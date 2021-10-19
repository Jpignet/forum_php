<?php 
    session_start();
    require('actions/questions/showArticleContentAction.php');
    require('actions/answers/postAnswerAction.php');
    require('actions/answers/showAllAnswersOfQuestionAction.php')
    ?>

<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php'; ?>
<body>
    <?php include 'includes/navbar.php'; ?>
    <br><br>

    <div class="container">

        <?php
            if(isset($errorMsg)){ echo $errorMsg; }
            if(isset($question_publication_date)){
                ?>
                <section class="show_content">
                    <h3><?= $question_title; ?></h3>
                    <hr>
                    <p><?= $question_content; ?></p>
                    <hr>
                    <small>Par <?= '<a href="profile.php?id='.$question_id_author.'">'.$question_pseudo_author . '</a> '?> le <?= $question_publication_date; ?> à <?= $question_publication_heure; ?></small>
                </section>
                <br>
                <section class="show-answers">
                    <form class="form-group" method="POST">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Réponse :</label>
                            <textarea name="answer" class="form-control"></textarea>
                            <br>
                            <button class="btn btn-primary" type="submit" name="validate">Répondre</button>
                        </div>                           
                    </form>

                    <?php
                        while($answer = $getAllAnswersOfThisQuestion->fetch()){
                            ?>
                            <div class="card">
                                <div class="card-header">
                                    Réponse de <a href="profile.php?id=<?= $answer['id_auteur_answer']; ?>"><?= $answer['pseudo_auteur_answer']; ?></a> le <?= $answer['date_publication_reponse']; ?> à <?= $answer['heure_publication_reponse']; ?>
                                </div>
                                <div class="card-body">
                                    <?= $answer['contenu_answer']; ?>
                                </div>
                            </div>
                            <br>
                            <?php
                        }
                    ?>

                </section>

                <?php
            }
        ?>
    </div>


</body>
</html>