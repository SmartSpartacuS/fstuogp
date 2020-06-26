
<table id="example" class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>NPM</th>
            <th>Nama</th>
            <th>Jenkel</th>
            <th>Angkatan</th>
            <th>Alamat</th>
            <th>Password</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($mhs as $item)
        <tr class="clickable-row" data-id="{{ $item->id }}">
            <td></td>
            <td>{{ $item->NPM }}</td>
            <td>{{ $item->nm_mhs }}</td>
            <td>{{ $item->jenkel }}</td>
            <td>{{ $item->angkatan }}</td>
            <td>{{ $item->alamat }}</td>
            <td>
                <div class="bt-switch">
                    <input type="checkbox" checked data-on-color="success" data-off-color="warning" data-on-text="Lihat" data-off-text="{{ $item->password }}">
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>No</th>
            <th>NPM</th>
            <th>Nama</th>
            <th>Jenkel</th>
            <th>Angkatan</th>
            <th>Alamat</th>
            <th>Password</th>
        </tr>
    </tfoot>
  </table>

  <script>
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    $('.js-switch').each(function() {
          new Switchery($(this)[0], $(this).data());
    });
  </script>

  <!--Bootstrap Switch Buttons-->
  <script src="{{ asset('toolspekerja/plugins/bootstrap-switch/bootstrap-switch.min.js') }}"></script>
  <script>
    $(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();
    var radioswitch = function() {
        var bt = function() {
            $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioState")
            }), $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck")
            }), $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck", !1)
            })
        };
        return {
            init: function() {
                bt()
            }
        }
    }();
    $(document).ready(function() {
        radioswitch.init()
    }); 
  </script>

<script>
    var href;
    $(document).ready(function($) {
        $(".clickable-row").dblclick(function() {
            href= $(this).data('id');
            $('#alertPertanyaan').modal('show')
                
        });
    });

    $('#btnUbah').off('click').on('click',function(e){
        e.preventDefault()
        $('#alertPertanyaan').modal('hide')
        save_method="Ubah"
        $.ajax({
            url: "StafMhs/"+href+"/edit", 
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
                url: "StafMhs/"+href,
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
