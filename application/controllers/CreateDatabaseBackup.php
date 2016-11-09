<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CreateDatabase extends CI_Controller {
public function importdatadomobject($date)
{
$path =  'uploads/dataFiles/Processor/TCFtxnexp'.$date.'.xml';
if(is_file($path))
{

$xml=simplexml_load_file($path);

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
$con = mysql_connect("localhost","root","ankit");
if (!$con)
{
die('Could not connect: ' . mysql_error());
}
$insertquery = " Insert INTO   `authadv` values ('$mtid' ,'$localdate', '$localtime' , '$tlogid' , '$itemid' ,
'$pan' , '$cardid' , '$crdproduct' , '$programid' , '$brncode' , '$txncode' , '$txnsubcode' , '$billamt' ,
'$acccur' , '$accno' , '$acctype' , '$billconvrate' , '$amtcom' , '$amtpad' , '$curtxn' , '$amttxn' , '$amttxncb' ,
'$approvalcode' , '$cortexdate' , '$stan' , '$rrn' , '$termcode' , '$crdacptid' , '$afe' , '$termlocation' , '$termstreet' ,
'$termcity' , '$termcountry' , '$schema' , '$chic' , '$chac' , '$chp' , '$cp' , '$cdim' , '$cham' , '$cha' , '$msgsrc' ,
'$rcc' , '$mcc' , '$tvr' , '$txndate' , '$txntime' , '$termtype' , '$ctxdatelocal' , '$ctxtimelocal' , '$aiid' ,
'$actioncode' , '$rspcode'  )";
$dbname = 'france';
mysql_select_db($dbname,$con);
//echo $insertquery."<br>";
$resultinsertquery = mysql_query($insertquery,$con);
if($resultinsertquery)
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
$con = mysql_connect("localhost","root","ankit");
if (!$con)
{
die('Could not connect: ' . mysql_error());
}
$insertquery = " Insert INTO   `authrev` values ('$mtid' ,'$localdate', '$localtime' , '$tlogid' , '$itemid' ,
'$pan' , '$cardid' , '$crdproduct' , '$programid' , '$brncode' , '$txncode' , '$txnsubcode' , '$billamt' ,
'$acccur' , '$accno' , '$acctype' , '$billconvrate' , '$amtcom' , '$amtpad' , '$curtxn' , '$amttxn' ,
'$amttxncb' ,'$amttxncb', '$approvalcode' , '$cortexdate' , '$stan' , '$rrn' , '$termcode' , '$crdacptid' ,
'$afe' , '$termlocation' , '$termstreet' , '$termcity' , '$termcountry' , '$schema' , '$stanorg', '$chic' ,
'$chac' , '$chp' , '$cp' , '$cdim' , '$cham' , '$cha' , '$msgsrc' , '$rcc' , '$mcc' , '$dispose', '$tvr' ,
'$txndate' , '$txntime' , '$termtype' , '$ctxdatelocal' , '$ctxtimelocal' , '$aiid' , '$actioncode' , '$rspcode'  )";
$dbname = 'france';
mysql_select_db($dbname,$con);
//echo $insertquery."<br>";
$resultinsertquery = mysql_query($insertquery,$con);
if($resultinsertquery)
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
$con = mysql_connect("localhost","root","ankit");
if (!$con)
{
die('Could not connect: ' . mysql_error());
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
$dbname = 'france';
mysql_select_db($dbname,$con);
//echo $insertquery."<br>";
$resultinsertquery = mysql_query($insertqueryfinadv,$con);
if($resultinsertquery)
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
$con = mysql_connect("localhost","root","ankit");
if (!$con)
{
die('Could not connect: ' . mysql_error());
}
$insertqueryCardload = " insert into   `cardload` values ('$localdate' , '$localtime' , '$itemid' , '$msgid' , '$pan' , '$cardid' , '$crdproduct' ,
 '$programid' , '$brncode' , '$curbill' , '$acccur' , '$accno' , '$acctype' , '$amtbill' , '$cortexdate' , '$crdacptid' , '$rev' , '$orgitemid' , 
 '$description' , '$loadsrc' , '$loadtype' , '$ctxdatelocal' , '$ctxtimelocal' , '$terminalid' , '$initload' , 
 '$curtxn' , '$amttxn' , '$billconvrate'  )";
$dbname = 'france';
mysql_select_db($dbname,$con);
//echo $insertquery."<br>";
$resultinsertquery = mysql_query($insertqueryCardload,$con);
if($resultinsertquery)
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
$con = mysql_connect("localhost","root","ankit");
if (!$con)
{
die('Could not connect: ' . mysql_error());
}
$insertqueryCardunload = " insert into   `cardunload` values ('$localdate' , '$localtime' , '$itemid' , '$msgid' , '$pan' , '$cardid' , '$crdproduct' , 
'$programid' , '$brncode' , '$curbill' , '$acccur' , '$accno' , '$acctype' , '$amtbill' , '$cortexdate' , 
'$crdacptid' , '$rev' , '$orgitemid' , '$description' , 
'$loadsrc' , '$loadtype' , '$ctxdatelocal' , '$ctxtimelocal' , '$terminalid')";
$dbname = 'france';
mysql_select_db($dbname,$con);
//echo $insertquery."<br>";
$resultinsertquery = mysql_query($insertqueryCardunload,$con);
if($resultinsertquery)
{
$cardunload++;
}

}


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
$con = mysql_connect("localhost","root","ankit");
if (!$con)
{
die('Could not connect: ' . mysql_error());
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
$dbname = 'france';
mysql_select_db($dbname,$con);
//echo $insertquery."<br>";
$resultinsertquery = mysql_query($insertqueryChrgback,$con);
if($resultinsertquery)
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
$con = mysql_connect("localhost","root","ankit");
if (!$con)
{
die('Could not connect: ' . mysql_error());
}
$insertquery = " insert into   `fee` values ('$mtid' , '$feetype' , '$feeid' , '$itemid' , '$orgitemid' , '$tlogid' , '$feedscr' ,
 '$deborcred' , '$localdate' , '$localtime' , '$txncode' , '$txnsubcode' , '$curtxn' , '$amttxn' , 
 '$curset' , '$amtset' , '$pan' , '$cardid' , '$crdproduct' , '$programid' , '$brncode' , '$fiid' ,
 '$crdacptid' , '$reasoncode' , '$msgsrc' , '$billamt' , '$acccur' , '$accno' , '$acctype' , 
 '$cortexdate' , '$txndate' , '$txntime' , '$itemsrc' , '$ctxdatelocal' , '$ctxtimelocal' )";
$dbname = 'france';
mysql_select_db($dbname,$con);
//echo $insertquery."<br>";
$resultinsertquery = mysql_query($insertquery,$con);
if($resultinsertquery)
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



$arrayCounts = array('Authadv'=>$authadv, 'Authrev'=>$authrev,'Finadv'=>$finadv, 'Adjust'=>$adjust,'Cardload'=>$cardload  ,'Cardunload'=>$cardunload , 'Fee'=>$fee, 'Chargeback'=>$chrgback, 'Date'=>$date);

/* echo " import is done for the Authadv no of records added : $authadv for the date $date </br>";
echo " import is done for the Authrev no of records added : $authrev for the date $date </br>";
echo " import is done for the finadv no of records added : $finadv for the date $date </br>";
echo " import is done for the Adjust no of records added : $adjust for the date $date </br>";
echo " import is done for the Cardload no of records added : $cardload for the date $date </br>";
echo " import is done for the Cardunload no of records added : $cardload for the date $date </br>";
echo " import is done for the Fee no of records added : $fee for the date $date </br>";
echo " import is done for the Fee no of records added : $chrgback for the date $date </br>"; */

$this->load->helper('url');
$this->load->view('createDatabase',$arrayCounts);
//$this->load->view('content/createDatabase',$arrayCounts);

}

else
{

$arrayCounts = array('Date'=>$date);
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
die('Could not connect: ' . mysql_error());
}
$insertquery = "LOAD XML LOCAL INFILE 'C:/wamp/www/ankitdev/france/ftpdata/TCFaccexcept20140609.xml'
INTO TABLE  tcfaccexcept(`pan`, `cardid`, `crdexpdate`,`crdproduct`,`programid`, `acctype`,`itemid`,`tlogid`,`amtbill`,`curbillalpha`,`datelocal`,`aprvlcode`,`rrn`,`accno`,`custcode`,`avlbal`,`blkamt`,`origloadamt`,`maxbal`,`instcode` ); ";
$dbname = 'france';
mysql_select_db($dbname,$con);
echo $insertquery."<br>";
$resultinsertquery = mysql_query($insertquery,$con);
if($resultinsertquery)
{

}
}
}
?>