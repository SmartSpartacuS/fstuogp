<div class="modal fade tampilModal text-left" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document"">
        <div class="modal-content">
            <div class="modal-header bg-primary white">
                <h4 class="modal-title text-white" id="judul">Tambah Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" id="formKu" novalidate>
                @csrf
                <input type="hidden" name="id" id="id">
                <input type="hidden" id="id_prodi" name="id_prodi" value="{{ $prodi->id }}">
                <div class="row">
                  <div class="col-sm-12 col-lg-4 col-xl-4">
                      <div class="form-group">
                          <div class="controls">
                              <label for="NPM">NPM</label>
                              <input type="text" name="NPM" id="NPM" class="form-control" data-validation-regex-regex="([^a-z]*[A-Z]*)*" data-validation-containsnumber-regex="([^0-9]*[0-9]+)+" data-validation-required-message="6 Digit Terakhir" maxlength="6" minlength="6" placeholder="6 Digit Terakhir">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-12 col-lg-8 col-xl-8">
                      <div class="form-group">
                          <div class="controls">
                              <label for="nm_mhs">Nama Mahasiswa</label>
                              <input type="text" name="nm_mhs" id="nm_mhs" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-12 col-lg-8 col-xl-8">
                      <div class="form-group">
                          <div class="controls">
                            <label>Jenis Kelamin</label>
                            <ul class="list-unstyled mb-0">
                                <li class="d-inline-block mr-2">
                                    <fieldset>
                                        <div class="vs-radio-con">
                                            <input type="radio" name="jenkel" checked value="Laki-laki">
                                            <span class="vs-radio">
                                                <span class="vs-radio--border"></span>
                                                <span class="vs-radio--circle"></span>
                                            </span>
                                            <span class="">Laki-laki</span>
                                        </div>
                                    </fieldset>
                                </li>
                                <li class="d-inline-block mr-2">
                                    <fieldset>
                                        <div class="vs-radio-con">
                                            <input type="radio" name="jenkel" value="Perempuan">
                                            <span class="vs-radio">
                                                <span class="vs-radio--border"></span>
                                                <span class="vs-radio--circle"></span>
                                            </span>
                                            <span class="">Perempuan</span>
                                        </div>
                                    </fieldset>
                                </li>
                            </ul>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-12 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <div class="controls">
                            <label for="angkatan">Angkatan</label>
                            <select name="angkatan" id="angkatan" class="select2 form-control" required data-validation-required-message="Tidak Boleh Kosong">
                            </select>
                        </div>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                        <div class="controls">
                            <label for="alamat">Alamat</label>
                            <input type="text" name="alamat" id="alamat" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
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
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
