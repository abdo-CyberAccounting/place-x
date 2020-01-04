@extends('layouts.app')

@section('login-signup-content')
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper" class="login-register login-sidebar" style="background-image:url({{asset('assets/images/background/login-register.jpg')}});">
        <div class="login-box card">
            <div class="card-body">
                <form class="form-horizontal form-material" method="POST" action="{{url('/login') }}" id="loginform" novalidate>
                    {{csrf_field()}}
                    <a href="javascript:void(0)" class="text-center db"><img src="{{asset('assets/images/logo-icon.png')}}" alt="Home" /><br/><img src="{{asset('assets/images/logo-text.png')}}" alt="Home" /></a>
                    <div class="form-group m-t-40">
                        <div class="col-xs-12">
                            <div class="controls">
                                <input class="form-control" required name="email" value="{{ old('email') }}" type="text" placeholder="Email">
                                @if ($errors->has('email'))
                                    <code class="text-danger">
                                        {{ $errors->first('email') }}
                                    </code>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="controls">
                                <input class="form-control" required name="password" type="password" placeholder="Password">
                                @if ($errors->has('password'))
                                    <code class="text-danger">
                                        {{ $errors->first('password') }}
                                    </code>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <a href="{{url('password/reset')}}" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Forgot password?</a>
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
@endsection

@section('login-signup-script')

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('assets/plugins/popper/popper.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{asset('js/jquery.slimscroll.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{asset('js/waves.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{asset('js/sidebarmenu.js')}}"></script>
    <!--stickey kit -->
    <script src="{{asset('assets/plugins/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>
    <script src="{{asset('assets/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{asset('js/custom.min.js')}}"></script>
    <script src="{{asset('js/validation.js')}}"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="{{asset('assets/plugins/styleswitcher/jQuery.style.switcher.js')}}"></script>
    <script src="{{asset('assets/plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('assets/plugins/sweetalert/jquery.sweet-alert.custom.js')}}"></script>
    @if(session()->has('success'))
        <script>
            swal("Good job!", "{{session()->get('success')}}", "success");
        </script>
    @endif
    @if(session()->has('error'))
        <script>
            swal("Sorry!", "{{session()->get('error')}}", "warning");
        </script>

    @elseif(session()->has('activation'))
        <script>
            swal("Activation!", "{{session()->get('activation')}}", "warning");
        </script>
    @endif
@endsection
