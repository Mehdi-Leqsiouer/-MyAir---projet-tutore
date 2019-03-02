<?php

      if ($dbcpolluscope = pg_Connect("host=localhost port=5432 dbname=polluscope user=postgres password=12345678 "))
        {
                if(isset($_GET['DateStart'])and isset($_GET['DateEnd']) )
                {

                if(isset($_GET['NodeID']))
                {$NodeID=$_GET['NodeID'];
             $ids = join("','",$NodeID);
                }

                $start1=$_GET['DateStart'];
                $end1=$_GET['DateEnd'];

            $Array=array();
       if((isset($_GET['NodeID'])and $query1 = pg_exec($dbcpolluscope,"select *,ST_AsGeoJSON(geom) as geojson from flaten_all_data where node_id IN ('$ids') and \"timestamp\" BETWEEN '$start1' and '$end1' order by id  "))
                        or $query1 = pg_exec($dbcpolluscope,"select *,ST_AsGeoJSON(geom) as geojson from flaten_all_data where \"timestamp\" BETWEEN '$start1' and '$end1' order by id  ")
                )
            {

                         while ($row = pg_fetch_array($query1)) {

                  $a=array('id'=>$row['id'],'timestamp'=>$row['timestamp'],'node_id'=>$row['node_id'],'gps_lat'=>$row['gps_lat'],'gps_lng'=>$row['gps_lng'],
                 'temperature'=>$row['temperature'],'pressure'=>$row['pressure'],'pm2.5'=>$row['pm2.5'],'pm10'=>$row['pm10'],'pm1.0'=>$row['pm1.0'],
                 'formaldehyde'=>$row['formaldehyde'],'no2'=>$row['no2'],'bc'=>$row['bc'],'GeoJSON'=>$row['geojson']);

                        array_push($Array,$a);

                 }

                echo json_encode($Array);


        }
        }
        }
?>