<x-main-master>

@section('page_title')
    Dashboard
@endsection
@section('session')

@endsection

@section('content-heading')
    Dashboard
@endsection
@section('content')
        <div class="row">

            <div class="col-12 col-sm-6 col-xl-4 mt-4 mb-4">
                <div class="card border-light shadow-sm">
                    <div class="card-body">
                        <div class="row d-block d-xl-flex align-items-center">
                            <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                <div class="icon icon-shape icon-md icon-shape-primary rounded me-4 me-sm-0"><span class="fas fa-users"></span></div>
                            </div>
                            <div class="col-12 col-xl-7 px-xl-0">
                                <div class="d-none d-sm-block">
                                    <h2 class="h5 text-center">Number of Customers</h2>
                                    <h3 class="mb-1 text-center" id="customer_number"></h3>
                                </div>
                                <div class="col text-center">
                                    <a href="{{route('customers.create')}}" class="btn btn-sm btn-secondary">Create New Customer</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-4 mt-4 mb-4">
                <div class="card border-light shadow-sm">
                    <div class="card-body">
                        <div class="row d-block d-xl-flex align-items-center">
                            <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                <div class="icon icon-shape icon-md icon-shape-primary rounded me-4 me-sm-0"><span class="fas fa-cash-register"></span></div>
                            </div>
                            <div class="col-12 col-xl-7 px-xl-0">
                                <div class="d-none d-sm-block">
                                    <h2 class="h5 text-center">Number of Tellers</h2>
                                    <h3 class="mb-1 text-center" id="teller_number"></h3>
                                </div>
                                <div class="col text-center">
                                    <a href="{{route('tellers.create')}}" class="btn btn-sm btn-secondary">Create New Teller</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-4 mt-4 mb-4">
                <div class="card border-light shadow-sm">
                    <div class="card-body">
                        <div class="row d-block d-xl-flex align-items-center">
                            <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                <div class="icon icon-shape icon-md icon-shape-primary rounded me-4 me-sm-0"><span class="fas fa-user-circle"></span></div>
                            </div>
                            <div class="col-12 col-xl-7 px-xl-0">
                                <div class="d-none d-sm-block">
                                    <h2 class="h5 text-center">Number of Users</h2>
                                    <h3 class="mb-1 text-center" id="users_number"></h3>
                                </div>
                                <div class="col text-center">
                                    <a href="{{route('users.create')}}" class="btn btn-sm btn-secondary">Create New User</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input hidden type="number" id="customer_number_value" name="customer_number_value" value="{{$customers}}">
            <input hidden type="number" id="teller_number_value" name="teller_number_value" value="{{$tellers}}">
            <input hidden type="number" id="users_number_value" name="users_number_value" value="{{$userss}}">
        </div>
    <div class="row">
        <div class="col">
        <div  id="first"></div>
        </div>
        <div class="col">
            <div id="second"></div>
        </div>
    </div>

    @endsection

@section('scripts')
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>
        <script>

            document.getElementById('customer_number').innerHTML = document.getElementById('customer_number_value').value ;
            document.getElementById('teller_number').innerHTML = document.getElementById('teller_number_value').value;
            document.getElementById('users_number').innerHTML = document.getElementById('users_number_value').value;
        </script>
        <script type="text/javascript">


            var items = <?php echo json_encode($items)?>;

            Highcharts.chart('first', {

                chart:{
                    height: 400,
                    width:500,
                    type: 'column'
                },
                title: {
                    text: 'New Users'
                },
                subtitle: {
                    text: 'Number of new registered users'
                },
                xAxis: {
                    categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                        'October', 'November', 'December'
                    ]
                },
                yAxis: {
                    title: {
                        text: 'Number of New Users'
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle'
                },
                plotOptions: {
                    series: {
                        allowPointSelect: true
                    }
                },
                series: [{
                    name: 'New Users',
                    data: items
                }],
                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                verticalAlign: 'bottom',
                                align: 'center'
                            }
                        }
                    }]
                }
            });
            Highcharts.chart('second', {

                chart:{
                    height: 400,
                    width:500,
                    type: 'line'
                },
                title: {
                    text: 'New Users'
                },
                subtitle: {
                    text: 'Number of new registered users'
                },
                xAxis: {
                    categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                        'October', 'November', 'December'
                    ]
                },
                yAxis: {
                    title: {
                        text: 'Number of New Users'
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle'
                },
                plotOptions: {
                    series: {
                        allowPointSelect: true
                    }
                },
                series: [{
                    name: 'New Users',
                    data: items
                }],
                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                verticalAlign: 'bottom',
                                align: 'center'
                            }
                        }
                    }]
                }
            });

        </script>

        <script>

        </script>
@endsection



</x-main-master>
