@extends('adminpanel.layout.auth.master')

@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card">
                    <div class="card-body ">

                        <h4 class="mb-2 text-center">Welcome to Admin Panel!</h4>
                        <p class="mb-4 text-center">Please sign-in to your account</p>

                        <form id="formAuthentication" class="mb-3" action="{{ route('auth.login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Enter your email" autofocus />
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Password</label>
                                    {{--  <a href="auth-forgot-password-basic.html">
                                    <small>Forgot Password?</small>
                                </a>  --}}
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember-me" name="remember_me" />
                                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                            </div>

                            @if (\Session::has('error'))
                                <div id="CredentialCheck">
                                    <div class="alert alert-warning">
                                        <span style="color:black;">
                                            {!! \Session::get('error') !!}
                                        </span>
                                    </div>
                                </div>
                            @endif

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('#CredentialCheck').delay(5000).fadeOut('slow');     
    </script>
@endsection
