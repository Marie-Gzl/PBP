<!DOCTYPE html>

<div class="d-flex justify-content-between" style="margin: 10px;">
  <h3>Liste des clients</h3>

  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addClient">Ajouter client</button>
</div>

<?php include './clients-add.modal.html.php'?>

<div>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">type</th>
        <th scope="col">nom</th>
        <th scope="col">prenom</th>
        <th scope="col">email</th>
        <th scope="col">agence</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <?php
// On ajoute une ligne par client
foreach ($clients as $iter) {
    echo '<tr>';
    echo '<td>' . $iter->type . '</td>';
    echo '<td>' . $iter->nom . '</td>';
    echo '<td>' . $iter->prenom . '</td>';
    echo '<td>' . $iter->email . '</td>';
    echo '<td>' . $iter->description . '</td>';
    echo '<td><a href="client.php?client=' . $iter->id_client . '"><i class="far fa-edit"></i></td>';
    echo '</tr>';
}
?>
    </tbody>
  </table>
</div>

</div>