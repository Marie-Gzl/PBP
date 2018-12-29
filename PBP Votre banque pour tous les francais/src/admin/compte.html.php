<a href="./client.php?client=<?php echo $idClient ?>">
    <button class="btn btn-primary">
        Retour à la fiche client
    </button>
</a>

<h3>
    Compte:
    <?php echo $iban?>
</h3>


<div class="input-group mb-3">
    <label>
        autoriser le decouvert ?
        <input type="checkbox" value="true" <?php echo ($compte->decouvert == '1' ? 'checked': '') ?> class="form-control" name="decouvert" onclick="updateDecouvert()" />
    </label>
</div>

<script>
    function updateDecouvert() {
        window.location = "./compte.php?client=<?php echo $idClient ?>&compte=<?php echo $idCompte ?>" + "&decouvert=<?php echo ($compte->decouvert == '1' ? '0': '1') ?>";
    }
</script>



<h3>
    Liste des opérations sur le compte:
    <?php echo $iban?>
</h3>

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




<h3>Effectuer un virement</h3>

<form onsubmit="return confirm('Confirmez vous l\'opération ?');" method="POST" action="./compte.php?client=<?php echo $idClient ?>&compte=<?php echo $idCompte?>">
    <input hidden name="dbObject" value="operation" />

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">Montant à envoyer</span>
        </div>
        <input type="number" required name="montant" min="0" value="0" step="0.01" max="<?php echo $compte->solde ?>">
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



<script>
    function plus(idCompte) {
        window.location = "./compte.php?client=<?php echo $idClient ?>&compte=" + idCompte;
    }
</script>