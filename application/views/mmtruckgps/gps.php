<link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.0/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>

<script src="https://unpkg.com/leaflet@1.5.0/dist/leaflet.js"
   integrity="sha512-3Wcxp7F9bV2pl+MBgrL6Pz7AJASLpemmQPIiPA0lDs3ImF0z4JuuMIBPeirLbgIuhfH2gJyGWZjvm6M+Zr7L6Q=="
   crossorigin=""></script>

   <script src="http://calvinmetcalf.github.io/shapefile-js/dist/shp.min.js"></script>


<section class="content-header">
          <h1>
            Monitoring
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Monitoring</li>
          </ol>
        </section>


<section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Monitoring</h3>
                
                </div>

   <div class="box-body">

  <div class="page-content-wrapper m-t">
    
<div class="sbox animated fadeIn">
  <div class="sbox-content">  

    <div id="mapid" style="width: 100%;height: 700px"></div>
  
  </div>
</div>


  </div>
</div>
</div>
          </div>
          </div>
        </section>


    <script>

      var mymap = L.map('mapid').setView([-7.7000677, 111.540868], 12);
      L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1Ijoia3J1YWt6IiwiYSI6IjEyYzg2MTgyMGIyMzE3MDFjYmI3YjAxNzM3MjRlMzY1In0.ub6D64RDGjZiA7YuUKKpzg', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox.streets',
    accessToken: 'pk.eyJ1Ijoia3J1YWt6IiwiYSI6IjEyYzg2MTgyMGIyMzE3MDFjYmI3YjAxNzM3MjRlMzY1In0.ub6D64RDGjZiA7YuUKKpzg'
}).addTo(mymap);

      var geo = L.geoJson({features:[]},{onEachFeature:function popUp(f,l){
        var out = [];
        if (f.properties){
          var x = 0;
            for(var key in f.properties){
              if(x > 15){
              out.push(key+" : "+f.properties[key]);
            }
              x++;
        }
        l.bindPopup(out.join("<br />"));
    }
}}).addTo(mymap);
      var base = '<?=base_url("kp04_2019.zip");?>';
    shp(base).then(function(data){
    geo.addData(data);
    });

    var freeIco = L.icon({
        iconUrl: '<?=base_url("logo-free.png");?>',
        iconSize: [40, 40],
        iconAnchor: [16, 37],
        popupAnchor: [0, -28]
    }); 

    var onIco = L.icon({
        iconUrl: '<?=base_url("logo-on.png");?>',
        iconSize: [30, 40],
        iconAnchor: [16, 37],
        popupAnchor: [0, -28]
    });

    var truk = [];
    var showdata = "Loading..";

      $.ajax({
            url: "https://gps.ptpn11.co.id/api/session",
            dataType: "json",
            type: "POST",
            xhrFields: {
       withCredentials: true
    },
    crossDomain: true,
            data: {
                email: "admin",
                password: "admin"
            },
            success: function(sessionResponse){
                console.log(sessionResponse);
                openWebsocket();
            }
        });

        var openWebsocket = function(){
            var ws;
            ws = new WebSocket('wss://gps.ptpn11.co.id/api/socket');

            ws.onopen = function () {
                updateStatus();
           };

            ws.onmessage = function (evt) 
           { 
              var received_msg = evt.data;
              dataparsed = JSON.parse(received_msg);
             // console.log(dataparsed);
              if (dataparsed.positions) {
                  
                  $.each(dataparsed.positions, function(k,v) {
                    if(typeof(truk[v.deviceId])==='undefined')
                     {
                      truk[v.deviceId] = new L.marker([v.latitude, v.longitude],{customId:v.deviceId});
                     
                      truk[v.deviceId].addTo(mymap).bindPopup(showdata);  
                       truk[v.deviceId].on('click', fshowdata );      
                     }
                     else 
                     {
                      truk[v.deviceId].setLatLng([v.latitude, v.longitude]);         
                     }
                  }); 
              }
              

           };

           ws.onclose = function()
           { 
              // websocket is closed.
              console.log("Connection is closed..."); 
           };

           window.onbeforeunload = function(event) {
              socket.close();
           };
        };

        function fshowdata(e){
         // updateStatus();
            var popup = e.target.getPopup();
            var id = e.target.options.customId;
             $.ajax({
            url: "<?=site_url('mmtruckgps/detailtruck');?>/"+id,
            dataType: "json",
            type: "POST",
            success: function(data){
                //console.log(data);
                if(data.status == 1){
                  stt = "On Task";
                }else{
                  stt = "Free";
                }

                popup.setContent("NOPOL : "+data.nopol_truk+"<br />HP GPS : "+data.no_hp+"<br />STATUS : "+stt);
            }
        });
           // console.log(id);
            //popup.setContent(id+" asd");

        } 


        function updateStatus(){
            $.ajax({
            url: "<?=site_url('mmtruckgps/listtruck');?>",
            dataType: "json",
            type: "POST",
            success: function(data){
                console.log(data);
                $.each(data, function(k,v) {
                  
                  if(typeof(truk[v.id_gps_server])!='undefined')
                     {
                      if(v.status == 1){
                        truk[v.id_gps_server].setIcon(onIco);
                      }else{
                        truk[v.id_gps_server].setIcon(freeIco);
                      }
                     }
                });
            }
        });
        }

        


        


        
    </script>
   
