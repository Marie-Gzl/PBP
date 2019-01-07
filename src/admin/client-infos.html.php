<h3 class="card-header text-center">Fiche client :
  <?php echo $client->nom . ' ' . $client->prenom; ?>
</h3>

<form class="card-body" method="POST" action="./client.php?client=<?php echo $idClient ?>">
  <input hidden name="dbObject" value="client" />

  <div class="form-group row">
    <div class="col-sm-6">
      <div class="form-group row">
        <label class="col-sm-3 col-form-label">Email</label>
        <div class="col-sm-9">
          <input type="email" class="form-control" placeholder="email" name="email" required value="<?php echo $client->email ?>" />
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-3 col-form-label">Mot de passe</label>
        <div class="col-sm-9">
          <input type="password" class="form-control" placeholder="mot de passe" name="password" required value="<?php echo $client->password ?>" />
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-3 col-form-label">Nom</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" placeholder="nom" name="nom" required value="<?php echo $client->nom ?>" />
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-3 col-form-label">Prenom</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" placeholder="prenom" name="prenom" required value="<?php echo $client->prenom ?>" />
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-3 col-form-label">Date naissance</label>
        <div class="col-sm-9">
          <input id="datepicker" type="text" class="form-control" placeholder="2000-01-01" name="date_naissance" value="<?php echo $client->date_naissance ?>" required />
          <script>
            $('#datepicker').datepicker({
                      format: 'yyyy-mm-dd',
                      uiLibrary: 'bootstrap4'
                  });
              </script>
        </div>
      </div>

    </div>

    <div class="col-sm-6">
      <div class="form-group row">
        <label class="col-sm-3 col-form-label">Type</label>
        <div class="col-sm-9">
          <select class="form-control" name="type">
            <option <?php echo ($client->type) == "PROFESSIONNEL" ? 'selected' : '' ?>>PARTICULIER</option>
            <option <?php echo ($client->type) == "PROFESSIONNEL" ? 'selected' : '' ?>>PROFESSIONNEL</option>
          </select>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-3 col-form-label">Adresse Postale</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" placeholder="1 rue de ..., VILLE, CODE_POSTAL" name="adresse" required value="<?php echo $client->adresse ?>" />
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-3 col-form-label">Telephone</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" placeholder="telephone" name="telephone" required value="<?php echo $client->telephone ?>" />
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-3 col-form-label">Agence</label>
        <div class="col-sm-9">
          <select class="form-control" name="agence">
            <?php
// On ajoute une option par agence avec l'agence principale du client sélectionnée par défaut
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

  </div>

  <div class="text-center">
    <button type="submit" class="btn btn-primary">Enregistrer</button>
  </div>

</form>