<div class="modal fade tampilModal">
    <div class="modal-dialog">
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
                        <div class="col-sm-5 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <div class="controls">
                                    <label for="NIDN">NIDN</label>
                                    <input type="text" name="NIDN" id="NIDN" class="form-control nomor" required data-validation-required-message="Tidak Boleh Kosong" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-7 col-lg-8 col-xl-8">
                            <div class="form-group">
                                <div class="controls">
                                    <label for="nm_dosen">Nama Dosen</label>
                                    <input type="text" name="nm_dosen" id="nm_dosen" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <div class="controls">
                                  <label>Jenis Kelamin</label>
                                  <ul class="list-unstyled mb-0">
                                      <li class="d-inline-block mr-2">
                                          <fieldset>
                                              <div class="vs-radio-con">
                                                  <input type="radio" name="jenkel" id="Laki-laki" checked value="Laki-laki">
                                                  <span class="vs-radio">
                                                      <span class="vs-radio--border"></span>
                                                      <span class="vs-radio--circle"></span>
                                                  </span>
                                                  <label for="Laki-laki">Laki-laki</label>
                                              </div>
                                          </fieldset>
                                      </li>
                                      <li class="d-inline-block mr-2">
                                          <fieldset>
                                              <div class="vs-radio-con">
                                                  <input type="radio" name="jenkel" id="Perempuan" value="Perempuan">
                                                  <span class="vs-radio">
                                                      <span class="vs-radio--border"></span>
                                                      <span class="vs-radio--circle"></span>
                                                  </span>
                                                  <label for="Perempuan">Perempuan</label>
                                              </div>
                                          </fieldset>
                                      </li>
                                  </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <div class="controls">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control single-select" required data-validation-required-message="Tidak Boleh Kosong">
                                      <option value="">Pilih Status</option>
                                      <option value="Tetap">Tetap</option>
                                      <option value="Luar">Luar</option>
                                  </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-12 col-xl-12">
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
                        <button type="submit" class="btn btn-info" id="tombolForm"></button>
                      </div>
                </form>
            </div>
        </div>
    </div>
</div>