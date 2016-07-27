<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
  var directionsDisplay;
  var directionsService = new google.maps.DirectionsService();
  var map;
  var oldDirections = [];
  var currentDirections = null;

  function initialize2(pFrom,pEnd) {
    var myOptions = {
      zoom: 13,      
	  center: new google.maps.LatLng(24.98367,121.453586),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

    directionsDisplay = new google.maps.DirectionsRenderer({
        'map': map,
        'preserveViewport': true,
        'draggable': true
    });	
	
    directionsDisplay.setPanel(document.getElementById("directions_panel"));

    google.maps.event.addListener(directionsDisplay, 'directions_changed',
      function() {
        if (currentDirections) {
          oldDirections.push(currentDirections);          
        }
        currentDirections = directionsDisplay.getDirections();
      });
    
	
    calcRoute2(pFrom,pEnd);
	
  }
  
  function calcRoute2(pFrom,pEnd) {
    
	var start = pFrom;
	var end = pEnd;
	console.log(start);
	console.log(end);
    var request = {
        origin:start,		//起始地
        destination:end,	//目的地
        travelMode: google.maps.DirectionsTravelMode.DRIVING //旅行工具 WALKING | DRIVING
    };
    directionsService.route(request, function(response, status) {
      if (status == google.maps.DirectionsStatus.OK) {
        directionsDisplay.setDirections(response);
		//alert(directionsDisplay.getDirections().routes[0].legs[0].start_address);//起點地點：330台灣桃園縣桃園市興華路23號
		//alert(directionsDisplay.getDirections().routes[0].legs[0].end_address);		//alert(directionsDisplay.getDirections().routes[0].legs[0].distance.text);//24.8公里
		//alert(directionsDisplay.getDirections().routes[0].legs[0].duration.text);//31分鐘
		//alert(directionsDisplay.getDirections().routes[0].copyrights);//地圖資料 2011 Kingway
		//alert(directionsDisplay.getDirections().routes[0].legs[0].steps[0].instructions);//朝<b>西北</b>，走<b>興華路</b>，往<b>大智路</b>前進
		//alert(directionsDisplay.getDirections().routes[0].legs[0].steps[0].distance.text);//0.3公里
		
      }
    });
		
  }
  
 
</script>
</head>
<body>
測試路徑規劃</br>
起始<input type="text" id="txtFrom" style="width:300px;"></input></br>
目的<input type="text" id="txtEnd" style="width:300px;"></input></br>
  <button id="btnSubmit" onclick="initialize2(txtFrom.value,txtEnd.value)">送出</button>
<div id="map_canvas" style="float:left;width:70%;height:100%"></div>
<div style="float:right;width:30%;height:100%;overflow:auto"> 
  
  <div id="directions_panel" style="width:100%"></div>
</div>

</body>
</html>