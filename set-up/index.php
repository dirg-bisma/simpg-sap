<!doctype html>
<?php 

function siteURL()
{
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $domainName = $_SERVER['HTTP_HOST'].'/';
    return $protocol.$domainName;
}


$dir=$_SERVER['REQUEST_URI'];
$dir=trim($dir,"/");
$dir=explode("/", $dir);

$hasil="";
if(($j=count($dir))>2){
	for ($i=0; $i <= $j-2 ; $i++) { 
		$hasil.=$dir[$i].'/';
	}
} else if(count($dir)>1) {
	$hasil=$dir[0];

} else if(count($dir)==1){
	$hasil="";
}

$dir=trim($hasil,"/");

 ?>


<html>
<head>
	<title>Instalasi SIMPG PT Perkebunan Nusantara</title>

<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="assets/ionicons/css/ionicons.min.css">

<style type="text/css">

	body {
		background-color: #ccc;
	}

</style>

</head>
<body>

<div class="container">

	<div class='row' style="text-align: center">

		<h1><span style='color: #f39c12;'>Sistem Informasi Manajemen</span> Pabrik Gula</h1>

	</div>

	<div class='row'>

		<div class='col-md-8 col-md-offset-2' style="margin-bottom: 50px; background: #FFF;border-radius: 5px;">
 			
 			<div class="row" style="padding: 20px">

 				<div class='col-md-12'>

 					<div class="form-group" style="text-align: center; margin-bottom: 60px;">



 						<div style="display: inline-block" >
 							<i  style="font-size: 55px;" id='database-sesi' class="ion ion-ios-box-outline"></i><br>
 							<span style='color: #3c8dbc;;font-weight: bold'>Database</span>
 						</div>

 						<div style="display: inline-block; margin: 0 70px 0 70px" >
 							<i  style="font-size: 45px;" id='informasi-sesi' class="ion ion-arrow-graph-up-right"></i><br>
 							<span style='color: #3c8dbc;font-weight: bold'>Informasi</span>
 						</div>

 						<div style="display: inline-block" >
 							<i  style="font-size: 45px;" id='selesai-sesi' class="ion ion-thumbsup"></i> <br>
 							<span style='color: #3c8dbc;font-weight: bold'>Selesai</span>
 						</div>

 					</div>


 					<div class='form-database' >
					<div class='form-group'>
						<label>Host</label>
						<input type='text' class='form-control' id="host_database" value='localhost' />
					</div>

					<div class='form-group'>
						<label>Nama Database</label>
						<input type='text' class='form-control' id="nama_database" />
					</div>

					<div class='form-group'>
						<label>User Database</label>
						<input type='text' class='form-control' id="user_database" value='root' />
					</div>

					<div class='form-group'>
						<label>Password Database</label>
						<input type='text' class='form-control' id="password_database" />
					</div>

					<div class='form-group'>
						<button class="btn btn-info" id="cek-database">Lanjut</button>
					</div>

				</div>

				<div class="form-informasi" style="display: none">

					<div class="form-group">
						<label>Nama Perusahaan</label>
						<input type="text" class="form-control" id="perusahaan" />
					</div>

					<div class="form-group">
						<label>Nama Unit Usaha</label>
						<input type="text" class="form-control" id="unitusaha" />
					</div>

					<div class="form-group">
						<label>Alamat Nama Unit Usaha</label>
						<input type="text" class="form-control" id="alamatunitusaha" />
					</div>

					<div class="form-group">
						<label>Company Code</label>
						<input type="text" class="form-control" id="companycode" />
					</div>

					<div class="form-group">
						<label>Plan Code</label>
						<input type="text" class="form-control" id="plancode"  />
					</div>

					<div class="form-group">
						<label>Password Admin</label>
						<input type="password" class="form-control" id="password_user" />
					</div>


					<div class="form-group">
						<button class="btn btn-primary" id="setting-informasi">Lanjut</button>
					</div>

				</div>


				<div class='form-finish' style="margin-top: 60px; text-align: center; display:none">

					<i class='ion ion-checkmark-round' style='font-size: 130px; color:green'></i><br>
					<span style="color:green;font-weight: bold">Aplikasi Berhasil Terinstal</span> 

					<br>
					<br>
					<br>
					<button class='btn btn-danger tombol-finish'>Finish! Klik tombol ini</button>
					<br>
					<br>
					<br>
					<div class="alert alert-success" role="alert"><strong>Langkah terakhir</strong>
						<br> 
						- Klik Tombol Finish diatas<br><br>

						<STRONG>Terimah Kasih telah menggunakan aplikasi ini</STRONG>

					</div>

				</div>


 				</div>



 			</div>


		</div>

	</div>

</div>

<div class="modal fade" id="modalError">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Terjadi Kesalahan</h4>
      </div>
      <div class="modal-body">
        <p>Kesalahan:</p>
        <p><span class='kesalahan-status'></span></p>
        <p></p><p></p>
        <p>Silahkan Coba Lagi</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript" src="assets/jquery-1.12.3.min.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>


<script type="text/javascript">

	$(function(){

		var nama_database,
			host_database,
			user_database,
			password_database,

			perusahaan,
			unitusaha,
			alamatunitusaha,
			companycode,
			plancode,
			password_user;



		$(document).on("click","#cek-database",function(){
			var _this=$(this);

			if($("#host_database").val()==""){
				alert("Masukan Host")
				return false;
			}

			if($("#nama_database").val()==""){
				alert("Masukan nama database");
				return false;
			}

			if(!_this[0].memproses){
				_this[0].memproses=true;
				_this.html("memproses...");

				var host=$("#host_database").val();
				var nama=$("#nama_database").val();
				var user=$("#user_database").val();
				var password=$("#password_database").val();

				$.ajax({
					type:"POST",
					data: {
						nama:nama,
						host:host,
						user:user,
						password:password
					},
					url: "cek_database.php",
					cache:false,
					dataType: "json",
					success: function(a){
						if(a.status=='error'){
							alert(a.pesan);
						} else {							
							nama_database=nama;
							host_database=host;
							user_database=user;
							password_database=password;

							$("#database-sesi").attr("class","ion ion-checkmark-circled").css("color","green");
							$(".form-database").slideUp();
							$(".form-informasi").slideDown();
							$("#informasi-sesi").css("font-size","55px");


						}
					},
					error: function(){
						alert("Terjadi kesalahan. Silahkan coba lagi ");
						_this.html("Lanjut");
						_this[0].memproses=false;
					},
					complete: function(){
						_this[0].memproses=false;	
						_this.html("Lanjut");

					}
				});

			}
		});


	$(document).on("click","#setting-informasi",function(){
		
			perusahaan=$("#perusahaan").val();
			unitusaha=$("#unitusaha").val();
			alamatunitusaha=$("#alamatunitusaha").val();
			companycode=$("#companycode").val();
			plancode=$("#plancode").val();
			password_user=$("#password_user").val();
			host_database=$("#host_database").val();
			nama_database=$("#nama_database").val();
			user_database=$("#user_database").val();
			password_database=$("#password_database").val();


		var _this=$(this);
		if(!_this[0].memproses){
			_this[0].memproses=true;

			if(perusahaan==""){
				alert("Masukan nama Perusahaan");
				_this[0].memproses=false;
				$("#perusahaan").focus();
			} else if (unitusaha==""){
				alert("Masukan Unit Usaha");
				_this[0].memproses=false;
				$("#unitusaha").focus();
			} else if(companycode==""){
				alert("Masukan nama companycode");
				_this[0].memproses=false;
				$("#companycode").focus();
			}  else if(password_user.length<8){
				alert("Password minimal 8 karakter");
				_this[0].memproses=false;			
				$("#password_user").focus();		
			} else {
				_this.html("Memproses Database Tunggu Sebentar..Cepet kok !!...");
				
				$.ajax({
					type:"POST",
					url:"proses.php",
					data: {

					nama_database:nama_database,
					host_database:host_database,
					user_database:user_database,
					password_database:password_database,

					perusahaan:perusahaan,
					unitusaha:unitusaha,
					alamatunitusaha:alamatunitusaha,
					companycode:companycode,
					plancode:plancode,
					password_user:password_user

					},
					dataType: "json",
					success: function(a){
						if(a.status=="error"){
							_this.html("Lanjut");
							_this[0].memproses=false;
						} else {
							_this.html("Lanjut");
							_this[0].memproses=false;
							$("#informasi-sesi").attr("class","ion ion-checkmark-circled").css("color","green");
							$(".form-informasi").slideUp();
							$("#selesai-sesi").css("font-size","55px");
							$(".form-finish").slideDown();

						}
					},
					error: function(a,b,c){
					$(".kesalahan-status").html(a.responseText);
					$('#modalError').modal('show')
					_this.html("Lanjut");
					_this[0].memproses=false;	

					}, 
					complete: function(){

					}
				});

			}
		}
	})


	$(document).on("click",".tombol-finish",function(){
		_this=$(this);
		if(!_this[0].memproses){
			//_this[0].memproses=true;
			$.ajax({
				type:"post",
				data:{akses:"ok"},
				url:"finish.php",
				cache:false,
				success: function(data){
					console.log(data);
					//window.location.href="<?php echo siteURL(); ?>"+"<?php echo $dir; ?>";
				}
			})
		}
	}); 


	});

</script>


</body>
</html>