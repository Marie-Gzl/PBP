<h3 class="card-header text-center">Virements</h3>

<div class="card-body">
    <form onsubmit="return confirm('Confirmez vous l\'opération ?');" method="POST" action="./operations.php">
        <input hidden name="dbObject" value="operation" />


        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Compte émetteur</label>
            <div class="col-sm-9">
                <select class="form-control" name="emetteur">
                    <?php 
foreach ($comptes as $compte) {
echo "<option value='".$compte->iban."'>".$compte->iban."</option>";
}
?>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Montant à envoyer</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" required name="montant" min="0" value="0" step="1">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">IBAN destinataire</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" required name="destinataire">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Description de l'opération</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" required name="description">
            </div>
        </div>
        
        <div class="text-center">
            <button class="btn btn-primary" type="submit">Envoyer</button>
        </div>

    </form>
</div>