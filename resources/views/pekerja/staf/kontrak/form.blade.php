<div class="modal fade tampilModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content bg-staf border-primary animated jackInTheBox">
            <div class="modal-header border-light-2">
                <h5 id="judul" class="modal-title text-white"></h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div> 
            <div class="modal-body">
                <form class="form-horizontal" id="formKu" novalidate>
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <div class="controls">
                                    <label for="NPM">NPM - Nama</label>
                                    <select name="perwalian_id" id="perwalian_id" class="single-select form-control" required data-validation-required-message="Tidak Boleh Kosong"> 
                                        <option value="">Pilih Mahasiswa</option>
                                        @foreach ($perwalian as $item)
                                            <option value="{{ $item->id }}">{{ $item->mhs->NPM }} - {{ $item->mhs->nm_mhs }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6 col-xl-4">
                            <div class="form-group">
                                <div class="controls">
                                    <label for="tahun_ak">Tahun</label>
                                    <select name="tahun_ak" id="tahun_ak" class="single-select form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                        <option value="2019">2019-2020</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6 col-xl-4">
                            <div class="form-group">
                                <div class="controls">
                                    <label for="semester_ak">Semester</label>
                                    <select name="semester_ak" id="semester_ak" class="single-select form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                      {{-- <option value="GANJIL">GANJIL</option> --}}
                                      <option value="GENAP">GENAP</option>
                                  </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-8 col-xl-4">
                            <div class="form-group">
                                <div class="controls">
                                    <label for="tgl_krs">Tgl. Pengisian KRS</label>
                                    <input type="date" name="tgl_krs" id="tgl_krs" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <div class="controls" id="pilihMatkul">
                                    <label for="my_multi_select2">Pilih Matkulih yang dikontrak</label>
                                    <select style="width: 500px" multiple="multiple" id="my_multi_select2" name="jadwal_id[]">
                                        {{-- <option value="" selected disabled></option> --}}
                                        @foreach ($matkul as $item)
                                        <optgroup label="{{ $item->hari }}">
                                            <option value="{{  $item->id }}">{{ $item->matkul->nm_matkul }}</option>
                                        </optgroup>
                                        @endforeach
                                      </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12" id="listKontrak" style="display: none;">
                            <div class="form-group">
                                <div class="controls">
                                    <h5 class="text-center">Mata Kuliah yang dikontrak.</h5>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <td>Nama Matkul</td>
                                                <td>Hari</td>
                                            </tr>
                                        </thead>
                                        <tbody id="tbodyKontrak">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                      <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="tombolForm"></button>
                      </div>
                </form>
            </div>
        </div>
    </div>
</div>
