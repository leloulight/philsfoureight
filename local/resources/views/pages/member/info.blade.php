@extends('layouts.default')
@section('title')
Member Info
@stop
@section('styles')
@stop
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Member Info
    <small>Profile</small>
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Member</li>
    <li class="active">Info</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Your Page Content Here -->
    <div class="row">
    <div class="col-md-6">
      <!-- Horizontal Form -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Personal Info</h3>
        </div>
        <!-- /.box-header -->
        <div class="form-horizontal">
          <div class="box-body">
            <div class="form-group">
              {!! Form::label('firstname', 'First Name', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::text('firstname', $member[0]->firstname, ['class' => 'form-control', 'style' => 'text-transform:uppercase', 'readonly', 'style' => 'background-color:White']) !!}
              </div>
            </div>
            <div class="form-group">
              {!! Form::label('middlename', 'Middle Name', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::text('middlename', $member[0]->middlename, ['class' => 'form-control', 'style' => 'text-transform:uppercase', 'readonly', 'style' => 'background-color:White']) !!}
              </div>
            </div>
            <div class="form-group">
              {!! Form::label('lastname', 'Last Name', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::text('lastname', $member[0]->lastname, ['class' => 'form-control', 'style' => 'text-transform:uppercase', 'readonly', 'style' => 'background-color:White']) !!}
              </div>
            </div>
            <div class="form-group">
              {!! Form::label('suffix', 'Suffix', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::text('suffix', $member[0]->suffix, ['class' => 'form-control', 'style' => 'text-transform:uppercase', 'readonly', 'style' => 'background-color:White']) !!}
              </div>
            </div>
            <div class="form-group">
              {!! Form::label('email', 'Email Address', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::email('email', $member[0]->email, ['class' => 'form-control', 'readonly', 'style' => 'background-color:White']) !!}
              </div>
            </div>
            <div class="form-group">
              {!! Form::label('mobileno', 'Mobile No.', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::text('mobileno', $member[0]->mobileno, ['class' => 'form-control', 'data-inputmask' => '"mask": "9999-999-9999"', 'data-mask', 'readonly', 'style' => 'background-color:White']) !!}
              </div>
            </div>
            <div class="form-group">
              {!! Form::label('phoneno', 'Phone No.', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::text('phoneno', $member[0]->phoneno, ['class' => 'form-control', 'data-inputmask' => '"mask": "(999) 999-9999"', 'data-mask', 'readonly', 'style' => 'background-color:White']) !!}
              </div>
            </div>
            <div class="form-group">
              {!! Form::label('birthdate', 'Birthdate', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::text('birthdate', $member[0]->birthdate, ['class' => 'form-control', 'data-inputmask' => '"alias": "yyyy/mm/dd"', 'data-mask', 'readonly', 'style' => 'background-color:White']) !!}
              </div>
            </div>
            <div class="form-group">
              {!! Form::label('gender', 'Gender', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-3">
                {!! Form::text('gender', $member[0]->gender, ['class' => 'form-control', 'readonly', 'style' => 'background-color:White']) !!}
              </div>
            </div>
            <div class="form-group">
              {!! Form::label('street_address', 'Street Adress', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::text('street_address', $member[0]->street_address, ['class' => 'form-control', 'readonly', 'style' => 'background-color:White']) !!}
              </div>
            </div>
            <div class="form-group">
              {!! Form::label('city', 'City', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::text('city', $member[0]->city_name, ['class' => 'form-control', 'readonly', 'style' => 'background-color:White']) !!}
              </div>
            </div>
            <div class="form-group">
              {!! Form::label('province', 'Province', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::text('province', $member[0]->province_name, ['class' => 'form-control', 'readonly', 'style' => 'background-color:White']) !!}
              </div>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
      </div>
      <!-- /.box -->
    </div>
    <div class="col-md-6">
      <!-- Horizontal Form -->
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Account Info</h3>
        </div>
        <!-- /.box-header -->
        <div class="form-horizontal">
          <div class="box-body">
            <div class="form-group">
              {!! Form::label('sponsorid', 'Sponsor Id', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::text('sponsor_id', $member[0]->sponsor_name, ['class' => 'form-control', 'readonly', 'style' => 'background-color:White']) !!}
              </div>
            </div>
            <div class="form-group">
              {!! Form::label('accountno', 'Account No.', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::text('accountno', $member[0]->accountno, ['class' => 'form-control', 'readonly', 'style' => 'background-color:White']) !!}
              </div>
            </div>
            <div class="form-group">
              {!! Form::label('username', 'Username', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::text('username', $member[0]->username, ['class' => 'form-control', 'style' => 'text-transform:lowercase', 'readonly', 'style' => 'background-color:White']) !!}
              </div>
            </div>
            <div class="form-group">
              {!! Form::label('status', 'Status', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-3">
                <span class="badge {{$member[0]->badgeStatus}}">{{$member[0]->badgeStatusLabel}}</span>
              </div>
            </div>
            <div class="form-group">
              {!! Form::label('created_at', 'Date Created', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::text('created_at', $member[0]->created_at, ['class' => 'form-control', 'style' => 'text-transform:lowercase', 'readonly', 'style' => 'background-color:White']) !!}
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- /.box -->
      </div>
    </div>
    <div class="col-md-6">
      <!-- Horizontal Form -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">General Info</h3>
        </div>
        <!-- /.box-header -->
        <div class="form-horizontal">
          <div class="box-body">
            <div class="form-group">
              {!! Form::label('money', 'Main Acc. Money', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                <div class="input-group">
                  {!! Form::text('money', $member[0]->money, ['class' => 'form-control', 'readonly', 'style' => 'background-color:White']) !!}
                  <span class="input-group-btn">
                    <a href="{{$member[0]->id}}/transactions" class="btn btn-success btn-flat">Logs</a>
                  </span>
                </div>
              </div>
            </div>
            <div class="form-group">
              {!! Form::label('submoney', 'Sub Acc. Money', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                <div class="input-group">
                  {!! Form::text('submoney', $member[0]->sub_money, ['class' => 'form-control', 'readonly', 'style' => 'background-color:White']) !!}
                  <span class="input-group-btn">
                    <a href="" class="btn btn-success btn-flat">Logs</a>
                  </span>
                </div>
              </div>
            </div>
            <div class="form-group">
              {!! Form::label('total_sub', 'Total Sub Acc.', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                <div class="input-group">
                  {!! Form::text('total_sub', $member[0]->total_sub, ['class' => 'form-control', 'readonly', 'style' => 'background-color:White']) !!}
                  <span class="input-group-btn">
                    <a href="" class="btn btn-primary btn-flat">View</a>
                  </span>
                </div>
              </div>
            </div>
            <div class="form-group">
              {!! Form::label('reward', 'Reward Program Status', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::text('created_at', $member[0]->reward_status, ['class' => 'form-control', 'style' => 'text-transform:lowercase', 'readonly', 'style' => 'background-color:White']) !!}
              </div>
            </div>
            <div class="box-footer">
              <a class="btn btn-success" href="">Genealogy</a>
              <a class="btn btn-warning" href="">Unilevel</a>
              
              <a class="btn btn-danger pull-right" href="../member">Back</a>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- /.box -->
      </div>
    </div>
    </div>
</section>
<!-- /.content -->
@stop
@section('scripts')
<!-- Loader -->
<script src="{{asset('dist/js/loader.js')}}"></script>
<script src="{{asset('common/dd_city_prov.js')}}"></script>
<!-- InputMask -->
<script src="{{asset('plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
<!-- Page script -->
<script>
  $(function () {
    $("[data-mask]").inputmask();
  });
</script>
@stop