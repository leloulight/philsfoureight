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
    <small>Pending</small>
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Reward Program</li>
    <li class="active">Pending</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <!-- Your Page Content Here -->
  <div class="row">
    <div class="col-xs-6">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Reward Program - Pending List - Level {{$level}}</h3>
          <div class="box-tools">
            <div class="input-group" style="width: 150px;">
              <input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search">
              <div class="input-group-btn">
                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-striped">
            <tr>
              <th>No.</th>
              <th>Name</th>
              <th>Type</th>
              <th>Date Activated</th>
            </tr>
            @foreach($reward as $row)
              <tr>
                <td>{{$row->row_num}}</td>
                <td>{{$row->lastname}}, {{$row->firstname}} {{$row->suffix}} {{$row->middlename}}</td>
                <td>{!! $row->typeSpan !!}</td>
                <td>{{$row->activated_at}}</td>
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
@stop

@section('scripts')

@stop