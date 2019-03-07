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
				//echo $ids;

            $Array=array();

#select id, "timestamp", node_id, node_name, gps_lat, gps_lng, gps_alt, temperature, humidity, pressure, "pm2.5", "pm10", "pm1.0", formaldehyde, ST_AsGeoJSON(geom) as geojson from flaten_all_data where node_id IN ('3566907703071345','3566907722371345','3566907742371345','3566907763371345') and timestamp BETWEEN '2000-03-01 09:40' and '2018-03-02 09:41' order by id

       if((isset($_GET['NodeID'])and $query1 = pg_exec($dbcpolluscope,"SELECT id, \"timestamp\", node_id, node_name, gps_lat, gps_lng, gps_alt, avg(temperature) as temperature, avg(humidity) as humidity, avg(pressure) as pressure, avg(\"pm2.5\") as \"pm2.5\", avg(pm10) as pm10, avg(\"pm1.0\") as \"pm1.0\", avg(formaldehyde) as formaldehyde, avg(no2) as no2, bc, ST_AsGeoJSON(geom) as geojson from flaten_all_data where node_id IN ('$ids') and \"timestamp\" BETWEEN '$start1' and '$end1' and geom is not null GROUP BY extract(doy from \"timestamp\"), id having avg(temperature) is not null and avg(humidity) is not null and avg(pressure) is not null and avg(\"pm2.5\") is not null and avg(pm10) is not null and avg(\"pm1.0\") is not null and avg(formaldehyde) is not null order by id "))
                        or $query1 = pg_exec($dbcpolluscope,"select *,ST_AsGeoJSON(geom) as geojson from flaten_all_data where \"timestamp\" BETWEEN '$start1' and '$end1' and geom is not null order by id  ")
                )
            {

                         while ($row = pg_fetch_array($query1)) {

                  $a=array('id'=>$row['id'],'timestamp'=>$row['timestamp'],'node_id'=>$row['node_id'],'gps_lat'=>$row['gps_lat'],'gps_lng'=>$row['gps_lng'],
                 'temperature'=>$row['temperature'],'pressure'=>$row['pressure'],'pm2.5'=>$row['pm2.5'],'pm10'=>$row['pm10'],'pm1.0'=>$row['pm1.0'],
                 'formaldehyde'=>$row['formaldehyde'],/*'no2'=>$row['no2'],'bc'=>$row['bc'],*/'GeoJSON'=>$row['geojson']);

                        array_push($Array,$a);

                 }

                echo json_encode($Array);

        }
        }
        }
?>
