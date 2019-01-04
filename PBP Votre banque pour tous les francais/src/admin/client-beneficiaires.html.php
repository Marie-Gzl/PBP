<div>

  <h3>Bénéficiaires</h3>

  <div>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Libelle</th>
          <th scope="col">IBAN</th>
          <th scope="col">Ajouté le</th>
          <th scope="col">Validé</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>

        <?php
// On ajoute une ligne par bénéficiaire
foreach ($beneficiaires as $iter) {
    echo '<tr>';
    echo '<td>' . $iter->libelle . '</td>';
    echo '<td>' . $iter->iban . '</td>';
    echo '<td>' . $iter->date_ajout . '</td>';
    echo '<td>' . ($iter->valide == 1 ? 'oui':'non') . '</td>';
    // En fonction de si le bénéficiaire est valide ou non, on affiche un élément différent
    echo '<td>' . 
    ($iter->valide == 1 ? 
        '<i class="fas fa-trash-alt" onclick="confirmDelete(\''.$iter->libelle.'\', \''.$iter->id_beneficiaire.'\')"></i>'
      : '<i class="fas fa-check-double" onclick="confirmValidatation(\''.$iter->libelle.'\', \''.$iter->id_beneficiaire.'\')"></i>') . '</td>';
    echo '</tr>';
}
?>
        <script>
          function confirmDelete(text, id){
            if (confirm("Etes-vous sur de vouloir supprimer: " + text)){
              window.location="./client.php?client=<?php echo $idClient ?>&deleteBeneficiaire=" +id;
            }
          }

          function confirmValidatation(text, id){
            if (confirm("Etes-vous sur de valider: " + text)){
              window.location="./client.php?client=<?php echo $idClient ?>&validateBeneficiaire=" +id;
            }
          }
        </script>
      </tbody>
    </table>


    <form method="POST" action="./client.php?client=<?php echo $idClient ?>">
      <input hidden name="dbObject" value="beneficiaire" />

      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">Ajouter bénéficiaire</span>
        </div>
        <input type="text" class="form-control" placeholder="libellé" name="libelle" aria-describedby="basic-addon1" required />
      </div>

      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">Numéro compte bancaire</span>
        </div>
        <input type="text" class="form-control" placeholder="IBAN" name="iban" aria-describedby="basic-addon1" required />
      </div>

      <input type="submit" class="btn btn-primary" value="Créer bénéficiaire" />
    </form>
  </div>


</div>