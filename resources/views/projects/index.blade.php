<x-main-master>

    @section('page_title')
        Project
    @endsection
    @section('content-heading')
        Project
    @endsection
    @section('content')
        <div class="col-sm-6">
            <form method="post" name="projectForm" onkeyup="calculate()" action="{{route('project.store')}}">
                @csrf
                <div class="mb-4">
                    <label class="my-1 me-2" for="currency">Currency</label>
                    <select class="form-select @error('currency') is-invalid @enderror" id="currency" name="currency" aria-label="Default select example">
                        <option value="0" selected>Please select one</option>
                        <option value="1">Tanzanian Shillings</option>
                        <option value="2">US Dollars</option>
                        <option value="3">Great British Pounds</option>
                    </select>
                    <small id="currencyHelp" class="form-text text-muted">Please select the preferred currency of the project</small>
                    @error('currency')
                    <div class="alert alert-danger">{{ 'Please make sure to select one' }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="minimum_spending">Minimum Spending</label>
                    <input type="text" class="form-control number-separator @error('minimum_spending') is-invalid @enderror" name="minimum_spending" id="minimum_spending" placeholder="e.g. 1,000,000/=" required>
                    <small id="minimum_spendingHelp" class="form-text text-muted">This is the minimum amount that a customer needs to spend before they are eligible for gifts and discounts</small>
                    @error('minimum_spending')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="gift_value">Gift Value</label>
                    <input type="text" class="form-control number-separator  @error('gift_value') is-invalid @enderror" name="gift_value" id="gift_value" placeholder="e.g. 100,000/=" required>
                    <small id="gift_valueHelp" class="form-text text-muted">This is the value of the gift when the customer reaches the minimum spending amount.</small>
                    @error('gift_value')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="gvp">Gift Value Points</label>
                    <input type="number" class="form-control @error('gvp') is-invalid @enderror" name="gvp" id="gvp" placeholder="e.g. 100" required>
                    <small id="gvpHelp" class="form-text text-muted">This is the number of points equivalent to the gift value</small>
                    @error('gvp')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="constants">Constant</label>
                    <input type="number" class="form-control @error('constants') is-invalid @enderror" id="constants" name="constants" required>
                    <small id="currencyHelp" class="form-text text-muted">This is the constant used in calculations to obtain points</small>
                    @error('constants')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="benefit_value">Benefit Value</label>
                    <input type="text" class="form-control @error('benefit_value') is-invalid @enderror" id="benefit_value" name="benefit_value" required>
                    <small id="currencyHelp" class="form-text text-muted">This value is the percentage value of customer benefit</small>
                    @error('benefit_value')
                    <div class="alert alert-danger" >{{ $message }}</div>
                    @enderror
                </div>
                <button class="btn btn-primary">Create</button>

            </form>
            <div class="mt-4">
                <a href={{route('projects.show')}}><button id="redeem" class="btn btn-tertiary btn-lg">View previous projects</button></a>
            </div>

            <button hidden id="showmd" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-achievement">show</button>
            <x-modal.Amodal-master>
                @section('header')
                    Project has been initialised
                @endsection
                @section('paragraph')
                        You have successfully completed the setup, you can now continue with the application.
                @endsection
                @section('route')
                        onclick="location.href='{{ route('dashboard.index') }}'"
                @endsection
            </x-modal.Amodal-master>
        </div>
    @endsection

    @section('scripts')

            <script>

                @if(\Illuminate\Support\Facades\Session::has('projectCreated'))

                    document.getElementById('showmd').click();
                @endif
            </script>

            <script>
                var form =document.forms.projectForm,
                    minimumSpending = form.minimum_spending,
                    gvp = form.gvp,
                    gift_value = form.gift_value;
                    constants = form.constants;
                    benefit_value = form.benefit_value;
                window.calculate = function (){
                    var x = minimumSpending.value;
                    var c = parseFloat(gvp.value);
                    var y = gift_value.value;
                    constants.value = (x.replace(/\,/g,'') / c);
                    benefit_value.value = (  y.replace(/\,/g,'')/ x.replace(/\,/g,'') ) ;
                }
            </script>
{{--minimum spending divided by gift value divided by 100--}}

    @endsection

</x-main-master>
