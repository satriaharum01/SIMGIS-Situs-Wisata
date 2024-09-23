@extends('admin.layout.header')
@section('title','Data Situs')
@section('content')
<!-- End Navbar -->
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between">
            <h6 class="mt-2 text-white text-capitalize ps-3">Data Situs Wisata</h6>
            <!-- Button trigger modal -->
            <button type="button" class="btn text-white text-capitalize ps-3 btn-dark me-3 btn-add" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
              <span class="material-icons opacity-10">add</span>
              Tambah Data
            </button>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="table-responsive p-5">
            <table class="table display table-hover align-items-center mb-0" style="table-layout:auto;" id="data-situs" width="100%">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" width="8%">No</th>
                  <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Situs</th>
                  <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kategori</th>
                  <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2" width="20%">alamat</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Latitude</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Longitude</th>
                  <th class="text-center text-secondary opacity-7" width="25%">Aksi</th>
                </tr>
              </thead>
              <tbody style="text-align:center;">
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  @endsection
  @section('custom_script')
  @include('admin.situs.modal')
  <script>
    $(function() {

      $.ajax({
        url: "{{ url('/category/json')}}",
        type: "GET",
        cache: false,
        dataType: 'json',
        success: function(dataResult) {
          console.log(dataResult);
          var resultData = dataResult.data;
          $.each(resultData, function(index, row) {
            $('#compose-form select[name=id_cat]').append('<option value="' + row.id_category + '">' + row.id_category + ' - ' + row.nama_category + '</option>');
          })
        }
      });

      table = $('#data-situs').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {
          url: '{{url("situs/json")}}'
        },
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex',
            orderable: false,
            searchable: false
          },
          {
            data: 'nama'
          },
          {
            data: 'id_category'
          },
          {
            data: 'alamat'
          },
          {
            data: 'lat'
          },
          {
            data: 'long'
          },
          {
            data: 'id_wisata',
            orderable: false,
            searchable: false,
            render: function(data, type, row) {
              return '<button type="button" class="btn btn-success btn-sm btn-edit" data-id="' + data + '"><span class="material-icons opacity-10">edit</span> Edit</button>\
                        <a class="btn btn-danger btn-sm btn-hapus" data-id="' + data + '" data-handler="situs" href="<?= url('situs/delete') ?>/' + data + '">\
                        <span class="material-icons opacity-10">delete</span> Hapus</a> \
					              <form id="delete-form-' + data + '-situs" action="<?= url('situs/delete') ?>/' + data + '" \
                        method="GET" style="display: none;"> \
                        </form>'
            }
          },
        ]
      });
    });

    function kosongkan() {
      jQuery("input[name=_method]").attr("value", "");
      jQuery("#compose-form input[name=nama]").val("");
      jQuery("#compose-form input[name=alamat]").val("");
      jQuery("#compose-form input[name=lat]").val("");
      jQuery("#compose-form input[name=long]").val("");
      jQuery("#compose-form select[name=id_cat]").val(0);
      jQuery("#compose-form textarea[name=deskripsi]").val("");
      jQuery("#compose-form select[name=lokasi]").val(0);
    }
    $("body").on("click", ".btn-add", function() {
      kosongkan();
      jQuery("#compose-form").attr("action", "{{ url('/situs/store')}}");
      jQuery("#compose .modal-title").html("Tambah Data Situs");
      jQuery("#compose").modal("toggle");
    })

    $("body").on("click", ".btn-edit", function() {
      var id = jQuery(this).attr("data-id");
      jQuery("input[name=_method]").attr("value", "patch");
      $.ajax({
        url: "<?= url('situs'); ?>/getjson/" + id,
        type: "GET",
        cache: false,
        dataType: 'json',
        success: function(dataResult) {
          console.log(dataResult);
          var resultData = dataResult;
          $.each(resultData, function(index, row) {
            jQuery("#compose-form input[name=nama]").val(row.nama);
            jQuery("#compose-form input[name=alamat]").val(row.alamat);
            jQuery("#compose-form input[name=lat]").val(row.lat);
            jQuery("#compose-form input[name=long]").val(row.long);
            jQuery("#compose-form select[name=id_cat]").val(row.id_category);
            jQuery("#compose-form select[name=lokasi]").val(row.lokasi);
            jQuery("#compose-form textarea[name=deskripsi]").val(row.deskripsi);
          })
        }
      });
      jQuery("#compose-form").attr("action", '<?= url('situs'); ?>/update/' + id);
      jQuery("#compose .modal-title").html("Update Data Situs");
      jQuery("#compose").modal("toggle");
    });
  </script>
  @endsection