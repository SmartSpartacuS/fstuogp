<div class="modal fade tampilModal">
    <div class="modal-dialog">
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
                                <label for="dosen_id">Dosen Wali</label>
                                <select name="dosen_id" id="dosen_id" class="single-select form-control" required data-validation-required-message="Tidak Boleh Kosong"> 
                                    <option value="">Pilih Dosen Wali</option>
                                    @foreach ($dosen as $item)
                                        <option value="{{ $item->id }}">{{ $item->NIDN }} - {{ $item->nm_dosen }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                            <div class="controls">
                                <label for="mhs_id">Mahasiswa</label>
                                <select name="mhs_id" id="mhs_id" class="single-select form-control" required data-validation-required-message="Tidak Boleh Kosong"> 
                                    <option value="">Pilih Mahasiswa</option>
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
        </div>
    </div>
</div>
