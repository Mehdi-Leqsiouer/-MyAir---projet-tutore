# install.packages('ggmap()')
# library(ggmap)
# library(ggplot2)
# library(ggthemes)

setwd("C:/polluscope")
args <- commandArgs(TRUE)
start_date<-paste(args[1],args[2],sep=" ")
end_date<-paste(args[3],args[4],sep=" ")
sensor_box<-args[5]
sensor_type<-args[6]
colorPlot<-args[7]
typePlot<-args[8]
sensor_box2<-args[9]
colorPlot2<-args[10]

#start_date<-"2018-03-07 00:00"
#end_date<-"2018-03-15 23:10"
#sensor_box<-4317218322204134
#sensor_box2<-NULL
#typePlot<-"point"
#sensor_type<-"pm1.0"
#colorPlot<-"red"
#colorPlot2<-"blue"

.libPaths('C:/Users/flori/OneDrive/Documents/R/win-library/3.6')#to indicate the path to the libraries when run the script through php
require('RPostgreSQL')
require('ggplot2')
require('ggmap')

con=dbConnect(PostgreSQL(),
              user="postgres",dbname="polluscope",password="12345678")
sqlStatement2 <-paste0("select name FROM unified_node where id='",sensor_box,"'"  )
out2 = dbGetQuery(con,sqlStatement2)
if (sensor_box2 != "NULL") {
  sqlStatement3 <-paste0("select name FROM unified_node where id='",sensor_box2,"'"  )
  out3 = dbGetQuery(con,sqlStatement3)
}



sqlStatement <- paste0("select * from flaten_all_data where node_id='", sensor_box ,"' and timestamp between '", start_date ,"' and '", end_date ,"'  ")
out=dbGetQuery(con, sqlStatement)
write.csv(out, file = "MyData.csv",row.names = FALSE)
png(filename="plot.png",width=500,height=500)# open or creat the png file

switch(typePlot,
       point={
         if(sensor_type=="pm1.0")
           p<- ggplot(out, aes(out$timestamp, out$pm1.0, color='pm1.0')) + geom_point(color=colorPlot)+ labs(x = "timestamp ", y=sensor_type ,title = out2$name)
         if(sensor_type=="pm10")
           p<- ggplot(out, aes(out$timestamp, out$pm10, color='pm10')) + geom_point(color=colorPlot)+ labs(x = "timestamp ", y=sensor_type ,title = out2$name)
         if(sensor_type=="pm2.5")
           p<- ggplot(out, aes(out$timestamp, out$pm2.5, color='pm2.5')) + geom_point(color=colorPlot)+ labs(x = "timestamp ", y=sensor_type ,title = out2$name)
         if(sensor_type=="no2")
           p<- ggplot(out, aes(out$timestamp, out$no2, color='no2')) + geom_point(color=colorPlot)+ labs(x = "timestamp ", y=sensor_type ,title = out2$name)
         if(sensor_type=="bc")
           p<- ggplot(out, aes(out$timestamp, out$bc, color='bc')) + geom_point(color=colorPlot)+ labs(x = "timestamp ", y=sensor_type ,title = out2$name)
       },
       colonne={  
         if(sensor_type=="pm1.0")
           p<- ggplot(out, aes(out$timestamp, out$pm1.0, color='pm1.0')) + geom_bar(stat="identity" , color = colorPlot) + labs(x = "timestamp ", y=sensor_type ,title = out2$name)
         if(sensor_type=="pm10")
           p<- ggplot(out, aes(out$timestamp, out$pm10, color='pm10')) + geom_bar(stat="identity", color = colorPlot) + labs(x = "timestamp ", y=sensor_type ,title = out2$name)
         if(sensor_type=="pm2.5")
           p<- ggplot(out, aes(out$timestamp, out$pm2.5, color='pm2.5')) + geom_bar(stat="identity", color = colorPlot) + labs(x = "timestamp ", y=sensor_type ,title = out2$name)
         if(sensor_type=="no2")
           p<- ggplot(out, aes(out$timestamp, out$no2, color='no2')) + geom_bar(stat="identity", color = colorPlot) + labs(x = "timestamp ", y=sensor_type ,title = out2$name)
         if(sensor_type=="bc")
           p<- ggplot(out, aes(out$timestamp, out$bc, color='bc')) + geom_bar(stat="identity", color = colorPlot) + labs(x = "timestamp ", y=sensor_type ,title = out2$name)
       },
       courbe={
         if(sensor_type=="pm1.0")
           p<- ggplot(out, aes(out$timestamp, out$pm1.0, color='pm1.0')) + geom_line() + labs(x = "timestamp ", y=sensor_type ,title = out2$name)
         if(sensor_type=="pm10")
           p<- ggplot(out, aes(out$timestamp, out$pm10, color='pm10')) + geom_line() + labs(x = "timestamp ", y=sensor_type ,title = out2$name)
         if(sensor_type=="pm2.5")
           p<- ggplot(out, aes(out$timestamp, out$pm2.5, color='pm2.5')) + geom_line() + labs(x = "timestamp ", y=sensor_type ,title = out2$name)
         if(sensor_type=="no2")
           p<- ggplot(out, aes(out$timestamp, out$no2, color='no2')) + geom_line() + labs(x = "timestamp ", y=sensor_type ,title = out2$name)
         if(sensor_type=="bc")
           p<- ggplot(out, aes(out$timestamp, out$bc, color='bc')) + geom_line() + labs(x = "timestamp ", y=sensor_type ,title = out2$name)
       },
       moyenne={
         if(sensor_type=="pm1.0")
           p<- ggplot(out, aes(out$timestamp, out$pm1.0, color='pm1.0')) + geom_smooth(color = colorPlot) + labs(x = "timestamp ", y=sensor_type ,title = out2$name)
         if(sensor_type=="pm10")
           p<- ggplot(out, aes(out$timestamp, out$pm10, color='pm10')) + geom_smooth(color = colorPlot) + labs(x = "timestamp ", y=sensor_type ,title = out2$name)
         if(sensor_type=="pm2.5")
           p<- ggplot(out, aes(out$timestamp, out$pm2.5, color='pm2.5')) + geom_smooth(color = colorPlot) + labs(x = "timestamp ", y=sensor_type ,title = out2$name)
         if(sensor_type=="no2")
           p<- ggplot(out, aes(out$timestamp, out$no2, color='no2')) + geom_smooth(color = colorPlot) + labs(x = "timestamp ", y=sensor_type ,title = out2$name)
         if(sensor_type=="bc")
           p<- ggplot(out, aes(out$timestamp, out$bc, color='bc')) + geom_smooth(color = colorPlot) + labs(x = "timestamp ", y=sensor_type ,title = out2$name)
       },
       {
         print('default')
       }
)
p
dev.off()


if ( sensor_box2 != "NULL") {
  sqlStatement <- paste0("select * from flaten_all_data where node_id='", sensor_box2 ,"' and timestamp between '", start_date ,"' and '", end_date ,"'  ")
  out2=dbGetQuery(con, sqlStatement)
  switch(typePlot,
         point={
           if(sensor_type=="pm1.0")
             p2<- ggplot(out2, aes(out2$timestamp, out2$pm1.0, color='pm1.0')) + geom_point(color = colorPlot2) + labs(x = "timestamp ", y=sensor_type ,title = out3$name)
           if(sensor_type=="pm10")
             p2<- ggplot(out2, aes(out2$timestamp, out2$pm10, color='pm10')) + geom_point(color = colorPlot2) + labs(x = "timestamp ", y=sensor_type ,title = out3$name)
           if(sensor_type=="pm2.5")
             p2<- ggplot(out2, aes(out2$timestamp, out2$pm2.5, color='pm2.5')) + geom_point(color = colorPlot2) + labs(x = "timestamp ", y=sensor_type ,title = out3$name)
           if(sensor_type=="no2")
             p2<- ggplot(out2, aes(out2$timestamp, out2$no2, color='no2'))+ geom_point(color = colorPlot2) + labs(x = "timestamp ", y=sensor_type ,title = out3$name)
           if(sensor_type=="bc")
             p2<- ggplot(out2, aes(out2$timestamp, out2$bc, color='bc')) + geom_point(color = colorPlot2) + labs(x = "timestamp ", y=sensor_type ,title = out3$name)
         },
         colonne={
           if(sensor_type=="pm1.0")
             p2<- ggplot(out2, aes(out2$timestamp, out2$pm1.0, color='pm1.0')) + geom_bar(stat="identity", color = colorPlot2) + labs(x = "timestamp ", y=sensor_type ,title = out3$name)
           if(sensor_type=="pm10")
             p2<- ggplot(out2, aes(out2$timestamp, out2$pm10, color='pm10')) + geom_bar(stat="identity", color = colorPlot2) + labs(x = "timestamp ", y=sensor_type ,title = out3$name)
           if(sensor_type=="pm2.5")
             p2<- ggplot(out2, aes(out2$timestamp, out2$pm2.5, color='pm2.5')) + geom_bar(stat="identity", color = colorPlot2) + labs(x = "timestamp ", y=sensor_type ,title = out3$name)
           if(sensor_type=="no2")
             p2<- ggplot(out2, aes(out2$timestamp, out2$no2, color='no2')) + geom_bar(stat="identity", color = colorPlot2) + labs(x = "timestamp ", y=sensor_type ,title = out3$name)
           if(sensor_type=="bc")
             p2<- ggplot(out2, aes(out2$timestamp, out2$bc, color='bc')) + geom_bar(stat="identity", color = colorPlot2) + labs(x = "timestamp ", y=sensor_type ,title = out3$name)
         },
         courbe={
           if(sensor_type=="pm1.0")
             p2<- ggplot(out2, aes(out2$timestamp, out2$pm1.0, color='pm1.0')) + geom_line(color = colorPlot2)+ labs(x = "timestamp ", y=sensor_type ,title = out3$name)
           if(sensor_type=="pm10")
             p2<- ggplot(out2, aes(out2$timestamp, out2$pm10, color='pm10')) + geom_line(color = colorPlot2)+ labs(x = "timestamp ", y=sensor_type ,title = out3$name)
           if(sensor_type=="pm2.5")
             p2<- ggplot(out2, aes(out2$timestamp, out2$pm2.5, color='pm2.5')) + geom_line(color = colorPlot2)+ labs(x = "timestamp ", y=sensor_type ,title = out3$name)
           if(sensor_type=="no2")
             p2<- ggplot(out2, aes(out2$timestamp, out2$no2, color='no2')) + geom_line(color = colorPlot2)+ labs(x = "timestamp ", y=sensor_type ,title = out3$name)
           if(sensor_type=="bc")
             p2<- ggplot(out2, aes(out2$timestamp, out2$bc, color='bc')) + geom_line(color = colorPlot2)+ labs(x = "timestamp ", y=sensor_type ,title = out3$name)
         },
         moyenne={
           if(sensor_type=="pm1.0")
             p2<- ggplot(out2, aes(out2$timestamp, out2$pm1.0, color='pm1.0')) + geom_smooth(color = colorPlot2) + labs(x = "timestamp ", y=sensor_type ,title = out3$name)
           if(sensor_type=="pm10")
             p2<- ggplot(out2, aes(out2$timestamp, out2$pm10, color='pm10')) + geom_smooth(color = colorPlot2) + labs(x = "timestamp ", y=sensor_type ,title = out3$name)
           if(sensor_type=="pm2.5")
             p2<- ggplot(out2, aes(out2$timestamp, out2$pm2.5, color='pm2.5')) + geom_smooth(color = colorPlot2) + labs(x = "timestamp ", y=sensor_type ,title = out3$name)
           if(sensor_type=="no2")
             p2<- ggplot(out2, aes(out2$timestamp, out2$no2, color='no2')) + geom_smooth(color = colorPlot2) + labs(x = "timestamp ", y=sensor_type ,title = out3$name)
           if(sensor_type=="bc")
             p2<- ggplot(out2, aes(out2$timestamp, out2$bc, color='bc')) + geom_smooth(color = colorPlot2) + labs(x = "timestamp ", y=sensor_type ,title = out3$name)
         },
         {
           print('default')
         }
  )
  
  sqlStatement4 <- paste0("select u1.*
                         from flaten_all_data as u1
                         full join flaten_all_data as u2 on u2.id=u1.id
                         where u1.timestamp between '",start_date,"' and '",end_date,"'
                         and (u1.node_id='",sensor_box,"' or u2.node_id='",sensor_box2,"')" )
  
  out4=dbGetQuery(con, sqlStatement4)
  switch(typePlot,
         point={
           if(sensor_type=="pm1.0")
             p3<- ggplot(data=out4, aes(out4$timestamp, out4$pm1.0, color=node_name))+ geom_point() + labs(x = "timestamp ", y=sensor_type ,title = "Comparaison")
           if(sensor_type=="pm10")
             p3<- ggplot(data=out4, aes(out4$timestamp, out4$pm10, color=node_name)) + geom_point() + labs(x = "timestamp ", y=sensor_type ,title = "Comparaison")
           if(sensor_type=="pm2.5")
             p3<- ggplot(data=out4, aes(out4$timestamp, out4$pm2.5, color=node_name)) + geom_point() + labs(x = "timestamp ", y=sensor_type ,title = "Comparaison")
           if(sensor_type=="no2")
             p3<- ggplot(data=out4, aes(out4$timestamp, out4$no2, color=node_name))+ geom_point() + labs(x = "timestamp ", y=sensor_type ,title = "Comparaison")
           if(sensor_type=="bc")
             p3<- ggplot(data=out4, aes(out4$timestamp, out4$bc, color=node_name)) + geom_point() + labs(x = "timestamp ", y=sensor_type ,title = "Comparaison")
         },
         colonne={
           if(sensor_type=="pm1.0")
             p3<- ggplot(data=out4, aes(out4$timestamp, out4$pm1.0, color=node_name)) + geom_bar(stat="identity") + labs(x = "timestamp ", y=sensor_type ,title = "Comparaison")
           if(sensor_type=="pm10")
             p3<- ggplot(data=out4, aes(out4$timestamp, out4$pm10, color=node_name)) + geom_bar(stat="identity") + labs(x = "timestamp ", y=sensor_type ,title = "Comparaison")
           if(sensor_type=="pm2.5")
             p3<- ggplot(data=out4, aes(out4$timestamp, out4$pm2.5, color=node_name)) + geom_bar(stat="identity") + labs(x = "timestamp ", y=sensor_type ,title = "Comparaison")
           if(sensor_type=="no2")
             p3<- ggplot(data=out4, aes(out4$timestamp, out4$no2, color=node_name)) + geom_bar(stat="identity") + labs(x = "timestamp ", y=sensor_type ,title = "Comparaison")
           if(sensor_type=="bc")
             p3<- ggplot(data=out4, aes(out4$timestamp, out4$bc, color=node_name)) + geom_bar(stat="identity") + labs(x = "timestamp ", y=sensor_type ,title = "Comparaison")
         },
         courbe={
           if(sensor_type=="pm1.0")
             p3<- ggplot(data=out4, aes(out4$timestamp, out4$pm1.0, color=node_name)) + geom_line()+ labs(x = "timestamp ", y=sensor_type ,title = "Comparaison")
           if(sensor_type=="pm10")
             p3<- ggplot(data=out4, aes(out4$timestamp, out4$pm10, color=node_name)) + geom_line()+ labs(x = "timestamp ", y=sensor_type ,title = "Comparaison")
           if(sensor_type=="pm2.5")
             p3<- ggplot(data=out4, aes(out4$timestamp, out4$pm2.5, color=node_name)) + geom_line()+ labs(x = "timestamp ", y=sensor_type ,title = "Comparaison")
           if(sensor_type=="no2")
             p3<- ggplot(data=out4, aes(out4$timestamp, out4$no2, color=node_name)) + geom_line()+ labs(x = "timestamp ", y=sensor_type ,title = "Comparaison")
           if(sensor_type=="bc")
             p3<- ggplot(data=out4, aes(out4$timestamp, out4$bc, color=node_name)) + geom_line()+ labs(x = "timestamp ", y=sensor_type ,title = "Comparaison")
         },
         moyenne={
           if(sensor_type=="pm1.0")
             p3<- ggplot(data=out4, aes(out4$timestamp, out4$pm1.0, color=node_name)) + geom_smooth() + labs(x = "timestamp ", y=sensor_type ,title = "Comparaison")
           if(sensor_type=="pm10")
             p3<- ggplot(data=out4, aes(out4$timestamp, out4$pm10, color=node_name)) + geom_smooth() + labs(x = "timestamp ", y=sensor_type ,title = "Comparaison")
           if(sensor_type=="pm2.5")
             p3<- ggplot(data=out4, aes(out4$timestamp, out4$pm2.5, color=node_name)) + geom_smooth() + labs(x = "timestamp ", y=sensor_type ,title = "Comparaison")
           if(sensor_type=="no2")
             p3<- ggplot(data=out4, aes(out4$timestamp, out4$no2, color=node_name)) + geom_smooth() + labs(x = "timestamp ", y=sensor_type ,title = "Comparaison")
           if(sensor_type=="bc")
             p3<- ggplot(data=out4, aes(out4$timestamp, out4$bc, color=node_name)) + geom_smooth() + labs(x = "timestamp ", y=sensor_type ,title = "Comparaison")
         },
         {
           print('default')
         }
  )
  
  
  
}



png(filename="plot2.png",width=500,height=500)# open or creat the png file
p2

dev.off()


dev.set(5)
png(filename="plot3.png",width=500,height=500)# open or creat the png file
p3
dev.off()



register_google(key = "AIzaSyBd4BvkehJr6z4Umr9yh83WY4C2FC0XwXk")
png(filename="map.png",width=500,height=500)# opening or creating the png file
lx_map <- get_map(location = c(2.3272305000000415 ,48.8635517), maptype = "roadmap", zoom = 12)
if (sensor_box2 != "NULL") {
  ggmap(lx_map, extent = "device")+ geom_point(data=out, aes(x=out$gps_lng, y=out$gps_lat),size=4, color=colorPlot) + geom_point(data=out2, aes(x=out2$gps_lng, y=out2$gps_lat),size=4, color="purple")
}
if (sensor_box2 == "NULL") {
  ggmap(lx_map, extent = "device")+ geom_point(data=out, aes(x=out$gps_lng, y=out$gps_lat),size=4, color=colorPlot)
}
dev.off()

library(leaflet)

if (sensor_box2 != "NULL"){
  sqlStatement <- paste0("select * from flaten_all_data where node_id='", sensor_box2 ,"' and timestamp between '", start_date ,"' and '", end_date ,"'  ")
  out2=dbGetQuery(con, sqlStatement)
  
  if (sensor_type == "pm1.0"){
    pollution2 = out2$pm1.0
    pollution1 = out$pm1.0
  }
    
  if (sensor_type == "pm10"){
    pollution2 = out2$pm10
    pollution1 = out$pm10
  }
    
  if (sensor_type == "pm2.5"){
    pollution2 = out2$pm2.5
    pollution1 = out$pm2.5
  }
    
  if (sensor_type == "no2"){
    pollution2 = out2$no2
    pollution1 = out$no2
  }
   
  if (sensor_type == "bc"){
    pollution2 = out2$bc
    pollution1 = out$bc
  }
   
  
  villes <- data.frame(time1 = out2$timestamp,
                       Latitude1 = out2$gps_lat,
                       Longitude1 = out2$gps_lng,
                       id_capteur1 = out2$node_id,
                       degre2 = pollution2)
  couleurs2 <- colorNumeric(c("#FCAB8F", "#FAF187", "#FFFFFF"), villes$degre2, n = 3)

  m <- leaflet(villes) %>% addTiles() %>%
    addCircles(lng = ~Longitude1, lat = ~Latitude1, weight = 1,
               radius = ~degre2*2, popup = ~paste("Date :",time1," / Second capteur :",id_capteur1),
               color = ~couleurs2(degre2), fillOpacity = 0.02)
  
  m <- addCircles(m, data=villes, lng = ~out$gps_lng, lat = ~out$gps_lat, weight = 1,
                  radius = ~pollution1, popup = ~paste("Date :",out$timestamp," / Premier capteur :",out$node_id),
                  color = "#FF0000", fillOpacity = 0.1)

  m <- addPolylines(m, data = villes,lat = ~out2$gps_lat, lng = ~out2$gps_lng)
  m <- addPolylines(m, data = villes,lat = ~out$gps_lat, lng = ~out$gps_lng, color = "#00FF00", fillOpacity = 0.015 )
  library(htmlwidgets)
  saveWidget(m, 'map.html', selfcontained = TRUE)
  
}
if(sensor_box2 == "NULL"){
  if (sensor_type == "pm1.0"){
    pollution = out$pm1.0
  }
  
  if (sensor_type == "pm10"){
    pollution = out$pm10
  }
  
  if (sensor_type == "pm2.5"){
    pollution = out$pm2.5
  }
  
  if (sensor_type == "no2"){
    pollution = out$no2
  }
  
  if (sensor_type == "bc"){
    pollution = out$bc
  }
  
  villes <- data.frame(time = out$timestamp,
                       Latitude = out$gps_lat,
                       Longitude = out$gps_lng,
                       id_capteur = out$node_id,
                       degre = pollution)
  couleurs <- colorNumeric(c("#FCAB8F", "#FAF187", "#FFFFFF"), villes$degre, n = 3)
  m <- leaflet(villes) %>% addTiles() %>%
    addCircles(lng = ~Longitude, lat = ~Latitude, weight = 1,
               radius = ~degre*2, popup = ~paste("Date :",time," / Capeur :",id_capteur),
               color = ~couleurs(degre), fillOpacity = 0.02)
  
  m <- addPolylines(m, data = villes,lat = ~out$gps_lat, lng = ~out$gps_lng)
  
  library(htmlwidgets)
  saveWidget(m, 'map.html', selfcontained = TRUE)
}

dbDisconnect(con)

