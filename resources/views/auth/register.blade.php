@extends('backend.layouts.login')

@section('content')
<script async src="https://www.google.com/recaptcha/api.js"></script>
<div class="auth-full-page-content d-flex p-sm-5 p-4">
    <div class="w-100">
        <div class="d-flex flex-column h-100">
            <div class="mb-4 mb-md-5 text-center">
                <a href="index.html" class="d-block auth-logo">
                    <img src="/assets/images/logo-sm.svg" alt="" height="28"> <span class="logo-txt">Minia</span>
                </a>
            </div>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="auth-content my-auto">
                    <div class="text-center">
                        <h5 class="mb-0">Backend Registration !</h5>
                        <p class="text-muted mt-2">Sign Up to continue to Minia.</p>
                        <x-backend.session-flash />
                    </div>                    
                    <form class="mt-4 pt-2" action="index.html">
                        <div class="mb-3">
                            <x-inputs.text-field type="text" name="name" label="Name" placeholder="Enter Name" />
                        </div>

                        <div class="mb-3">
                            <x-inputs.text-field type="email" name="email" label="Email" placeholder="Enter Email" />
                        </div>

                        <div class="mb-3">
                            <x-inputs.text-field type="password" name="password" label="Password" placeholder="Enter Password" />                            
                        </div>

                        <div class="mb-3">
                            <x-inputs.text-field type="password" name="password_confirmation" label="Confirm Password" placeholder="Enter Confirm Password" />                            
                        </div>

                        <div class="mb-3">
                            <div class="g-recaptcha mt-4" data-sitekey={{config('services.recaptcha.key')}}></div>
                        </div>

                        <div class="mb-3">
                            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Sign Up</button>
                        </div>
                    </form>
                    
                    <div class="mt-5 text-center">
                        <p class="text-muted mb-0"><a href="/login" class="text-primary fw-semibold"> Login </a> </p>
                    </div>
                </div>
            </form>
            <div class="mt-4 mt-md-5 text-center">
                <p class="mb-0">© <script>
                        document.write(new Date().getFullYear())
                    </script> Minia . Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand</p>
            </div>
        </div>
    </div>
</div>

@endsection