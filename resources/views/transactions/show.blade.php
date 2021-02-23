<x-main-master>
    @section('page_title')
        Transaction
    @endsection

    @section('content-heading')
        Edit The Transaction
    @endsection

    @section('content')
            @if(session('updated_not'))
                <div class="alert alert-danger">{{session('updated_not')}}</div>
            @endif
        <div class="col-sm-12">
            <form method="post" name="transactionForm" onkeyup="calculate()" action="{{route('transaction.update', $transaction)}}">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label for="username">Customer</label>
                            <input type="number"
                                   class="form-control @error('customer') is-invalid @enderror"
                                   name="customer"
                                   id="customer"
                                   value="{{$transaction->user_id}}"
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
                                   value="{{$transaction->firstname}}"
                                   required>
                            <small id="first_nameHelp" class="form-text text-muted">Customer's First Name</small>
                            @error('firstname')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label for="mode_of_payment">Mode Of Payment</label>
                            <select class="form-select @error('mode_of_payment') is-invalid @enderror" id="mode_of_payment" name="mode_of_payment" aria-label="Default select example">
                                <option value="0"
                                        @if(is_null($transaction->mode_of_payment))
                                        selected
                                        @endif
                                >Please select one</option>
                                <option value="Cash"
                                        @if(($transaction->mode_of_payment)=='Cash')
                                        selected
                                    @endif
                                >Cash</option>
                                <option value="Mobile_Money"
                                        @if(($transaction->mode_of_payment)=='Mobile_Money')
                                        selected
                                    @endif
                                >Mobile Money</option>
                                <option value="Bank_Card"
                                        @if(($transaction->mode_of_payment)=='Bank_Card')
                                        selected
                                    @endif
                                >Bank Card</option>
                            </select>
                            <small id="mode_of_paymentHelp" class="form-text text-muted">Please select the mode of Payment</small>
                            @error('mode_of_payment')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="points">Spending Amount</label>
                    <input type="text"
                           class="form-control number-separator @error('spending_amount') is-invalid @enderror"
                           name="spending_amount"
                           id="spending_amount"
                           value="{{$transaction->spending_amount}}"
                           required>
                    <small id="spending_amountHelp" class="form-text text-muted">Please enter the Spending Amount</small>
                    @error('spending_amount')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="address">Points</label>
                    <input type="number"
                           class="form-control @error('points') is-invalid @enderror"
                           name="points"
                           id="points"
                           value="{{$transaction->points}}"
                           required>
                    <small id="pointsHelp" class="form-text text-muted">Number of Points to be added</small>
                    @error('points')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="gift_value">Gift Value</label>
                    <input type="text"
                           class="form-control number-separator @error('gift_value') is-invalid @enderror"
                           name="gift_value"
                           id="gift_value"
                           value="{{$transaction->gift_value}}"
                           required>
                    <small id="gift_valueHelp" class="form-text text-muted">Please input their password</small>
                    @error('gift_value')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button class="btn btn-primary">Update</button>
                <input hidden type="number" id="teller_id" name="teller_id" value="{{auth()->user()->id}}">
                <input hidden type="number" id="constant" name="constant" value="{{$project->constant}}">
                <input hidden type="number" id="benefit_value" name="benefit_value" value="{{$project->benefit_value}}">
                <input hidden type="text" id="gift_value_points" name="gift_value_points" value="{{$project->gift_value_points}}">
                <input type="hidden" id="project_gift_value" name="project_gift_value" value="{{$project->gift_value}}">
            </form>
        </div>
        <button hidden id="showmd" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-achievement">show</button>
        <x-modal.Amodal-master>
            @section('header')
                Transaction has been updated
            @endsection
            @section('paragraph')
                Well Done! You have successfully updated the Transaction!
            @endsection
            @section('route')
                onclick="location.href='{{ route('dashboard.index') }}'"
            @endsection
        </x-modal.Amodal-master>
    @endsection

    @section('scripts')
        <script>
            @if(\Illuminate\Support\Facades\Session::has('updated_transaction'))
            document.getElementById('showmd').click();
            @endif
        </script>
        <script>
            var form =document.forms.transactionForm,
                userid = form.customer,
                firstname = form.firstname,
                spendingAmount = form.spending_amount,
                points = form.points,
                gift_value = form.gift_value;
            constants = document.getElementById('constant').value;
            benefit_value = document.getElementById('benefit_value').value;
            project_gv = document.getElementById('project_gift_value').value;
            project_gvp = document.getElementById('gift_value_points').value;

            window.calculate = function (){
                var x = spendingAmount.value;

                points.value = Math.round(x.replace(/\,/g,'') / constants);
                gift_value.value = points.value * (project_gv/project_gvp);
            }


            function fetchCustomer(){
                $.ajax({
                    url: "{{ route('transactions.fetch') }}",
                    data:{
                        id: document.getElementById('customer').value
                    },
                    success: function(result){
                        document.getElementById('firstname').value = result.firstname
                    }});
            }



        </script>
    @endsection
</x-main-master>
