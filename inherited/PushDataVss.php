<?php

/*
euro 500-> euro 525
euro 300-> euro 315
euro 50 -> euro 55
euro 150-> euro 160
euro 100 -> euro 108
*/
include 'datacon.php';
class pushDataVss
{
function vssFees($startdate,$enddate)
{   

$todaydate = $enddate;	    
$todaydate   = strtotime($todaydate);	// converting the date time to string 
$todaydate =  date("m/d/Y",$todaydate );	
$enddate = $todaydate;
$datetime_start = strtotime($startdate);
$datetime_end   = strtotime($enddate);	
$datetime_temp  = $datetime_start;
while ($datetime_temp <= $datetime_end) 
{
$newdate_reserve = date('Y/m/d', $datetime_temp);	
$getdate_reserve = str_replace("/","-",$newdate_reserve);
$feesubtotal = 0;
set_time_limit(0);
$newdate = date('m/d/Y', $datetime_temp);
$objdatacon = new database();		
$con = $objdatacon->con();    		 
$dbname='vssfr'; // Data base selection for the slect query from the VSS daily data base 
mysql_select_db($dbname,$con);	
/*
The query below is to select the conversion fees from the vssreport table in the vssfr database 

*/
$selectVssConversionFees = "SELECT `Totalamountinterchange` from 	`vssreport".$getdate_reserve."` where `Maintype` = ' TOTAL CURRENCY CONVERSION FEES '  ";
echo $selectVssConversionFees."</br>";
$resultSelectVssConversionFees = mysql_query($selectVssConversionFees,$con); 

$resultArrayVssConversionFees  = mysql_fetch_array($resultSelectVssConversionFees);
// Getting an array from the mysql_query run inside the mysql_fetch_array function 

$selectVssVisaCharges = " SELECT `Totalamountmain` from `vssreport".$getdate_reserve."` where `innertype` = 'TOTAL VISA CHARGES'  ";
echo $selectVssVisaCharges."</br>";
/* 
mysql_query($selectVssVisaCharges); 
// Selecting the amount for the visa charges for the date, above line it to run the query only.  

*/

$resultVssVisaCharges = mysql_query($selectVssVisaCharges,$con);
$resultArrayVssVisaCharges = mysql_fetch_array($resultVssVisaCharges); 
// Getting an array with the results for visa charges. This will also run the query on the right hand side to get the visa charges 


$selectVssReimbursemetFees = "SELECT `Totalamountmain` from `vssreport".$getdate_reserve."` where `innertype`= 'TOTAL REIMBURSEMENT FEES'";
echo $selectVssReimbursemetFees."</br>"; 

/*
mysql_query($selectVssReimbursemetFees); 
above line is to run the query for the reimbursement fees
// Selecting the amount for the reimbursement fees 

*/
$resultVssReimbursementFees = mysql_query($selectVssReimbursemetFees,$con);
$resultArrayVssReimbursementFees = mysql_fetch_array($resultVssReimbursementFees);
// Getting an array with the results for reimbursement fees.

$vssfeesCredit = substr($resultArrayVssConversionFees[0], 0,-2); 
// Taking out the the last two string which is 'DB' from the conversion fess results, this is an income for the particular day generating with visa. 


$vssfessDebit = substr($resultArrayVssReimbursementFees[0],0,-2) + substr($resultArrayVssVisaCharges[0], 0, -2);
 // Taking out the last two string ('DB') from the resultant arrays and also adding them to get the final amount for negatinve fees for the particular day incurred from the visa.
 

$total = $vssfeesCredit - $vssfessDebit;
$dbname='france'; // Data base selection for the slect query from the VSS daily data base 
mysql_select_db($dbname,$con);	

$insertFeeSubtotal= "INSERT INTO `vssfee`  "." (Date, Description, Total, Debit, Credit) VALUES('".$newdate."','VSS Fees','".$total."','".$vssfessDebit."','".$vssfeesCredit."')";
echo $insertFeeSubtotal."<br>";
mysql_query($insertFeeSubtotal,$con);	
$datetime_temp = strtotime('+1 day', $datetime_temp);
 } 
 // while loop ends here 
echo " Vss Fees database updated";
echo "</br> Between ".$startdate. " and  ". $enddate;


}




function importEachFieToMysql($pathToImportfile)
{
echo "I am in ImportEachFileToMysql <br>";
foreach (glob($pathToImportfile) as $filename) {    
echo "I am in ImportEachFileToMysql function starting the loop to read files <br/> ";

$fh = fopen($filename, 'r');
$str = fread($fh,80000);
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
$str = str_replace("TOTAL CURRENCY CONVERSION FEES||","TOTAL CURRENCY CONVERSION FEES",$str);
$str = str_replace("TOTAL ATM CASH||","TOTAL ATM CASH||",$str);


//echo $str.'<br>';
$file = fopen("C:/wamp/www/vssdownload/saveData.txt","w");
echo fwrite($file,$str);
fclose($file);
//echo $str;
echo "creating  the table <br>"; 
$con = mysqli_connect("localhost","root","ankitPfrance1801","vssfr")or die ("could not connect to mysqli database");
  
  $newname =$tablename;

$dbname='vssfr';


$createtablequery = "create table `".$newname."`
(`Maintype`  varchar (40),
`innertype`  varchar (40),
 `amounta`     varchar (40),
 `amountb`    varchar (40),
 `Totalamountmain`    varchar (40),
 `Totalamountinterchange`    varchar (40)
 )";

 
 
 $resultCreatetablequery = mysqli_query($con, $createtablequery);
 

$filename1 = "C:/wamp/www/vssdownload/saveData.txt";

if(!$resultCreatetablequery)
{

echo "Replacing the existing table with the new table". " New table name ". $newname."<br>";
$droptable = " drop table  `".$newname."` ";
$resultCreatetablequery = mysqli_query($con, $createtablequery);
}


if($resultCreatetablequery)
{
echo "The table  ".$newname." is Created <br>";

$loadFileDatatoTablequery = "LOAD DATA LOCAL INFILE '". $filename1. "' INTO TABLE  `".$newname."` FIELDS TERMINATED BY  ',' ENCLOSED BY '' ESCAPED BY  '' LINES TERMINATED BY  '||'";
$resultloadFileDatatoTablequery = mysqli_query($con, $loadFileDatatoTablequery);

if($resultloadFileDatatoTablequery)
{
echo $loadFileDatatoTablequery."<br>";
echo " import done";
}}

}






}



}

 //class ends here 


echo "Before class <br> ";
$objectpushdata = new pushDataVss(); // Creating an instance of the class 


$objectpushdata->importEachFieToMysql("C:/wamp/www/vssdownload/*.TXT");


//$objectpushdata->vssFees('07/01/2015','12/30/2015');







?>



