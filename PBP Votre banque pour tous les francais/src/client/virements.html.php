<h3>Virements</h3>

<form onsubmit="return confirm('Confirmez vous l\'opération ?');" method="POST" action="./operations.php">
    <input hidden name="dbObject" value="operation" />

<div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">Compte émetteur</span>
        </div>
  </div>

   <select class="form-control" name="emetteur">

    <?php 
        foreach ($comptes as $compte) {
            echo "<option value='".$compte->iban."'>".$compte->iban."</option>";
        }
    ?>

</select>
</div>

     </div>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">Montant à envoyer</span>
        </div>
        <input type="number" required name="montant" min="0" value="0" step="1">
    </div>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">IBAN destinataire</span>
        </div>
        <input type="text" required name="destinataire">
    </div>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">Description de l'opération</span>
        </div>
        <input type="text" required name="description">
    </div>

    <button class="btn btn-primary" type="submit">Envoyer</button>

</form>