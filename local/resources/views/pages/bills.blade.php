@extends('layouts.default')
@section('title')
Bills Payment
@stop
@section('styles')
@stop
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Bills Payment
    <small>Online Transaction</small>
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Home</li>
    <li class="active">Bills Payment</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <!-- Your Page Content Here -->
  {!! Form::open(array('url' => '/bills/invoice', 'method' => 'post', 'onsubmit' => 'submit.disabled = true; return true;')) !!}
  <!-- Your Page Content Here -->
  <div class="row">
    <div class="col-md-6">
      <!-- Horizontal Form -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Bills Payment</h3>
        </div>
        <!-- /.box-header -->
        <div class="form-horizontal">
          <div class="box-body">
            <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
              {!! Form::label('city', 'Bills Payment', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                <select class="form-control" name="bills_main" id="bills_main">
                  @foreach($bills_main as $row)
                  @if ($id == $row->id)
                  <option value="{{$row->id}}" selected>{{$row->name}}</option>
                  @else
                  <option value="{{$row->id}}">{{$row->name}}</option>
                  @endif
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group {{ $errors->has('province') ? 'has-error' : '' }}">
              {!! Form::label('province', 'Type', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                <select class="form-control" name="bills_sub" id="bills_sub">
                  @foreach($bills_sub as $row)
                  @if ($sub == $row->id)
                  <option value="{{$row->id}}" selected>{{$row->name}}</option>
                  @else
                  <option value="{{$row->id}}">{{$row->name}}</option>
                  @endif
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group {{ $errors->has('refno') ? 'has-error' : '' }}">
              {!! Form::label('refno', 'Reference No.', ['class' => 'col-sm-3 control-label']) !!}
              <div class="col-sm-9">
                {!! Form::text('refno', null, ['class' => 'form-control', 'style' => 'text-transform:uppercase']) !!}
                {!! $errors->first('refno', '<label class="control-label"><i class="fa fa-times-circle-o"></i> :message</label>') !!}
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
<script src="{{asset('dist/js/loader.js')}}"></script>
<script src="{{asset('common/ul_bills.js')}}"></script>
<script type="text/javascript">
  $(function () {
      var bills_ul = new Bills();
  });
</script>
@stop