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
				
				<link rel="stylesheet" href="assets/css/main5.css" />
				
				<link rel="stylesheet" href="assets/css/m5.css" />
				
				
				
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
						
						
						
						
						<!-- Debut PhP Code par Yehia -->
						
						
						
						
						
						
						
						<?php
							
							
							// if ($dbcpolluscope = pg_Connect("host=193.55.95.225 port=25432 dbname=polluscope user=docker password=docker"))
							if ($dbcpolluscope = pg_Connect("host=localhost port=5432 dbname=polluscope user=postgres password=12345678 "))
							{  
								error_reporting(E_ALL ^ E_NOTICE);//turn off notices 
								$a=array();
								$a["4317218322204134"] = "AirParif 1";
								$a["35669077111271345"] = "AirParif 10";
								$a["3566907742371345"] = "AirParif 11";
								$a["3566907722371345"] = "AirParif 12";
								$a["35669077252071345"] = "AirParif 13";
								$a["35669077121271345"] = "AirParif 14";
								$a["35669077192371345"] = "AirParif 15";
								$a["35669077143371345"] = "AirParif 16";
								$a["35669077272271345"] = "AirParif 17";
								$a["43152552141141345"] = "AirParif 2";
								$a["4315255293441345"] = "AirParif 3";
								$a["3566907703071345"] = "AirParif 4";
								$a["35669077103071345"] = "AirParif 5";
								$a["35669077133271345"] = "AirParif 6";
								$a["4316701852319345"] = "AirParif 7";
								$a["3566907763371345"] = "AirParif 8";
								$a["35669077213271345"] = "AirParif 9";
								
								$now = new DateTime();
								$end=$now->format('Y-m-d H:i');
								$now->modify("-1 day");
								$start=$now->format("Y-m-d H:i");
								$st=explode(' ',$start);
								$start=$st[0]."T".$st[1];
								$en=explode(' ',$end);
								$end=$en[0]."T".$en[1];
								if ($dbcpolluscope = pg_Connect("host=localhost port=5432 dbname=polluscope user=postgres password=12345678 "))
								{
									$queryId = pg_exec($dbcpolluscope, "SELECT id,name FROM unified_node ");
									
								?>
								
									<div class="highlights">
										<section>
											<div  class="content2">
												
												<form method='POST' action='' >
												
													<section  float=right>												
														
														<strong><font color=#e60000>Start</strong> <br>
														Date : <input type=date  name='start' value=$start > <br>
														Hour : <input type=time name='hourStart' value=$hourStart  min=0 max=23 > <br><br></font>
														
														<strong><font color=#e60000>End</strong> <br>
														Date : <input type=date name='end' value=$end style='margin-left: 5px' > <br> 
														Hour : <input type=time name='hourEnd' value=$hourEnd min=0 max=23 style='margin-left: 5px' ></font>
													
													</section>
													
													<br>
													
													Sensors Box:<select required id="sensorBox" name='sensorBox'  style="width:107%"> 
														<?php while($row=pg_fetch_array($queryId)) { ?>
															<option value=<?php echo $row[0] ?> > <?php echo $row[1] ?>  </option>
														<?php } ?>								
													</select>
													
													<?php $queryId = pg_exec($dbcpolluscope, "SELECT id,name FROM unified_node ");?>
													<select id = "sensorBox2" name='sensorBox2'  style="width:107%;">
														<option value=NULL >  </option>
														<?php while($row=pg_fetch_array($queryId)) { ?>
															<option value=<?php echo $row[0] ?> > <?php echo $row[1] ?>  </option>
														<?php } ?>
													</select>
													
													Sensors Type:<select name='sensorType' class=button5 style="width:107%" > 
														<option value="pm1.0" > pm1.0</option>
														<option value="pm10"  > pm10</option>
														<option value="pm2.5"  > pm2.5</option>
														<option value="no2"  > no2</option>
														<option value="bc"  > bc</option>
													</select> 
													
													Plot Color 1:<select name='plotColor1' class=button5 style="width:107%" > 
														<option value="red" > Red</option>
														<option value="green" > Green</option>
														<option value="blue" > Blue</option>
														<option value="black" > Black</option>
													</select>
													
													Plot Color 2:<select name='plotColor2' class=button5 style="width:107%" > 
														<option value="red" > Red</option>
														<option value="green" > Green</option>
														<option value="blue" > Blue</option>
														<option value="black" > Black</option>
													</select>
													
														Plot Type:
														<select name='plotType' class=button5 style="width:107%">
															<option value="point" > Point </option>
															<option value="colonne" > Colonne </option>
															<option value="courbe" > Courbe </option>
															<option value="moyenne" > Moyenne en courbe</option>
														</select><br>
													
													
													<input type='submit' value='submit' >
													<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
													
													<script>
													$(document).ready (function() {
														$("#button").click(function(){
															$("#sensorBox2").show();
														});
													});
													</script>-->
													
												</form>
											
												<a href="MyData.csv" ><button >Download CSV</button></a><br><br>									
												<a href="map.png" download='map.png' ><button background-color = 'gainsboro'>Download Map</button></a><br><br>
												<a href="plot.png" download='plot.png'><button>Download Plot1</button></a><br><br>											
												<a href="plot.png" download='plot2.png'><button>Download Plot2</button></a>
											
											
											</div>	
											
											
										</section>
										
										<section>
											
											<div class=content>
											
											
												<?php 
													
													if(isset($_POST['start']) and isset($_POST['end']))
													{  
														$start=$_POST['start'];//result of formt yyyy-mm-ddThh:ii:ss								
														$end=$_POST['end'];														
														$hourStart=$_POST['hourStart'];														
														$hourEnd=$_POST['hourEnd'];														
														$start1=$start." ".$hourStart;
														$end1=$end." ".$hourEnd;
														
														$sensorBox=$_POST['sensorBox'];
														$sensorBox2=$_POST['sensorBox2'];
														$sensorType=$_POST['sensorType'];
														$color = $_POST['plotColor1'];
														$color2 = $_POST['plotColor2'];
														$type = $_POST['plotType'];
														$number=$start1." ".$end1." ".$sensorBox." ".$sensorType." ".$color." ".$type." ".$sensorBox2." ".$color2;

														exec('"C:/Program Files/R/R-3.5.2/bin/Rscript.exe" C:/polluscope/polluscope.R 2>&1 '.$number);// 2>&1 to get the error
														
														if (!is_null($sensorBox2)){
															$var=rand();
															exec("R CMD BATCH polluscope.R ".$number );
															echo "<img src='map.png?$var' width=500px height=350px >";	
															echo "<img src='plot.png?$var' width=500 height=350px > ";
														}
														
														else{
															$var=rand();	
															exec("R CMD BATCH polluscope.R ".$number );
															echo "<img src='map.png?$var' width=500px height=350px >";	
															echo "<img src='plot.png?$var' width=500 height=350px > ";	
															echo "<img src='plot2.png?$var' width=500 height=350px > ";
															echo "<img src='plot3.png?$var' width=500 height=350px > ";
														}
												?>
												
												<br>
												<br>
												<br>
												
											</div>
										
											<div class=content >
												<header>
													<?php 
													}
													
													else{
														$var=rand();
														echo 'bonjour';
														echo"<img src='images/mapEmpty.png?$var' width=500px height=350px >";
														
													}
													
													
													?>
												</header>
											</div>
										
										</section>			
									
									</div>
								
									<?php
								}
								?>
							
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
			
			
			
			
			
			
			
				