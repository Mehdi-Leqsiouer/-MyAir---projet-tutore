
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
								// ini_set('display_errors', 0);
								// Script 11.4 - upload_file.php
								/* This script displays and handles an HTML form. This script takes a file upload and stores it on the server. */
								
								
								
								pg_exec($dbcpolluscope," CREATE TABLE IF NOT EXISTS \"NO2\"
								(
								\"id\" serial,
								\"number\" text,
								\"time\" timestamp with time zone,
								\"level\" double precision,
								\"bat\" integer,
								\"temp\" integer,
								\"humidity\" integer,
								CONSTRAINT \"NO2_pkey\" PRIMARY KEY (\"id\") )
								" );
								
								pg_exec($dbcpolluscope," CREATE TABLE IF NOT EXISTS \"link-canarin-cairsens\"
								(
								id serial,
								canarin_id bigint,
								cairsens_id text,
								CONSTRAINT \"link-canarin-cairsens_pkey\" PRIMARY KEY (id)
								)
								" 
								);
								
								if (isset($_POST['submitted'])) { // Handle the form.
									
									// Try to move the uploaded file:
									if (move_uploaded_file ($_FILES['thefile']['tmp_name'], "Cairsens/{$_FILES['thefile']['name']}")) {
										
										print '<head><center><p><h3 style="margin-left: -40px;"><b>Your file has been uploaded</h3></b></p></center></head>';
										$a=$_FILES['thefile']['name'];		
										$type=explode(".",$a);
										
										$name_file='Cairsens/'.$a;
	                                    // $file = fopen("no2/$a","r");
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
									
									$creat=pg_exec($dbcpolluscope, "SELECT to_regclass('\"public\".\"No2temporary\"')");
									$row=pg_fetch_array($creat);
									
									if($row[0]==null)//if the table was not aleady exist
									{ 
										
										pg_exec($dbcpolluscope, "CREATE TABLE public.\"No2temporary\"
										(
										id serial,
										\"number\" text,
										\"time\" timestamp with time zone,
										level double precision,
										bat integer,
										temp integer,
										humidity integer,
										CONSTRAINT \"No2temporary_pkey\" PRIMARY KEY (id)
										)" );
										
									}
									
									if($type[1]=='xlsx')
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
										
										function array2Table($data) {
											echo '<table>';
											foreach($data as $row) {
												echo "<tr>";
												foreach($row as $cell) {
													echo "<td>" . escape($cell) . "</td>";
												}
												echo "</tr>";
											}
											echo '</table>';
										}
										
										foreach($sheetNames as $sheetName) {
											$sheet = $xlsx->getSheet($sheetName);
											$ar=$sheet->getData();
											
										}
										// print_r($ar);
										$number=$ar[0][1];
										
										for($i=2;$i<sizeof($ar);$i++)
										{
											
											$time=$ar[$i][0];
											$level=$ar[$i][1];
											$bat=$ar[$i][2];
											$temp=$ar[$i][3];
											$humidity=$ar[$i][4]; 
											
											if(gettype($time)==string)
											{
												if ($time = DateTime::createFromFormat('d/m/Y H:i:s',$time)) {
													$time= $time->format('Y/m/d H:i:s');
													$time = date("Y-m-d H:i", strtotime($time));
													$exist=pg_exec($dbcpolluscope, "SELECT * from \"NO2\" where \"number\"='$number' and \"time\"='{$time}' ");
													$row=pg_num_rows($exist);
													if($row==0)
													{
														pg_exec($dbcpolluscope, "INSERT INTO \"NO2\"(\"number\",\"time\",\"level\",\"bat\",\"temp\",\"humidity\")
														VALUES('$number','{$time}','$level','$bat','$temp','$humidity')");	
													}
													pg_exec($dbcpolluscope, "INSERT INTO \"No2temporary\"(\"number\",\"time\",\"level\",\"bat\",\"temp\",\"humidity\")
													VALUES('$number','{$time}','$level','$bat','$temp','$humidity')");
													
												}
												else {
													$time=$ar[$i][0];
													$time = date("Y-m-d H:i", strtotime($time));
													$exist=pg_exec($dbcpolluscope, "SELECT * from \"NO2\" where \"number\"='$number' and \"time\"='{$time}' ");
													$row=pg_num_rows($exist);
													if($row==0)
													{
														pg_exec($dbcpolluscope, "INSERT INTO \"NO2\"(\"number\",\"time\",\"level\",\"bat\",\"temp\",\"humidity\")
														VALUES('$number','{$time}','$level','$bat','$temp','$humidity')");	
													}
													pg_exec($dbcpolluscope, "INSERT INTO \"No2temporary\"(\"number\",\"time\",\"level\",\"bat\",\"temp\",\"humidity\")
													VALUES('$number','{$time}','$level','$bat','$temp','$humidity')");
												}
												
												
											}
											else if(gettype($time)==double)
											{
												
												$seconds = 30;
												$UNIX_DATE = ($time - 25569) * 86400;
												$time=gmdate("Y-m-d H:i:s", $UNIX_DATE);
												$time=date("Y-m-d H:i", (strtotime(date($time)) + $seconds));
												$exist=pg_exec($dbcpolluscope, "SELECT * from \"NO2\" where \"number\"='$number' and \"time\"='{$time}' ");
												$row=pg_num_rows($exist);
												if($row==0)
												{
													pg_exec($dbcpolluscope, "INSERT INTO \"NO2\"(\"number\",\"time\",\"level\",\"bat\",\"temp\",\"humidity\")
													VALUES('$number','{$time}','$level','$bat','$temp','$humidity')");	
												}
												pg_exec($dbcpolluscope, "INSERT INTO \"No2temporary\"(\"number\",\"time\",\"level\",\"bat\",\"temp\",\"humidity\")
												VALUES('$number','{$time}','$level','$bat','$temp','$humidity')");
											}
											
											
										}
										
										// pg_exec($dbcpolluscope,"UPDATE \"No2temporary\"
										// SET  \"time\"= \"time\" - interval '3 months' - interval '16 days'
										// WHERE \"number\"='CNB0100003750' ");
										
									}
									else if($type[1]=='csv') 
									{
										
										$file = fopen("Cairsens/$a","r");
										$data =fgetcsv($file);//read the first line
										$id = explode(";", $data[0]);
										$number=$id[1];
										$data =fgetcsv($file);
										// print_r($data);
										while(! feof($file))
										{  
											$data =fgetcsv($file);
											
											$result= explode(";",$data[0]);
											
											if($result[0]!=null)
											{
												$dt = DateTime::createFromFormat('d/m/Y H:i:s', $result[0]);
											$result[0]=$dt->format('Y-m-d H:i:s');
											
											if($result[1]==null)
											$result[1]='null';
											if($result[2]==null)
											$result[2]='null';
											if($result[3]==null)
											$result[3]='null';
											if($result[4]==null)
											$result[4]='null';
											if($result[5]==null)
											$result[5]='null';										
											
											$exist=pg_exec($dbcpolluscope, "SELECT * from \"NO2\" where \"number\"='$number' and \"time\"='{$result[0]}' ");
											$row=pg_num_rows($exist);
											if($row==0)
											{
											pg_exec($dbcpolluscope, "INSERT INTO \"NO2\"(\"number\",\"time\",\"level\",\"bat\",\"temp\",\"humidity\")
											VALUES('$number','{$result[0]}',$result[1],$result[2],$result[3],$result[4])");
											
											}
											pg_exec($dbcpolluscope, "INSERT INTO \"No2temporary\"(\"number\",\"time\",\"level\",\"bat\",\"temp\",\"humidity\")
											VALUES('$number','{$result[0]}',$result[1],$result[2],$result[3],$result[4])");
											}
											
											
											}
											
											}
											
											
											
											$queryy= pg_exec($dbcpolluscope, "SELECT number, time,\"timestamp\",node_id,level,no2,bc,gps_lng
											FROM (select \"number\", \"canarin_id\",\"time\",\"level\"
											from \"No2temporary\",\"link-canarin-cairsens\"
											where \"No2temporary\".\"number\"=\"link-canarin-cairsens\".\"cairsens_id\") as p
											LEFT OUTER JOIN \"flaten_all_data\" on  p.\"canarin_id\"=\"flaten_all_data\".\"node_id\" and 
											p.\"time\"=\"flaten_all_data\".\"timestamp\"
											order by  \"flaten_all_data\".\"timestamp\" asc  ");
											
											
											
											while ($row = pg_fetch_array($queryy)) {
											
											if($row['node_id']==null ) {// if the column node_id of the join table equal null
											$qu= pg_exec($dbcpolluscope, "SELECT * from flaten_all_data where node_id is null and \"timestamp\"= '{$row['time']}' ");
											if(pg_num_rows($qu)==0)// if the timestamp not already exist at the flat table
											{
											pg_exec($dbcpolluscope, "INSERT INTO flaten_all_data (timestamp,no2)
											VALUES ('{$row['time']}',{$row['level']})");
											}
											else
											{ 
											if($row['level']!=null)
											pg_exec($dbcpolluscope, "update flaten_all_data set no2={$row['level']}  where node_id is null and  \"timestamp\"='{$row['time']}' ");  
											
											}
											
											}
											else
											{   if($row['level']!=null)
										    pg_exec($dbcpolluscope, "update flaten_all_data set no2={$row['level']}  where node_id={$row['node_id']} and \"timestamp\"='{$row['timestamp']}' ");  
											}
											
											}
											
											
											
											pg_exec($dbcpolluscope, "DROP TABLE \"No2temporary\" ");
											
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
											
											
											
											
											
											
											
											
											
											
											<?																																									