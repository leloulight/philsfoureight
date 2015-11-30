@extends('layouts.default')

@section('title')
	Member Transaction
@stop

@section('styles')
@stop


@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    {{$summary[0]->name}}
    <small>Overview</small>
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Member</li>
    <li class="active">Transaction</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <!-- Your Page Content Here -->
  <div class="row">
    <div class="col-md-3">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Referral Credits</h3>
        </div><!-- /.box-header -->
        <div class="box-body" style="display: block;">
          ₱ {{$summary[0]->referral_credit}}
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div>
    <div class="col-md-3">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Reward Program</h3>
        </div><!-- /.box-header -->
        <div class="box-body" style="display: block;">
          ₱ {{$summary[0]->reward_program}}
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div>
    <div class="col-md-3">
      <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Unilevel Bonus</h3>
        </div><!-- /.box-header -->
        <div class="box-body" style="display: block;">
          ₱ {{$summary[0]->unilevel_bonus}}
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div>
    <div class="col-md-3">
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Unilevel Transactions</h3>
        </div><!-- /.box-header -->
        <div class="box-body" style="display: block;">
          ₱ {{$summary[0]->unilevel_transaction}}
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Transaction History</h3>
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
          <table class="table table-striped">
            <tr>
              <th>No.</th>
              <th>Log</th>
              <th>Amount</th>
              <th>Date</th>
            </tr>
            @foreach($transactions as $row)
              <tr>
                <td>{{$row->row_num}}</td>
                <td>{{$row->log}}</td>
                <td><label class="{{$row->amount_status}}">{{$row->amount}}</label></td>
                <td>{{$row->created_at}}</td>
              </tr>
            @endforeach
          </table>
        </div><!-- /.box-body -->
        <div class="box-footer clearfix">
          {!! $transactions->render() !!}
        </div>
      </div><!-- /.box -->
    </div>
  </div>
</section><!-- /.content -->
@stop

@section('scripts')

@stop