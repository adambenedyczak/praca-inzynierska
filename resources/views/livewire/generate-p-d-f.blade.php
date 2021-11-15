<div>
    <div class="modal-header">
        <h5 class="modal-title" id="PDFModal"><h5>Tworzenie zestawienia PDF</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    <div class="form-group">
        <h6>Wybierz elementy</h6>
        <div class="form-check">
            <input wire:model="setParts" class="form-check-input" type="checkbox" value="" id="chbxparts">
            <label class="form-check-label" for="chbxparts">
                Części
            </label>
        </div>
        <div class="form-check">
            <input wire:model="setOverviews" class="form-check-input" type="checkbox" value="" id="chbxoverviews">
            <label class="form-check-label" for="chbxoverviews">
                Przeglądy
            </label>
        </div>
        <div class="form-check">
            <input wire:model="setInsurances" class="form-check-input" type="checkbox" value="" id="chbxinsurances">
            <label class="form-check-label" for="chbxinsurances">
                Ubezpieczenia
            </label>
        </div>
    </div>
    <hr/>
    <div class="form-group">
        <h6>Ustawienia dodatkowe</h6>
        <div class="form-check">
            <input wire:model="setHistory" class="form-check-input" type="checkbox" value="" id="chbxhistory">
            <label class="form-check-label" for="chbxhistory">
                Historia zdarzeń
            </label>
        </div>
    </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Anuluj</button>
        <button wire:click="generate" type="button" class="btn btn-success">Generuj PDF</button>
    </div>
</div>
