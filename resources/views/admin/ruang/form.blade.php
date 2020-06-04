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
                              <label for="kd_ruang">Kode Ruang</label>
                              <input type="text" name="kd_ruang" id="kd_ruang" class="form-control" required data-validation-required-message="Tidak Boleh Kosong" autocomplete="off">
                          </div>
                          <div></div>
                      </div>
                  </div>
                  <div class="col-sm-7 col-lg-8 col-xl-8">
                      <div class="form-group">
                          <div class="controls">
                              <label for="nm_ruang">Nama Ruang</label>
                              <input type="text" name="nm_ruang" id="nm_ruang" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
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
