@extends('layouts.default')
@section('title')
Sub Accounts - Registration
@stop
@section('styles')
@stop
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Register Sub Accounts
    <small>Create Sub Accounts</small>
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Register</li>
    <li class="active">Sub Accounts</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  {!! Form::open(array('url' => '/register/sub', 'method' => 'post')) !!}
    <!-- Your Page Content Here -->
    <div class="row">
    <div class="col-md-6">
      <!-- Horizontal Form -->
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Account Info</h3>
        </div>
        <!-- /.box-header -->
        <div class="form-horizontal">
          <div class="box-body">
            <div class="form-group {{ $errors->has('accountno') ? 'has-error' : '' }}">
              {!! Form::label('accountno', 'Account No.', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::text('accountno', null, ['class' => 'form-control']) !!}
                {!! $errors->first('accountno', '<label class="control-label"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
              </div>
            </div>
            <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
              {!! Form::label('username', 'Username', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::text('username', null, ['class' => 'form-control', 'style' => 'text-transform:lowercase']) !!}
                {!! $errors->first('username', '<label class="control-label"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
              </div>
            </div>
            <div class="form-group {{ $errors->has('sponsor_id') ? 'has-error' : '' }}">
              {!! Form::label('sponsorid', 'Sponsor Id', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::text('sponsor_id', null, ['class' => 'form-control']) !!}
                {!! $errors->first('sponsor_id', '<label class="control-label"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
                {!! $errors->has('sponsor_id') ? '' : '<label class="control-label text-aqua"><i class="fa fa-bell-o"></i> Leave blank if none.</label>' !!}
              </div>
            </div>
            <div class="form-group {{ $errors->has('placement_id') ? 'has-error' : '' }}">
              {!! Form::label('sponsorid', 'Placement Id', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::text('placement_id', null, ['class' => 'form-control']) !!}
                {!! $errors->first('placement_id', '<label class="control-label"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
                
                {!! $errors->has('placement_id') ? '' : '<label class="control-label text-aqua"><i class="fa fa-bell-o"></i> Leave blank if none.</label>' !!}
              </div>
            </div>
            <div class="form-group">
              {!! Form::label('', 'Placement Type', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::select('placement_type', 
                [
                  'direct' => 'Direct'
                ], null, ['class' => 'form-control']) !!}
              </div>
            </div>
            <div class="form-group">
              {!! Form::label('', 'Entry Package', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::select('entry_package', 
                [
                  '1' => '1 Account - P500',
                  '2' => '2 Account - P1,000',
                  '3' => '3 Account - P1,500', 
                  '4' => '4 Account - P2,000', 
                  '5' => '5 Account - P2,500', 
                  '6' => '6 Account - P3,000',
                  '7' => '7 Account - P3,500', 
                  '8' => '8 Account - P4,000', 
                  '9' => '9 Account - P4,500', 
                  '10' => '10 Account - P5,000'
                ], null, ['class' => 'form-control']) !!}
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <!-- {!! Form::submit('Cancel', ['class' => 'btn btn-default', 'name' => 'clear']); !!} -->
              <!-- <button type="submit" class="btn btn-info pull-right">Submit</button> -->
              {!! Form::submit('Submit', ['class' => 'btn btn-info pull-right', 'name' => 'submit']); !!}
            </div>
          </div>
        </div>
        <!-- /.box -->
      </div>
    </div>
    </div>
  {!! Form::close() !!}
  
</section>
<!-- /.content -->
@stop
@section('scripts')
@stop