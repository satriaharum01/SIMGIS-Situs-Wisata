<!-- Modal -->
<div class="modal fade" id="compose" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" id="compose-form" method="POST">
        <input name="_method" type="hidden" value="patch">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label>Jalur</label>
            <input type="number" class="form-control" name="jalur" placeholder="Ex. jalur 1 = 1">
          </div>
          <div class="form-group">
            <label>Node</label>
            <select class="form-control" name="node" id="node">
              <option value="0" selected disabled>--- Pilih Nodes ---</option>
            </select>
          </div>
          <div class="form-group">
            <label>Jarak</label>
            <input type="number" class="form-control" name="jarak" placeholder="Ex. 200 M = 200">
          </div>
          <div class="form-group">
            <label>Situs Wisata</label>
            <select class="form-control" name="situs" id="situs">
              <option value="0" selected disabled>--- Pilih Wisata ---</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary btn-simpan">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>