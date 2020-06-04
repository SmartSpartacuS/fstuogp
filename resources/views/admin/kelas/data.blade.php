<?php 
use Carbon\Carbon;
?>
<style>
    .hilang {
        display: none;
        text-transform:uppercase;
    }
</style>
<table class="table zero-configuration">
    <thead>
        <tr>
            <th>Hari</th>
            <th>Jam</th>
            <th>Kode MK</th>
            <th>Nama MK</th>
            <th>Ruang</th>
            <th>Kelas</th>
            <th>Kuota</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kelas as $item)
        <tr class="clickable-row" data-id='{{ $item->id }}' data-id_jadwal="{{ $item->jadwal_id }}">
            <td>{{ $item->hari }}</td>
            <td>{{ Carbon::parse($item->jam_mulai)->format('H:i') }}-{{ Carbon::parse($item->jam_seles)->format('H:i') }}</td>
            <td>{{ $item->matkul->kd_matkul }}</td>
            <td id="{{ $item->jadwal_id }}">{{ $item->matkul->nm_matkul }}</td>
            <td>{{ $item->ruang->kd_ruang }}</td>
            @if ($item->id)
                <td>{{ $item->nm_kelas }}</td>
                <td>{{ $item->kuota }}</td>
            @else
                <td></td>
                <td><button id="tambah" type="button" data-id="{{ $item->jadwal_id }}" class="btn btn-primary btn-relief-info">
                    <i class="feather icon-plus-circle"></i> Tambah Data
                </button> </td>
            @endif
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
                    let id_jadwal=$(this).data('id_jadwal');
                    let nm_matkul=$('#'+id_jadwal).html();
                    $('.ketForm').html('Silahkan Mengubah data Kelas Untuk Matakuliah '+nm_matkul)
                    $('#alertPertanyaan').modal('hide')
                    save_method="Ubah"
                    $.ajax({
                        url: href+"/edit", 
                        type: 'GET',
                        dataType: 'JSON',
                        beforeSend: function() {
                            // lakukan sesuatu sebelum data dikirim
                            console.log(href); 
                            },
                        success: function(data) {
                            // lakukan sesuatu jika data sudah terkirim
                            $('#id').val(data.id);
                            $('#id_jadwal').val(data.id_jadwal);
                            $('#nm_kelas').val(data.nm_kelas);
                            $('#kuota').val(data.kuota);
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
                            url: href,
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
    // Tampilkan Modal Edit
    $('button#tambah').on('click',function(e){
        e.preventDefault();
        let id_jadwal=$(this).data('id');
        let nm_matkul=$('#'+id_jadwal).html();
        save_method="add"
        $('#judul').html('Tambah Kelas')
        $('.ketForm').html('Silahkan Menambah Kelas Untuk Matakuliah '+nm_matkul)
        $('#id_jadwal').val(id_jadwal)
        $('#tombolForm').html('Simpan Data')
        $('.tampilModal').modal('show')
        $('#nm_kelas').val('')
        $('#kuota').val(0)
    });   
</script>


<script>
    $('.table').dataTable( {
        "ordering": false
        } );
</script>


