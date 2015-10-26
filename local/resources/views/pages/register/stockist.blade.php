@extends('layouts.default')
@section('title')
Stockist - Registration
@stop
@section('styles')
@stop
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Register Stockist
    <small>Create New Stockist</small>
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Register</li>
    <li class="active">New Stockist</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  {!! Form::open(array('url' => '/register/stockist', 'method' => 'post')) !!}
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
            <div class="form-group {{ $errors->has('firstname') ? 'has-error' : '' }}">
              {!! Form::label('firstname', 'First Name', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::text('firstname', null, ['class' => 'form-control', 'style' => 'text-transform:uppercase']) !!}
                {!! $errors->first('firstname', '<label class="control-label"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
              </div>
            </div>
            <div class="form-group {{ $errors->has('middlename') ? 'has-error' : '' }}">
              {!! Form::label('middlename', 'Middle Name', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::text('middlename', null, ['class' => 'form-control', 'style' => 'text-transform:uppercase']) !!}
                {!! $errors->first('middlename', '<label class="control-label"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
              </div>
            </div>
            <div class="form-group {{ $errors->has('lastname') ? 'has-error' : '' }}">
              {!! Form::label('lastname', 'Last Name', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::text('lastname', null, ['class' => 'form-control', 'style' => 'text-transform:uppercase']) !!}
                {!! $errors->first('lastname', '<label class="control-label"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
              </div>
            </div>
            <div class="form-group {{ $errors->has('suffix') ? 'has-error' : '' }}">
              {!! Form::label('suffix', 'Suffix', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::text('suffix', null, ['class' => 'form-control', 'style' => 'text-transform:uppercase']) !!}
                {!! $errors->first('suffix', '<label class="control-label"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
              </div>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
              {!! Form::label('email', 'Email Address', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::email('email', null, ['class' => 'form-control']) !!}
                {!! $errors->first('email', '<label class="control-label"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
              </div>
            </div>
            <div class="form-group {{ $errors->has('mobileno') ? 'has-error' : '' }}">
              {!! Form::label('mobileno', 'Mobile No.', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::text('mobileno', null, ['class' => 'form-control', 'data-inputmask' => '"mask": "9999-999-9999"', 'data-mask']) !!}
                {!! $errors->first('mobileno', '<label class="control-label"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
              </div>
            </div>
            <div class="form-group {{ $errors->has('phoneno') ? 'has-error' : '' }}">
              {!! Form::label('phoneno', 'Phone No.', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::text('phoneno', null, ['class' => 'form-control', 'data-inputmask' => '"mask": "(999) 999-9999"', 'data-mask']) !!}
                {!! $errors->first('phoneno', '<label class="control-label"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
              </div>
            </div>
            <div class="form-group {{ $errors->has('birthdate') ? 'has-error' : '' }}">
              {!! Form::label('birthdate', 'Birthdate', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::text('birthdate', null, ['class' => 'form-control', 'data-inputmask' => '"alias": "yyyy/mm/dd"', 'data-mask']) !!}
                {!! $errors->first('birthdate', '<label class="control-label"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
              </div>
            </div>
            <div class="form-group">
              {!! Form::label('gender', 'Gender', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-3">
                {!! Form::select('gender', ['m' => 'Male', 'f' => 'Female'], null, ['class' => 'form-control']) !!}
              </div>
            </div>
            <div class="form-group {{ $errors->has('street_address') ? 'has-error' : '' }}">
              {!! Form::label('street_address', 'Address', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::text('street_address', null, ['class' => 'form-control', 'style' => 'text-transform:uppercase']) !!}
                {!! $errors->first('street_address', '<label class="control-label"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
              </div>
            </div>
            <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
              {!! Form::label('city', 'City', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::select('city', [], null, ['class' => 'form-control']) !!}
              </div>
            </div>
            <div class="form-group {{ $errors->has('province') ? 'has-error' : '' }}">
              {!! Form::label('province', 'Province', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::select('province', [], null, ['class' => 'form-control']) !!}
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
            <!-- <div class="form-group {{ $errors->has('sponsor_id') ? 'has-error' : '' }}">
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
            </div> -->
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
            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
              {!! Form::label('password', 'Password', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::password('password', ['class' => 'form-control']) !!}
                {!! $errors->first('password', '<label class="control-label"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
              </div>
            </div>
            <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
              {!! Form::label('password_confirmation', 'Confirm Password', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                {!! $errors->first('password_confirmation', '<label class="control-label"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
              </div>
            </div>
            <!-- <div class="form-group">
              {!! Form::label('', 'Entry Package', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::select('entry_package', 
                [
                  '1' => '1 Account - P500', 
                  '3' => '3 Account - P1,500',
                  '7' => '7 Account - P3,500', 
                  '15' => '15 Account - P7,500', 
                  '31' => '31 Account - P15,500', 
                  '63' => '63 Account - P31,500', 
                  '127' => '127 Account - P63,500',
                  '500' => '500 Account - Developer Use ONLY!'
                ], null, ['class' => 'form-control']) !!}
              </div>
            </div> -->
            <!-- /.box-body -->
            <div class="box-footer">
            <button type="button" id="auto_fill" class="btn btn-danger">Auto-Fill</button>
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
    var city_prov = new City_Province();

    // Auto Fill
    $(".content").on('click', '#auto_fill', function() {

        var name = randomName();
        document.getElementById("firstname").value = name;
        document.getElementById("middlename").value = name;
        document.getElementById("lastname").value = name;
        document.getElementById("email").value = randomEmail();
        document.getElementById("mobileno").value = randomMobile();
        document.getElementById("phoneno").value = randomPhone();
        document.getElementById("birthdate").value = '1991/07/30';
        document.getElementById("street_address").value = 'B1-B L4 Italy Street Ivory Crest Village, Salitran 2';
        
        set_city(24);
        document.getElementById("province").value = 24;

        document.getElementById("accountno").value = randomIntFromInterval(1000000001, 1000001000);
        var uname_pword = randomUsername();
        document.getElementById("username").value = uname_pword;
        document.getElementById("password").value = uname_pword;
        document.getElementById("password_confirmation").value = uname_pword;
    });

    function set_city (prov_id) {
      $("#city").empty();
        $.get('/api/city/' + prov_id, function(o) {
            var output = '';
            for (var i = 0; i < o.length; i++) {
            output += '<option value=' + o[i].id + '>' + o[i].name + '</td>';
            }
            $("#city").html(output);
            document.getElementById("city").value = 415;
      }, 'json');
    };

    function randomName() {
        var text = "";
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        for( var i=0; i < 4; i++ )
            text += possible.charAt(Math.floor(Math.random() * possible.length));
        return text;
    }

    function randomUsername() {
        var text = "";
        var possible = "abcdefghijklmnopqrstuvwxyz";
        for( var i=0; i < 4; i++ )
            text += possible.charAt(Math.floor(Math.random() * possible.length));
        return text + randomThreeDigits();
    }

    function randomThreeDigits() {
        var text = "";
        var possible = "1234567890";
        for( var i=0; i < 3; i++ )
            text += possible.charAt(Math.floor(Math.random() * possible.length));
        return text;
    }

    function randomAccNo() {
        var text = "";
        var possible = "1234567890";
        for( var i=0; i < 10; i++ )
            text += possible.charAt(Math.floor(Math.random() * possible.length));
        return text;
    }

    function randomPhone() {
        var text = "043";
        var possible = "1234567890";
        for( var i=0; i < 7; i++ )
            text += possible.charAt(Math.floor(Math.random() * possible.length));
        return text;
    }

    function randomMobile() {
        var text = "090";
        var possible = "1234567890";
        for( var i=0; i < 8; i++ )
            text += possible.charAt(Math.floor(Math.random() * possible.length));
        return text;
    }

    function randomEmail() {
        var text = "alvinmanaros";
        var possible = "1234567890";
        for( var i=0; i < 3; i++ )
            text += possible.charAt(Math.floor(Math.random() * possible.length));
        return text + '@gmail.com';
    }

    function randomIntFromInterval(min,max) {
        return Math.floor(Math.random()*(max-min+1)+min);
    }
  });
</script>
@stop