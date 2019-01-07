<?php
$bdd = new PDO('mysql:host=localhost;dbname=pbp;charset=utf8', 'root', '');

// On récupère la liste des agences
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
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
              <input type="email" class="form-control" placeholder="email" name="email" required />
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Mot de passe</label>
            <div class="col-sm-9">
              <input type="password" class="form-control" placeholder="mot de passe" name="password" required />
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Type</label>
            <div class="col-sm-9">
              <select class="form-control" name="type">
                <option>PARTICULIER</option>
                <option>PROFESSIONNEL</option>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Nom</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" placeholder="nom" name="nom" required />
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Prenom</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" placeholder="prenom" name="prenom" required />
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Adresse Postale</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" placeholder="1 rue de ..., VILLE, CODE_POSTAL" name="adresse" required />
            </div>
          </div>


          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Date naissance</label>
            <div class="col-sm-9">
              <input id="datepicker" type="text" class="form-control" placeholder="2000-01-01" name="date_naissance" required />
              <script>
                $('#datepicker').datepicker({
                    format: 'yyyy-mm-dd',
                    uiLibrary: 'bootstrap4'
                });
            </script>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Telephone</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" placeholder="telephone" name="telephone" required />
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Agence</label>
            <div class="col-sm-9">
              <select class="form-control" name="agence">
                <?php
              // On ajoute chaque agence comme option
              foreach ($agences as $iter) {
                  echo '<option value='.$iter->id_agence.'>' . $iter->description . '</option>';
              }
              ?>
              </select>
            </div>
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