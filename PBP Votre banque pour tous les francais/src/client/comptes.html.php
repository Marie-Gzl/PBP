<!DOCTYPE html>

<div>

    <?php
  foreach ($comptesCheque as $key => $iter) {
      $compteType = $iter->type;
      $compteNumber = $iter->iban;
      $compteSolde = $iter->solde;
      $compteId = $iter->id_compte;

           //3 dernieres Operations
$reqOperations = $bdd->prepare("SELECT * FROM operation WHERE compte_debit = :idCompte OR compte_credit = :idCompte ORDER BY date_execution DESC LIMIT 3");
$reqOperations->execute([":idCompte" => $compteId]);
$operations = $reqOperations->fetchAll(PDO::FETCH_OBJ);

      include './compte.card.html.php';
  }

  foreach ($comptesEpargne as $key => $iter) {
      $compteType = $iter->type;
      $compteNumber = $iter->iban;
      $compteSolde = $iter->solde;
      $compteId = $iter->id_compte;

           //3 dernieres Operations
$reqOperations = $bdd->prepare("SELECT * FROM operation WHERE compte_debit = :idCompte OR compte_credit = :idCompte ORDER BY date_execution DESC LIMIT 3");
$reqOperations->execute([":idCompte" => $iter->id_compte]);
$operations = $reqOperations->fetchAll(PDO::FETCH_OBJ);

      include './compte.card.html.php';
  }
  ?>
</div>