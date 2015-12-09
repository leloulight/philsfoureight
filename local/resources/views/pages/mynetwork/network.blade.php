@extends('layouts.default')

@section('title')
	Genealogy
@stop

@section('styles')
@stop


@section('content')
<section class="content-header">
  <h1>
    Network List
  </h1>
  <ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Network List</li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-xs-6">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Unilevel</h3>
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
              <th>Level</th>
              <th>Total</th>
              <th>Active</th>
            </tr>
            @foreach($network as $row)
              <tr>
                <td>Level {{$row['level']}}</td>
                <td>{{$row['total']}}</td>
                <td>{{$row['active']}}</td>
              </tr>
            @endforeach
          </table>
        </div><!-- /.box-body -->
        <div class="box-footer clearfix">
        </div>
      </div><!-- /.box -->
    </div>
  </div>
</section><!-- /.content -->
@stop

@section('scripts')
@stop