<x-main-master>
    @section('page_title')
        Customers
    @endsection

    @section('content-heading')
        Create new Customer
    @endsection

    @section('content')

        <div class="col-sm-6">
            <form method="post" name="userForm" action="{{route('customers.store')}}">
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
                <div class="row">
                    <div class="col-sm-6">
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
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="birthday">Date Of Birth</label>
                            <div class="input-group">
                                <span class="input-group-text"><span class="far fa-calendar-alt"></span></span>
                                <input data-datepicker="" class="form-control" id="birthday" name="birthday" type="text" placeholder="dd/mm/yyyy" required>

                            </div>
                            <small id="birthdayHelp" class="form-text text-muted">Please enter their date of birth</small>
                        </div>
                    </div>
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
                <button class="btn btn-primary">Create</button>
            </form>
        </div>
        <button hidden id="showmd" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-achievement">show</button>
        <x-modal.Amodal-master>
            @section('header')
                Customer has been created
            @endsection
            @section('paragraph')
                Well Done! You have successfully created a Customer!
            @endsection
            @section('route')
                onclick="location.href='{{ route('customers.create') }}'"
            @endsection
        </x-modal.Amodal-master>
    @endsection

    @section('scripts')
        <script>
            @if(\Illuminate\Support\Facades\Session::has('created_customer'))
            document.getElementById('showmd').click();
            @endif
        </script>

    @endsection
</x-main-master>
