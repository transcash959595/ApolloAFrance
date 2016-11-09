<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class PushDataVss extends CI_Controller {



public function importvss()
{
foreach (glob("C:/wamp/www/vssdownload/*.TXT") as $filename) {          
$fh = fopen($filename, 'r');
$str = fread($fh,12000);
fclose($fh);
//echo $theData;
$vss = substr($filename, 35,10);
//$str1 = substr($vss,0,4);
//$str2 = substr($vss,4,4);
//$str3 = $str2.$str1;

$tablename = "vssreport".$vss;
//opendir("Z:/ANKIT/IT Manual");
$str = preg_replace('/\b\s+\n/','||',$str);
$str = str_replace(",","",$str);
$str = preg_replace('/\s\W\s+/',',',$str);
$str = preg_replace('/\d\s\D/','',$str);
$str = preg_replace('/\s\W\s+/',',',$str);


$file = fopen("test.txt","w");
echo fwrite($file,$str);
fclose($file);
//echo $str;
echo "creating  the table"; 
$con = mysql_connect("localhost","root","ankit");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
  
  $newname =$tablename;

$dbname='vssfrance';


$createtablequery = "create table `".$newname."`
(`Maintype`  varchar (40),
`innertype`  varchar (40),
 `amounta`     varchar (40),
 `amountb`    varchar (40),
 `Totalamountmain`    varchar (40),
 `Totalamountinterchange`    varchar (40)
 )";

 
 
 
 mysql_select_db($dbname,$con);

$result = mysql_query($createtablequery,$con);

$filename1 = "C:/wamp/www/vssdownload/test.txt";

if(!$result)
{

echo "Replacing the existing table with the new table". " New table name ". $newname."<br>";
$droptable = " DROP table  `".$newname."` ";
 mysql_select_db($dbname,$con);
$result_droptable  = mysql_query($droptable,$con);

}
 mysql_select_db($dbname,$con);
$result = mysql_query($createtablequery,$con);

if($result)
{
echo "The table  ".$newname." is Created";

$insertquery = "LOAD DATA LOCAL INFILE '". $filename1. "' INTO TABLE  `".$newname."` FIELDS TERMINATED BY  ',' ENCLOSED BY '' ESCAPED BY  '' LINES TERMINATED BY  '||'";
mysql_select_db($dbname,$con);

$result = mysql_query($insertquery,$con);

if($result)
{
echo " import done";
}}

}
foreach (glob("C:/wamp/www/vssdownload/*.TXT") as $filename) {          
echo unlink($filename);}

}

 




}

?>



