@extends('layouts.default')
@section('title')
Invoice
@stop
@section('styles')
@stop
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Invoice
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Bills Payment</a></li>
    <li class="active">Invoice</li>
  </ol>
</section>
<div class="pad margin no-print">
  <div class="callout callout-info" style="margin-bottom: 0!important;">
    <h4><i class="fa fa-info"></i> Note:</h4>
    This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
  </div>
</div>

<section class="invoice">
{!! Form::open(array('url' => '/bills/submit', 'method' => 'post', 'onsubmit' => 'submit.disabled = true; return true;')) !!}
<input type="hidden" id="bills_main" name="bills_main" value="{{$request['bills_main']}}">
<input type="hidden" id="bills_sub" name="bills_sub" value="{{$request['bills_sub']}}">
<input type="hidden" id="refno" name="refno" value="{{$request['refno']}}">
<input type="hidden" id="amount" name="amount" value="{{$request['amount']}}">
<input type="hidden" id="note" name="note" value="{{$request['note']}}">
  <!-- title row -->
  <div class="row">
    <div class="col-xs-12">
      <h2 class="page-header">
        <i class="fa fa-globe"></i> PhilsFourEight, Co.
        <small class="pull-right">Date: {{date("m/d/Y")}}</small>
      </h2>
    </div>
    <!-- /.col -->
  </div>
  <!-- info row -->
  <div class="row invoice-info">
    <div class="col-sm-4 invoice-col">
      From:
      <address>
        <strong>{{Auth::user()->firstname}} {{Auth::user()->middlename}} {{Auth::user()->lastname}} {{Auth::user()->suffix}}</strong><br>
        {{Auth::user()->street_address}}<br>
        {{$data['city']}}, {{$data['province']}}<br>
        {{Auth::user()->email}}<br>
        {{Auth::user()->mobileno}}
      </address>
    </div>
    <!-- /.col -->
    <div class="col-sm-4 invoice-col">
      To:
      <address>
        <strong>{{$data['bills_sub']}}</strong><br>
        {{$data['bills_main']}}<br>
      </address>
    </div>
    <!-- /.col -->
    <div class="col-sm-4 invoice-col">
      <b>Reference No.:</b> {{$request['refno']}}<br>
      <b>Payment Date:</b> {{date("m/d/Y")}}<br>
      <b>My Account No.:</b> {{Auth::user()->accountno}}
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  <!-- Table row -->
  <div class="row">
    <div class="col-xs-12 table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Type</th>
            <th>Reference No.</th>
            <th>Description</th>
            <th>Subtotal</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Online Payment</td>
            <td>{{$request['refno']}}</td>
            <td>{{$data['bills_sub']}} - {{$data['bills_main']}}</td>
            <td>Php {{number_format($request['amount'], 2)}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  <div class="row">
    <!-- accepted payments column -->
    <div class="col-xs-6">
      <p class="lead">Payment Methods:</p>
      <img src="../../dist/img/credit/visa.png" alt="Visa">
      <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
      <img src="../../dist/img/credit/american-express.png" alt="American Express">
      <img src="../../dist/img/credit/paypal2.png" alt="Paypal">
      <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
        Etc..
      </p>
    </div>
    <!-- /.col -->
    <div class="col-xs-6">
      <p class="lead">Amount Due {{date("m/d/Y")}}</p>
      <div class="table-responsive">
        <table class="table">
          <tr>
            <th style="width:50%">Subtotal:</th>
            <td>Php {{number_format($request['amount'], 2)}}</td>
          </tr>
          <tr>
            <th>Fee:</th>
            <td>Php 10.00</td>
          </tr>
          <tr>
            <th>Total:</th>
            <td>Php {{number_format(($request['amount'] + 10), 2)}}</td>
          </tr>
        </table>
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  <!-- this row will not appear when printing -->
  <div class="row no-print">
    <div class="col-xs-12">
      <button class="btn btn-success pull-right" type="button" data-toggle="modal" data-target="#modalDialog"><i class="fa fa-credit-card"></i> Submit Payment</button>
    </div>
  </div>
  <!-- Modal -->
  <!-- Modal -->
<div id="modalDialog" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Confirmation</h4>
      </div>
      <div class="modal-body box-body">
        <p>Are you sure you want to continue?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
        <button name="submit" class="btn btn-success">Yes</button>
      </div>
    </div>
  </div>
</div>
{!! Form::close() !!}
</section>

<div class="clearfix"></div>
<!-- /.content -->
@stop
@section('scripts')
<script>
</script>
@stop