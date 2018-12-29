<!-- Modal -->
<div class="modal fade" id="addCompte" tabindex="-1" role="dialog" aria-labelledby="addCompte" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajout compte</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="./client.php?client=<?php echo $idClient ?>">
          <input hidden name="dbObject" value="compte" />

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">type</span>
            </div>
            <select class="form-control" name="type">
              <option>epargne</option>
              <option>cheque</option>
            </select>
          </div>


          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Solde</span>
            </div>
            <input type="text" class="form-control" placeholder="0.0" name="solde" required />
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Taux</span>
            </div>
            <input type="text" class="form-control" placeholder="0.0" name="taux" required />
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Découvert</span>
            </div>
            <input type="checkbox" value="true" class="form-control" name="decouvert" />
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>