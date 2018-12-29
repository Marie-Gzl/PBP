<div>

  <h3>Demandes client</h3>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">Date</th>
        <th scope="col">Message</th>
      </tr>
    </thead>
    <tbody>
      <?php
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