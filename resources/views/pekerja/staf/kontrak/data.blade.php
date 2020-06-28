
<table id="example" class="tableKu table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>NPM</th>
            <th>Nama Mahasiswa</th>
            <th>Semester</th>
            <th>Tahun</th>
            <th>Tgl. Pengisian</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($krs as $item)
        <tr class="clickable-row" data-id="{{ $item->id }}">
            <td></td>
            <td>{{ $item->perwalian->mhs->NPM }}</td>
            <td>{{ $item->perwalian->mhs->nm_mhs }}</td>
            <td>{{ $item->semester_ak }}</td>
            <td>{{ $item->tahun_ak }}</td>
            <td>{{ $item->tgl_krs }}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>No</th>
            <th>NPM</th>
            <th>Nama Mahasiswa</th>
            <th>Semester</th>
            <th>Tahun</th>
            <th>Tgl. Pengisian</th>
        </tr>
    </tfoot>
  </table>

<script>
    var href;
    $(document).ready(function() {
        $(".clickable-row").dblclick(function() {
            href= $(this).data('id');
            $('#alertPertanyaan').modal('show');
        });
    });
</script>

<script>
    $('#btnUbah').off('click').on('click',function(e){
        e.preventDefault()
        $('#alertPertanyaan').modal('hide')
        save_method="Ubah"
        $('#tbodyKontrak').children('tr').remove();
        $.ajax({
            url: "StafKontrak/"+href, 
            type: 'GET',
            dataType: 'JSON',
            beforeSend: function() {
                // lakukan sesuatu sebelum data dikirim
                },
            success: function(data) {
                // lakukan sesuatu jika data sudah terkirim
                $('#listKontrak').show();
                $('#pilihMatkul').hide();
                $('#id').val(data.id);
                $('#perwalian_id').val(data.krs.perwalian_id).trigger('change');
                $('#tgl_krs').val(data.krs.tgl_krs);
                $.each(data.kontrak, function(index, value) {
                    $('#listKontrak').find('tbody').append('<tr><td>'+value.jadwal.matkul.nm_matkul+'</td><td>'+value.jadwal.hari+'</td></tr>')
                });
                $('.tampilModal').modal('show')
                $('#judul').html('Silahkan Merubah Data KRS')
                $('#tombolForm').html('Print')
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
                url: "StafKontrak/"+href,
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
        });
    });
</script>

<script>
    $(document).ready(function() {
            let table = $('.tableKu').DataTable( {
                "columnDefs": [ {
                "searchable": false,
                "orderable": false,
                "targets": 0
                } ],
                order: [[ 1, "desc" ]],
                lengthChange: false,
                buttons: [ 'excel', 'pdf']
            });

            table.on( 'order.dt search.dt', function () {
                table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                });
        }).draw();
        table.buttons().container()
            .appendTo( '#example_wrapper .col-md-6:eq(0)' );
    });
</script>
