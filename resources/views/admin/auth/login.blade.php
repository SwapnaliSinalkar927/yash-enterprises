<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | {{ config('app.name') }}</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- CSS -->
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet" type="text/css">
    <style>
        .center {
            /* position: absolute;
            top: 50%;
            transform: translate(0, -50%); */
            padding: 10px;
            }
    </style>
</head>
<body>
    <!-- Wrapper -->
    <div class="hk-wrapper hk-pg-auth" data-footer="simple">
        <!-- Main Content -->
        <div class="hk-pg-wrapper pt-0 pb-xl-0 pb-5">
            <div class="hk-pg-body pt-0 pb-xl-0">
                <!-- Container -->
                <div class="container-xxl px-5 center">
                    <!-- Row -->
                    <div class="row" style="margin-top:105px;">
                        <div class="col-sm-10 position-relative mx-auto">
                            <div class="auth-content py-8">
                                <form class="w-100" action="{{ route('admin.auth.check',['redirect-url'=>request()->get('redirect-url')]) }}" method="POST">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-7 col-sm-10 mx-auto">
                                            {{-- <div class="text-center mb-7">
                                                <a class="navbar-brand me-0" href="index.html">
                                                    <img class="brand-img d-inline-block" src="{{ asset('images/logo/logo-light.png') }}" alt="brand">
                                                </a>
                                            </div> --}}
                                            <div class="card card-lg card-shadow">
                                                <div class="card-body">
                                                    <h4 class="mb-4 text-center">Sign in to your account</h4>
                                                    @csrf
                                                    @if (\Session::get('status')=='failed')
                                                    <div class="mb-3">
                                                        <div class="alert alert-danger">
                                                            <p style="margin-bottom: 0;">{!! \Session::get('message') !!}</p>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @error('email')
                                                    <div class="mb-3">
                                                        <div class="alert alert-danger">
                                                            <p style="margin-bottom: 0;">{{ $message }}</p>
                                                        </div>
                                                    </div>
                                                    @enderror

                                                    @error('password')
                                                    <div class="mb-3">
                                                        <div class="alert alert-danger">
                                                            <p style="margin-bottom: 0;">{{ $message }}</p>
                                                        </div>
                                                    </div>
                                                    @enderror
                                                    <div class="row gx-3">
                                                        <div class="form-group col-lg-12">
                                                            <div class="form-label-group">
                                                                <label>User Name</label>
                                                            </div>
                                                            <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Email Address" required>
                                                        </div>
                                                        <div class="form-group col-lg-12">
                                                            <div class="form-label-group">
                                                                <label>Password</label>
                                                                <a href="#" class="fs-7 fw-medium">Forgot Password ?</a>
                                                            </div>
                                                            <div class="input-group password-check">
                                                                <span class="input-affix-wrapper">
                                                                    <input type="password" class="form-control" name="password" value="{{ old('password') }}" id="password" placeholder="Enter password" required>
                                                                    <a href="#" class="input-suffix text-muted">
                                                                        <span class="feather-icon"><i class="form-icon" data-feather="eye"></i></span>
                                                                        <span class="feather-icon d-none"><i class="form-icon" data-feather="eye-off"></i></span>
                                                                    </a>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-center">
                                                        <div class="form-check form-check-sm mb-3">
                                                            <input type="checkbox" class="form-check-input" id="logged_in" name="remember" checked>
                                                            <label class="form-check-label text-muted fs-7" for="logged_in">Keep me logged in</label>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary btn-uppercase btn-block">Login</button>
                                                    {{-- <p class="p-xs mt-2 text-center">New to Appster? <a href="#"><u>Create new account</u></a></p> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /Row -->
                </div>
                <!-- /Container -->
            </div>
            <!-- /Page Body -->

            <!-- Page Footer -->
            <div class="hk-footer border-0">
                <footer class="container-xxl footer px-5">
                    <div class="row">
                        <div class="col-xl-8 text-center">
                            <p class="footer-text"><span class="copy-text">ElevateX © {{ date('Y') }} All rights reserved.</span></p>
                            {{-- <p class="footer-text pb-0"><span class="copy-text">Appster © 2022 All rights reserved.</span><a href="#" class="" >Privacy Policy</a><span class="footer-link-sep">|</span><a href="#" class="" >T&C</a><span class="footer-link-sep">|</span><a href="#" class="" >System Status</a></p> --}}
                        </div>
                    </div>
                </footer>
            </div>
            <!-- / Page Footer -->
        </div>
        <!-- /Main Content -->
    </div>
    <!-- /Wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('admin/js/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JS -->
    <script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>

    <!-- FeatherIcons JS -->
    <script src="{{ asset('admin/js/feather.min.js') }}"></script>

    <!-- Fancy Dropdown JS -->
    <script src="{{ asset('admin/js/dropdown-bootstrap-extended.js') }}"></script>

    <!-- Simplebar JS -->
    <script src="{{ asset('admin/js/simplebar.min.js') }}"></script>

    <!-- Init JS -->
    <script src="{{ asset('admin/js/init.js') }}"></script>
</body>
</html>
