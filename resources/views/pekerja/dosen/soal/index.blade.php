<?php 
use Illuminate\Support\Carbon;
?>
@extends('pekerja.dosen.layouts.default')

@section('judul','Soal UAS')
@section('Aturan','active')

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
<input type="hidden" name="id_menu" id="id_menu" value="{{ $jadwal->id }}">
<div class="content-body">
    <!-- Zero configuration table -->
    <section id="horizontal-vertical">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Aturan UAS</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                @if ($aturan)
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Kode Matkul</th>
                                            <th>Nama Matkul</th>
                                            <th>Jenis UAS</th>
                                            <th>Mulai</th>
                                            <th>Batas</th>
                                            <th>Sisa Waktu</th>
                                            <th colspan="2">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($aturan)
                                        <input type="hidden" id="waktuSelesUas" value="{{ $aturan->aturan_seles }}">
                                        <tr class="double_aturan" data-id='{{ $aturan->id }}'>
                                            <td>{{ $aturan->jadwal->matkul->kd_matkul }}</td>
                                            <td>{{ $aturan->jadwal->matkul->nm_matkul }}</td>
                                            <td>{{ $aturan->jenis_tujuan }}</td>
                                            <td>
                                                {{ Carbon::createFromFormat('Y-m-d H:i:s', $aturan->aturan_mulai)->format('d-m-Y H:i:s') }}
                                            </td>
                                            <td>
                                                {{ Carbon::createFromFormat('Y-m-d H:i:s', $aturan->aturan_seles)->format('d-m-Y H:i:s') }}
                                            </td>
                                            <td><div id="demo"></div></td>
                                            <td>
                                                <a href="{{ route('aturan.edit',$aturan->id) }}" class="btn btn-warning white-text" id="btnUbahAturan"> Edit</a>
                                            </td>
                                            <td>
                                                <a href="#" data-id="{{route('aturan.destroy',$aturan->id)}}" class="btn btn-danger white-text" id="btnHapusAturan"> Hapus</a>
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                                @else
                                    @include('pekerja.dosen.aturan.form')
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Tampilan Soal --}}
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
                            <p class="card-text">Untuk menghapus data silahkan klik 2x pada data yang ingin dihapus.</p>
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
                <button type="button" class="btn btn-warning btnUbah" id="btnUbah"><i class="feather icon-edit"></i> Ubah</button>
                <button type="button" class="btn btn-danger btnHapus" id="btnHapus"><i class="feather icon-trash-2"></i> Hapus</button>
            </div>
        </div>
    </div>
</div>




@include('pekerja.dosen.soal.form') 

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

<script src="{{ asset('toolsAdmin/daterange/moment.min.js') }}"></script>
<script src="{{ asset('toolsAdmin/daterange/daterangepicker.js') }}"></script>
<script src="{{ asset('toolsAdmin/countdown/countdown.js') }}"></script>

<script>
    let seles=$('#waktuSelesUas').val()
    SisaWaktuUas(seles)
</script>



<script>

    // Select menu
    $(document).ready(function(){
        $(function() {
            $('.dateTimeKu').daterangepicker({
                timePicker24Hour: true,
                "locale": {
                    "format": "DD/MM/YYYY|HH:MM",
                    "separator": " - ",
                    "applyLabel": "Apply",
                    "cancelLabel": "Cancel",
                    "fromLabel": "From",
                    "toLabel": "To",
                    "customRangeLabel": "Custom",
                    "weekLabel": "W",
                    "daysOfWeek": [
                        "Su",
                        "Mo",
                        "Tu",
                        "We",
                        "Th",
                        "Fr",
                        "Sa"
                    ],
                    "monthNames": [
                        "Januari",
                        "Februari",
                        "Maret",
                        "April",
                        "Mai",
                        "Juni",
                        "Juli",
                        "Agustus",
                        "September",
                        "Oktober",
                        "November",
                        "Desember"
                    ],
                    "firstDay": 1
                },
                timePicker: true,
                startDate: moment().startOf('hour'),
                endDate: moment().startOf('hour').add(32, 'hour'),
            });
        });



        let id_menu=$('#id_menu').val()
        $('li #soal'+id_menu).addClass("active");
        console.log(id_menu);
        
    });
    // Matikan Keyboard
    $(function() {
        $('.mati').keypress(function(event) {
                event.preventDefault();
                return false;
            });
        });
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
        $('#id_prodi').val('').trigger('change');
        $('#status').val('').trigger('change');
        $('#jabatan').val('').trigger('change');
        $('.tampilModal').modal('show')
    });

    $(document).ready(function () {
        $("#formKu").on('submit',function(e){
          e.preventDefault();
          let id = $('#id').val();
          let dataKu = $('#formKu').serialize();
          if (save_method=="add") { 
              url="{{ route('dosen.store') }}"
              method="POST"
          } else {
              url="dosen/"+id
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
            
              $('#NIDN').val('');
              $('#nm_dosen').val('');
              $('#alamat').val('');
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

