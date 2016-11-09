<div id='mainContainer' class='center'>
<?php if ($accountActive == ''):  // this if block is for the first time, no transactions ?>


<div id='verticaltabs' style='display: none;'>
<?php foreach($account as $account) :?>

<?php $accountVerticalTabs = $account->accountname; ?>


<div class='verticaltabsrow' >

<input class='accounttabs' type='submit'  value='<?php echo $accountVerticalTabs.'  Account'?>  ' id='<?php echo $accountVerticalTabs.'tabs'?>' />
<input class='accountabshidden' type='hidden'  value='<?php echo $accountVerticalTabs;?>'  />

</div>
<?php endforeach; ?>
 </div> 

<div id='sampledialog' style ='display:none;'>
  <div id='dialog-confirm' title='Change the Database ?'>
    <p><span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 20px 0; border-radius:10px;background-color:#FFCC66;'></span> Are you sure?</p>
  </div>
  </div>
  


<div id='bankMovements'>







<?php else:  //this is else statement for transactions ?>

<div id='verticaltabs' >
<?php foreach($account as $account) :?>

<?php $accountVerticalTabs = $account->accountname; ?>


<div class='verticaltabsrow' >

<input class='accounttabs' type='submit'  value='<?php echo $accountVerticalTabs.'  Account'?>  ' id='<?php echo $accountVerticalTabs.'tabs'?>' />
<input class='accountabshidden' type='hidden'  value='<?php echo $accountVerticalTabs;?>'  />

</div>
<?php endforeach; ?>
 </div> 

<div id='sampledialog' style ='display:none;'>
  <div id='dialog-confirm' title='Change the Database ?'>
    <p><span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 20px 0; border-radius:10px;background-color:#FFCC66;'></span> Are you sure?</p>
  </div>
  </div>
  


<div id='bankMovements'>





<?php endif;?>


