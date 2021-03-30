<x-main-master>
    @section('page_title')
        Profile
    @endsection

    @section('content-heading')
        Profile for {{$user->firstname}}
    @endsection

    @section('content')
            @if(session('updated_not'))
                <div class="alert alert-danger">{{session('updated_not')}}</div>
            @endif
        <div class="row">
            <div class="col-sm-6">
                <form method="post" name="userForm" action="{{route('user.profile.update', $user)}}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="username">Username</label>
                        <input type="text"
                               class="form-control @error('username') is-invalid @enderror"
                               name="username"
                               id="username"
                               value="{{$user->username}}"
                               required>
                        <small id="usernameHelp" class="form-text text-muted">This is the Username</small>
                        @error('username')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="firstname">First Name</label>
                        <input type="text"
                               class="form-control @error('firstname') is-invalid @enderror"
                               name="firstname"
                               id="firstname"
                               value="{{$user->firstname}}"
                               required>
                        <small id="first_nameHelp" class="form-text text-muted">This is the First Name</small>
                        @error('firstname')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="lastname">Last Name</label>
                        <input type="text"
                               class="form-control @error('lastname') is-invalid @enderror"
                               name="lastname"
                               id="lastname"
                               value="{{$user->lastname}}"
                               required>
                        <small id="last_nameHelp" class="form-text text-muted">This is the Last Name</small>
                        @error('lastname')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email">Email Address</label>
                        <input type="text"
                               class="form-control @error('email') is-invalid @enderror"
                               name="email"
                               id="email"
                               value="{{$user->email}}"
                               required>
                        <small id="minimum_spendingHelp" class="form-text text-muted">This is the Email Address</small>
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="gender">Gender</label>
                        <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" aria-label="Default select example">
                            <option value="0"
                                    @if(is_null($user->gender))
                                    selected
                                        @endif
                            >Please select one</option>
                            <option value="Male"
                                    @if(($user->gender)=='Male')
                                    selected
                                @endif
                            >Male</option>
                            <option value="Female"
                                    @if(($user->gender)=='Female')
                                    selected
                                @endif
                            >Female</option>
                            <option value="Other"
                                    @if(($user->gender)=='Other')
                                    selected
                                @endif
                            >Other</option>
                        </select>
                        <small id="genderHelp" class="form-text text-muted">This is the Gender</small>
                        @error('gender')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="address">Address</label>
                        <input type="text"
                               class="form-control @error('address') is-invalid @enderror"
                               name="address"
                               id="address"
                               value="{{$user->address}}"
                               required>
                        <small id="addressHelp" class="form-text text-muted">This is the Address</small>
                        @error('address')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
{{--                    <div class="mb-3">--}}
{{--                        <label for="password">Password</label>--}}
{{--                        <input type="password"--}}
{{--                               class="form-control @error('password') is-invalid @enderror"--}}
{{--                               name="password"--}}
{{--                               id="password"--}}
{{--                               required>--}}
{{--                        <small id="passwordHelp" class="form-text text-muted">Please input your password</small>--}}
{{--                        @error('password')--}}
{{--                        <div class="alert alert-danger">{{ $message }}</div>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                    <div class="mb-3">--}}
{{--                        <label for="password_confirmation">Confirm Password</label>--}}
{{--                        <input type="password"--}}
{{--                               class="form-control @error('password_confirmation') is-invalid @enderror"--}}
{{--                               name="password_confirmation"--}}
{{--                               id="password_confirmation"--}}
{{--                               required>--}}
{{--                        <small id="ConfirmPasswordHelp" class="form-text text-muted">Please confirm your Password</small>--}}
{{--                        @error('password_confirmation')--}}
{{--                        <div class="alert alert-danger">{{ $message }}</div>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
                    @if(\Illuminate\Support\Facades\Gate::allows('isAdmin'))
                    <button class="btn btn-primary">Update</button>
                    @endif
                </form>
            </div>
            @if(\Illuminate\Support\Facades\Gate::allows('isAdmin'))
            <div class="col-sm-6">
                <div class="card border-light shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap mb-0 rounded">
                                <thead class="thead-light">
                                <tr>
                                    <th class="border-0">Name</th>
                                    <th class="border-0">Attach</th>
                                    <th class="border-0">Detach</th>
                                </tr>
                                </thead>
                                <tbody>
                                <!-- Item -->
                                @foreach($roles as $role)
                                <tr>
                                    <td class="border-0 fw-bold">{{$role->name}}</td>
                                    <form method="post" action="{{route('user.role.attach', $user)}}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" id="role" name="role" value="{{$role->id}}">
                                        <td><button class="btn btn-primary"
                                                    @if($user->roles->contains($role))
                                                    disabled
                                                @endif
                                            >
                                                Attach
                                            </button></td>
                                    </form>
                                    <form method="post" action="{{route('user.role.detach', $user)}}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="role" value="{{$role->id}}">
                                        <td><button class="btn btn-danger"
                                                    @if(!$user->roles->contains($role))
                                                    disabled
                                                @endif>Detach</button></td>
                                    </form>
                                @endforeach
                                <!-- End of Items -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            @endif
                <button hidden id="showmd" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-achievement">show</button>
                <x-modal.Amodal-master>
                    @section('header')
                        User Has been updated
                    @endsection
                    @section('paragraph')
                            Well Done! You have successfully updated the user!
                    @endsection
                    @section('route')
                            onclick="location.href='{{ route('dashboard.index') }}'"
                    @endsection
                </x-modal.Amodal-master>
            </div>
    @endsection

    @section('scripts')
            <script>
                @if(\Illuminate\Support\Facades\Session::has('updated_user'))
                document.getElementById('showmd').click();
                @endif
            </script>
    @endsection
</x-main-master>
