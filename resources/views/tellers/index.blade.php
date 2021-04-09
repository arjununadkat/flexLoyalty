<x-main-master>
    @section('page_title')
        Tellers
    @endsection

    @section('content-heading')
        Tellers
    @endsection

    @section('content')
            <div class="card border-light shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tellersTable" class="table table-centered table-hover table-nowrap mb-0 rounded">
                            <thead class="thead-light">
                            <tr>
                                <th class="border-0">ID</th>
                                <th class="border-0">First Name</th>
                                <th class="border-0">Last Name</th>
                                <th class="border-0">Transactions Made</th>
                                <th class="border-0">Received Amount</th>
                                <th class="border-0">Discounted Points</th>
                                <th class="border-0">Discounted Gift Value</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- Item -->
                            @foreach($users as $user)
                            <tr>
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
                                    <a href="{{route('teller.transactions', $user->id)}}" class="d-flex align-items-center">
                                        <div><span class="h6">{{$user->transactions_made}}</span></div>
                                    </a>
                                </td>
{{--                                <td class="border-0 fw-bold">{{$user->transactions_made}}</td>--}}
                                <td class="border-0 fw-bold">{{$user->received_amount}}</td>
                                <td class="border-0 fw-bold">{{$user->discounted_points}}</td>
                                <td class="border-0 fw-bold">{{$user->discounted_gift_value}}</td>
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
            <script>
                $(document).ready(function() {
                    $('#tellersTable').DataTable( {
                        responsive: true,
                        "language": {
                            "thousands": ","
                        }
                    } );
                } );
            </script>
    @endsection
</x-main-master>
