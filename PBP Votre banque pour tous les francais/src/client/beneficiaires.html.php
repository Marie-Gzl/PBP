<h3>Bénéficiaire</h3>

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="valide-tab" data-toggle="tab" href="#valide" role="tab" aria-controls="valide" aria-selected="true">Mes bénificiaires</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="attente-tab" data-toggle="tab" href="#attente" role="tab" aria-controls="attente" aria-selected="false">Bénéficiaires en attente</a>
  </li>
</ul>

<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="valide" role="tabpanel" aria-labelledby="valide-tab">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Libelle</th>
          <th scope="col">IBAN</th>
          <th scope="col">Ajouté le</th>
        </tr>
      </thead>
      <tbody>
        <?php
// On ajoute une ligne au tableau par bénéficiaire valide
foreach ($beneficiairesValide as $iter) {
    echo '<tr>';
    echo '<td>' . $iter->libelle . '</td>';
    echo '<td>' . $iter->iban . '</td>';
    echo '<td>' . $iter->date_ajout . '</td>';
    echo '</tr>';
}
?>
      </tbody>
    </table>

    <form id="connexion" method="POST" action="beneficiaires.php">
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">Libellé bénéficiaire</span>
        </div>
        <input type="text" class="form-control" placeholder="libellé" name="libelle" aria-describedby="basic-addon1" required />
      </div>

      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">Numéro compte bancaire</span>
        </div>
        <input type="text" class="form-control" placeholder="IBAN" name="iban" aria-describedby="basic-addon1" required />
      </div>

      <input type="submit" class="btn btn-primary" value="Envoyer demande" />
    </form>
  </div>

  <div class="tab-pane fade" id="attente" role="tabpanel" aria-labelledby="attente-tab">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Libelle</th>
          <th scope="col">IBAN</th>
          <th scope="col">Ajouté le</th>
        </tr>
      </thead>
      <tbody>
        <?php
// On ajoute une ligne au tableau par bénéficiaire en attente
foreach ($beneficiairesAttente as $iter) {
    echo '<tr>';
    echo '<td>' . $iter->libelle . '</td>';
    echo '<td>' . $iter->iban . '</td>';
    echo '<td>' . $iter->date_ajout . '</td>';
    echo '</tr>';
}
?>
      </tbody>
    </table>
  </div>

</div>