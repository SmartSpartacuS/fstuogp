
<table class="table">
    <tbody>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>{{ $staf->nm_staf }}</td>
        </tr>
        <tr>
            <td>Jenkel</td>
            <td>:</td>
            <td>{{ $staf->jenkel }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $staf->alamat }}</td>
        </tr>
        <tr>
            <td>Username</td>
            <td>:</td>
            <td>{{ $staf->username }}</td>
        </tr>
        <tr>
            <td>Foto</td>
            <td>:</td>
            <td>
                <div class="row">
                    <div class="col-4">
                        <a href="{{ asset($staf->foto_staf) }}" data-fancybox="group2">
                            <img src="{{ asset($staf->foto_staf) }}" alt="lightbox" class="lightbox-thumb img-thumbnail">
                        </a>
                    </div>
                </div>
            </td>
        </tr>
    </tbody>
</table>

