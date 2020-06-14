@extends('pekerja.kaprodi.layouts.default')

@section('judul','Jadwal')

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
  <!-- Material Design Bootstrap -->
  <link rel="stylesheet" href="{{ asset('toolspekerja/css/mdb.min.css') }}">
  
  
@endsection

@section('content')

<div class="row">
  <div class="col-lg-12"> 
    <div class="card">
      <div class="card-header"><i class="fa fa-table"></i> Data @yield('judul')</div>
      <div class="card-body">
        <p>Untuk Mengubah atau Menghapus Data Silahkan Klik 2x pada data yang ingin diubah atau dihapus.</p>
        <button type="button" id="tambah" class="btn btn-light waves-effect waves-light mb-3"><i class="fa fa-plus-circle"></i> Tambah Data</button>
        <form id="exportExcel" method="POST">
            @csrf
            <input type="hidden" id="id_prodi" name="id_prodi" data-id="{{ auth()->user()->dosen->id_prodi }}" value="">
          <div class="row">
            
            <div class="col-6 col-md-3 col-lg-3 col-xl-2">
                <div class="form-group">
                    <select name="semester_ak" class="single-select form-control semester_ak">
                        <option value="GANJIL">GANJIL</option>
                        <option value="GENAP">GENAP</option>
                    </select>
                </div>
            </div>
            <div class="col-6 col-md-3 col-lg-3 col-xl-2">
                <div class="form-group">
                    <select name="tahun_ak" class="single-select form-control tahun_ak">
                        @foreach ($param->keyBy('tahun_ak') as $item)  
                        <option value="{{ $item->tahun_ak }}">{{ $item->tahun_ak }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-3">
                <div class="form-group">
                    <button class="btn btn-info" id="exportProdi">Export Jadwal {{ auth()->user()->dosen->prodi->nm_prodi }}</button>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-3">
                <div class="form-group">
                    <button class="btn btn-info" id="exportSemua">Export Jadwal Keseluruhan</button>
                </div>
            </div>
          </div>    
        </form>
        <div class="table-responsive">
          <div id="tampil"></div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade text-left" id="alertPertanyaan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content bg-kaprodi">
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


@include('pekerja.kaprodi.jadwal.form')

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
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="{{ asset('toolspekerja/js/mdb.min.js') }}"></script>
  <!-- Custom scripts -->
  <script>
    $('#jam_mulai').pickatime({
      twelvehour: false,
    });
    $('#jam_seles').pickatime({
      // 12 or 24 hour
      twelvehour: false,
    });

  </script>
    

  {{-- Menentukan Tahun dan Semester --}}
  <script> 
    $(document).ready(function(){
        let sekarang = new Date();
        let tahun = sekarang.getFullYear();
        for (let i = tahun; i > tahun - 3; i--) {
            $('#tahun_ak').append('<option value="' + i + '">' + i + '</option>');
        }
        let bulan = sekarang.getMonth();
        let semester_ak;
        bulan > 6 ? semester_ak="GANJIL" : semester_ak="GENAP";
        $('.semester_ak, #semester_ak').val(semester_ak).trigger('change')         
        $('.tahun_ak').val(tahun).trigger('change');
    });
  </script>
  {{-- Load Data --}}
  <script>
    //    Parameter Jadwal
    $(document).ready(function(){
        $('.semester_ak').on('change', function(){
            loadMoreData();
        })
    });
    $(document).ready(function(){
        $('.tahun_ak').on('change', function(){
            loadMoreData();
        })
    });
    // Load Data
    function loadMoreData() {
        $(document).ready(function(){
            let semester_ak=$('.semester_ak').val();
            let tahun_ak=$('.tahun_ak').val();
            $.ajax({
                url: '',
                type: "get",
                datatype: "html",
                data:{
                    'semester_ak':semester_ak,
                    'tahun_ak':tahun_ak,
                },
                success:function(data){
                    $('#tampil').html(data);
                }
            })
            .fail(function(jqXHR, ajaxOptions, thrownError)
            {
                alert('Server tidak merespon...');
            });
        })
    }
    loadMoreData();
  </script>
  {{-- Export Excel --}}
  <script>
   $(document).ready(function(){
     $('#exportProdi').on('click',function(e){
        e.preventDefault();
        $('#id_prodi').val($('#id_prodi').data('id'));
        $('#exportExcel').attr('action', "{{ route('exportExcelPerProdi') }}").submit();
     })
     $('#exportSemua').on('click',function(e){
        e.preventDefault();
        $('#id_prodi').val("");
        $('#exportExcel').attr('action', "{{ route('exportExcelPerProdi') }}").submit();
     })
   })
  </script>
  {{-- Tambah Data --}}
  <script>  
    $('#tambah').click(function(){
        save_method="add"
        $('#judul').html('From Tambah Data')
        $('#tombolForm').html('Simpan Data')
        $('.tampilModal').modal('show')
    });

    $(document).ready(function () {
        $("#formKu").on('submit',function(e){
          e.preventDefault();
          let id = $('#id').val();
          let dataKu = $('#formKu').serialize();
          if (save_method=="add") { 
              url="{{ route('kaprodiJadwal.store') }}"
              method="POST"
          } else {
              url="kaprodiJadwal/"+id
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
            
              $('#id_matkul').val('').trigger('change');
              $('#id_ruang').val('').trigger('change');
              $('#id_dosen').val('').trigger('change');
              $('#hari').val('').trigger('change');
              $('#jam_mulai').val('');
              $('#jam_seles').val('');
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