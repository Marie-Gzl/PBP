<!-- Modal -->
<div class="modal fade" id="addAgence" tabindex="-1" role="dialog" aria-labelledby="addAgence" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajout Client</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="./agences.php">
        
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Adresse</span>
            </div>
            <input type="text" class="form-control" placeholder="adresse" name="adresse" required />
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Description</span>
            </div>
            <input type="text" class="form-control" placeholder="description" name="description" required />
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Code Banque</span>
            </div>
            <input type="text" class="form-control" placeholder="cd_banque" name="cd_banque" required />
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Code Guichet</span>
            </div>
            <input type="text" class="form-control" placeholder="cd_guichet" name="cd_guichet" required />
          </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
      </div>

      </form>

    </div>
  </div>
</div>