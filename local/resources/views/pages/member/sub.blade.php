@extends('layouts.default')

@section('title')
	Member List
@stop

@section('styles')
@stop


@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Sub Accounts
    <small>List of Sub Account</small>
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Member</li>
    <li class="active">Sub Accounts</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <!-- Your Page Content Here -->
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Sub Account List</h3>
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
              <th>Money</th>
              <th>Status</th>
              <th>Date Created</th>
            </tr>
            @foreach($member as $row)
              <tr>
                <td>{{$row->row_num}}</td>
                <td><a href="../{{$row->id}}/transactions">{{$row->lastname}}, {{$row->firstname}} {{$row->suffix}} {{$row->middlename}}</a></td>
                <td>{{$row->money}}</td>
                <td><span class="badge {{$row->badgeStatus}}">{{$row->badgeStatusLabel}}</span></td>
                <td>{{$row->created_at}}</td>
              </tr>
            @endforeach
          </table>
        </div><!-- /.box-body -->
        <div class="box-footer clearfix">
          {!! $member->render() !!}
        </div>
      </div><!-- /.box -->
    </div>
  </div>
</section><!-- /.content -->
@stop

@section('scripts')

@stop