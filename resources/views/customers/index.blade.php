<x-main-master>
    @section('page_title')
        Customers
    @endsection

    @section('content-heading')
        Costumers
    @endsection

    @section('content')
        <div class="card border-light shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-centered table-nowrap mb-0 rounded">
                        <thead class="thead-light">
                        <tr>
                            <th class="border-0">ID</th>
                            <th class="border-0">First Name</th>
                            <th class="border-0">Last Name</th>
                            <th class="border-0">Spending Amount</th>
                            <th class="border-0">Points</th>
                            <th class="border-0">Gift Value</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- Item -->
                        @foreach($users as $user)
                            <tr onclick="window.location='{{route('user.profile.show', $user->id)}}';">
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
                            </tr>
                        @endforeach
                        <!-- End of Item -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')

    @endsection
</x-main-master>
