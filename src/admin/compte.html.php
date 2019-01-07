<div class="d-flex justify-content-between">
    <a href="./client.php?client=<?php echo $idClient ?>">
        <button class="btn btn-primary">
            Retour à la fiche client
        </button>
    </a>
    <h3>
        <?php echo $iban?>
    </h3>
</div>

<div class="card">
    <h3 class="card-header text-center">Découvert</h3>

    <div class="form-group row card-body">
        <label class="col-sm-3 col-form-label">Souhaitez vous autoriser le decouvert ?</label>
        <div class="col-sm-9">
            <input type="checkbox" value="true" <?php echo ($compte->decouvert == '1' ? 'checked': '') ?> class="form-control" name="decouvert" onclick="updateDecouvert()" />
        </div>
    </div>

    <script>
        function updateDecouvert() {
        window.location = "./compte.php?client=<?php echo $idClient ?>&compte=<?php echo $idCompte ?>" + "&decouvert=<?php echo ($compte->decouvert == '1' ? '0': '1') ?>";
    }
</script>

</div>

<div class="card">
    <h3 class="card-header text-center">Liste des opérations</h3>

    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Debit/Credit</th>
                    <th scope="col">Montant</th>
                    <th scope="col">Description</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
// On ajoute une ligne par opération en base
foreach ($operations as $iter) {
    echo '<tr>';
    echo '<td>' . ($iter->compte_debit == $idCompte ? 'Débit' : 'Crédit') . '</td>';
    echo '<td style="color:'.($iter->compte_debit == $idCompte ? 'red' : 'green').'">' . $iter->montant . '</td>';
    echo '<td>' . $iter->description. '</td>';
    echo '<td>' . $iter->date_execution . '</td>';
    echo '</tr>';
}
?>


            </tbody>
        </table>
    </div>
</div>

<div class="card">
    <h3 class="card-header text-center">Effectuer un virement</h3>

    <div class="card-body">
        <form onsubmit="return confirm('Confirmez vous l\'opération ?');" method="POST" action="./compte.php?client=<?php echo $idClient ?>&compte=<?php echo $idCompte?>">
            <input hidden name="dbObject" value="operation" />

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Montant à envoyer</label>
                <div class="col-sm-9">
                    <input type="number" required name="montant" min="0" value="0" step="0.01" max="<?php echo $compte->solde ?>">
                </div>
            </div>


            <div class="form-group row">
                <label class="col-sm-3 col-form-label">IBAN destinataire</label>
                <div class="col-sm-9">
                    <input type="text" required name="destinataire">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Description de l'opération</label>
                <div class="col-sm-9">
                    <input type="text" required name="description">
                </div>
            </div>

            <div class="text-center">
                <button class="btn btn-primary" type="submit">Envoyer</button>
            </div>

        </form>



        <script>
            function plus(idCompte) {
                window.location = "./compte.php?client=<?php echo $idClient ?>&compte=" + idCompte;
            }
        </script>
    </div>
</div>