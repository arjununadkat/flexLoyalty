<x-main-master>
    @section('page_title')
        User
    @endsection

    @section('content-heading')
        Create new User
    @endsection

    @section('content')

        <div class="col-sm-6">
            <form method="post" name="userForm" action="{{route('users.store')}}">
                @csrf
                <div class="row">
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label for="username">Username</label>
                            <input type="text"
                                   class="form-control @error('username') is-invalid @enderror"
                                   name="username"
                                   id="username"
                                   required>
                            <small id="usernameHelp" class="form-text text-muted">Please enter a unique username</small>
                            @error('username')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label for="firstname">First Name</label>
                            <input type="text"
                                   class="form-control @error('firstname') is-invalid @enderror"
                                   name="firstname"
                                   id="firstname"
                                   required>
                            <small id="first_nameHelp" class="form-text text-muted">Please enter their First Name</small>
                            @error('firstname')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label for="lastname">Last Name</label>
                            <input type="text"
                                   class="form-control @error('lastname') is-invalid @enderror"
                                   name="lastname"
                                   id="lastname"
                                   required>
                            <small id="last_nameHelp" class="form-text text-muted">Please enter their Last Name</small>
                            @error('lastname')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email">Email Address</label>
                    <input type="text"
                           class="form-control @error('email') is-invalid @enderror"
                           name="email"
                           id="email"
                           required>
                    <small id="minimum_spendingHelp" class="form-text text-muted">Please enter their email address</small>
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="mb-3">
                            <label for="country_code">Country Code</label>
                            <input readonly
                                   type="number"
                                   class="form-control @error('country_code') is-invalid @enderror"
                                   name="country_code"
                                   id="country_code"
                                   value="+255"
                                   placeholder="+255"
                                   required>
{{--                            <small id="minimum_spendingHelp" class="form-text text-muted">Please enter their Phone Number</small>--}}
                            @error('country_code')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <div class="mb-3">
                            <label for="phone_number">Phone Number</label>
                            <input type="number"
                                   class="form-control @error('phone_number') is-invalid @enderror"
                                   name="phone_number"
                                   id="phone_number"
                                   required>
                            <small id="phone_numberHelp" class="form-text text-muted">Please enter their Phone Number</small>
                            @error('phone_number')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="gender">Gender</label>
                    <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" aria-label="Default select example">
                        <option value="0" selected>Please select one</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                    <small id="genderHelp" class="form-text text-muted">Please select their gender</small>
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
                           required>
                    <small id="addressHelp" class="form-text text-muted">Please enter their residential address</small>
                    @error('address')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password">Password</label>
                    <input type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           name="password"
                           id="password"
                           required>
                    <small id="passwordHelp" class="form-text text-muted">Please input their password</small>
                    @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password"
                           class="form-control @error('password_confirmation') is-invalid @enderror"
                           name="password_confirmation"
                           id="password_confirmation"
                           required>
                    <small id="ConfirmPasswordHelp" class="form-text text-muted">Please confirm the Password</small>
                    @error('password_confirmation')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="role1">Role</label>
                    <select class="form-select @error('role1') is-invalid @enderror" id="role1" name="role1" aria-label="Default select example">
                        <option value="0" selected>Please select one</option>
                        <option value="1">Admin</option>
                        <option value="2">Teller</option>
                        <option value="3">Customer</option>
                    </select>
                    <small id="role1Help" class="form-text text-muted">Please select their role</small>
                    @error('role1')
                    <div class="alert alert-danger">{{ 'Please make sure to select at least one role' }}</div>
                    @enderror
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" name="role2checkbox" type="checkbox" id="role2checkbox" onclick="myFunction()">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Add a second role</label>
                </div>
                <div style="display:none" id="role2div" class="mb-3">
                    <label for="role2">Second Role</label>
                    <select class="form-select @error('role2') is-invalid @enderror" id="role2" name="role2" aria-label="Default select example">
                        <option value="0" selected>Please select one</option>
                        <option value="1">Admin</option>
                        <option value="2">Teller</option>
                        <option value="3">Customer</option>
                    </select>
                    <small id="role2Help" class="form-text text-muted">This is optional</small>
                    @error('role2')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div style="display:none" id="role3checboxdiv" class="form-check form-switch">
                    <input  class="form-check-input" name="role3checkbox" type="checkbox" id="role3checkbox" onclick="myFunction()">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Add a third role</label>
                </div>
                <div style="display:none" id="role3div" class="mb-3">
                    <label for="role3">Third Role</label>
                    <select class="form-select @error('role3') is-invalid @enderror" id="role3" name="role3" aria-label="Default select example">
                        <option value="0" selected>Please select one</option>
                        <option value="1">Admin</option>
                        <option value="2">Teller</option>
                        <option value="3">Customer</option>
                    </select>
                    <small id="role3Help" class="form-text text-muted">This is optional</small>
                    @error('role3')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-4">
                <button class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
        <button hidden id="showmd" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-achievement">show</button>
            <x-modal.Amodal-master>
            @section('header')
                User has been created
            @endsection
            @section('paragraph')
                Well Done! You have successfully created a User!
            @endsection
            @section('route')
                onclick="location.href='{{ route('users.create') }}'"
            @endsection
        </x-modal.Amodal-master>
    @endsection

    @section('scripts')
        <script>
            @if(\Illuminate\Support\Facades\Session::has('created_user'))
            document.getElementById('showmd').click();
            @endif
        </script>
            <script>
                function myFunction() {
                    var role2checkbox = document.getElementById('role2checkbox');
                    var role2div = document.getElementById('role2div');
                    var role3checkbox = document.getElementById('role3checkbox');
                    var role3div = document.getElementById('role3div');
                    var role3checboxdiv = document.getElementById('role3checboxdiv');
                    if (role2checkbox.checked == true){
                        role2div.style.display = "block"
                        role3checboxdiv.style.display = "block";
                    }
                    else{
                        role2div.style.display = "none";
                        role3checboxdiv.style.display = "none";
                    }
                    if (role3checkbox.checked == true){
                        role3div.style.display = "block";
                    }
                    else{
                        role3div.style.display = "none";
                    }
                }
            </script>
        @endsection
</x-main-master>
