<!DOCTYPE HTML>

<!-- 
	
	Polluscope Data Platforme by Yehia TAHER
	
	templated.co @templatedco
	
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
	
-->





<html>
	
	<head>
		
		<title>Polluscope Project</title>
		
		<meta charset="utf-8" />
		
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		
		<meta name="description" content="" />
		
		<meta name="keywords" content="" />
		
		<link rel="stylesheet" href="assets/css/main1.css" />
		
		<link rel="stylesheet" href="assets/css/m.css" />
		
	</head>
	
	<body class="is-preload">			
		
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
		
		
		
		<!-- Banner -->
		
		<section id="banner">
			
			<div class="inner">
				
				<h1>Polluscope Data Platform</h1>
				
				<p>A Cloud based Data platform<br>
					
				hosted at GLACTICA CNRS Cloud Platform.</p>
				
			</div>
			
			<!--	<video autoplay loop muted playsinline src="images/banner.mp4"></video> -->
			
		</section>
		
		
		
		<!-- Highlights -->
		
		<section class="wrapper">
			
			<div class="inner">
				
				<header class="special">
					
					<h2>Data Acquisition Module</h2>
					
					<p><h4>Choose the time interval of interest and validate, then download the data in csv format. All sensor data are grouped in a flat file.</h4></p>	
					
				</header>
				
				
				
				<!-- Debut PhP Code par Yehia -->
				
				
				
				
				
				
				
				<?php
					
					
					
					
					
					// if ($dbcpolluscope = pg_Connect("host=193.55.95.225 port=25432 dbname=polluscope user=docker password=docker"))
					if ($dbcpolluscope = pg_Connect("host=localhost port=5432 dbname=polluscope user=postgres password=12345678 "))
					
					{  
						
						if($query= pg_exec($dbcpolluscope,"select count(*) from flaten_all_data"))
						
						{
							
							
							if(isset($_POST['start']) && isset($_POST['end'])) 
							
							{    
							
								if (isset($_POST['DeviceID'])) { //Apport Modification 
									$sensor_ids= join("','", $_POST['DeviceID']);
								}

						        $start=$_POST['start'];//result of formt yyyy-mm-ddThh:ii:ss
								
								$end=$_POST['end'];	
								
						        $hourStart=$_POST['hourStart'];	
								
								$hourEnd=$_POST['hourEnd'];	
								
								$cptr = 0;
								
								if(strlen($hourStart)==1) 
								
								$hourStart = sprintf("%02d", $hourStart);//for transform the number with one digit to number with two digit.ex:3->03
								
								if(strlen($hourEnd)==1) 
								
								$hourEnd = sprintf("%02d", $hourEnd);
								
								
								
								$start1=$start." ".$hourStart.":"."00";
								
								$end1=$end." ".$hourEnd.":"."00";
								
								//$getAirparif=pg_exec($dbcpolluscope,"select id,name from unified_node "); COMMENTER
								
								if(isset($_POST['minTemp']))
									$minTemp=$_POST['minTemp'];
								else
								//$minTemp=pg_exec($dbcpolluscope,"select min(temperature) from flaten_all_data");
								$minTemp=0;
								if(isset($_POST['maxTemp']))
									$maxTemp=$_POST['maxTemp'];
								else
								//$maxTemp=pg_exec($dbcpolluscope,"select max(temperature) from flaten_all_data");
								$maxTemp=10000;
								
								if(isset($_POST['minHum']))
									$minHum=$_POST['minHum'];
								else
								//$minHum=pg_exec($dbcpolluscope,"select min(humidity) from flaten_all_data");
								$minHum=0;
								if(isset($_POST['maxHum']))
									$maxHum=$_POST['maxHum'];
								else
								//$maxHum=pg_exec($dbcpolluscope,"select max(humidity) from flaten_all_data");
								$maxHum=10000;
								
								if(isset($_POST['minPress']))
									$minPress=$_POST['minPress'];
								else
								//$minPress=pg_exec($dbcpolluscope,"select min(pressure) from flaten_all_data");
								$minPress=0;
								if(isset($_POST['maxPress']))
									$maxPress=$_POST['maxPress'];
								else
								//$maxPress=pg_exec($dbcpolluscope,"select max(pressure) from flaten_all_data");
								$maxPress=10000;

								echo " <div class=\"highlights\">
								
								<section  float=right>
								
								<div class=\"content\">
								
								<header id=\"filtres\" align=left >
								
								<form method=POST >
								
								<strong><font color=#e60000>Start</strong> <br>
								Date : <input type=date  name='start' value=$start > <br>
								Hour : <input type=number name='hourStart' value=$hourStart  min=0 max=23 > <br><br></font>
								
								<strong><font color=#e60000>End</strong> <br>
								Date : <input type=date name='end' value=$end style='margin-left: 5px' > <br> 
								Hour : <input type=number name='hourEnd' value=$hourEnd min=0 max=23 style='margin-left: 5px' ><br><br><br></font>
								
								<font color=#e60000>Canarin Sensor:</font>
								<select class=button3 style=\"width:200px;\" name='DeviceID[]' multiple >	

								</header>";

								?>
								
								
								<!-- CE header EST L'ENDROIT OU SERA INSERE LE TABLEAU-->
								<header align=left >
								
								<input alt='Search Button' src='images/submit.png' type='image' width=120 height=45 />
								
								
								</header>
								
								</form>
								
								</div>
								
								</section>
								
								
								
								
								<section>
								
								<div class=\"content\">
								
								<header>
								
								<a href=\"polluscope-data.csv\" class=\"icon fa-floppy-o\"><span class=\"label\">Icon</span></a>
								
								<h3> Download all rows Between:<br> $start1 and $end1 </h3>
								
								</header>											
								
								</div>
								
								</section>";
								
								<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"> </script>
								<script>
								$(document).ready (function() {
									$("button").click(function(){
										$("#test2").show();
										$cptr +=1;
									});
								});

								</script>
								<?php
								
								
								
								echo " </div>";
								
								
								
								//creat a csv file
								
								if (!file_exists('polluscope-data.csv'))
								
								{ touch('polluscope-data.csv');
									
									
									
								}
								
								$fp = fopen('polluscope-data.csv', 'w');
								fwrite($fp, "id, timestamp, node_id, node_name, gps_lat, gps_lng, gps_alt, temperature, humidity, pressure, pm2.5, pm10, pm1.0, formaldehyde, no2,bc\n");
								
								if($query0 = pg_exec($dbcpolluscope,"select *,ST_AsGeoJSON(geom) as geojson from flaten_all_data where node_id IN ('$sensor_ids') and \"timestamp\" BETWEEN '$start' and '$end' and temperature BETWEEN '$minTemp' and '$maxTemp' and humidity BETWEEN '$minHum' and '$maxHum' and pressure BETWEEN '$minPress' and '$maxPress' order by id  "))
								{
									while ($row = pg_fetch_array($query0)) {
										
										fwrite($fp, "{$row['id']},{$row['timestamp']}, {$row['node_id']}, {$row['node_name']}, {$row['gps_lat']}, {$row['gps_lng']}, {$row['gps_alt']}, {$row['temperature']}, {$row['humidity']},{$row['pressure']},{$row['pm2.5']},{$row['pm10']},{$row['pm1.0']},{$row['formaldehyde']},{$row['no2']},{$row['bc']}\n");
										
									}
									
								}
								
								else { // query0 didn't run.
									
									print '<p style="color: red;">Could not run the query:<br />' .
									
									'.</p><p> <i>select * from ( select * from flaten_all_data0 order by id DESC LIMIT 100 ) as p  order by id asc  </i> on Polluscope DB</p>';
									
								} // End of query IF.
								
							if($query2 = pg_exec($dbcpolluscope,"select *,ST_AsGeoJSON(geom) as geojson from flaten_all_data where node_id IN ('$sensor_ids') and \"timestamp\" BETWEEN '$start' and '$end' and temperature BETWEEN '$minTemp' and '$maxTemp' and humidity BETWEEN '$minHum' and '$maxHum' and pressure BETWEEN '$minPress' and '$maxPress' order by id  "))
								
								{
									
									echo "<div id=\"div2\"><table id=\"table2\" style=width:1%; >
									
									<caption><h2 align=center> table flaten_all_data @ Polluscope DB </h2></caption>
									
									<tr>
									
									<th> id </th>
									
									<th> timestamp </th>
									
									<th> node_id </th>
									
									<th> node_name </th>
									
									<th> gps_lat </th>
									
									<th> gps_lng </th>
									
									<th> gps_alt </th>
									
									<th> temperature </th>
									
									<th> humidity </th>
									
									<th> pressure </th>
									
									<th> pm2.5 </th>
									
									<th> pm10 </th>
									
									<th> pm1.0 </th>
									
									<th> formaldehyde </th>
									
									<th> no2 </th>
									
									<th> bc </th>
									
									</tr>";
									
									
									
									while ($row = pg_fetch_array($query2)) {
										
										print "<tr> 
										
										<td>{$row['id']}</td>
										
										<td>{$row['timestamp']}</td>
										
										<td>{$row['node_id']}</td>
										
										<td>{$row['node_name']}</td>
										
										<td>{$row['gps_lat']}</td>                                                                                      
										
										<td>{$row['gps_lng']}</td>
										
										<td>{$row['gps_alt']}</td>
										
										<td>{$row['temperature']}</td>
										
										<td>{$row['humidity']}</td>
										
										<td>{$row['pressure']}</td>
										
										<td>{$row['pm2.5']}</td>
										
										<td>{$row['pm10']}</td>
										
										<td>{$row['pm1.0']}</td>
										
										<td>{$row['formaldehyde']}</td>
										
										<td>{$row['no2']}</td>
										
										<td>{$row['bc']}</td>
										
										</tr>";
										
										
									}
									
									echo "</table></div>";
									
									
									
									// End of query IF.
									
									
									
									// fclose($fp);
									
								}
								
								
								
								
								
								else { // query2 didn't run.
									
									print '<p style="color: red;">Could not run the query:<br />' .
									
									'.</p><p> <i>select * from ( select * from flaten_all_data order by id DESC LIMIT 100 ) as p  order by id asc  </i> on Polluscope DB</p>';
									
								} // End of query IF.
								
								
								
							if($query3 = pg_exec($dbcpolluscope,"select *,ST_AsGeoJSON(geom) as geojson from flaten_all_data where node_id IN ('$sensor_ids') and \"timestamp\" BETWEEN '$start' and '$end' and temperature BETWEEN '$minTemp' and '$maxTemp' and humidity BETWEEN '$minHum' and '$maxHum' and pressure BETWEEN '$minPress' and '$maxPress' order by id  "))
								
								{
									
									$max=pg_fetch_array($query3);
									
									
									
							if($query1 = pg_exec($dbcpolluscope,"select *,ST_AsGeoJSON(geom) as geojson from flaten_all_data where node_id IN ('$sensor_ids') and \"timestamp\" BETWEEN '$start' and '$end' and temperature BETWEEN '$minTemp' and '$maxTemp' and humidity BETWEEN '$minHum' and '$maxHum' and pressure BETWEEN '$minPress' and '$maxPress' order by id  "))
									
									{
										
										
										
										while($row = pg_fetch_array($query1))
										$arr[]=$row;
										
										
										
									?>
									
									
									
									<select id=foo  class=button2  onchange="myFunction(this)";></select>
									
									<script>//code from google
										
										(function() { // don't leak
											
											
											
											var elm = document.getElementById('foo'), // get the select
											
											df = document.createDocumentFragment(); // create a document fragment to hold the options while we create them
											
											for (var i = 0; i*100 < <?php echo $max[0] ?>+100; i++) {
												
												var option = document.createElement('option'); // create the option element
												
												option.value = i*100; // set the value property
												
												if(i==0)
												
												option.appendChild(document.createTextNode( "Show"));
												
												else
												
												option.appendChild(document.createTextNode("page"+i)); // set the textContent in a safe way.
												
												df.appendChild(option); // append the option to the document fragment
												
											}
											
											elm.appendChild(df); // append the document fragment to the DOM. this is the better way rather than setting innerHTML a bunch of times (or even once with a long string)
											
										}());
										
									</script>
									
									
									
									
									
									<script src="http://code.jquery.com/jquery-1.9.1.js" ></script>		
									
									<script>
										
									
										var rows = <?php echo json_encode($arr);?>;
										
										<!-- alert(JSON.stringify(rows));
										
										
										
										var c, curr ;		
										
										function myFunction(v) {
											
											c=v.value-100;curr=v.value;
											
											$("#table2 tr:gt(0)").remove();
											
											for(c;c<rows.length&&c<curr;c++){
												
												$('#table2 tr:last').after(
												
												'<tr>'+ 
												
												'<td>'+rows[c].id+'</td>'+'<td>'+rows[c].timestamp+'</td>'+'<td>'+rows[c].node_id+'</td>'+'<td>'+rows[c].node_name+'</td>'+'<td>'+rows[c].gps_lat+'</td>'+
												
												'<td>'+rows[c].gps_lng+'</td>'+'<td>'+rows[c].gps_alt+'</td>'+'<td>'+rows[c].temperature+'</td>'+'<td>'+rows[c].humidity+'</td>'+
												
												'<td>'+rows[c].pressure+'<td>'+rows[c]['pm2.5']+'</td>'+'<td>'+rows[c].pm10+'</td>'+'<td>'+rows[c]['pm1.0']+'</td>'+'<td>'+rows[c].formaldehyde+'</td>'+'<td>'+rows[c].no2+'</td>'+'<td>'+rows[c].bc+'</td>'+
												
												'</tr><tr>'		
												
												
												
												);
												
												
												
												
												
											}
											
										
										}
										
										
										
									</script>
									
									<?php }
									
									else { // query1 didn't run.
										
										print '<p style="color: red;">Could not run the query:<br />' .
										
										'.</p><p> <i>select * from flaten_all_data where (\"timestamp\" BETWEEN $start1 and $end1) and (temperature BETWEEN $minTemp and $maxTemp) and (humidity BETWEEN $minHum and $maxHum) and (pressure BETWEEN $minPress and $maxPress) order by id    </i> on Polluscope DB</p>';
										
									}
									
									
									
								} 
								
								else { // query3 didn't run.
									
									print '<p style="color: red;">Could not run the query:<br />' .
									
									'.</p><p> <i>select count(*) from(select * from flaten_all_data where (\"timestamp\" BETWEEN $start1 and $end1) and (temperature BETWEEN $minTemp and $maxTemp) and (humidity BETWEEN $minHum and $maxHum) and (pressure BETWEEN $minPress and $maxPress) order by id) as a    </i> on Polluscope DB</p>';
									
								} // End of query IF.
								
								
							}// fin de if(isset($_POST['start']) && isset($_POST['end']))
							
							else 
							
							{ 
								$now = new DateTime();
								$hourStart=$now->format("H");
								$hourEnd=$now->format("H");
								$end=$now->format('Y-m-d');
								$now->modify("-1 day");
								$start=$now->format("Y-m-d");
								$getAirparif=pg_exec($dbcpolluscope,"select id,name from unified_node  ");
								//$minTemp=pg_exec($dbcpolluscope,"select min(temperature) from flaten_all_data");
								$minTemp=0;
								//$maxTemp=pg_exec($dbcpolluscope,"select max(temperature) from flaten_all_data");
								$maxTemp=10000;
								
								//$minHum=pg_exec($dbcpolluscope,"select min(humidity) from flaten_all_data");
								$minHum=0;
								//$maxHum=pg_exec($dbcpolluscope,"select max(humidity) from flaten_all_data");
								$maxHum=10000;
								
								//$minPress=pg_exec($dbcpolluscope,"select min(pressure) from flaten_all_data");
								$minPress=0;
								//$maxPress=pg_exec($dbcpolluscope,"select max(pressure) from flaten_all_data");
								$maxPress=10000;
								
								echo " <div class=\"highlights\">
								
								<section  float=right>
								
								<div class=\"content\">
								
								<header id=\"filtres\" align=left >
								
								
								
								<form action='' method=POST >
								
								<strong><font color=#e60000>Start</strong> <br>
								Date : <input type=date  name='start' value=$start > <br>
								Hour : <input type=number name='hourStart' value=$hourStart  min=0 max=23 > <br><br></font>
								
								<strong><font color=#e60000>End</strong> <br>
								Date : <input type=date name='end' value=$end style='margin-left: 5px' > <br> 
								Hour : <input type=number name='hourEnd' value=$hourEnd min=0 max=23 style='margin-left: 5px' ><br><br><br></font>
								
								<font color=#e60000>Canarin Sensor:</font>
								<select class=button3 style=\"width:200px;\" name='DeviceID[]' multiple >	";
									
									while( $NameDevice=pg_fetch_array($getAirparif) ) {?>
										<option value=<?php echo $NameDevice[0];?> ><?php echo $NameDevice[1]; ?> </option>
									<?php }	
								$getAirparif=pg_exec($dbcpolluscope,"select id,name from unified_node  ");
								echo "</select>
								<select id = 'test' class=button3 style=\"width:200px;display:none;\" name='DeviceID2[]' multiple >	";
									
									while( $NameDevice=pg_fetch_array($getAirparif) ) {?>
										<option value=<?php echo $NameDevice[0];?> >
										<?php 

										echo $NameDevice[1]; 
										?> </option>
									<?php }	
								echo "</select>
								
								</header>
								
								<header id=\"filtres\" align=left>
								<button type ='button' id = 'plus'>More Options</button><br>
								
								<div id= 'extra_options' style= 'display: none;'>
								<strong><font color=#e60000>Temperature</strong> <br>
								Min : <input type=number name='minTemp' value=$minTemp  min=$minTemp max=$maxTemp > <br>
								Max : <input type=number name='maxTemp' value=$maxTemp  min=$minTemp max=$maxTemp > <br><br></font>
								
								<strong><font color=#e60000>Humidity</strong> <br>
								Min : <input type=number name='minHum' value=$minHum  min=$minHum max=$maxHum > <br>
								Max : <input type=number name='maxHum' value=$maxHum  min=$minHum max=$maxHum > <br><br></font>
								
								<strong><font color=#e60000>Pressure</strong> <br>
								Min : <input type=number name='minPress' value=$minPress  min=$minPress max=$maxPress > <br>
								Max : <input type=number name='maxPress' value=$maxPress  min=$minPress max=$maxPress > <br><br></font>
								</div>
								</header>
								
								<header align=left >
								
								<input alt='Search Button' src='images/submit.png' type='image' width=120 height=45 />
								

								</header>
								
								</form>
								
								</div>
								
								</section>";
								
								$nb= pg_fetch_array($query);
								
								echo "<section>
								
								<div class=\"content\">
								
								<header>
								
								<a href=\"#\" class=\"icon fa-files-o\"><span class=\"label\">Icon</span></a>
								
								<h3>number of all rows : $nb[0] </h3>					
								
								</header>
								
								</div>
								
								</section>";
								?>
								<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"> </script>
								<script>
								// A COMPLETER
								$(document).ready (function() {
									$("#plus").click(function(){
										$("#extra_options").show();
									});
								});

								</script>
								<?php
								
								
							}
							
							
						}
						
						else { // query didn't run.
							
							print '<p style="color: red;">Could not run the query:<br />' .
							
							'.</p><p> <i>select count(*) from flaten_all_data  </i> on Polluscope DB</p>';
							
						} // End of query IF.
						
						
						
						
						
						pg_close($dbcpolluscope);
						
						
						
						
						
					} // end of: "if ($dbcpolluscope..."
					
					
					
					
					
					else { // if the connexion to polluscope (postgres) doesn't work... 
						
						print '<p style="color: red;">Could not connect to Postgres<br />'.'.</p>';
						
						mysqli_close($dbccanarin);
						
					}
					
					
					
					
					
				?>
				
				
				
				
				
				
				
				
				
				
				
			</div>
			
		</section> 
		
		
		
		
		
		
		
		<!-- CTA -->
		
		<section id="cta" class="wrapper">
			
			<div class="inner">
				
				<h2>To be added!</h2>
				
				<p>To be added!</p>
				
			</div>
			
		</section>
		
		
		
		<!-- Testimonials -->
		
		<section class="wrapper">
			
			<div class="inner">
				
				<header class="special">
					
					<h2>To be added!</h2>
					
					<p>To be added!</p>
					
				</header>
				
				<div class="testimonials">
				
				<section>
				
				<div class="content">
				
				<blockquote>
				
				<p>To be added!</p>
				
				</blockquote>
				
				<div class="author">
				
				<div class="image">
				
				<img src="images/pic01.jpg" alt="" />
				
				</div>
				
				<p class="credit">- <strong>Jane Doe</strong> <span>CEO - ABC Inc.</span></p>
				
				</div>
				
				</div>
				
				</section>
				
				<section>
				
				<div class="content">
				
				<blockquote>
				
				<p>Nunc lacinia ante nunc ac lobortis ipsum. Interdum adipiscing gravida odio porttitor sem non mi integer non faucibus.</p>
				
				</blockquote>
				
				<div class="author">
				
				<div class="image">
				
				<img src="images/pic03.jpg" alt="" />
				
				</div>
				
				<p class="credit">- <strong>John Doe</strong> <span>CEO - ABC Inc.</span></p>
				
				</div>
				
				</div>
				
				</section>
				
				<section>
				
				<div class="content">
				
				<blockquote>
				
				<p>Nunc lacinia ante nunc ac lobortis ipsum. Interdum adipiscing gravida odio porttitor sem non mi integer non faucibus.</p>
				
				</blockquote>
				
				<div class="author">
				
				<div class="image">
				
				<img src="images/pic02.jpg" alt="" />
				
				</div>
				
				<p class="credit">- <strong>Janet Smith</strong> <span>CEO - ABC Inc.</span></p>
				
				</div>
				
				</div>
				
				</section>
				
				</div>
				
				</div>
				
				</section>
				
				
				
				<!-- Footer -->
				
				<footer id="footer">
				
				<div class="inner">
				
				<div class="content">
				
				<section>
				
				<h3>To be added!</h3>
				
				<p>To be added!</p>
				
				</section>
				
				<section>
				
				<h4>To be added!</h4>
				
				<ul class="alt">
				
				<li><a href="#">Dolor pulvinar sed etiam.</a></li>
				
				<li><a href="#">Etiam vel lorem sed amet.</a></li>
				
				<li><a href="#">Felis enim feugiat viverra.</a></li>
				
				<li><a href="#">Dolor pulvinar magna etiam.</a></li>
				
				</ul>
				
				</section>
				
				<section>
				
				<h4>Magna sed ipsum</h4>
				
				<ul class="plain">
				
				<li><a href="#"><i class="icon fa-twitter">&nbsp;</i>Twitter</a></li>
				
				<li><a href="#"><i class="icon fa-facebook">&nbsp;</i>Facebook</a></li>
				
				<li><a href="#"><i class="icon fa-instagram">&nbsp;</i>Instagram</a></li>
				
				<li><a href="#"><i class="icon fa-github">&nbsp;</i>Github</a></li>
				
				</ul>
				
				</section>
				
				</div>
				
				<div class="copyright">
				
				&copy; Untitled. Photos <a href="https://unsplash.co">Unsplash</a>, Video <a href="https://coverr.co">Coverr</a>.
				
				</div>
				
				</div>
				
				</footer>
				
				
				
				<!-- Scripts -->
				
				<script src="assets/js/jquery.min.js"></script>
				
				<script src="assets/js/browser.min.js"></script>
				
				<script src="assets/js/breakpoints.min.js"></script>
				
				<script src="assets/js/util.js"></script>
				
				<script src="assets/js/main.js"></script>
				
				
				
				</body>
				
				</html>
				
								
