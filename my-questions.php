<?php
    require('actions/users/securityAction.php');
    require('actions/questions/myQuestionsAction.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php'; ?>
<body>
    <?php include 'includes/navbar.php'; ?>
    
    <br><br>

    <div class="container">
        

        <form method="GET">

            <div class="form-group row">
                <div class="col-8">
                    <input type="search" name="search"  placeholder="Mot(s) clé(s)" class="form-control">
                </div>
                <div class="col-4">
                    <button class="btn btn-success" type="submit">Rechercher</button>
                </div>
            </div>
        </form>
        
        <br><br>

        <?php
            if(isset($errorMsg)) {
                echo '<p>'.$errorMsg.'</p>';    
            }elseif(isset($successMsg)){
                echo '<p>'.$successMsg.'</p>';
            }
        ?>

        <?php
            while($question = $getAllMyQuestions->fetch()){
                ?>

                <div class="card">
                    <h5 class="card-header">
                        <a href="article.php?id=<?php echo $question['id']; ?>">
                            <?php echo $question['titre']; ?>
                        </a>
                    </h5>
                    <div class="card-body">
                        <p class="card-text">
                            <?php echo $question['description']; ?>
                        </p>
                        <a href="article.php?id=<?php echo $question['id']; ?>"" class="btn btn-primary">Accéder à la question</a>
                        <a href="edit-question.php?id=<?php echo $question['id']; ?>" class="btn btn-warning">Modifier la question</a>      <!-- clic sur bouton -> renvoi vers l'id en question  --> 
                        <a href="actions/questions/deleteQuestionAction.php?id_user=<?php echo $question['id_auteur_question']; ?>&amp;id=<?php echo $question['id']; ?>" class="btn btn-danger">Supprimer la question</a>      <!-- &amp permet de concaténer plusieur élement dans l'URL  --> 
                    </div>
                </div>
                <br>

                <?php
            }
        ?>

    </div>
</body>
</html>