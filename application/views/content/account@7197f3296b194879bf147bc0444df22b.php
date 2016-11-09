
<?php foreach($account as $account) :
$accountnumber = $account->accountname; ?>

<div id='<?php echo $accountnumber.'accountdiv';?>' class='divmargin' style='display: none;'>




<div id='<?php echo 'tittlediv'.$accountnumber;?>' class='firstmenu'>
<input type='submit' value='Update' id='<?php echo $accountnumber.'update';?>'  class='btnprnt' />
<input type='button' value='Print' onclick='PrintElem('<?php echo '#'.$accountnumber.'accountdiv';?>')' class='btnprnt'  />
<input type='button' value='Save' class='btnprnt' id='<?php echo 'save'.$accountnumber;?>'/>
<input type='button' value='Add Row' class='btnprnt' id='<?php echo 'addrow'.$accountnumber;?>'/>
<input type='submit' value='Reconcile' id='<?php echo 'reconcile'.$accountnumber;?>' class='btnprnt' />
<input type='submit' value='Undo' id='<?php echo $accountnumber.'undo';?>' class='btnprnt' />
<input type='submit' value='Checkbox Restore' id='<?php echo 'ckrestore'.$accountnumber;?>' class='btnprnt' />

</div>



<div id='<?php echo 'adddivrowmain'.$accountnumber;?>' style='display: none;' class='divaddmain' >
<div id='<?php echo 'tittleaddrow'.$accountnumber;?>'  class='picktittle'>
<input type='submit' class ='fieldsbankreconadd' readonly='readonly' value='Date' /> 
<input type='submit' class ='fieldsbankreconadd' readonly='readonly' value='Description'/> 
<input type='submit' class ='fieldsbankreconadd' readonly='readonly' value='ReqCode'/> 
<input type='submit' class ='fieldsbankreconadd' readonly='readonly' value='Debit' /> 


<input type='submit' class ='fieldsbankreconadd' readonly='readonly' value='Credit' /> 
<input type='submit' class ='fieldsbankreconadd' readonly='readonly' value='Balance'/> </div>

<div id='<?php echo 'adddivrow'.$accountnumber;?>' class='pickrow' >
<div class='<?php echo 'row'.$accountnumber;?>'> 
    
	 <input type='text' class ='fieldsbankreconadd'  value='' id='<?php echo 'newdate'.$accountnumber;?>'/> 
     <input type='text' class ='fieldsbankreconadd'  value='' id='<?php echo 'newdes'.$accountnumber;?>'/> 
     <input type='text' class ='fieldsbankreconadd'  value='' id='<?php echo 'newreqcode'.$accountnumber;?>'/> 
     <input type='text' class ='fieldsbankreconadd'  value='' style='color:red' id='<?php echo 'newdebit'.$accountnumber;?>'/> 
     <input type='text' class ='fieldsbankreconadd'  value='' id='<?php echo 'newcredit'.$accountnumber;?>' /> 
     <input type='text' class ='fieldsbankreconadd'  value='' /> 
	 </div></br>
	 
	 </div>

<div class='<?php echo 'row'.$accountnumber;?>'>
<input type='submit' id='<?php echo 'ok'.$accountnumber;?>' value='OK' class='btnprnt' style='margin-left:280px;' /> 
<input type='submit' id='<?php echo 'cancel'.$accountnumber;?>' value='Cancel' class='btnprnt' style='margin-left:6px;' /> 
</div>

</div>


<div class='resulhistoryclass'>

<div class='accountbtn' >
<input type='submit' value='<?php echo $accountnumber.'-XXXXXX8126';?>' id='btnfund' class='bankmovementsbtn'/>
<input type='text' value='' id='<?php echo $accountnumber.'accounttext';?>' class='bankmovementsbtn'/>


<div id='<?php echo 'openingbaldiv'.$accountnumber;?>' class='divopening'>
<input type ='button' value='Beginning   Balance' class='reconfields' id='<?php echo 'openingbalbutton'.$accountnumber;?>'/>
<input type='text' value='0' class='reconfields' id='<?php echo 'openingbaltext'.$accountnumber;?>' >
</div>
<div id='<?php echo 'reconcilediv'.$accountnumber;?>' class='divreconcile'>
<input type ='button' value='Ending  Balance' class='reconfields' id='<?php echo 'closingbalbutton'.$accountnumber;?>'/>
<input type='text' value='' id='<?php echo 'closingbaltext'.$accountnumber;?>'  class='reconfields'>
</div>

<div id='<?php echo 'clearedbaldiv'.$accountnumber;?>' class='divclearedbal'>
<input type ='button' value='Cleared   Balance' class='reconfields' id='<?php echo 'clearedbalbutton'.$accountnumber;?>'/>
<input type='text' value='' id='<?php echo 'clearedbaltext'.$accountnumber;?>' class='reconfields' >
</div>

<div id='<?php echo 'differencebaldiv'.$accountnumber;?>' class='divdifferencebal'>
<input type ='button' value='Difference' class='reconfields' id='<?php echo 'differencebalbutton'.$accountnumber;?>'/>
<input type='text' value='' id='<?php echo 'differencebaltext'.$accountnumber;?>'  class='reconfields'>
</div>



</div>



<div id='<?php echo 'history'.$accountnumber;?>'>
<input type='text' value='Reconciled Documents' style='width:296px; background-color:#F6CECE; text-align:center' readonly='readonly'/>



</div>



</div>




<div  class='data_cont'>
<div  class='rowtittle'>
</br><input type ='button' value='Check All' id ='<?php echo 'selectchbx'.$accountnumber;?>' class = 'update' /> 
<input type ='button' value='Uncheck  All' id ='<?php echo 'selectunchbx'.$accountnumber;?>' class = 'update' /> 
<input type ='button' value='Calculate' id ='<?php echo 'calculate'.$accountnumber;?>' class = 'update' /> </br>
</div>

<div id='<?php echo 'data'.$accountnumber;?>'>





</div>

</div>

</div> 

<?php endforeach; ?>





</div>

</div>
</body>
</html>
