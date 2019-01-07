<h3 class="card-header text-center">Bénéficiaires</h3>
<div class="card-body">
  <div>
    <div class="d-flex justify-content-between" style="margin-bottom: 10px">
      <h5>Mes bénéficiaires</h5>
      <button id="add-bene" class="btn btn-primary" onClick="addBene()">Ajouter</button>
      <button id="cancel-bene" class="btn btn-primary" style="display: none;" onClick="cancelBene()">Annuler</button>
    </div>

    <script>
      function addBene(){
          var addIcon = document.getElementById('add-bene');
          addIcon.style.display = "none";

          var cancelIcon = document.getElementById('cancel-bene');
          cancelIcon.style.display = "block";

          var form = document.getElementById('form-add-beneficiaire');
          form.style.display = "block";

          var table = document.getElementById('table-beneficiaire-valide');
          table.style.display = "none";
      };

      function cancelBene(){
        var addIcon = document.getElementById('add-bene');
          addIcon.style.display = "block";

          var cancelIcon = document.getElementById('cancel-bene');
          cancelIcon.style.display = "none";

          var form = document.getElementById('form-add-beneficiaire');
          form.style.display = "none";

          var table = document.getElementById('table-beneficiaire-valide');
          table.style.display = "block";
          
      }
    </script>


    <div id="table-beneficiaire-valide">

      <?php
// On ajoute une ligne au tableau par bénéficiaire valide
if (count($beneficiairesValide) > 0){
  echo '
  <table class="table">
        <thead>
          <tr>
            <th scope="col">Libelle</th>
            <th scope="col">IBAN</th>
            <th scope="col">Ajouté le</th>
          </tr>
        </thead>
        <tbody>
  ';
  foreach ($beneficiairesValide as $iter) {
      echo '<tr>';
      echo '<td>' . $iter->libelle . '</td>';
      echo '<td>' . $iter->iban . '</td>';
      echo '<td>' . $iter->date_ajout . '</td>';
      echo '</tr>';
  }
  echo '
  </tbody>
  </table>
';
}else {
  echo 'Pas encore de bénéficaire';
}
?>
    </div>
  </div>

  <form id="form-add-beneficiaire" style="display: none" method="POST" action="./operations.php">
    <div class="form-group row">
      <label class="col-sm-3 col-form-label">Libellé bénéficiaire</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" placeholder="libellé" name="libelle" aria-describedby="basic-addon1" required />
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-3 col-form-label">Numéro compte bancaire</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" placeholder="IBAN" name="iban" aria-describedby="basic-addon1" required />
      </div>
    </div>

    <input type="submit" class="btn btn-primary" value="Envoyer demande" />
  </form>


  <div style="margin-top: 50px;">
    <h5>En attente de validation</h5>
    <div>

      <?php
// On ajoute une ligne au tableau par bénéficiaire en attente

if (count($beneficiairesAttente) > 0){
  echo '
  <table class="table">
        <thead>
          <tr>
            <th scope="col">Libelle</th>
            <th scope="col">IBAN</th>
            <th scope="col">Ajouté le</th>
          </tr>
        </thead>
        <tbody>
  ';
  foreach ($beneficiairesAttente as $iter) {
    echo '<tr>';
    echo '<td>' . $iter->libelle . '</td>';
    echo '<td>' . $iter->iban . '</td>';
    echo '<td>' . $iter->date_ajout . '</td>';
    echo '</tr>';
  }
  echo '
      </tbody>
      </table>
  ';
}else {
  echo 'Pas de validation en cours';
}
?>

    </div>
  </div>
</div>