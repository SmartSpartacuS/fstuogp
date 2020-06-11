@extends('pekerja.kaprodi.layouts.default')

@section('judul','Profile')

@section('content')

<div class="row">
  <div class="col-12 col-lg-6">
    <div class="card">
      <div class="card-body">
        <h5 class="text-uppercase">
          <i class="fa fa-address-book-o"></i>
           Data Profil
        </h5>
        <div id="tampil"></div>
      </div>
    </div>
  </div>
  <div class="col-12 col-lg-6">
    <div class="card">
      <div class="card-body">
        @foreach ($errors->all() as $error)
          <p id="error" style="display: none">{{ $error }}</p>
        @endforeach 
       
        <form id="signupForm" action="{{ route('kaprodiProfile.store') }}" method="POST">
          @csrf
          <h4 class="form-header text-uppercase">
            <i class="fa fa-address-book-o"></i>
             Ganti Password
          </h4>
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                  <label for="password_lama">Password Lama</label>
                  <input type="password" class="form-control" id="password_lama" name="password_lama">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                  <label for="password_baru">Password Baru</label>
                  <input type="password" class="form-control" id="password_baru" name="password_baru">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                  <label for="confirm_password">Ulangi Password</label>
                  <input type="password" class="form-control" id="confirm_password" name="confirm_password">
              </div>
            </div>
          </div>

          <div class="form-footer">
              <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> Ubah Data</button>
          </div>
        </form>

      </div>
    </div>
  </div>
</div><!--End Row-->

@endsection

@section('js')

<!--Form Validatin Script-->
<script src="{{ asset('toolspekerja/plugins/jquery-validation/js/jquery.validate.min.js') }}"></script>
{{-- Notif --}}
<script src="{{ asset('toolspekerja/plugins/notifications/js/lobibox.min.js') }}"></script>
<script src="{{ asset('toolspekerja/plugins/notifications/js/notifications.min.js') }}"></script>
{{-- Costum Notification --}}
<script>
  function notifSucces(){
			Lobibox.notify('info', {
		    pauseDelayOnHover: true,
		    icon: 'fa fa-info-circle',
            continueDelayOnInactiveTab: false,
		    position: 'center top',
		    showClass: 'bounceIn',
            hideClass: 'bounceOut',
            width: 600,
		    msg: 'Berhasil Merubah Password'
		    });
      };

  function notifError(idError){
			Lobibox.notify('error', {
		    pauseDelayOnHover: true,
		    icon: 'fa fa-info-circle',
            continueDelayOnInactiveTab: false,
		    position: 'center top',
		    showClass: 'zoomIn',
            hideClass: 'zoomOut',
            width: 600,
		    msg: idError
		    });
      };

  $(document).ready(function(){
    let idError=$('#error').html()
    if (idError) {
      notifError(idError)
    }
  })  
</script>

@if (session('success'))
  <script>notifSucces()</script>
@endif


<script>
  $().ready(function() {
    $("#personal-info").validate();
    // validate signup form on keyup and submit
      $("#signupForm").validate({
          rules: {
              nm_staf: "required",
              alamat: "required",
              password_lama: "required",
              lastname: "required",
              username: {
                  required: true,
                  minlength: 2
              },
              password_baru: {
                  required: true,
                  minlength: 6
              },
              confirm_password: {
                  required: true,
                  minlength: 6,
                  equalTo: "#password_baru"
              },
              email: {
                  required: true,
                  email: true
              },
              contactnumber: {
                  required: true,
                  minlength: 10
              },
              topic: {
                  required: "#newsletter:checked",
                  minlength: 2
              },
              agree: "required"
          },
          messages: {
              nm_staf: "Nama Tidak Boleh Kosong",
              password_lama: "Passwor Lama Tidak Boleh Kosong",
              lastname: "Please enter your lastname",
              username: {
                  required: "Please enter a username",
                  minlength: "Your username must consist of at least 2 characters"
              },
              password_baru: {
                  required: "Silahkan Masukan Password Baru",
                  minlength: "Password Harus Lebih Dari 6 Karakter"
              },
              confirm_password: {
                  required: "Ulangi Password Baru",
                  minlength: "Password Harus Lebih Dari 6 Karakter",
                  equalTo: "Password Tidak Cocok"
              },
              email: "Silahkan masukan Email yang valid",
              contactnumber: "Please enter your 10 digit number",
              agree: "Please accept our policy",
              topic: "Please select at least 2 topics"
          }
      });

  });

</script>


<script>
  // Load Data
  function loadMoreData() {
        $.ajax({
            url: '',
            type: "get",
            datatype: "html",
            success:function(data){
                $('#tampil').html(data);
            }
        })
        .fail(function(jqXHR, ajaxOptions, thrownError)
        {
            alert('Server tidak merespon...');
        });
    }
    loadMoreData();
</script>
@endsection