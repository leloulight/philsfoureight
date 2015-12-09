@extends('layouts.default')
@section('title')
Dashboard
@stop
@section('styles')
@stop
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Dashboard
    <small>Control Panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Home</li>
    <li class="active">Dashboard</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <!-- Your Page Content Here -->
  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>
            <!-- ₱ --> {!! $widget[0]->balance !!}<span style="font-size: 20px;">.{!! $widget[0]->balance_dec !!}</span>
          </h3>
          <p>Available Balance</p>
        </div>
        <div class="icon">
          <i class="ion ion-android-globe"></i>
        </div>
        <div class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>
            <!-- ₱ --> {!! $widget[0]->referral_unilevel !!}<span style="font-size: 20px;">.{!! $widget[0]->referral_unilevel_dec !!}</span>
          </h3>
          <p>Referral / Unilevel Bonus</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <div class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3>
            <!-- ₱ --> {!! $widget[0]->commission !!}<span style="font-size: 20px;">.{!! $widget[0]->commission_dec !!}</span>
          </h3>
          <p>Unilevel Commission</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <div class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3>
            <!-- ₱ --> {!! $widget[0]->reward !!}<span style="font-size: 20px;">.{!! $widget[0]->reward_dec !!}</span>
          </h3>
          <p>Reward Program</p>
        </div>
        <div class="icon">
          <i class="ion-android-contact"></i>
        </div>
        <div class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></div>
      </div>
    </div>
    <!-- ./col -->
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-md-8">
      <!-- BAR CHART -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Bar Chart</h3>
        </div>
        <div class="box-body">
          <div class="chart">
            <canvas id="barChart" style="height:230px"></canvas>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <div class="col-md-4">
      <div class="box box-danger">
        <!-- /.box-header -->
            <table class="table table-responsive" id="table_stats">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Credit</th>
                  <th>Debit</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td colspan="3">Loading...</td>
                </tr>
              </tbody>
            </table>
        <!-- /.box-body -->
      </div>
      <!--/.box -->
    </div>
  </div>
</section>
<!-- /.content -->
@stop
@section('scripts')
<script src="plugins/chartjs/Chart.min.js"></script>
<script>
  $(function () {
    $.getJSON('api/bargraph', function(barChartData) {
        //-------------
        //- BAR CHART -
        //-------------
        var barChartCanvas = $("#barChart").get(0).getContext("2d");
        var barChart = new Chart(barChartCanvas);
        
        barChartData.datasets[1].fillColor = "#00a65a";
        barChartData.datasets[1].strokeColor = "#00a65a";
        barChartData.datasets[1].pointColor = "#00a65a";
        var barChartOptions = {
          //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
          scaleBeginAtZero: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: true,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - If there is a stroke on each bar
          barShowStroke: true,
          //Number - Pixel width of the bar stroke
          barStrokeWidth: 2,
          //Number - Spacing between each of the X value sets
          barValueSpacing: 5,
          //Number - Spacing between data sets within X values
          barDatasetSpacing: 1,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          //Boolean - whether to make the chart responsive
          responsive: true,
          maintainAspectRatio: true
        };
        var credit = barChartData.datasets[0].data;
        var debit = barChartData.datasets[1].data;
        var date = barChartData.labels;

        var content = '';
        for (var i = 0; i < 7; i++) {
          content += '<tr>';
          content += '<td>' + date[i] + '</td>';
          content += '<td><label class="text-green">' + parseFloat(credit[i]).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,') + '</label></td>';
          content += '<td><label class="text-red">' + parseFloat(debit[i]).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,') + '</label></td>';
          content += '</tr>';
        };
        
        barChartOptions.datasetFill = false;
        barChart.Bar(barChartData, barChartOptions);
        $('#table_stats tbody').html(content);
    });
  });

</script>
@stop
