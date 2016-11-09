<?php
			ini_set('memory_limit', '10000M');
			set_time_limit(0);

			foreach (glob("C:/wamp/www/ApolloAFrance/uploads/dataFiles/ProcessorCardSales/*.xml") as $filename) 
			{ 
				$path =  $filename;
                 echo $filename;

				if(is_file($path))
				{
                    $datename = substr($filename, -12, -4);
                    echo $datename;
					$d = substr($datename,-2);
					$m = substr($datename,-4,-2);
					$y =substr($datename,0,4);

					$salesDate = $y."-".$m."-".$d;

					echo $salesDate;

					$xml=simplexml_load_file($path);


					$CardSalesImport = 0;
	//REET' , 'TERMCITY' , 'TERMCOUNTRY' , 'SCHEMA' , 'CHIC' , 'CHAC' , 'CHP' , 'CP' , 'CDIM' , 'CHAM' , 'CHA' , 'MSGSRC' , 'RCC' , 'MCC' , 'TVR' , 'TXNDATE' , 'TXNTIME' , 'TERMTYPE' , 'CTXDATELOCAL' , 'CTXTIMELOCAL' , 'AIID' , 'ACTIONCODE' , 'RSPCODE' );
					foreach($xml->children() as $child) {



							if($child->getName() =='CARD'){
							foreach($child as $innerchild) {

/*
This loop is matching with all the inner child tags
if statements are to match with the predefined  tags if
the conditions are true it will store the values to the variables created in
each if statement and later on these newly created variables will be used in the
sql query to insert one row for each iteration 
*/


if ($innerchild->getName() == 'RECID') 	{ $recid = $innerchild;  } 
if ($innerchild->getName() == 'PAN')	 { $pan = $innerchild;  }  
if ($innerchild->getName() == 'PREVPAN') { $prevpan = $innerchild;  }  if ($innerchild->getName() == 'ACCNO') { $accno = $innerchild;  }  
if ($innerchild->getName() == 'ACCTYPE') { $acctype = $innerchild;  }  if ($innerchild->getName() == 'OLDSTATCODE') { $oldstatcode = $innerchild;  } 
if ($innerchild->getName() == 'STATCODE') { $statcode = $innerchild;  }  if ($innerchild->getName() == 'TITLE') { $title = $innerchild;  } 
if ($innerchild->getName() == 'LASTNAME') { $lastname = $innerchild;  }  if ($innerchild->getName() == 'FIRSTNAME') { $firstname = $innerchild;  }  
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
}
$con = mysql_connect("localhost","root","ankit");
if (!$con)
{
	die('Could not connect: ' . mysql_error());
}
$insertqueryCardSalesimport = " insert into   `cardsalesimport` values ( '$recid', '$pan'  , '$prevpan'  , '$accno' , '$acctype' , '$oldstatcode', '$statcode'  , '$title'  , '$lastname'  , '$firstname' , '$designref' ,
 '$imageid'  , '$dlvmethod'  , '$isolang'  , '$cardid'  , '$prevcardid'  , '$brncode'  , '$user'  , '$usergrp'  , '$cardevent'  , '$expdate'  , 
 '$programid'  , '$participantid'  , '$accountid'  , '$crdbtchno'  , '$custcode'  , '$crdproduct'  , '$accesscode'  , '$carrierpan'  , '$stockno',
 '$fundcrdpan'  , '$fundcrdeffdate'  , '$fundcrdexpdate'  , '$fundcrdtype'  , '$fundcrdissnum'  , '$addrind'  , '$addrl1'  , '$addrl2'  , 
 '$addrl3'  , '$city'  , '$county'  , '$postcode'  , '$country'  , '$workaddrl1'  , '$workaddrl2'  , '$workaddrl3'  , '$workcity'  , 
 '$workcounty'  , '$workpostcode'  , '$workcountry'  , '$pobox'  , '$dlvaddrl1'  , '$dlvaddrl2'  , '$dlvaddrl3'  , '$dlvcity'  , 
 '$dlvcounty'  , '$dlvpostcode'  , '$dlvcountry'  , '$dlvindate'  , '$dlvpurgedate'  , '$totalcards'  , '$totalrencards'  , '$totalrepcards'  ,
 '$totalreisscards' , '$totalpins'  , '$totalpinrep'  , '$totalpinrmnd'  , '$totalstatchg'  , '$totaltoexpire'  , '$crdprofile'  , '$accprofile'  ,
 '$custprofile', '$salesDate' )";
$dbname = 'france';
mysql_select_db($dbname,$con);
//echo $insertqueryCardSalesimport."<br>";
$resultinsertquery = mysql_query($insertqueryCardSalesimport,$con);
if($resultinsertquery)
{
	$CardSalesImport++;
}

}






$arrayCounts = array('CardSalesImport'=>$CardSalesImport);

//$this->load->view('content/createDatabase',$arrayCounts);

echo "Number of records entered ".$CardSalesImport."<br>";



}


}


}

?>