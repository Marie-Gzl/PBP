<!DOCTYPE html>

<div>
  <div class="card text-center">
    <h4 class="card-header">Compte <?php echo $compte->type?> :
      <?php echo $compte->iban?>
    </h4>
    <div class="card-body">
      <div class="d-flex justify-content-between d-flex align-items-center">
        <div class="card-left">
          <p>
            <span> Numéro du compte: </span>
            <span style="font-weight: bold">
              <?php echo $compte->numero_compte?></span>
          </p>

          <div>Autorisation de découvert</div>
          <label class="switch">
            <?php
          if($compte->decouvert){
            echo '<input type="checkbox" checked disabled/> <span class="slider round"></span>';
          }else {
            echo '<input type="checkbox" disabled/> <span class="slider round"></span>';
          }
          ?>
          </label>
        </div>

        <div class="card-right">
          <p><span>Solde: </span>
            <?php
          if($compte->solde > 0){
            echo '<span style="color:green">+'.$compte->solde.' €</span>';
          }else {
            echo '<span style="color:red">'.$compte->solde.' €</span>';
          }
          ?>
          </p>
        </div>
      </div>
    </div>
  </div>
  <div class="card text-center">
    <h4 class="card-header">Opérations</h4>
    <div class="card-body">
      <table class="table table-card">
        <thead>
          <tr>
            <th scope="col">Date</th>
            <th scope="col">Montant</th>
            <th scope="col">Description</th>
          </tr>
        </thead>
        <tbody>
          <?php
  foreach ($operations as $operation) {
echo '<tr>';
echo '<td>'.$operation->date_execution.'</td>';
if ($operation->compte_debit==$compte->id_compte){
  echo '<td style="color: red">- '.$operation->montant.' €</td>';
}else {
  echo '<td style="color: green">+ '.$operation->montant.' €</td>';
}
echo '<td>'.$operation->description.'</td>';
echo '</tr>';
  }
            ?>
        </tbody>
      </table>
    </div>
  </div>
</div>