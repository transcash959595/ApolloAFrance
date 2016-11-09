







<div id="carddetailsdiv">
<ul class="loginul">

<?php foreach($carddetails as $carddetails) :?>

<?php if ($carddetails->status=="Primary")
	{
	$cardnumberdetails = "Primary Card - ".$carddetails->cardnumberdetails; 
	$balance = "$".$carddetails->balance;
	$cardnum = $carddetails->cardnumberdetails; 
	}
	
	else 
	
	{
	$cardnumberdetails = "Secondary Card - ".$carddetails->cardnumberdetails; 
	$balance = "$".$carddetails->balance;
	$cardnum = $carddetails->cardnumberdetails; 
	}
	
	?>
	
	
	<div class='carddetailsrow'><a href='<?php echo site_url('transaction/index/'.$cardnum)?>'> <input type='text' class ='card' readonly='readonly' value='<?php  echo $cardnumberdetails; //this notation is for the object returned value from the controller  ?>' /> 
	<input type='text' class ='balance' readonly='readonly' value='<?php  echo $balance ?>'/> </a>
	
	
	</div></br>



<?php endforeach; ?>
</ul>

</div>

</div>






</div>

</div>


</body>
</html>
