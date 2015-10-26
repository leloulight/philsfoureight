@extends('layouts.default')

@section('title')
	Account No.
@stop

@section('styles')
@stop


@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Account No.
    <small>Generate Account No.</small>
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Account No.</li>
    <li class="active">Generate</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <!-- Your Page Content Here -->
  {!! Form::open(array('url' => '/settings/accountno/generate', 'method' => 'post')) !!}
    <!-- Your Page Content Here -->
    <div class="row">
    <div class="col-md-6">
      <!-- Horizontal Form -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Account No. Info</h3>
        </div>
        <!-- /.box-header -->
        <div class="form-horizontal">
          <div class="box-body">
            <div class="form-group">
              {!! Form::label('last_accountno', 'Last Account No.', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::text('last_accountno', $start, ['class' => 'form-control', 'readonly', 'style' => 'background-color:White;']) !!}
              </div>
            </div>
            <div class="form-group {{ $errors->has('no_accounts') ? 'has-error' : '' }}">
              {!! Form::label('no_accounts', 'No. of Cards', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::text('no_accounts', null, ['class' => 'form-control']) !!}
                {!! $errors->first('no_accounts', '<label class="control-label"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
              </div>
            </div>
            <!-- <div class="form-group {{ $errors->has('error_result') ? 'has-error' : '' }}">
              {!! Form::label('', '', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! $errors->first('error_result', '<label class="control-label"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
              </div>
            </div> -->
          </div>
          <!-- @if (count($errors) > 0)
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif -->
          <!-- /.box-body -->
          <div class="box-footer">
              {!! Form::submit('Submit', ['class' => 'btn btn-info pull-right', 'name' => 'submit']); !!}
            </div>
        </div>
      </div>
      <!-- /.box -->
    </div>
  </div>
  {!! Form::close() !!}
</section><!-- /.content -->
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