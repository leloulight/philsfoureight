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
          <h3 class="box-title">Transaction Info</h3>
        </div>
        <!-- /.box-header -->
        <div class="form-horizontal">
          <div class="box-body">
            <div class="form-group">
              {!! Form::label('money', 'Main Acc. Money', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::text('sponsor_id', $member[0]->money, ['class' => 'form-control', 'readonly', 'style' => 'background-color:White']) !!}
              </div>
            </div>
            <div class="form-group">
              {!! Form::label('submoney', 'Sub Acc. Money', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::text('sponsor_id', $member[0]->sub_money, ['class' => 'form-control', 'readonly', 'style' => 'background-color:White']) !!}
              </div>
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