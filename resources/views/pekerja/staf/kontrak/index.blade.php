@extends('pekerja.staf.layouts.default')

@section('judul','Mahasiswa')

@section('css')
  <!--Data Tables -->
  <link href="{{ asset('toolspekerja/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('toolspekerja/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"> 
  <!--Switchery-->
  <link href="{{ asset('toolspekerja/plugins/bootstrap-switch/bootstrap-switch.min.css') }}" rel="stylesheet">
  <link href="{{ asset('toolsAdmin/css/plugins/forms/validation/form-validation.css') }}" rel="stylesheet" type="text/css">
  <!--Select Plugins-->
  <link href="{{ asset('toolspekerja/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="{{ asset('toolsAdmin/vendors/css/extensions/sweetalert2.min.css') }}">
  
@endsection

@section('content')

<div class="row">
  <div class="col-lg-12"> 
    <div class="card">
      <div class="card-header"><i class="fa fa-table"></i> Data Mahasiswa</div>
      <div class="card-body">
        <p>Untuk Mengubah atau Menghapus Data Silahkan Klik 2x pada data yang ingin diubah atau dihapus.</p>
        <button type="button" id="tambah" class="btn btn-light waves-effect waves-light mb-3"><i class="fa fa-plus-circle"></i> Tambah Data</button>

        <div class="table-responsive">
          <div id="tampil"></div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade text-left" id="alertPertanyaan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content bg-staf">
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

@include('pekerja.staf.mhs.form')

@endsection

@section('js')

  <!--Data Tables js-->
  <script src="{{ asset('toolspekerja/plugins/bootstrap-datatable/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('toolspekerja/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('toolspekerja/plugins/bootstrap-datatable/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('toolspekerja/plugins/bootstrap-datatable/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('toolspekerja/plugins/bootstrap-datatable/js/jszip.min.js') }}"></script>
  <script src="{{ asset('toolspekerja/plugins/bootstrap-datatable/js/pdfmake.min.js') }}"></script>
  <script src="{{ asset('toolspekerja/plugins/bootstrap-datatable/js/vfs_fonts.js') }}"></script>
  <script src="{{ asset('toolspekerja/plugins/bootstrap-datatable/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('toolspekerja/plugins/bootstrap-datatable/js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('toolspekerja/plugins/bootstrap-datatable/js/buttons.colVis.min.js') }}"></script>
  <!--Form Validatin Script-->
  <script src="{{ asset('toolsAdmin/vendors/js/forms/validation/jqBootstrapValidation.js') }}"></script>
  <script src="{{ asset('toolsAdmin/js/scripts/forms/validation/form-validation.js') }}"></script>
  {{-- Notif --}}
  <script src="{{ asset('toolspekerja/plugins/notifications/js/lobibox.min.js') }}"></script>
  <script src="{{ asset('toolspekerja/plugins/notifications/js/notifications.min.js') }}"></script>
  <!--Select Plugins Js-->
  <script src="{{ asset('toolspekerja/plugins/select2/js/select2.min.js') }}"></script>
  {{-- Script Sendiri --}}
  <script src="{{ asset('toolspekerja/js/script_ku.js') }}"></script>
  {{-- Sweet Alert --}}
  <script src="{{ asset('toolsAdmin/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
    

  <script>
    // Angkatan
    $(document).ready(function(){
      let start_year= new Date().getFullYear();
          for (let i = start_year; i >= start_year - 7; i--) {
              $('#angkatan').append('<option value="' + i + '">' + i + '</option>');
          }
      //called when key is pressed in textbox
      $(".nomor").keypress(function (e) {
        //if the letter is not digit then display error and don't type anything
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });
    });
    // Load Data
      loadMoreData();
  </script>

  {{-- Tambah Data --}}
  <script>
    $('#tambah').click(function(){
        save_method="add"
        $('#judul').html('From Tambah Data')
        $('#tombolForm').html('Simpan Data')
        $('#formKu').trigger("reset");
        $('.tampilModal').modal('show')
        console.log(save_method)
    });

    $(document).ready(function () {
        $("#formKu").on('submit',function(e){
          e.preventDefault();
          var id = $('#id').val();
          var dataKu = $('#formKu').serialize();
          if (save_method=="add") { 
              url="{{ route('StafMhs.store') }}"
              method="POST"
          } else {
              url="StafMhs/"+id
              method="PUT"
          }
          $.ajax({
          url: url,
          type: method,
          data: dataKu, 
          success: function(response) {
                if (save_method=="add") { 
                    successTambah()                    
                } else {
                    successUbah()
                    aksi=$('.tampilModal').modal('hide')
                }
              $('#id').val('');
              $('#NPM').val('');
              $('#nm_mhs').val('');
              $('#alamat').val('');
              loadMoreData();
            //   pesan
          }
          // error: function(xhr, status, error) {
          //   var err = eval("(" + xhr.responseText + ")");
          //   alert(err.Message);
          // }
          })
          .fail(function(xhr, status, error)
            {
              notifError(xhr.responseJSON.errors.NPM[0])
            });
          console.log(save_method)
        });
    });
  </script>
@endsection