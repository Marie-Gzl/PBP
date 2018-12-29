<div>

  <h3>Comptes client</h3>

  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCompte">Ajouter compte</button>

  <?php include './client-add-compte.modal.html.php'?>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">type</th>
        <th scope="col">iban</th>
        <th scope="col">solde</th>
        <th scope="col">taux</th>
        <th scope="col">decouvert</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <?php
foreach ($comptes as $iter) {
    echo '<tr>';
    echo '<td>' . $iter->id_compte . '</td>';
    echo '<td>' . $iter->type . '</td>';
    echo '<td>' . $iter->iban . '</td>';
    echo '<td>' . $iter->solde . '€</td>';
    echo '<td>' . $iter->taux . '%</td>';
    echo '<td>' . ($iter->decouvert ? 'oui' : 'non') . '</td>';
    echo '<td>' . '<i class="fas fa-plus-square" onclick="plus(\''.$iter->id_compte.'\')"></i>' . '</td>';
    echo '</tr>';
}
?>

    </tbody>
  </table>


  <script>
        function plus(idCompte) {
          window.location = "./compte.php?client=<?php echo $idClient ?>&compte=" + idCompte;
        }
      </script>
</div>