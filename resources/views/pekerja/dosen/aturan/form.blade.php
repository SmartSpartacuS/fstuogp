<h6 class="mb-2">Sebelum Membuat Soal UAS. Silahkan Membuat Aturan UAS Terlebih Dahulu.</h6>
<form class="form form-horizontal" method="POST" action="{{ route('aturan.store') }}" novalidate>
    @csrf
    <input type="hidden" name="jadwal_id" id="jadwal_id" value="{{ $jadwal->id }}">
    <div class="form-body">
        <div class="row">
            <div class="col-12">
                <div class="form-group row">
                    <div class="col-md-3">
                        <span>Tgl, Jam Mulai dan Selesai</span>
                    </div>
                    <div class="col-md-8">
                        <div class="position-relative has-icon-left">
                            <input type="text" name="waktu" id="waktu" class="dateTimeKu form-control" required data-validation-required-message="Tidak Boleh Kosong">
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
                                                <input type="radio" name="jenis_tujuan" value="Soal" checked>
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
                                                <input type="radio" name="jenis_tujuan"  value="Tugas">
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