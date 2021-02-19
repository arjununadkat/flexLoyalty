<x-auth.auth-master>
    @section('title')
        Login to Fléx Loyalty
    @endsection
    @section('form')
        <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="bg-white shadow-soft border rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                <div class="text-center text-md-center mb-4 mt-md-0">
                    <h1 class="mb-0 h3">Sign in to Fléx Loyalty</h1>
                </div>
                <form class="mt-4" method="POST" action="{{ route('login') }}">
                @csrf
                <!-- Form -->
                    <div class="form-group mb-4">
                        <label for="email">{{ __('E-Mail Address') }}</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><span class="fas fa-envelope"></span></span>
                            <input id="email" type="email" placeholder="example@company.com" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <!-- End of Form -->
                    <div class="form-group">
                        <!-- Form -->
                        <div class="form-group mb-4">
                            <label for="password">{{ __('Password') }}</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon2"><span class="fas fa-unlock-alt"></span></span>
                                <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- End of Form -->
                        <div class="d-flex justify-content-between align-items-top mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label mb-0" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                            @if (Route::has('password.request'))
                                <a class="small text-right" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif

                        </div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-dark">{{ __('Login') }}</button>
                    </div>
                </form>
            </div>
        </div>
    @endsection


</x-auth.auth-master>
