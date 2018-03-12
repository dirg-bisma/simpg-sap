<?php 

if(file_exists("../starting") AND isset($_POST['nama_database'])) {

function parseScript($script) {

  $result = array();
  $delimiter = ';';
  while(strlen($script) && preg_match('/((DELIMITER)[ ]+([^\n\r])|[' . $delimiter . ']|$)/is', $script, $matches, PREG_OFFSET_CAPTURE)) {
    if (count($matches) > 2) {
      $delimiter = $matches[3][0];
      $script = substr($script, $matches[3][1] + 1);
    } else {
      if (strlen($statement = trim(substr($script, 0, $matches[0][1])))) {
        $result[] = $statement;
      }
      $script = substr($script, $matches[0][1] + 1);
    }
  }

  return $result;

}

ini_set('max_execution_time', 1000);
$nama_database=$_POST['nama_database'];
$host_database=$_POST['host_database'];
$user_database=$_POST['user_database'];
$password_database=$_POST['password_database'];

$perusahaan=$_POST['perusahaan'];
$unitusaha=$_POST['unitusaha'];
$alamatunitusaha=$_POST['alamatunitusaha'];
$password_user=md5($_POST['password_user']);
$plancode=$_POST['plancode'];
$companycode=$_POST['companycode'];


$pdo = new PDO("mysql:host=$host_database;dbname=$nama_database", $user_database, $password_database);

$script = file_get_contents("db_simpg.sql");
  $statements = parseScript($script);
  foreach($statements as $statement) {
    $pdo->query($statement);
  }
 
$pdo->query("UPDATE tb_users 
			SET 
				password='$password_user' WHERE username='admin' 
		");

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 32; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    $key= $randomString;






$init="../setting.php";

$string="<?php 
define('CNF_APPNAME','SIMPG');
define('CNF_NAMAPERUSAHAAN','$perusahaan');
define('CNF_PG','$unitusaha');
define('CNF_ALAMAT','$alamatunitusaha');
define('CNF_METAKEY','');
define('CNF_METADESC','');
define('CNF_GROUP','');
define('CNF_ACTIVATION','');
define('CNF_REGIST','');
define('CNF_FRONT','');
define('CNF_THEME','');
define('CNF_MULTILANG','');
define('CNF_RECAPTCHA','');
define('CNF_RECAPTCHA_PUBLIC','6Lc3CgATAAAAAPgCiPghxW05nTD9zkP2PAbTbJ31');
define('CNF_RECAPTCHA_PRIVATE','6Lc3CgATAAAAABGFov6XNNdaTP9xM9ctDLCaGiBw');
define('CNF_LOGINFB','');
define('CNF_LOGINFB_ID','1468944159994855');
define('CNF_LOGINFB_SECRET','8b5b2516044931d1b0c034fe195ed4ec');
define('CNF_LOGINGG','');
define('CNF_LOGINGG_ID','559583753076-52227gi95f7ndiloavemt2ai3ef2bm6g.apps.googleusercontent.com');
define('CNF_LOGINGG_SECRET','nlsH3tidIYC3THzL6inhKy3C');
define('CNF_LOGINTW','');
define('CNF_LOGINTW_ID','fJbc2gx4tIG1ZLzNTbYAaCfpy');
define('CNF_LOGINTW_SECRET','XvTc0DF83s1rjKy7zgT0zD6ilgCOSod4DLjNubUMByU1cPsgPT');
define('CNF_COMPANYCODE','$companycode');
define('CNF_PLANCODE','$plancode');
define('CNF_TAHUNTANAM','2017');
define('CNF_TAHUNGILING','2018');
define('CNF_METODE','1');
define('CNF_RAFAKSI','0');
?> 
";
chmod($init, 0777);
$file=fopen($init, 'w');
fwrite($file, $string);
fclose($file);


$init="../application/config/database.php";
chmod($init, 0777);

$string="
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
\$active_group = 'default';
\$active_record = TRUE;

\$db['default']['hostname'] = '$host_database';
\$db['default']['username'] = '$user_database';
\$db['default']['password'] = '$password_database';
\$db['default']['database'] = '$nama_database';
\$db['default']['dbdriver'] = 'mysqli';
\$db['default']['dbprefix'] = '';
\$db['default']['pconnect'] = TRUE;
\$db['default']['db_debug'] = TRUE;
\$db['default']['cache_on'] = FALSE;
\$db['default']['cachedir'] = '';
\$db['default']['char_set'] = 'utf8';
\$db['default']['dbcollat'] = 'utf8_general_ci';
\$db['default']['swap_pre'] = '';
\$db['default']['autoinit'] = TRUE;
\$db['default']['stricton'] = FALSE;
";

$file=fopen($init, 'w');
fwrite($file, $string);
fclose($file);


echo json_encode(array("status"=>"succses"));

}else{
	echo 'Kesalahan Sistem '.$_POST['nama_database'];die();
}
?>
