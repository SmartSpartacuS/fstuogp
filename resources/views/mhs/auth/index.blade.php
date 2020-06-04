<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>FST UOGP</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="ThemeDesign" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="{{ asset('toolsMhs/images/favicon.ico') }}">

        <link href="{{ asset('toolsMhs/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('toolsMhs/css/icons.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('toolsMhs/css/style.css') }}" rel="stylesheet" type="text/css">

    </head>


    <body class="pb-0">

        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <!-- Begin page -->
        <div class="accountbg">
            
            <div class="content-center">
                <div class="content-desc-center">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5 col-md-8">
                                <div class="card">
                                    <div class="card-body">
                
                                        <h3 class="text-center mt-0 m-b-15">
                                            {{-- <a href="index.html" class="logo logo-admin"><img src="{{ asset('toolsMhs/images/logo-dark.png') }}" height="30" alt="logo"></a> --}}
                                        </h3>
                
                                        <h4 class="text-muted text-center font-18" id="countdown"><b>Login</b></h4>
                
                                        <div class="p-2">
                                            <form class="form-horizontal m-t-20"method="POST" action="{{ route('login') }}">
                                                @csrf
                
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <input class="form-control" type="text" name="username" required placeholder="Username">
                                                        @error('username')
                                                            <span class="ml-1" style="color:red">{{ $message }}</span>
                                                        @enderror           
                                                    </div>
                                                </div>
                
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <input class="form-control" name="password" type="password" required placeholder="Password">
                                                        @error('password')
                                                            <span class="ml-1" style="color:red">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" name="remember" id="remember"">
                                                            <label class="custom-control-label" for="remember">Ingat Saya</label>
                                                        </div>
                                                    </div>
                                                </div>
                
                                                <div class="form-group text-center row m-t-20">
                                                    <div class="col-12">
                                                        <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Log In</button>
                                                    </div>
                                                </div>
                
                                                {{-- <div class="form-group m-t-10 mb-0 row">
                                                    <div class="col-sm-7 m-t-20">
                                                        <a href="pages-recoverpw.html" class="text-muted"><i class="mdi mdi-lock"></i> Forgot your password?</a>
                                                    </div>
                                                    <div class="col-sm-5 m-t-20">
                                                        <a href="pages-register.html" class="text-muted"><i class="mdi mdi-account-circle"></i> Create an account</a>
                                                    </div>
                                                </div> --}}
                                            </form>
                                        </div>
                
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery  -->
        <script src="{{ asset('toolsMhs/js/jquery.min.js') }}"></script>
        <script src="{{ asset('toolsMhs/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('toolsMhs/js/modernizr.min.js') }}"></script>
        <script src="{{ asset('toolsMhs/js/detect.js') }}"></script>
        <script src="{{ asset('toolsMhs/js/fastclick.js') }}"></script>
        <script src="{{ asset('toolsMhs/js/jquery.slimscroll.js') }}"></script>
        <script src="{{ asset('toolsMhs/js/jquery.blockUI.js') }}"></script>
        <script src="{{ asset('toolsMhs/js/waves.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('toolsMhs/js/app.js') }}"></script>
        
        <script>
            // let countDownDate = new Date(tgl + " " + seles).getTime();
            let countDownDate = new Date("2020-04-23 00:01:00").getTime();

            // Update the count down every 1 second
            let x = setInterval(function() {

                // Get today's date and time
                let now = new Date().getTime();

                // Find the distance between now and the count down date
                let distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                let days = Math.floor(distance / (1000 * 60 * 60 * 24));
                let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                let seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Output the result in an element with id="demo"
                // $("#countdown").html('Sisa Waktu : '+ days + ":" + hours + ":" + minutes + ":" + seconds + "")
                // If the count down is over, write some text 
                if (distance > 999) {
                    window.location.replace("/");
                }else {
                    clearInterval(x);
                }
            }, 1000);
        </script>

    </body>
</html>