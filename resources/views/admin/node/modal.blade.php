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
            <label>Nama Jalan</label>
            <input type="text" class="form-control" name="nama">
          </div>
          <div class="form-group">
            <label>Latitude</label>
            <input type="number" class="form-control" name="lat" step="0.0000000000000001">
          </div>
          <div class="form-group">
            <label>Longitude</label>
            <input type="number" class="form-control" name="long" step="0.0000000000000001">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary btn-simpan">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>