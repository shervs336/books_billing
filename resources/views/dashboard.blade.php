@extends('layouts.app')

@section('content')
  <section class="content-header">
      <h1 class="pull-left">Dashboard</h1>
  </section>
  <div class="clearfix"></div>
  <div class="content">
      <div class="clearfix"></div>

      <div class="row">

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{ $books->count() }}</h3>

              <p>Number of Titles</p>
            </div>
            <div class="icon">
              <i class="fa fa-book"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{ $books->sum('stocks') }}</h3>

              <p>Number of Stocks</p>
            </div>
            <div class="icon">
              <i class="fa fa-dropbox"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ $sales->count() }}</h3>

              <p>Transactions</p>
            </div>
            <div class="icon">
              <i class="fa fa-refresh"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>₱ {{ number_format($totalSales, 2) }}</h3>

              <p>Sales</p>
            </div>
            <div class="icon">
              <i class="fa fa-money"></i>
            </div>
          </div>
        </div>

      </div>

      <div class="row">
        <div class="col-lg-12">
          <!-- small box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <div class="box-title">Sales Chart</div>
            </div>
            <div class="box-body">
              <canvas id="mySales" height="90"></canvas>
            </div>
          </div>

        </div>
      </div>

  </div>
@endsection

@section('scripts')
  <script>
      var ctx = document.getElementById('mySales').getContext('2d');
      var bgColor = [
          "#f38b4a",
          "#56d798",
          "#ff8397",
          "#6970d5"
        ]
      var chart = new Chart(ctx, {
          // The type of chart we want to create
          type: 'line',

          // The data for our dataset
          data: {
              labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
              datasets: [
                @php
                  $ctr = 0;
                  $arrayData = [0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00];
                @endphp
                @for($i=$salesYears->min(); $i <= $salesYears->max(); $i++)
                {
                  @php
                    if(isset($salesData[$i])){
                      foreach($salesData[$i] as $x)
                      {
                        $arrayData[($x->month-1)] = $x->total_price;
                      }
                    }
                  @endphp
                  label: {{ $i }},
                  fill: false,
                  backgroundColor: bgColor[{{ $ctr }}],
                  borderColor: bgColor[{{ $ctr }}],
                  data: ['{!! implode("','", $arrayData) !!}'],
                }@if($i != $salesYears->max()),@endif
                @php
                  $ctr++;
                  $arrayData = [0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00];
                @endphp
                @endfor
            ]
          },

          // Configuration options go here
          options: {}
      });
  </script>
@endsection
