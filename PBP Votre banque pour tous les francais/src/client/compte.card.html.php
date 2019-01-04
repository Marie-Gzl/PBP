<div class="card text-center">
  <h4 class="card-header">
    <?php echo $compteType ?>
  </h4>
  <div class="card-body">
    <div class="d-flex justify-content-between d-flex align-items-center">
      <div class="card-left">
        <h5>
          <?php echo $compteNumber ?>
        </h5>
        <?php
            if ($compteSolde >= 0) {
                echo '<p style="color:green; font-weight: bold">';
                echo $compteSolde;
                echo ' €</p>';
            } else {
                echo '<p style="color:red; font-weight: bold">';
                echo $compteSolde;
                echo ' €</p>';
            }
        ?>
      </div>

      <div class="card-right">
        <h6>Dernières opérations</h6>
        <table class="table table-card">
          <thead>
            <tr>
              <th scope="col">Libellé</th>
              <th scope="col">Montant</th>
            </tr>
          </thead>
          <tbody>
            <?php
// On affiche la liste des opérations
foreach ($operations as $operation) {
  echo '<tr>';
  echo '<td>'.$operation->description.'</td>';
  if ($operation->compte_debit==$compteId){
    echo '<td style="color: red">- '.$operation->montant.' €</td>';
  }else {
    echo '<td style="color: green">+ '.$operation->montant.' €</td>';
  }
  echo '</tr>';
}
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="card-footer text-muted">
    <a href="./compte.php?compte=<?php echo $compteId?>" class="btn btn-primary">Plus</a>
  </div>
</div>
</div>