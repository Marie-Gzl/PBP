<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include '../modules/includes.php'?>
        <title>Inscription</title>
    </head>

<?php

session_start();

// Accès à la base de données
$bdd = new PDO('mysql:host=localhost;dbname=pbp;charset=utf8', 'root', '');

// On récupère la liste des agences
$reqAgences = $bdd->prepare("SELECT * FROM agence");
$reqAgences->execute();
$agences = $reqAgences->fetchAll(PDO::FETCH_OBJ);

// Si on a reçu les paramètres nécessaires à la création d'un compte
if (isset( $_POST["email"],$_POST["password"], $_POST["type"], $_POST["nom"], $_POST["prenom"], $_POST["adresse"],
    $_POST["date_naissance"], $_POST["telephone"], $_POST["agence"])) {
        // On commence avec la création du client
        $reqInsertClient = $bdd->prepare(
            "INSERT INTO client" .
            "(login, password, `type`, nom, prenom, date_naissance, email, telephone, adresse, id_agence)" .
            "VALUES(:login, :password, :type, :nom, :prenom, :date_naissance, :email, :telephone, :adresse, :agence)");
            
        $result = $reqInsertClient->execute([
            ":login" => $_POST["email"],
            ":password" => $_POST["password"],
            ":type" => $_POST["type"],
            ":nom" => $_POST["nom"],
            ":prenom" => $_POST["prenom"],
            ":email" => $_POST["email"],
            ":adresse" => $_POST["adresse"],
            ":date_naissance" => $_POST["date_naissance"],
            ":telephone" => $_POST["telephone"],
            ":agence" => $_POST["agence"],
        ]);

        // On récupère l'id du client fraîchement créé
        $insertedClientId=$bdd->lastInsertId();


        // Creation du compte cheque courant avec 1000€ offert
        $reqGetMax = $bdd->prepare("SELECT COALESCE(MAX(id_compte), 0) FROM compte where id_agence = :idAgence");
        $reqGetMax->execute([":idAgence" => $_POST["agence"]]);
        $maxAccount = $reqGetMax->fetch();

        foreach ($agences as $iter){
            if ($iter->id_agence == $_POST["agence"]){
                $currentAgence = $iter;
            }
        }

        $cdPays='FR';
        $cleIban='76';
        $cdBanque=$currentAgence->cd_banque;
        $cdGuichet=$currentAgence->cd_guichet;
        $numeroCompte = str_pad($maxAccount[0] + 1 . "", 11, "0", STR_PAD_LEFT);
        $cleRib=str_pad(rand(0, 99) . "", 2, "0", STR_PAD_LEFT);
        $iban=$cdPays . $cleIban . $cdBanque . $cdGuichet . $numeroCompte . $cleRib;

        $reqInsertCompte = $bdd->prepare(
            "INSERT INTO compte" .
            " (`type`, numero_compte, id_client, solde, taux, decouvert, id_agence, cd_pays, cle_rib, cle_iban, iban)" .
            " VALUES(:type, :numero, :idClient, :solde, :taux, :decouvert, :idAgence, :cdPays, :cleRib, :cleIban, :iban)");

        $decouvert = 0;
        $res = $reqInsertCompte->execute([
            ":type" => 'cheque',
            ":numero" => $numeroCompte,
            ":idClient" => $insertedClientId,
            ":solde" => 1000,
            ":taux" => 0,
            ":decouvert" => 1,
            ":idAgence" => $currentAgence->id_agence,
            ":cdPays" => $cdPays,
            ":cleRib" => $cleRib,
            ":cleIban" => $cleIban,
            ":iban" => $iban,
        ]);

        //On log l'utilisateur avec l'objet client en base
        $reqClient = $bdd->prepare("SELECT * FROM client WHERE login = :email AND password = :password");
        $reqClient->execute([':email' => $_POST["email"], ':password' => $_POST["password"]]);
        $result = $reqClient->fetch(PDO::FETCH_OBJ);

        $_SESSION['connectedUser'] = $result;
        header('Location: ../client/client.php');
}


?>

<body class="container">
  <div class="d-flex margin-top-20">
    <div class="width-40">
      <div>
        <a href="../../index.html"><img alt="" id="logo" src="../../media/logo.png" /></a>
      </div>
      <h2 class="text_salarie" id="text_acces">Inscription client</h2>
    </div>

    <div>
      <form method="POST" action="./inscription.php">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">Email</span>
          </div>
          <input type="email" class="form-control" placeholder="email" name="email" required />
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">Mot de passe</span>
          </div>
          <input type="password" class="form-control" placeholder="mot de passe" name="password" required />
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">Type</span>
          </div>
          <select class="form-control" name="type">
            <option>PARTICULIER</option>
            <option>PROFESSIONNEL</option>
          </select>
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">Nom</span>
          </div>
          <input type="text" class="form-control" placeholder="nom" name="nom" required />
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">Prenom</span>
          </div>
          <input type="text" class="form-control" placeholder="prenom" name="prenom" required />
        </div>


        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">Adresse Postale</span>
          </div>
          <input type="text" class="form-control" placeholder="1 rue de ..., VILLE, CODE_POSTAL" name="adresse" required />
        </div>


        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">Date naissance</span>
          </div>
          <input id="datepicker" type="text" class="form-control" placeholder="2000-01-01" name="date_naissance" required />
          <script>
            $('#datepicker').datepicker({
                  format: 'yyyy-mm-dd',
                  uiLibrary: 'bootstrap4'
              });
          </script>
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">Telephone</span>
          </div>
          <input type="text" class="form-control" placeholder="telephone" name="telephone" required />
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">Agence</span>
          </div>
          <select class="form-control" name="agence">
            <?php
            foreach ($agences as $iter) {
                echo '<option value='.$iter->id_agence.'>' . $iter->description . '</option>';
            }
            ?>
          </select>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>

      </form>
    </div>

  </div>
  </div>
</body>