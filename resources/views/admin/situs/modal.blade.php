<!-- Modal -->
<div class="modal fade" id="compose" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" id="compose-form" method="POST" enctype="multipart/form-data">
        <input name="_method" type="hidden" value="patch">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label>Nama Situs</label>
            <input type="text" class="form-control" name="nama">
          </div>
          <div class="form-group">
            <label>Alamat</label>
            <input type="text" class="form-control" name="alamat">
          </div>
          <div class="form-group">
            <label>Lokasi</label>
            <select class="form-control" name="lokasi">
              <option value="0" selected disabled>--- Pilih Lokasi ---</option>
              <option value="Nias">Pulau Nias</option>
              <option value="Other">Kota Medan</option>
            </select>
          </div>
          <div class="form-group">
            <label>Latitude</label>
            <input type="number" class="form-control" name="lat" step="0.0000000000000001">
          </div>
          <div class="form-group">
            <label>Longitude</label>
            <input type="number" class="form-control" name="long" step="0.0000000000000001">
          </div>
          <div class="form-group">
            <label>Category</label>
            <select class="form-control" name="id_cat" id="category">
              <option value="0" selected disabled>--- Pilih Category ---</option>
            </select>
          </div>
          <div class="form-group">
            <label>Deskripsi</label>
            <textarea rows="5" cols="50" class="form-control" name="deskripsi"></textarea>
          </div>
          <div class="form-group foto-section">
            <label>Foto</label>
            <input type="file" class="form-control" name="foto" id="foto" accept="image/*">
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