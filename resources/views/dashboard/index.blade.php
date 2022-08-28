@extends('layout.header');
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('/app-assets/css/plugins/charts/chart-apex.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/app-assets/css/colors.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
@endsection
@section('breadcrumb')
    <h2 class="content-header-title float-left mb-0">Dashboard</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><span class="font-weight-bolder" style="font-size: 15px;color: #7367F0" href="">Home</span>
            </li>
            {{--<li class="breadcrumb-item"><a href="#">Components</a>--}}
            {{--</li>--}}
            {{--<li class="breadcrumb-item active">Alerts--}}
            {{--</li>--}}
        </ol>
    </div>
@endsection
@section('content')
<div class="content-body">
    <section id="basic-alerts">
        <div class="row">
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header flex-column align-items-start pb-0">
                        <div class="avatar bg-light-warning p-50 m-0">
                            <div class="avatar-content">
                                <i data-feather="package" class="font-medium-5"></i>
                            </div>
                        </div>
                        <h2 class="font-weight-bolder mt-1">{{$data['results']}}</h2>
                        <p class="card-text">Total Products</p>
                    </div>
                    <div id="order-chart"></div>
                </div>
           </div>
          
          
        </div>

       
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between pb-0">
                        <h4 class="card-title">Categories Products</h4>
                    </div>
                    <div class="card-body">
                        <div id="currentMonthPostChart">
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
    </section>

</div>
@endsection
@section('js')

<script src="{{asset('/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')}}"></script>
<script src="{{asset('/app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
<script src="{{asset('/app-assets/vendors/js/extensions/moment.min.js')}}"></script>
<script src="{{asset('/app-assets/js/scripts/pages/dashboard-analytics.js')}}"></script>

<script type="text/javascript">
    $('.dashboard').addClass('active');

    let seriesData = JSON.parse('{!! json_encode($data["chart"]["series"]) !!}')
    let categories = JSON.parse('{!! json_encode($data["chart"]["categories"]) !!}')

     $(document).ready(function() {
            $('.dynamic_table').DataTable();
             $('.dynamic_table').on( 'draw.dt', function () {
                feather.replace();
            });
           
            var options = {
            series: seriesData,
            chart: {
                height: 320,
                type: 'bar'
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            xaxis: {
                categories: categories
            },
            yaxis: {
                labels: {
                    formatter: function(val) {
                        return val.toFixed(0)
                    }
                },
            },
            // tooltip: {
            //     x: {
            //         format: 'yyyy/MM/dd'
            //     },
            // },
            };

            var chart = new ApexCharts(document.querySelector("#currentMonthPostChart"), options);
            chart.render();

        });
</script>
@endsection
