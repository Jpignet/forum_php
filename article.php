<?php require('actions/questions/showArticleContentAction.php'); ?>
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
                <h3><?= $question_title; ?></h3>
                <hr>
                <p><?= $question_content; ?></p>
                <hr>
                <small>Publié par <?= $question_pseudo_author ?> le <?= $question_publication_date; ?></small>
                <?php
            }
        ?>
    </div>


</body>
</html>