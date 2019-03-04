<html>
  <head>

    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>

    <link rel="stylesheet" type="text/css" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <!--<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
    integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
    crossorigin=""/>
<!--
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
    integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
    crossorigin=""></script>
-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet" href= "./extra_css/visualise_php.css">

		<link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
			integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
			crossorigin=""/>
		<script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
			integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
			crossorigin=""></script>

		<script src="https://unpkg.com/geojson-vt@3.2.0/geojson-vt.js"></script>
  </head>	



  <script>

  var gVars={} // Global Varaibels
  
    var a = {};
      a["4317218322204134"] = "AirParif1";
      a["35669077111271345"] = "AirParif10";
	  a["3566907742371345"] = "AirParif11";
	  a["3566907722371345"] = "AirParif12";
	  a["35669077252071345"] = "AirParif13";
	  a["35669077121271345"] = "AirParif14";
	  a["35669077192371345"] = "AirParif15";
	  a["35669077143371345"] = "AirParif16";
	  a["35669077272271345"] = "AirParif17";
	  a["43152552141141345"] = "AirParif2";
	  a["4315255293441345"] = "AirParif3";
	  a["3566907703071345"] = "AirParif4";
	  a["35669077103071345"] = "AirParif5";
	  a["35669077133271345"] = "AirParif6";
	  a["4316701852319345"] = "AirParif7";
	  a["3566907763371345"] = "AirParif8";
	  a["35669077213271345"] = "AirParif9";


  function getData(){
    $.ajax({
            type: "GET",
            url: "query-data.php",
            data: {
              DateStart: moment($("#dateTimePicker").val().split(" - ")[0],"DD/MM/YYYY hh:mm").format("YYYY-MM-DD hh:mm"),
              DateEnd: moment($("#dateTimePicker").val().split(" - ")[1],"DD/MM/YYYY hh:mm").format("YYYY-MM-DD hh:mm"),
              NodeID: $("#sensorSelect").val()
            },
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function OnPopulateControl(response) {

                gVars.currentData = response;
				alert(JSON.stringify(gVars.currentData))//.getItem('GeoJSON'));
                 console.log(response);
                refreshMap();
                refreshChart();
            },
            error: function(xhr, status, error) {
              alert(status);
              // var err = JSON.parse(xhr.responseText);
            }
        });
  }

  function initMap(){
    var sensorsMap = L.map('mapid').setView([48.864716, 2.349014], 11);

    sensorsMap.addLayer(L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
      }) );
      return sensorsMap;
  }

  function initDateTimePicker(){
    $('#dateTimePicker').daterangepicker({
      "timePicker": true,
      "locale": {"format": 'DD/MM/YYYY hh:mm'},
      "timePicker24Hour": true,
      "startDate": moment().subtract(1, 'days'),
      "endDate": moment()
    }, function(start, end, label) {});
  }
  
   function getSmallId(value){
   
      return a[value];
	  
   }
  function getActiveNodes(){
    $.ajax({
            type: "GET",
            url: "nodes.php",
            data: "",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function OnPopulateControl(response) {
                sensorsIDList= response['node_id']
                // console.log(sensorsIDList);
                if (sensorsIDList.length > 0) {
                    $.each(sensorsIDList, function (key,value) {
                      // console.log(value);
                      $("#sensorSelect").append('<option value=' + value + '>' + getSmallId(value) + '</option>');
                      // console.log( $("#sensorSelect").html() )
                    });
                }
                else {
                    $("sensorSelect").empty().append('<option selected="selected" value="0">No Active Sensors<option>');
                }
            },
            error: function () {
                alert("Error");
            }
        });
  }

  function refreshMap(){
    if(gVars.currentData!=""){

      GeoJSON = gVars.currentData.map(getGeoJSON);//(gVars.currentData));

			//console.log(gVars.currentData.map(getGeoJSON));
			//alert(JSON.stringify(GeoJSON));
      var geojsonMarkerOptions = {
          radius: 2,
          fillColor: "#AF0000",
          color: "#AF0000",
          weight: 1,
          opacity: 1,
          fillOpacity: 0.5
      };

			//console.log(GeoJSON);
      var PointsLayer = L.geoJSON(GeoJSON, {
          pointToLayer: function (feature, latlng) {
              return L.circleMarker(latlng, geojsonMarkerOptions);
          }
      }).addTo(map);

      gVars.sensorsMap.addLayer(PointsLayer);
			//PointsLayer.addTo(map);
    } else { alert("No Data Available")}
  }

  function refreshChart(){

    gVars.chartConfig.data.datasets = [];

    attributeToView = $("#attributeSelect").val()

    var filteredData = gVars.currentData.map(getNodeIdTimestampAttribute(attributeToView))

    var groupedByNodeId = _.mapValues(
      _.groupBy(filteredData, function(tupple){return tupple['node_id']} ),
      clist => clist.map( tupple => _.omit(tupple, 'node_id') )
    );

    gVars.chartConfig.options.title.text= attributeToView + " Data"

    Object.keys(groupedByNodeId).forEach(function(sensorId){
      var colorName = gVars.colorNames[gVars.chartConfig.data.datasets.length % gVars.colorNames.length];
      var newColor = gVars.chartColors[colorName];
      dataset = {
          label: getSmallId(sensorId),
          fill: false,
          data: groupedByNodeId[sensorId],
          backgroundColor: newColor,
          borderColor: newColor,
          pointBorderWidth: 0,
          tension: 0
        };
        gVars.chartConfig.data.datasets.push(dataset);
      });

    gVars.chart.update();

    console.log(groupedByNodeId);

  }

  function getGeoJSON(tupple){
		//console.log(JSON.parse(tupple['GeoJSON']));
    return JSON.parse(tupple['GeoJSON']);
  }

  function getNodeIdTimestampAttribute(attribute){ //TODO check formaldehyde select value is the same as in data
    var mappingFunction = function(tupple){
       return { "node_id" : tupple['node_id'], "x" : tupple['timestamp'], "y" : tupple[attribute]};
     }
    return mappingFunction;
  }

  function initChart(){

    var ctx = document.getElementById("chartid").getContext('2d');

    var myChart = new Chart(ctx,gVars.chartConfig);

    return myChart;

  }
  

 

  $(document).ready(function(){

    gVars.host = "localhost";

    getActiveNodes();

    initDateTimePicker();

    gVars.SensorsData = "";
    gVars.sensorsMap = initMap();
    gVars.chartConfig = {
      type: 'scatter',
      data: '',
      options: {
        scales: {
          xAxes: [{
          type: 'time',
          distribution: 'linear',
          time: {
            unit: 'hour',
            unitStepSize: 1,
            displayFormats: {'day': 'MMM DD'}
          },
          ticks: {
                 autoSkip: true
             },
        }]
      },
        title: {
          display: true,
          text: 'Attribute Data'
        },
        elements: {
          point: {
            radius: 2,
            hitRadius: 7,
            hoverRadius: 4,
          }
        }
      }
    }

    gVars.chartColors = window.chartColors = {
      red: 'rgb(255, 99, 132)',
	    orange: 'rgb(255, 159, 64)',
	    yellow: 'rgb(255, 205, 86)',
      green: 'rgb(75, 192, 192)',
      blue: 'rgb(54, 162, 235)',
      purple: 'rgb(153, 102, 255)',
      grey: 'rgb(201, 203, 207)'
    };

    gVars.colorNames = Object.keys(gVars.chartColors);

    gVars.chart = initChart();


  });

  </script>


 <body>		
		    
    <!-- Header -->

    <header id="header">

      <a class="logo" href="index.php">Polluscope</a>

      <nav>
        <a href="#menu">Menu</a>
      </nav>

    </header>
    <!-- Nav -->


    <nav id="menu">

      <ul class="links">

        <b>Acquisition</b>

        <li><a href="get-flaten-data.php">Access and Filter </a></li>
        <li><a href="visualise-R.php">Filter and Visualise </a></li>
        <li><a href="visualise.php">Filter and Visualise V2 </a></li>
        <li><a href="upload-AE51.php">Upload AE51&Update canarin</a></li>	
        <li><a href="upload-cairsens.php">Upload Cairs&Update canarin</a></li>
        <li><a href="link-canarin-cairsens.php">Link Canarin-Cairsens</a></li>
        <li><a href="link-canarin-AE51.php">Link Canarin-AE51</a></li>

        <b>QUALIFICATION</b>

        <li><a href="upload-AE51-for-qualification.php">Upload AE51</a></li>	
        <li><a href="upload-cairsens-for-qualification.php">Upload Cairsens</a></li>
        <li><a href="upload-teom.php">Upload TEOM</a></li>	
        <li><a href="upload-fidas.php">Upload FIDAS</a></li>	
        <li><a href="upload-actris.php">Upload ACTRIS</a></li>
        <li><a href="upload-aethalometer.php">Upload AETHALOMETER</a></li>
        <li><a href="canarin-teom.php">Link Canarin-TEOM</a></li>
        <li><a href="canarin-fidas.php">Link Canarin-FIDAS</a></li>
        <li><a href="cairsens-actris.php">Link cairsens-ACTRIS</a></li>
        <li><a href="AE51-aethalometer.php">Link AE51-AETHALOMETER</a></li>

      </ul>

    </nav>

  
    <div class="container">
      <div class="row">

        <div class="col-lg-3">

          <div class="card">
            <div class="card-body ">
              <h3 class="card-header text-white bg-info mb-3">Filters</h3>
                        <form>
                              <div class="form-group">
                                <label for="sensorSelect">Choose the Required Sensor</label>
                                <select class="custom-select" id="sensorSelect" multiple="multiple">
                              </select>
                              </div>

                              <div class="form-group">
                                <label for="dateTimePicker">Choose the Required Time Interval</label>
                                    <input type="text" id="dateTimePicker" class="form-control" value=""/>
                              </div>
								<!--<strong><font color=#e60000>Start</strong> <br>
								Date : <input type=date  name='start' value=$start > <br>
								Hour : <input type=number name='hourStart' value=$hourStart  min=0 max=23 > <br><br></font>
								
								<strong><font color=#e60000>End</strong> <br>
								Date : <input type=date name='end' value=$end style='margin-left: 5px' > <br> 
								Hour : <input type=number name='hourEnd' value=$hourEnd min=0 max=23 style='margin-left: 5px' ><br><br></font>-->

                              <div class="form-group">
                                <label for="attributeSelect">Choose Attribute</label>
                                <select class="custom-select" id="attributeSelect">
                                  <option value="temperature">temperature</option>
                                  <option value="pressure">Pressure</option>
                                  <option value="pm2.5">PM 2.5</option>
                                  <option value="pm10">PM 10</option>
                                  <option value="pm1.0">PM 1.0</option>
                                  <option value="formaldehyde">Formal Dehyde</option>
                                  <option value="no2">NO2</option>
                              </select>
                              </div>
                              <input type="button" id="submit" onclick="getData()" value="Refresh" class="btn btn-primary"/><br><br>
							  
                            </form>
						
							
            </div>
			<div class="card-body ">
              <h3 class="card-header text-white bg-info mb-3"><a href="index.php">Main page</a></h3>
             </div>
          </div>

        </div>

        <div class="col-lg-9">

          <div class="card">
            <div class="card-body ">
              <h3 class="card-header text-white bg-info mb-3">Sensor Location Map</h3>
              <div id="mapid" style="height: 560px;"></div>
            </div>
          </div>

          <div class="card">
            <div class="card-body">
              <h3 class="card-header text-white bg-info mb-3">Sensor Atributes Graph</h3>
              <canvas id="chartid" width="400" height="300"></canvas>
            </div>
          </div>

      </div>
	  

   </div>

</div>


		
		<script src="assets/js/browser.min.js"></script>
		
		<script src="assets/js/breakpoints.min.js"></script>
		
		<script src="assets/js/util.js"></script>
		
		<script src="assets/js/main.js"></script>

  </body>

</html>
