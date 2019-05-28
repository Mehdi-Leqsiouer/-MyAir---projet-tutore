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
				
				<link rel="stylesheet" href="assets/css/main2.css" />
				
				<link rel="stylesheet" href="assets/css/m1.css" />
				
				
				
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
								
								pg_exec($dbcpolluscope," CREATE TABLE IF NOT EXISTS \"AE51Qualification\"
														(
														  \"Id\" serial,
														  \"Device_ID\" text,
														  \"Date\" date,
														  \"Time\" time with time zone,
														  \"Ref\" bigint,
														  \"Sen\" bigint,
														  \"ATN\" double precision,
														  \"Flow\" integer,
														  \"Temp\" integer,
														  \"Status\" integer,
														  \"Battery\" integer,
														  \"BC\" bigint,
														  CONSTRAINT \"AE51Qualification_pkey\" PRIMARY KEY (\"Id\") )") ;
								
								
								// Script 11.4 - upload_file.php
								/* This script displays and handles an HTML form. This script takes a file upload and stores it on the server. */
								
								if (isset($_POST['submitted'])) { // Handle the form.
									
									// Try to move the uploaded file:
									if (move_uploaded_file ($_FILES['thefile']['tmp_name'], "AE51Qualification/{$_FILES['thefile']['name']}")) { // we upload the file into images
										
										print '<head><center><p><h3 style="margin-left: -40px;"><b>Your file has been uploaded</h3></b></p></center></head>';
										$a=$_FILES['thefile']['name'];
										$type=explode(".",$a);
	                                    $file = fopen("AE51Qualification/$a","r");
										$name_file='AE51Qualification/'.$a;
										
										} else { // Problem!
										
										print '<head><center><h3 ><b><p style="color: red;">Your file could not be uploaded because:</p></center></head> ';
										
										// Print a message based upon the error:
										switch ($_FILES['thefile']['error']) {
											case 1:
											print 'The file exceeds the upload_max_filesize setting in php.ini';
											break;
											case 2:
											print 'The file exceeds the MAX_FILE_SIZE setting in the HTML form';
											break;
											case 3:
											print 'The file was only partially uploaded';
											break;
											case 4:
											print 'No file was uploaded';
											break;
											case 6:
											print 'The temporary folder does not exist.';
											break;
											default:
											print 'Something unforeseen happened.';
											break;
										}
										
										print '.</p>'; // Complete the paragraph.
										
									} // End of move_uploaded_file( ) IF.
									
								
									
									if($type[1]=='csv') 
									{	
										
										$data =fgetcsv($file);//read the first line
										$data =fgetcsv($file);//read the second line
										$data =fgetcsv($file);
										$data =fgetcsv($file);
										 
										$id = explode("= ", $data[0]);
										
										$data =fgetcsv($file);
										$data =fgetcsv($file);
										$data =fgetcsv($file);
										$data =fgetcsv($file);
										$data =fgetcsv($file);
										$data =fgetcsv($file);
										$data =fgetcsv($file);
										$data =fgetcsv($file);
										$data =fgetcsv($file);
										$data =fgetcsv($file);
										$data =fgetcsv($file);
										$data =fgetcsv($file);
										$data =fgetcsv($file);
										$data =fgetcsv($file);
										
										
										while(! feof($file))
										{
											$data =fgetcsv($file);
											if(strpos($data[4], ',') !== false)
											{
												$k=explode(",",$data[4]);
											    $ATN=$k[0].".".$k[1];
											}
											else{
												$ATN=$data[4];
												}
										
											if($data[2]==null)
											$data[2]='null';
											if($data[3]==null)
											$data[3]='null';
											if($data[4]==null)
											$data[4]='null';
											if($data[5]==null)
											$data[5]='null';
											if($data[6]==null)
											$data[6]='null';
											if($data[7]==null)
											$data[7]='null';
											if($data[8]==null)
											$data[8]='null';
											if($data[9]==null)
											$data[9]='null';
											if($data[0]!=null and $data[1]!=null)
											{  
										
										     $exist=pg_exec($dbcpolluscope, "SELECT * from \"AE51Qualification\" where \"Device_ID\"='$id[1]' and \"Date\"='{$data[0]}' and \"Time\"='{$data[1]}' ");
												$row=pg_num_rows($exist);
												if($row==0)
												{
												pg_exec($dbcpolluscope, "INSERT INTO \"AE51Qualification\"(\"Device_ID\",\"Date\",\"Time\",\"Ref\",\"Sen\",\"ATN\",\"Flow\",\"Temp\",\"Status\",\"Battery\",\"BC\") 
												VALUES('$id[1]','{$data[0]}','{$data[1]}',$data[2],$data[3],$ATN,$data[5],$data[6],$data[7],$data[8],$data[9])");	
												
												
												}
												
											}
											
											
											
										}
										
									}
									else if($type[1]=='xlsx') 
									{   
										date_default_timezone_set('UTC');
										require('XLSXReader.php');
										$xlsx = new XLSXReader($name_file);
										
										$sheetNames = $xlsx->getSheetNames();
										
										function escape($string) {
											return htmlspecialchars($string, ENT_QUOTES);
										}
										
										function debug1($data) {
											echo '<pre>';
											print_r($data);
											echo '</pre>';
										}
										
										foreach($sheetNames as $sheetName) {
											$sheet = $xlsx->getSheet($sheetName);
											
											
											$ar=$sheet->getData();
										}
										
										$device=explode("= ",$ar[2][0]);
										
										
										for($i=17;$i<sizeof($ar);$i++)
										{  
											
											$date=(int)$ar[$i][0];
											$time=(float)$ar[$i][1];
											$Ref=$ar[$i][2];
											$Sen=$ar[$i][3];
											$ATN=$ar[$i][4];
											$Flow=$ar[$i][5];
											$Temp=$ar[$i][6];
											$Status=$ar[$i][7];
											$Battery=$ar[$i][8];
											$BC=$ar[$i][9];
											if($Ref==null)
											$Ref='null';
											if($Sen==null)
											$Sen='null';
											if($ATN==null)
											$ATN='null';
											if($Flow==null)
											$Flow='null';
											if($Temp==null)
											$Temp='null';
											if($Battery==null)
											$Battery='null';
											if($BC==null)
											$BC='null';
											
											
											$EXCEL_DATE=$date+$time;
											$date=date('Y-m-d', ($EXCEL_DATE - 25569)*24*60*60 );
											////////////////////////////////////////////////////////////////// 
											$time=date('H:i:s', ($EXCEL_DATE - 25569)*24*60*60 );
											$seconds = 30;
										    $time=date("H:i", (strtotime(date($time)) + $seconds));
											////////////////////////////////////////////////////////////////// to give an exact time from excel to php
											
											if($date!=null and $time[1]!=null)
											{   
										
										        $exist=pg_exec($dbcpolluscope, "SELECT * from \"AE51Qualification\" where \"Device_ID\"='$device[1]' and \"Date\"='$date' and \"Time\"='$time' ");
												$row=pg_num_rows($exist);
												if($row==0)
												{
												pg_exec($dbcpolluscope, "INSERT INTO \"AE51Qualification\"(\"Device_ID\",\"Date\",\"Time\",\"Ref\",\"Sen\",\"ATN\",\"Flow\",\"Temp\",\"Status\",\"Battery\",\"BC\") 
												VALUES('$device[1]','$date','$time',$Ref,$Sen,$ATN,$Flow,$Temp,$Status,$Battery,$BC)");	
													
												}
											}
											
											
										}
										
										
										
									}
									
							
								
									
									
								} // End of submission IF.
								
								// Leave PHP and display the form:
								
								
							?> 
							
							<div class="highlights">
								<section>
									<div  class="content">
										
										<form action='' enctype="multipart/form-data" method="post">
											<p><h3 ><b>Upload a file using this form</h3></b></p>
											<p>
												<input type="hidden" name="MAX_FILE_SIZE" value="128000000" />
												<input type="file" name="thefile"  />
												
												<input type="submit" name="submit" value="Upload This File" class=button1  />
											</p>
											<input type="hidden" name="submitted" value="true" />
										</form>
									</div>
								</section>
								
								
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
				
				
				
				
				
				
				
								