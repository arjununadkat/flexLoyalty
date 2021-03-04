<x-main-master>
    @section('page_title')
        New Transactions
    @endsection

    @section('content-heading')
        Make new Transaction
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
                            <label for="mode_of_payment">Mode Of Payment</label>
                            <select class="form-select @error('mode_of_payment') is-invalid @enderror" id="mode_of_payment" name="mode_of_payment" aria-label="Default select example">
                                <option value="0" selected>Please select one</option>
                                <option value="Cash">Cash</option>
                                <option value="Mobile_Money">Mobile Money</option>
                                <option value="Bank_Card">Bank Card</option>
                            </select>
                            <small id="mode_of_paymentHelp" class="form-text text-muted">Please select the mode of Payment</small>
                            @error('mode_of_payment')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label for="points">Spending Amount</label>
                            <input type="text"
                                   class="form-control number-separator @error('spending_amount') is-invalid @enderror"
                                   name="spending_amount"
                                   id="spending_amount"
                                   required>
                            <small id="spending_amountHelp" class="form-text text-muted">Please enter the Spending Amount</small>
                            @error('spending_amount')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label for="address">Points</label>
                            <input type="number"
                                   class="form-control @error('points') is-invalid @enderror"
                                   name="points"
                                   id="points"
                                   required>
                            <small id="pointsHelp" class="form-text text-muted">Number of Points to be added</small>
                            @error('points')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label for="gift_value">Gift Value</label>
                            <input type="text"
                                   class="form-control number-separator @error('gift_value') is-invalid @enderror"
                                   name="gift_value"
                                   id="gift_value"
                                   required>
                            <small id="gift_valueHelp" class="form-text text-muted">Please input their password</small>
                            @error('gift_value')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label for="amount_payable">Amount Payable</label>
                            <input type="text"
                                   class="form-control number-separator @error('discount') is-invalid @enderror"
                                   name="amount_payable"
                                   id="amount_payable"
                                   required>
                            <small id="amount_payableHelp" class="form-text text-muted">Please ask the customer to pay this amount</small>
                            @error('amount_payable')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div id="divredeemgiftvalue" style="display: none" class="col-sm-4">
                        <div class="mb-3">
                            <label for="redeemable_gift_value">Redeemable Gift Value</label>
                            <input type="text"
                                   class="form-control number-separator @error('redeemable_gift_value') is-invalid @enderror"
                                   name="redeemable_gift_value"
                                   id="redeemable_gift_value"
                                   >
                            <small id="redeemable_gift_valueHelp" class="form-text text-muted">Please input the gift value</small>
                            @error('redeemable_gift_value')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div id="divredeempoints" style="display: none" class="col-sm-4">
                    <div class="mb-3">
                        <label for="redeemable_points">Redeemable Points</label>
                        <input type="number"
                               class="form-control @error('redeemable_points') is-invalid @enderror"
                               name="redeemable_points"
                               id="redeemable_points"
                               >
                        <small id="redeemable_pointsHelp" class="form-text text-muted">This is the points redeemable</small>
                        @error('redeemable_points')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                </div>
{{--                <input hidden type="text" id="redeem_gift_valueval">--}}
{{--                <input hidden type="number" id="redeem_pointsval">--}}
                <button type="submit" class="submit btn btn-primary">Confirm</button>
                <input hidden type="number" id="teller_id" name="teller_id" value="{{auth()->user()->id}}">
                <input hidden type="number" id="constant" name="constant" value="{{$project->constant}}">
                <input hidden type="number" id="benefit_value" name="benefit_value" value="{{$project->benefit_value}}">
                <input hidden type="text" id="gift_value_points" name="gift_value_points" value="{{$project->gift_value_points}}">
                <input type="hidden" id="project_gift_value" name="project_gift_value" value="{{$project->gift_value}}">
            </form>
            <div class="mt-4 mb-4">
{{--                <button id="redeem" data-bs-toggle="modal" data-bs-target="#modalredeem" class="btn btn-tertiary btn-lg">Redeem</button>--}}
                <button id="redeem" class="btn btn-tertiary btn-lg">Redeem</button>
            </div>
        </div>
        <button hidden id="showmd" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-achievement">show</button>
            <div class="card border-light shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-centered table-hover table-nowrap mb-0 rounded">
                            <thead class="thead-light">
                            <tr>
                                <th class="border-0">Number Of Transactions</th>
                                <th class="border-0">Spending Amount</th>
                                <th class="border-0">Points</th>
                                <th class="border-0">Gift Value</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- Item -->
                                <tr id="tr">
                                    <td id="n_o_t" class="border-0 fw-bold"></td>
                                    <td id="s_a" class="border-0 fw-bold"></td>
                                    <td id="points_td" class="border-0 fw-bold"></td>
                                    <td id="gift_value_td" class="border-0 fw-bold"></td>
                                </tr>
                            <!-- End of Item -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <x-modal.Amodal-master>
            @section('header')
                Transaction has been created
            @endsection
            @section('paragraph')
                Well Done! You have successfully created a Transaction!
            @endsection
            @section('route')
                onclick="location.href='{{ route('dashboard.index') }}'"
            @endsection
        </x-modal.Amodal-master>
    @endsection

    @section('scripts')
        <script>
            @if(\Illuminate\Support\Facades\Session::has('created_transaction'))
            document.getElementById('showmd').click();
            @endif
        </script>
        <script>
            $(function () {
                $("#redeem").click(function () {
                    if ($(this).val() == "Yes") {
                        $("#divredeemgiftvalue").show();
                        $("#divredeempoints").show();
                        $(this).val("No");
                    } else {
                        $("#divredeemgiftvalue").hide();
                        $("#divredeempoints").hide();
                        $(this).val("Yes");
                    }
                });
            });

            var form =document.forms.transactionForm,
                userid = form.customer,
                firstname = form.firstname,
                spendingAmount = form.spending_amount,
                points = form.points,
                gift_value = form.gift_value;
                redeemable_gift_value = form.redeemable_gift_value;
                redeemable_points = form.redeemable_points;
                amount_payable = form.amount_payable;

                constants = document.getElementById('constant').value;
                benefit_value = document.getElementById('benefit_value').value;
                project_gv = document.getElementById('project_gift_value').value;
                project_gvp = document.getElementById('gift_value_points').value;

            window.calculate = function (){
                var x = spendingAmount.value;
                var y = redeemable_gift_value.value;
                points.value = Math.round(x.replace(/\,/g,'') / constants);
                gift_value.value = points.value * (project_gv/project_gvp);
                amount_payable.value = (x.replace(/\,/g,'') - y.replace(/\,/g,'')).toLocaleString();
                redeemable_points.value = y.replace(/\,/g,'') / (project_gv/project_gvp);
            }

            // $(document).ready(function (){
            //     $("#modalConfirmbtn").click(function (){
            //         var gift_value = $("#modalredeem #redeem_gift_value").val();
            //         $("#redeem_gift_valueval").val(gift_value);
            //
            //         var points = $("#modalredeem #redeem_points").val();
            //         $("#redeem_pointsval").val(points);
            //
            //         var x = document.getElementById('redeem_gift_valueval').value;
            //         var form =document.forms.transactionForm,
            //             discount = form.discount;
            //         discount.value = x.replace(/\,/g,'');
            //     });
            // });


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
                            document.getElementById('n_o_t').innerHTML = result.transactions_number
                            document.getElementById('s_a').innerHTML = result.spending_amount
                            document.getElementById('points_td').innerHTML = result.points
                            document.getElementById('gift_value_td').innerHTML = result.gift_value
                        }
                }});
            }





        </script>
    @endsection
</x-main-master>
