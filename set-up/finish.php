<?php 

if(file_exists("../starting") AND isset($_POST['akses'])){
chmod("../starting", 0777);
chmod("proses.php", 0777);
chmod("index.php", 0777);
chmod("../index.php", 0777);
chmod("cek_database.php", 0777);
chmod("db_simpg.sql", 0777);
chmod(realpath("../index"), 0777);


//rename("../index","../index.php");


if(!rename("../index","../index.php")){
	exec("mv ".realpath("../index")." ".realpath("../index.php"));
	echo "gagal";
}
unlink(realpath("index.php"));
unlink(realpath("../starting"));
unlink(realpath("../index"));	


unlink(realpath("proses.php"));
unlink(realpath("cek_database.php"));
unlink(realpath("db_simpg.sql"));


echo "{}";
 
}

?>