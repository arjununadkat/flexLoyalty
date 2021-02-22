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
                    <table class="table table-centered table-hover table-nowrap mb-0 rounded">
                        <thead class="thead-light">
                        <tr>
                            <th class="border-0">ID</th>
                            <th class="border-0">First Name</th>
                            <th class="border-0">Last Name</th>
                            <th class="border-0">Number Of Transactions</th>
                            <th class="border-0">Spending Amount</th>
                            <th class="border-0">Points</th>
                            <th class="border-0">Gift Value</th>
                            <th class="border-0">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- Item -->
                        @foreach($users as $user)
                            <tr>
{{--                                onclick="window.location='{{route('user.profile.show', $user->id)}}';"--}}
                                <td class="border-0 fw-bold">{{$user->id}}</td>
                                <td class="border-0">
                                    <a href="{{route('user.profile.show', $user->id)}}" class="d-flex align-items-center">
                                        <div><span class="h6">{{$user->firstname}}</span></div>
                                    </a>
                                </td>
                                <td class="border-0">
                                    <a href="{{route('user.profile.show', $user->id)}}" class="d-flex align-items-center">
                                        <div><span class="h6">{{$user->lastname}}</span></div>
                                    </a>
                                </td>
                                <td class="border-0 fw-bold">{{$user->transactions_number}}</td>
                                <td class="border-0 fw-bold">{{$user->spending_amount}}</td>
                                <td class="border-0 fw-bold">{{$user->points}}</td>
                                <td class="border-0 fw-bold">{{$user->gift_value}}</td>
                                <td>
                                    <form method="post" action="{{route('user.destroy', $user->id)}}" enctype="multipart/form-data">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-secondary">Delete</button>
                                        <button type="button" id="deletebutton" class="btn btn-danger delete"
                                                data-toggle="modal"
                                                data-user_id='{{$user->id}}'
                                                data-target="#deletemodal">Delete</button>
                                    </form>
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
                    You are about to delete a user
                @endsection
                @section('paragraph')
                    Are you sure you want to delete this user?
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
                    console.log(user_id)

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
