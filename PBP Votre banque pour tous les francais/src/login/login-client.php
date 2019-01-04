<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include '../modules/includes.php'?>
        <title>Connexion Client</title>
    </head>

<?php
session_start();

// Accès à la base de données
$bdd = new PDO('mysql:host=localhost;dbname=pbp;charset=utf8', 'root', '');

$var = $bdd->prepare("GRANT ALL PRIVILEGES ON *.* TO 'admin'@'localhost' IDENTIFIED BY 'admin';");
$var->execute();

// Si on a bien reçu les paramètres nécessaires à l'authentification
if (isset($_POST["email"], $_POST["password"])) {
    // Alors on cherche le compte
    $req = $bdd->prepare("SELECT * FROM client WHERE login = :email AND password = :password");
    $req->execute([':email' => $_POST["email"], ':password' => $_POST["password"]]);
    // Si il existe
    if ($req->rowCount() == 1) {
        // On stock le client de base de données dans un cookie de session
        $result = $req->fetch(PDO::FETCH_OBJ);

        $_SESSION['connectedUser'] = $result;
        header('Location: ../client/client.php');

    } else {
        echo "Wrong login informations";
    }
}
?>

<body class="container">
  <div class="d-flex margin-top-20">
    <div class="width-40">
      <div>
        <a href="../../index.html"
          ><img alt="" id="logo" src="../../media/logo.png"
        /></a>
      </div>
      <h2 class="text_salarie" id="text_acces">ACCÈS CLIENT</h2>
    </div>
    <div>
      <div id="login">
        <div id="saisie">
          <h1><i class="fas fa-lock"></i> ACCÈS SÉCURISÉ À VOTRE COMPTE</h1>
          <form id="connexion" method="POST" action="login-client.php">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">@</span>
              </div>
              <input
                type="text"
                class="form-control"
                placeholder="Username"
                name="email"
                required
              />
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">#</span>
              </div>
              <input
                type="password"
                class="form-control"
                placeholder="Password"
                name="password"
                required
              />
            </div>

            <input type="submit" class="btn btn-primary" value="Connexion client" />
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
