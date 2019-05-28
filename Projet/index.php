<!DOCTYPE HTML>

<!--
	
	Polluscope Data Platforme by Yehia TAHER
	
	templated.co @templatedco
	
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
	
-->



<head>
	
	<center>
		
		<style>
			
			#div1
			
			{
			
			height:500px;
			
			width=1000px;
			
			overflow:auto;
			
			overflow-x:hidden;
			
			}
			
			#table1
			
			{
			
			
			
			font-family:Arail;
			
			font-size:10pt;
			
			width:800px;
			
			color:black;
			
			cellspacing:0px;
			
			cellpadding:10px;
			
			height:100%;
			
			}
			
			
			
			
			
		</style>
		
	</head>
	
	<html>
		
		<head>
			
			<title>Polluscope Project</title>
			
			<meta charset="utf-8" />
			
			<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
			
			<meta name="description" content="" />
			
			<meta name="keywords" content="" />
			
			<link rel="stylesheet" href="assets/css/main.css" />
			
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
						
						<p>This module is extracting new data records from Canarin Data Sever 
							
						and load them to Polluscope Data Platform.</p>	
						
					</header>
					
					
					
					<!-- Debut PhP Code par Yehia -->
					
					
					
					
					
					
					
					<?php
						
						
						
						// if ($dbccanarin = @mysqli_connect("canarin3.ces11ksjxlw4.eu-central-1.rds.amazonaws.com","airparif","senairsor2018","canarinProj"))
						
						// if ($dbccanarin = @mysqli_connect("canarin3.ces11ksjxlw4.eu-central-1.rds.amazonaws.com","airparif","senairsor2018","canarinProj"))
						if ($dbccanarin = @mysqli_connect("localhost","root","","polluscope"))
						{   
							
							//  if ($dbcpolluscope = pg_Connect("host=193.55.95.225 port=25432 dbname=postgres user=docker password=docker"))
							// if ($dbcpolluscope = pg_Connect("host=193.55.95.225 port=25432 dbname=polluscope user=docker password=docker"))
							if($dbcpolluscope = pg_Connect("host=localhost port=5432 dbname=polluscope user=postgres password=12345678 "))
							{   
						
						
						    pg_exec($dbcpolluscope," CREATE TABLE IF NOT EXISTS flaten_all_data
							(
							id serial,
							\"timestamp\" timestamp(6) with time zone NOT NULL,
							node_id bigint,
							node_name text,
							gps_lat double precision,
							gps_lng double precision,
							gps_alt double precision,
							temperature double precision,
							humidity double precision,
							pressure double precision,
							\"pm2.5\" double precision,
							pm10 double precision,
							\"pm1.0\" double precision,
							formaldehyde double precision,
							no2 double precision,
							bc double precision,
							geom geometry(Point,4326),
							CONSTRAINT flaten_data_pkey PRIMARY KEY (id)
							)
							" 
							);
							
							
							pg_exec($dbcpolluscope," CREATE TABLE IF NOT EXISTS polluscope_airparif_data
								(
								  id bigint NOT NULL,
								  node_id bigint NOT NULL,
								  server_timestamp timestamp(6) with time zone NOT NULL,
								  \"timestamp\" timestamp(6) with time zone NOT NULL,
								  type_id integer NOT NULL,
								  value_num double precision,
								  value_str text,
								  CONSTRAINT polluscope_airparif_data_pkey PRIMARY KEY (id)
								)
							" 
							);
							
							
							$creat=pg_exec($dbcpolluscope, "SELECT to_regclass('\"public\".\"type_id\"')");
							$row=pg_fetch_array($creat);
							if($row[0]==null)//if the table was not aleady exist
							{ 
							pg_exec($dbcpolluscope," CREATE TABLE IF NOT EXISTS \"type_id\" (id integer)" );
							pg_exec($dbcpolluscope," INSERT INTO type_id(id)VALUES (1)" );
							pg_exec($dbcpolluscope," INSERT INTO type_id(id)VALUES (2)" );
							pg_exec($dbcpolluscope," INSERT INTO type_id(id)VALUES (3)" );
							pg_exec($dbcpolluscope," INSERT INTO type_id(id)VALUES (4)" );
							pg_exec($dbcpolluscope," INSERT INTO type_id(id)VALUES (5)" );
							pg_exec($dbcpolluscope," INSERT INTO type_id(id)VALUES (6)" );
							pg_exec($dbcpolluscope," INSERT INTO type_id(id)VALUES (7)" );
							pg_exec($dbcpolluscope," INSERT INTO type_id(id)VALUES (8)" );
							pg_exec($dbcpolluscope," INSERT INTO type_id(id)VALUES (9)" );
							pg_exec($dbcpolluscope," INSERT INTO type_id(id)VALUES (11)" );
							pg_exec($dbcpolluscope," INSERT INTO type_id(id)VALUES (15)" );
							}
						        error_reporting(E_ALL ^ E_NOTICE);//turn off notices
								$a=array();
								$a["4317218322204134"] = "AirParif1";
								$a["35669077111271345"] = "AirParif10";
								$a["3566907742371345"] = "AirParif11";
								$a["3566907722371345"] = "AirParif12";
								$a["35669077252071345"] = "AirParif13";
								$a["35669077121271345"] = "AirParif14";
								$a["35669077192371345"] = "AirParif15";
								$a["35669077143371345"] = "AirParif16";
								$a["35669077272271345"] = "AirParif17";
								$a["43152552141141345"] = "AirParif2";
								$a["4315255293441345"] = "AirParif3";
								$a["3566907703071345"] = "AirParif4";
								$a["35669077103071345"] = "AirParif5";
								$a["35669077133271345"] = "AirParif6";
								$a["4316701852319345"] = "AirParif7";
								$a["3566907763371345"] = "AirParif8";
								$a["35669077213271345"] = "AirParif9";
								if($maxidpolluscope = pg_exec($dbcpolluscope, "select max(id) as id from polluscope_airparif_data"))
								
								{
									
									
									
									if ($rowpolluscope = pg_fetch_array($maxidpolluscope))
									
									if (!$maxidpolluscopedb= $rowpolluscope["id"])
									
									$maxidpolluscopedb = 0;
									
									
									$maxidcanarin = mysqli_query($dbccanarin, "select max(id) as id from airparif_data");
									
									if ($rowcanarin = mysqli_fetch_array($maxidcanarin))
									
									if (!$maxidcanarindb= $rowcanarin["id"])
									
									$maxidcanarindb = 0;         
									
									
									$querycanarin = "SELECT id, node_id, from_unixtime(server_timestamp) as server_timestamp, from_unixtime(timestamp) as timestamp, type_id, value_num, value_str FROM `airparif_data` where id >$maxidpolluscopedb limit 3000 ";
									
									
									
									if ($result = mysqli_query($dbccanarin, $querycanarin)) 
									
									{ //Run the query.
										
										$row_cnt =mysqli_num_rows($result);
										$file = "maxnumber.csv";
										$maxnbr = 0;										
										if (file_exists($file)) { 
											$pointeur = fopen($file,"r");											
											$t = fgetcsv($pointeur,1024);
											fclose($pointeur);
											if ($row_cnt > $t[0]) {
												$pointeur = fopen($file,"w");
												fputcsv($pointeur,array($row_cnt));
												fclose($pointeur);
											}
											$maxnbr = $t[0];											
										}
											
										else {
											$maxnbr = $row_cnt;
											$pointeur = fopen($file,"w");
											fputcsv($pointeur,array($row_cnt));
											fclose($pointeur);											
										}										
											
										echo " <div class=\"highlights\">
										
										<section>
										
										<div class=\"content\">
										
										<header>
										
										<a href=\"#\" class=\"icon fa-vcard-o\"><span class=\"label\">Icon</span></a>
										
										<h3>Table airparif_data @ Polluscope DB</h3>
										
										</header>
										
										<p>MAX ID: $maxidpolluscopedb</p>
										
										</div>
										
										</section>";
										
										
										
										echo "	<section>
										
										<div class=\"content\">
										
										<header>
										
										<a href=\"#\" class=\"icon fa-files-o\"><span class=\"label\">Icon</span></a>
										
										<h3>Table airparif_data @ Canarin DB</h3>
										
										</header>
										
										<p>MAX ID: $maxidcanarindb</p>
										
										</div>
										
										</section>";
										
										
										
										
										
										if ($row_cnt!=0)
										
										{ //check if postgres database is not up-to-date
											
											echo "	<section>
											
											<div class=\"content\">
											
											<header>
											
											<a href=\"Polluscope.csv\" class=\"icon fa-floppy-o\"><span class=\"label\">Icon</span></a>
											
											<h3>New Inserted Records into airparif_data @ Polluscope DB</h3>
											
											</header>
											
											<p>Record Number: $maxnbr</p>
											
											</div>
											
											</section>";
											
											
											
											echo " </div>";
											
											
											
											//creat a csv file
											
											if (!file_exists('Polluscope.csv'))
											
											{ touch('Polluscope.csv');
												
												
												
											}
											
											
											
											
											
											$fp = fopen('Polluscope.csv', 'w');
											
											fwrite($fp, "id, node_id, server_timestamp, timestamp, type_id, value_num, value_str\n");
											
											
											
											echo " <div id=div1>";
											
											echo "<table id=table1 border>
											
											<caption align=right><h3> Inserted New records ($row_cnt) into the table polluscope_airparif_data @ Polluscope DB<h3> </caption>
											
											
											
											<tr>
											
											<th> id </th>
											
											<th> node_id </th>
											
											<th> server_timestamp </th>
											
											<th> timestamp </th>
											
											<th> type_id </th>
											
											<th> value_num </th>
											
											<th> value_str </th>
											
											</tr>";
											
											
											
											// Retrieve and print every record:
											
											while ($row = mysqli_fetch_array($result)) {
												
												print "<tr> 
												
												<td>{$row['id']}</td>
												
												<td>{$row['node_id']}</td>
												
												<td>{$row['server_timestamp']}</td>
												
												<td>{$row['timestamp']}</td>
												
												<td>{$row['type_id']}</td>
												
												<td>{$row['value_num']}</td>
												
												<td>{$row['value_str']}</td>
												
												</tr>";
												
												
												
												
												
												fwrite($fp, "{$row['id']}, {$row['node_id']}, {$row['server_timestamp']}, {$row['timestamp']}, {$row['type_id']}, {$row['value_num']}, {$row['value_str']}\n");
												
												
												
												pg_exec($dbcpolluscope, "INSERT INTO polluscope_airparif_data (id, node_id, server_timestamp, timestamp, type_id, value_num, value_str)
												
												VALUES ({$row['id']}, {$row['node_id']}, '{$row['server_timestamp']}', '{$row['timestamp']}', {$row['type_id']}, {$row['value_num']}, NULLIF('{$row['value_str']}',''))");
												
												
												
											}
											
											echo "</table>";
											
											echo " </div>";
											
											
											
											
											
											/////////////////////////////////////////////////////////////////// start of code of insert from polluscope table to plat table				
											
											
											
											//  select from polluscope table to cross table format
											
											if($queryy=pg_exec($dbcpolluscope, " 
											
											SELECT node_id ,
											(date_trunc('minute', \"timestamp\") +(case when extract(second from \"timestamp\") > 30 then 60 else 0 end) * interval '1 second'  )as  \"timestamp\" , gps_lat , gps_lng , gps_alt ,temperature ,
											
											humidity ,pressure ,\"pm2.5\" ,pm10 ,\"pm1.0\" ,formaldehyde ,no2,ST_SetSRID(ST_MakePoint( gps_lng,gps_lat ),4326) as geom
											
											FROM crosstab(
											
											'select CONCAT(node_id,\"timestamp\") as c,id,node_id,\"timestamp\", type_id,value_num 
											
											from polluscope_airparif_data where id>$maxidpolluscopedb order by c ','select distinct id from type_id order by 1 '
											
											)  
											
											AS canarintoflaten4(c text,id bigint,node_id bigint,
											
											\"timestamp\" timestamp(6) with time zone, gps_lat double precision, 
											
											gps_lng double precision, gps_alt double precision,temperature double precision,
											
											humidity double precision,pressure double precision,\"pm2.5\" double precision,
											
											pm10 double precision,\"pm1.0\" double precision,formaldehyde double precision,
											
											no2 double precision)
											
											order by id																	 
											
											"))
											
											{
												
												
												
												
												
												while ($row = pg_fetch_array($queryy)) 
												
												{
													
													if( $row['gps_lat']==null)//the null value make a problem in the query insert
													
													$row['gps_lat']="null";
													
													if( $row['gps_lng']==null)
													
													$row['gps_lng']="null";
													
													if( $row['gps_alt']==null)
													
													$row['gps_alt']="null";
													
													if( $row['temperature']==null)
													
													$row['temperature']="null";
													
													if( $row['humidity']==null)
													
													$row['humidity']="null";
													
													if( $row['pressure']==null)
													
													$row['pressure']="null";
													
													if( $row['pm2.5']==null)
													
													$row['pm2.5']="null";
													
													if( $row['pm10']==null)
													
													$row['pm10']="null";
													
													if( $row['pm1.0']==null)
													
													$row['pm1.0']="null";
													
													if( $row['formaldehyde']==null)
													
													$row['formaldehyde']="null";
													
													if( $row['no2']==null)
													
													$row['no2']="null";
													
													if( $row['geom']==null)
													
													$row['geom']="null";
													
													if($q=pg_exec($dbcpolluscope, "select * from flaten_all_data where node_id={$row['node_id']} and \"timestamp\"='{$row['timestamp']}' "))
													
													{
														
														
														$exist= pg_fetch_array($q);//test if the row existed in the table plat
														
														
														
														if($exist[0]==null)//if this is a row with new node_id and timestamp, insert in plat table
														
														{  
															
															
															$node_name=$a[$row['node_id']];
															
															pg_exec($dbcpolluscope, "INSERT INTO flaten_all_data (timestamp,node_id,node_name,gps_lat, gps_lng, gps_alt,temperature,humidity,
															
															pressure,\"pm2.5\",pm10,\"pm1.0\",formaldehyde,no2,geom)
															
															VALUES ('{$row['timestamp']}', {$row['node_id']},'$node_name',{$row['gps_lat']},{$row['gps_lng']}, {$row['gps_alt']},{$row['temperature']},
															
															{$row['humidity']},{$row['pressure']},{$row['pm2.5']},{$row['pm10']},{$row['pm1.0']},{$row['formaldehyde']},
															
															{$row['no2']},ST_SetSRID(ST_MakePoint({$row['gps_lng']}, {$row['gps_lat']}),4326))");
															
															
															
															
															
														}
														
														else //if the node_id and timetamp already exist update the row 
														
														{ 
															
															
															
															if(strcmp($row['gps_lat'],"null")!=0)//gps_lat of cross table who register in object php(not in database postgres) different of null
															
															pg_exec($dbcpolluscope, "update flaten_all_data set gps_lat={$row['gps_lat']}  where node_id={$row['node_id']} and \"timestamp\"='{$row['timestamp']}' ");  
															
															if(strcmp($row['gps_lng'],"null")!=0)
															
															pg_exec($dbcpolluscope, "update flaten_all_data set gps_lng={$row['gps_lng']}  where node_id={$row['node_id']} and \"timestamp\"='{$row['timestamp']}' ");  
															
															if(strcmp($row['gps_alt'],"null")!=0)
															
															pg_exec($dbcpolluscope, "update flaten_all_data set gps_alt={$row['gps_alt']}  where node_id={$row['node_id']} and \"timestamp\"='{$row['timestamp']}' ");  
															
															if(strcmp($row['temperature'],"null")!=0)
															
															pg_exec($dbcpolluscope, "update flaten_all_data set temperature={$row['temperature']}  where node_id={$row['node_id']} and \"timestamp\"='{$row['timestamp']}' ");  
															
															if(strcmp($row['humidity'],"null")!=0)
															
															pg_exec($dbcpolluscope, "update flaten_all_data set humidity={$row['humidity']}  where node_id={$row['node_id']} and \"timestamp\"='{$row['timestamp']}' ");  
															
															if( strcmp($row['pressure'],"null")!=0)
															
															pg_exec($dbcpolluscope, "update flaten_all_data set pressure={$row['pressure']} where node_id={$row['node_id']} and \"timestamp\"='{$row['timestamp']}' ");  
															
															if(strcmp($row['pm2.5'],"null")!=0)
															
															pg_exec($dbcpolluscope, "update flaten_all_data set \"pm2.5\"={$row['pm2.5']} where node_id={$row['node_id']} and \"timestamp\"='{$row['timestamp']}' ");  
															
															if( strcmp($row['pm10'],"null")!=0)
															
															pg_exec($dbcpolluscope, "update flaten_all_data set pm10={$row['pm10']}  where node_id={$row['node_id']} and \"timestamp\"='{$row['timestamp']}' ");  
															
															if(strcmp($row['pm1.0'],"null")!=0)
															
															pg_exec($dbcpolluscope, "update flaten_all_data set \"pm1.0\"={$row['pm1.0']}   where node_id={$row['node_id']} and \"timestamp\"='{$row['timestamp']}' ");  
															
															if(strcmp($row['formaldehyde'],"null")!=0)
															
															pg_exec($dbcpolluscope, "update flaten_all_data set formaldehyde={$row['formaldehyde']}  where node_id={$row['node_id']} and \"timestamp\"='{$row['timestamp']}' ");  
															
															if( strcmp($row['no2'],"null")!=0)
															
															pg_exec($dbcpolluscope, "update flaten_all_data set no2={$row['no2']}  where node_id={$row['node_id']} and \"timestamp\"='{$row['timestamp']}' "); 
															
															
															
															
															
															
															
															if(strcmp($row['geom'],"null")!=0 )
																
																pg_exec($dbcpolluscope, "update flaten_all_data set geom='{$row['geom']}'  where node_id={$row['node_id']} and \"timestamp\"='{$row['timestamp']}' ");
																
															else
															
															if(strcmp($row['gps_lat'],"null")!=0 and $exist['gps_lng']!=null)//if  gps_lat exist in the cross table in the object php and gps_lng exist in the plat table in postgres
															
															{ 
																
																pg_exec($dbcpolluscope, "update flaten_all_data set geom=ST_SetSRID(ST_MakePoint({$exist['gps_lng']}, {$row['gps_lat']}),4326) 	
																
																where node_id={$row['node_id']} and \"timestamp\"='{$row['timestamp']}' "); 
																
															}
															
															else 
															
															if(strcmp($row['gps_lng'],"null")!=0 and $exist['gps_lat']!=null )//if  gps_lng exist in the cross table in the object php and gps_lat exist in the plat table in postgres
															
															{
																
																pg_exec($dbcpolluscope, "update flaten_all_data set geom=ST_SetSRID(ST_MakePoint({$row['gps_lng']}, {$exist['gps_lat']}),4326) 	
																
																where node_id={$row['node_id']} and \"timestamp\"='{$row['timestamp']}' ");
																
																
																
															}
															
															
															
														}
														
														
														
														///////////////////////////////////////////////////////////////////  end of code of insert from polluscope table to plat table	
														
													}
													
													else { // $q didn't run.
														
														print '<p style="color: red;">Could not run the query:$q <br />' ;
														
														
														
													} // End of query IF.
													
												}//end while
												
												
												
												
												
											}
											
											else { // Queryy didn't run.
												
												print '<p style="color: red;">Could not run the query:$queryy<br />' ;	
												
											} // End of query IF.
											
											
											
											fclose($fp);		
											
										} // end of: "if ($row_cnt!=0)"
										
										
										
										else { // if postgres database is up-to-date
											
											
											
											echo "	<section>
											
											<div class=\"content\">
											
											<header>
											
											<a href=\"#\" class=\"icon fa-floppy-o\"><span class=\"label\">Icon</span></a>
											
											<h3>New Inserted Records into airparif_data @ Polluscope DB</h3>
											
											</header>
											
											<p>Record Number: $maxnbr</p>
											
											</div>
											
											</section>
											
											</div>";
											
											
											
											echo "<center><h1><p style=\"color: red;\"> Your database is up-to-date </br> 
											
											No new records to be added! </p></h1></center>";
											
										}
										
										
										
										
										
									} // end of: "if ($result = mysqli_query($dbccanarin, $querycanarin)) "
									
									
									
									else { // Query didn't run.
										
										print '<p style="color: red;">Could not run the query:<br />' .
										
										'.</p><p>' . $querycanarin . '</p>';
										
									} // End of query IF.
									
									
									
								} // end of: "if($maxidpolluscope = pg_exec($dbcpolluscope, "select max(id) as id from airparif_data"))"
								
								
								
								else { // Query select max(id) didn't run.
									
									print '<p style="color: red;">Could not run the query:<br />' .
									
									'.</p><p> <i>select max(id) as id from airparif_data</i> on Polluscope DB</p>';
									
								} // End of query IF.
								
								
								
								pg_close($dbcpolluscope);
								
								mysqli_close($dbccanarin);
								
								
								
								
								
							} // end of: "if ($dbcpolluscope..."
							
							
							
							
							
							else { // if the connexion to polluscope (postgres) doesn't work... 
								
								print '<p style="color: red;">Could not connect to Postgres<br />'.'.</p>';
								
								mysqli_close($dbccanarin);
								
							}
						
							
						?>
						<!-- <meta http-equiv="refresh" content="<?php //echo 10 ?>;URL='<?php// echo $_SERVER['PHP_SELF']?>'"> -->
						
						<meta http-equiv="refresh" content="<?php echo 10 ?>;URL='<?php echo $_SERVER['PHP_SELF']?>'"> 
						<?php	
						} // end of: "if ($dbccanarin ..." 
						
						
						
						
						
						else { // if the connexion to canarin (mysql) doesn't work...  
							
							print '<p style="color: red;">Could not connect to MySQL<br />'.'.</p>';
							
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