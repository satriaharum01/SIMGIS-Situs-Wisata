@extends('admin.layout.header')
@section('title','Data Graf')

@section('content')
<!-- End Navbar -->
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between">
            <h6 class="mt-2 text-white text-capitalize ps-3">Data Graf</h6>
            <!-- Button trigger modal -->
            <button type="button" class="btn text-white text-capitalize ps-3 btn-dark me-3 btn-add" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
              <span class="material-icons opacity-10">add</span>
              Tambah Data
            </button>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div style="" class="card-body px-5 pb-0">
            <label class="card-title" style="margin-top: 1%;">Pilih Situs : </label>
            <select name="wisata" id="wisata" onchange="changewisata();">
              <option value="0" selected disabled>--- Pilih Situs Wisata ---</option>
            </select>
          </div>
          <div class="table-responsive p-5">
            <table class="table align-items-center mb-0" id="data-graf">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jalur</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Node</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jarak</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Wisata</th>
                  <th class="text-center text-secondary opacity-7">Aksi</th>
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
  @include('admin.graf.modal')
  <script>
    $(function() {
      $.ajax({
        url: "{{ url('/wisata/json')}}",
        type: "GET",
        cache: false,
        dataType: 'json',
        success: function(dataResult) {
          console.log(dataResult);
          var resultData = dataResult.data;
          $.each(resultData, function(index, row) {
            $('#wisata').append('<option value="' + row.id_wisata + '">' + row.id_wisata + ' - ' + row.nama + '</option>');
            $('#compose-form select[name=situs]').append('<option value="' + row.id_wisata + '">' + row.id_wisata + ' - ' + row.nama + '</option>');
          })
        }
      });

      $.ajax({
        url: "{{ url('/nodes/json')}}",
        type: "GET",
        cache: false,
        dataType: 'json',
        success: function(dataResult) {
          console.log(dataResult);
          var resultData = dataResult.data;
          $.each(resultData, function(index, row) {
            $('#compose-form select[name=node]').append('<option value="' + row.id_node + '">' + row.id_node + ' - ' + row.nama_jalan + '</option>');
          })
        }
      });

      table = $('#data-graf').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {
          url: '{{url("graf/json")}}'
        },
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex',
            orderable: false,
            searchable: false
          },
          {
            data: 'jalur'
          },
          {
            data: 'nama_jalan'
          },
          {
            data: 'jarak'
          },
          {
            data: 'nama_wisata'
          },
          {
            data: 'id_graf',
            orderable: false,
            searchable: false,
            render: function(data, type, row) {
              return '<button type="button" class="btn btn-success btn-sm btn-edit" data-id="' + data + '"><span class="material-icons opacity-10">edit</span> Edit</button>\
                        <a class="btn btn-danger btn-sm btn-hapus" data-id="' + data + '" data-handler="graf" href="<?= url('graf/delete') ?>/' + data + '">\
                        <span class="material-icons opacity-10">delete</span> Hapus</a> \
					              <form id="delete-form-' + data + '-graf" action="<?= url('graf/delete') ?>/' + data + '" \
                        method="GET" style="display: none;"> \
                        </form>'
            }
          },
        ]
      });

    });

    function kosongkan() {
      jQuery("input[name=_method]").attr("value", "");
      jQuery("#compose-form input[name=jalur]").val("");
      jQuery("#compose-form select[name=node]").val(0);
      jQuery("#compose-form input[name=jarak]").val("");
      jQuery("#compose-form select[name=situs]").val(0);
    }
    $("body").on("click", ".btn-add", function() {
      kosongkan();
      jQuery("#compose-form").attr("action", "{{ url('/graf/store')}}");
      jQuery("#compose .modal-title").html("Tambah Data Graf");
      jQuery("#compose").modal("toggle");
    })

    $("body").on("click", ".btn-edit", function() {
      var id = jQuery(this).attr("data-id");
      jQuery("input[name=_method]").attr("value", "patch");
      $.ajax({
        url: "<?= url('graf'); ?>/getjson/" + id,
        type: "GET",
        cache: false,
        dataType: 'json',
        success: function(dataResult) {
          console.log(dataResult);
          var resultData = dataResult;
          $.each(resultData, function(index, row) {
            jQuery("#compose-form input[name=jalur]").val(row.jalur);
            jQuery("#compose-form select[name=node]").val(row.id_node);
            jQuery("#compose-form input[name=jarak]").val(row.jarak);
            jQuery("#compose-form select[name=situs]").val(row.id_wisata);
          })
        }
      });
      jQuery("#compose-form").attr("action", '<?= url('graf'); ?>/update/' + id);
      jQuery("#compose .modal-title").html("Update Data Graf");
      jQuery("#compose").modal("toggle");
    });

    function changewisata() {
      var val = $("#wisata option:selected").val();
      table.ajax.url('{{("wisata/get")}}/' + val).load();
    }
  </script>
  @endsection