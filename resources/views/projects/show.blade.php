<x-main-master>

    @section('page_title')
        Projects
    @endsection
    @section('content-heading')
        Projects
@endsection
@section('content')

            <div class="card border-light shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="projectsTable" class="table table-centered table-hover table-nowrap mb-0 rounded">
                            <thead class="thead-light">
                            <tr>
                                <th class="border-0">ID</th>
                                <th class="border-0">Minimum Spending</th>
                                <th class="border-0">Gift Value</th>
                                <th class="border-0">Gift Value Points</th>
                                <th class="border-0">Constant</th>
                                <th class="border-0">Benefit Value</th>
                                <th class="border-0">Created At</th>

                            </tr>
                            </thead>
                            <tbody>
                            <!-- Item -->
                            @foreach($projects as $project)
                                <tr>
                                    {{--                                onclick="window.location='{{route('user.profile.show', $user->id)}}';"--}}
                                    <td class="border-0 fw-bold">{{$project->id}}</td>
                                    <td class="border-0 fw-bold">{{$project->minimum_spending}}</td>
                                    <td class="border-0 fw-bold">{{$project->gift_value}}</td>
                                    <td class="border-0 fw-bold">{{$project->gift_value_points}}</td>
                                    <td class="border-0 fw-bold">{{$project->constant}}</td>
                                    <td class="border-0 fw-bold">{{$project->benefit_value}}</td>
                                    <td class="border-0 fw-bold">{{$project->created_at}}</td>

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
                    $('#projectsTable').DataTable( {
                        responsive: true,
                        "language": {
                            "thousands": ","
                        }
                    } );
                } );
            </script>
@endsection

</x-main-master>
