@extends('layouts.default')

@section('title')
	Account No. Summary
@stop

@section('styles')
@stop


@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Account No. Summary
    <small>Account No.</small>
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Account No.</li>
    <li class="active">Summary</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <!-- Your Page Content Here -->
  <div class="row">
    <div class="col-md-3">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Stockist Id</h3>
        </div><!-- /.box-header -->
        <div class="box-body" style="display: block;">
          <div class="form-group">
            <select class="form-control" name="stockist_list" id="stockist_list">
              @foreach($stockist_list as $row)
                <option value="{{$row->id}}" {{$id == $row->id ? 'selected' : ''}}>{{$row->lastname}}, {{$row->firstname}}</option>
              @endforeach
            </select>
          </div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div>
    <div class="col-md-3">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">No. of Cards</h3>
        </div><!-- /.box-header -->
        <div class="box-body" style="display: block;">
          {{$summary_widget[0]->total_cards}}
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div>
    <div class="col-md-3">
      <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Used Cards</h3>
        </div><!-- /.box-header -->
        <div class="box-body" style="display: block;">
          {{$summary_widget[0]->total_used}}
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div>
    <div class="col-md-3">
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Unused Cards</h3>
        </div><!-- /.box-header -->
        <div class="box-body" style="display: block;">
          {{$summary_widget[0]->total_unused}}
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Account <No class=""></No></h3>
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
              <th>Account No.</th>
              <th>Member</th>
              <th>Updated At</th>
              <th></th>
            </tr>
            @foreach($summary_list as $row)
            <tr>
              <td>{{$row->row_num}}</td>
              <td><span class="badge {{$row->name == NULL ? 'bg-red' : 'bg-blue'}}">{{$row->accountno}}</span></td>
              <td>{{$row->name}}</td>
              <td>{{$row->updated_at}}</td>
              <td></td>
            </tr>
            @endforeach
          </table>
        </div><!-- /.box-body -->
        <div class="box-footer clearfix">
        {!!$summary_list->render()!!}
        </div>
      </div><!-- /.box -->
    </div>
  </div>
</section><!-- /.content -->
@stop

@section('scripts')
<script>
$(function () {
  $(".content").on('change', '#stockist_list', function() {
    var dd = this;
    window.location = "/settings/accountno/summary/" + dd.value;
  });
});
</script>
@stop