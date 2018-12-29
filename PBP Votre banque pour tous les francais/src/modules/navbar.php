<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="client.php">PBP</a>
    <button
      class="navbar-toggler"
      type="button"
      data-toggle="collapse"
      data-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="client.php">Tableau de bord</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="comptes.php">Comptes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="operations.php">Opérations</a>
        </li>
      </ul>

      <ul class="navbar-nav">
        <li class="nav-item dropdown" style="right: 0">
          <a
            class="nav-link dropdown-toggle"
            href="#"
            id="navbarDropdownMenuLink"
            role="button"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
          >
<?php
echo $_SESSION['connectedUser']->nom . ' ' . $_SESSION['connectedUser']->prenom
?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <img class="dropdown-item" src="../../media/avatar-2.png" />
            <span class="dropdown-item">LOREM Ipsum</span>
            <span class="dropdown-item"></span>
            <a class="dropdown-item" href="../modules/logout.php"
              ><button class="btn btn-danger">Deconnexion</button></a
            >
          </div>
        </li>
      </ul>
    </div>
  </nav>
