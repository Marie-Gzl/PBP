<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="clients.php">PBP Backoffice</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="clients.php">Clients</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="agences.php">Agences</a>
      </li>
    </ul>

    <ul class="navbar-nav">
      <li class="nav-item dropdown" style="right: 0">
        <a class="nav-link" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php
echo $_SESSION['connectedUser']->login
?>
        </a>
      </li>
      <a href="../modules/logout.php"><button class="btn btn-danger">Deconnexion</button></a>
    </ul>
  </div>
</nav>