<!DOCTYPE html>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addAgence">Ajouter agence</button>

<?php include './agence-add.modal.html.php'?>

<div>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Adresse</th>
        <th scope="col">Description</th>
        <th scope="col">Code Banque</th>
        <th scope="col">Code Guichet</th>
      </tr>
    </thead>
    <tbody>
      <?php
foreach ($agences as $iter) {
    echo '<tr>';
    echo '<td>' . $iter->id_agence . '</td>';
    echo '<td>' . $iter->adresse . '</td>';
    echo '<td>' . $iter->description . '</td>';
    echo '<td>' . $iter->cd_banque. '</td>';
    echo '<td>' . $iter->cd_guichet . '</td>';
    echo '</tr>';
}
?>
    </tbody>
  </table>
</div>

</div>