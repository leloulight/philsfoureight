@extends('layouts.default')

@section('title')
	Genealogy
@stop

@section('styles')
@stop


@section('content')
<section class="content-header">
  <h1>
    Genealogy
  </h1>
  <ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Genealogy</a></li>
    <li class="active">View</li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Genealogy - {{$name}}</h3>
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
          <table class="table">
            <!-- <tr><td colspan="8" valign="top" align="center">&nbsp;</td></tr> -->
            <tr>
              <td colspan="8" valign="top" align="center">
                @if (count($data_one) == 1)
                  <div id="divMain" class="genealogy small-box {{$data_one[0]->status == 1 ? 'bg-green' : 'bg-red'}}" style="width: 180px; height: 70px;">
                    <a href="/mynetwork/genealogy/{{$data_one[0]->id}}" style="color: White;"><b>{{$data_one[0]->name}}</b></a><br />
                    {{$data_one[0]->created_at}}<br />
                    <span class="badge {{$data_one[0]->span}}">{{$data_one[0]->type}}</span>
                  </div>
                @else
                  <div id="divMain" class="genealogy small-box bg-gray" style="width: 180px; height: 70px;">
                  </div>
                @endif
                <!-- <span class="badge bg-blue">LEFT</span> -->
                <img src="{{asset('dist/img/gen_1.png')}}">
                <!-- <span class="badge bg-red">RIGHT</span> -->
              </td>
            </tr>
            <tr>
              <td colspan="4" valign="top" align="center">
                @if (count($data_one) == 1)
                  @if($data_one[0]->binary_left_name != NULL)
                    <div id="divMain" class="genealogy small-box {{$data_one[0]->binary_left_status == 1 ? 'bg-green' : 'bg-red'}}" style="width: 180px; height: 70px;">
                      <a href="/mynetwork/genealogy/{{$data_one[0]->binary_left_id}}" style="color: White;"><b>{{$data_one[0]->binary_left_name}}</b></a><br />
                      {{$data_one[0]->binary_left_created}}<br />
                      <span class="badge {{$data_one[0]->binary_left_span}}">{{$data_one[0]->binary_left_type}}</span>
                    </div>
                  @else
                    <div id="divMain" class="genealogy small-box bg-gray" style="width: 180px; height: 70px;">
                    </div>
                  @endif
                @else
                  <div id="divMain" class="genealogy small-box bg-gray" style="width: 180px; height: 70px;">
                  </div>
                @endif
                <!-- <span class="badge bg-blue">LEFT</span> -->
                <img src="{{asset('dist/img/gen_2.png')}}">
                <!-- <span class="badge bg-red">RIGHT</span> -->
              </td>
              <td colspan="4" valign="top" align="center">
                @if (count($data_one) == 1)
                  @if($data_one[0]->binary_right_name != NULL)
                    <div id="divMain" class="genealogy small-box {{$data_one[0]->binary_right_status == 1 ? 'bg-green' : 'bg-red'}}" style="width: 180px; height: 70px;">
                      <a href="/mynetwork/genealogy/{{$data_one[0]->binary_right_id}}" style="color: White;"><b>{{$data_one[0]->binary_right_name}}</b></a><br />
                      {{$data_one[0]->binary_right_created}}<br />
                      <span class="badge {{$data_one[0]->binary_right_span}}">{{$data_one[0]->binary_right_type}}</span>
                    </div>
                  @else
                    <div id="divMain" class="genealogy small-box bg-gray" style="width: 180px; height: 70px;">
                    </div>
                  @endif
                @else
                  <div id="divMain" class="genealogy small-box bg-gray" style="width: 180px; height: 70px;">
                  </div>
                @endif
                <!-- <span class="badge bg-blue">LEFT</span> -->
                <img src="{{asset('dist/img/gen_2.png')}}">
                <!-- <span class="badge bg-red">RIGHT</span> -->
              </td>
            </tr>
            <tr>
              <td colspan="2" valign="top" align="center">
                @if (count($data_two) == 1)
                  @if($data_two[0]->binary_left_name != NULL)
                    <div id="divMain" class="genealogy small-box {{$data_two[0]->binary_left_status == 1 ? 'bg-green' : 'bg-red'}}" style="width: 180px; height: 70px;">
                      <a href="/mynetwork/genealogy/{{$data_two[0]->binary_left_id}}" style="color: White;"><b>{{$data_two[0]->binary_left_name}}</b></a><br />
                      {{$data_two[0]->binary_left_created}}<br />
                      <span class="badge {{$data_two[0]->binary_left_span}}">{{$data_two[0]->binary_left_type}}</span>
                    </div>
                  @else
                    <div id="divMain" class="genealogy small-box bg-gray" style="width: 180px; height: 70px;">
                    </div>
                  @endif
                @else
                  <div id="divMain" class="genealogy small-box bg-gray" style="width: 180px; height: 70px;">
                  </div>
                @endif
                <!-- <span class="badge bg-blue">LEFT</span> -->
                <img src="{{asset('dist/img/gen_3.png')}}">
                <!-- <span class="badge bg-red">RIGHT</span> -->
              </td>
              <td colspan="2" valign="top" align="center">
                @if (count($data_two) == 1)
                  @if($data_two[0]->binary_right_name != NULL)
                    <div id="divMain" class="genealogy small-box {{$data_two[0]->binary_right_status == 1 ? 'bg-green' : 'bg-red'}}" style="width: 180px; height: 70px;">
                      <a href="/mynetwork/genealogy/{{$data_two[0]->binary_right_id}}" style="color: White;"><b>{{$data_two[0]->binary_right_name}}</b></a><br />
                      {{$data_two[0]->binary_right_created}}<br />
                      <span class="badge {{$data_two[0]->binary_right_span}}">{{$data_two[0]->binary_right_type}}</span>
                    </div>
                  @else
                    <div id="divMain" class="genealogy small-box bg-gray" style="width: 180px; height: 70px;">
                    </div>
                  @endif
                @else
                  <div id="divMain" class="genealogy small-box bg-gray" style="width: 180px; height: 70px;">
                  </div>
                @endif
                <!-- <span class="badge bg-blue">LEFT</span> -->
                <img src="{{asset('dist/img/gen_3.png')}}">
                <!-- <span class="badge bg-red">RIGHT</span> -->
              </td>
              <td colspan="2" valign="top" align="center">
                @if (count($data_three) == 1)
                  @if($data_three[0]->binary_left_name != NULL)
                    <div id="divMain" class="genealogy small-box {{$data_three[0]->binary_left_status == 1 ? 'bg-green' : 'bg-red'}}" style="width: 180px; height: 70px;">
                      <a href="/mynetwork/genealogy/{{$data_three[0]->binary_left_id}}" style="color: White;"><b>{{$data_three[0]->binary_left_name}}</b></a><br />
                      {{$data_three[0]->binary_left_created}}<br />
                      <span class="badge {{$data_three[0]->binary_left_span}}">{{$data_three[0]->binary_left_type}}</span>
                    </div>
                  @else
                    <div id="divMain" class="genealogy small-box bg-gray" style="width: 180px; height: 70px;">
                    </div>
                  @endif
                @else
                  <div id="divMain" class="genealogy small-box bg-gray" style="width: 180px; height: 70px;">
                  </div>
                @endif
                <!-- <span class="badge bg-blue">LEFT</span> -->
                <img src="{{asset('dist/img/gen_3.png')}}">
                <!-- <span class="badge bg-red">RIGHT</span> -->
              </td>
              <td colspan="2" valign="top" align="center">
                @if (count($data_three) == 1)
                  @if($data_three[0]->binary_right_name != NULL)
                    <div id="divMain" class="genealogy small-box {{$data_three[0]->binary_right_status == 1 ? 'bg-green' : 'bg-red'}}" style="width: 180px; height: 70px;">
                      <a href="/mynetwork/genealogy/{{$data_three[0]->binary_right_id}}" style="color: White;"><b>{{$data_three[0]->binary_right_name}}</b></a><br />
                      {{$data_three[0]->binary_right_created}}<br />
                      <span class="badge {{$data_three[0]->binary_right_span}}">{{$data_three[0]->binary_right_type}}</span>
                    </div>
                  @else
                    <div id="divMain" class="genealogy small-box bg-gray" style="width: 180px; height: 70px;">
                    </div>
                  @endif
                @else
                  <div id="divMain" class="genealogy small-box bg-gray" style="width: 180px; height: 70px;">
                  </div>
                @endif
                <!-- <span class="badge bg-blue">LEFT</span> -->
                <img src="{{asset('dist/img/gen_3.png')}}">
                <!-- <span class="badge bg-red">RIGHT</span> -->
              </td>
            </tr>

            <tr>
              <td valign="top" align="center">
                @if (count($data_four) == 1)
                  @if($data_four[0]->binary_left_name != NULL)
                    <div id="divMain" class="genealogy small-box {{$data_four[0]->binary_left_status == 1 ? 'bg-green' : 'bg-red'}}" style="width: 120px; height: 70px;">
                      <a href="/mynetwork/genealogy/{{$data_four[0]->binary_left_id}}" style="color: White;"><b>{{$data_four[0]->binary_left_name}}</b></a><br />
                      {{$data_four[0]->binary_left_created}}<br />
                      <span class="badge {{$data_four[0]->binary_left_span}}">{{$data_four[0]->binary_left_type}}</span>
                    </div>
                  @else
                    <div id="divMain" class="genealogy small-box bg-gray" style="width: 120px; height: 70px;">
                    </div>
                  @endif
                @else
                  <div id="divMain" class="genealogy small-box bg-gray" style="width: 120px; height: 70px;">
                  </div>
                @endif
              </td>
              <td valign="top" align="center">
                @if (count($data_four) == 1)
                  @if($data_four[0]->binary_right_name != NULL)
                    <div id="divMain" class="genealogy small-box {{$data_four[0]->binary_right_status == 1 ? 'bg-green' : 'bg-red'}}" style="width: 120px; height: 70px;">
                      <a href="/mynetwork/genealogy/{{$data_four[0]->binary_right_id}}" style="color: White;"><b>{{$data_four[0]->binary_right_name}}</b></a><br />
                      {{$data_four[0]->binary_right_created}}<br />
                      <span class="badge {{$data_four[0]->binary_right_span}}">{{$data_four[0]->binary_right_type}}</span>
                    </div>
                  @else
                    <div id="divMain" class="genealogy small-box bg-gray" style="width: 120px; height: 70px;">
                    </div>
                  @endif
                @else
                  <div id="divMain" class="genealogy small-box bg-gray" style="width: 120px; height: 70px;">
                  </div>
                @endif
              </td>
              <td valign="top" align="center">
                @if (count($data_five) == 1)
                  @if($data_five[0]->binary_left_name != NULL)
                    <div id="divMain" class="genealogy small-box {{$data_five[0]->binary_left_status == 1 ? 'bg-green' : 'bg-red'}}" style="width: 120px; height: 70px;">
                      <a href="/mynetwork/genealogy/{{$data_five[0]->binary_left_id}}" style="color: White;"><b>{{$data_five[0]->binary_left_name}}</b></a><br />
                      {{$data_five[0]->binary_left_created}}<br />
                      <span class="badge {{$data_five[0]->binary_left_span}}">{{$data_five[0]->binary_left_type}}</span>
                    </div>
                  @else
                    <div id="divMain" class="genealogy small-box bg-gray" style="width: 120px; height: 70px;">
                    </div>
                  @endif
                @else
                  <div id="divMain" class="genealogy small-box bg-gray" style="width: 120px; height: 70px;">
                  </div>
                @endif
              </td>
              <td valign="top" align="center">
                @if (count($data_five) == 1)
                  @if($data_five[0]->binary_right_name != NULL)
                    <div id="divMain" class="genealogy small-box {{$data_five[0]->binary_right_status == 1 ? 'bg-green' : 'bg-red'}}" style="width: 120px; height: 70px;">
                      <a href="/mynetwork/genealogy/{{$data_five[0]->binary_right_id}}" style="color: White;"><b>{{$data_five[0]->binary_right_name}}</b></a><br />
                      {{$data_five[0]->binary_right_created}}<br />
                      <span class="badge {{$data_five[0]->binary_right_span}}">{{$data_five[0]->binary_right_type}}</span>
                    </div>
                  @else
                    <div id="divMain" class="genealogy small-box bg-gray" style="width: 120px; height: 70px;">
                    </div>
                  @endif
                @else
                  <div id="divMain" class="genealogy small-box bg-gray" style="width: 120px; height: 70px;">
                  </div>
                @endif
              </td>
              <td valign="top" align="center">
                @if (count($data_six) == 1)
                  @if($data_six[0]->binary_left_name != NULL)
                    <div id="divMain" class="genealogy small-box {{$data_six[0]->binary_left_status == 1 ? 'bg-green' : 'bg-red'}}" style="width: 120px; height: 70px;">
                      <a href="/mynetwork/genealogy/{{$data_six[0]->binary_left_id}}" style="color: White;"><b>{{$data_six[0]->binary_left_name}}</b></a><br />
                      {{$data_six[0]->binary_left_created}}<br />
                      <span class="badge {{$data_six[0]->binary_left_span}}">{{$data_six[0]->binary_left_type}}</span>
                    </div>
                  @else
                    <div id="divMain" class="genealogy small-box bg-gray" style="width: 120px; height: 70px;">
                    </div>
                  @endif
                @else
                  <div id="divMain" class="genealogy small-box bg-gray" style="width: 120px; height: 70px;">
                  </div>
                @endif
              </td>
              <td valign="top" align="center">
                @if (count($data_six) == 1)
                  @if($data_six[0]->binary_right_name != NULL)
                    <div id="divMain" class="genealogy small-box {{$data_six[0]->binary_right_status == 1 ? 'bg-green' : 'bg-red'}}" style="width: 120px; height: 70px;">
                      <a href="/mynetwork/genealogy/{{$data_six[0]->binary_right_id}}" style="color: White;"><b>{{$data_six[0]->binary_right_name}}</b></a><br />
                      {{$data_six[0]->binary_right_created}}<br />
                      <span class="badge {{$data_six[0]->binary_right_span}}">{{$data_six[0]->binary_right_type}}</span>
                    </div>
                  @else
                    <div id="divMain" class="genealogy small-box bg-gray" style="width: 120px; height: 70px;">
                    </div>
                  @endif
                @else
                  <div id="divMain" class="genealogy small-box bg-gray" style="width: 120px; height: 70px;">
                  </div>
                @endif
              </td>
              <td valign="top" align="center">
                @if (count($data_seven) == 1)
                  @if($data_seven[0]->binary_left_name != NULL)
                    <div id="divMain" class="genealogy small-box {{$data_seven[0]->binary_left_status == 1 ? 'bg-green' : 'bg-red'}}" style="width: 120px; height: 70px;">
                      <a href="/mynetwork/genealogy/{{$data_seven[0]->binary_left_id}}" style="color: White;"><b>{{$data_seven[0]->binary_left_name}}</b></a><br />
                      {{$data_seven[0]->binary_left_created}}<br />
                      <span class="badge {{$data_seven[0]->binary_left_span}}">{{$data_seven[0]->binary_left_type}}</span>
                    </div>
                  @else
                    <div id="divMain" class="genealogy small-box bg-gray" style="width: 120px; height: 70px;">
                    </div>
                  @endif
                @else
                  <div id="divMain" class="genealogy small-box bg-gray" style="width: 120px; height: 70px;">
                  </div>
                @endif
              </td>
              <td valign="top" align="center">
                @if (count($data_seven) == 1)
                  @if($data_seven[0]->binary_right_name != NULL)
                    <div id="divMain" class="genealogy small-box {{$data_seven[0]->binary_right_status == 1 ? 'bg-green' : 'bg-red'}}" style="width: 120px; height: 70px;">
                      <a href="/mynetwork/genealogy/{{$data_seven[0]->binary_right_id}}" style="color: White;"><b>{{$data_seven[0]->binary_right_name}}</b></a><br />
                      {{$data_seven[0]->binary_right_created}}<br />
                      <span class="badge {{$data_seven[0]->binary_right_span}}">{{$data_seven[0]->binary_right_type}}</span>
                    </div>
                  @else
                    <div id="divMain" class="genealogy small-box bg-gray" style="width: 120px; height: 70px;">
                    </div>
                  @endif
                @else
                  <div id="divMain" class="genealogy small-box bg-gray" style="width: 120px; height: 70px;">
                  </div>
                @endif
              </td>
            </tr>
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