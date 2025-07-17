<!doctype html>
<html lang="{{ $lang ?? 'en' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ __('Login') }} - {{ config('app.name') }}</title>

    @include('auth.includes.global-head')
</head>

<body class="auth-bg">

    <div class="container mt-5">       

        <div class="row py-5 mt-5 align-items-center">

            <div class="text-center mb-3 mt-3">
                <img src="{{ asset('assets/img/logo-auth.png') }}" class="img-fluid" alt="{{ config('app.name') }}">
            </div>

            <div class="col-md-6 offset-md-3 bg-white rounded">

                <div class='fs-5 mt-3 mb-3 fw-bold'>{{ __('Login into your account') }}</div>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="row">

                        <!-- Email Address -->
                        <div class="input-group col-12 mb-4">
                            <div class="input-group mb-1">
                                <span class="input-group-text" id="addonEmail"><i class="bi bi-envelope"></i></span>
                                <input type="email" name="email" class="form-control form-control-lg" placeholder="{{ __('Login email') }}" aria-label="{{ __('Login email') }}" aria-describedby="addonEmail"
                                    @error('email') is-invalid @enderror required autocomplete="email">
                            </div>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="input-group col-12 mb-4">
                            <div class="input-group mb-1">
                                <span class="input-group-text" id="addonPw"><i class="bi bi-lock"></i></span>
                                <input type="password" name="password" class="form-control form-control-lg" placeholder="{{ __('Password') }}" aria-label="{{ __('Password') }}" aria-describedby="addonPw"
                                    @error('password') is-invalid @enderror required>
                            </div>

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="input-group col-12 mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} checked>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group col-lg-12 mx-auto">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-auth btn-block py-2">
                                    <span class="font-weight-bold">{{ __('Login') }}</span>
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
                        <div class="text-center w-100 mb-3 fw-bold">
                            @if (Route::has('password.request'))
                                <span class="text-muted font-weight-bold"><a href="{{ route('password.request') }}" class="text-secondary">{{ __('Forgot password') }}</a></span>
                            @endif                           
                        </div>

                    </div>

                </form>
            </div>

            @include('auth.includes.footer-text')

        </div>
    </div>

</body>

</html>
