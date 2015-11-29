@extends('layouts.default')
@section('title')
Remittance
@stop
@section('styles')
@stop
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Remittance
    <small>Online Transaction</small>
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Home</li>
    <li class="active">Remittance</li>
  </ol>
</section>
<!-- Main content -->

<section class="content">
 {!! Form::open(array('url' => '/remittance/invoice', 'method' => 'post')) !!}
  <!-- Your Page Content Here -->
  <div class="row">
  
  <div class="col-md-6">
      <!-- Horizontal Form -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Remittance Service</h3>
        </div>
        <!-- /.box-header -->
        <div class="form-horizontal">
          <div class="box-body">
            <div class="form-group {{ $errors->has('accountno') ? 'has-error' : '' }}">
              {!! Form::label('accountno', 'Account No.', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::text('accountno', null, ['class' => 'form-control', 'style' => 'text-transform:uppercase']) !!}
                {!! $errors->first('accountno', '<label class="control-label"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
              </div>
            </div>
            <div class="form-group {{ $errors->has('memberid') ? 'has-error' : '' }}">
              {!! Form::label('memberid', 'Member Id', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::text('memberid', null, ['class' => 'form-control', 'style' => 'text-transform:lowercase']) !!}
                {!! $errors->first('memberid', '<label class="control-label"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
              </div>
            </div>
            <div class="form-group {{ $errors->has('balance') ? 'has-error' : '' }}">
              {!! Form::label('balance', 'My Balance', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::text('balance', number_format(Auth::user()->money, 2), ['class' => 'form-control', 'style' => 'text-transform:uppercase', 'readonly', 'style' => 'background-color:White']) !!}
                {!! $errors->first('balance', '<label class="control-label"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
              </div>
            </div>
            <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
              {!! Form::label('amount', 'Amount', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::text('amount', null, ['class' => 'form-control', 'style' => 'text-transform:uppercase']) !!}
                {!! $errors->first('amount', '<label class="control-label"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
                {!! $errors->has('sponsor_id') ? '' : '<label class="control-label text-aqua"><i class="fa fa-bell-o"></i> Fee is 2% if amount.</label>' !!}
              </div>
            </div>
            <div class="form-group {{ $errors->has('note') ? 'has-error' : '' }}">
              {!! Form::label('note', 'Note', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::textarea('note', null, ['class' => 'form-control', 'style' => 'text-transform:uppercase', 'size' => '30x2']) !!}
                {!! $errors->first('note', '<label class="control-label"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
              </div>
            </div>
            <div class="box-footer">
              @if ($hasPending)
                <button class="btn btn-warning pull-right" type="button">You still have a pending request</button>
              @else
                {!! Form::submit('Submit', ['class' => 'btn btn-info pull-right', 'name' => 'submit']); !!}
              @endif
            </div>
          </div>
          <!-- /.box-body -->
        </div>
      </div>
      <!-- /.box -->
    </div>
  </div>
 
  {!! Form::close() !!}
</section>
<!-- /.content -->
@stop
@section('scripts')

@stop