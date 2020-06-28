@extends('pekerja.staf.layouts.default')

@section('judul','Perwalian')

@section('css')
<!--Select Plugins-->
<link href="{{ asset('toolspekerja/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
<!--multi select-->
<link href="{{ asset('toolspekerja/plugins/jquery-multi-select/multi-select.css') }}" rel="stylesheet" type="text/css">
  <!--Data Tables -->
  <link href="{{ asset('toolspekerja/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('toolspekerja/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"> 
  <!--Switchery-->
  <link href="{{ asset('toolspekerja/plugins/bootstrap-switch/bootstrap-switch.min.css') }}" rel="stylesheet">
  <link href="{{ asset('toolsAdmin/css/plugins/forms/validation/form-validation.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('toolsAdmin/vendors/css/extensions/sweetalert2.min.css') }} rel="stylesheet" type="text/css"">
  
@endsection

@section('content')

<div class="row">
  <div class="col-lg-12"> 
    <div class="card">
      <div class="card-header"><i class="fa fa-table"></i> Data @yield('judul')</div>
      <div class="card-body">
        <p>Untuk Menubah atau Menghapus Data Silahkan Klik 2x pada data yang ingin ubah atau dihapus.</p>
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
              <button type="button" class="btn btn-warning" id="btnUbah"><i class="feather icon-edit"></i> Lihat</button>
              <button type="button" class="btn btn-danger" id="btnHapus"><i class="feather icon-trash-2"></i> Hapus</button>
          </div>
      </div>
  </div>
</div>

@include('pekerja.staf.kontrak.form')

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
  {{-- Script Sendiri --}}
  <script src="{{ asset('toolspekerja/js/script_ku.js') }}"></script>
  {{-- Sweet Alert --}}
  <script src="{{ asset('toolsAdmin/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
  <!--Select Plugins Js-->
  <script src="{{ asset('toolspekerja/plugins/select2/js/select2.min.js') }}"></script>
  <!--Multi Select Js-->
  <script src="{{ asset('toolspekerja/plugins/jquery-multi-select/jquery.multi-select.js') }}"></script>

  <script>
    $(document).ready(function() {
        $('.single-select').select2();
        $('#my_multi_select2').multiSelect({
            selectableOptgroup: true,
            width: '600px',
            buttonWidth: '400px'
        });
    });
</script>

  {{-- Drop Down Kontrak --}}
  <script>
    function dropDownKontrak()
    {
      $(document).ready(function(){
        $('.jadwal_id').empty();
        $('.jadwal_id').append('<option value="">Pilih Mahasiswa</option>');
        $.getJSON("StafKontrak/create", function (data){
            $.each(data, function(key,val){
                $('.jadwal_id').append('<option value="' + val.id +'">' + val.hari + ' - ' + val.matkul.nm_matkul + '</option>');
            })
        })                
      })
    }

    let hitung=0;
    $('#tambahMatkul').on('click', function(){
      hitung++;
      let html='';
      html+='<div class="col-12 mb-2">';
      html+='<select name="jadwal_id" id="jadwal_id'+hitung+'" class="selectKontrak'+hitung+' form-control" required data-validation-required-message="Tidak Boleh Kosong"><option value="2019">2019-2020</option></select>';
      html+='</div>';
      $('#pilihanKontrak').append(html);

      console.log(html);
      $('.selectKontrak').select2();
      
      // $("#tbl").children("select").select2()
    })
  </script>

  {{-- Tambah Data --}}
  <script>
    $('#tambah').click(function(){
        save_method="add"
        $('#listKontrak').hide();
        $('#judul').html('From Tambah Data')
        $('#tombolForm').html('Simpan Data')
        $('.tampilModal').modal('show');
        $('#formKu').trigger("reset");
        $('#pilihMatkul').show()
        $('#perwalian_id').val('').trigger('change');
        $('#my_multi_select2').multiSelect('deselect_all');

        // dropDownKontrak()
        $('#dosen_id').val('').trigger('change');
        console.log(save_method)
    });

    $(document).ready(function () {
        $("#formKu").on('submit',function(e){
          e.preventDefault();
          var id = $('#id').val();
          var dataKu = $('#formKu').serialize();
          if (save_method=="add") { 
              url="{{ route('StafKontrak.store') }}"
              method="POST"
          } else {
              // url="StafKontrak/"+id
              // method="PUT"
              alert('Belum Bisa');
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
              loadMoreData();
              $('#id').val('');
              $('#tgl_krs').val('');
              $('#perwalian_id').val('').trigger('change');
              $('#my_multi_select2').multiSelect('deselect_all');
            //   pesan
          }
          })
          .fail(function(xhr, status, error)
            {
              notifError(xhr.responseJSON.errors.perwalian_id[0])
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