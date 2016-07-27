@extends('welcome')

@section('css')
<link rel="stylesheet" type="text/css" href="/assets/css/jquery.fullPage.css" />
<link rel="stylesheet" type="text/css" href="/assets/css/examples.css" />
<style type="text/css">
	#Result{border:3px solid #40AA53;margin:0 auto;text-align:center;width:600px;padding:150px 0;background:#efe;}
	#ResultNum{font-size:20pt;font-family:Verdana}
	#map{border:3px solid #40AA53;margin:0 auto;text-align:center;width:600px;padding:150px 0;background:#efe;}
</style>
@endsection

@section('js')
<script type="text/javascript" src="/assets/js/jquery.fullPage.js"></script>
<script type="text/javascript"></script>
<script type="text/javascript">
		$(document).ready(function() {
			$('#fullpage').fullpage({
				sectionsColor: ['#1bbc9b', '#4BBFC3', '#7BAABE', 'whitesmoke', '#ccddff'],
				anchors: ['firstPage', 'secondPage', '3rdPage', '4thpage', 'lastPage'],
				menu: '#menu',
				easingcss3: 'cubic-bezier(0.175, 0.885, 0.320, 1.275)'
			});

		});
</script>

@endsection

@section('content')


<div id="fullpage">
	<div class="section " id="section0">
		<h1>抽奖结果</h1>

		<div id="Result" >
			<span id="ResultNum"></span>
		</div>

		<div id="Button">
			<input class="btn btn-warning" type='button' id="btn" value='开始' onclick='beginRndNum(this)'/>
		</div>
		
		
	</div>
	<div class="section" id="section1">
		<h1>餐廳位置</h1>
		<div class="intro">
			<div id="map"></div>
			<a class="btn btn-success" href="#firstPage">重新抽獎</a>
			<a class="btn btn-danger" href="#3rdPage">瓜s</a>
		</div>
	</div>
	<div class="section" id="section2">
		<div class="intro">
			<h1>How To GO</h1>
			<div id="map_canvas" style="float:left;width:70%;height:100%"></div>
			<div style="float:right;width:30%;height:100%;overflow:auto"> 
  				<div id="directions_panel" style="width:100%"></div>
			</div>
		</div>
	</div>
</div>

<!-- <script src="//maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyCRFqcFXc2EZ3-XA1KIolCamLKl5xOSSLk" async="" defer="defer" type="text/javascript"></script> -->

<script type="text/javascript">
	
		var g_Interval = 1;
		var g_PersonCount = {!!count($map)!!};
		var map_name = {!!$map!!};
		var g_Timer;
		var running = false;
		var lat , lng;

		var geo = window.navigator.geolocation;
		geo.getCurrentPosition(succCallback);
		function succCallback(a){
			var lati  = a.coords.latitude;
			var longi = a.coords.longitude;
			initMap(lati , longi);
		}
		

		function beginRndNum(trigger){
			if(running){
				running = false;
				clearTimeout(g_Timer);		
				$(trigger).val("开始");
				$('#ResultNum').css('color','red');
			}
			else{
				running = true;
				$('#ResultNum').css('color','black');
				$(trigger).val("停止");
				beginTimer();
			}
		}

		function updateRndNum(){
			var num = Math.floor(Math.random()*g_PersonCount);
			var name = map_name[num].title;
			lat  = map_name[num].lat;
			lng  = map_name[num].lng;
			$('#ResultNum').html(name);
			initMap(lat ,lng );
		}

		function beginTimer(){
			g_Timer = setTimeout(beat, g_Interval);
		}

		function beat() {
			g_Timer = setTimeout(beat, g_Interval);
			updateRndNum();
		}
		function initMap(lat , lng) {
		  var myLatLng = {lat, lng};
		  var map = new google.maps.Map(document.getElementById('map'), {
		    zoom: 17,
		    center: myLatLng
		  });
		  var marker = new google.maps.Marker({
		    position: myLatLng,
		    map: map,
		  });
		}
  
 
</script>
<script src="https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyCRFqcFXc2EZ3-XA1KIolCamLKl5xOSSLk&signed_in=true&callback=initMap"
        async defer></script>

@endsection