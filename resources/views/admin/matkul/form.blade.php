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
                <div class="row">
                  <div class="col-sm-5 col-lg-4 col-xl-4">
                      <div class="form-group">
                          <div class="controls">
                              <label for="kd_matkul">Kode Matkul</label>
                              <input type="text" name="kd_matkul" id="kd_matkul" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-7 col-lg-8 col-xl-8">
                      <div class="form-group">
                          <div class="controls">
                              <label for="nm_matkul">Nama Mata Kuliah</label>
                              <input type="text" name="nm_matkul" id="nm_matkul" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6 col-lg-6 col-xl-6">
                      <div class="form-group">
                          <div class="controls">
                              <label for="sks">SKS</label>
                              <input type="text" name="sks" id="sks" class="form-control nomor" required data-validation-required-message="Tidak Boleh Kosong">
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6 col-lg-6 col-xl-6">
                      <div class="form-group">
                          <div class="controls">
                              <label for="semester">Semester</label>
                              <select name="semester" id="semester" class="select2 form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                <option value="">Pilih Semester</option>
                                @for ($i = 1; $i <= 8; $i++)
                                  <option value="{{ $i }}">Semester {{ $i }}</option>
                                @endfor
                                <option value="Pilihan">Smester Pilihan</option>
                             </select>
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
