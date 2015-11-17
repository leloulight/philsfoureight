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
      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">PhilsFourEight Remittance Rates</h3>
          <div class="box-tools">
          </div>
        </div><!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-striped">
            <tr>
              <th style="background-color:#cceae7"><center>Amount</center></th>
              <th style="background-color:#cceae7"><center>Fee</center></th>
              <th style="background-color:#99d5cf"><center>Amount</center></th>
              <th style="background-color:#99d5cf"><center>Fee</center></th>
            </tr>
            <tr align="center">
              <td style="background-color:#cceae7">1 - 50</td>
              <td style="background-color:#cceae7">2</td>
              
              <td style="background-color:#99d5cf">2,301 - 2,500</td>
              <td style="background-color:#99d5cf">72</td>
              
            </tr>
            <tr align="center">
              <td style="background-color:#cceae7">51 - 100</td>
              <td style="background-color:#cceae7">3</td>
              
              <td style="background-color:#99d5cf">2,501 - 2,800</td>
              <td style="background-color:#99d5cf">81</td>
              
            </tr>
            <tr align="center">
              <td style="background-color:#cceae7">101 - 200</td>
              <td style="background-color:#cceae7">6</td>
              
              <td style="background-color:#99d5cf">2,801 - 3,000</td>
              <td style="background-color:#99d5cf">87</td>
              
            </tr>
            <tr align="center">
              <td style="background-color:#cceae7">201 - 300</td>
              <td style="background-color:#cceae7">9</td>
              
              <td style="background-color:#99d5cf">3,001 - 3,500</td>
              <td style="background-color:#99d5cf">93</td>
              
            </tr>
            <tr align="center">
              <td style="background-color:#cceae7">301 - 400</td>
              <td style="background-color:#cceae7">12</td>
              
              <td style="background-color:#99d5cf">3,501 - 4,000</td>
              <td style="background-color:#99d5cf">113</td>
              
            </tr>
            <tr align="center">
              <td style="background-color:#cceae7">401 - 500</td>
              <td style="background-color:#cceae7">15</td>
              
              <td style="background-color:#99d5cf">4,001 - 4,500</td>
              <td style="background-color:#99d5cf">123</td>
              
            </tr>
            <tr align="center">
              <td style="background-color:#cceae7">501 - 600</td>
              <td style="background-color:#cceae7">18</td>
              
              <td style="background-color:#99d5cf">4,501 - 5,000</td>
              <td style="background-color:#99d5cf">128</td>
              
            </tr>
            <tr align="center">
              <td style="background-color:#cceae7">601 - 700</td>
              <td style="background-color:#cceae7">20</td>
              
              <td style="background-color:#99d5cf">5,001 - 6,000</td>
              <td style="background-color:#99d5cf">145</td>
              
            </tr>
            <tr align="center">
            <td style="background-color:#cceae7">701 - 800</td>
              <td style="background-color:#cceae7">23</td>
              <td style="background-color:#99d5cf">6,001 - 7,000</td>
              <td style="background-color:#99d5cf">155</td>
            </tr>
            <tr align="center">
            <td style="background-color:#cceae7">801 - 900</td>
              <td style="background-color:#cceae7">26</td>
              <td style="background-color:#99d5cf">7,001 - 8,000</td>
              <td style="background-color:#99d5cf">165</td>
            </tr>
            <tr align="center">
            <td style="background-color:#cceae7">901 - 1,000</td>
              <td style="background-color:#cceae7">29</td>
              <td style="background-color:#99d5cf">8,001 - 9,500</td>
              <td style="background-color:#99d5cf">185</td>
            </tr>
            <tr align="center">
            <td style="background-color:#cceae7">1,001 - 1,300</td>
              <td style="background-color:#cceae7">38</td>
              <td style="background-color:#99d5cf">9,501 - 10,000</td>
              <td style="background-color:#99d5cf">195</td>
            </tr>
            <tr align="center">
            <td style="background-color:#cceae7">1,301 - 1,500</td>
              <td style="background-color:#cceae7">43</td>
              <td style="background-color:#99d5cf">10,001 - 14,000</td>
              <td style="background-color:#99d5cf">210</td>
            </tr>
            <tr align="center">
            <td style="background-color:#cceae7">1,501 - 1,800</td>
              <td style="background-color:#cceae7">52</td>
              <td style="background-color:#99d5cf">14,001 - 15,000</td>
              <td style="background-color:#99d5cf">220</td>
            </tr>
            <tr align="center">
            <td style="background-color:#cceae7">1,801 - 2,000</td>
              <td style="background-color:#cceae7">58</td>
              <td style="background-color:#99d5cf">15,001 - 20,000</td>
              <td style="background-color:#99d5cf">260</td>
            </tr>
            <tr align="center">
            <td style="background-color:#cceae7">2,001 - 2,300</td>
              <td style="background-color:#cceae7">67</td>
              <td style="background-color:#99d5cf">20,001 - 30,000</td>
              <td style="background-color:#99d5cf">300</td>
            </tr>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
  </div>
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