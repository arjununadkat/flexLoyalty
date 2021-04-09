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
                                    <a href="{{route('customers.index')}}"><h3 class="mb-1 text-center" id="customer_number"></h3></a>
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
                                    <a href="{{route('tellers.index')}}"><h3 class="mb-1 text-center" id="teller_number"></h3></a>
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
                                    <a href="{{route('users.index')}}"><h3 class="mb-1 text-center" id="users_number"></h3></a>
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
            <input hidden type="number" id="users_number_value" name="users_number_value" value="{{$number_of_users}}">
        </div>
    <div class="row">
        <div class="col">
        <div  id="first"></div>
        </div>
        <div class="col">
            <div id="second"></div>
        </div>
    </div>
        <div class="mt-4 row">
            <div class="col">
                <div  id="third"></div>
            </div>
            <div class="col">
                <div id="fourth"></div>
            </div>
        </div>
        <div class="mt-4 row">
            <div class="col">
                <div  id="fifth"></div>
            </div>
            <div class="col">
                <div id="sixth"></div>
            </div>
        </div>

    @endsection

@section('scripts')
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


            var items = <?php echo json_encode($users)?>;

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
                    categories: <?php echo json_encode($first_c)?>
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
                    data: <?php echo json_encode($first_v)?>
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

            var points = <?php echo json_encode($rd_values)?>;

            Highcharts.chart('second', {

                chart:{
                    height: 400,
                    width:500,
                    type: 'line'
                },
                title: {
                    text: 'Gift Value Redeemed'
                },
                subtitle: {
                    text: 'The amount of gifts redeemed by customers'
                },
                xAxis: {
                    categories: <?php echo json_encode($second_c)?>
                },
                yAxis: {
                    title: {
                        text: 'Gift Value Redeemed'
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
                    name: 'Gift Value',
                    data: <?php echo json_encode($second_v)?>
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

            var spending_amount = <?php echo json_encode($spending_amount)?>;

            Highcharts.chart('third', {

                chart:{
                    height: 400,
                    width:500,
                    type: 'line'
                },
                title: {
                    text: 'Spending Amount'
                },
                subtitle: {
                    text: 'The amount of Spending done by customers'
                },
                xAxis: {
                    categories: <?php echo json_encode($third_c)?>
                },
                yAxis: {
                    title: {
                        text: 'Spending Amount'
                    },
                    labels: {
                        formatter: function(){
                            return this.value/1000000 + "M";
                        },
                        style: {
                            color: Highcharts.getOptions().colors[1]
                        }
                    },
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
                    name: 'Spending Amount',
                    data: <?php echo json_encode($third_v)?>
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

            var transactions_made = <?php echo json_encode($transactions_made)?>;

            Highcharts.chart('fourth', {

                chart:{
                    height: 400,
                    width:500,
                    type: 'column'
                },
                title: {
                    text: 'Transactions Made'
                },
                subtitle: {
                    text: 'The number of transactions made'
                },
                xAxis: {
                    categories: <?php echo json_encode($fourth_c)?>
                },
                yAxis: {
                    title: {
                        text: 'Transactions made'
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
                    name: 'Transactions made',
                    data: <?php echo json_encode($fourth_v)?>
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

            var teller_transactions_made = <?php echo json_encode($teller_transactions_made)?>;

            Highcharts.chart('fifth', {

                chart:{
                    height: 400,
                    width:500,
                    type: 'column'
                },
                title: {
                    text: 'Tellers Transactions'
                },
                subtitle: {
                    text: 'The number of transactions made by each teller'
                },
                xAxis: {
                    categories: <?php echo json_encode($fifth_c)?>
                },
                yAxis: {
                    title: {
                        text: 'Transactions made'
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
                    name: 'Transactions made',
                    data: <?php echo json_encode($fifth_v)?>
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

            var teller_amount_received = <?php echo json_encode($teller_amount_received)?>;

            Highcharts.chart('sixth', {

                chart:{
                    height: 400,
                    width:500,
                    type: 'line'
                },
                title: {
                    text: 'Tellers Amount Received'
                },
                subtitle: {
                    text: 'The amount of money received by each teller'
                },
                xAxis: {
                    categories: <?php echo json_encode($sixth_c)?>
                },
                yAxis: {
                    title: {
                        text: 'Amount Received'
                    },
                    labels: {
                        formatter: function(){
                            return this.value/1000000 + "M";
                        },
                        style: {
                            color: Highcharts.getOptions().colors[1]
                        }
                    },
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
                    name: 'Amount Received',
                    data: <?php echo json_encode($sixth_v)?>
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
