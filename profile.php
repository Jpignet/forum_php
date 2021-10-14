<?php
    session_start(); 
    require('actions/users/showOneUsersProfileAction.php');    
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
            if(isset($getHisQuestions)){

                ?>
                <div class="card">
                    <div class="card-body">
                        <h4>@<?= $user_pseudo; ?></h4>
                        <hr>
                        Nom : <?= $user_lastname; ?><br>
                        Prénom : <?= $user_firstname; ?><br>
                        Inscrit depuis le : <?= $user_date_inscription; ?><br>
                    </div>
                </div>
                <br>
                <?php
                while($question = $getHisQuestions->fetch()){
                    ?>

                        <div class="card">
                            <div class="card-header">
                                <?= $question['titre']; ?>
                            </div>
                            <div class="card-body">
                                <?= $question['description']; ?>
                            </div>
                            <div class="card-footer">
                                <small>Par <?= $question['pseudo_auteur']; ?> le <?= $question['date_publication_question']; ?> à <?= $question['heure_publication_question']; ?></small>
                            </div>
                        </div>
                        <br>
                    <?php
                }

            }
        ?>
    </div>
</body>
</html>