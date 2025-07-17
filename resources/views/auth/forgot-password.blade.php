<!doctype html>
<html lang="{{ $lang ?? 'en' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('Reset password') }}</title>

    @include('auth.includes.global-head')
</head>


<body class="auth-bg">

    <div class="container mt-5">

        <div class="row py-5 mt-5 align-items-center">

            <div class="text-center mb-3 mt-3">
                <img src="{{ asset('assets/img/logo-auth.png') }}" class="img-fluid" alt="{{ config('app.name') }}">
            </div>

            <div class="col-md-6 offset-md-3 bg-white rounded">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class='fs-5 mt-3 mb-3 fw-bold'>{{ __('Reset password') }}</div>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST">
                    @csrf

                    <div class="input-group mb-3">
                        <span class="input-group-text login-field" id="addonEmail"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" class="form-control form-control-lg login-field" placeholder="{{ __('Email') }}" aria-label="{{ __('Email') }}" aria-describedby="addonEmail"
                            @error('email') is-invalid @enderror required autocomplete="email">
                    </div>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <!-- Submit Button -->
                    <div class="form-group col-lg-12 mx-auto">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-auth btn-block py-2">
                                <span class="font-weight-bold">{{ __('Reset password') }}</span>
                            </button>
                        </div>
                    </div>

                    <!-- Divider Text -->
                    <div class="form-group col-lg-12 mx-auto d-flex align-items-center my-3">
                        <div class="border-bottom w-100 ml-5"></div>
                        <span class="px-2 small text-muted font-weight-bold text-muted">{{ __('OR') }}</span>
                        <div class="border-bottom w-100 mr-5"></div>
                    </div>

                    <!-- Already Registered -->
                    <div class="text-center w-100">
                        <p class="text-muted fw-bold">{{ __('Already registered?') }} <a href="{{ route('login') }}" class="text-primary ml-2">{{ __('Login') }}</a></p>
                    </div>
                </form>

            </div>

            @include('auth.includes.footer-text')

        </div>

    </div>
</body>

</html>
