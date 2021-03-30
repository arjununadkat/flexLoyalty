<x-main-master>
    @section('page_title')
        Transactions
    @endsection

    @section('content-heading')
        Transactions
    @endsection

    @section('content')
        <div class="card border-light shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="transactionsTable" style="width: 100%" class="table table-centered table-hover table-nowrap mb-0 rounded">
                        <thead class="thead-light">
                        <tr>
                            <th class="border-0">ID</th>
                            <th class="border-0">Costumer</th>
                            <th class="border-0">First Name</th>
                            <th class="border-0">Mode Of Payment</th>
                            <th class="border-0">Spending Amount</th>
                            <th class="border-0">Points</th>
                            <th class="border-0">Points Redeemed</th>
                            <th class="border-0">Teller ID</th>
                            <th class="border-0">Transaction Time</th>
                            @if(\Illuminate\Support\Facades\Gate::allows('isAdmin'))
                            <th class="border-0">Delete</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        <!-- Item -->
                        @foreach($transactions as $transaction)
                            <tr>
                                <td class="border-0">
                                    <a href="{{route('transaction.show', base64_encode($transaction->id))}}" class="d-flex align-items-center">
                                        <div><span class="h6">{{$transaction->id}}</span></div>
                                    </a>
                                </td>
                                <td class="border-0 fw-bold">{{$transaction->user_id}}</td>
                                <td class="border-0 fw-bold">{{$transaction->firstname}}</td>
{{--                                onclick="window.location='{{route('user.profile.show', $user->id)}}';"--}}
                                <td class="border-0">
                                    <a href="{{route('transaction.show', $transaction->id)}}" class="d-flex align-items-center">
                                        <div><span class="h6">{{$transaction->mode_of_payment}}</span></div>
                                    </a>
                                </td>
                                <td class="border-0">
                                    <a href="{{route('transaction.show', $transaction->id)}}" class="d-flex align-items-center">
                                        <div><span class="h6">{{$transaction->spending_amount}}</span></div>
                                    </a>
                                </td>
                                <td class="border-0">
                                    <a href="{{route('transaction.show', $transaction->id)}}" class="d-flex align-items-center">
                                        <div><span class="h6">{{$transaction->points}}</span></div>
                                    </a>
                                </td>
                                <td class="border-0">
                                    <a href="{{route('transaction.show', $transaction->id)}}" class="d-flex align-items-center">
                                        <div><span class="h6">{{$transaction->redeemable_points}}</span></div>
                                    </a>
                                </td>
                                <td class="border-0">
                                    <a href="{{route('transaction.show', $transaction->id)}}" class="d-flex align-items-center">
                                        <div><span class="h6">{{$transaction->teller_id}}</span></div>
                                    </a>
                                </td>
                                <td class="border-0">
                                    <a href="{{route('transaction.show', $transaction->id)}}" class="d-flex align-items-center">
                                        <div><span class="h6">{{$transaction->updated_at}}</span></div>
                                    </a>
                                </td>
                                @if(\Illuminate\Support\Facades\Gate::allows('isAdmin'))
                                <td>
                                    <button type="button" id="deletebutton" class="btn btn-danger delete"
                                            data-toggle="modal"
                                            data-transaction_id='{{$transaction->id}}'
                                            data-target="#deletemodal">Delete</button>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                        <!-- End of Item -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
            <button hidden id="showmd2" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-achievement">show</button>
            <x-modal.Dmodal-master>
                @section('Dheader')
                    You are about to delete a transaction
                @endsection
                @section('Dparagraph')
                    Are you sure you want to delete this transaction?
                @endsection
                @section('Daction')
                    action="{{route('transaction.destroy', 'transaction')}}"
                @endsection
                @section('Dinput')
                    <input type=hidden id="transaction_id" name="transaction_id">
                @endsection

            </x-modal.Dmodal-master>
            <x-modal.Amodal-master>
                @section('header')
                    Transaction has been deleted
                @endsection
                @section('paragraph')
                    Well Done! You have successfully deleted the Transaction!
                @endsection
                @section('route')
                    onclick="location.href='{{ route('dashboard.index') }}'"
                @endsection
            </x-modal.Amodal-master>
     @endsection

    @section('scripts')
        <script>
            @if(\Illuminate\Support\Facades\Session::has('transaction_deleted'))
            document.getElementById('showmd2').click();
            @endif

            $('#deletemodal').on('show.bs.modal', function (event){
                var button = $(event.relatedTarget);
                var transaction_id = button.data('transaction_id');
                var modal = $(this);
                modal.find('.modal-footer #transaction_id').val(transaction_id);
            })

            $(document).ready(function() {
                $('#transactionsTable').DataTable( {
                    responsive: true,

                } );
            } );

            // $(document).on('click','.delete',function(){
            //     let user_id = $(this).attr('data-user_id');
            //     $('#user_id').val(user_id);
            // });

            // function mydeleteFunction(){
            //     var button = document.getElementById('deletebutton')
            //     var userid = $(this).button.data('userid');
            //     // let user_id = $(this).attr('data-user_id');
            //         $('#user_id').val(userid);
            // }
        </script>
    @endsection
</x-main-master>
