<!DOCTYPE HTML>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Upload a File</title>
	</head>
	<body>
		
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
				
				<link rel="stylesheet" href="assets/css/main6.css" />
				
				<link rel="stylesheet" href="assets/css/m6.css" />
				
				
				
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
						
						
						
						
						<!-- Debut PhP Code par Yehia -->
						
						
						
						
						
						
						
						<?php
							
							
							// if ($dbcpolluscope = pg_Connect("host=193.55.95.225 port=25432 dbname=polluscope user=docker password=docker"))
							if ($dbcpolluscope = pg_Connect("host=localhost port=5432 dbname=polluscope user=postgres password=12345678 "))
							{  
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
								
								$now = new DateTime();
								$end=$now->format('Y-m-d H:i');
								$now->modify("-1 day");
								$start=$now->format("Y-m-d H:i");
								$st=explode(' ',$start);
								$start=$st[0]."T".$st[1];
								$en=explode(' ',$end);
								$end=$en[0]."T".$en[1];
								
								$queryId = pg_exec($dbcpolluscope, "SELECT id,name FROM unified_node ");
								
								
							?>
							
							<div class="highlights">
								<section>
									<div  class="content">
										
										<form method='POST' action='' >
											
											
											Start Date:<input type="datetime-local"  name='start' value=<?php echo $start ?> ><br>
											End Date:<br><input type="datetime-local" name='end' value=<?php echo $end ?>  ><br>
											
											
											<br>
											
											
										</div>
										
									</section>
									
									<section>
										
										<div class=content>
											
											Sensors Box:<select name='sensorBox[]' multiple> 
												<?php while($row=pg_fetch_array($queryId)) { ?>
													<option value=<?php echo $row[0] ?> > <?php echo $row[1] ?>  </option>
												<?php } ?>
											</select>  
											
											Sensors Type:<select name='ref' class=button5  > 
												<option value="FIDAS2.5" > FIDAS2.5</option>
												<option value="FIDAS1.0" > FIDAS1.0</option>
												<option value="FIDAS10" > FIDAS10</option>
												
											</select> 
											
											
											<input type='submit' value='submit' >
											
										</form>
										
										<?php 
											
											if(isset($_POST['sensorBox']) and isset($_POST['ref']))
											{   
												$ref=$_POST['ref'];
												
												
												if(strcmp($ref,"FIDAS2.5")==0)
												{$pollutant="pm2.5";
													$fidas="FIDAS_PM2.5";
												}
												if(strcmp($ref,"FIDAS1.0")==0)
												{
													$pollutant="pm1.0";
													$fidas="FIDAS_PM1";
												}
												if(strcmp($ref,"FIDAS10")==0)
												{
													$pollutant="pm10";
													$fidas="FIDAS_PM10";
												}
												$nodes=array();
												foreach ((array) $_POST['sensorBox'] as $node)
												{ 
													array_push($nodes,$node);
												}
												
												$node_name="ref";
												foreach ($nodes as $node_id)
												{
													$node_name=$node_name."-".$a[$node_id]; 
												}
												$table_name=$node_name."-".$ref;
												$table_ref=$table_name."_pkey";
												
												$creat=pg_exec($dbcpolluscope, "SELECT to_regclass('\"public\".\"$table_name\"')");
												$row=pg_fetch_array($creat);
												
												if($row[0]==null)//if the table was not aleady exist
												{  
													pg_exec($dbcpolluscope, "CREATE TABLE IF NOT EXISTS \"$table_name\" 
													(
													id SERIAL,
													node_id bigint,
													name_node text,
													ref text,
													CONSTRAINT \"$table_ref\" PRIMARY KEY (id))" ); 
													$creat=pg_exec($dbcpolluscope, "SELECT to_regclass('\"public\".\"$table_name\"')");
													$row=pg_fetch_array($creat);
													foreach ($nodes as $node_id)
													{
														$name_node=$a[$node_id];
														pg_exec($dbcpolluscope, "insert into \"$table_name\"(node_id,name_node,ref) values({$node_id},'{$a[$node_id]}','{$ref}') " ); 
														
													}
												}
												
												// $query = pg_exec($dbcpolluscope, "Drop TABLE \"$table_name\" " ); 
											}	
											
											
											if(isset($_POST['start']) and isset($_POST['end']))
											{   
												$s=explode('T',$_POST['start']);
												$start=$s[0]." ".$s[1];
												$e=explode('T',$_POST['end']);													
												$end=$e[0]." ".$e[1];
												
												$hms=explode(':',$s[1]);
												$hs=$hms[0];
												$ms=$hms[1];
												
												$hme=explode(':',$e[1]);
												$he=$hme[0];
												$me=$hme[1];
												$query = pg_exec($dbcpolluscope, "select \"node_name\",\"$pollutant\",\"MC\",\"timestamp\",\"date_time\" from (select * from ( select * from (select * from flaten_all_data where \"timestamp\" BETWEEN '$start' and '$end') as flaten,\"$table_name\"
												where flaten.node_id=\"$table_name\".node_id) as \"f\" 
												right OUTER JOIN \"$fidas\" on \"$fidas\".\"date_time\"=\"f\".\"timestamp\") as \"result\" where \"result\".\"MC\" is not null and \"result\".\"date_time\" between '$start' and '$end' order by \"timestamp\" ");
												
												$node_name="Comparaison";
												foreach ($nodes as $node_id)
												{ 
													$node_name=$node_name."-".$a[$node_id];
													
												}
												$table_name=$node_name."-".$ref."-".$s[0]." ".$hs."-".$ms."_".$e[0]." ".$he."-".$me;
												$csv_file=$table_name.".csv";
												
												$creat=pg_exec($dbcpolluscope, "SELECT to_regclass('\"public\".\"$table_name\"')");
												$row=pg_fetch_array($creat);
												
												if($row[0]==null)
												{   
													pg_exec($dbcpolluscope, "CREATE TABLE IF NOT EXISTS \"$table_name\" ()" ); 
													pg_exec($dbcpolluscope, "ALTER TABLE \"$table_name\"
													ADD COLUMN \"id\" SERIAL PRIMARY KEY " );
													foreach ($nodes as $node_id)
													{
														$node_name=$a[$node_id];
														pg_exec($dbcpolluscope, "ALTER TABLE \"$table_name\"
														ADD COLUMN \"$node_name\" double precision " ); 
														
													}
													
													
													pg_exec($dbcpolluscope, "ALTER TABLE \"$table_name\"
													ADD COLUMN \"AQM\" double precision " );
													
													pg_exec($dbcpolluscope, "ALTER TABLE \"$table_name\"
													ADD COLUMN \"WS\" double precision " );
													
													pg_exec($dbcpolluscope, "ALTER TABLE \"$table_name\"
													ADD COLUMN \"WD\" double precision " );
													
													
													
													pg_exec($dbcpolluscope, "ALTER TABLE \"$table_name\"
													ADD COLUMN \"timestamp\" timestamp with time zone " );
													
													$ws=0;
													$wd=0;
													
													while($row = pg_fetch_array($query))
													{
														
														if($row['node_name']!=null )
														{  
															
															if($row['MC']==null)
															$row['MC']="null";
															if($pollutant==null)
															$pollutant="null";
															$pollutant_value=$row[$pollutant];
															
															if($row[$pollutant]==null)// some rows has node_id but the value of the pollutant is null
															$pollutant_value="null";
															
															$qu= pg_exec($dbcpolluscope, "SELECT * from \"$table_name\" where \"timestamp\"= '{$row['timestamp']}' ");
															if(pg_num_rows($qu)==0)//befor insert the row check if the timestamp already exist
															{
																if($row['MC']!="null")//at least we must have one value of the both MC or pollutant to insert the row
																pg_exec($dbcpolluscope, "insert into \"$table_name\"(\"{$row['node_name']}\",\"AQM\",\"WS\",\"WD\",\"timestamp\") values({$pollutant_value},{$row['MC']},{$ws},{$wd},'{$row['timestamp']}') " ); 
															}
															else
															{  
																if($row['MC']!="null")
																pg_exec($dbcpolluscope, "update \"$table_name\" set \"AQM\"={$row['MC']} where \"timestamp\"= '{$row['timestamp']}' " );
																
																if($pollutant_value!="null")// if this timestamp already exists we have to update the row.
																pg_exec($dbcpolluscope, "update \"$table_name\" set \"{$row['node_name']}\"={$pollutant_value} where \"timestamp\"= '{$row['timestamp']}' " );
																
															}
															
															
														}
														else
														{    
															$qu= pg_exec($dbcpolluscope, "SELECT * from \"$table_name\" where \"timestamp\"= '{$row['date_time']}' ");
															if(pg_num_rows($qu)==0)//before insert the row check if the timestamp already exist
															{
																if($row['MC']!="null")
																pg_exec($dbcpolluscope, "insert into \"$table_name\"(\"AQM\",\"WS\",\"WD\",\"timestamp\") values({$row['MC']},{$ws},{$wd},'{$row['date_time']}') " );
																
															}
															else
															{
																if($row['MC']!="null")
																pg_exec($dbcpolluscope, "update \"$table_name\" set \"AQM\"={$row['MC']} where \"timestamp\"= '{$row['timestamp']}' " );
																
															}
															
														}
														
														
													}
													
													
													$sensors=array();
													foreach ($nodes as $node_id)
													{
														array_push($sensors,$a[$node_id]); 
														
													}
												
													
													$null=-999999;
													foreach($sensors as $sensor_name)
													pg_exec($dbcpolluscope, "update \"$table_name\" set \"{$sensor_name}\"='$null' where \"{$sensor_name}\" is null " );
													
													pg_exec($dbcpolluscope, "update \"$table_name\" set \"AQM\"='$null' where \"AQM\" is null " );
													
													///////////// creat temporal table in order copy the data from posgresql table to csv SET without timestamp column
													pg_exec($dbcpolluscope, "SELECT *,ROW_NUMBER() OVER (ORDER BY \"timestamp\" asc) as \"ROW_ID\" INTO \"TempTable\" FROM \"$table_name\" order by \"timestamp\" asc ");
													pg_exec($dbcpolluscope, "ALTER TABLE \"TempTable\" DROP COLUMN \"timestamp\" ");
													pg_exec($dbcpolluscope, "ALTER TABLE \"TempTable\" DROP COLUMN \"id\" ");
													////////////
													
													
													
													/////////////////////// from postgre table to csv file
													$files = glob('SET/FIDAS/*'); // get all file names
													foreach($files as $file){ // iterate files
														if(is_file($file))
														unlink($file); // delete file
													}
													
													$fp1 = fopen("SET/FIDAS/$csv_file","wb");
													$fp2 = fopen("Archive/FIDAS/$csv_file","wb"); 
													
													$header=array();
													foreach ($nodes as $node_id)
													{
														$node_name=$a[$node_id];
														
														array_push($header,$node_name);
														
													}
													array_push($header,"AQM");
													array_push($header,"WS");
													array_push($header,"WD");
													array_push($header,"ROW_ID");
													fputcsv($fp1, $header);
													fputcsv($fp2, $header);
													
													
													////////////////// SET
													$result1=pg_exec($dbcpolluscope,"select * from \"TempTable\" ");
													while ($row = pg_fetch_array($result1)) {
														$data=array();
														foreach ($nodes as $node_id)
														{
															$node_name=$a[$node_id];
															
															array_push($data,$row[$node_name]);
															
														}
														array_push($data,$row['AQM']);
														array_push($data,$row['WS']);
														array_push($data,$row['WD']);
														array_push($data,$row['ROW_ID']);
														
														fputcsv($fp1,  $data);
														
													}
													
													fclose($fp1);
													///////////////Archive
													$result2=pg_exec($dbcpolluscope,"select * from \"TempTable\" ");
													while ($row = pg_fetch_array($result2)) {
														$data=array();
														foreach ($nodes as $node_id)
														{
															$node_name=$a[$node_id];
															
															array_push($data,$row[$node_name]);
															
														}
														array_push($data,$row['AQM']);
														array_push($data,$row['WS']);
														array_push($data,$row['WD']);
														array_push($data,$row['ROW_ID']);
														
														fputcsv($fp2,  $data);
														
													}
													
													fclose($fp2);
													
													
													 pg_exec($dbcpolluscope, "DROP TABLE \"TempTable\" ");
													
													echo "<a href='SET/FIDAS/$csv_file'><button>Download</button></a>";
													
												}
												else{
													
													echo "<script>
													
													alert('Sorry! table aleardy exist');
													
													</script>";
													
												}
												
											}
										?>
										<br>
										<br>
										<br>
									</div>
									
								</section>
								
							</div>
							
							
							<?php
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
		
		
		
		
		
		
		
		