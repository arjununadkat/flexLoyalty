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
@endsection



</x-main-master>
