
	<?php 
	session_start();
		if ($dbcpolluscope = pg_Connect("host=localhost port=5432 dbname=polluscope user=postgres password=12345678 "))
		{ 
	        
			if($queryId = pg_exec($dbcpolluscope, "SELECT id FROM unified_node ") )
			{
				
			$Array=array();
			while ($row = pg_fetch_array($queryId)) {		
			array_push($Array,$row[0]);	
		    }
		    $Array2=array("node_id"=>$Array);
			
		    echo json_encode($Array2);	
			
			}
			
			
		}
		
	?>
