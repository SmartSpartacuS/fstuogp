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
<input type="hidden" name="id_menu" id="id_menu" value="{{ $aturan->jadwal_id }}">
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
                                <h6 class="mb-2">Silahkan Mengubah Aturan UAS</h6>
                                <form class="form form-horizontal" method="POST" action="{{ route('aturan.update',$aturan->id) }}" novalidate>
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="id" id="id" value="{{ $aturan->id }}">
                                    <input type="hidden" name="jadwal_id" id="jadwal_id" value="{{ $aturan->jadwal_id }}">
                                    <input type="hidden" name="aturan_mulai" id="aturan_mulai" value="{{ Carbon::createFromFormat('Y-m-d H:i:s', $aturan->aturan_mulai)->format('d-m-Y H:i:s') }}">
                                    <input type="hidden" name="aturan_seles" id="aturan_seles" value="{{ Carbon::createFromFormat('Y-m-d H:i:s', $aturan->aturan_seles)->format('d-m-Y H:i:s') }}">
                                     
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group row">
                                                    <div class="col-md-3">
                                                        <span>Tgl, Jam Mulai dan Selesai</span>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="position-relative has-icon-left">
                                                            <input type="text" name="waktu" id="waktu" class="dateTimeKu mati form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                                            <div class="form-control-position">
                                                                <i class="feather icon-user"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group row">
                                                    <div class="col-md-3">
                                                        <span>Jenis UAS</span>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="position-relative has-icon-left">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                <ul class="list-unstyled mb-0">
                                                                    <li class="d-inline-block mr-2">
                                                                        <fieldset>
                                                                            <div class="vs-radio-con">
                                                                                <input type="radio" name="jenis_tujuan" value="Soal" @if ($aturan->jenis_tujuan=="Soal")
                                                                                    checked
                                                                                @endif>
                                                                                <span class="vs-radio">
                                                                                    <span class="vs-radio--border"></span>
                                                                                    <span class="vs-radio--circle"></span>
                                                                                </span>
                                                                                <span class="">Soal</span>
                                                                            </div>
                                                                        </fieldset>
                                                                    </li>
                                                                    <li class="d-inline-block mr-2">
                                                                        <fieldset>
                                                                            <div class="vs-radio-con">
                                                                                <input type="radio" name="jenis_tujuan"  value="Tugas" @if ($aturan->jenis_tujuan=="Tugas")
                                                                                    checked
                                                                                @endif > 
                                                                                <span class="vs-radio">
                                                                                    <span class="vs-radio--border"></span>
                                                                                    <span class="vs-radio--circle"></span>
                                                                                </span>
                                                                                <span class="">Tugas</span>
                                                                            </div>
                                                                        </fieldset>
                                                                    </li>
                                                                </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-8 offset-md-3">
                                                <button type="submit" class="btn btn-primary mr-1 mb-1">Simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ Zero configuration table -->
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

<script src="{{ asset('toolsAdmin/daterange/moment.min.js') }}"></script>
<script src="{{ asset('toolsAdmin/daterange/daterangepicker.js') }}"></script>



<script>

    // Select menu
    $(document).ready(function(){
        $(function() {
            let aturan_mulai=$('#aturan_mulai').val();
            let aturan_seles=$('#aturan_seles').val();

            console.log(aturan_mulai)
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
                startDate: aturan_mulai,
                endDate: aturan_seles,
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





@endsection

