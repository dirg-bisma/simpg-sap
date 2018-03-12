<?php 

if(file_exists("../starting") AND isset($_POST['akses'])){
unlink("../starting");	
unlink("proses.php");
unlink("index.php");
unlink("../index.php");
unlink("cek_database.php");
unlink("db_simpg.sql");
//rename('../set-up',realpath('../env');
rename('../index','../index.php');

echo "{}";

}

?>