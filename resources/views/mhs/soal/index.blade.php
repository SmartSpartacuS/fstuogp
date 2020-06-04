@extends('mhs.layouts.default')

@section('judul','Soal')

@section('content')

<div class="row">
    <div class="col-xl-12">
        <div class="card m-b-30">
            <div class="card-body">

                <input type="hidden" name="seles" id="seles" value="{{ $waktu->seles }}">
                <input type="hidden" name="tgl" id="tgl" value="{{ $waktu->tgl }}">

                <h4 class="mt-0 header-title">Waktu Sekarang : <span id="jam"></span><span id="menit"></span><span id="detik"></span></h4>
                <h4 class="mt-0 header-title">Waktu Mulai : {{ $waktu->mulai }} </h4>
                <h4 class="mt-0 header-title">Waktu Selesai : {{ $waktu->seles }}</h4>
            </div>
        </div>
    </div>

    <div class="col-xl-12">
        <div class="card m-b-30">
            <div class="card-body">

                <form action="{{ route('jawaban.store') }}" method="post" id="jawaban">
                    @csrf
                <h4 class="mt-0 header-title">Soal Pilihan Ganda</h4>
                <hr>
                @foreach ($soal as $item)
                    <p class="font-14 mb-0"><span>{{ $loop->iteration }}. </span>{{ $item->pertanyaan }}</p> 
                        

                        @if ($item->jenis_soal=="Pilihan")
                        
                            <input type="hidden" name="id_soal[{{ $loop->iteration }}]" id="" value="{{ $item->id }}">
                        <div class="row ml-2">
                            <div class="col-xl-6 col-md-6">
                                {{-- Pilihan A --}}
                                <input type="radio" name="jawaban[{{ $loop->iteration }}]" id="{{ $item->pilihan_a }}{{ $item->id }}" value="{{ $item->pilihan_a }}">
                                <label for="{{ $item->pilihan_a }}{{ $item->id }}">{{ $item->pilihan_a }}</label>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                {{-- Pilihan B --}}
                                <input type="radio" name="jawaban[{{ $loop->iteration }}]" id="{{ $item->pilihan_b }}{{ $item->id }}" value="{{ $item->pilihan_b }}">
                                <label for="{{ $item->pilihan_b }}{{ $item->id }}">{{ $item->pilihan_b }}</label>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                {{-- Pilihan C --}}
                                <input type="radio" name="jawaban[{{ $loop->iteration }}]" id="{{ $item->pilihan_c }}{{ $item->id }}" value="{{ $item->pilihan_c }}">
                                <label for="{{ $item->pilihan_c }}{{ $item->id }}">{{ $item->pilihan_c }}</label>
                            </div>
                            <div class="col-xl-6 col-md-6">
                            {{-- Pilihan D --}}
                                <input type="radio" name="jawaban[{{ $loop->iteration }}]" id="{{ $item->pilihan_d }}{{ $item->id }}" value="{{ $item->pilihan_d }}">
                                <label for="{{ $item->pilihan_d }}{{ $item->id }}">{{ $item->pilihan_d }}</label>
                            </div>
                        </div>

                            {{-- Terpilih --}}
                            <input type="radio" style="display:none" name="jawaban[{{ $loop->iteration }}]" id="{{ $item->pilihan_a }}{{ $item->id }}" value="Kosong" checked>
                            {{-- Tutup --}}
                        @else
                            <input type="hidden" name="id_soal[{{ $loop->iteration }}]" id="" value="{{ $item->id }}">
                            <div class="form-group ml-3">
                                <div>
                                    <textarea  name="jawaban[{{ $loop->iteration }}]" class="form-control" rows="5" cols="5"></textarea>
                                </div>
                            </div>
                        @endif

                        <input type="hidden" name="waktu_jawab" class="waktu_jawab" >
                          
                @endforeach
                <button type="button" class="btn btn-primary btn-lg btn-block mt-5" data-toggle="modal" data-target=".bs-example-modal-center">Selesai Menjawab</button>
            </form>
                <!-- Nav tabs -->
            </div>
        </div>
    </div>
</div>
<!-- end row -->

{{-- <div class="col-sm-6 col-md-4 col-xl-3 m-b-30">
    <p class="text-muted">Alert Dialog</p>
    <button type="button" class="btn btn-primary" id="habis">Click me</button>
</div> --}}

{{-- Modal --}}
<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Yakin Dengan Jawaban Anda ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Jawaban anda akan langsung disimpan dalam database dan tidak dapat diubah!</p>
            </div>
            <div class="modal-footer">
                <button type="button" id="mulai" class="btn btn-primary">Yakin</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


@endsection

@section('script')
<!-- Alertify js -->
<script src="{{ asset('toolsMhs/plugins/alertify/js/alertify.js') }}"></script>
<script src="{{ asset('toolsMhs/pages/alertify-init.js') }}"></script>

<script>
$(document).ready(function () {
    //Disable cut copy paste
    $('body').bind('cut copy paste', function (e) {
        e.preventDefault();
    });
   
    //Disable mouse right click
    $("body").on("contextmenu",function(e){
        return false;
    });
});
</script>

<script>
    $('#mulai').click(function(){
        $('#jawaban').submit()
    })
</script>


<script>
    window.setTimeout("waktu()", 1000);
    
    function waktu() {
        let waktu = new Date();
        setTimeout("waktu()", 1000);
        $("#jam").html(waktu.getHours() + ':')
        $("#menit").html(waktu.getMinutes() + ':')
        $("#detik").html(waktu.getSeconds())
    }
</script>

<script src="{{ asset('toolsMhs/js/waktu.js') }}"></script>


@endsection