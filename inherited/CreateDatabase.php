	<?php 

	class createTableImportXml
	{
	// The above class is to create and import the xml files for the france database
      function importXmlfiles()
		{


			ini_set('memory_limit', '10000M');
			set_time_limit(0);

			foreach (glob("C:/wamp/www/ApolloAFrance/uploads/dataFiles/Processor/*.xml") as $filename) 
			{ 
				$path =  $filename;
				
				
				if(is_file($path))
				{

					$xml=simplexml_load_file($path);


					$adjust = 0;
	//REET' , 'TERMCITY' , 'TERMCOUNTRY' , 'SCHEMA' , 'CHIC' , 'CHAC' , 'CHP' , 'CP' , 'CDIM' , 'CHAM' , 'CHA' , 'MSGSRC' , 'RCC' , 'MCC' , 'TVR' , 'TXNDATE' , 'TXNTIME' , 'TERMTYPE' , 'CTXDATELOCAL' , 'CTXTIMELOCAL' , 'AIID' , 'ACTIONCODE' , 'RSPCODE' );
					foreach($xml->children() as $child) {



							if($child->getName() =='ADJUST'){
							foreach($child as $innerchild) {

/*
This loop is matching with all the inner child tags
if statements are to match with the predefined  tags if
the conditions are true it will store the values to the variables created in
each if statement and later on these newly created variables will be used in the
sql query to insert one row for each iteration 
*/

if ($innerchild->getName() == 'LOCALDATE') 	{ $localdate = $innerchild;  } 
if ($innerchild->getName() == 'LOCALTIME')	 { $localtime = $innerchild;  }  
if ($innerchild->getName() == 'ITEMID') { $itemid = $innerchild;  }  if ($innerchild->getName() == 'MSGID') { $msgid = $innerchild;  }  
if ($innerchild->getName() == 'PAN') { $pan = $innerchild;  }  if ($innerchild->getName() == 'CARDID') { $cardid = $innerchild;  } 
if ($innerchild->getName() == 'CRDPRODUCT') { $crdproduct = $innerchild;  }  if ($innerchild->getName() == 'PROGRAMID') { $programid = $innerchild;  } 
if ($innerchild->getName() == 'BRNCODE') { $brncode = $innerchild;  }  if ($innerchild->getName() == 'CURBILL') { $curbill = $innerchild;  }  
if ($innerchild->getName() == 'ACCCUR') { $acccur = $innerchild;  }  if ($innerchild->getName() == 'ACCNO') { $accno = $innerchild;  } 
if ($innerchild->getName() == 'ACCTYPE') { $acctype = $innerchild;  }  if ($innerchild->getName() == 'AMTBILL') { $amtbill = $innerchild;  } 
if ($innerchild->getName() == 'CORTEXDATE') { $cortexdate = $innerchild;  }  if ($innerchild->getName() == 'CRDACPTID') { $crdacptid = $innerchild;  } 
if ($innerchild->getName() == 'REV') { $rev = $innerchild;  } if ($innerchild->getName() == 'ORGITEMID') { $orgitemid = $innerchild;  }  
if ($innerchild->getName() == 'DESCRIPTION') { $description = $innerchild;  }  if ($innerchild->getName() == 'EXTCODE') { $extcode = $innerchild;  } 
if ($innerchild->getName() == 'CTXDATELOCAL') { $ctxdatelocal = $innerchild;  }  if ($innerchild->getName() == 'CTXTIMELOCAL') { $ctxtimelocal = $innerchild;  }
if ($innerchild->getName() == 'FIRSTNAME') { $firstname = $innerchild;  }  if ($innerchild->getName() == 'LASTNAME') { $lastname = $innerchild;  }
if ($innerchild->getName() == 'USRDATA1') { $usrdata1 = $innerchild;  }  if ($innerchild->getName() == 'USRDATA2') { $usrdata2 = $innerchild;  }
if ($innerchild->getName() == 'USRDATA3') { $usrdata3 = $innerchild;  }  if ($innerchild->getName() == 'USRDATA4') { $usrdata4 = $innerchild;  }
if ($innerchild->getName() == 'TXNCODE') { $txncode = $innerchild;  }  if ($innerchild->getName() == 'CURTXN') { $curtxn = $innerchild;  }
if ($innerchild->getName() == 'AMTTXN') { $amttxn = $innerchild;  }  if ($innerchild->getName() == 'BILLCONVRATE') { $billconvrate = $innerchild;  } }
$con = mysql_connect("localhost","root","ankit");
if (!$con)
{
	die('Could not connect: ' . mysql_error());
}
$insertqueryAdjust = " insert into   `adjust` values ('$localdate' , '$localtime' , '$itemid' , '$msgid' , '$pan' , '$cardid' , '$crdproduct' , 
'$programid' , '$brncode' , '$curbill' , '$acccur' , '$accno' , '$acctype' , '$amtbill' , '$cortexdate' ,'$rev' ,
'$orgitemid' , '$description' , '$extcode' , '$ctxdatelocal' , '$ctxtimelocal' , 
'$firstname' , '$lastname' , '$usrdata1' , '$usrdata2' , '$usrdata3' , '$usrdata4' , '$txncode' , '$curtxn' , 
'$amttxn' , '$billconvrate' )";
$dbname = 'france';
mysql_select_db($dbname,$con);
//echo $insertquery."<br>";
$resultinsertquery = mysql_query($insertqueryAdjust,$con);
if($resultinsertquery)
{
	$adjust++;
}

}






$arrayCounts = array('Adjust'=>$adjust);

//$this->load->view('content/createDatabase',$arrayCounts);




}


}


}




} //  ImportXmlfiles Function is ending here 


function importAccountExceptionfiles()
{
ini_set('memory_limit', '10000M');
		set_time_limit(0);			
		$exception = 0;
 foreach (glob("C:/wamp/www/ApolloAFrance/uploads/dataFiles/cardexception/*.xml") as $filename) 
		{ $path =  $filename;
			if(is_file($path))
			{
			$year = substr($filename,-12,-8);
			$month = substr($filename,-8,-6);
			$day = substr($filename,-6,-4);
			$dateimport = $year."-".$month."-".$day;
			$xml=simplexml_load_file($path);
            $adjust = 0;
//REET' , 'TERMCITY' , 'TERMCOUNTRY' , 'SCHEMA' , 'CHIC' , 'CHAC' , 'CHP' , 'CP' , 'CDIM' , 'CHAM' , 'CHA' , 'MSGSRC' , 'RCC' , 'MCC' , 'TVR' , 'TXNDATE' , 'TXNTIME' , 'TERMTYPE' , 'CTXDATELOCAL' , 'CTXTIMELOCAL' , 'AIID' , 'ACTIONCODE' , 'RSPCODE' );
				foreach($xml->children() as $child) {
				if($child->getName() =='ACCEXCEPTRPT'){
				foreach($child as $innerchild) {
/*
This loop is matching with all the inner child tags
if statements are to match with the predefined  tags if
the conditions are true it will store the values to the variables created in
each if statement and later on these newly created variables will be used in the
sql query to insert one row for each iteration 
*/

if ($innerchild->getName() == 'EXCEPTTYPE'){ $EXCEPTTYPE = $innerchild; }  
if ($innerchild->getName() == 'PAN'){ $PAN = $innerchild;  }  
if ($innerchild->getName() == 'CARDID') { $CARDID = $innerchild;  }  
if ($innerchild->getName() == 'CRDEXPDATE') { $CRDEXPDATE = $innerchild;  }  
if ($innerchild->getName() == 'CRDPRODUCT') { $CRDPRODUCT = $innerchild;  }  
if ($innerchild->getName() == 'PROGRAMID') { $PROGRAMID = $innerchild;  } 
if ($innerchild->getName() == 'ACCTYPE') { $ACCTYPE = $innerchild;  }  
if ($innerchild->getName() == 'ITEMID') { $ITEMID = $innerchild;  }  
if ($innerchild->getName() == 'TLOGID') { $TLOGID = $innerchild;  }  
if ($innerchild->getName() == 'AMTBILL') { $AMTBILL = $innerchild;  } 
if ($innerchild->getName() == 'CURBILLALPHA') { $CURBILLALPHA = $innerchild;  } 
if ($innerchild->getName() == 'DATELOCAL') { $DATELOCAL = $innerchild;  } 
if ($innerchild->getName() == 'APRVLCODE') { $APRVLCODE = $innerchild;  } 
if ($innerchild->getName() == 'RRN') { $RRN = $innerchild;  } 
if ($innerchild->getName() == 'ACCNO') { $ACCNO = $innerchild;  } 
if ($innerchild->getName() == 'CUSTCODE') { $CUSTCODE = $innerchild;  }  
if ($innerchild->getName() == 'AVLBAL') { $AVLBAL = $innerchild;  } 
if ($innerchild->getName() == 'BLKAMT') { $BLKAMT = $innerchild;  } 
if ($innerchild->getName() == 'ORIGLOADAMT') { $ORIGLOADAMT	 = $innerchild;  }  
if ($innerchild->getName() == 'MAXBAL') { $MAXBAL = $innerchild;  }
if ($innerchild->getName() == 'INSTCODE') { $INSTCODE = $innerchild;  } }// foreach loop ending here 

if($EXCEPTTYPE == 5)
{
$con = mysqli_connect("localhost","root","ankitPfrance1801","france")or die ("could not connect to mysqli database");
$insertquery = " insert into   `accountexception` values ('$EXCEPTTYPE' , '$PAN' , '$CARDID' , '$CRDEXPDATE' , '$CRDPRODUCT' ,
'$PROGRAMID' , '$ACCTYPE' , '$ITEMID' , '$TLOGID' , '$AMTBILL' , '$CURBILLALPHA' , '$dateimport' , '$APRVLCODE' , '$RRN' ,
'$ACCNO' ,'$CUSTCODE' , '$AVLBAL' , '$BLKAMT' , '$ORIGLOADAMT' , '$MAXBAL' , '$INSTCODE' )";
$resultinsertquery = mysqli_query($con, $insertquery);
if($resultinsertquery)
{ $exception++;}}
//this if condition is checking if account exceptional type is 5 for negative balance 
// according to thierry 
}}}} // foreach file loop ends here 
echo "Number Records entered".$exception."<br>";
$arrayexception = array('exception'=>$exception);
//$this->load->view('content/createDatabase',$arrayCounts);
}// function ends here 

}// class ends here 

$objectcreateTableImportXml = new createTableImportXml();
$objectcreateTableImportXml->importAccountExceptionfiles();












?>