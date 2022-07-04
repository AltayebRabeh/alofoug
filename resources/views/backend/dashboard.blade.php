@extends('layouts.backend.admin')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('backend/vendors/css/charts/morris.css')}}">

@endsection

@section('content')
<div class="content-wrapper">

    <div class="row">
        <div class="col-xl-3 col-lg-6 col-12">
          <div class="card pull-up">
            <div class="card-content">
              <div class="card-body">
                <div class="media d-flex">
                  <div class="media-body text-left">
                    <h3 class="info">{{ $posts }}</h3>
                    <h6>احداث و اخبار</h6>
                  </div>
                  <div>
                    <i class="la la-pencil-square text-info" style="font-size: 50px"></i>
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
                    <h3 class="warning">{{ $contacts }}</h3>
                    <h6>مراسلة</h6>
                  </div>
                  <div>
                    <i class="la la-envelope text-warning" style="font-size: 50px"></i>
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
                    <h3 class="success">{{ $programs }}</h3>
                    <h6>برامج</h6>
                  </div>
                  <div>
                    <i class="la la-university text-success" style="font-size: 50px"></i>
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
                        <h3 class="danger">{{ $visitors }}</h3>
                        <h6>إجمالي الزوار</h6>
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
                <div class="card-content">
                  <div class="card-body sales-growth-chart">
                    <div id="pages-visits" class="height-250"></div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="chart-title mb-1 text-center">
                    <h6>عدد الزيارات للصفحات لهذا العام</h6>
                  </div>
                </div>
            </div>
        </div>
      </div>
</div>
@endsection


@section('js')

<script src="{{asset('backend/vendors/js/charts/raphael-min.js')}}" type="text/javascript"></script>
<script src="{{asset('backend/vendors/js/charts/morris.min.js')}}" type="text/javascript"></script>

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

});
</script>

@endsection
