
	  


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

<div class="table-responsive">
					<table class="table table-striped table-bordered" >
						<tbody>	
					
					<tr>
						<td width='30%' class='label-view text-right'>Nopol Truk</td>
						<td><?php echo $row['nopol_truk'] ;?> </td>
						<td width='30%' class='label-view text-right'>No rangka</td>
						<td><?php echo $row['norangka'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Namatruk</td>
						<td><?php echo $row['namatruk'] ;?> </td>
						
						<td width='30%' class='label-view text-right'>IMEI</td>
						<td><?php echo $row['imei'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Latitude</td>
						<td><?php echo $row['latitude'] ;?> </td>
						<td width='30%' class='label-view text-right'>Longitude</td>
						<td><?php echo $row['longitude'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Last Update</td>
						<td><?php echo $row['last_update'] ;?> </td>
						<td width='30%' class='label-view text-right'>Rfid Sticker</td>
						<td><?php echo $row['rfid_sticker'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>No Hp</td>
						<td><?php echo $row['no_hp'] ;?> </td>
						
					</tr>
				
						</tbody>	
					</table> 


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

      var mymap = L.map('mapid').setView([-8.2412627,113.5032091], 12);
      L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 20,
    subdomains:['mt0','mt1','mt2','mt3'] 
  //  id: 'mapbox.streets',
   // accessToken: 'pk.eyJ1Ijoia3J1YWt6IiwiYSI6IjEyYzg2MTgyMGIyMzE3MDFjYmI3YjAxNzM3MjRlMzY1In0.ub6D64RDGjZiA7YuUKKpzg'
}).addTo(mymap);

      var geo = L.geoJson({features:[]},{onEachFeature:function popUp(f,l){
        var out = [];
        if (f.properties){
          var x = 0;
            for(var key in f.properties){
              if(x > 16){
              out.push(key+" : "+f.properties[key]);
            }
              x++;
        }
        l.bindPopup(out.join("<br />"));
    }
}}).addTo(mymap);
      var base = '<?=base_url(CNF_PLANCODE."TS.zip");?>';
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

    var pabrikIco = L.icon({
        iconUrl: 'http://ptpn11.co.id/assets/ptpn/dist/img/pabrik2.png',
        iconSize: [40, 40],
        iconAnchor: [16, 37],
        popupAnchor: [0, -28]
    });

    var truk = [];
    var showdata = "Loading..";
    var pointList = [];
      $.ajax({
            url: "<?=site_url('mmtruckgps/historytruck');?>/<?=$row['id_gps_server'];?>",
            dataType: "json",
            type: "POST",
            
            success: function(data){

                //openWebsocket();
                $.each(data, function(a,x){
                	pointList[a] = new L.LatLng(x.latitude, x.longitude);
                });


                var firstpolyline = new L.Polyline(pointList, {
				    color: 'red',
				    weight: 3,
				    opacity: 0.5,
				    smoothFactor: 1
				});
				firstpolyline.addTo(mymap);

               for (i = 0; i < locations.length; i++) { 

             var mrk = new L.marker([locations[i][1], locations[i][2]]);
                      mrk.addTo(mymap).bindPopup(" "+locations[i][0]+" "); 
                      mrk.setIcon(pabrikIco);
        }
            }
        });

        

        var locations = [
      ['PG Soedhono', -7.497223, 111.420054, 1],
      ['PG Poerwodadie', -7.570894, 111.422953, 2],
      ['PG Redjosarie', -7.689866, 111.414551, 3],
      ['PG Pagottan', -7.702408, 111.537895, 4],
      ['PG Kanigoro', -7.660795, 111.538461, 5],
      ['PG Kedawoeng', -7.746745, 112.991578, 6],
      ['PG Wonolangan', -7.766801, 113.246646, 7],
      ['PG Gending', -7.811100, 113.311992, 8],
      ['PG Padjarakan', -7.779382, 113.356480, 9],
      ['PG Djatiroto', -8.125943, 113.363649, 10],
      ['PG Semboro', -8.206887, 113.444577, 11],
      ['PG Wringinanom', -7.707506, 113.968855, 12],
      ['PG Olean', -7.705527, 114.005961, 13],
      ['PG Pandjie', -7.698221, 114.030953, 14],
      ['PG Assembagoes', -7.751207, 114.229829, 15],
      ['PG Pradjekan', -7.811111, 113.972778, 16],
    ];

        function fshowdata(e){
          updateStatus();
            var popup = e.target.getPopup();
            var id = e.target.options.customId;
             $.ajax({
            url: "<?=site_url('mmtruckgps/detailtruck');?>/"+id,
            dataType: "json",
            type: "POST",
            success: function(data){
                //console.log(data);
                if(data.status == 2){
                  stt = "On Task";
                }else{
                  stt = "Free";
                }

                popup.setContent("NOPOL : <b>"+data.nopol+"</b><br />HP GPS : <b>"+data.no_hp+"</b><br />STATUS : <b>"+stt+"</b><br />SPTA : <b>"+data.no_spat+"</b><br />PETAK : <b>"+data.kode_blok+"</b><br />DESK : <b>"+data.deskripsi_blok+"</b><br />AFD : <b>"+data.divisi+"</b><br />VENDOR : <b>"+data.nama_vendor+"</b>");
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
                      if(v.status == 2){
                        truk[v.id_gps_server].setIcon(onIco);
                      }else{
                        truk[v.id_gps_server].setIcon(freeIco);
                      }
                     }
                });
            }
        });

             for (i = 0; i < locations.length; i++) { 

             var mrk = new L.marker([locations[i][1], locations[i][2]]);
                      mrk.addTo(mymap).bindPopup(" "+locations[i][0]+" "); 
                      mrk.setIcon(pabrikIco);
        }
      }

        


        


        
    </script>
   
