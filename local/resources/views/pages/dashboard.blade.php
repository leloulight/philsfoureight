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
            ₱ {!! $widget[0]->admin_money !!}<span style="font-size: 20px;">.{!! $widget[0]->admin_money_dec !!}</span>
          </h3>
          <p>Company's Income</p>
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
          <h3>{!! $widget[0]->new_registration !!}</h3>
          <p>New Registrations</p>
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
            ₱ {!! $widget[0]->member_money !!}<span style="font-size: 20px;">.{!! $widget[0]->member_money_dec !!}</span>
          </h3>
          <p>Member's Income</p>
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
          <h3>{!! $widget[0]->reward_complete !!}</h3>
          <p>Reward Program Completed</p>
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
    <!-- /.col (RIGHT) -->
    <div class="col-md-4">
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Latest Members</h3>
          <div class="box-tools pull-right">
            <span class="label label-danger">{!! $widget[0]->new_registration !!} New Member(s)</span>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
          <ul class="users-list clearfix">
            @foreach($latest_member as $member)
            <li>
              <img src="dist/img/default-user.png" alt="User Image">
              <a class="users-list-name" href="#">{{$member->name}}</a>
              <span class="users-list-date">{{$member->created_at}}</span>
            </li>
            @endforeach
          </ul>
          <!-- /.users-list -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer text-center">
          <a href="member" class="uppercase">View All Users</a>
        </div>
        <!-- /.box-footer -->
      </div>
      <!--/.box -->
    </div>
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-md-8">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Completed Reward Program</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table class="table no-margin">
              <thead>
                <tr>
                  <th>Acc No.</th>
                  <th>Name</th>
                  <th>Level</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody>
                
                 @foreach($reward_list as $member)
                  <tr>
                    <td><a href="pages/examples/invoice.html">{{$member->accountno}}</a></td>
                    <td>{{$member->name}}</td>
                    <td><span class="label {{$member->level_status}}">Level {{$member->level}}</span></td>
                    <td>
                      <div class="sparkbar" data-color="#00a65a" data-height="20">{{$member->created_at}}</div>
                    </td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All</a>
        </div>
        <!-- /.box-footer -->
      </div>
      <!-- /.box -->
    </div>
    <div class="col-md-4">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Top 5 Earners</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <ul class="products-list product-list-in-box">
            
            @foreach($top_earner as $member)
            <li class="item">
              <div class="product-img">
                <img src="dist/img/default-user.png" alt="User Image">
              </div>
              <div class="product-info">
                <a href="javascript::;" class="product-title">{{$member->name}} <button class="btn btn-primary btn-sm pull-right"><b>₱ {{$member->money}}</b></button></a>
                <span class="product-description">
                {{$member->city}}, {{$member->province}}
                </span>
              </div>
            </li>
            @endforeach
            <!-- /.item -->
          </ul>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
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
      
        barChartOptions.datasetFill = false;
        barChart.Bar(barChartData, barChartOptions);
    });
  });
</script>
@stop