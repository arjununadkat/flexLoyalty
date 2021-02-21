<x-main-master>
    @section('page_title')
        Users
    @endsection

    @section('content-heading')
        Users
    @endsection

    @section('content')
            <button id="delete" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-achievement">delete</button>
            <div class="card border-light shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-centered table-hover table-nowrap mb-0 rounded">
                        <thead class="thead-light">
                        <tr>
                            <th class="border-0">ID</th>
                            <th class="border-0">First Name</th>
                            <th class="border-0">Last Name</th>
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
                                <td class="border-0 fw-bold">{{$user->spending_amount}}</td>
                                <td class="border-0 fw-bold">{{$user->points}}</td>
                                <td class="border-0 fw-bold">{{$user->gift_value}}</td>
                                <td>
                                    <button type="button" class="btn btn-danger delete" data-bs-toggle="modal" data-user_id='{{$user->id}}'data-bs-target="#deletemodal">Delete</button>
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

                $('#deletemodal').on('show-bs-modal', function (event){
                    var button = $(event.relatedTarget);
                    var user_id = button.data('user_id');
                    var modal = $(this);
                    modal.find('.modal #user_id').value(user_id);

                })
            </script>
    @endsection
</x-main-master>
