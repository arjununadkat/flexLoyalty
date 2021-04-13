<x-main-master>
    @section('page_title')
        Show Customer
    @endsection

    @section('content-heading')
        Show Customer's details
    @endsection

    @section('content')

        <div class="col-sm-12">
            <form id="transactionform" method="post" name="transactionForm" onkeyup="calculate()" action="{{route('transactions.store')}}">
                @csrf
                <div class="row">
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label for="username">Customer</label>
                            <input type="number"
                                   class="form-control @error('customer') is-invalid @enderror"
                                   name="customer"
                                   id="customer"
                                   required onchange="fetchCustomer()">
                            <small id="CustomerHelp" class="form-text text-muted">Please input the Customer's ID</small>
                            @error('customer')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label for="firstname">First Name</label>
                            <input readonly
                                   type="text"
                                   class="form-control @error('firstname') is-invalid @enderror"
                                   name="firstname"
                                   id="firstname"
                                   required>
                            <small id="first_nameHelp" class="form-text text-muted">Customer's First Name</small>
                            @error('firstname')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label for="firstname">Last Name</label>
                            <input readonly
                                   type="text"
                                   class="form-control @error('lastname') is-invalid @enderror"
                                   name="lastname"
                                   id="lastname"
                                   required>
                            <small id="last_nameHelp" class="form-text text-muted">Customer's Last Name</small>
                            @error('lastname')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label for="email_address">Email Address</label>
                            <input readonly
                                   type="text"
                                   class="form-control @error('email_address') is-invalid @enderror"
                                   name="email_address"
                                   id="email_address"
                                   required>
                            <small id="email_addressHelp" class="form-text text-muted">The email address of the customer</small>
                            @error('email_address')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label for="address">Address</label>
                            <input readonly
                                   type="text"
                                   class="form-control @error('address') is-invalid @enderror"
                                   name="address"
                                   id="address"
                                   required>
                            <small id="addressHelp" class="form-text text-muted">The Customer's Address</small>
                            @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label for="gender">Gender</label>
                            <input readonly
                                   type="text"
                                   class="form-control @error('gender') is-invalid @enderror"
                                   name="gender"
                                   id="gender"
                                   required>
                            <small id="genderHelp" class="form-text text-muted">The gender of the customer</small>
                            @error('gender')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label for="firstname">Number Of Transactions</label>
                            <input readonly
                                   type="text"
                                   class="form-control @error('not') is-invalid @enderror"
                                   name="not"
                                   id="not"
                                   required>
                            <small id="notHelp" class="form-text text-muted">The Number Of transactions done by the customer</small>
                            @error('not')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label for="firstname">Number Of Points Available</label>
                            <input readonly
                                   type="text"
                                   class="form-control @error('points') is-invalid @enderror"
                                   name="points"
                                   id="points"
                                   required>
                            <small id="pointsHelp" class="form-text text-muted">The Number Of points that this customer currently has</small>
                            @error('points')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label for="firstname">Gift Value Available</label>
                            <input readonly
                                   type="text"
                                   class="form-control @error('gift_value') is-invalid @enderror"
                                   name="gift_value"
                                   id="gift_value"
                                   required>
                            <small id="gift_valueHelp" class="form-text text-muted">The amount of Gift value that this customer currently has</small>
                            @error('gift_value')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <input hidden type="number" id="teller_id" name="teller_id" value="{{auth()->user()->id}}">
            </form>
            <div class="mt-4 mb-4">
                <a href="{{route('transactions.create')}}"><button id="redeem" class="btn btn-tertiary btn-lg">Redeem Points</button></a>
                <a href="{{route('dashboard.index')}}"><button id="redeem" class="btn btn-tertiary btn-lg">Go Back</button></a>
            </div>
        </div>
        <button hidden id="showmd" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-achievement">show</button>
        <button hidden id="showmd2" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-warning">show</button>


    @endsection

    @section('scripts')
        <script>

        </script>
        <script>

            function fetchCustomer(){
                $.ajax({
                    url: "{{ route('transactions.fetch') }}",
                    data:{
                        id: document.getElementById('customer').value
                    },
                    success: function(result){

                        if (!$.trim(result)){
                            document.getElementById('firstname').value = null
                            document.getElementById('n_o_t').innerHTML = null
                            document.getElementById('s_a').innerHTML = null
                            document.getElementById('points_td').innerHTML = null
                            document.getElementById('gift_value_td').innerHTML = null
                        }else{
                            document.getElementById('firstname').value = result.firstname
                            document.getElementById('lastname').value = result.lastname
                            document.getElementById('not').value = result.transactions_number
                            document.getElementById('points').value = result.points
                            document.getElementById('gift_value').value = result.gift_value
                            document.getElementById('email_address').value = result.email
                            document.getElementById('address').value = result.address
                            document.getElementById('gender').value = result.gender

                        }
                    }});
            }





        </script>
    @endsection
</x-main-master>
