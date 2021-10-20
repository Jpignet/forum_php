<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Forum</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
          <a class="nav-link" href="login.php">Connexion</a>
        </li>  
      <li class="nav-item">
          <a class="nav-link" href="index.php">Les questions</a>
        </li>
        <?php
          if(isset($_SESSION['auth'])){
            ?>
        <li class="nav-item">
          <a class="nav-link" href="publish-question.php?id_user=<?= $_SESSION['id']; ?>">Publier une question</a>
        </li>
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Mon Compte
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="profile.php?id=<?= $_SESSION['id']; ?>">Mon Profil</a></li>
            <li><a class="dropdown-item" href="my-questions.php?id_user=<?= $_SESSION['id']; ?>">Mes questions</a></li>
            <li><a class="dropdown-item" href="my-answers?id=<?= $_SESSION['id']; ?>">Mes réponses</a></li>
          </ul>
        </li>
          <li class="nav-item">
            <a class="nav-link" href="actions/users/logoutAction.php">Déconnexion</a>
          </li>
          <?php
          }
        ?>
      </ul>
    </div>
  </div>
</nav>