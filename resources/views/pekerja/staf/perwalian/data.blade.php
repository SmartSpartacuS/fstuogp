
<table id="example" class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>NPM</th>
            <th>Nama Mahasiswa</th>
            <th>NIDN</th>
            <th>Nama Dosen</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($perwalian as $item)
        <tr class="clickable-row" data-id="{{ $item->id }}">
            <td></td>
            <td>{{ $item->mhs->NPM }}</td>
            <td>{{ $item->mhs->nm_mhs }}</td>
            <td>{{ $item->dosen->NIDN }}</td>
            <td>{{ $item->dosen->nm_dosen }}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>No</th>
            <th>NIDN</th>
            <th>Nama Dosen</th>
            <th>NPM</th>
            <th>Nama Mahasiswa</th>
        </tr>
    </tfoot>
  </table>

<script>
    $(document).ready(function($) {
        $(".clickable-row").dblclick(function() {
            var href= $(this).data('id');
            // $('#alertPertanyaan').modal('show')
            //     $('#btnUbah').on('click',function(e){
            //         e.preventDefault()
            //         $('#alertPertanyaan').modal('hide')
            //         save_method="Ubah"
            //         $.ajax({
            //             url: "StafPerwalian/"+href+"/edit", 
            //             type: 'GET',
            //             dataType: 'JSON',
            //             beforeSend: function() {
            //                 // lakukan sesuatu sebelum data dikirim
            //                 console.log(href); 
            //                 },
            //             success: function(data) {
            //                 // lakukan sesuatu jika data sudah terkirim
            //                 $('#id').val(data.id);
            //                 $('#dosen_id').val(data.dosen_id).trigger('change');
            //                 $('#mhs_id').val(data.mhs_id).trigger('change');
            //                 $('.tampilModal').modal('show')
            //                 $('#judul').html('Silahkan Merubah Data')
            //                 $('#tombolForm').html('Ubah Data')
            //             }
            //         });
                    
            //     });
                // $('#btnHapus').on('click',function(){
                //     $('#alertPertanyaan').modal('hide')
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
                            url: "StafPerwalian/"+href,
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
        });
    // });
</script>

<script>
    $(document).ready(function() {
            let table = $('.table').DataTable( {
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
