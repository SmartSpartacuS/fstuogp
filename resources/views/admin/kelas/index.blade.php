
@extends('admin.layouts.default')

@section('judul','Kelas')

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

<link rel="stylesheet" type="text/css" href="{{ asset('toolsAdmin/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css') }}">
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
                        <h4 class="card-title" id="prodiActive" data-id="{{ $prodi->id }}">JADWAL {{ $prodi->nm_prodi }}</h4>    
                    </div>
                    <div class="card-header">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6 col-md-3 col-lg-3 col-xl-2">
                                    <div class="form-group">
                                        <select name="semester_ak" class="select2 form-control semester_ak">
                                            <option value="GANJIL">GANJIL</option>
                                            <option value="GENAP">GENAP</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 col-lg-3 col-xl-2">
                                    <div class="form-group">
                                        <select name="tahun" class="select2 form-control tahun_ak">
                                            @foreach ($param->keyBy('tahun_ak') as $item)  
                                            <option value="{{ $item->tahun_ak }}">{{ $item->tahun_ak }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
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

@include('admin.kelas.form')

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

<script src="{{ asset('toolsAdmin/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js') }}"></script>
<script src="{{ asset('toolsAdmin/js/scripts/forms/number-input.js') }}"></script>

{{-- Menentukan Tahun dan Semester --}}
<script>
     // Active Menu Prodi
     $(document).ready(function(){
        let active = $('#prodiActive').data('id');
        $('#kelas'+active).addClass("active");
    });
    $(document).ready(function () {
    //called when key is pressed in textbox
        $(".nomor").keypress(function (e) {
        //if the letter is not digit then display error and don't type anything
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });
    });
    
    $(document).ready(function(){
        let sekarang = new Date();
        let tahun = sekarang.getFullYear();
        for (let i = tahun; i > tahun - 3; i--) {
            $('#tahun_ak').append('<option value="' + i + '">' + i + '</option>');
        }
        let bulan = sekarang.getMonth();
        let semester_ak;
        bulan > 6 ? semester_ak="GANJIL" : semester_ak="GENAP";
        $('.semester_ak').val(semester_ak).trigger('change')         
        $('.tahun_ak').val(tahun).trigger('change');
    });
</script>

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
   
    // Load Modal
    $(document).ready(function(){
        $(".modal-content").addClass("animated " + "flipInY");
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

{{-- Tambah dan Ubah Data --}}
<script>  
    // $('.tambah').click(function(){
    //     save_method="add"   
    //     $('#judul').html('Tambah Data')
    //     $('#tombolForm').html('Simpan Data')
    //     $('.tampilModal').modal('show')
    // });

    $(document).ready(function () {
        $("#formKu").on('submit',function(e){
          e.preventDefault();
          let id = $('#id').val();
          let dataKu = $('#formKu').serialize();
          if (save_method=="add") { 
              url="{{ route('kelas.store') }}"
              method="POST"
          } else {
              url= id
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
                    
                }
                $('#formKu').trigger("reset");
              aksi=$('.tampilModal').modal('hide')
              loadMoreData();
            //   pesan
          }
          })
          .fail(function(jqXHR, ajaxOptions, thrownError)
            {
                alert('Error.');
            });
          console.log(save_method)
        });
    });

</script>

@endsection

