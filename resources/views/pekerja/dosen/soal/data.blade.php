<table class="table tableKu">
    <thead>
        <tr>
            <th>Kode Matkul</th>
            <th>Nama Matkul</th>
            <th>Jenis UAS</th>
            <th>Mulai</th>
            <th>Selesai</th>
        </tr>
    </thead>
    <tbody>
        @if ($aturan)
        <tr class="clickable-row" data-id='{{ $aturan->id }}'>
            <td>{{ $aturan->jadwal->matkul->kd_matkul }}</td>
            <td>{{ $aturan->jadwal->matkul->nm_matkul }}</td>
            <td>{{ $aturan->jenis_tujuan }}</td>
            <td>{{ $aturan->aturan_mulai }}</td>
            <td>{{ $aturan->aturan_seles }}</td>
        </tr>
        @endif
    </tbody>
</table>


<script>
    var href;
    // Soal
    $(document).ready(function($) {
        $(".clickable-row").dblclick(function() {
            href= $(this).data('id');
            $('#alertPertanyaan').modal('show')
            $('.btnUbah').attr('id','btnUbah');    
            $('.btnHapus').attr('id','btnHapus');    
        });
    });

    $('#btnUbah').off('click').on('click',function(e){
        e.preventDefault()
        $('#alertPertanyaan').modal('hide')
        save_method="Ubah"
        $.ajax({
            url: "soalDosen/"+href+"/edit", 
            type: 'GET',
            dataType: 'JSON',
            beforeSend: function() {
                // lakukan sesuatu sebelum data dikirim
                console.log(href); 
                },
            success: function(data) {
                // lakukan sesuatu jika data sudah terkirim
                $('#id').val(data.id);
                $('#NPM').val(data.NPM);
                $('#nm_mhs').val(data.nm_mhs);
                $('#angkatan').val(data.angkatan).trigger('change');
                if (data.jenkel == 'Laki-laki') {
                    $('input:radio[name=jenkel][value="Laki-laki"]').prop('checked', true)
                } else {
                    $('input:radio[name=jenkel][value="Perempuan"]').prop('checked', true)
                }
                $('#alamat').val(data.alamat);
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
                url: "soalDosen/"+href,
                type : "POST",
                data : {'_method' : 'DELETE', '_token' :csrf_token},
                success: function(response) {
                    Swal.fire({
                            type: "success",
                            title: 'hapus!',
                            text: 'Berhasil Dihapus.',
                            confirmButtonClass: 'btn btn-success',
                        })
                    loadMoreData();
                    }
                })
            }
        })
    });

    // Hapus Aturan
    $('#btnHapusAturan').on('click',function(){
        let id=$(this).data('id');
        Swal.fire({
        title: 'Yakin?',
        text: "Data Akan Dihapus Secara Permanen!",
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
            document.getElementById('deleteForm').action=id;
            document.getElementById('deleteForm').submit();
            Swal.fire({
                    type: "success",
                    title: 'hapus!',
                    text: 'Berhasil Dihapus.',
                    confirmButtonClass: 'btn btn-success',
                })
            }
        })
    });
</script>

<form action="" method="POST" id="deleteForm">
    @csrf
    @method("DELETE")
    <input type="submit" value="Hapus" style="display:none">
</form>

<script>
    $(document).ready(function() {
            let table = $('.tableKu').DataTable( {
                "columnDefs": [ {
                "searchable": false,
                "orderable": false,
                "targets": 0
                } ],
                order: [[ 2, "asc" ]],
            });

            table.on( 'order.dt search.dt', function () {
                table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                });
        }).draw();
    });
</script>


