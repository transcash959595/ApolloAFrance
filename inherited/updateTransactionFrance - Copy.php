<?php

   
   
   include 'datacon.php';
   //Including a php file to add to this class this is only to help in the database connection
   class updatetransaction
   {   
     private  $startdate ='07/01/2015'; 
     // To check manually , to make a direct call to this php page, bypassing the jquery , for the purpose of troubleshooting    
	 private  $database = 'france';
	 // Setting up the name to the database 	 
   public function cleanData($tableToClean)
   {
   /* 
   This function is to truncate the table which is supposed to be filled with new information with another process or iterations.
   The function acceptind one  argument, which is the name of the function to truncate in the my sql database 
   */
     $database =  $this->database;
      // Setting the database 
     $objdatacon = new database();
     // Creating the an instance for the database class which is include at the top		
     $con = $objdatacon->con();   
      // Creating a connection object
	 $Account_truncate="truncate `".$tableToClean."`";	
	 // Creating the Mysql query string 
	 $objdatacon->truncate($database, $Account_truncate);    
     // Calling another function in the database class to actually run the query
   }
   
   public function update_transaction_fees_fis($startdate,$lastdate)
   {
   /*
   Purpose : This function is created  to update required transactions based on the account  and the argument passed.
   This function basically runs like an iterator itself with the help of the while loop.
   This function will select the  rows from the table passed as an argument also based on the conditions
   on where clause which has specific condition such as the type of fees. It will then apply calculation 
   usually the addition  to combine similar transactions . Finally it combines similar transactions
   and insert it into the one simple table that has  credit, debit, description and date this table also 
   has subtotal rows inserted by the the iterations.The function takes two  arguments first one is the startdate
   to start the iterations from second

   */
   
   $startdate = $startdate; 
   
    $todaydate = $lastdate;	
    //$todaydate = $this->$todaydate; 
	$todaydate   = strtotime($todaydate);
	
	$todaydate =  date("m/d/Y",$todaydate );
	
    $enddate = $todaydate;
	
	$arrayFeeDescription = array("SMS service","Frais de rejet de transaction",
		"Frais de rejet au DAB","Frais de consultation de solde","Frais de remboursement",
		"Frais de retrait international","Frais de retrait","Frais de retrait au guichet",
		"Frais de renouvellement","Frais de changement de PIN au","Frais de gestion");
	// Array above is representing the types of fees  in the fee table 
 
$datetime_start = strtotime($startdate);
$datetime_end   = strtotime($enddate);	
// Initialize the accounts and variables 	
$datetime_temp  = $datetime_start;

while ($datetime_temp <= $datetime_end) {
$newdate_reserve = date('Y/m/d', $datetime_temp);	
$getdate_reserve = str_replace("/","-",$newdate_reserve);
$feesubtotal = 0;

set_time_limit(0);
$objdatacon = new database();		
$con = mysqli_connect("localhost","root","","france")or die ("could not connect to mysqli database");  
    
    $newdate = date('m/d/Y', $datetime_temp);		 
	
	
	
	// This is to make database selection with the help of object named con
	foreach ($arrayFeeDescription as $feeDescription)
	 {
	 	$feeSumfetchQuery="SELECT SUM( `BILLAMT` ), `FEEDSCR` ,`DEBORCRED`  FROM  `fee`
	  WHERE `TXNDATE` = '".$getdate_reserve."' and `FEEDSCR` = '".$feeDescription."'  ";
	  // Query  for sms service fee from france database

	echo $feeSumfetchQuery."<br>";
	$result_feeSumfetchQuery= mysqli_query($con,$feeSumfetchQuery);
	if($result_feeSumfetchQuery)
	{ 
	 $result_feeSumfetchQueryArray=mysqli_fetch_array($result_feeSumfetchQuery);	

     if($result_feeSumfetchQueryArray[0])
	{
	
	
	$feesubtotal  = $feesubtotal  + $result_feeSumfetchQueryArray[0];	

    if($result_feeSumfetchQueryArray[0]==1)
	{ 
	$insertFeeAmountQuery = "INSERT INTO `accountFrance`  "." (Date, Description, Req_code, Debit, Credit) VALUES('".$newdate."','".$result_feeSumfetchQueryArray[1]."','',".$result_feeSumfetchQueryArray[0]."','')";
	  echo $insertFeeAmountQuery."<br>";
      mysqli_query($con,$insertFeeAmountQuery);}
	else {
     $insertFeeAmountQuery = "INSERT INTO `accountFrance`  "." (Date, Description, Req_code, Debit, Credit) VALUES('".$newdate."','".$result_feeSumfetchQueryArray[1]."','','','".$result_feeSumfetchQueryArray[0]."')";
	echo $insertFeeAmountQuery."<br>";
    mysqli_query($con,$insertFeeAmountQuery);	}}}}
	

    $insertFeeSubtotal= "INSERT INTO `accountFrance`  "." (Date, Description, Req_code, Debit, Credit) VALUES('".$newdate."','Sub','Total ','Fees','".$feesubtotal."')";
	echo $insertFeeSubtotal."<br>";
    mysqli_query($con,$insertFeeSubtotal);	


 $datetime_temp = strtotime('+1 day', $datetime_temp); }
echo "database updated";
echo "</br> Between ".$startdate. " and  ". $enddate;

// Function ends here 
}










 public function update_transaction_loading($startdate,$lastdate)
 {
 	/*
 Purpose :
 This function is same as above and the only difference is that
 its only for loading part.
 	*/
$con = mysqli_connect("","root","","france")or die ("could not connect to mysqli database");  
$startdate = $startdate;    
$todaydate = $lastdate;	
//$todaydate = $this->$todaydate; 
$todaydate   = strtotime($todaydate);	
$todaydate =  date("m/d/Y",$todaydate );	
$enddate = $todaydate;	
$arrayFeeDescription = array("Frais","Rechargement");
// Array above is representing the types of fee in the fee table  
$datetime_start = strtotime($startdate);
$datetime_end   = strtotime($enddate);	
// Initialize the accounts and variables 	
$datetime_temp  = $datetime_start;
while ($datetime_temp <= $datetime_end) {
$newdate_reserve = date('Y/m/d', $datetime_temp);	
$getdate_reserve = str_replace("/","-",$newdate_reserve);
$feesubtotal = 0;
$revenueForLoad = 0;
set_time_limit(0);
$objdatacon = new database();		
//$con = $objdatacon->con();    
$newdate = date('m/d/Y', $datetime_temp);		 
//$dbname='france';	
//mysql_select_db($dbname,$con);	
$revenueForLoad = 0;	

$feeSumfetchQuery="SELECT SUM( `AMTBILL` )   FROM  `cardload` WHERE `LOCALDATE` = '".$getdate_reserve."' and `DESCRIPTION` like '%".$arrayFeeDescription[0]."%'  ";
// Query for sms service fee from france database
echo $feeSumfetchQuery."<br>";

$result_feeSumfetchQuery = mysqli_query($con, $feeSumfetchQuery);
//$result_feeSumfetchQuery= mysql_query($feeSumfetchQuery,$con);
if($result_feeSumfetchQuery)
{
$result_feeSumfetchQueryArray = mysqli_fetch_array($result_feeSumfetchQuery);	
 if(abs($result_feeSumfetchQueryArray[0]))
{		
$feesubtotal  = $feesubtotal  + abs($result_feeSumfetchQueryArray[0]);	
$insertFeeAmountQuery = "INSERT INTO `loadingnew`  "." (Date, Description, Req_code, Debit, Credit) VALUES('".$newdate."','".$arrayFeeDescription[0]."','','','".abs($result_feeSumfetchQueryArray[0])."')";
echo $insertFeeAmountQuery."<br>";
//mysql_query($insertFeeAmountQuery);
mysqli_query($con, $insertFeeAmountQuery);
}} 
 	
// These line are to determine if the fees description is for the loading only 
$feeSumfetchQuery="SELECT *    FROM  `cardload`
  WHERE `LOCALDATE` = '".$getdate_reserve."' and `DESCRIPTION` like '%".$arrayFeeDescription[1]."%'  ";
//$result = mysql_query($feeSumfetchQuery,$con);
$result = mysqli_query($con, $feeSumfetchQuery);
//$num=mysqli_num_rows($result);
//$i=0;
echo $feeSumfetchQuery."<br>";
while ($row = mysqli_fetch_assoc($result)) {
// loop to get the required fields from the result set 


   $amountBill = $row['AMTBILL'];
   $description = $row['DESCRIPTION']; 
   //$amountBill = mysqli_result($result,$i,"AMTBILL");
  // $description = mysqli_result($result,$i,"DESCRIPTION");


echo $description."This is the complete description <br>";
$revenueForLoad = 0;
echo $amountBill."".$description."<br>";
if (strpos($description,'internet') !== false)
{
echo " Credit Card load  should be 5 percentage of ".$amountBill."<br>";
$percentage = (5*$amountBill)/2;
$revenueForLoad = number_format( $percentage /100, 2 );
$revenueForLoad = $revenueForLoad + abs($revenueForLoad);
$description = 'Credit Card';
}
else
{
if(strpos($description,'virement') !== false)
{
echo " Bank Transfer should be 3 percentage of ".$amountBill." <br>";
$percentage = (3*$amountBill)/2;
$revenueForLoad = number_format( $percentage /100, 2 );
$revenueForLoad = $revenueForLoad + abs($revenueForLoad);
$description = 'Bank Transfer';
}
else
{

 
   
   
   if($amountBill == 500.00) { 
   echo "Equal to  500 <br>";
   $revenueForLoad = $revenueForLoad + 25;
   $description = 'Voucher'; }
   
   
   if($amountBill == 300.00) { 
   echo "Equal to  300 <br>";
   $revenueForLoad = $revenueForLoad + 15; 
   $description = 'Voucher'; 

   }
   
   
   if($amountBill == 200.00) { 
   echo "Equal to  200 <br>";
   $revenueForLoad = $revenueForLoad + 12;  
   $description = 'Voucher';

   }
   
   
   if($amountBill == 50.00) { 
   echo "Equal to  50 <br>";
   $revenueForLoad = $revenueForLoad + 5;  
   $description = 'Voucher';

   }
   
   if($amountBill == 100.00){ 
     $revenueForLoad = $revenueForLoad + 8;
     $description = 'Voucher';
	  echo "Equal to  100 <br>";
   } 
     // Add 8 $ to the fees sub total

    if($amountBill == 150.00 ) {
	$revenueForLoad = $revenueForLoad + 10;
  $description = 'Voucher';
	echo "Equal to  150 <br>";
	} 
	 
	 if($amountBill < 50.00)  { // Making a comparison if the value is more than 150.  Take the 5% of the value and add it as a fees
  
   $percentage = 10*$amountBill;
   $revenuePercentage = number_format( $percentage / 100, 2 );
  $revenueForLoad = $revenueForLoad + $revenuePercentage;
  echo "Less than 50 <br>";
  $description = 'Voucher';
   }

}




}

 //Add 10 $ to the fees sub total 
 // Main if ends here that check if there is any result coming from the data base 


$feesubtotal  = $feesubtotal  + abs($revenueForLoad);	 // Calculating the fees subtotal  for this particular type of query abs is to get the value in positive or the absolute because the data stored is in negative 
$insertFeeAmountQuery = "INSERT INTO `loadingnew`  "." (Date, Description, Req_code, Debit, Credit) VALUES('".$newdate."','".$description."','".$amountBill."','','".$revenueForLoad."')";
echo $insertFeeAmountQuery."<br>";
mysqli_query($con, $insertFeeAmountQuery);


//$i++;

}
// Creating the query for the select statement from the adjust database 
// This is where the if condition for rechargement ends 
 	
	
	




$insertFeeSubtotal= "INSERT INTO `loadingnew`  "." (Date, Description, Req_code, Debit, Credit) VALUES('".$newdate."','Sub','Total ','Fees','".$feesubtotal."')";

	echo $insertFeeSubtotal."<br>";
	mysqli_query($con, $insertFeeSubtotal);
	
   // mysqli_query($insertFeeSubtotal);	

 $datetime_temp = strtotime('+1 day', $datetime_temp);     // This is where for each loop ends 
}


echo "Loading database updated";
echo "</br> Between ".$startdate. " and  ". $enddate;

}//function ends here 






function update_interchange_fees($startdate,$lastdate)
{ 
   
$startdate = $startdate;    

$lastdate   = strtotime($lastdate);	
$lastdate =  date("m/d/Y",$lastdate );	
$enddate = $lastdate;	
$datetime_start = strtotime($startdate);
$datetime_end   = strtotime($enddate);	
$datetime_temp  = $datetime_start;
$month = 01;
while ($datetime_temp <= $datetime_end) {
$newdate_start = date('Y/m/d', $datetime_temp);
$newdate_end = date('Y/m/d', $datetime_end);	
$getdate_reserve_start = str_replace("/","-",$newdate_start);
$getdate_reserve_end = str_replace("/","-",$newdate_end);
$feesubtotal = 0;
$revenueForLoad = 0;
set_time_limit(0);
//$objdatacon = new database();		
$con = mysqli_connect("","root","","france")or die ("could not connect to mysqli database");  
$newdate = date('m/d/Y', $datetime_temp);		 


$feeSumfetchQuery="SELECT SUM( `AMTBILL` )   FROM  `adjust` WHERE 
WHERE  `Description` like '%Frais%'and  `LOCALDATE` >= '".$getdate_reserve_start."' and `LOCALDATE` <= '".$getdate_reserve_end."'  ";
echo $feeSumfetchQuery."<br>";
$result_feeSumfetchQuery= mysqli_query($con,$feeSumfetchQuery);
if($result_feeSumfetchQuery){
$result_feeSumfetchQueryArray=mysqli_fetch_array($result_feeSumfetchQuery);	
 if(abs($result_feeSumfetchQueryArray[0]))
{$adjustfees  =$result_feeSumfetchQueryArray[0];}}    


 


$feesubtotal  = $feesubtotal  + abs($revenueForLoad);	 // Calculating the fees subtotal  for this particular type of query abs is to get the value in positive or the absolute because the data stored is in negative 
$insertFeeAmountQuery = "INSERT INTO `interchangeandfee_backup`  "." (month, vssfeesdebit, vssfesscredit, adjustfees, adjustfesspin,accountfrancefees,total) VALUES('".$month."','".$vssfeesdebit."','".$vssfesscredit."','".$adjustfees."','".$adjustfesspin."','".$accountfrancefees."','".$revenueForLoad."')";
echo $insertFeeAmountQuery."<br>";
mysqli_query($con, $insertFeeAmountQuery);
$datetime_temp = strtotime('+1 month', $datetime_temp); 

$datetime_end  = strtotime('+1 month', $datetime_end );

$month++;
  // This is where for each loop ends 
}


echo "Loading database updated";
echo "</br> Between ".$startdate. " and  ". $enddate;

}

}// class ends here 


$objtransaction = new updatetransaction();

//$objtransaction->cleanData("loading");

//$objtransaction->update_transaction_fees_fis('12/30/2015','09/30/2016');

//$objtransaction->update_transaction_loading('09/01/2016','09/30/2016');
//$objtransaction->update_interchange_fees('01/01/2016','01/31/2016');

?>

