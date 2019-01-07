<!DOCTYPE html>

<div>
    <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="cheque-tab" data-toggle="tab" href="#cheque" role="tab" aria-controls="cheque" aria-selected="true">Mes comptes cheque</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="epargne-tab" data-toggle="tab" href="#epargne" role="tab" aria-controls="epargne" aria-selected="false">Mes comptes epargne</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="cheque" role="tabpanel" aria-labelledby="cheque-tab">
            <?php
    // Pour chaque compte chèque
  foreach ($comptesCheque as $key => $iter) {
      $compteType = $iter->type;
      $compteNumber = $iter->iban;
      $compteSolde = $iter->solde;
      $compteId = $iter->id_compte;

           // On récupère les 3 dernieres Operations
$reqOperations = $bdd->prepare("SELECT * FROM operation WHERE compte_debit = :idCompte OR compte_credit = :idCompte ORDER BY date_execution DESC LIMIT 3");
$reqOperations->execute([":idCompte" => $compteId]);
$operations = $reqOperations->fetchAll(PDO::FETCH_OBJ);

      include './compte.card.html.php';
  }
  ?>
        </div>

        <div class="tab-pane fade" id="epargne" role="tabpanel" aria-labelledby="epargne-tab">
            <?php
  // Pour chaque compte épargne
  foreach ($comptesEpargne as $key => $iter) {
      $compteType = $iter->type;
      $compteNumber = $iter->iban;
      $compteSolde = $iter->solde;
      $compteId = $iter->id_compte;

           //On récupère les 3 dernieres Operations
$reqOperations = $bdd->prepare("SELECT * FROM operation WHERE compte_debit = :idCompte OR compte_credit = :idCompte ORDER BY date_execution DESC LIMIT 3");
$reqOperations->execute([":idCompte" => $iter->id_compte]);
$operations = $reqOperations->fetchAll(PDO::FETCH_OBJ);

      include './compte.card.html.php';
  }
  ?>
        </div>

    </div>