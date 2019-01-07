<h3 class="card-header">Demandes client</h3>

<div class="card-body">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Date</th>
        <th scope="col">Message</th>
      </tr>
    </thead>
    <tbody>
      <?php
// On ajoute une ligne par demande
foreach ($demandes as $iter) {
    echo '<tr>';
    echo '<td>' . $iter->date . '</td>';
    echo '<td>' . $iter->message . '</td>';
    echo '</tr>';
}
?>
    </tbody>
  </table>
</div>