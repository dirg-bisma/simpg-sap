<?php 

if(file_exists("../starting") AND isset($_POST['akses'])){
chmod("../starting", 0755);
chmod("proses.php", 0755);
chmod("index.php", 0755);
chmod("../index.php", 0755);
chmod("cek_database.php", 0755);
chmod("db_simpg.sql", 0755);
chmod("../index", 0755);

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