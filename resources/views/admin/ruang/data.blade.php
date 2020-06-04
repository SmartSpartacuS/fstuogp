<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Ruang</th>
            <th>Nama Ruangan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ruang as $item)
        <tr class="clickable-row" data-id='{{ $item->id }}'>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->kd_ruang }}</td>
            <td>{{ $item->nm_ruang }}</td>
        </tr>
        @endforeach
    </tbody>
</table>


<script>
    $(document).ready(function($) {
        $(".clickable-row").dblclick(function() {
            var href= $(this).data('id');
            $('#alertPertanyaan').modal('show')
                $('#btnUbah').on('click',function(){
                    $('#alertPertanyaan').modal('hide')
                    save_method="Ubah"
                    $.ajax({
                        url: "ruang/"+href+"/edit", 
                        type: 'GET',
                        dataType: 'JSON',
                        beforeSend: function() {
                            // lakukan sesuatu sebelum data dikirim
                            console.log(href); 
                            },
                        success: function(data) {
                            // lakukan sesuatu jika data sudah terkirim
                            $('#id').val(data.id);
                            $('#kd_ruang').val(data.kd_ruang);
                            $('#nm_ruang').val(data.nm_ruang);
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
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    confirmButtonClass: 'btn btn-primary',
                    cancelButtonClass: 'btn btn-danger ml-1',
                    buttonsStyling: false,
                    }).then(function (result) {
                    if (result.value) {
                        $.ajax({
                            url: "ruang/" + href,
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
    $('.table').dataTable( {
        "ordering": false
        } );
</script>


