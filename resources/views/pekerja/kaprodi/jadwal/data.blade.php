<?php 
use Carbon\Carbon;
?>
<style>
    .hilang {
        display: none;
        text-transform:uppercase;
    }
</style>

<table id="example" class="table table-bordered">
    <thead>
        <tr class="hilang">
            <th>UNIVERSITAS OTTOW GEISSLER PAPUA</th>
        </tr>
        <tr class="hilang">
            <th>FAKULTAS SAINS DAN TEKNOLOGI</th>
        </tr>
        <tr class="hilang">
            <th>JL.PERKUTUT KOTARAJA 99225 JAYAPURA</th>
        </tr>
        <tr class="hilang">
            <th>JADWAL KULIAH {{ $prodi }}</th>
        </tr>
        <tr class="hilang">
            <th>SEMESTER @foreach ($jadwal->keyBy('semester_ak') as $item) {{ $item->semester_ak }} @endforeach T.A @foreach ($jadwal->keyBy('tahun_ak') as $item)
                @if ($item->semester_ak=='GENAP')
                    {{ $item->tahun_ak-1 }}/{{ $item->tahun_ak }}
                @else
                    {{ $item->tahun_ak }}/{{ $item->tahun_ak+1 }}  
                @endif 
            @endforeach</th>
        </tr>
        <tr class="hilang">
            <th></th>
        </tr>
        <tr>
            <th>Hari</th>
            <th>Jam</th>
            <th>Mata Kuliah</th>
            <th>Kode MK</th>
            <th>SKS</th>
            <th>Progdi-SMT</th>
            <th>Ruang</th>  
            <th>Dosen</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($jadwal as $item)
        <tr class="clickable-row" data-id='{{ $item->id }}'>
            <td>{{ $item->hari }}</td>
            <td>{{ Carbon::parse($item->jam_mulai)->format('H:i') }}-{{ Carbon::parse($item->jam_seles)->format('H:i') }}</td>
            <td>{{ $item->matkul->nm_matkul }}</td>
            <td>{{ $item->matkul->kd_matkul }}</td>
            <td>{{ $item->matkul->sks }}</td>
            <td>{{ $item->prodi->kd_prodi }}-{{ $item->matkul->sks }}</td>
            <td>{{ $item->ruang->kd_ruang }}</td>
            <td>{{ $item->dosen->nm_dosen }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
    $(document).ready(function($) {
        $(".clickable-row").dblclick(function() {
            var href= $(this).data('id');
            $('#alertPertanyaan').modal('show')
                $('#btnUbah').on('click',function(e){
                    e.preventDefault()
                    $('#alertPertanyaan').modal('hide')
                    save_method="Ubah"
                    $.ajax({
                        url: "kaprodiJadwal/"+href+"/edit", 
                        type: 'GET',
                        dataType: 'JSON',
                        beforeSend: function() {
                            // lakukan sesuatu sebelum data dikirim
                            console.log(href); 
                            },
                        success: function(data) {
                            // lakukan sesuatu jika data sudah terkirim
                            $('#id').val(data.id);
                            $('#id_matkul').val(data.id_matkul).trigger('change');
                            $('#id_ruang').val(data.id_ruang).trigger('change');
                            $('#id_dosen').val(data.id_dosen).trigger('change');
                            $('#hari').val(data.hari).trigger('change');
                            $('#jam_mulai').val(data.jam_mulai);
                            $('#jam_seles').val(data.jam_seles);
                            $('.tampilModal').modal('show')
                            $('#judul').html('Silahkan Merubah Data')
                            $('#tombolForm').html('Ubah Data')
                        }
                    });
                    
                });
                $('#btnHapus').on('click',function(){
                    $('#alertPertanyaan').modal('hide')
                    var csrf_token=$('meta[name="csrf_token"]').attr('content');
                    Swal.fire({
                    title: 'Yakin?',
                    text: "Data akan dihapus secara permanen!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yakin',
                    cancelButtonText: 'Batal',
                    confirmButtonClass: 'btn btn-primary',
                    cancelButtonClass: 'btn btn-danger ml-1',
                    buttonsStyling: false,
                    }).then(function (result) {
                    if (result.value) {
                        $.ajax({
                            url: "kaprodiJadwal/"+href,
                            type : "POST",
                            data : {'_method' : 'DELETE', '_token' :csrf_token},
                            success: function(response) {
                                Swal.fire({
                                        type: "success",
                                        title: 'Deleted!',
                                        text: 'Your file has been deleted.',
                                        confirmButtonClass: 'btn btn-success',
                                    })
                                loadMoreData();
                            }
                        })
                    }
                })
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.table').dataTable( {
            "ordering": false
        });
    });
</script>
