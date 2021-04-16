<x-main-master>
    @section('page_title')
        Change Password
    @endsection

    @section('content-heading')
        Change your Password
    @endsection

    @section('content')
        @if(session('updated_not'))
            <div class="alert alert-danger">{{session('updated_not')}}</div>
        @endif
        <div class="row">
            <div class="col-sm-6">
                <form method="post" name="userPassForm" action="{{route('user.password.update', $user)}}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="password">New Password</label>
                        <input type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               name="password"
                               id="password"
                               required>
                        <small id="passwordHelp" class="form-text text-muted">Please input a new password</small>
                        @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation">Confirm New Password</label>
                        <input type="password"
                               class="form-control @error('password_confirmation') is-invalid @enderror"
                               name="password_confirmation"
                               id="password_confirmation"
                               required>
                        <small id="ConfirmPasswordHelp" class="form-text text-muted">Please confirm the new Password</small>
                        @error('password_confirmation')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                        <button class="btn btn-primary">Update</button>
                </form>
            </div>
            <button hidden id="showmd" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-achievement">show</button>
            <x-modal.Amodal-master>
                @section('header')
                    Password Changed
                @endsection
                @section('paragraph')
                    Well Done! You have successfully changed your password!
                @endsection
                @section('route')
                    onclick="location.href='{{ route('dashboard.index') }}'"
                @endsection
            </x-modal.Amodal-master>
        </div>
    @endsection

    @section('scripts')
        <script>
            @if(\Illuminate\Support\Facades\Session::has('password_changed'))
            document.getElementById('showmd').click();
            @endif
        </script>
    @endsection
</x-main-master>
