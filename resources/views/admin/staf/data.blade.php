<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Jenkel</th>
            <th>Progdi</th>
            <th>Alamat</th>
            <th>Username</th>
            <th>Password</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($staf as $item)
        <tr class="clickable-row" data-id='{{ $item->id }}'>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->nm_staf }}</td>
            <td>{{ $item->jenkel }}</td>
            <td>{{ $item->prodi->nm_prodi }}</td>
            <td>{{ $item->alamat }}</td>
            <td>{{ $item->username }}</td>
            <td>{{ $item->password }}</td>
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
                        url: "staf/"+href+"/edit", 
                        type: 'GET',
                        dataType: 'JSON',
                        beforeSend: function() {
                            // lakukan sesuatu sebelum data dikirim
                            console.log(href); 
                            },
                        success: function(data) {
                            // lakukan sesuatu jika data sudah terkirim
                            $('#id').val(data.id);
                            $('#nm_staf').val(data.nm_staf);
                            $('#id_prodi').val(data.id_prodi).trigger('change');
                            $('#username').val(data.username);
                            $('#alamat').val(data.alamat);
                            if (data.jenkel == 'Laki-laki') {
                                $('input:radio[name=jenkel][value="Laki-laki"]').prop('checked', true)
                            } else {
                                $('input:radio[name=jenkel][value="Perempuan"]').prop('checked', true)
                            }
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
                            url: "staf/" + href,
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
            let table = $('.table').DataTable( {
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


