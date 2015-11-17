@extends('layouts.default')
@section('title')
Dashboard
@stop
@section('styles')
@stop

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Dashboard
    <small>Control Panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Home</li>
    <li class="active">Dashboard</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <!-- Your Page Content Here -->
<button onclick="myFunction()">Click me</button>
<div id="googleMap" style="width:500px;height:380px;"></div>
</section>
<!-- /.content -->
@stop
@section('scripts')
<script src="http://maps.googleapis.com/maps/api/js"></script>
<script>
var lat = 14.2990183;
var lng = 120.9589699;
var myCenter=new google.maps.LatLng(lat, lng);
var mapProp = {
	  center:myCenter,
	  zoom:15,
	  mapTypeId:google.maps.MapTypeId.ROADMAP
	  };

	var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

function initialize()
{
	
	for (var i = 0; i < 10; i++) {
		var new_lat = lat + randomLat();
		var new_long = lng + randomLong();
		// alert(new_lat);
		var myCenter2=new google.maps.LatLng(new_lat, new_long);
		var marker=new google.maps.Marker({
		  position:myCenter2,
		  title:'Click to zoom'
		  });

		google.maps.event.addListener(marker,'click',function() {
		  map.setZoom(15);
		  map.setCenter(marker.getPosition());
		  });
		marker.setMap(map);
	};

	
// var marker=new google.maps.Marker({
//   position:myCenter2,
//   title:'Click to zoom'
//   });
// marker.setMap(map);

// google.maps.event.addListener(marker,'click',function() {
//   map.setZoom(15);
//   map.setCenter(marker.getPosition());
//   });
}
function randomLat() {
	var i = parseFloat((Math.random() * (0.005 - 0.000001) + 0.000001).toFixed(6));
	// alert(i);
	var i = Math.random() < 0.5 ? i * -1 : i * 1;
	return i;
}

function randomLong() {
	var i = parseFloat((Math.random() * (0.005 - 0.000001) + 0.000001).toFixed(6));
	// alert(i);
	var i = Math.random() < 0.5 ? i * -1 : i * 1;
	return i;
}

google.maps.event.addDomListener(window, 'load', initialize);

function myFunction () {
	var new_lat = lat + randomLat();
		var new_long = lng + randomLong();
	var myCenter2=new google.maps.LatLng(new_lat, new_long);
		var marker=new google.maps.Marker({
		  position:myCenter2,
		  animation:google.maps.Animation.BOUNCE,
		  title:'Click to zoom'
		  });

		google.maps.event.addListener(marker,'click',function() {
		  map.setZoom(15);
		  map.setCenter(marker.getPosition());
		  });
		marker.setMap(map);
}
</script>
@stop
