<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <?php include '../modules/includes.php'?>
  <title>Connexion Admin</title>
</head>

<?php
session_start();

// Accès à la base de données
$bdd = new PDO('mysql:host=localhost;dbname=pbp;charset=utf8', 'root', '');

// Si on a bien reçu les paramètres nécessaires à l'authentification
if (isset($_POST["login"], $_POST["password"])) {
    // Alors on cherche le compte
    $req = $bdd->prepare("SELECT * FROM conseiller WHERE login = :login AND password = :password");
    $req->execute([':login' => $_POST["login"], ':password' => $_POST["password"]]);
    // Si il existe
    if ($req->rowCount() == 1) {
        // On stock le client de base de données dans un cookie de session
        $result = $req->fetch(PDO::FETCH_OBJ);

        $result->userType = "CONSEILLER";
        $_SESSION['connectedUser'] = $result;
        header('Location: ../admin/clients.php');
    } else {
      $loginError = "Identification incorrecte";
    }
}
?>

<body class="container access">
  <div class="d-flex margin-top-20">
    <div class="width-40">
      <div>
        <a href="../../index.html"><img alt="" id="logo" src="../../media/logo.png" /></a>
      </div>
    </div>
    <div>
      <div id="login">
        <h1>ACCÈS CONSEILLER</h1>
        <form id="connexion" method="POST" action="login-conseiller.php">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">login</span>
            </div>
            <input type="text" class="form-control" placeholder="Login" name="login" required />
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">#</span>
            </div>
            <input type="password" class="form-control" placeholder="Password" name="password" required />
          </div>

          <div class="login-error">
            <?php if (isset($loginError)) { echo $loginError; }?>
          </div>

          <input type="submit" class="btn btn-primary" value="Connexion Backoffice" />
        </form>
      </div>
    </div>
  </div>
  </div>
</body>

</html>