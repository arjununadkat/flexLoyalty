<x-main-master>
    @section('page_title')
        Users
    @endsection

    @section('content-heading')
        Users
    @endsection

    @section('content')
            <div class="card border-light shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="usersTable" class="table table-centered table-hover table-nowrap mb-0 rounded">
                        <thead class="thead-light">
                        <tr>
                            <th class="border-0">ID</th>
                            <th class="border-0">First Name</th>
                            <th class="border-0">Last Name</th>
                            <th class="border-0">Number Of Transactions</th>
                            <th class="border-0">Spending Amount</th>
                            <th class="border-0">Points</th>
                            <th class="border-0">Gift Value</th>
                            @if(\Illuminate\Support\Facades\Gate::allows('isAdmin'))
                            <th class="border-0">Delete</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        <!-- Item -->
                        @foreach($users as $user)
                            <tr>
{{--                                onclick="window.location='{{route('user.profile.show', $user->id)}}';"--}}
                                <td class="border-0 fw-bold">{{$user->id}}</td>
                                <td class="border-0">
                                    <a href="{{route('user.profile.show', base64_encode($user->id))}}" class="d-flex align-items-center">
                                        <div><span class="h6">{{$user->firstname}}</span></div>
                                    </a>
                                </td>
                                <td class="border-0">
                                    <a href="{{route('user.profile.show', base64_encode($user->id))}}" class="d-flex align-items-center">
                                        <div><span class="h6">{{$user->lastname}}</span></div>
                                    </a>
                                </td>
                                <td class="border-0">
                                    <a href="{{route('user.transactions', $user->id)}}" class="d-flex align-items-center">
                                        <div><span class="h6">{{$user->transactions_number}}</span></div>
                                    </a>
                                </td>
                                <td class="border-0 fw-bold">{{$user->spending_amount}}</td>
                                <td class="border-0 fw-bold">{{$user->points}}</td>
                                <td class="border-0 fw-bold">{{$user->gift_value}}</td>
                                @if(\Illuminate\Support\Facades\Gate::allows('isAdmin'))
                                <td>
                                        <button type="button" id="deletebutton" class="btn btn-danger delete"
                                                data-toggle="modal"
                                                data-user_id='{{$user->id}}'
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
            <x-modal.Dmodal-master>
                @section('Dheader')
                    You are about to delete a user
                @endsection
                @section('Dparagraph')
                    Are you sure you want to delete this user?
                @endsection
                @section('Daction')
                        action="{{route('user.destroy', 'user')}}"
                @endsection
                @section('Dinput')
                        <input type=hidden id="user_id" name="user_id">
                @endsection

            </x-modal.Dmodal-master>
    @endsection

        @section('scripts')
            <script>

                $('#deletemodal').on('show.bs.modal', function (event){
                    var button = $(event.relatedTarget);
                    var user_id = button.data('user_id');
                    var modal = $(this);
                    modal.find('.modal-footer #user_id').val(user_id);
                })

                $(document).ready(function() {
                    $('#usersTable').DataTable( {
                        responsive: true,
                        "language": {
                            "thousands": ","
                        }
                    } );
                } );

            </script>
        @endsection
</x-main-master>
