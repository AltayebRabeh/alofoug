@extends('layouts.backend.admin')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('backend/vendors/css/charts/morris.css')}}">

@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0 cairo">الزوار</h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">لوحة التحكم</a>
                        </li>
                        <li class="breadcrumb-item active">الزوار
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3 col-lg-6 col-12">
          <div class="card pull-up">
            <div class="card-content">
              <div class="card-body">
                <div class="media d-flex">
                  <div class="media-body text-left">
                    <h3 class="info">{{ $visitorsCount }}</h3>
                    <h6>إجمالي الزوار</h6>
                  </div>
                  <div>
                    <i class="la la-eye text-info" style="font-size: 50px"></i>
                  </div>
                </div>
                <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                  <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-12">
          <div class="card pull-up">
            <div class="card-content">
              <div class="card-body">
                <div class="media d-flex">
                  <div class="media-body text-left">
                    <h3 class="warning">{{ $yearCount }}</h3>
                    <h6>زائر في السنة</h6>
                  </div>
                  <div>
                    <i class="la la-eye text-warning" style="font-size: 50px"></i>
                  </div>
                </div>
                <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                  <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-12">
          <div class="card pull-up">
            <div class="card-content">
              <div class="card-body">
                <div class="media d-flex">
                  <div class="media-body text-left">
                    <h3 class="success">{{ $monthCount }}</h3>
                    <h6>زائر في الشهر</h6>
                  </div>
                  <div>
                    <i class="la la-eye text-success" style="font-size: 50px"></i>
                  </div>
                </div>
                <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                  <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-12">
          <div class="card pull-up">
            <div class="card-content">
              <div class="card-body">
                <div class="media d-flex">
                    <div class="media-body text-left">
                        <h3 class="danger">{{ $dayCount }}</h3>
                        <h6>زائر في اليوم</h6>
                      </div>
                  <div class="fonticon-wrap">
                    <i class="la la-eye text-danger"  style="font-size: 50px"></i>
                  </div>
                </div>
                <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                  <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <form action="{{ route('visitors.index') }}" method="get">
                    @csrf
                    <div class="input-group">
                        <select name="year" class="form-control" id="year">
                            @foreach ($years as $year)
                                <option value="{{$year->year}}">{{$year->year}}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary">تم</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-content">
                  <div class="card-body sales-growth-chart">
                    <div id="pages-visits" class="height-250"></div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="chart-title mb-1 text-center">
                    <h6>عدد الزيارات للصفحات لعام {{ $year->year }}</h6>
                  </div>
                </div>
            </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
            <div class="card w-100">
                <div class="card-content">
                  <div class="earning-chart position-relative"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                    <div class="chart-title position-absolute mt-2 ml-2">
                      <h1 class="display-4"> {{ $yearCount }}</h1>
                      <span class="text-muted">كل الزيارات في العام  {{ $year->year }}</span>
                    </div>
                    <canvas id="earning-chart" class="height-450 chartjs-render-monitor" width="294" height="450"></canvas>
                    <div class="chart-stats position-absolute position-bottom-0 position-right-0 mb-2 mr-3">
                      <span class="text-muted">الزيارات الشهرية في {{ $year->year }}</span>
                    </div>
                  </div>
                </div>
            </div>
        </div>
      </div>

    <div class="row">
        <div class="col-md-4">
                <div class="card">
                <p class="pb-1">الزيارات حسب المتصفح {{ $year->year }}</p>
                <div id="sessions-browser-donut-chart" class="height-200">
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <p class="pb-1">الزيارات حسب الجهاز {{ $year->year }}</p>
                <div id="sessions-device-donut-chart" class="height-200">
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <p class="pb-1">الزيارات حسب المنصة {{ $year->year }}</p>
                <div id="sessions-platform-donut-chart" class="height-200">
                </div>
            </div>
        </div>
    </div>

</div>
    @include('layouts.backend.modal.delete')

@endsection

@section('js')

<script src="{{asset('backend/vendors/js/charts/raphael-min.js')}}" type="text/javascript"></script>
<script src="{{asset('backend/vendors/js/charts/morris.min.js')}}" type="text/javascript"></script>
<script src="{{asset('backend/vendors/js/charts/chart.min.js')}}" type="text/javascript"></script>

<script>

$(window).on("load", function(){

    /********************************************
    *               Monthly Sales               *
    ********************************************/
    Morris.Bar.prototype.fillForSeries = function(i) {
      var color;
      return "0-#fff-#f00:20-#000";
    };

    Morris.Bar({
        element: 'pages-visits',
        data: [
            @foreach ($pageVisits as $page)
                {page: '<a href="{{$page->url}}">{{$page->url}}</a>', visits: {{$page->total}} }
                @if (!$loop->last)
                    ,
                @endif
            @endforeach
        ],
        xkey: 'page',
        ykeys: ['visits'],
        labels: ['زيارة'],
        barGap: 4,
        barSizeRatio: 0.3,
        gridTextColor: '#bfbfbf',
        gridLineColor: '#E4E7ED',
        numLines: 5,
        gridtextSize: 14,
        resize: true,
        barColors: ['#1e9ff2'],
        hideHover: 'auto',
    });



    var ctx3 = document.getElementById("earning-chart").getContext("2d");

    // Chart Options
    var earningOptions = {
        responsive: true,
        maintainAspectRatio: false,
        datasetStrokeWidth: 3,
        pointDotStrokeWidth: 4,
        tooltipFillColor: "rgba(0,0,0,0.8)",
        legend: {
            display: false,
            position: 'bottom',
        },
        hover: {
            mode: 'label'
        },
        scales: {
            xAxes: [{
                display: false,
            }],
            yAxes: [{
                display: false,
                ticks: {
                    min: 0,
                    max: 70
                },
            }]
        },
        title: {
            display: false,
            fontColor: "#FFF",
            fullWidth: false,
            fontSize: 40,
            text: '82%'
        }
    };

    // Chart Data
    var earningData = {
        labels: [
            @foreach ($monthVisits as $visits)
                "{{$visits->month_name}}"
                @if (!$loop->last)
                    ,
                @endif
            @endforeach
        ],
        datasets: [{
            label: "عدد الزيارات",
            data: [
                @foreach ($monthVisits as $visits)
                    {{$visits->count}}
                    @if (!$loop->last)
                      ,
                    @endif
                @endforeach
            ],
            backgroundColor: 'rgba(255,117,136,0.12)',
            borderColor: "#FF4961",
            borderWidth: 3,
            strokeColor: "#FF4961",
            capBezierPoints: true,
            pointColor: "#fff",
            pointBorderColor: "#FF4961",
            pointBackgroundColor: "#FFF",
            pointBorderWidth: 3,
            pointRadius: 5,
            pointHoverBackgroundColor: "#FFF",
            pointHoverBorderColor: "#FF4961",
            pointHoverRadius: 7,
        }]
    };

    var earningConfig = {
        type: 'line',

        // Chart Options
        options: earningOptions,

        // Chart Data
        data: earningData
    };

    // Create the chart
    var earningChart = new Chart(ctx3, earningConfig);



    //Sessions by Browser
    // -----------------------------------
    Morris.Donut({
        element: 'sessions-browser-donut-chart',
        data: [
            @foreach ($browserVisits as $item)
                {
                    label: "{{ $item->browser }}",
                    value: {{ $item->count }}
                }
                @if (!$loop->last)
                    ,
                @endif
            @endforeach
        ],
        resize: true,
        colors: ['#40C7CA', '#FF7588', '#2DCEE3', '#FFA87D', '#16D39A']
    });

    //Sessions by device
    // -----------------------------------
    Morris.Donut({
        element: 'sessions-device-donut-chart',
        data: [
            @foreach ($deviceVisits as $item)
                {
                    label: "{{ $item->device }}",
                    value: {{ $item->count }}
                }
                @if (!$loop->last)
                    ,
                @endif
            @endforeach
        ],
        resize: true,
        colors: ['#FFA87D', '#FF7588','#40C7CA',  '#2DCEE3', '#16D39A']
    });

    //Sessions by platform
    // -----------------------------------
    Morris.Donut({
        element: 'sessions-platform-donut-chart',
        data: [
            @foreach ($platformVisits as $item)
                {
                    label: "{{ $item->platform }}",
                    value: {{ $item->count }}
                }
                @if (!$loop->last)
                    ,
                @endif
            @endforeach
        ],
        resize: true,
        colors: ['#2DCEE3', '#FFA87D', '#40C7CA', '#FF7588', '#16D39A']
    });
});

</script>

<script>

    $('.delete-btn').click(function() {
        $('#deleteModal form').attr('action', $(this).data('action'))
    });

</script>

@endsection
