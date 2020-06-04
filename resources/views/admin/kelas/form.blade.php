<div class="modal fade tampilModal text-left" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document"">
        <div class="modal-content">
            <div class="modal-header bg-primary white">
                <h4 class="modal-title text-white" id="judul">Tambah Kelas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p class="ketForm"></p>
              <form class="form-horizontal" id="formKu">
                @csrf
                <input type="hidden" name="id" id="id">
                <input type="hidden" id="id_jadwal" name="id_jadwal">
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                        <div class="controls">
                            <label for="nm_kelas">Nama Kelas</label>
                            <select name="nm_kelas" id="nm_kelas" class="form-control">
                              <option value=""></option>
                              <option value="A">A</option>
                              <option value="B">B</option>
                            </select>
                        </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                        <div class="controls">
                          <label for="kuota">Kuota</label><br>
                            <div class="d-inline-block mb-1">
                              <div class="input-group">
                                  <input type="number" name="kuota" id="kuota" class="touchspin" value="0">
                              </div>
                          </div>
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
