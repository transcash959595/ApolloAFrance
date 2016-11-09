<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CreateDatabase extends CI_Controller {





public function index()
{
$username = $this->session->userdata('username');
$password = $this->session->userdata('password');
if(isset($username)&&isset($password))
{
$this->load->model('Accountmodel');
$data['account'] = $this->Accountmodel->getAccountDetails();
$data['startdate'] = '';
$data['enddate'] = '';
$data['accountActive'] = '';
$this->load->helper('url');
$this->load->view('account');
$this->load->view('content/accountVerticalTabs',$data);
$this->load->view('content/account',$data);
//print_r($data);
} 
else
{
$this->load->view('login');
//print_r($this->session->all_userdata());
}
}







function importVss()
{
$pathToImportfile = "C:/wamp/www/vssdownload/*.TXT";
/*
This function importVss  is to import the vss files for TransCash France.
This function has to be called for all the .TXT file extension and so make
sure that extension is renamed at command prompt.
Run the following commands 
go to the vss import folder with command line with CD commands 
usually it is at c:\wamp\vss\vssdownload
Then run the command ren .*txt .*TXT 
after that command run the rename command for saveData.txt 
ren saveData.TXT saveData.txt

Make sure by typing DIR at the same dirctory it will show the files with the extension TXT 
*/

//echo "I am in ImportEachFileToMysql <br>";
foreach (glob($pathToImportfile) as $filename) {    
//echo "I am in ImportEachFileToMysql function starting the loop to read files <br/> ";

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

function vssFeesCalculation($startdate,$enddate)
{  
 
/*
This function has to be called after the import function  called for all the date has to be passed in a format of m-d-Y. 

*/
$startdate = str_replace("-","/",$startdate);
$enddate = str_replace("-","/",$enddate);
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
		

$dbname='vssfr'; // Data base selection for the slect query from the VSS daily data base 

/*
The query below is to select the conversion fees from the vssreport table in the vssfr database 

*/
$con = mysqli_connect("localhost","root","ankitPfrance1801","vssfr")or die ("could not connect to mysqli database");
$selectVssConversionFees = "SELECT `Totalamountinterchange` from 	`vssreport".$getdate_reserve."` where `Maintype` = ' TOTAL CURRENCY CONVERSION FEES '  ";
echo $selectVssConversionFees."</br>";
$resultSelectVssConversionFees = mysqli_query($con, $selectVssConversionFees);
//$resultSelectVssConversionFees = mysql_query($selectVssConversionFees,$con); 


if($resultSelectVssConversionFees){
$resultArrayVssConversionFees  = mysqli_fetch_array($resultSelectVssConversionFees);}
// Getting an array from the mysql_query run inside the mysql_fetch_array function 

$selectVssVisaCharges = " SELECT `Totalamountmain` from `vssreport".$getdate_reserve."` where `innertype` = 'TOTAL VISA CHARGES'  ";
echo $selectVssVisaCharges."</br>";
/* 
mysql_query($selectVssVisaCharges); 
// Selecting the amount for the visa charges for the date, above line it to run the query only.  

*/

$resultVssVisaCharges = mysqli_query($con, $selectVssVisaCharges);
if($resultVssVisaCharges){
$resultArrayVssVisaCharges = mysqli_fetch_array($resultVssVisaCharges); }
// Getting an array with the results for visa charges. This will also run the query on the right hand side to get the visa charges 


$selectVssReimbursemetFees = "SELECT `Totalamountmain` from `vssreport".$getdate_reserve."` where `innertype`= 'TOTAL REIMBURSEMENT FEES'";
echo $selectVssReimbursemetFees."</br>"; 

/*
mysql_query($selectVssReimbursemetFees); 
above line is to run the query for the reimbursement fees
// Selecting the amount for the reimbursement fees 

*/
$resultVssReimbursementFees = mysqli_query($con,$selectVssReimbursemetFees);
if($resultVssReimbursementFees){
$resultArrayVssReimbursementFees = mysqli_fetch_array($resultVssReimbursementFees); } 
// Getting an array with the results for reimbursement fees.

$vssfeesCredit = substr($resultArrayVssConversionFees[0], 0,-2); 
// Taking out the the last two string which is 'DB' from the conversion fess results, this is an income for the particular day generating with visa. 


$vssfessDebit = substr($resultArrayVssReimbursementFees[0],0,-2) + substr($resultArrayVssVisaCharges[0], 0, -2);
 // Taking out the last two string ('DB') from the resultant arrays and also adding them to get the final amount for negatinve fees for the particular day incurred from the visa.
 

$total = $vssfeesCredit - $vssfessDebit;

$conFee = mysqli_connect("localhost","root","ankitPfrance1801","france")or die ("could not connect to mysqli database");
//$dbname='france'; // Data base selection for the slect query from the VSS daily data base 
//mysql_select_db($dbname,$con);	

$insertFeeSubtotal= "INSERT INTO `vssfee`  "." (Date, Description, Total, Debit, Credit) VALUES('".$newdate."','VSS Fees','".$total."','".$vssfessDebit."','".$vssfeesCredit."')";
echo $insertFeeSubtotal."<br>";
mysqli_query($conFee,$insertFeeSubtotal);	
$datetime_temp = strtotime('+1 day', $datetime_temp);
 } 
 // while loop ends here 
echo " Vss Fees database updated";
echo "</br> Between ".$startdate. " and  ". $enddate;


}

public function importCardSales()
{

//This function is to import the card sales xml data to SQL table.
ini_set('memory_limit', '10000M');
ini_set('max_execution_time', 10000);
$CardSalesImport = 0;
$con = mysqli_connect("localhost","root","ankitPfrance1801","france")or die ("could not connect to mysqli database");
foreach (glob("C:/wamp/www/ApolloAFrance/uploads/dataFiles/ProcessorCardSales/*.xml") as $filename) 
	{ $path =  $filename;
	// echo $filename;
	 if(is_file($path))
	{
	$datename = substr($filename, -12, -4);
	//echo $datename;
	$d = substr($datename,-2);
	$m = substr($datename,-4,-2);
	$y =substr($datename,0,4);
	$salesDate = $y."-".$m."-".$d;
	//echo $salesDate;
	$xml=simplexml_load_file($path);
	$CardSalesImport = 0;
	//REET' , 'TERMCITY' , 'TERMCOUNTRY' , 'SCHEMA' , 'CHIC' , 'CHAC' , 'CHP' , 'CP' , 'CDIM' , 'CHAM' , 'CHA' , 'MSGSRC' , 'RCC' , 'MCC' , 'TVR' , 'TXNDATE' , 'TXNTIME' , 'TERMTYPE' , 'CTXDATELOCAL' , 'CTXTIMELOCAL' , 'AIID' , 'ACTIONCODE' , 'RSPCODE' );
		foreach($xml->children() as $child) {
		if($child->getName() =='CARD'){
		 foreach($child as $innerchild){
/*
This loop is matching with all the inner child tags
if statements are to match with the predefined  tags if
the conditions are true it will store the values to the variables created in
each if statement and later on these newly created variables will be used in the
sql query to insert one row for each iteration 
*/
if ($innerchild->getName() == 'RECID')	{ $recid = $innerchild;  } 
if ($innerchild->getName() == 'PAN')	 { $pan = $innerchild;  }if ($innerchild->getName() == 'PREVPAN') { $prevpan = $innerchild;  }  if ($innerchild->getName() == 'ACCNO') { $accno = $innerchild;  }  
if ($innerchild->getName() == 'ACCTYPE') { $acctype = $innerchild;  }  if ($innerchild->getName() == 'OLDSTATCODE') { $oldstatcode = $innerchild;  } 
if ($innerchild->getName() == 'STATCODE') { $statcode = $innerchild;  }  if ($innerchild->getName() == 'TITLE') { $title = $innerchild;  }if ($innerchild->getName() == 'LASTNAME') { $lastname = $innerchild;  }  if ($innerchild->getName() == 'FIRSTNAME') { $firstname = $innerchild;  }  
if ($innerchild->getName() == 'DESIGNREF') { $designref = $innerchild;  }  if ($innerchild->getName() == 'IMAGEID') { $imageid = $innerchild;  } 
if ($innerchild->getName() == 'DLVMETHOD') { $dlvmethod = $innerchild;  }  if ($innerchild->getName() == 'ISOLANG') { $isolang = $innerchild;  } 
if ($innerchild->getName() == 'CARDID') { $cardid = $innerchild;  }  if ($innerchild->getName() == 'PREVCARDID') { $prevcardid = $innerchild;  } 
if ($innerchild->getName() == 'BRNCODE') { $brncode = $innerchild;  } if ($innerchild->getName() == 'USER') { $user = $innerchild;  }  
if ($innerchild->getName() == 'USERGRP') { $usergrp = $innerchild;  }  if ($innerchild->getName() == 'CARDEVENT') { $cardevent = $innerchild;  } 
if ($innerchild->getName() == 'EXPDATE') { $expdate = $innerchild;  }  if ($innerchild->getName() == 'PROGRAMID') { $programid = $innerchild;  }
if ($innerchild->getName() == 'PARTICIPANTID') { $participantid = $innerchild;  }  if ($innerchild->getName() == 'ACCOUNTID') { $accountid = $innerchild;  }
if ($innerchild->getName() == 'CRDBTCHNO') { $crdbtchno = $innerchild;  }  if ($innerchild->getName() == 'CUSTCODE') { $custcode = $innerchild;  }
if ($innerchild->getName() == 'CRDPRODUCT') { $crdproduct = $innerchild;  }  if ($innerchild->getName() == 'ACCESSCODE') { $accesscode = $innerchild;  }
if ($innerchild->getName() == 'CARRIERPAN') { $carrierpan = $innerchild;  }  if ($innerchild->getName() == 'STOCKNO') { $stockno = $innerchild;  }
if ($innerchild->getName() == 'FUNDCRDPAN') { $fundcrdpan = $innerchild;  }  if ($innerchild->getName() == 'FUNDCRDEFFDATE') { $fundcrdeffdate = $innerchild;  } 
if ($innerchild->getName() == 'FUNDCRDEXPDATE') { $fundcrdexpdate = $innerchild;  } if ($innerchild->getName() == 'FUNDCRDTYPE') { $fundcrdtype = $innerchild;  } 
if ($innerchild->getName() == 'FUNDCRDISSNUM') { $fundcrdissnum = $innerchild;  }  if ($innerchild->getName() == 'ADDRIND') { $addrind = $innerchild;  }
if ($innerchild->getName() == 'ADDRL1') { $addrl1 = $innerchild;  }  if ($innerchild->getName() == 'ADDRL2') { $addrl2 = $innerchild;  }
if ($innerchild->getName() == 'ADDRL3') { $addrl3 = $innerchild;  }  if ($innerchild->getName() == 'CITY') { $city = $innerchild;  }
if ($innerchild->getName() == 'COUNTY') { $county = $innerchild;  } if ($innerchild->getName() == 'POSTCODE') { $postcode = $innerchild;  } 
if ($innerchild->getName() == 'COUNTRY') { $country = $innerchild;  } if ($innerchild->getName() == 'WORKADDRL1') { $workaddrl1 = $innerchild;  } 
if ($innerchild->getName() == 'WORKADDRL2')  { $workaddrl2 = $innerchild;  } if ($innerchild->getName() == 'WORKADDRL3') { $workaddrl3 = $innerchild;  }
if ($innerchild->getName() == 'WORKCITY') { $workcity = $innerchild;  }  if ($innerchild->getName() == 'WORKCOUNTY') { $workcounty = $innerchild;  }
if ($innerchild->getName() == 'WORKPOSTCODE') { $workpostcode = $innerchild;  }  
if ($innerchild->getName() == 'WORKCOUNTRY') { $workcountry = $innerchild;  }  if ($innerchild->getName() == 'POBOX') { $pobox = $innerchild;  }
if ($innerchild->getName() == 'DLVADDRL1') { $dlvaddrl1 = $innerchild;  }  if ($innerchild->getName() == 'DLVADDRL2') { $dlvaddrl2 = $innerchild;  }
if ($innerchild->getName() == 'DLVADDRL3') { $dlvaddrl3 = $innerchild;  }  if ($innerchild->getName() == 'DLVCITY') { $dlvcity = $innerchild;  }
if ($innerchild->getName() == 'DLVCOUNTY') { $dlvcounty = $innerchild;  }  if ($innerchild->getName() == 'DLVPOSTCODE') { $dlvpostcode = $innerchild;  }
if ($innerchild->getName() == 'DLVCOUNTRY') { $dlvcountry = $innerchild;  }  if ($innerchild->getName() == 'DLVINDATE') { $dlvindate = $innerchild;  }
if ($innerchild->getName() == 'DLVPURGEDATE') { $dlvpurgedate = $innerchild;  }  if ($innerchild->getName() == 'TOTALCARDS') { $totalcards = $innerchild;  }
if ($innerchild->getName() == 'TOTALRENCARDS') { $totalrencards = $innerchild;  }  if ($innerchild->getName() == 'TOTALREPCARDS') { $totalrepcards = $innerchild;  }
if ($innerchild->getName() == 'TOTALREISSCARDS') { $totalreisscards = $innerchild;  }  if ($innerchild->getName() == 'TOTALPINS') { $totalpins = $innerchild;  }
if ($innerchild->getName() == 'TOTALPINREP') { $totalpinrep = $innerchild;  }  if ($innerchild->getName() == 'TOTALPINRMND') { $totalpinrmnd = $innerchild;  }
if ($innerchild->getName() == 'TOTALSTATCHG') { $totalstatchg = $innerchild;  }  if ($innerchild->getName() == 'TOTALTOEXPIRE') { $totaltoexpire = $innerchild;  }
if ($innerchild->getName() == 'CRDPROFILE') { $crdprofile = $innerchild;  }  if ($innerchild->getName() == 'ACCPROFILE') { $accprofile = $innerchild;  }
if ($innerchild->getName() == 'CUSTPROFILE') { $custprofile = $innerchild;  }  
}  // for each child as inner child 

$insertqueryCardSalesimport = " insert into   `cardsalesimport` values ( '$recid', '$pan'  , '$prevpan'  , '$accno' , '$acctype' , '$oldstatcode', '$statcode'  , '$title'  , '$lastname'  , '$firstname' , '$designref' ,
 '$imageid'  , '$dlvmethod'  , '$isolang'  , '$cardid'  , '$prevcardid'  , '$brncode'  , '$user'  , '$usergrp'  , '$cardevent'  , '$expdate'  , 
 '$programid'  , '$participantid'  , '$accountid'  , '$crdbtchno'  , '$custcode'  , '$crdproduct'  , '$accesscode'  , '$carrierpan'  , '$stockno',
 '$fundcrdpan'  , '$fundcrdeffdate'  , '$fundcrdexpdate'  , '$fundcrdtype'  , '$fundcrdissnum'  , '$addrind'  , '$addrl1'  , '$addrl2'  , 
 '$addrl3'  , '$city'  , '$county'  , '$postcode'  , '$country'  , '$workaddrl1'  , '$workaddrl2'  , '$workaddrl3'  , '$workcity'  , 
 '$workcounty'  , '$workpostcode'  , '$workcountry'  , '$pobox'  , '$dlvaddrl1'  , '$dlvaddrl2'  , '$dlvaddrl3'  , '$dlvcity'  , 
 '$dlvcounty'  , '$dlvpostcode'  , '$dlvcountry'  , '$dlvindate'  , '$dlvpurgedate'  , '$totalcards'  , '$totalrencards'  , '$totalrepcards'  ,
 '$totalreisscards' , '$totalpins'  , '$totalpinrep'  , '$totalpinrmnd'  , '$totalstatchg'  , '$totaltoexpire'  , '$crdprofile'  , '$accprofile'  ,
 '$custprofile', '$salesDate' )";
$resultinsertqueryCardSales = mysqli_query($con, $insertqueryCardSalesimport);

if($resultinsertqueryCardSales)
{
	$CardSalesImport++;
}

} // if child is getchild 
} // foreach xml children 

} // if path exits ends here 

} // First Foreach loop ends here, for each text files


echo "<br/> Number of Records updated".$CardSalesImport; 


} // cardSalesImportFunctionEnds Here








public function importMultipleData($fileDate)
{
$con = mysqli_connect("localhost","root","ankitPfrance1801","france")or die ("could not connect to mysqli database");
$filename = "TCFtxnexp".$fileDate;
//foreach (glob("C:/wamp/www/ApolloAFrance/uploads/dataFiles/Processor/".$filename1.".xml") as $filename) { 
$path =  "C:/wamp/www/ApolloAFrance/uploads/dataFiles/Processor/".$filename.".xml";
if(is_file($path))
{
$xml = simplexml_load_file($path);
$authadv = 0;
$finadv = 0;
$authrev = 0;
$fee =0;
$cardload = 0;
$cardunload = 0;
$adjust = 0;
$chrgback = 0;
//$tags = array ( 'MTID' , 'LOCALTIME' , 'TLOGID' , 'ITEMID' , 'PAN' , 'CARDID' , 'CRDPRODUCT' , 'PROGRAMID' , 'BRNCODE' , 'TXNCODE' , 'TXNSUBCODE' , 'BILLAMT' , 'ACCCUR' , 'ACCNO' , 'ACCTYPE' , 'BILLCONVRATE' , 'AMTCOM' , 'AMTPAD' , 'CURTXN' , 'AMTTXN' , 'AMTTXNCB' , 'APPROVALCODE' , 'CORTEXDATE' , 'STAN' , 'RRN' , 'TERMCODE' , 'CRDACPTID' , 'AFE' , 'TERMLOCATION' , 'TERMSTREET' , 'TERMCITY' , 'TERMCOUNTRY' , 'SCHEMA' , 'CHIC' , 'CHAC' , 'CHP' , 'CP' , 'CDIM' , 'CHAM' , 'CHA' , 'MSGSRC' , 'RCC' , 'MCC' , 'TVR' , 'TXNDATE' , 'TXNTIME' , 'TERMTYPE' , 'CTXDATELOCAL' , 'CTXTIMELOCAL' , 'AIID' , 'ACTIONCODE' , 'RSPCODE' );
foreach($xml->children() as $child) {
ini_set('memory_limit', '10000M');
ini_set('max_execution_time', 1000);
if($child->getName() =='AUTHADV'){
foreach($child as $innerchild) {
/*
This loop is matching with all the inner child tags
if statements are to match with the predefined  tags if
the conditions are true it will store the values to the variables created in
each if statement and later on these newly created variables will be used in the
sql query to insert one row for each iteration */

if ($innerchild->getName() == 'MTID'){ $mtid = $innerchild; }  if ($innerchild->getName() == 'LOCALDATE'){$localdate = $innerchild;}if ($innerchild->getName() == 'LOCALTIME'){$localtime = $innerchild;}    if ($innerchild->getName() == 'TLOGID'){$tlogid = $innerchild; }
if ($innerchild->getName() == 'ITEMID'){$itemid = $innerchild;}      if ($innerchild->getName() == 'PAN'){$pan = $innerchild; }if ($innerchild->getName() == 'CARDID'){ $cardid = $innerchild;}    if ($innerchild->getName() == 'CRDPRODUCT'){$crdproduct = $innerchild;}
if ($innerchild->getName() == 'PROGRAMID'){$programid = $innerchild;}    if ($innerchild->getName() == 'BRNCODE'){ $brncode = $innerchild;}if ($innerchild->getName() == 'TXNCODE'){$txncode = $innerchild; }      if ($innerchild->getName() == 'TXNSUBCODE'){ $txnsubcode = $innerchild; }
if ($innerchild->getName() == 'BILLAMT'){$billamt = $innerchild; }      if ($innerchild->getName() == 'ACCCUR') {$acccur = $innerchild; }if ($innerchild->getName() == 'ACCNO') {  $accno = $innerchild; }     if ($innerchild->getName() == 'ACCTYPE') {  $acctype = $innerchild; }
if ($innerchild->getName() == 'BILLCONVRATE'){$billconvrate = $innerchild; }    if ($innerchild->getName() == 'AMTCOM') {$amtcom = $innerchild;}if ($innerchild->getName() == 'AMTPAD') { $amtpad = $innerchild;}     if ($innerchild->getName() == 'CURTXN') {$curtxn = $innerchild;  }
if ($innerchild->getName() == 'AMTTXN') {$amttxn = $innerchild;  }  if ($innerchild->getName() == 'AMTTXNCB'){$amttxncb = $innerchild;}if ($innerchild->getName() == 'APPROVALCODE'){$approvalcode = $innerchild; }  if ($innerchild->getName() == 'CORTEXDATE'){$cortexdate = $innerchild;}
if ($innerchild->getName() == 'STAN'){ $stan = $innerchild; }  if ($innerchild->getName() == 'RRN'){$rrn = $innerchild; }if ($innerchild->getName() == 'TERMCODE'){$termcode = $innerchild;}     if ($innerchild->getName() == 'CRDACPTID'){$crdacptid = $innerchild;}
if ($innerchild->getName() == 'AFE'){ $afe = $innerchild; }    if ($innerchild->getName() == 'TERMLOCATION'){$termlocation = $innerchild;  }if ($innerchild->getName() == 'TERMSTREET'){ $termstreet = $innerchild; }    if ($innerchild->getName() == 'TERMCITY') {$termcity = $innerchild;}
if ($innerchild->getName() == 'TERMCOUNTRY'){$termcountry = $innerchild;}  if ($innerchild->getName() == 'SCHEMA'){$schema = $innerchild;}if ($innerchild->getName() == 'CHIC'){$chic = $innerchild;}  if ($innerchild->getName() == 'CHAC'){$chac = $innerchild;}
if ($innerchild->getName() == 'CHP') {$chp = $innerchild;}     if ($innerchild->getName() == 'CP') { $cp = $innerchild;}if ($innerchild->getName() == 'CDIM') { $cdim = $innerchild;   }    if ($innerchild->getName() == 'CHAM') {  $cham = $innerchild;  }
if ($innerchild->getName() == 'CHA') {  $cha = $innerchild;   }     if ($innerchild->getName() == 'MSGSRC')   {  $msgsrc = $innerchild;}if ($innerchild->getName() == 'RCC')      {   $rcc = $innerchild;  }     if ($innerchild->getName() == 'MCC') {     $mcc = $innerchild;}
if ($innerchild->getName() == 'TVR')  {    $tvr = $innerchild;    }      if ($innerchild->getName() == 'TXNDATE') { $txndate = $innerchild;}if ($innerchild->getName() == 'TXNTIME') { $txntime = $innerchild;  }    if ($innerchild->getName() == 'TERMTYPE') {  $termtype = $innerchild;}
if ($innerchild->getName() == 'CTXDATELOCAL')  {  $ctxdatelocal = $innerchild;}  if ($innerchild->getName() == 'CTXTIMELOCAL')  {  $ctxtimelocal = $innerchild;} if ($innerchild->getName() == 'AIID'){  $aiid = $innerchild;  }      if ($innerchild->getName() == 'ACTIONCODE') { $actioncode = $innerchild;}
if ($innerchild->getName() == 'RSPCODE'){ $rspcode = $innerchild;  }
}
$insertqueryAuthadv = " Insert INTO   `authadv` values ('$mtid' ,'$localdate', '$localtime' , '$tlogid' , '$itemid' ,
'$pan' , '$cardid' , '$crdproduct' , '$programid' , '$brncode' , '$txncode' , '$txnsubcode' , '$billamt' ,
'$acccur' , '$accno' , '$acctype' , '$billconvrate' , '$amtcom' , '$amtpad' , '$curtxn' , '$amttxn' , '$amttxncb' ,
'$approvalcode' , '$cortexdate' , '$stan' , '$rrn' , '$termcode' , '$crdacptid' , '$afe' , '$termlocation' , '$termstreet' ,
'$termcity' , '$termcountry' , '$schema' , '$chic' , '$chac' , '$chp' , '$cp' , '$cdim' , '$cham' , '$cha' , '$msgsrc' ,
'$rcc' , '$mcc' , '$tvr' , '$txndate' , '$txntime' , '$termtype' , '$ctxdatelocal' , '$ctxtimelocal' , '$aiid' ,
'$actioncode' , '$rspcode'  )";
//echo $insertquery."<br>";

$resultinsertqueryAuthadv = mysqli_query($con, $insertqueryAuthadv);
if($resultinsertqueryAuthadv)
{
$authadv++;
}

}
//if statement for new xml tag
if($child->getName() =='AUTHREV'){
foreach($child as $innerchild) {
/*
This loop is matching with all the inner child tags
if statements are to match with the predefined  tags if
the conditions are true it will store the values to the variables created in
each if statement and later on these newly created variables will be used in the
sql query to insert one row for each iteration */

if ($innerchild->getName() == 'MTID'){ $mtid = $innerchild; }            if ($innerchild->getName() == 'LOCALDATE'){$localdate = $innerchild;} if ($innerchild->getName() == 'LOCALTIME'){$localtime = $innerchild;}    if ($innerchild->getName() == 'TLOGID'){$tlogid = $innerchild; }
if ($innerchild->getName() == 'ITEMID'){$itemid = $innerchild;}          if ($innerchild->getName() == 'PAN'){$pan = $innerchild; }            if ($innerchild->getName() == 'CARDID'){ $cardid = $innerchild;}         if ($innerchild->getName() == 'CRDPRODUCT'){$crdproduct = $innerchild;}
if ($innerchild->getName() == 'PROGRAMID'){$programid = $innerchild;}    if ($innerchild->getName() == 'BRNCODE'){ $brncode = $innerchild;}    if ($innerchild->getName() == 'TXNCODE'){$txncode = $innerchild; }       if ($innerchild->getName() == 'TXNSUBCODE'){ $txnsubcode = $innerchild; }
if ($innerchild->getName() == 'BILLAMT'){$billamt = $innerchild; }       if ($innerchild->getName() == 'ACCCUR') {$acccur = $innerchild; }     if ($innerchild->getName() == 'ACCNO') {  $accno = $innerchild; }        if ($innerchild->getName() == 'ACCTYPE') {  $acctype = $innerchild; }
if ($innerchild->getName() == 'BILLCONVRATE'){$billconvrate = $innerchild; } if ($innerchild->getName() == 'AMTCOM') {$amtcom = $innerchild;}  if ($innerchild->getName() == 'AMTPAD') { $amtpad = $innerchild;}        if ($innerchild->getName() == 'CURTXN') {$curtxn = $innerchild;  }
if ($innerchild->getName() == 'AMTTXN') {$amttxn = $innerchild;  }       if ($innerchild->getName() == 'AMTTXNCB'){$amttxncb = $innerchild;}   if ($innerchild->getName() == 'AMTTXNORG'){$amttxnorg = $innerchild;}    if ($innerchild->getName() == 'APPROVALCODE'){$approvalcode = $innerchild; }
if ($innerchild->getName() == 'CORTEXDATE'){$cortexdate = $innerchild;}  if ($innerchild->getName() == 'STAN'){ $stan = $innerchild; }         if ($innerchild->getName() == 'RRN'){$rrn = $innerchild; }               if ($innerchild->getName() == 'TERMCODE'){$termcode = $innerchild;}
if ($innerchild->getName() == 'CRDACPTID'){$crdacptid = $innerchild;}    if ($innerchild->getName() == 'AFE'){ $afe = $innerchild; }           if ($innerchild->getName() == 'TERMLOCATION'){$termlocation = $innerchild;  }  if ($innerchild->getName() == 'TERMSTREET'){ $termstreet = $innerchild; }
if ($innerchild->getName() == 'TERMCITY') {$termcity = $innerchild;}     if ($innerchild->getName() == 'TERMCOUNTRY'){$termcountry = $innerchild;} if ($innerchild->getName() == 'SCHEMA'){$schema = $innerchild;}          if ($innerchild->getName() == 'STANORG'){$stanorg = $innerchild;}
if ($innerchild->getName() == 'CHIC'){$chic = $innerchild;}              if ($innerchild->getName() == 'CHAC'){$chac = $innerchild;}           if ($innerchild->getName() == 'CHP') {$chp = $innerchild;}               if ($innerchild->getName() == 'CP') { $cp = $innerchild;}
if ($innerchild->getName() == 'CDIM') { $cdim = $innerchild;   }         if ($innerchild->getName() == 'CHAM') {  $cham = $innerchild;  }      if ($innerchild->getName() == 'CHA') {  $cha = $innerchild;   }          if ($innerchild->getName() == 'MSGSRC')   {  $msgsrc = $innerchild;   }
if ($innerchild->getName() == 'RCC')      {   $rcc = $innerchild;  }     if ($innerchild->getName() == 'MCC') {     $mcc = $innerchild;   }    if ($innerchild->getName() == 'DISPOSE') {     $dispose = $innerchild;   }    if ($innerchild->getName() == 'TVR')  {    $tvr = $innerchild;    }
if ($innerchild->getName() == 'TXNDATE') { $txndate = $innerchild;  }    if ($innerchild->getName() == 'TXNTIME') { $txntime = $innerchild;  } if ($innerchild->getName() == 'TERMTYPE') {  $termtype = $innerchild;  } if ($innerchild->getName() == 'CTXDATELOCAL')  {  $ctxdatelocal = $innerchild;}
if ($innerchild->getName() == 'CTXTIMELOCAL'){$ctxtimelocal = $innerchild;} if ($innerchild->getName() == 'AIID'){  $aiid = $innerchild;  }    if ($innerchild->getName() == 'ACTIONCODE') { $actioncode = $innerchild;}if ($innerchild->getName() == 'RSPCODE'){ $rspcode = $innerchild;  }
}

$insertqueryAuthrev = " Insert INTO   `authrev` values ('$mtid' ,'$localdate', '$localtime' , '$tlogid' , '$itemid' ,
'$pan' , '$cardid' , '$crdproduct' , '$programid' , '$brncode' , '$txncode' , '$txnsubcode' , '$billamt' ,
'$acccur' , '$accno' , '$acctype' , '$billconvrate' , '$amtcom' , '$amtpad' , '$curtxn' , '$amttxn' ,
'$amttxncb' ,'$amttxnorg', '$approvalcode' , '$cortexdate' , '$stan' , '$rrn' , '$termcode' , '$crdacptid' ,
'$afe' , '$termlocation' , '$termstreet' , '$termcity' , '$termcountry' , '$schema' , '$stanorg', '$chic' ,
'$chac' , '$chp' , '$cp' , '$cdim' , '$cham' , '$cha' , '$msgsrc' , '$rcc' , '$mcc' , '$dispose', '$tvr' ,
'$txndate' , '$txntime' , '$termtype' , '$ctxdatelocal' , '$ctxtimelocal' , '$aiid' , '$actioncode' , '$rspcode'  )";

$resultinsertqueryAuthrev = mysqli_query($con, $insertqueryAuthrev) ;  
if($resultinsertqueryAuthrev)
{
$authrev++;
}

}
//if statement for new xml tag
if($child->getName() =='FINADV'){
foreach($child as $innerchild) {
/*
This loop is matching with all the inner child tags
if statements are to match with the predefined  tags if
the conditions are true it will store the values to the variables created in
each if statement and later on these newly created variables will be used in the
sql query to insert one row for each iteration */

if  ($innerchild->getName() == 'MTID') { $mtid = $innerchild;  }if ($innerchild->getName() == 'LOCALDATE') { $localdate = $innerchild;  }if ($innerchild->getName() == 'LOCALTIME') { $localtime = $innerchild;  }if ($innerchild->getName() == 'TLOGID') { $tlogid = $innerchild;  }
if ($innerchild->getName() == 'ORGTLOGID') { $orgtlogid = $innerchild;  }if ($innerchild->getName() == 'ITEMID') { $itemid = $innerchild;  }if ($innerchild->getName() == 'ORGITEMID') { $orgitemid = $innerchild;  }if ($innerchild->getName() == 'PAN') { $pan = $innerchild;  }
if ($innerchild->getName() == 'CARDID') { $cardid = $innerchild;  }if ($innerchild->getName() == 'CRDPRODUCT') { $crdproduct = $innerchild;  }if ($innerchild->getName() == 'PROGRAMID') { $programid = $innerchild;  }if ($innerchild->getName() == 'BRNCODE') { $brncode = $innerchild;  }
if ($innerchild->getName() == 'TXNCODE') { $txncode = $innerchild;  }if ($innerchild->getName() == 'TXNSUBCODE') { $txnsubcode = $innerchild;  }if ($innerchild->getName() == 'CURTXN') { $curtxn = $innerchild;  }if ($innerchild->getName() == 'AMTTXN') { $amttxn = $innerchild;  }
if ($innerchild->getName() == 'AMTFEE') { $amtfee = $innerchild;  }if ($innerchild->getName() == 'AMTTXNCB') { $amttxncb = $innerchild;  }if ($innerchild->getName() == 'CURSET') { $curset = $innerchild;  }if ($innerchild->getName() == 'RATESET') { $rateset = $innerchild;  }
if ($innerchild->getName() == 'AMTSET') { $amtset = $innerchild;  }if ($innerchild->getName() == 'BILLAMT') { $billamt = $innerchild;  }if ($innerchild->getName() == 'ACCCUR') { $acccur = $innerchild;  }if ($innerchild->getName() == 'ACCNO') { $accno = $innerchild;  }
if ($innerchild->getName() == 'ACCTYPE') { $acctype = $innerchild;  }if ($innerchild->getName() == 'BILLCONVRATE') { $billconvrate = $innerchild;  }if ($innerchild->getName() == 'APPROVALCODE') { $approvalcode = $innerchild;  }if ($innerchild->getName() == 'CORTEXDATE') { $cortexdate = $innerchild;  }
if ($innerchild->getName() == 'STAN') { $stan = $innerchild;  }if ($innerchild->getName() == 'RRN') { $rrn = $innerchild;  }if ($innerchild->getName() == 'TERMCODE') { $termcode = $innerchild;  }if ($innerchild->getName() == 'CRDACPTID') { $crdacptid = $innerchild;  }
if ($innerchild->getName() == 'AFE') { $afe = $innerchild;  }if ($innerchild->getName() == 'TERMLOCATION') { $termlocation = $innerchild;  }if ($innerchild->getName() == 'TERMSTREET') { $termstreet = $innerchild;  }if ($innerchild->getName() == 'TERMCITY') { $termcity = $innerchild;  }
if ($innerchild->getName() == 'TERMCOUNTRY') { $termcountry = $innerchild;  }if ($innerchild->getName() == 'SCHEMA') { $schema = $innerchild;  }if ($innerchild->getName() == 'ARN') { $arn = $innerchild;  }if ($innerchild->getName() == 'FIID') { $fiid = $innerchild;  }
if ($innerchild->getName() == 'RIID') { $riid = $innerchild;  }if ($innerchild->getName() == 'REASONCODE') { $reasoncode = $innerchild;  }if ($innerchild->getName() == 'CHIC') { $chic = $innerchild;  }if ($innerchild->getName() == 'CHAC') { $chac = $innerchild;  }
if ($innerchild->getName() == 'CHP') { $chp = $innerchild;  }if ($innerchild->getName() == 'CP') { $cp = $innerchild;  }if ($innerchild->getName() == 'CDIM') { $cdim = $innerchild;  }if ($innerchild->getName() == 'CHAM') { $chan = $innerchild;  }
if ($innerchild->getName() == 'CHA') { $cha = $innerchild;  }if ($innerchild->getName() == 'TVR') { $tvr = $innerchild;  }if ($innerchild->getName() == 'MSGSRC') { $msgsrc = $innerchild;  }if ($innerchild->getName() == 'RCC') { $rcc = $innerchild;  }
if ($innerchild->getName() == 'MCC') { $mcc = $innerchild;  }if ($innerchild->getName() == 'CBACKIND') { $cbackind = $innerchild;  }if ($innerchild->getName() == 'TXNDATE') { $txndate = $innerchild;  }if ($innerchild->getName() == 'TXNTIME') { $txntime = $innerchild;  }
if ($innerchild->getName() == 'TERMTYPE') { $termtype = $innerchild;  }if ($innerchild->getName() == 'CTXDATELOCAL') { $ctxdatelocal = $innerchild;  }if ($innerchild->getName() == 'CTXTIMELOCAL') { $ctxtimelocal = $innerchild;  }if ($innerchild->getName() == 'AIID') { $aiid = $innerchild;  }
if ($innerchild->getName() == 'DLVCYCLE') { $dlvcycle = $innerchild;  }if ($innerchild->getName() == 'ACTIONCODE') { $actioncode = $innerchild;  } if ($innerchild->getName() == 'RSPCODE') { $rspcode = $innerchild;  }
}

$insertqueryfinadv = " insert into   `finadv` values ('$mtid' , '$localdate' , '$localtime' , '$tlogid' ,
'$orgtlogid' , '$itemid' , '$orgitemid' , '$pan' , '$cardid' , '$crdproduct' , '$programid' ,  '$brncode' ,
'$txncode' , '$txnsubcode' , '$curtxn' , '$amttxn' , '$amtfee' , '$amttxncb' , '$curset' , '$rateset' , '$amtset' ,
'$billamt' , '$acccur' , '$accno' , '$acctype' , '$billconvrate' , '$approvalcode' , '$cortexdate' ,
'$stan' , '$rrn' , '$termcode' ,  '$crdacptid' , '$afe' , '$termlocation' , '$termstreet' , '$termcity' ,
'$termcountry' , '$schema' , '$arn' , '$fiid' , '$riid' , '$reasoncode' , '$chic' , '$chac' , '$chp' , '$cp' ,
'$cdim' , '$cham' , '$cha' , '$tvr' , '$msgsrc' , '$rcc' , '$mcc' , '$cbackind' , '$txndate' , '$txntime' , '$termtype' ,
'$ctxdatelocal' , '$ctxtimelocal' , '$aiid' , '$dlvcycle' ,'$actioncode',
'$rspcode' )";

$resultinsertqueryfinadv = mysqli_query($con, $insertqueryfinadv) ; 
if($resultinsertqueryfinadv)
{
$finadv++;
}

}




//if statement for new xml tag
if($child->getName() =='ADJUST'){
foreach($child as $innerchild) {
/*
This loop is matching with all the inner child tags
if statements are to match with the predefined  tags if
the conditions are true it will store the values to the variables created in
each if statement and later on these newly created variables will be used in the
sql query to insert one row for each iteration */
if ($innerchild->getName() == 'LOCALDATE') { $localdate = $innerchild;  }  if ($innerchild->getName() == 'LOCALTIME') { $localtime = $innerchild;  }  
if ($innerchild->getName() == 'ITEMID') { $itemid = $innerchild;  }  if ($innerchild->getName() == 'MSGID') { $msgid = $innerchild;  }  
if ($innerchild->getName() == 'PAN') { $pan = $innerchild;  }  if ($innerchild->getName() == 'CARDID') { $cardid = $innerchild;  } 
if ($innerchild->getName() == 'CRDPRODUCT') { $crdproduct = $innerchild;  }  if ($innerchild->getName() == 'PROGRAMID') { $programid = $innerchild;  } 
if ($innerchild->getName() == 'BRNCODE') { $brncode = $innerchild;  }  if ($innerchild->getName() == 'CURBILL') { $curbill = $innerchild;  }  
if ($innerchild->getName() == 'ACCCUR') { $acccur = $innerchild;  }  if ($innerchild->getName() == 'ACCNO') { $accno = $innerchild;  } 
if ($innerchild->getName() == 'ACCTYPE') { $acctype = $innerchild;  }  if ($innerchild->getName() == 'AMTBILL') { $amtbill = $innerchild;  } 
if ($innerchild->getName() == 'CORTEXDATE') { $cortexdate = $innerchild;  }  
if ($innerchild->getName() == 'CRDACPTID') { $crdacptid = $innerchild;  } 
if ($innerchild->getName() == 'REV') { $rev = $innerchild;  } 
if ($innerchild->getName() == 'ORGITEMID') { $orgitemid = $innerchild;  }  
if ($innerchild->getName() == 'DESCRIPTION') { $description = $innerchild;  }  if ($innerchild->getName() == 'EXTCODE') { $extcode = $innerchild;  } 
if ($innerchild->getName() == 'CTXDATELOCAL') { $ctxdatelocal = $innerchild;  }  if ($innerchild->getName() == 'CTXTIMELOCAL') { $ctxtimelocal = $innerchild;  }
if ($innerchild->getName() == 'FIRSTNAME') { $firstname = $innerchild;  }  if ($innerchild->getName() == 'LASTNAME') { $lastname = $innerchild;  }
if ($innerchild->getName() == 'USRDATA1') { $usrdata1 = $innerchild;  }  if ($innerchild->getName() == 'USRDATA2') { $usrdata2 = $innerchild;  }
if ($innerchild->getName() == 'USRDATA3') { $usrdata3 = $innerchild;  }  if ($innerchild->getName() == 'USRDATA4') { $usrdata4 = $innerchild;  }
if ($innerchild->getName() == 'TXNCODE') { $txncode = $innerchild;  }  if ($innerchild->getName() == 'CURTXN') { $curtxn = $innerchild;  }
if ($innerchild->getName() == 'AMTTXN') { $amttxn = $innerchild;  }  if ($innerchild->getName() == 'BILLCONVRATE') { $billconvrate = $innerchild;  } }

$insertqueryAdjust = " insert into   `adjust` values ('$localdate' , '$localtime' , '$itemid' , '$msgid' , '$pan' , '$cardid' , '$crdproduct' , 
'$programid' , '$brncode' , '$curbill' , '$acccur' , '$accno' , '$acctype' , '$amtbill' , '$cortexdate' ,'$rev' ,
  '$orgitemid' , '$description' , '$extcode' , '$ctxdatelocal' , '$ctxtimelocal' , 
 '$firstname' , '$lastname' , '$usrdata1' , '$usrdata2' , '$usrdata3' , '$usrdata4' , '$txncode' , '$curtxn' , 
 '$amttxn' , '$billconvrate' )";
 
//echo $insertqueryAdjust."<br/>";
$resultinsertqueryAdjust = mysqli_query($con, $insertqueryAdjust) ; 
if($resultinsertqueryAdjust)
{
$adjust++;
}

}







//if statement for new xml tag
if($child->getName() =='CARDLOAD'){
foreach($child as $innerchild) {
/*
This loop is matching with all the inner child tags
if statements are to match with the predefined  tags if
the conditions are true it will store the values to the variables created in
each if statement and later on these newly created variables will be used in the
sql query to insert one row for each iteration */



if ($innerchild->getName() == 'LOCALDATE') { $localdate = $innerchild;  }  if ($innerchild->getName() == 'LOCALTIME') { $localtime = $innerchild;  } 
if ($innerchild->getName() == 'ITEMID') { $itemid = $innerchild;  }  if ($innerchild->getName() == 'MSGID') { $msgid = $innerchild;  }
if ($innerchild->getName() == 'PAN') { $pan = $innerchild;  }  if ($innerchild->getName() == 'CARDID') { $cardid = $innerchild;  }
if ($innerchild->getName() == 'CRDPRODUCT') { $crdproduct = $innerchild;  }  if ($innerchild->getName() == 'PROGRAMID') { $programid = $innerchild;  }
if ($innerchild->getName() == 'BRNCODE') { $brncode = $innerchild;  }  if ($innerchild->getName() == 'CURBILL') { $curbill = $innerchild;  }
if ($innerchild->getName() == 'ACCCUR') { $acccur = $innerchild;  }  if ($innerchild->getName() == 'ACCNO') { $accno = $innerchild;  }
if ($innerchild->getName() == 'ACCTYPE') { $acctype = $innerchild;  }  if ($innerchild->getName() == 'AMTBILL') { $amtbill = $innerchild;  }
if ($innerchild->getName() == 'CORTEXDATE') { $cortexdate = $innerchild;  }  if ($innerchild->getName() == 'CRDACPTID') { $crdacptid = $innerchild;  }
if ($innerchild->getName() == 'REV') { $rev = $innerchild;  }  if ($innerchild->getName() == 'ORGITEMID') { $orgitemid = $innerchild;  }
if ($innerchild->getName() == 'DESCRIPTION') { $description = $innerchild;  }  if ($innerchild->getName() == 'LOADSRC') { $loadsrc = $innerchild;  }
if ($innerchild->getName() == 'LOADTYPE') { $loadtype = $innerchild;  }  if ($innerchild->getName() == 'CTXDATELOCAL') { $ctxdatelocal = $innerchild;  }
if ($innerchild->getName() == 'CTXTIMELOCAL') { $ctxtimelocal = $innerchild;  }  if ($innerchild->getName() == 'TERMINALID') { $terminalid = $innerchild;  }
if ($innerchild->getName() == 'INITLOAD') { $initload = $innerchild;  }  if ($innerchild->getName() == 'CURTXN') { $curtxn = $innerchild;  }
if ($innerchild->getName() == 'AMTTXN') { $amttxn = $innerchild;  }  if ($innerchild->getName() == 'BILLCONVRATE') { $billconvrate = $innerchild;  } 
}
$insertqueryCardload = " insert into   `cardload` values ('$localdate' , '$localtime' , '$itemid' , '$msgid' , '$pan' , '$cardid' , '$crdproduct' ,
 '$programid' , '$brncode' , '$curbill' , '$acccur' , '$accno' , '$acctype' , '$amtbill' , '$cortexdate' , '$crdacptid' , '$rev' , '$orgitemid' , 
 '$description' , '$loadsrc' , '$loadtype' , '$ctxdatelocal' , '$ctxtimelocal' , '$terminalid' , '$initload' , 
 '$curtxn' , '$amttxn' , '$billconvrate'  )";
 //echo $insertqueryCardload."<br/>";
 $resultinsertqueryCardload = mysqli_query($con,$insertqueryCardload); 
if($resultinsertqueryCardload)
{
$cardload++;
}

}

//if statement for new xml tag
if($child->getName() =='CARDUNLOAD'){
foreach($child as $innerchild) {
/*
This loop is matching with all the inner child tags
if statements are to match with the predefined  tags if
the conditions are true it will store the values to the variables created in
each if statement and later on these newly created variables will be used in the
sql query to insert one row for each iteration */


if ($innerchild->getName() == 'LOCALDATE') { $localdate = $innerchild;  }  if ($innerchild->getName() == 'LOCALTIME') { $localtime = $innerchild;  } 
if ($innerchild->getName() == 'ITEMID') { $itemid = $innerchild;  }  if ($innerchild->getName() == 'MSGID') { $msgid = $innerchild;  }  
if ($innerchild->getName() == 'PAN') { $pan = $innerchild;  }  if ($innerchild->getName() == 'CARDID') { $cardid = $innerchild;  }  
if ($innerchild->getName() == 'CRDPRODUCT') { $crdproduct = $innerchild;  }  if ($innerchild->getName() == 'PROGRAMID') { $programid = $innerchild;  } 
if ($innerchild->getName() == 'BRNCODE') { $brncode = $innerchild;  }  if ($innerchild->getName() == 'CURBILL') { $curbill = $innerchild;  } 
if ($innerchild->getName() == 'ACCCUR') { $acccur = $innerchild;  }  if ($innerchild->getName() == 'ACCNO') { $accno = $innerchild;  } 
if ($innerchild->getName() == 'ACCTYPE') { $acctype = $innerchild;  }  if ($innerchild->getName() == 'AMTBILL') { $amtbill = $innerchild;  }
if ($innerchild->getName() == 'CORTEXDATE') { $cortexdate = $innerchild;  }  if ($innerchild->getName() == 'CRDACPTID') { $crdacptid = $innerchild;  }
if ($innerchild->getName() == 'REV') { $rev = $innerchild;  }  if ($innerchild->getName() == 'ORGITEMID') { $orgitemid = $innerchild;  }
if ($innerchild->getName() == 'DESCRIPTION') { $description = $innerchild;  }  if ($innerchild->getName() == 'LOADSRC') { $loadsrc = $innerchild;  }
if ($innerchild->getName() == 'LOADTYPE') { $loadtype = $innerchild;  }  if ($innerchild->getName() == 'CTXDATELOCAL') { $ctxdatelocal = $innerchild;  }
if ($innerchild->getName() == 'CTXTIMELOCAL') { $ctxtimelocal = $innerchild;  }  if ($innerchild->getName() == 'TERMINALID') { $terminalid = $innerchild;  } 
}
$insertqueryCardunload = " insert into   `cardunload` values ('$localdate' , '$localtime' , '$itemid' , '$msgid' , '$pan' , '$cardid' , '$crdproduct' , 
'$programid' , '$brncode' , '$curbill' , '$acccur' , '$accno' , '$acctype' , '$amtbill' , '$cortexdate' , 
'$crdacptid' , '$rev' , '$orgitemid' , '$description' , 
'$loadsrc' , '$loadtype' , '$ctxdatelocal' , '$ctxtimelocal' , '$terminalid')";
//echo $insertqueryCardunload."<br/>";
$resultinsertqueryCardunload = mysqli_query($con, $insertqueryCardunload ) ; 
if($resultinsertqueryCardunload)
{
$cardunload++;
}}


//if statement for new xml tag
if($child->getName() =='CHRGBACK'){
foreach($child as $innerchild) {
/*
This loop is matching with all the inner child tags
if statements are to match with the predefined  tags if
the conditions are true it will store the values to the variables created in
each if statement and later on these newly created variables will be used in the
sql query to insert one row for each iteration */

if ($innerchild->getName() == 'MTID') { $mtid = $innerchild;}if ($innerchild->getName() == 'REPEAT'){ $repeat = $innerchild;} 
if ($innerchild->getName() == 'LOCALDATE'){ $localdate = $innerchild;}if ($innerchild->getName() == 'LOCALTIME') { $localtime = $innerchild;  } 
if ($innerchild->getName() == 'TLOGID') {$tlogid = $innerchild;}if ($innerchild->getName() == 'PAN') { $pan = $innerchild;  } 
if ($innerchild->getName() == 'CARDID') {$cardid = $innerchild;  }if ($innerchild->getName() == 'CRDPRODUCT') { $crdproduct = $innerchild;  } 
if ($innerchild->getName() == 'PROGRAMID'){ $programid = $innerchild;}if ($innerchild->getName() == 'BRNCODE') { $brncode = $innerchild;  } 
if ($innerchild->getName() == 'TXNCODE') { $txncode = $innerchild;}if ($innerchild->getName() == 'TXNSUBCODE') { $txnsubcode = $innerchild;} 
if ($innerchild->getName() == 'CURTXN') { $curtxn = $innerchild;}if ($innerchild->getName() == 'AMTTXN') { $amttxn = $innerchild;  } 
if ($innerchild->getName() == 'AMTFEE') { $amtfee = $innerchild;}if ($innerchild->getName() == 'AMTTXNCB') { $amttxncb = $innerchild;  } 
if ($innerchild->getName() == 'CURSET') { $curset = $innerchild;}if ($innerchild->getName() == 'RATESET') { $rateset = $innerchild;  } 
if ($innerchild->getName() == 'AMTSET') { $amtset = $innerchild;}if ($innerchild->getName() == 'BILLAMT') { $billamt = $innerchild;  } 
if ($innerchild->getName() == 'ACCCUR') { $acccur = $innerchild;}if ($innerchild->getName() == 'ACCNO') { $accno = $innerchild;  } 
if ($innerchild->getName() == 'ACCTYPE') { $acctype = $innerchild;}  if ($innerchild->getName() == 'BILLCONVRATE') { $billconvrate = $innerchild;  } 
if ($innerchild->getName() == 'DATESET') { $dateset = $innerchild;  }  if ($innerchild->getName() == 'APPROVALCODE') { $approvalcode = $innerchild;  } 
if ($innerchild->getName() == 'CORTEXDATE') { $cortexdate = $innerchild;  }  if ($innerchild->getName() == 'STAN') { $stan = $innerchild;  } 
if ($innerchild->getName() == 'RRN') { $rrn = $innerchild;  }  if ($innerchild->getName() == 'TERMCODE') { $termcode = $innerchild;  } 
if ($innerchild->getName() == 'CRDACPTID') { $crdacptid = $innerchild;  }  if ($innerchild->getName() == 'AFE') { $afe = $innerchild;  } 
if ($innerchild->getName() == 'TERMLOCATION') { $termlocation = $innerchild;  }  if ($innerchild->getName() == 'TERMSTREET') { $termstreet = $innerchild;  } 
if ($innerchild->getName() == 'TERMCITY') { $termcity = $innerchild;  }  if ($innerchild->getName() == 'TERMCOUNTRY') { $termcountry = $innerchild;  } 
if ($innerchild->getName() == 'STANORG') { $stanorg = $innerchild;  }  if ($innerchild->getName() == 'SCHEMA') { $schema = $innerchild;  } 
if ($innerchild->getName() == 'ARN') { $arn = $innerchild;  }  if ($innerchild->getName() == 'FIID') { $fiid = $innerchild;  } 
if ($innerchild->getName() == 'RIID') { $riid = $innerchild;  }  if ($innerchild->getName() == 'REASONCODE') { $reasoncode = $innerchild;  } 
if ($innerchild->getName() == 'CHIC') { $chic = $innerchild;  }  if ($innerchild->getName() == 'CHAC') { $chac = $innerchild;  } 
if ($innerchild->getName() == 'CHP') { $chp = $innerchild;  }  if ($innerchild->getName() == 'CP') { $cp = $innerchild;  } 
if ($innerchild->getName() == 'CDIM') { $cdim = $innerchild;  }  if ($innerchild->getName() == 'CHAM') { $cham = $innerchild;  } 
if ($innerchild->getName() == 'CHA') { $cha = $innerchild;  }  if ($innerchild->getName() == 'MSGSRC') { $msgsrc = $innerchild;  } 
if ($innerchild->getName() == 'MCC') { $mcc = $innerchild;  }  if ($innerchild->getName() == 'TERMTYPE') { $termtype = $innerchild;  }
if ($innerchild->getName() == 'CTXLOCALDATE') { $ctxlocaldate = $innerchild;  }  if ($innerchild->getName() == 'CTXLOCALTIME') { $ctxlocaltime = $innerchild;  } 
if ($innerchild->getName() == 'AIID') { $aiid = $innerchild;  }
}


$insertqueryChrgback = " insert into   `chrgback` values ('$mtid' , '$repeat' , '$localdate' , '$localtime' , '$tlogid' , '$pan' ,
 '$cardid' , '$crdproduct' , '$programid' , '$brncode' , '$txncode' , '$txnsubcode' ,
 '$curtxn' , '$amttxn' , '$amtfee' , '$amttxncb' , '$curset' , '$rateset' , '$amtset' ,
 '$billamt' , '$acccur' , '$accno' , '$acctype' , '$billconvrate' , '$dateset' , 
 '$approvalcode' , '$cortexdate' , '$stan' , '$rrn' , '$termcode' , '$crdacptid' ,
 '$afe' , '$termlocation' , '$termstreet' , '$termcity' , '$termcountry' , 
 '$stanorg' , '$schema' , '$arn' , '$fiid' , '$riid' , '$reasoncode' , 
 '$chic' , '$chac' , '$chp' , '$cp' , '$cdim' , '$cham' , '$cha' , '$msgsrc' , 
 '$mcc' , '$termtype' , '$ctxdatelocal' , '$ctxtimelocal' , '$aiid' )";
 //echo $insertqueryChrgback."<br/>";
$resultinsertqueryChrgback = mysqli_query($con, $insertqueryChrgback ) ; 

if($resultinsertqueryChrgback)
{
$chrgback++;
}

}




//if statement for new xml tag
if($child->getName() =='FEE'){
foreach($child as $innerchild) {
/*
This loop is matching with all the inner child tags
if statements are to match with the predefined  tags if
the conditions are true it will store the values to the variables created in
each if statement and later on these newly created variables will be used in the
sql query to insert one row for each iteration */


if ($innerchild->getName() == 'MTID') { $mtid = $innerchild;  }  if ($innerchild->getName() == 'FEETYPE') { $feetype = $innerchild;  }  
if ($innerchild->getName() == 'FEEID') { $feeid = $innerchild;  }  
if ($innerchild->getName() == 'ITEMID') { $itemid = $innerchild;  }  if ($innerchild->getName() == 'ORGITEMID') { $orgitemid = $innerchild;  }  
if ($innerchild->getName() == 'TLOGID') { $tlogid = $innerchild;  }  if ($innerchild->getName() == 'FEEDESCR') { $feedscr = $innerchild;  }  
if ($innerchild->getName() == 'DEBORCRED') { $deborcred = $innerchild;  }  if ($innerchild->getName() == 'LOCALDATE') { $localdate = $innerchild;  }  
if ($innerchild->getName() == 'LOCALTIME') { $localtime = $innerchild;  }  if ($innerchild->getName() == 'TXNCODE') { $txncode = $innerchild;  }  
if ($innerchild->getName() == 'TXNSUBCODE') { $txnsubcode = $innerchild;  }  if ($innerchild->getName() == 'CURTXN') { $curtxn = $innerchild;  }  
if ($innerchild->getName() == 'AMTTXN') { $amttxn = $innerchild;  }  if ($innerchild->getName() == 'CURSET') { $curset = $innerchild;  }  
if ($innerchild->getName() == 'AMTSET') { $amtset = $innerchild;  }  if ($innerchild->getName() == 'PAN') { $pan = $innerchild;  }  
if ($innerchild->getName() == 'CARDID') { $cardid = $innerchild;  }  if ($innerchild->getName() == 'CRDPRODUCT') { $crdproduct = $innerchild;  }  
if ($innerchild->getName() == 'PROGRAMID') { $programid = $innerchild;  }  if ($innerchild->getName() == 'BRNCODE') { $brncode = $innerchild;  } 
if ($innerchild->getName() == 'FIID') { $fiid = $innerchild;  }  if ($innerchild->getName() == 'CRDACPTID') { $crdacptid = $innerchild;  }  
if ($innerchild->getName() == 'REASONCODE') { $reasoncode = $innerchild;  }  if ($innerchild->getName() == 'MSGSRC') { $msgsrc = $innerchild;  }  
if ($innerchild->getName() == 'BILLAMT') { $billamt = $innerchild;  }  if ($innerchild->getName() == 'ACCCUR') { $acccur = $innerchild;  }  
if ($innerchild->getName() == 'ACCNO') { $accno = $innerchild;  }  if ($innerchild->getName() == 'ACCTYPE') { $acctype = $innerchild;  }  
if ($innerchild->getName() == 'CORTEXDATE') { $cortexdate = $innerchild;  }  if ($innerchild->getName() == 'TXNDATE') { $txndate = $innerchild;  }  
if ($innerchild->getName() == 'TXNTIME') { $txntime = $innerchild;  }  if ($innerchild->getName() == 'ITEMSRC') { $itemsrc = $innerchild;  }  
if ($innerchild->getName() == 'CTXDATELOCAL') { $ctxdatelocal = $innerchild;  }  if ($innerchild->getName() == 'CTXTIMELOCAL') { $ctxtimelocal = $innerchild;  }
}


$insertqueryfee = " insert into   `fee` values ('$mtid' , '$feetype' , '$feeid' , '$itemid' , '$orgitemid' , '$tlogid' , '$feedscr' ,
 '$deborcred' , '$localdate' , '$localtime' , '$txncode' , '$txnsubcode' , '$curtxn' , '$amttxn' , 
 '$curset' , '$amtset' , '$pan' , '$cardid' , '$crdproduct' , '$programid' , '$brncode' , '$fiid' ,
 '$crdacptid' , '$reasoncode' , '$msgsrc' , '$billamt' , '$acccur' , '$accno' , '$acctype' , 
 '$cortexdate' , '$txndate' , '$txntime' , '$itemsrc' , '$ctxdatelocal' , '$ctxtimelocal' )";
 
$resultinsertqueryfee = mysqli_query($con, $insertqueryfee ) ; 
if($resultinsertqueryfee)
{
$fee++;
}

}
}

$authadv = "Authadv records entered ".$authadv;
$authrev = "Authrev records entered ".$authrev;
$finadv = "Finadv records entered ".$finadv;
$adjust = "Adjust records entered ".$adjust;
$cardload = "Card Load records entered ".$cardload;
$cardunload = "Card Unload records ".$cardunload;
$fee  = "Fee records entered ".$fee;
$chrgback = "Charge back records entered ".$chrgback;
$date = $fileDate;
log_message('info',$authadv);
log_message('info',$authrev);
log_message('info',$finadv);
log_message('info',$adjust);
log_message('info',$cardload);
log_message('info',$cardunload);
log_message('info',$fee);
log_message('info',$chrgback);
log_message('info',$fileDate);


$arrayCounts = array('Authadv'=>$authadv, 'Authrev'=>$authrev,'Finadv'=>$finadv, 'Adjust'=>$adjust,'Cardload'=>$cardload  ,'Cardunload'=>$cardunload , 'Fee'=>$fee, 'Chargeback'=>$chrgback, 'Date'=>$date);

/*echo " import is done for the Authadv no of records added : $authadv for the date $date </br>";
echo " import is done for the Authrev no of records added : $authrev for the date $date </br>";
echo " import is done for the finadv no of records added : $finadv for the date $date </br>";
echo " import is done for the Adjust no of records added : $adjust for the date $date </br>";
echo " import is done for the Cardload no of records added : $cardload for the date $date </br>";
echo " import is done for the Cardunload no of records added : $cardload for the date $date </br>";
echo " import is done for the Fee no of records added : $fee for the date $date </br>";
echo " import is done for the Fee no of records added : $chrgback for the date $date </br>";  */
//$arrayCounts = array('Adjust'=>$adjust);
$this->load->helper('url');
$this->load->view('createDatabase',$arrayCounts);
//$this->load->view('content/createDatabase',$arrayCounts);
}

else
{

$arrayCounts = array('Date'=>$fileDate);
$this->load->helper('url');
$this->load->view('noCreateDatabase',$arrayCounts);
}

//if


//print $xmlDoc->saveXML();

}
//public  $dbname = 'france';
public function importdata($date)
{
$con = mysql_connect("localhost","root","ankit");
if (!$con)
{
die('Could not connect: ' . mysqli_error());
}
$insertquery = "LOAD XML LOCAL INFILE 'C:/wamp/www/ankitdev/france/ftpdata/TCFaccexcept20140609.xml'
INTO TABLE  tcfaccexcept(`pan`, `cardid`, `crdexpdate`,`crdproduct`,`programid`, `acctype`,`itemid`,`tlogid`,`amtbill`,`curbillalpha`,`datelocal`,`aprvlcode`,`rrn`,`accno`,`custcode`,`avlbal`,`blkamt`,`origloadamt`,`maxbal`,`instcode` ); ";
$dbname = 'france';
mysql_select_db($dbname,$con);
echo $insertquery."<br>";
$resultinsertquery = mysqli_query($insertquery,$con);
if($resultinsertquery)
{

}
}





}


?>