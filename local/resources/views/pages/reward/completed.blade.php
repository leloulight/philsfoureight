@extends('layouts.default')

@section('title')
	Reward Program
@stop

@section('styles')
@stop


@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Reward Program
    <small>Completed</small>
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Reward Program</li>
    <li class="active">Completed</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <!-- Your Page Content Here -->
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Reward Program - Completed List - Level {{$level}}</h3>
          <div class="box-tools">
            <!-- <div class="input-group" style="width: 150px;">
              <input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search">
              <div class="input-group-btn">
                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
              </div>
            </div> -->
          </div>
        </div><!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table id="rewardSummary" class="table table-striped">
            <tr>
              <th>No.</th>
              <th>Name</th>
              <th>Type</th>
              <th>Date Completed</th>
              <th></th>
            </tr>
            @foreach($reward as $row)
              <tr>
                <td>{{$row->row_num}}</td>
                <td>{{$row->lastname}}, {{$row->firstname}} {{$row->suffix}} {{$row->middlename}}</td>
                <td>{!! $row->typeSpan !!}</td>
                <td>{{$row->completed_at}}</td>
                <td><button id="{{$level}}-{{$row->id}}" class="btn btn-info btn-xs" data-toggle="modal">View</button></td>
              </tr>
            @endforeach
          </table>
        </div><!-- /.box-body -->
        <div class="box-footer clearfix">
          {!! $reward->render() !!}
        </div>
      </div><!-- /.box -->
    </div>
  </div>
</section><!-- /.content -->
<!-- Modal -->
<div id="modalList" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Unity List</h4>
      </div>
      <div class="modal-body box-body table-responsive no-padding">
        <table id="rewardList" class="table table-striped">
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@stop

@section('scripts')
<script src="{{asset('dist/js/loader.js')}}"></script>
<script>
$(function () {
  $("#rewardSummary button").click(function() {
    loader.init();
    var button = this;
    var split = button.id.split('-');

    var level = split[0];
    var id = split[1];

    $.getJSON('/api/reward/member/' + level + '/' + id, function(o) {
      var output = '<tr>'
      output += '<th>Name</th>';
      output += '<th>Account No.</th>';
      output += '<th>Type</th>';
      output += '<th>Date Inserted</th>';
      output += '</tr>';
      for (var i = 0; i < o.length; i++) {
        output += '<tr>';
        output += '<td>' + o[i].name + '</td>';
        output += '<td>' + o[i].accountno + '</td>';
        output += '<td>' + o[i].typeSpan + '</td>';
        output += '<td>' + o[i].inserted_at + '</td>';
        output += '</tr>';
      }
      var modalTable = document.getElementById("rewardList");
      $(modalTable).html(output);
      loader.destroy();
      $('#modalList').modal('show');
    });
  });
});
</script>
@stop