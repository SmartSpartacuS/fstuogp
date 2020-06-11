@extends('pekerja.staf.layouts.default')

@section('judul','Perwalian')

@section('css')
  <!--Data Tables -->
  <link href="{{ asset('toolspekerja/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('toolspekerja/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"> 
  <!--Switchery-->
  <link href="{{ asset('toolspekerja/plugins/bootstrap-switch/bootstrap-switch.min.css') }}" rel="stylesheet">
  <link href="{{ asset('toolsAdmin/css/plugins/forms/validation/form-validation.css') }}" rel="stylesheet" type="text/css">
  <!--Select Plugins-->
  <link href="{{ asset('toolspekerja/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('toolsAdmin/vendors/css/extensions/sweetalert2.min.css') }} rel="stylesheet" type="text/css"">
  
@endsection

@section('content')

<div class="row">
  <div class="col-lg-12"> 
    <div class="card">
      <div class="card-header"><i class="fa fa-table"></i> Data @yield('judul')</div>
      <div class="card-body">
        <p>Untuk Menghapus Data Silahkan Klik 2x pada data yang ingin dihapus.</p>
        <button type="button" id="tambah" class="btn btn-light waves-effect waves-light mb-3"><i class="fa fa-plus-circle"></i> Tambah Data</button>

        <div class="table-responsive">
          <div id="tampil"></div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Modal Pertanyaan --}}
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

@include('pekerja.staf.perwalian.form')

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

  {{-- Drop Down MHS --}}
  <script>
    function dropDownMhs()
    {
      $(document).ready(function(){
        $('#mhs_id').empty();
        $('#mhs_id').append('<option value="">Pilih Mahasiswa</option>');
        $.getJSON("StafPerwalian_mhs", function (data){
            $.each(data, function(key,val){
                $('#mhs_id').append('<option value="' + val.id +'">' + val.NPM + ' - ' + val.nm_mhs + '</option>');
            })
        })                
      })
    }
  </script>

  {{-- Tambah Data --}}
  <script>
    $('#tambah').click(function(){
        save_method="add"
        $('#judul').html('From Tambah Data')
        $('#tombolForm').html('Simpan Data')
        $('.tampilModal').modal('show')
        dropDownMhs()
        $('#dosen_id').val('').trigger('change');
        console.log(save_method)
    });

    $(document).ready(function () {
        $("#formKu").on('submit',function(e){
          e.preventDefault();
          var id = $('#id').val();
          var dataKu = $('#formKu').serialize();
          if (save_method=="add") { 
              url="{{ route('StafPerwalian.store') }}"
              method="POST"
          } else {
              url="StafPerwalian/"+id
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
              dropDownMhs();
              loadMoreData();
            //   pesan
          }
          })
          .fail(function(xhr, status, error)
            {
              notifError('Server Tidak Merespon')
            });
          console.log(save_method)
        });
    });
  </script>

  {{-- Load Data --}}
  <script>
    $(document).ready(function(){
      loadMoreData();
    })
  </script>
  
@endsection