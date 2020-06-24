
<table class="table">
    <tbody>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>{{ $tool->nm_tool }}</td>
        </tr>
        <tr>
            <td>Jenkel</td>
            <td>:</td>
            <td>{{ $tool->jenkel }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $tool->alamat }}</td>
        </tr>
        <tr>
            <td>Username</td>
            <td>:</td>
            <td>{{ $tool->username }}</td>
        </tr>
        <tr>
            <td>Foto</td>
            <td>:</td>
            <td>
                <div class="row">
                    <div class="col-4">
                        <a href="{{ asset($tool->foto_tool) }}" data-fancybox="group2">
                            <img src="{{ asset($tool->foto_tool) }}" alt="lightbox" class="lightbox-thumb img-thumbnail">
                        </a>
                    </div>
                </div>
            </td>
        </tr>
    </tbody>
</table>

