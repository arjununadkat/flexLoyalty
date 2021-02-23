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
                    <table class="table table-centered table-hover table-nowrap mb-0 rounded">
                        <thead class="thead-light">
                        <tr>
                            <th class="border-0">ID</th>
                            <th class="border-0">Costumer</th>
                            <th class="border-0">First Name</th>
                            <th class="border-0">Mode Of Payment</th>
                            <th class="border-0">Spending Amount</th>
                            <th class="border-0">Points</th>
                            <th class="border-0">Gift Value</th>
                            <th class="border-0">Teller ID</th>
                            <th class="border-0">Transaction Time</th>
                            <th class="border-0">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- Item -->
                        @foreach($transactions as $transaction)
                            <tr>
                                <td class="border-0 fw-bold">{{$transaction->id}}</td>
                                <td class="border-0 fw-bold">{{$transaction->user_id}}</td>
                                <td class="border-0 fw-bold">{{$transaction->firstname}}</td>
{{--                                onclick="window.location='{{route('user.profile.show', $user->id)}}';"--}}
                                <td class="border-0">
                                    <a href="{{route('transaction.show', $transaction->id)}}" class="d-flex align-items-center">
                                        <div><span class="h6">{{$transaction->mode_of_payment}}</span></div>
                                    </a>
                                </td>
                                <td class="border-0">
                                    <a href="#" class="d-flex align-items-center">
                                        <div><span class="h6">{{$transaction->spending_amount}}</span></div>
                                    </a>
                                </td>
                                <td class="border-0">
                                    <a href="#" class="d-flex align-items-center">
                                        <div><span class="h6">{{$transaction->points}}</span></div>
                                    </a>
                                </td>
                                <td class="border-0">
                                    <a href="#" class="d-flex align-items-center">
                                        <div><span class="h6">{{$transaction->gift_value}}</span></div>
                                    </a>
                                </td>
                                <td class="border-0">
                                    <a href="#" class="d-flex align-items-center">
                                        <div><span class="h6">{{$transaction->teller_id}}</span></div>
                                    </a>
                                </td>
                                <td class="border-0">
                                    <a href="#" class="d-flex align-items-center">
                                        <div><span class="h6">{{$transaction->created_at}}</span></div>
                                    </a>
                                </td>
                                <td>
                                    <button type="button" id="deletebutton" class="btn btn-danger delete"
                                            data-toggle="modal"
                                            data-transaction_id='{{$transaction->id}}'
                                            data-target="#deletemodal">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                        <!-- End of Item -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
            <x-modal.Dmodal-master>
                @section('header')
                    You are about to delete a transaction
                @endsection
                @section('paragraph')
                    Are you sure you want to delete this transaction?
                @endsection
                @section('action')
                    action="{{route('transaction.destroy', 'transaction')}}"
                @endsection
                @section('input')
                    <input type=hidden id="transaction_id" name="transaction_id">
                @endsection

            </x-modal.Dmodal-master>
     @endsection

    @section('scripts')
        <script>

            $('#deletemodal').on('show.bs.modal', function (event){
                var button = $(event.relatedTarget);
                var transaction_id = button.data('transaction_id');
                var modal = $(this);
                modal.find('.modal-footer #transaction_id').val(transaction_id);


            })
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
