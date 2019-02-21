<?php 
	
	if ($dbcpolluscope = pg_Connect("host=localhost port=5432 dbname=polluscope user=postgres password=12345678 "))
	{  
		$creat=pg_exec($dbcpolluscope, "SELECT to_regclass('\"public\".\"unified_node\"')");
		$row=pg_fetch_array($creat);
		if($row[0]==null)//if the table was not aleady exist
		{ 
			pg_exec($dbcpolluscope,"CREATE TABLE if not exists \"unified_node\"
			(
			id bigint NOT NULL,
			name text,
			\"interval\" integer,
			CONSTRAINT id PRIMARY KEY (id)
			)" );
			pg_exec($dbcpolluscope," INSERT INTO \"unified_node\"( id, name, \"interval\") VALUES (3566907703071345, 'AirParif4', 5) " );	
			pg_exec($dbcpolluscope," INSERT INTO \"unified_node\"( id, name, \"interval\") VALUES (3566907722371345, 'AirParif12', 5) " );
			pg_exec($dbcpolluscope," INSERT INTO \"unified_node\"( id, name, \"interval\") VALUES (3566907742371345, 'AirParif11', 5) " );
			pg_exec($dbcpolluscope," INSERT INTO \"unified_node\"( id, name, \"interval\") VALUES (3566907763371345, 'AirParif8', 5) " );
			pg_exec($dbcpolluscope," INSERT INTO \"unified_node\"( id, name, \"interval\") VALUES (4315255293441345, 'AirParif3', 5) " );
			pg_exec($dbcpolluscope," INSERT INTO \"unified_node\"( id, name, \"interval\") VALUES (4316701852319345, 'AirParif7', 5) " );
			pg_exec($dbcpolluscope," INSERT INTO \"unified_node\"( id, name, \"interval\") VALUES (4317218322204134, 'AirParif1', 5) " );
			pg_exec($dbcpolluscope," INSERT INTO \"unified_node\"( id, name, \"interval\") VALUES (35669077103071345, 'AirParif5', 5) " );
			pg_exec($dbcpolluscope," INSERT INTO \"unified_node\"( id, name, \"interval\") VALUES (35669077111271345, 'AirParif10', 5) " );
			pg_exec($dbcpolluscope," INSERT INTO \"unified_node\"( id, name, \"interval\") VALUES (35669077121271345, 'AirParif14', 5) " );
			pg_exec($dbcpolluscope," INSERT INTO \"unified_node\"( id, name, \"interval\") VALUES (35669077133271345, 'AirParif6', 5) " );
			pg_exec($dbcpolluscope," INSERT INTO \"unified_node\"( id, name, \"interval\") VALUES (35669077143371345, 'AirParif16', 5) " );
			pg_exec($dbcpolluscope," INSERT INTO \"unified_node\"( id, name, \"interval\") VALUES (35669077192371345, 'AirParif15', 5) " );
			pg_exec($dbcpolluscope," INSERT INTO \"unified_node\"( id, name, \"interval\") VALUES (35669077213271345, 'AirParif9', 5) " );
			pg_exec($dbcpolluscope," INSERT INTO \"unified_node\"( id, name, \"interval\") VALUES (35669077252071345, 'AirParif13', 5) " );
			pg_exec($dbcpolluscope," INSERT INTO \"unified_node\"( id, name, \"interval\") VALUES (35669077272271345, 'AirParif17', 5) " );
			pg_exec($dbcpolluscope," INSERT INTO \"unified_node\"( id, name, \"interval\") VALUES (43152552141141345, 'AirParif2', 5) " );
			
			
		}
		
	}
	
	
	
	
