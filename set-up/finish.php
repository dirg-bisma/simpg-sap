<?php 

if(file_exists("../starting") AND isset($_POST['akses'])){
chmod("../starting", 0777);
chmod("proses.php", 0777);
chmod("index.php", 0777);
chmod("../index.php", 0777);
chmod("cek_database.php", 0777);
chmod("db_simpg.sql", 0777);
chmod("../index", 0777);

unlink("index.php");
unlink("../starting");	
rename("../index","../index.php");

unlink("proses.php");
unlink("../index.php");
unlink("cek_database.php");
unlink("db_simpg.sql");


echo "{}";
 
}

?>