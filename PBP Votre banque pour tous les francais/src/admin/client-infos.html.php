<div>
    <h3>Fiche client :
      <?php echo $client->nom . ' ' . $client->prenom; ?>
    </h3>

    <form method="POST" action="./client.php?client=<?php echo $idClient ?>">
      <input hidden name="dbObject" value="client" />

      <div class="d-flex justify-content-around">
        <div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Email</span>
            </div>
            <input type="email" class="form-control" placeholder="email" name="email" required value="<?php echo $client->email ?>" />
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Mot de passe</span>
            </div>
            <input type="password" class="form-control" placeholder="mot de passe" name="password" required value="<?php echo $client->password ?>" />
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Nom</span>
            </div>
            <input type="text" class="form-control" placeholder="nom" name="nom" required value="<?php echo $client->nom ?>" />
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Prenom</span>
            </div>
            <input type="text" class="form-control" placeholder="prenom" name="prenom" required value="<?php echo $client->prenom ?>" />
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Date naissance</span>
            </div>
            <input id="datepicker" type="text" class="form-control" placeholder="2000-01-01" name="date_naissance" value="<?php echo $client->date_naissance ?>" required />
            <script>
              $('#datepicker').datepicker({
                      format: 'yyyy-mm-dd',
                      uiLibrary: 'bootstrap4'
                  });
              </script>
          </div>
        </div>

        <div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Type</span>
            </div>
            <select class="form-control" name="type">
              <option <?php echo ($client->type) == "PROFESSIONNEL" ? 'selected' : '' ?>>PARTICULIER</option>
              <option <?php echo ($client->type) == "PROFESSIONNEL" ? 'selected' : '' ?>>PROFESSIONNEL</option>
            </select>
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Adresse Postale</span>
            </div>
            <input type="text" class="form-control" placeholder="1 rue de ..., VILLE, CODE_POSTAL" name="adresse" required value="<?php echo $client->adresse ?>" />
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Telephone</span>
            </div>
            <input type="text" class="form-control" placeholder="telephone" name="telephone" required value="<?php echo $client->telephone ?>" />
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Agence</span>
            </div>
            <select class="form-control" name="agence">
              <?php
foreach ($agences as $iter) {
    if ($iter->id_agence == $client->id_agence) {
        echo '<option selected value=' . $iter->id_agence . '>' . $iter->description . '</option>';

    } else {
        echo '<option value=' . $iter->id_agence . '>' . $iter->description . '</option>';
    }
}
?>
            </select>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <div id="editDiv">
          <button type="button" onclick="show('confirmDiv', 'editDiv')" class="btn btn-primary">edit</button>
        </div>
        <div id="confirmDiv" style="display: none">
          <button type="button" class="btn btn-secondary" onclick="show('editDiv', 'confirmDiv')" data-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>

        <script>
          function show(idShow, idHide){
              var divShow = document.getElementById(idShow);
              var divHide = document.getElementById(idHide);
              divShow.style.display = "block";
              divHide.style.display = "none";
            }
          </script>
      </div>

    </form>
  </div>

