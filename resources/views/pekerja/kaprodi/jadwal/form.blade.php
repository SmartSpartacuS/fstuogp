<div class="modal fade tampilModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-kaprodi border-primary animated jackInTheBox">
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
                        <div class="col-sm-12 col-lg-6 col-xl-3">
                            <div class="form-group">
                                <div class="controls">
                                    <label for="tahun_ak">Tahun</label>
                                    <select name="tahun_ak" id="tahun_ak" class="single-select form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6 col-xl-4">
                          <div class="form-group">
                              <div class="controls">
                                  <label for="semester_ak">Semester</label>
                                  <select name="semester_ak" id="semester_ak" class="single-select form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                    <option value="GANJIL">GANJIL</option>
                                    <option value="GENAP">GENAP</option>
                                </select>
                              </div>
                          </div>
                        </div>
                        <div class="col-sm-12 col-lg-12 col-xl-5">
                            <div class="form-group">
                                <div class="controls">
                                    <label for="id_ruang">Pilih Ruangan</label>
                                    <select name="id_ruang" id="id_ruang" class="single-select form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                        <option value="">Pilih Ruang</option>
                                      @foreach ($ruang as $item)  
                                          <option value="{{ $item->id }}">{{ $item->nm_ruang }}</option>
                                      @endforeach
                                   </select>
                                </div>
                            </div>
                          </div>
                        <div class="col-sm-12 col-lg-12 col-xl-12">
                          <div class="form-group">
                              <div class="controls">
                                  <label for="id_matkul">Mata Kuliah</label>
                                  <select name="id_matkul" id="id_matkul" class="single-select form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                      <option value="">Pilih Matkul</option>
                                    @foreach ($matkul as $item)  
                                        <option value="{{ $item->id }}">{{ $item->kd_matkul }}-{{ $item->nm_matkul }}</option>
                                    @endforeach
                                 </select>
                              </div>
                          </div>
                        </div>
                        <div class="col-sm-12 col-lg-12 col-xl-12">
                          <div class="form-group">
                              <div class="controls">
                                  <label for="id_dosen">Dosen</label>
                                  <select name="id_dosen" id="id_dosen" class="single-select form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                      <option value="">Pilih Dosen</option>
                                    @foreach ($dosen as $item)  
                                        <option value="{{ $item->id }}">{{ $item->NIDN }}-{{ $item->nm_dosen }}</option>
                                    @endforeach
                                 </select>
                              </div>
                          </div>
                        </div>
                        <div class="col-sm-6 col-lg-4 col-xl-4">
                          <div class="form-group">
                              <div class="controls">
                                  <label for="hari">Hari</label>
                                  <select name="hari" id="hari" class="single-select form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                      <option value="">Pilih Hari</option>
                                      <option value="Senin">Senin</option>
                                      <option value="Selasa">Selasa</option>
                                      <option value="Rabu">Rabu</option>
                                      <option value="Kamis">Kamis</option>
                                      <option value="Jumat">Jumat</option>
                                      <option value="Sabtu">Sabtu</option>
                                 </select>
                              </div>
                          </div>
                        </div>
                        <div class="col-sm-3 col-lg-4 col-xl-4">
                          <div class="form-group">
                              <div class="controls">
                                  <label for="jam_mulai">Jam Mulai</label>
                                  <input type="time" name="jam_mulai" id="jam_mulai" class="form-control timepicker" required data-validation-required-message="Tidak Boleh Kosong">
                              </div>
                          </div>
                        </div>
                        <div class="col-sm-3 col-lg-4 col-xl-4">
                          <div class="form-group">
                              <div class="controls">
                                  <label for="jam_seles">Jam Selesai</label>
                                  <input type="time" name="jam_seles" id="jam_seles" class="form-control timepicker" required data-validation-required-message="Tidak Boleh Kosong">
                              </div>
                          </div>
                        </div>
                    </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-info" id="tombolForm"></button>
                      </div>
                </form>
            </div>
        </div>
    </div>
</div>