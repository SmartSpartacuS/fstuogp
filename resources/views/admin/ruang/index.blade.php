
@extends('admin.layouts.default')

@section('judul','Ruang')
@section('Ruang','active')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('toolsAdmin/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('toolsAdmin/vendors/css/tables/datatable/datatables.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('toolsAdmin/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('toolsAdmin/vendors/css/forms/select/select2.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('toolsAdmin/css/plugins/forms/validation/form-validation.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('toolsAdmin/vendors/css/extensions/toastr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('toolsAdmin/css/plugins/extensions/toastr.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('toolsAdmin/vendors/css/animate/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('toolsAdmin/vendors/css/extensions/sweetalert2.min.css') }}">
     <!-- END: Page CSS-->

    
@endsection

@section('content')
<div class="content-body">
    <!-- Zero configuration table -->
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@yield('judul')</h4>
                        <button type="button" id="tambah" class="btn btn-outline-primary  float-right">
                            <i class="feather icon-plus-circle"></i> Tambah Data
                        </button>                        
                    </div>
                    
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <p>Untuk mengubah atau menghapus data silahkan klik 2x pada data yang ingin diubah atau dihapus.</p>
                                <div id="tampil"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ Zero configuration table -->
</div>
<div class="modal fade text-left" id="alertPertanyaan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">Pilih Tindakan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Silahkan Pilih tindakan selanjutnya.</p>
                
            </div>
            <div class="text-center mb-2">
                <button type="button" class="btn btn-warning" id="btnUbah"><i class="feather icon-edit"></i> Ubah</button>
                <button type="button" class="btn btn-danger" id="btnHapus"><i class="feather icon-trash-2"></i> Hapus</button>
            </div>
        </div>
    </div>
</div>


@include('admin.ruang.form')

@endsection

@section('js')
<script src="{{ asset('toolsAdmin/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
<script src="{{ asset('toolsAdmin/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
<script src="{{ asset('toolsAdmin/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('toolsAdmin/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
<script src="{{ asset('toolsAdmin/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
<script src="{{ asset('toolsAdmin/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
<script src="{{ asset('toolsAdmin/vendors/js/tables/datatable/buttons.bootstrap.min.js') }}"></script>
<script src="{{ asset('toolsAdmin/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>

<script src="{{ asset('toolsAdmin/js/scripts/datatables/datatable.js') }}"></script>

<!-- Selected -->
<script src="{{ asset('toolsAdmin/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="{{ asset('toolsAdmin/js/scripts/forms/select/form-select2.js') }}"></script>

<script src="{{ asset('toolsAdmin/vendors/js/forms/validation/jqBootstrapValidation.js') }}"></script>
<script src="{{ asset('toolsAdmin/js/scripts/forms/validation/form-validation.js') }}"></script>

<script src="{{ asset('toolsAdmin/vendors/js/extensions/toastr.min.js') }}"></script>
<script src="{{ asset('toolsAdmin/js/scripts/extensions/toastr.js') }}"></script>

<script src="{{ asset('toolsAdmin/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>

<script>
    // Load Modal
    $(document).ready(function(){
        $(".modal-content").addClass("animated " + "flipInY");
    });
    // Load Data
    function loadMoreData() {
        $.ajax({
            url: '',
            type: "get",
            datatype: "html",
            success:function(data){
                $('#tampil').html(data);
            }
        })
        .fail(function(jqXHR, ajaxOptions, thrownError)
        {
            alert('Server tidak merespon...');
        });
    }
    loadMoreData();
</script>

{{-- Tambah dan Ubah Data --}}
<script>  
    $('#tambah').click(function(){
        save_method="add"
        $('#judul').html('From Tambah Data')
        $('#tombolForm').html('Simpan Data')
        $('#formKu').trigger("reset");
        $('.tampilModal').modal('show')
    });

    $(document).ready(function () {
        $("#formKu").on('submit',function(e){
          e.preventDefault();
          let id = $('#id').val();
          let dataKu = $('#formKu').serialize();
          if (save_method=="add") { 
              url="{{ route('ruang.store') }}"
              method="POST"
          } else {
              url="ruang/"+id
              method="PUT"
          }
          $.ajax({
          url: url,
          type: method,
          data: dataKu, 
          success: function(response) {           
                if (save_method=="add") {                     
                    toastr.info('Data Disimpan ', 'Berhasil', { "progressBar": true }); 
                } else {
                    toastr.info('Data Diubah ', 'Berhasil', { "progressBar": true }); 
                    aksi=$('.tampilModal').modal('hide')
                }
            
              $('#kd_ruang').val('');
              $('#nm_ruang').val('');
              loadMoreData();
            //   pesan
          }
          })
          .fail(function(jqXHR, ajaxOptions, thrownError)
            {
                alert('Error. Kemungkinan Kode Sudah Ada.');
            });
          console.log(save_method)
        });
    });

</script>




@endsection

