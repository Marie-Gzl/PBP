<?php
$bdd = new PDO('mysql:host=localhost;dbname=pbp;charset=utf8', 'root', '');

$reqAgences = $bdd->prepare("SELECT * FROM agence");
$reqAgences->execute();
$agences = $reqAgences->fetchAll(PDO::FETCH_OBJ);
?>

<!-- Modal -->
<div class="modal fade" id="addClient" tabindex="-1" role="dialog" aria-labelledby="addClient" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajout Client</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="./clients.php">
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

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
      </div>

      </form>

    </div>
  </div>
</div>