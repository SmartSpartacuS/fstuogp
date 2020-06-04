<div class="modal fade tampilModal text-left" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document"">
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
                <div class="row">
                  <div class="col-sm-12 col-lg-7 col-xl-7">
                      <div class="form-group">
                          <div class="controls">
                              <label for="nm_staf">Nama</label>
                              <input type="text" name="nm_staf" id="nm_staf" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-12 col-lg-5 col-xl-5">
                    <div class="form-group">
                        <div class="controls">
                            <label for="id_prodi">Progdi</label>
                            <select name="id_prodi" id="id_prodi" class="form-control select2" required data-validation-required-message="Tidak Boleh Kosong">
                                <option value="">Pilih Prodi</option>
                                @foreach ($allProdi as $item)
                                  <option value="{{ $item->id }}">{{ $item->nm_prodi }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                  </div>
                  <div class="col-sm-12 col-lg-7 col-xl-7">
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
                  <div class="col-sm-12 col-lg-5 col-xl-5">
                    <div class="form-group">
                        <div class="controls">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
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
                    <button type="submit" class="btn btn-primary" id="tombolForm"></button>
                  </div>
              </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
