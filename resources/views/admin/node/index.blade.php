@extends('admin.layout.header')
@section('title','Data Nodes')

@section('content')
<!-- End Navbar -->
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between">
            <h6 class="mt-2 text-white text-capitalize ps-3">Data Nodes</h6>
            <!-- Button trigger modal -->
            <button type="button" class="btn text-white text-capitalize ps-3 btn-dark me-3 btn-add" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
              <span class="material-icons opacity-10">add</span>
              Tambah Data
            </button>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="table-responsive p-5">
            <table class="table align-items-center mb-0" id="data-nodes" width="100%">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jalan</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Latitude</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Longitude</th>
                  <th class="text-secondary opacity-7">Aksi</th>
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
  @include('admin.node.modal')
  <script>
    $(function() {
        table = $('#data-nodes').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{url("nodes/json")}}'
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'nama_jalan'
                },
                {
                    data: 'lat'
                },
                {
                    data: 'long'
                },
                {
                    data: 'id_node',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return '<button type="button" class="btn btn-success btn-sm btn-edit" data-id="' + data + '"><span class="material-icons opacity-10">edit</span> Edit</button>\
                        <a class="btn btn-danger btn-sm btn-hapus" data-id="' + data + '" data-handler="nodes" href="<?= url('nodes/delete') ?>/' + data + '">\
                        <span class="material-icons opacity-10">delete</span> Hapus</a> \
					              <form id="delete-form-' + data + '-nodes" action="<?= url('nodes/delete') ?>/' + data + '" \
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
        jQuery("#compose-form input[name=lat]").val("");
        jQuery("#compose-form input[name=long]").val("");
    }
    $("body").on("click", ".btn-add", function() {
        kosongkan();
        jQuery("#compose-form").attr("action", "{{ url('/nodes/store')}}");
        jQuery("#compose .modal-title").html("Tambah Data Nodes");
        jQuery("#compose").modal("toggle");
    })

    $("body").on("click", ".btn-edit", function() {
        var id = jQuery(this).attr("data-id");
        jQuery("input[name=_method]").attr("value", "patch");
        $.ajax({
            url: "<?= url('nodes'); ?>/getjson/" + id,
            type: "GET",
            cache: false,
            dataType: 'json',
            success: function(dataResult) {
                console.log(dataResult);
                var resultData = dataResult;
                $.each(resultData, function(index, row) {
                    jQuery("#compose-form input[name=nama]").val(row.nama_jalan);
                    jQuery("#compose-form input[name=lat]").val(row.lat);
                    jQuery("#compose-form input[name=long]").val(row.long);
                })
            }
        });
        jQuery("#compose-form").attr("action", '<?= url('nodes'); ?>/update/' + id);
        jQuery("#compose .modal-title").html("Update Data Nodes");
        jQuery("#compose").modal("toggle");
    });
  </script>
  @endsection