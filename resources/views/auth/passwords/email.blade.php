<x-auth.auth-master>
    @section('title')
        Password Reset
    @endsection
    @section('form')
            <div class="container">
                <div class="row justify-content-center form-bg-image">
                    <p class="text-center"><a href="{{route('login')}}" class="text-gray-700"><i class="fas fa-angle-left me-2"></i> Back to log in</a></p>
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="signin-inner my-3 my-lg-0 bg-white shadow-soft border rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                            <h1 class="h3">Forgot your password?</h1>
                            <p class="mb-4">Don't fret! Just type in your email and we will send you a code to reset your password!</p>
                            <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <!-- Form -->
                                <div class="mb-4">
                                    <label for="email">{{ __('E-Mail Address') }}</label>
                                    <div class="input-group">
                                        <input id="email" type="email" placeholder="john@company.com" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- End of Form -->
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-dark">{{ __('Send Password Reset Link') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    @endsection


</x-auth.auth-master>
