







<div id="accountdetailsdiv">
<ul class="loginul">

<?php foreach($transactiondetails as $transactiondetails) :?>



<?php 
$Description = "Description : ".$transactiondetails->Description; 	
$Req_code = "Request Code: " ."$".$transactiondetails->Req_code;
$phpdate = strtotime( $transactiondetails->Date );
$date = date( 'm-d-Y ', $phpdate );

   if($transactiondetails->debit=='')
	{
	
	$amount= "$".$transactiondetails->credit;
    

	
	echo "<div class='accountdetailsrow'>
	<input type='checkbox' name='checked' value =' ' class='ckboxaccount'><input type='text' class='chngaccount' readonly='readonly' value='Change'> 
		<input type='text' class='confirmaccount' readonly='readonly' value='Confirm' style='display:none'> 
		 <input type='text' class='fieldsbankreconDate' readonly='readonly' value='$date '> 
		 <input type='text' class='fieldsbankreconDes' readonly='readonly' value='$Description'> 
		 <input type='text' class='fieldsbankreconReq' readonly='readonly' value='$Req_code'> 
		 <input type='text' class='fieldsbankreconDebit' readonly='readonly' value='' > 
		 <input type='text' class='fieldsbankreconCredit' readonly='readonly' value='$amount' style='color:green;'> 
		 <input type='hidden' class='notreconciled' readonly='readonly' value=''> 
		 <input type='text' class='fieldsbankreconnot' readonly='readonly' value=''> 
		 <input type='hidden' class='checkboxretain' readonly='readonly' value=''> 
	
	</div></br> "; 
	 }
	 
	 else 
	
	
	{
	
	$amount= "-$".$transactiondetails->debit;
   
	
	echo "<div class='accountdetailsrow'>
	<input type='checkbox' name='checked' value =' ' class='ckboxaccount'><input type='text' class='chngaccount' readonly='readonly' value='Change'> 
		<input type='text' class='confirmaccount' readonly='readonly' value='Confirm' style='display:none'> 
		 <input type='text' class='fieldsbankreconDate' readonly='readonly' value='$date '> 
		 <input type='text' class='fieldsbankreconDes' readonly='readonly' value='$Description'> 
		 <input type='text' class='fieldsbankreconReq' readonly='readonly' value='$Req_code'> 
		 <input type='text' class='fieldsbankreconDebit' readonly='readonly' value='$amount' style='color:red;' > 
		 <input type='text' class='fieldsbankreconCredit' readonly='readonly' value='' > 
		 <input type='hidden' class='notreconciled' readonly='readonly' value=''> 
		 <input type='text' class='fieldsbankreconnot' readonly='readonly' value=''> 
		 <input type='hidden' class='checkboxretain' readonly='readonly' value=''> 
	</div></br> "; 
	
     } ?>
	
	
	



<?php endforeach; ?>
</ul>

</div>

</div>






</div>

</div>


</body>
</html>
