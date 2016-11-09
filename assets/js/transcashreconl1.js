$(document).ready(function() {




$('#noOfAccuntsSubmit').click( function()

{

//script to append as many input divs for number of accounts requested by the user. 

var noofaccounts = $('#noOfAccounts').val();
$('.DivNoOfAccounts').html('');
$('.DivNoOfAccounts').append("<input class='AccountNames'  value='Enter Accounts Names Below' readonly>");
for(i=1;i<= noofaccounts;i++)

{
var j=i;

$('.DivNoOfAccounts').append("<div class='accountrows'><input  class='howManyAccounts' value='Account' readonly> <input class='accountNames' value=''> </div>");


}

$('.DivNoOfAccounts').append("<input class='AccountNames' id='submitAccountNames' value='Create Accounts' readonly>");


});



$('#submitAccountNames').live("click", function(){ 


//ajax call to insert the name of new account in the table noofaccounts

$.ajax(
			{
			url:'http://10.0.1.165/AdminController/NoOfAccount',
			type:'POST',
			data: {account:'noofaccounts'},
			dataType:'json',
			success: function(data)
			{

									  

			




			}

			
			
			
			
			

			});
	

//ajax call for each accounts to be created by the user 	
$('.howManyAccounts').each(function(){
    var accountName  = $(this).closest('.accountrows').children('.accountNames').val();
     alert(accountName);
	        $.ajax(
			{
			url:'http://10.0.1.165/AdminController/createtable',
			type:'POST',
			data: {account:accountName},
			dataType:'json',
			success: function(data)
			{

									  

			




			}


			});
	
	
});
	

	$('.DivNoOfAccounts').html('<p> Accounts Created Successfully');
	
		
		});		



$('input').each(function(){
    $(this).bind("change keyup input",function(){
        $(this).attr('value',$(this).val());
    });
	//the above lines are to assign the new values of input boxes to the this variables
	
});






$('input:checkbox').each(function(){
    $(this).bind('click', function() {
     $(this).attr('checked',$(this).attr('checked'));
});
//this is to assign the checked attribute to the this variable after the changes 

});





$('.accounttabs').click( function()
{
/*
This is to show the content and elements for the accounts clicked by the user it also hides other 
account not in use. 

*/
var accountName  = $(this).closest('.verticaltabsrow').children('.accountabshidden').val();

backendcall(accountName);
var html = 'browse'+accountName;
 var namefile = 'browse'+accountName;


/*$.ajax(
{
url:'filehanding.php',
type:'POST',
data: {filename:namefile,data:html,accounttype:'browsefunding'},
dataType:'text',

success: function(data)
{

$('#historyfunding').html(data);



}


});

*/


$('input').each(function(){
    $(this).bind("change keyup input",function(){
        $(this).attr('value',$(this).val());
    });
	
	
});



$('input:checkbox').each(function(){
    $(this).bind('click', function() {
     $(this).attr('checked',$(this).attr('checked'));
});

});



$(":input").attr("readonly",true);
$('.divmargin').hide();
$('#'+accountName+'accountdiv').show();

$('#btnfund').show();
$('#bankaccount1btn').show();
$('#'+accountName+'update').show();




}
);


/*
8/24/2015
above jquery script is written for new code ingniter frame work


below jquery script is inherited from the old core php frame work of AppolloA frame work


*/
$('#cardholderupdate').click( function()

{
$(":input").attr("readonly",false);

});



$('#incomeupdate').click( function()

{
$(":input").attr("readonly",false);

});



$('#fundingupdate').click( function()

{
$(":input").attr("readonly",false);

});



$('#settlementupdate').click( function()

{
$(":input").attr("readonly",false);

});


$('#reserveupdate').click( function()

{
$(":input").attr("readonly",false);

});



$('#balanceupdate').click( function()

{
$(":input").attr("readonly",false);

});





$('#balanceadjustmentupdate').click( function()

{
$(":input").attr("readonly",false);

});




$('#irnupdate').click( function()

{
$(":input").attr("readonly",false);

});



function backendcall(account)
{
/*

This function makes a call to fetch the account details.
All the transactions for the particular account is fetched by this function.

*/

 $(":input").attr("readonly",true);
 $('#tabs').show();
 $('#verticaltabs').show();
 
 
 
var startdate = $('#datepickerbankstart').val();
var enddate = $('#datepickerbankend').val();
$("#accountdetails").attr("disabled","disabled");

$.ajax(
{
url:'http://10.0.1.131/Account/accountfetch',
type:'POST',
data: {startdate:startdate,enddate:enddate,account:account},
dataType:'json',

success: function(data)
{


//alert(data);
//$('#datacardholder').html("hi");


$.each(data, function(key, val) {  
$('#data'+account).html(val.accountdetails);  
   


$('#openingbaltext'+accountt).val(val.begbalaccount);    
$('#openingbaltext').val(val.begbalaccount);               
/*
$('#data'+accountt).html(val.accountt+'details');


$('#datasettlement').html(val.settlementdetails);

$('#datafunding').html(val.fundingdetails);
$('#databalanceadjustment').html(val.balanceadjustmentdetails);
$('#datareserve').html(val.reservedetails);
$('#datairn').html(val.irndetails);
$('#missingcodes').html(val.missingcodes);


*/



});
}

});






}



$('#accountdetails').click( function()

 {
 
 $('#bankMovements').show();
 //$('#tabs').show();
 $('#verticaltabs').show();
 //backendcall();



});

$('#cdhldr').click( function()
{
backendcall('cardholder');



var html = 'browsecardholder';
 var namefile = 'browsecardholder';


$.ajax(
{
url:'filehanding.php',
type:'POST',
data: {filename:namefile,data:html,accounttype:'browsecardholder'},
dataType:'text',

success: function(data)
{

$('#historycardholder').html(data);



}


});



$('input').each(function(){
    $(this).bind("change keyup input",function(){
        $(this).attr('value',$(this).val());
    });
	
	
});



$('input:checkbox').each(function(){
    $(this).bind('click', function() {
     $(this).attr('checked',$(this).attr('checked'));
});

});
$(":input").attr("readonly",true);

$('#cardholderdiv').show();
$('#missingcodes').show();


$('#incomediv').hide();

$('#settlediv').hide();

$('#fundingaccountdiv').hide();

$('#balanceadjustmentdiv').hide();
$('#bankaccount44btn').hide();

$('#bankaccount4btn').hide();

$('#reservediv').hide();
$('#reserveaccountbtn').hide();
$('#btnreserve').hide();
$('#reserveaccounttext').hide();
$('#reserveupdate').hide();
$('#chargebackdiv').hide();
$('#irndiv').hide();



}
);



$('#incm').click( function()
{
backendcall('income');
var html = 'browseincome';
 var namefile = 'browseincome';


$.ajax(
{
url:'filehanding.php',
type:'POST',
data: {filename:namefile,data:html,accounttype:'browseincome'},
dataType:'text',

success: function(data)
{

$('#historyincome').html(data);



}


});



$('input').each(function(){
    $(this).bind("change keyup input",function(){
        $(this).attr('value',$(this).val());
    });
	
	
});



$('input:checkbox').each(function(){
    $(this).bind('click', function() {
     $(this).attr('checked',$(this).attr('checked'));
});

});

$(":input").attr("readonly",true);
$('#incomediv').show();
$('#missingcodes').show();

$('#cardholderdiv').hide();
$('#fundingaccountdiv').hide();

$('#settlediv').hide();
$('#balanceadjustmentdiv').hide();



$('#reservediv').hide();
$('#reserveaccountbtn').hide();
$('#btnreserve').hide();
$('#reserveaccounttext').hide();
$('#reserveupdate').hide();
$('#irndiv').hide();

$('#chargebackdiv').hide();
}
);


$('#fund').click( function()
{
backendcall('funding');
var html = 'browsefunding';
 var namefile = 'browsefunding';


$.ajax(
{
url:'filehanding.php',
type:'POST',
data: {filename:namefile,data:html,accounttype:'browsefunding'},
dataType:'text',

success: function(data)
{

$('#historyfunding').html(data);



}


});



$('input').each(function(){
    $(this).bind("change keyup input",function(){
        $(this).attr('value',$(this).val());
    });
	
	
});



$('input:checkbox').each(function(){
    $(this).bind('click', function() {
     $(this).attr('checked',$(this).attr('checked'));
});

});

$(":input").attr("readonly",true);
$('#fundingaccountdiv').show();
$('#missingcodes').show();
$('#btnfund').show();
$('#bankaccount1btn').show();
$('#fundingupdate').show();

$('#incomeccountdiv').hide();
$('#missingcodes').show();
$('#btnincm').hide();

$('#cardholderdiv').hide();


$('#settlediv').hide();

$('#balanceadjustmentdiv').hide();


$('#reservediv').hide();
$('#incomediv').hide();
$('#reserveaccountbtn').hide();
$('#btnreserve').hide();
$('#reserveaccounttext').hide();
$('#reserveupdate').hide();
$('#chargebackdiv').hide();
$('#irndiv').hide();


}
);


$('#stlmnt').click( function()
{
backendcall('settlement');


var html = 'browsesettlement';
 var namefile = 'browsesettlement';


$.ajax(
{
url:'filehanding.php',
type:'POST',
data: {filename:namefile,data:html,accounttype:'browsesettlement'},
dataType:'text',

success: function(data)
{

$('#historysettlement').html(data);



}


});



$('input').each(function(){
    $(this).bind("change keyup input",function(){
        $(this).attr('value',$(this).val());
    });
	
	
});



$('input:checkbox').each(function(){
    $(this).bind('click', function() {
     $(this).attr('checked',$(this).attr('checked'));
});

});

$(":input").attr("readonly",true);
$('#settlediv').show();
$('#missingcodes').show();

$('#fundingaccountdiv').hide();


$('#incomediv').hide();

$('#cardholderdiv').hide();

$('#balanceadjustmentdiv').hide();


$('#reservediv').hide();
$('#reserveaccountbtn').hide();
$('#btnreserve').hide();
$('#reserveaccounttext').hide();
$('#reserveupdate').hide();

$('#irndiv').hide();


}
);























function check_changerowcolor(account)
{


$('.ckbox'+account).prop("checked", true);
	     $('.row'+account+' :checkbox').each(function() {
		var $this = $(this);
	    $(this).closest('.row'+account).children('.fieldsbankreconDate').css("background","#A9BCF5"); 		
		$(this).closest('.row'+account).children('.fieldsbankreconDes').css("background","#A9BCF5");		
		$(this).closest('.row'+account).children('.fieldsbankreconReq').css("background","#A9BCF5"); 		
		$(this).closest('.row'+account).children('.fieldsbankreconDebit').css("background","#A9BCF5");
		$(this).closest('.row'+account).children('.fieldsbankreconCredit').css("background","#A9BCF5");
		$(this).closest('.row'+account).children('.fieldsbankrecon').css("background","#A9BCF5");
		
		 $(this).closest('.row'+account).children('.fieldsbankreconDatenot').css("background","#A9BCF5"); 		
		$(this).closest('.row'+account).children('.fieldsbankreconDesnot').css("background","#A9BCF5");		
		$(this).closest('.row'+account).children('.fieldsbankreconReqnot').css("background","#A9BCF5"); 		
		$(this).closest('.row'+account).children('.fieldsbankreconDebitnot').css("background","#A9BCF5");
		$(this).closest('.row'+account).children('.fieldsbankreconCreditnot').css("background","#A9BCF5");
		$(this).closest('.row'+account).children('.fieldsbankreconnot').css("background","#A9BCF5");
		
		
		});




}






function uncheck_changerowcolor(account)
{


$('.ckbox'+account).prop("checked", false);
$('.ckboxsubtotal'+account).prop("checked", false);

	   $('.row'+account+' :checkbox').each(function() {
		var $this = $(this);
	    $(this).closest('.row'+account).children('.fieldsbankreconDate').css("background","#ffffff"); 		
		$(this).closest('.row'+account).children('.fieldsbankreconDes').css("background","#ffffff");		
		$(this).closest('.row'+account).children('.fieldsbankreconReq').css("background","#ffffff"); 		
		$(this).closest('.row'+account).children('.fieldsbankreconDebit').css("background","#ffffff");
		$(this).closest('.row'+account).children('.fieldsbankreconCredit').css("background","#ffffff");
		$(this).closest('.row'+account).children('.fieldsbankrecon').css("background","#ffffff");
		
		
		
		$(this).closest('.row'+account).children('.fieldsbankreconDatenot').css("background","#ffffff"); 		
		$(this).closest('.row'+account).children('.fieldsbankreconDesnot').css("background","#ffffff");		
		$(this).closest('.row'+account).children('.fieldsbankreconReqnot').css("background","#ffffff"); 		
		$(this).closest('.row'+account).children('.fieldsbankreconDebitnot').css("background","#ffffff");
		$(this).closest('.row'+account).children('.fieldsbankreconCreditnot').css("background","#ffffff");
		$(this).closest('.row'+account).children('.fieldsbankreconnot').css("background","#ffffff");
		
		});




}



$('#selectchbx').click(function(){ 
     $('.ckboxreserve').prop("checked", true);
	 $('.rowreserve :checkbox').each(function() {
		var $this = $(this);
	   $(this).closest('.rowreserve').children('.fieldsbankreconDate').css("background","#A9BCF5"); 		
		$(this).closest('.rowreserve').children('.fieldsbankreconDes').css("background","#A9BCF5");		
		$(this).closest('.rowreserve').children('.fieldsbankreconReq').css("background","#A9BCF5"); 		
		$(this).closest('.rowreserve').children('.fieldsbankreconDebit').css("background","#A9BCF5");
		$(this).closest('.rowreserve').children('.fieldsbankreconCredit').css("background","#A9BCF5");
		$(this).closest('.rowreserve').children('.fieldsbankrecon').css("background","#A9BCF5");
		
		});
}); 


$('#selectunchbx').click(function(){ 
     $('.ckboxreserve').prop("checked", false);
	 $('.rowreserve :checkbox').each(function() {
		var $this = $(this);
	   $(this).closest('.rowreserve').children('.fieldsbankreconDate').css("background","#ffffff"); 		
		$(this).closest('.rowreserve').children('.fieldsbankreconDes').css("background","#ffffff");		
		 $(this).closest('.rowreserve').children('.fieldsbankreconReq').css("background","#ffffff"); 		
		$(this).closest('.rowreserve').children('.fieldsbankreconDebit').css("background","#ffffff");
		$(this).closest('.rowreserve').children('.fieldsbankreconCredit').css("background","#ffffff");
		$(this).closest('.rowreserve').children('.fieldsbankrecon').css("background","#ffffff");
		
		});
});


$('#selectchbxfunding').click(function(){ 
     
		check_changerowcolor('funding');
		
}); 


$('#selectunchbxfunding').click(function(){ 
     
		
		
		uncheck_changerowcolor('funding');
});



$('#selectchbxbalanceadjustment').click(function(){ 
     
		
		check_changerowcolor('balanceadjustment');
		
}); 


$('#selectunchbxbalanceadjustment').click(function(){ 
     
		
		
		uncheck_changerowcolor('balanceadjustment');
});






$('#selectchbxchargeback').click(function(){ 
     
		
		check_changerowcolor('chargeback');
		
}); 


$('#selectunchbxchargeback').click(function(){ 
     
		
		
		uncheck_changerowcolor('chargeback');
});





$('#selectchbxincome').click(function(){ 
     
		check_changerowcolor('income');
		
}); 


$('#selectunchbxincome').click(function(){ 
     
		uncheck_changerowcolor('income');
});




$('#selectchbxcardholder').click(function(){ 
    
		
		check_changerowcolor('cardholder');
}); 


$('#selectunchbxcardholder').click(function(){ 
    
		
		uncheck_changerowcolor('cardholder');
});




$('#selectchbxsettlement').click(function(){ 
    
		check_changerowcolor('settlement');
		
}); 


$('#selectunchbxsettlement').click(function(){ 
     
		
		uncheck_changerowcolor('settlement');
		
});




$('#selectchbxirn').click(function(){ 
     /*$('.ckboxirn').prop("checked", true);
	     $('.rowirn :checkbox').each(function() {
		var $this = $(this);
	    $(this).closest('.rowirn').children('.fieldsbankreconDate').css("background","#A9BCF5"); 		
		$(this).closest('.rowirn').children('.fieldsbankreconDes').css("background","#A9BCF5");		
		 $(this).closest('.rowirn').children('.fieldsbankreconReq').css("background","#A9BCF5"); 		
		$(this).closest('.rowirn').children('.fieldsbankreconDebit').css("background","#A9BCF5");
		$(this).closest('.rowirn').children('.fieldsbankreconCredit').css("background","#A9BCF5");
		$(this).closest('.rowirn').children('.fieldsbankrecon').css("background","#A9BCF5");
		
		}); */
		check_changerowcolor('irn');
		
}); 


$('#selectunchbxirn').click(function(){ 
    /* $('.ckboxirn').prop("checked", false);
	   $('.rowirn :checkbox').each(function() {
		var $this = $(this);
	   $(this).closest('.rowirn').children('.fieldsbankreconDate').css("background","#ffffff"); 		
		$(this).closest('.rowirn').children('.fieldsbankreconDes').css("background","#ffffff");		
		 $(this).closest('.rowirn').children('.fieldsbankreconReq').css("background","#ffffff"); 		
		$(this).closest('.rowirn').children('.fieldsbankreconDebit').css("background","#ffffff");
		$(this).closest('.rowirn').children('.fieldsbankreconCredit').css("background","#ffffff");
		$(this).closest('.rowirn').children('.fieldsbankrecon').css("background","#ffffff");
		
		}); */
		
		uncheck_changerowcolor('irn');
		
});





var nwdatenotfunding = '';
var nwdesnotfunding = '';
var nwdebitnotfunding = '';
var nwcreditnotfunding = '';
var nwreqcodenotfunding = '';



 

$(':checkbox').live("click", function(){ 
		var $this = $(this);

		// $this will contain a reference to the checkbox
        //this is to change the background color of the div with checkboxes checked		
		if ($this.is(':checked')) {		
        $(this).closest('.rowfunding').children('.fieldsbankreconDate').css("background","#A9BCF5"); 		
		$(this).closest('.rowfunding').children('.fieldsbankreconDes').css("background","#A9BCF5");		
		$(this).closest('.rowfunding').children('.fieldsbankreconReq').css("background","#A9BCF5"); 		
		$(this).closest('.rowfunding').children('.fieldsbankreconDebit').css("background","#A9BCF5");
		$(this).closest('.rowfunding').children('.fieldsbankreconCredit').css("background","#A9BCF5");
		$(this).closest('.rowfunding').children('.fieldsbankrecon').css("background","#A9BCF5");
		
		
		
		}
		
		
		
		else
		{
		
		
        $(this).closest('.rowfunding').children('.fieldsbankreconDate').css("background","#ffffff"); 		
		$(this).closest('.rowfunding').children('.fieldsbankreconDes').css("background","#ffffff");		
		 $(this).closest('.rowfunding').children('.fieldsbankreconReq').css("background","#ffffff"); 		
		$(this).closest('.rowfunding').children('.fieldsbankreconDebit').css("background","#ffffff");
		$(this).closest('.rowfunding').children('.fieldsbankreconCredit').css("background","#ffffff");
		$(this).closest('.rowfunding').children('.fieldsbankrecon').css("background","#ffffff");
		
		
		
		
		
		
		}
		
		
		});
		
		
		
		
		
		
		
$(':checkbox').live("click", function(){ 
		var $this = $(this);

		// $this will contain a reference to the checkbox
        //this is to change the background color of the div with checkboxes checked		
		if ($this.is(':checked')) {		
        $(this).closest('.rowincome').children('.fieldsbankreconDate').css("background","#A9BCF5"); 		
		$(this).closest('.rowincome').children('.fieldsbankreconDes').css("background","#A9BCF5");		
		$(this).closest('.rowincome').children('.fieldsbankreconReq').css("background","#A9BCF5"); 		
		$(this).closest('.rowincome').children('.fieldsbankreconDebit').css("background","#A9BCF5");
		$(this).closest('.rowincome').children('.fieldsbankreconCredit').css("background","#A9BCF5");
		$(this).closest('.rowincome').children('.fieldsbankrecon').css("background","#A9BCF5");
		
		
		
		}
		
		
		
		else
		{
		
		
        $(this).closest('.rowincome').children('.fieldsbankreconDate').css("background","#ffffff"); 		
		$(this).closest('.rowincome').children('.fieldsbankreconDes').css("background","#ffffff");		
		 $(this).closest('.rowincome').children('.fieldsbankreconReq').css("background","#ffffff"); 		
		$(this).closest('.rowincome').children('.fieldsbankreconDebit').css("background","#ffffff");
		$(this).closest('.rowincome').children('.fieldsbankreconCredit').css("background","#ffffff");
		$(this).closest('.rowincome').children('.fieldsbankrecon').css("background","#ffffff");
		
		
		
		
		
		
		}
		
		
		});		
		

		
		
		

$(':checkbox').live("click", function(){ 
		var $this = $(this);

		// $this will contain a reference to the checkbox
        //this is to change the background color of the div with checkboxes checked		
		if ($this.is(':checked')) {		
        $(this).closest('.rowcardholder').children('.fieldsbankreconDate').css("background","#A9BCF5"); 		
		$(this).closest('.rowcardholder').children('.fieldsbankreconDes').css("background","#A9BCF5");		
		$(this).closest('.rowcardholder').children('.fieldsbankreconReq').css("background","#A9BCF5"); 		
		$(this).closest('.rowcardholder').children('.fieldsbankreconDebit').css("background","#A9BCF5");
		$(this).closest('.rowcardholder').children('.fieldsbankreconCredit').css("background","#A9BCF5");
		$(this).closest('.rowcardholder').children('.fieldsbankrecon').css("background","#A9BCF5");
		
		
		
		}
		
		
		
		else
		{
		
		
        $(this).closest('.rowcardholder').children('.fieldsbankreconDate').css("background","#ffffff"); 		
		$(this).closest('.rowcardholder').children('.fieldsbankreconDes').css("background","#ffffff");		
		 $(this).closest('.rowcardholder').children('.fieldsbankreconReq').css("background","#ffffff"); 		
		$(this).closest('.rowcardholder').children('.fieldsbankreconDebit').css("background","#ffffff");
		$(this).closest('.rowcardholder').children('.fieldsbankreconCredit').css("background","#ffffff");
		$(this).closest('.rowcardholder').children('.fieldsbankrecon').css("background","#ffffff");
		
		
		
		
		
		
		}
		
		
		});








$(':checkbox').live("click", function(){ 
		var $this = $(this);

		// $this will contain a reference to the checkbox
        //this is to change the background color of the div with checkboxes checked		
		if ($this.is(':checked')) {		
        $(this).closest('.rowsettlement').children('.fieldsbankreconDate').css("background","#A9BCF5"); 		
		$(this).closest('.rowsettlement').children('.fieldsbankreconDes').css("background","#A9BCF5");		
		$(this).closest('.rowsettlement').children('.fieldsbankreconReq').css("background","#A9BCF5"); 		
		$(this).closest('.rowsettlement').children('.fieldsbankreconDebit').css("background","#A9BCF5");
		$(this).closest('.rowsettlement').children('.fieldsbankreconCredit').css("background","#A9BCF5");
		$(this).closest('.rowsettlement').children('.fieldsbankrecon').css("background","#A9BCF5");
		
		
		
		}
		
		
		
		else
		{
		
		
        $(this).closest('.rowsettlement').children('.fieldsbankreconDate').css("background","#ffffff"); 		
		$(this).closest('.rowsettlement').children('.fieldsbankreconDes').css("background","#ffffff");		
		 $(this).closest('.rowsettlement').children('.fieldsbankreconReq').css("background","#ffffff"); 		
		$(this).closest('.rowsettlement').children('.fieldsbankreconDebit').css("background","#ffffff");
		$(this).closest('.rowsettlement').children('.fieldsbankreconCredit').css("background","#ffffff");
		$(this).closest('.rowsettlement').children('.fieldsbankrecon').css("background","#ffffff");
		
		
		
		
		
		
		}
		
		
		});






$(':checkbox').live("click", function(){ 
		var $this = $(this);

		// $this will contain a reference to the checkbox
        //this is to change the background color of the div with checkboxes checked		
		if ($this.is(':checked')) {		
        $(this).closest('.rowirn').children('.fieldsbankreconDate').css("background","#A9BCF5"); 		
		$(this).closest('.rowirn').children('.fieldsbankreconDes').css("background","#A9BCF5");		
		$(this).closest('.rowirn').children('.fieldsbankreconReq').css("background","#A9BCF5"); 		
		$(this).closest('.rowirn').children('.fieldsbankreconDebit').css("background","#A9BCF5");
		$(this).closest('.rowirn').children('.fieldsbankreconCredit').css("background","#A9BCF5");
		$(this).closest('.rowirn').children('.fieldsbankrecon').css("background","#A9BCF5");
		
		
		
		}
		
		
		
		else
		{
		
		
        $(this).closest('.rowirn').children('.fieldsbankreconDate').css("background","#ffffff"); 		
		$(this).closest('.rowirn').children('.fieldsbankreconDes').css("background","#ffffff");		
		 $(this).closest('.rowirn').children('.fieldsbankreconReq').css("background","#ffffff"); 		
		$(this).closest('.rowirn').children('.fieldsbankreconDebit').css("background","#ffffff");
		$(this).closest('.rowirn').children('.fieldsbankreconCredit').css("background","#ffffff");
		$(this).closest('.rowirn').children('.fieldsbankrecon').css("background","#ffffff");
		
		
		
		
		
		
		}
		
		
		});		
		
		
		
		
$(':checkbox').live("click", function(){ 
		var $this = $(this);

		// $this will contain a reference to the checkbox
        //this is to change the background color of the div with checkboxes checked		
		if ($this.is(':checked')) {		
        $(this).closest('.rowreserve').children('.fieldsbankreconDate').css("background","#A9BCF5"); 		
		$(this).closest('.rowreserve').children('.fieldsbankreconDes').css("background","#A9BCF5");		
		$(this).closest('.rowreserve').children('.fieldsbankreconReq').css("background","#A9BCF5"); 		
		$(this).closest('.rowreserve').children('.fieldsbankreconDebit').css("background","#A9BCF5");
		$(this).closest('.rowreserve').children('.fieldsbankreconCredit').css("background","#A9BCF5");
		$(this).closest('.rowreserve').children('.fieldsbankrecon').css("background","#A9BCF5");
		
		
		
		}
		
		
		
		else
		{
		
		
        $(this).closest('.rowreserve').children('.fieldsbankreconDate').css("background","#ffffff"); 		
		$(this).closest('.rowreserve').children('.fieldsbankreconDes').css("background","#ffffff");		
		 $(this).closest('.rowreserve').children('.fieldsbankreconReq').css("background","#ffffff"); 		
		$(this).closest('.rowreserve').children('.fieldsbankreconDebit').css("background","#ffffff");
		$(this).closest('.rowreserve').children('.fieldsbankreconCredit').css("background","#ffffff");
		$(this).closest('.rowreserve').children('.fieldsbankrecon').css("background","#ffffff");
		
		
		
		
		
		
		}
		
		
		});		
		




//if (!$('input.ckbox[type=checkbox]:not(:checked)').length)
  //  do('stuff');
  
 $('#calculatereserve').click(function(){ 
 //alert(" All the check boxes are checked");
   var message = "Trasactions are checked \n";
   
   
	
	$.ajax(
			{
			url:'notreconcile.php',
			type:'POST',
			data: {name:'truncate_temp',account:'reserve'},
			dataType:'json',
			success: function(data)
			{

									  

			$('#testupdate').append(data);




			}


			});

   
   //below is the is code to calculate the sum of the credit and debit with chekboxes checked 
   
    if ($('input.ckboxreserve[type=checkbox]:not(:checked)').length)
	{message = "Not  all the Transactions are checked \n";}
	var sum =0;
	var difference= 0;
	var credit =0;
	var debit = 0;
	var beforesum = 0;
	
	$('.rowreserve :checkbox').each(function() {
		var $this = $(this);
		// $this will contain a reference to the checkbox   
		if ($this.is(':checked')) {
		
			if(!isNaN(this.value) && this.value.length!=0) 
	  {
		
		//alert(sum);
		 beforesum = sum;
		sum += parseFloat(this.value);      
        

       
		  
       
	   
			
				if (sum < beforesum )
				{
					debit += parseFloat(this.value); 
				}
				else
				{
					credit += parseFloat(this.value);
				}		
	  }      
			
		}



    else
		{
		
		 nwdatenotreserve  = $(this).closest('.rowreserve').children('.fieldsbankreconDate').val();
         nwdesnotreserve  = $(this).closest('.rowreserve').children('.fieldsbankreconDes').val();
         nwdebitnotreserve = $(this).closest('.rowreserve').children('.fieldsbankreconDebit').val();
         nwcreditnotreserve = $(this).closest('.rowreserve').children('.fieldsbankreconCredit').val();
         
          			//alert("this is for not reconciled");
		  /*alert(nwdatenotreserve );
		  alert(nwdesnotreserve  );
		  alert(nwdebitnotreserve );
		  alert(nwcreditnotreserve ); */
		  
		  
		  
			$.ajax(
			{
			url:'notreconcile.php',
			type:'POST',
			data: {newdatenotaccount:nwdatenotreserve,newdesnotaccount:nwdesnotreserve,newdebitnotaccount:nwdebitnotreserve,newcreditnotaccount:nwcreditnotreserve,name:'reservenotreconciled',account:'reserve'},
			dataType:'json',
			success: function(data)
			{

									  

			$('#testupdate').append(data);




			}


			});
				
		
		}
		
		
		
	  
	});
	
	//var sum_new = sum.tofixed(2);
	$('#clearedbaltext').val(sum.toFixed(2));
        if ($('input.ckboxreserve[type=checkbox]:not(:checked)').length)
		{
		  difference = $('#closingbaltext').val() - $('#clearedbaltext').val() - $('#openingbaltext').val();
		}
		//trying to  preserve the code written above this why this if condition has no logical effect
		
		else{
	 difference = $('#closingbaltext').val() - $('#clearedbaltext').val()- $('#openingbaltext').val();}
	difference=  Math.abs(difference);
	$('#differencebaltext').val(difference.toFixed(2));
	message = message + " Beginning Balance : $" + $('#openingbaltext').val() + "\n";
	message = message + " Ending Balance : $" + $('#closingbaltext').val() + "\n";
	message = message + " Cleared Balance : $" + $('#clearedbaltext').val() + "\n";
	message = message + " Difference : $" + $('#differencebaltext').val(); + "\n";
	message = message + " Total Debit  : $" + debit + "\n";
	message = message + " Total Credit : $" + credit + "\n";
	
	
	$('input').each(function(){
    
        $(this).attr('value',$(this).val());
   
	
	
});



$('input:checkbox').each(function(){
    
     $(this).attr('checked',$(this).attr('checked'));
});






	alert(message);
	
	
	/*
	$('div input').each(function(){
    $(this).bind("change keyup input",function(){
        $(this).attr('value',$(this).val());
    });
	
	
});



$('div input:checkbox').each(function(){
    $(this).bind('click', function() {
     $(this).attr('checked',$(this).attr('checked'));
});


    }); */

	
	
});  
		
		

 $('#calculatefunding').click(function(){ 
 //alert(" All the check boxes are checked");
 $("#reconcilefunding").attr("enabled","enabled");
   var messagefunding = "Trasactions are checked \n";
   
   
	$.ajax(
			{
			url:'notreconcile.php',
			type:'POST',
			data: {name:'truncate_temp',account:'funding'},
			dataType:'json',
			success: function(data)
			{

									  

			$('#testupdate').append(data);




			}


			});
	

   
   //below is the is code to calculate the sum of the credit and debit with chekboxes checked 
   
    if ($('input.ckboxfunding[type=checkbox]:not(:checked)').length)
	{messagefunding = "Not  all the Transactions are checked \n";}
	var sumfunding =0;
	var differencefunding= 0;
	var credit = 0;
	var debit = 0;
	var beforesumfunding = 0;
	
	$('.rowfunding :checkbox').each(function() {
		var $this = $(this);
		// $this will contain a reference to the checkbox   
		if ($this.is(':checked')) {
		
			if(!isNaN(this.value) && this.value.length!=0) 
	  {
		
		//alert(sum);
		 beforesumfunding = sumfunding;
		 sumfunding += parseFloat(this.value);       
       
	   
			
				if (sumfunding < beforesumfunding )
				{
					debit += parseFloat(this.value); 
				}
				else
				{
					credit += parseFloat(this.value);
				}
			

	   
        		
	  }      
			
		} 
		
		else
		{
		
		 nwdatenotfunding  = $(this).closest('.rowfunding').children('.fieldsbankreconDate').val();
         nwdesnotfunding  = $(this).closest('.rowfunding').children('.fieldsbankreconDes').val();
         nwdebitnotfunding = $(this).closest('.rowfunding').children('.fieldsbankreconDebit').val();
         nwcreditnotfunding = $(this).closest('.rowfunding').children('.fieldsbankreconCredit').val();
         nwreqcodenotfunding  = $(this).closest('.rowfunding').children('.fieldsbankreconReq').val();
          
		 /*alert(nwdatenotfunding );
		  alert(nwdesnotfunding  );
		  alert(nwdebitnotfunding );
		  alert(nwcreditnotfunding );
		  alert(nwreqcodenotfunding ); */  
		  
		  
			$.ajax(
			{
			url:'notreconcile.php',
			type:'POST',
			data: {newdatenotaccount:nwdatenotfunding,newdesnotaccount:nwdesnotfunding,newdebitnotaccount:nwdebitnotfunding,newcreditnotaccount:nwcreditnotfunding,newreqcodenotaccount:nwreqcodenotfunding,name:'accountnotreconciled',account:'funding'},
			dataType:'json',
			success: function(data)
			{

									  

			$('#testupdate').append(data);




			}


			});
		
		}
		
		
		
		
	  
	});
	
	//var sum_new = sum.tofixed(2);
	
	var sumfunding = Math.abs(sumfunding);
	$('#clearedbaltextfunding').val(sumfunding.toFixed(2));
	  // $('#clearedbaltextfunding').val("-4537");
       
		  //differencefunding = parseFloat($('#closingbaltextfunding').val()) + parseFloat($('#openingbaltextfunding').val()) -  parseFloat($('#clearedbaltextfunding').val().substring(1)) ;
	//alert($('#clearedbaltextfunding').val().substring(1));
    //alert(differencefunding);	
	var closefunding = $('#closingbaltextfunding').val();
	var closefunding = Math.abs(closefunding);
    var openfunding	= $('#openingbaltextfunding').val();
	var openfunding = Math.abs(openfunding);
	var sumtotalfunding = parseFloat(closefunding) - parseFloat(openfunding) ;
	var sumtotalfunding = Math.abs(sumtotalfunding);
	 //alert(sumtotalfunding.toFixed(2));
	 var  differencefunding = parseFloat(sumtotalfunding.toFixed(2)) - parseFloat($('#clearedbaltextfunding').val());
	 //alert(differencefunding);
	$('#differencebaltextfunding').val(differencefunding.toFixed(2));
	messagefunding = messagefunding + " Beginning Balance : $" + $('#openingbaltextfunding').val() + "\n";
	messagefunding = messagefunding + " Ending Balance : $" + $('#closingbaltextfunding').val() + "\n";
	messagefunding = messagefunding + " Cleared Balance : $" + $('#clearedbaltextfunding').val() + "\n";
	messagefunding = messagefunding + " Difference : $" + $('#differencebaltextfunding').val() + "\n";
	messagefunding = messagefunding + " Total debit  : $" + debit + "\n";
	messagefunding = messagefunding + " Total credit  : $" + credit + "\n";
	
	//alert($('#differencebaltextfunding').val());
	
	$('input').each(function(){
    
        $(this).attr('value',$(this).val());
   
	
	
});



$('input:checkbox').each(function(){
    
     $(this).attr('checked',$(this).attr('checked'));
});






	alert(messagefunding);
	
	
	/*
	$('div input').each(function(){
    $(this).bind("change keyup input",function(){
        $(this).attr('value',$(this).val());
    });
	
	
});



$('div input:checkbox').each(function(){
    $(this).bind('click', function() {
     $(this).attr('checked',$(this).attr('checked'));
});


    }); */

	
	
});  











 $('#calculatesettlement').click(function(){ 
 //alert(" All the check boxes are checked");
 $("#reconcilesettlement").attr("enabled","enabled");
   var messagesettlement = "Trasactions are checked \n";
   
   
	$.ajax(
			{
			url:'notreconcile.php',
			type:'POST',
			data: {name:'truncate_temp',account:'settlement'},
			dataType:'json',
			success: function(data)
			{

									  

			$('#testupdate').append(data);




			}


			});
	

   
   //below is the is code to calculate the sum of the credit and debit with chekboxes checked 
   
    if ($('input.ckboxsettlement[type=checkbox]:not(:checked)').length)
	{messagesettlement = "Not  all the Transactions are checked \n";}
	var sumsettlement =0;
	var differencesettlement= 0;
	var credit = 0;
	var debit = 0;
	var beforesumsettlement = 0;
	
	$('.rowsettlement :checkbox').each(function() {
		var $this = $(this);
		// $this will contain a reference to the checkbox   
		if ($this.is(':checked')) {
		
			if(!isNaN(this.value) && this.value.length!=0) 
	  {
		
		//alert(sum);
		 beforesumsettlement = sumsettlement;
		 sumsettlement += parseFloat(this.value);       
       
	   
			
				if (sumsettlement < beforesumsettlement )
				{
					debit += parseFloat(this.value); 
				}
				else
				{
					credit += parseFloat(this.value);
				}
			

	   
        		
	  }      
			
		} 
		
		else
		{
		
		 nwdatenotsettlement  = $(this).closest('.rowsettlement').children('.fieldsbankreconDate').val();
         nwdesnotsettlement  = $(this).closest('.rowsettlement').children('.fieldsbankreconDes').val();
         nwdebitnotsettlement = $(this).closest('.rowsettlement').children('.fieldsbankreconDebit').val();
         nwcreditnotsettlement = $(this).closest('.rowsettlement').children('.fieldsbankreconCredit').val();
         nwreqcodenotsettlement  = $(this).closest('.rowsettlement').children('.fieldsbankreconReq').val();
          
		 /*alert(nwdatenotsettlement );
		  alert(nwdesnotsettlement  );
		  alert(nwdebitnotsettlement );
		  alert(nwcreditnotsettlement );
		  alert(nwreqcodenotsettlement ); */  
		  
		  
			$.ajax(
			{
			url:'notreconcile.php',
			type:'POST',
			data: {newdatenotaccount:nwdatenotsettlement,newdesnotaccount:nwdesnotsettlement,newdebitnotaccount:nwdebitnotsettlement,newcreditnotaccount:nwcreditnotsettlement,newreqcodenotaccount:nwreqcodenotsettlement,name:'accountnotreconciled',account:'settlement'},
			dataType:'json',
			success: function(data)
			{

									  

			$('#testupdate').append(data);




			}


			});
		
		}
		
		
		
		
	  
	});
	
	//var sum_new = sum.tofixed(2);
	
	var sumsettlement = Math.abs(sumsettlement);
	$('#clearedbaltextsettlement').val(sumsettlement.toFixed(2));
	  // $('#clearedbaltextsettlement').val("-4537");
       
		  //differencesettlement = parseFloat($('#closingbaltextsettlement').val()) + parseFloat($('#openingbaltextsettlement').val()) -  parseFloat($('#clearedbaltextsettlement').val().substring(1)) ;
	//alert($('#clearedbaltextsettlement').val().substring(1));
    //alert(differencesettlement);	
	var closesettlement = $('#closingbaltextsettlement').val();
	var closesettlement = Math.abs(closesettlement);
    var opensettlement	= $('#openingbaltextsettlement').val();
	var opensettlement = Math.abs(opensettlement);
	var sumtotalsettlement = parseFloat(closesettlement) - parseFloat(opensettlement) ;
	var sumtotalsettlement = Math.abs(sumtotalsettlement);
	 //alert(sumtotalsettlement.toFixed(2));
	 var  differencesettlement = parseFloat(sumtotalsettlement.toFixed(2)) - parseFloat($('#clearedbaltextsettlement').val());
	 //alert(differencesettlement);
	$('#differencebaltextsettlement').val(differencesettlement.toFixed(2));
	messagesettlement = messagesettlement + " Beginning Balance : $" + $('#openingbaltextsettlement').val() + "\n";
	messagesettlement = messagesettlement + " Ending Balance : $" + $('#closingbaltextsettlement').val() + "\n";
	messagesettlement = messagesettlement + " Cleared Balance : $" + $('#clearedbaltextsettlement').val() + "\n";
	messagesettlement = messagesettlement + " Difference : $" + $('#differencebaltextsettlement').val() + "\n";
	messagesettlement = messagesettlement + " Total debit  : $" + debit + "\n";
	messagesettlement = messagesettlement + " Total credit  : $" + credit + "\n";
	
	//alert($('#differencebaltextsettlement').val());
	
	$('input').each(function(){
    
        $(this).attr('value',$(this).val());
   
	
	
});



$('input:checkbox').each(function(){
    
     $(this).attr('checked',$(this).attr('checked'));
});






	alert(messagesettlement);
	
	
	/*
	$('div input').each(function(){
    $(this).bind("change keyup input",function(){
        $(this).attr('value',$(this).val());
    });
	
	
});



$('div input:checkbox').each(function(){
    $(this).bind('click', function() {
     $(this).attr('checked',$(this).attr('checked'));
});


    }); */

	
	
});  









 $('#calculatebalanceadjustment').click(function(){ 
 //alert(" All the check boxes are checked");
 $("#reconcilebalanceadjustment").attr("enabled","enabled");
   var messagebalanceadjustment = "Trasactions are checked \n";
   
   
	$.ajax(
			{
			url:'notreconcile.php',
			type:'POST',
			data: {name:'truncate_temp',account:'balanceadjustment'},
			dataType:'json',
			success: function(data)
			{

									  

			$('#testupdate').append(data);




			}


			});
	

   
   //below is the is code to calculate the sum of the credit and debit with chekboxes checked 
   
    if ($('input.ckboxbalanceadjustment[type=checkbox]:not(:checked)').length)
	{messagebalanceadjustment = "Not  all the Transactions are checked \n";}
	var sumbalanceadjustment =0;
	var differencebalanceadjustment= 0;
	var credit = 0;
	var debit = 0;
	var beforesumbalanceadjustment = 0;
	
	$('.rowbalanceadjustment :checkbox').each(function() {
		var $this = $(this);
		// $this will contain a reference to the checkbox   
		if ($this.is(':checked')) {
		
			if(!isNaN(this.value) && this.value.length!=0) 
	  {
		
		//alert(sum);
		 beforesumbalanceadjustment = sumbalanceadjustment;
		 sumbalanceadjustment += parseFloat(this.value);       
       
	   
			
				if (sumbalanceadjustment < beforesumbalanceadjustment )
				{
					debit += parseFloat(this.value); 
				}
				else
				{
					credit += parseFloat(this.value);
				}
			

	   
        		
	  }      
			
		} 
		
		else
		{
		
		 nwdatenotbalanceadjustment  = $(this).closest('.rowbalanceadjustment').children('.fieldsbankreconDate').val();
         nwdesnotbalanceadjustment  = $(this).closest('.rowbalanceadjustment').children('.fieldsbankreconDes').val();
         nwdebitnotbalanceadjustment = $(this).closest('.rowbalanceadjustment').children('.fieldsbankreconDebit').val();
         nwcreditnotbalanceadjustment = $(this).closest('.rowbalanceadjustment').children('.fieldsbankreconCredit').val();
         nwreqcodenotbalanceadjustment  = $(this).closest('.rowbalanceadjustment').children('.fieldsbankreconReq').val();
          
		 /*alert(nwdatenotbalanceadjustment );
		  alert(nwdesnotbalanceadjustment  );
		  alert(nwdebitnotbalanceadjustment );
		  alert(nwcreditnotbalanceadjustment );
		  alert(nwreqcodenotbalanceadjustment ); */  
		  
		  
			$.ajax(
			{
			url:'notreconcile.php',
			type:'POST',
			data: {newdatenotaccount:nwdatenotbalanceadjustment,newdesnotaccount:nwdesnotbalanceadjustment,newdebitnotaccount:nwdebitnotbalanceadjustment,newcreditnotaccount:nwcreditnotbalanceadjustment,newreqcodenotaccount:nwreqcodenotbalanceadjustment,name:'accountnotreconciled',account:'balanceadjustment'},
			dataType:'json',
			success: function(data)
			{

									  

			$('#testupdate').append(data);




			}


			});
		
		}
		
		
		
		
	  
	});
	
	//var sum_new = sum.tofixed(2);
	
	var sumbalanceadjustment = Math.abs(sumbalanceadjustment);
	$('#clearedbaltextbalanceadjustment').val(sumbalanceadjustment.toFixed(2));
	  // $('#clearedbaltextbalanceadjustment').val("-4537");
       
		  //differencebalanceadjustment = parseFloat($('#closingbaltextbalanceadjustment').val()) + parseFloat($('#openingbaltextbalanceadjustment').val()) -  parseFloat($('#clearedbaltextbalanceadjustment').val().substring(1)) ;
	//alert($('#clearedbaltextbalanceadjustment').val().substring(1));
    //alert(differencebalanceadjustment);	
	var closebalanceadjustment = $('#closingbaltextbalanceadjustment').val();
	var closebalanceadjustment = Math.abs(closebalanceadjustment);
    var openbalanceadjustment	= $('#openingbaltextbalanceadjustment').val();
	var openbalanceadjustment = Math.abs(openbalanceadjustment);
	var sumtotalbalanceadjustment = parseFloat(closebalanceadjustment) - parseFloat(openbalanceadjustment) ;
	var sumtotalbalanceadjustment = Math.abs(sumtotalbalanceadjustment);
	 //alert(sumtotalbalanceadjustment.toFixed(2));
	 var  differencebalanceadjustment = parseFloat(sumtotalbalanceadjustment.toFixed(2)) - parseFloat($('#clearedbaltextbalanceadjustment').val());
	 //alert(differencebalanceadjustment);
	$('#differencebaltextbalanceadjustment').val(differencebalanceadjustment.toFixed(2));
	messagebalanceadjustment = messagebalanceadjustment + " Beginning Balance : $" + $('#openingbaltextbalanceadjustment').val() + "\n";
	messagebalanceadjustment = messagebalanceadjustment + " Ending Balance : $" + $('#closingbaltextbalanceadjustment').val() + "\n";
	messagebalanceadjustment = messagebalanceadjustment + " Cleared Balance : $" + $('#clearedbaltextbalanceadjustment').val() + "\n";
	messagebalanceadjustment = messagebalanceadjustment + " Difference : $" + $('#differencebaltextbalanceadjustment').val() + "\n";
	messagebalanceadjustment = messagebalanceadjustment + " Total debit  : $" + debit + "\n";
	messagebalanceadjustment = messagebalanceadjustment + " Total credit  : $" + credit + "\n";
	
	//alert($('#differencebaltextbalanceadjustment').val());
	
	$('input').each(function(){
    
        $(this).attr('value',$(this).val());
   
	
	
});



$('input:checkbox').each(function(){
    
     $(this).attr('checked',$(this).attr('checked'));
});






	alert(messagebalanceadjustment);
	
	
	/*
	$('div input').each(function(){
    $(this).bind("change keyup input",function(){
        $(this).attr('value',$(this).val());
    });
	
	
});



$('div input:checkbox').each(function(){
    $(this).bind('click', function() {
     $(this).attr('checked',$(this).attr('checked'));
});


    }); */

	
	
});  


















 $('#calculatecardholder').click(function(){ 
 //alert(" All the check boxes are checked");
 $("#reconcilecardholder").attr("enabled","enabled");
   var messagecardholder = "Trasactions are checked \n";
   
   
	$.ajax(
			{
			url:'notreconcile.php',
			type:'POST',
			data: {name:'truncate_temp',account:'cardholder'},
			dataType:'json',
			success: function(data)
			{

									  

			$('#testupdate').append(data);




			}


			});
	

   
   //below is the is code to calculate the sum of the credit and debit with chekboxes checked 
   
    if ($('input.ckboxcardholder[type=checkbox]:not(:checked)').length)
	{messagecardholder = "Not  all the Transactions are checked \n";}
	var sumcardholder =0;
	var differencecardholder= 0;
	var credit = 0;
	var debit = 0;
	var beforesumcardholder = 0;
	
	$('.rowcardholder :checkbox').each(function() {
		var $this = $(this);
		// $this will contain a reference to the checkbox   
		if ($this.is(':checked')) {
		
			if(!isNaN(this.value) && this.value.length!=0) 
	  {
		
		//alert(sum);
		 beforesumcardholder = sumcardholder;
		 sumcardholder += parseFloat(this.value);       
       
	   
			
				if (sumcardholder < beforesumcardholder )
				{
					debit += parseFloat(this.value); 
				}
				else
				{
					credit += parseFloat(this.value);
				}
			

	   
        		
	  }      
			
		} 
		
		else
		{
		
		 nwdatenotcardholder  = $(this).closest('.rowcardholder').children('.fieldsbankreconDate').val();
         nwdesnotcardholder  = $(this).closest('.rowcardholder').children('.fieldsbankreconDes').val();
         nwdebitnotcardholder = $(this).closest('.rowcardholder').children('.fieldsbankreconDebit').val();
         nwcreditnotcardholder = $(this).closest('.rowcardholder').children('.fieldsbankreconCredit').val();
         nwreqcodenotcardholder  = $(this).closest('.rowcardholder').children('.fieldsbankreconReq').val();
          
		 /*alert(nwdatenotcardholder );
		  alert(nwdesnotcardholder  );
		  alert(nwdebitnotcardholder );
		  alert(nwcreditnotcardholder );
		  alert(nwreqcodenotcardholder ); */  
		  
		  
			$.ajax(
			{
			url:'notreconcile.php',
			type:'POST',
			data: {newdatenotaccount:nwdatenotcardholder,newdesnotaccount:nwdesnotcardholder,newdebitnotaccount:nwdebitnotcardholder,newcreditnotaccount:nwcreditnotcardholder,newreqcodenotaccount:nwreqcodenotcardholder,name:'accountnotreconciled',account:'cardholder'},
			dataType:'json',
			success: function(data)
			{

									  

			$('#testupdate').append(data);




			}


			});
		
		}
		
		
		
		
	  
	});
	
	//var sum_new = sum.tofixed(2);
	
	var sumcardholder = Math.abs(sumcardholder);
	$('#clearedbaltextcardholder').val(sumcardholder.toFixed(2));
	  // $('#clearedbaltextcardholder').val("-4537");
       
		  //differencecardholder = parseFloat($('#closingbaltextcardholder').val()) + parseFloat($('#openingbaltextcardholder').val()) -  parseFloat($('#clearedbaltextcardholder').val().substring(1)) ;
	//alert($('#clearedbaltextcardholder').val().substring(1));
    //alert(differencecardholder);	
	var closecardholder = $('#closingbaltextcardholder').val();
	var closecardholder = Math.abs(closecardholder);
    var opencardholder	= $('#openingbaltextcardholder').val();
	var opencardholder = Math.abs(opencardholder);
	var sumtotalcardholder = parseFloat(closecardholder) - parseFloat(opencardholder) ;
	var sumtotalcardholder = Math.abs(sumtotalcardholder);
	 //alert(sumtotalcardholder.toFixed(2));
	 var  differencecardholder = parseFloat(sumtotalcardholder.toFixed(2)) - parseFloat($('#clearedbaltextcardholder').val());
	 //alert(differencecardholder);
	$('#differencebaltextcardholder').val(differencecardholder.toFixed(2));
	messagecardholder = messagecardholder + " Beginning Balance : $" + $('#openingbaltextcardholder').val() + "\n";
	messagecardholder = messagecardholder + " Ending Balance : $" + $('#closingbaltextcardholder').val() + "\n";
	messagecardholder = messagecardholder + " Cleared Balance : $" + $('#clearedbaltextcardholder').val() + "\n";
	messagecardholder = messagecardholder + " Difference : $" + $('#differencebaltextcardholder').val() + "\n";
	messagecardholder = messagecardholder + " Total debit  : $" + debit + "\n";
	messagecardholder = messagecardholder + " Total credit  : $" + credit + "\n";
	
	//alert($('#differencebaltextcardholder').val());
	
	$('input').each(function(){
    
        $(this).attr('value',$(this).val());
   
	
	
});



$('input:checkbox').each(function(){
    
     $(this).attr('checked',$(this).attr('checked'));
});






	alert(messagecardholder);
	
	
	/*
	$('div input').each(function(){
    $(this).bind("change keyup input",function(){
        $(this).attr('value',$(this).val());
    });
	
	
});



$('div input:checkbox').each(function(){
    $(this).bind('click', function() {
     $(this).attr('checked',$(this).attr('checked'));
});


    }); */

	
	
});  
















 $('#calculateirn').click(function(){ 
 //alert(" All the check boxes are checked");
 $("#reconcileirn").attr("enabled","enabled");
   var messageirn = "Trasactions are checked \n";
   
   
	$.ajax(
			{
			url:'notreconcile.php',
			type:'POST',
			data: {name:'truncate_temp',account:'irn'},
			dataType:'json',
			success: function(data)
			{

									  

			$('#testupdate').append(data);




			}


			});
	

   
   //below is the is code to calculate the sum of the credit and debit with chekboxes checked 
   
    if ($('input.ckboxirn[type=checkbox]:not(:checked)').length)
	{messageirn = "Not  all the Transactions are checked \n";}
	var sumirn =0;
	var differenceirn= 0;
	var credit = 0;
	var debit = 0;
	var beforesumirn = 0;
	
	$('.rowirn :checkbox').each(function() {
		var $this = $(this);
		// $this will contain a reference to the checkbox   
		if ($this.is(':checked')) {
		
			if(!isNaN(this.value) && this.value.length!=0) 
	  {
		
		//alert(sum);
		 beforesumirn = sumirn;
		 sumirn += parseFloat(this.value);       
       
	   
			
				if (sumirn < beforesumirn )
				{
					debit += parseFloat(this.value); 
				}
				else
				{
					credit += parseFloat(this.value);
				}
			

	   
        		
	  }      
			
		} 
		
		else
		{
		
		 nwdatenotirn  = $(this).closest('.rowirn').children('.fieldsbankreconDate').val();
         nwdesnotirn  = $(this).closest('.rowirn').children('.fieldsbankreconDes').val();
         nwdebitnotirn = $(this).closest('.rowirn').children('.fieldsbankreconDebit').val();
         nwcreditnotirn = $(this).closest('.rowirn').children('.fieldsbankreconCredit').val();
         nwreqcodenotirn  = $(this).closest('.rowirn').children('.fieldsbankreconReq').val();
          
		 /*alert(nwdatenotirn );
		  alert(nwdesnotirn  );
		  alert(nwdebitnotirn );
		  alert(nwcreditnotirn );
		  alert(nwreqcodenotirn ); */  
		  
		  
			$.ajax(
			{
			url:'notreconcile.php',
			type:'POST',
			data: {newdatenotaccount:nwdatenotirn,newdesnotaccount:nwdesnotirn,newdebitnotaccount:nwdebitnotirn,newcreditnotaccount:nwcreditnotirn,newreqcodenotaccount:nwreqcodenotirn,name:'accountnotreconciled',account:'irn'},
			dataType:'json',
			success: function(data)
			{

									  

			$('#testupdate').append(data);




			}


			});
		
		}
		
		
		
		
	  
	});
	
	//var sum_new = sum.tofixed(2);
	
	var sumirn = Math.abs(sumirn);
	$('#clearedbaltextirn').val(sumirn.toFixed(2));
	  // $('#clearedbaltextirn').val("-4537");
       
		  //differenceirn = parseFloat($('#closingbaltextirn').val()) + parseFloat($('#openingbaltextirn').val()) -  parseFloat($('#clearedbaltextirn').val().substring(1)) ;
	//alert($('#clearedbaltextirn').val().substring(1));
    //alert(differenceirn);	
	var closeirn = $('#closingbaltextirn').val();
	//var closeirn = Math.abs(closeirn);
    var openirn	= $('#openingbaltextirn').val();
	//var openirn = Math.abs(openirn);
	var sumtotalirn = parseFloat(closeirn) - parseFloat(openirn) ;
	var sumtotalirn = Math.abs(sumtotalirn);
	 //alert(sumtotalirn.toFixed(2));
	 var  differenceirn = parseFloat(sumtotalirn.toFixed(2)) - parseFloat($('#clearedbaltextirn').val());
	 //alert(differenceirn);
	$('#differencebaltextirn').val(differenceirn.toFixed(2));
	messageirn = messageirn + " Beginning Balance : $" + $('#openingbaltextirn').val() + "\n";
	messageirn = messageirn + " Ending Balance : $" + $('#closingbaltextirn').val() + "\n";
	messageirn = messageirn + " Cleared Balance : $" + $('#clearedbaltextirn').val() + "\n";
	messageirn = messageirn + " Difference : $" + $('#differencebaltextirn').val() + "\n";
	messageirn = messageirn + " Total debit  : $" + debit + "\n";
	messageirn = messageirn + " Total credit  : $" + credit + "\n";
	
	//alert($('#differencebaltextirn').val());
	
	$('input').each(function(){
    
        $(this).attr('value',$(this).val());
   
	
	
});



$('input:checkbox').each(function(){
    
     $(this).attr('checked',$(this).attr('checked'));
});






	alert(messageirn);
	
	
	/*
	$('div input').each(function(){
    $(this).bind("change keyup input",function(){
        $(this).attr('value',$(this).val());
    });
	
	
});



$('div input:checkbox').each(function(){
    $(this).bind('click', function() {
     $(this).attr('checked',$(this).attr('checked'));
});


    }); */

	
	
});  




 




 $('#calculateincome').click(function(){ 
 
 $("#reconcileincome").attr("enabled","enabled");
   var messageincome = "Trasactions are checked \n";
   
  $.ajax(
			{
			url:'notreconcile.php',
			type:'POST',
			data: {name:'truncate_temp',account:'income'},
			dataType:'json',
			success: function(data)
			{

									  

			$('#testupdate').append(data);




			}


			});
	
	

   
   //below is the is code to calculate the sum of the credit and debit with chekboxes checked 
   
    if ($('input.ckboxincome[type=checkbox]:not(:checked)').length)
	{messageincome = "Not  all the Transactions are checked \n";}
	
	var sumincome =0;
	var differenceincome= 0;
	var credit = 0;
	var debit = 0;
	var beforesumincome = 0;
	
	$('.rowincome :checkbox').each(function() {
	
	//this is to  loop through all the transaction of the account on the page whose check boxes are checked
		var $this = $(this);
		// variable $this contains a reference to the checkbox   
		if ($this.is(':checked')) {
		
		/* This loop will check all the checked transactions on the account 
		Here check boxes  have  their  own hidden values which corresponds  
		to the actual credit and debit values of the transactions.
		this.value is actually picking up the values from the check boxes  
		*/
			if(!isNaN(this.value) && this.value.length!=0) 
	  {
		//condition is only true if and only if the value of the check box is not null and the length is not null for the value of the check box
		
		 beforesumincome = sumincome;
		 sumincome += parseFloat(this.value);       
       
	 
			
				if (sumincome < beforesumincome )
				{
					debit += parseFloat(this.value); 
				}
				else
				{
					credit += parseFloat(this.value);
				}
			

	   
        		
	  }      
			
		} 
		
		else
		{
		 //lines here are to assimilate the not reconciled transactions
		 nwdatenotincome  = $(this).closest('.rowincome').children('.fieldsbankreconDate').val();
         nwdesnotincome  = $(this).closest('.rowincome').children('.fieldsbankreconDes').val();
         nwdebitnotincome = $(this).closest('.rowincome').children('.fieldsbankreconDebit').val();
         nwcreditnotincome = $(this).closest('.rowincome').children('.fieldsbankreconCredit').val();
         nwreqcodenotincome  = $(this).closest('.rowincome').children('.fieldsbankreconReq').val();
          
		  
		  
			
		
		}
		
		
		
		
	  
	});
	
	//var sum_new = sum.tofixed(2);
	
	var sumincome = Math.abs(sumincome);
	$('#clearedbaltextincome').val(sumincome.toFixed(2));
	  // $('#clearedbaltextincome').val("-4537");
       
		  //differenceincome = parseFloat($('#closingbaltextincome').val()) + parseFloat($('#openingbaltextincome').val()) -  parseFloat($('#clearedbaltextincome').val().substring(1)) ;
	//alert($('#clearedbaltextincome').val().substring(1));
    //alert(differenceincome);	
	var closeincome = $('#closingbaltextincome').val();
	var closeincome = Math.abs(closeincome);
    var openincome	= $('#openingbaltextincome').val();
	var openincome = Math.abs(openincome);
	var sumtotalincome = parseFloat(closeincome) - parseFloat(openincome) ;
	var sumtotalincome = Math.abs(sumtotalincome);
	 //alert(sumtotalincome.toFixed(2));
	 var  differenceincome = parseFloat(sumtotalincome.toFixed(2)) - parseFloat($('#clearedbaltextincome').val());
	 //alert(differenceincome);
	$('#differencebaltextincome').val(differenceincome.toFixed(2));
	messageincome = messageincome + " Beginning Balance : $" + $('#openingbaltextincome').val() + "\n";
	messageincome = messageincome + " Ending Balance : $" + $('#closingbaltextincome').val() + "\n";
	messageincome = messageincome + " Cleared Balance : $" + $('#clearedbaltextincome').val() + "\n";
	messageincome = messageincome + " Difference : $" + $('#differencebaltextincome').val() + "\n";
	messageincome = messageincome + " Total debit  : $" + debit + "\n";
	messageincome = messageincome + " Total credit  : $" + credit + "\n";
	
	//alert($('#differencebaltextincome').val());
	
	$('input').each(function(){
    
        $(this).attr('value',$(this).val());
   
	
	
});



$('input:checkbox').each(function(){
    
     $(this).attr('checked',$(this).attr('checked'));
});






	alert(messageincome);
	
	
	/*
	$('div input').each(function(){
    $(this).bind("change keyup input",function(){
        $(this).attr('value',$(this).val());
    });
	
	
});



$('div input:checkbox').each(function(){
    $(this).bind('click', function() {
     $(this).attr('checked',$(this).attr('checked'));
});


    }); */

	
	
});  


$('#reconcilereserve').click(function(){ 
var difference = $('#differencebaltext').val();
if(difference == 0)
{

var startdate  = $('#datepickerbankstart').val();
var enddate = $('#datepickerbankend').val();
//alert ("hi");
alert(" Reserve Account, Reconciled" + " \n" + " Saved for the dates  :" + startdate +" & " + enddate + " \n " + " You can click on  Reconciled Data on the top to view this Reconcilation");


var beginingbal = $('#openingbaltext').val();
var endingbal = $('#closingbaltext').val();
var clearedbal = $('#clearedbaltext').val();
var difference = $('#differencebaltext').val();


$.ajax(
{
url:'reconcile.php',
type:'POST',
data: {startdate:startdate,enddate:enddate, beginingbal:beginingbal,endingbal:endingbal,clearedbal:clearedbal, difference:difference,name:'reservereconcile',accounttype:'reserve'},
dataType:'json',
success: function(data)
{

                          

$('#testupdate').append(data);




}


});









$('.rowreserve :checkbox').each(function() {

var $this = $(this);

if ($this.is(':checked')) {

if(!isNaN(this.value) && this.value.length!=0) 
{

var reconciledate  = $(this).closest('.rowreserve').children('.fieldsbankreconDate').val();
var reconciledes  = $(this).closest('.rowreserve').children('.fieldsbankreconDes').val();
var reconciledebit = $(this).closest('.rowreserve').children('.fieldsbankreconDebit').val();
var reconcilecredit = $(this).closest('.rowreserve').children('.fieldsbankreconCredit').val();




$.ajax
(
{
url:'update.php',
type:'POST',
data: {newdate:reconciledate,newdes:reconciledes,newdebit:reconciledebit,newcredit:reconcilecredit,name:'addreconcile',acctype:'reserve'},
dataType:'json',

success: function(data)
{

                          

$('#testupdate').append(data);




}



});









       
var notreconciled  = $(this).closest('.rowreserve').children('.notreconciled').val();
	   
	   if(notreconciled == 1)
	   {
	   
	   
	   
	   //alert("hi this is not reconcile checked");
	   
	    var  datenotreconcilereserve    = $(this).closest('.rowreserve').children('.fieldsbankreconDate').val();
        var  desnotreconcilereserve     = $(this).closest('.rowreserve').children('.fieldsbankreconDes').val();
        var  debitnotreconcilereserve   = $(this).closest('.rowreserve').children('.fieldsbankreconDebit').val();
        var  creditnotreconcilereserve  = $(this).closest('.rowreserve').children('.fieldsbankreconCredit').val();
       
		 
		 //alert(creditnotreconcilereserve);
		 
          
       	   
	     
	   $.ajax(
			{

			url:'notreconcile.php',
			type:'POST',
			data: {datenotreconcileaccount:datenotreconcilereserve,desnotreconcileaccount:desnotreconcilereserve,debitnotreconcileaccount:debitnotreconcilereserve,creditnotreconcileaccount:creditnotreconcilereserve,name:'reservenotreconcileddel',account:'reserve'},
			dataType:'text',
			success: function(data)
			{

		

			$('#testupdate').append(data);




			}


			});
	    
	   }
	   
        










}

}

});










$.ajax(
{
url:'notreconcile.php',
type:'POST',
data: {name:'reservenotreconciledmove',account:'reserve'},
dataType:'json',
success: function(data)
{

                          

$('#testupdate').append(data);




}


});













}


else 

{

alert("Please check, the difference is not zero");

}
});





$('#reconcilefunding').click(function(){ 
$("#reconcilefunding").attr("disabled","disabled");
var startdate  = $('#datepickerbankstart').val();
var enddate = $('#datepickerbankend').val();
//alert ("hi");
alert(" Funding  Account, Reconciled" + " \n" + " Saved for the dates  :" + startdate +" & " + enddate + " \n " + " You can click on  Reconciled Data on the top to view this Reconcilation");


var beginingbal = $('#openingbaltextfunding').val();
var endingbal = $('#closingbaltextfunding').val();
var clearedbal = $('#clearedbaltextfunding').val();
var difference = $('#differencebaltextfunding').val();







$('.rowfunding :checkbox').each(function() {

var $this = $(this);

if ($this.is(':checked')) {

if(!isNaN(this.value) && this.value.length!=0) 
{

var reconciledate  = $(this).closest('.rowfunding').children('.fieldsbankreconDate').val();
var reconciledes  = $(this).closest('.rowfunding').children('.fieldsbankreconDes').val();
var reconciledebit = $(this).closest('.rowfunding').children('.fieldsbankreconDebit').val();
var reconcilecredit = $(this).closest('.rowfunding').children('.fieldsbankreconCredit').val();
var reconcilereqcode  = $(this).closest('.rowfunding').children('.fieldsbankreconReq').val();



$.ajax
(
{
url:'update.php',
type:'POST',
data: {newdate:reconciledate,newdes:reconciledes,newdebit:reconciledebit,newreqcode:reconcilereqcode,newcredit:reconcilecredit,name:'addreconcile',acctype:'funding'},
dataType:'json',

success: function(data)
{

                          

$('#testupdate').append(data);




}



});









       
var notreconciled  = $(this).closest('.rowfunding').children('.notreconciled').val();
	   
	   if(notreconciled == 1)
	   {
	   
	   
	   
	   //alert("hi this is not reconcile checked");
	   
	    var  datenotreconcilefunding    = $(this).closest('.rowfunding').children('.fieldsbankreconDate').val();
        var  desnotreconcilefunding     = $(this).closest('.rowfunding').children('.fieldsbankreconDes').val();
        var  debitnotreconcilefunding   = $(this).closest('.rowfunding').children('.fieldsbankreconDebit').val();
        var  creditnotreconcilefunding  = $(this).closest('.rowfunding').children('.fieldsbankreconCredit').val();
        var reqcodenotreconcilefunding = $(this).closest('.rowfunding').children('.fieldsbankreconReq').val();
		 
		 alert(reqcodenotreconcilefunding);
		 
          
       	   
	     
	   $.ajax(
			{
			url:'notreconcile.php',
			type:'POST',
			data: {datenotreconcileaccount:datenotreconcilefunding,desnotreconcileaccount:desnotreconcilefunding,debitnotreconcileaccount:debitnotreconcilefunding,creditnotreconcileaccount:creditnotreconcilefunding,reqcodenotreconcileaccount:reqcodenotreconcilefunding,name:'accountnotreconcileddel',account:'funding'},
			dataType:'text',
			success: function(data)
			{

		

			$('#testupdate').append(data);




			}


			});
	    
	   }
	   
        










}

}

});


$.ajax(
{
url:'reconcile.php',
type:'POST',
data: {startdate:startdate,enddate:enddate, beginingbal:beginingbal,endingbal:endingbal,clearedbal:clearedbal, difference:difference,name:'accountreconcile',accounttype:'funding'},
dataType:'json',
success: function(data)
{

                          

$('#testupdate').append(data);




}


});



         
		 
		 

$.ajax(
{
url:'notreconcile.php',
type:'POST',
data: {name:'accountnotreconciledmove',account:'funding'},
dataType:'json',
success: function(data)
{

                          

$('#testupdate').append(data);




}


});


});






$('#reconcileincome').click(function(){ 
$("#reconcileincome").attr("disabled","disabled");
var startdate  = $('#datepickerbankstart').val();
var enddate = $('#datepickerbankend').val();
//alert ("hi");
alert(" income  Account, Reconciled" + " \n" + " Saved for the dates  :" + startdate +" & " + enddate + " \n " + " You can click on  Reconciled Data on the top to view this Reconcilation");


var beginingbal = $('#openingbaltextincome').val();
var endingbal = $('#closingbaltextincome').val();
var clearedbal = $('#clearedbaltextincome').val();
var difference = $('#differencebaltextincome').val();








$('.rowincome :checkbox').each(function() {

var $this = $(this);

if ($this.is(':checked')) {

if(!isNaN(this.value) && this.value.length!=0) 
{

var reconciledate  = $(this).closest('.rowincome').children('.fieldsbankreconDate').val();
var reconciledes  = $(this).closest('.rowincome').children('.fieldsbankreconDes').val();
var reconciledebit = $(this).closest('.rowincome').children('.fieldsbankreconDebit').val();
var reconcilecredit = $(this).closest('.rowincome').children('.fieldsbankreconCredit').val();
var reconcilereqcode  = $(this).closest('.rowincome').children('.fieldsbankreconReq').val();



$.ajax
(
{
url:'update.php',
type:'POST',
data: {newdate:reconciledate,newdes:reconciledes,newdebit:reconciledebit,newreqcode:reconcilereqcode,newcredit:reconcilecredit,name:'addreconcile',acctype:'income'},
dataType:'json',

success: function(data)
{

                          

$('#testupdate').append(data);




}



});









       
var notreconciled  = $(this).closest('.rowincome').children('.notreconciled').val();
	   
	   if(notreconciled == 1)
	   {
	   
	   
	   
	   //alert("hi this is not reconcile checked");
	    var  datenotreconcileincome    = $(this).closest('.rowincome').children('.fieldsbankreconDate').val();
        var  desnotreconcileincome     = $(this).closest('.rowincome').children('.fieldsbankreconDes').val();
        var  debitnotreconcileincome   = $(this).closest('.rowincome').children('.fieldsbankreconDebit').val();
        var  creditnotreconcileincome  = $(this).closest('.rowincome').children('.fieldsbankreconCredit').val();
        var reqcodenotreconcileincome = $(this).closest('.rowincome').children('.fieldsbankreconReq').val();
		 
		 
		 
          
       	   
	     
	   $.ajax(
			{
			url:'notreconcile.php',
			type:'POST',
				data: {datenotreconcileaccount:datenotreconcileincome,desnotreconcileaccount:desnotreconcileincome,debitnotreconcileaccount:debitnotreconcileincome,creditnotreconcileaccount:creditnotreconcileincome,reqcodenotreconcileaccount:reqcodenotreconcileincome,name:'accountnotreconcileddel',account:'income'},
			dataType:'text',
			success: function(data)
			{

		

			$('#testupdate').append(data);




			}


			});
	    
	   }
	   
        










}

}

});



$.ajax(
{
url:'reconcile.php',
type:'POST',
data: {startdate:startdate,enddate:enddate, beginingbal:beginingbal,endingbal:endingbal,clearedbal:clearedbal,difference:difference,name:'accountreconcile',accounttype:'income'},
dataType:'json',
success: function(data)
{

                          

$('#testupdate').append(data);




}


});

         

$.ajax(
{
url:'notreconcile.php',
type:'POST',
data: {name:'accountnotreconciledmove',account:'income'},
dataType:'json',
success: function(data)
{

                          

$('#testupdate').append(data);




}


});


});




$('#reconcilecardholder').click(function(){ 
$("#reconcilecardholder").attr("disabled","disabled");
var startdate  = $('#datepickerbankstart').val();
var enddate = $('#datepickerbankend').val();
//alert ("hi");
alert(" cardholder  Account, Reconciled" + " \n" + " Saved for the dates  :" + startdate +" & " + enddate + " \n " + " You can click on  Reconciled Data on the top to view this Reconcilation");


var beginingbal = $('#openingbaltextcardholder').val();
var endingbal = $('#closingbaltextcardholder').val();
var clearedbal = $('#clearedbaltextcardholder').val();
var difference = $('#differencebaltextcardholder').val();







$('.rowcardholder :checkbox').each(function() {

var $this = $(this);

if ($this.is(':checked')) {

if(!isNaN(this.value) && this.value.length!=0) 
{

var reconciledate  = $(this).closest('.rowcardholder').children('.fieldsbankreconDate').val();
var reconciledes  = $(this).closest('.rowcardholder').children('.fieldsbankreconDes').val();
var reconciledebit = $(this).closest('.rowcardholder').children('.fieldsbankreconDebit').val();
var reconcilecredit = $(this).closest('.rowcardholder').children('.fieldsbankreconCredit').val();
var reconcilereqcode  = $(this).closest('.rowcardholder').children('.fieldsbankreconReq').val();



$.ajax
(
{
url:'update.php',
type:'POST',
data: {newdate:reconciledate,newdes:reconciledes,newdebit:reconciledebit,newreqcode:reconcilereqcode,newcredit:reconcilecredit,name:'addreconcile',acctype:'cardholder'},
dataType:'json',

success: function(data)
{

                          

$('#testupdate').append(data);




}



});









       
var notreconciled  = $(this).closest('.rowcardholder').children('.notreconciled').val();
	   
	   if(notreconciled == 1)
	   {
	   
	   
	   
	   //alert("hi this is not reconcile checked");
	    var  datenotreconcilecardholder    = $(this).closest('.rowcardholder').children('.fieldsbankreconDate').val();
        var  desnotreconcilecardholder     = $(this).closest('.rowcardholder').children('.fieldsbankreconDes').val();
        var  debitnotreconcilecardholder   = $(this).closest('.rowcardholder').children('.fieldsbankreconDebit').val();
        var  creditnotreconcilecardholder  = $(this).closest('.rowcardholder').children('.fieldsbankreconCredit').val();
        var reqcodenotreconcilecardholder = $(this).closest('.rowcardholder').children('.fieldsbankreconReq').val();
		 
		 
		 
          
       	   
	     
	   $.ajax(
			{
			url:'notreconcile.php',
			type:'POST',
			data: {datenotreconcileaccount:datenotreconcilecardholder,desnotreconcileaccount:desnotreconcilecardholder,debitnotreconcileaccount:debitnotreconcilecardholder,creditnotreconcileaccount:creditnotreconcilecardholder,reqcodenotreconcileaccount:reqcodenotreconcilecardholder,name:'accountnotreconcileddel',account:'cardholder'},
			dataType:'text',
			success: function(data)
			{

		

			$('#testupdate').append(data);




			}


			});
	    
	   }
	   
        










}

}

});


$.ajax(
{
url:'reconcile.php',
type:'POST',
data: {startdate:startdate,enddate:enddate, beginingbal:beginingbal,endingbal:endingbal,clearedbal:clearedbal, difference:difference,name:'accountreconcile',accounttype:'cardholder'},
dataType:'json',
success: function(data)
{

                          

$('#testupdate').append(data);




}


});




$.ajax(
{
url:'reconcile.php',
type:'POST',
data: {startdate:startdate,enddate:enddate, beginingbal:beginingbal,endingbal:endingbal,clearedbal:clearedbal, difference:difference,name:'accountreconcilenew',accounttype:'cardholder'},
dataType:'json',
success: function(data)
{

                          

$('#testupdate').append(data);




}


});



         

$.ajax(
{
url:'notreconcile.php',
type:'POST',
data: {name:'accountnotreconciledmove',account:'cardholder'},
dataType:'json',
success: function(data)
{

                          

$('#testupdate').append(data);




}


});


});


$('#reconcilesettlement').click(function(){ 
$("#reconcilesettlement").attr("disabled","disabled");
var startdate  = $('#datepickerbankstart').val();
var enddate = $('#datepickerbankend').val();
//alert ("hi");
alert(" settlement  Account, Reconciled" + " \n" + " Saved for the dates  :" + startdate +" & " + enddate + " \n " + " You can click on  Reconciled Data on the top to view this Reconcilation");


var beginingbal = $('#openingbaltextsettlement').val();
var endingbal = $('#closingbaltextsettlement').val();
var clearedbal = $('#clearedbaltextsettlement').val();
var difference = $('#differencebaltextsettlement').val();








$('.rowsettlement :checkbox').each(function() {

var $this = $(this);

if ($this.is(':checked')) {

if(!isNaN(this.value) && this.value.length!=0) 
{

var reconciledate  = $(this).closest('.rowsettlement').children('.fieldsbankreconDate').val();
var reconciledes  = $(this).closest('.rowsettlement').children('.fieldsbankreconDes').val();
var reconciledebit = $(this).closest('.rowsettlement').children('.fieldsbankreconDebit').val();
var reconcilecredit = $(this).closest('.rowsettlement').children('.fieldsbankreconCredit').val();
var reconcilereqcode  = $(this).closest('.rowsettlement').children('.fieldsbankreconReq').val();



$.ajax
(
{
url:'update.php',
type:'POST',
data: {newdate:reconciledate,newdes:reconciledes,newdebit:reconciledebit,newreqcode:reconcilereqcode,newcredit:reconcilecredit,name:'addreconcile',acctype:'settlement'},
dataType:'json',

success: function(data)
{

                          

$('#testupdate').append(data);




}



});









       
var notreconciled  = $(this).closest('.rowsettlement').children('.notreconciled').val();
	   
	   if(notreconciled == 1)
	   {
	   
	   
	   
	   //alert("hi this is not reconcile checked");
	    var  datenotreconcilesettlement    = $(this).closest('.rowsettlement').children('.fieldsbankreconDate').val();
        var  desnotreconcilesettlement     = $(this).closest('.rowsettlement').children('.fieldsbankreconDes').val();
        var  debitnotreconcilesettlement   = $(this).closest('.rowsettlement').children('.fieldsbankreconDebit').val();
        var  creditnotreconcilesettlement  = $(this).closest('.rowsettlement').children('.fieldsbankreconCredit').val();
        var reqcodenotreconcilesettlement = $(this).closest('.rowsettlement').children('.fieldsbankreconReq').val();
		 
		 
		 
          
       	   
	     
	   $.ajax(
			{
			url:'notreconcile.php',
			type:'POST',
				data: {datenotreconcileaccount:datenotreconcilesettlement,desnotreconcileaccount:desnotreconcilesettlement,debitnotreconcileaccount:debitnotreconcilesettlement,creditnotreconcileaccount:creditnotreconcilesettlement,reqcodenotreconcileaccount:reqcodenotreconcilesettlement,name:'accountnotreconcileddel',account:'settlement'},
			dataType:'text',
			success: function(data)
			{

		

			$('#testupdate').append(data);




			}


			});
	    
	   }
	   
        










}

}

});


$.ajax(
{
url:'reconcile.php',
type:'POST',
data: {startdate:startdate,enddate:enddate, beginingbal:beginingbal,endingbal:endingbal,clearedbal:clearedbal, difference:difference,name:'accountreconcile',accounttype:'settlement'},
dataType:'json',
success: function(data)
{

                          

$('#testupdate').append(data);




}


});


         

$.ajax(
{
url:'notreconcile.php',
type:'POST',
data: {name:'accountnotreconciledmove',account:'settlement'},
dataType:'json',
success: function(data)
{

                          

$('#testupdate').append(data);




}


});


});





$('#reconcileirn').click(function(){ 
$("#reconcileirn").attr("disabled","disabled");
var startdate  = $('#datepickerbankstart').val();
var enddate = $('#datepickerbankend').val();
//alert ("hi");
alert(" irn  Account, Reconciled" + " \n" + " Saved for the dates  :" + startdate +" & " + enddate + " \n " + " You can click on  Reconciled Data on the top to view this Reconcilation");


var beginingbal = $('#openingbaltextirn').val();
var endingbal = $('#closingbaltextirn').val();
var clearedbal = $('#clearedbaltextirn').val();
var difference = $('#differencebaltextirn').val();








$('.rowirn :checkbox').each(function() {

var $this = $(this);

if ($this.is(':checked')) {

if(!isNaN(this.value) && this.value.length!=0) 
{

var reconciledate  = $(this).closest('.rowirn').children('.fieldsbankreconDate').val();
var reconciledes  = $(this).closest('.rowirn').children('.fieldsbankreconDes').val();
var reconciledebit = $(this).closest('.rowirn').children('.fieldsbankreconDebit').val();
var reconcilecredit = $(this).closest('.rowirn').children('.fieldsbankreconCredit').val();
var reconcilereqcode  = $(this).closest('.rowirn').children('.fieldsbankreconReq').val();



$.ajax
(
{
url:'update.php',
type:'POST',
data: {newdate:reconciledate,newdes:reconciledes,newdebit:reconciledebit,newreqcode:reconcilereqcode,newcredit:reconcilecredit,name:'addreconcile',acctype:'irn'},
dataType:'json',

success: function(data)
{

                          

$('#testupdate').append(data);




}



});









       
var notreconciled  = $(this).closest('.rowirn').children('.notreconciled').val();
	   
	   if(notreconciled == 1)
	   {
	   
	   
	   
	   //alert("hi this is not reconcile checked");
	    var  datenotreconcileirn    = $(this).closest('.rowirn').children('.fieldsbankreconDate').val();
        var  desnotreconcileirn     = $(this).closest('.rowirn').children('.fieldsbankreconDes').val();
        var  debitnotreconcileirn   = $(this).closest('.rowirn').children('.fieldsbankreconDebit').val();
        var  creditnotreconcileirn  = $(this).closest('.rowirn').children('.fieldsbankreconCredit').val();
        var reqcodenotreconcileirn = $(this).closest('.rowirn').children('.fieldsbankreconReq').val();
		 
		 
		 
          
       	   
	     
	   $.ajax(
			{
			url:'notreconcile.php',
			type:'POST',
				data: {datenotreconcileaccount:datenotreconcileirn,desnotreconcileaccount:desnotreconcileirn,debitnotreconcileaccount:debitnotreconcileirn,creditnotreconcileaccount:creditnotreconcileirn,reqcodenotreconcileaccount:reqcodenotreconcileirn,name:'accountnotreconcileddel',account:'irn'},
			dataType:'text',
			success: function(data)
			{

		

			$('#testupdate').append(data);




			}


			});
	    
	   }
	   
        










}

}

});


$.ajax(
{
url:'reconcile.php',
type:'POST',
data: {startdate:startdate,enddate:enddate, beginingbal:beginingbal,endingbal:endingbal,clearedbal:clearedbal, difference:difference,name:'accountreconcile',accounttype:'irn'},
dataType:'json',
success: function(data)
{

                          

$('#testupdate').append(data);




}


});


         

$.ajax(
{
url:'notreconcile.php',
type:'POST',
data: {name:'accountnotreconciledmove', account:'irn'},
dataType:'json',
success: function(data)
{

                          

$('#testupdate').append(data);




}


});


});




$('#reconcilebalanceadjustment').click(function(){ 
$("#reconcilebalanceadjustment").attr("disabled","disabled");
var startdate  = $('#datepickerbankstart').val();
var enddate = $('#datepickerbankend').val();
//alert ("hi");
alert(" balanceadjustment  Account, Reconciled" + " \n" + " Saved for the dates  :" + startdate +" & " + enddate + " \n " + " You can click on  Reconciled Data on the top to view this Reconcilation");


var beginingbal = $('#openingbaltextbalanceadjustment').val();
var endingbal = $('#closingbaltextbalanceadjustment').val();
var clearedbal = $('#clearedbaltextbalanceadjustment').val();
var difference = $('#differencebaltextbalanceadjustment').val();



$.ajax(
{
url:'reconcile.php',
type:'POST',
data: {startdate:startdate,enddate:enddate, beginingbal:beginingbal,endingbal:endingbal,clearedbal:clearedbal, difference:difference,name:'accountreconcile',accounttype:'balanceadjustment'},
dataType:'json',
success: function(data)
{

                          

$('#testupdate').append(data);




}


});




$('.rowbalanceadjustment :checkbox').each(function() {

var $this = $(this);

if ($this.is(':checked')) {

if(!isNaN(this.value) && this.value.length!=0) 
{

var reconciledate  = $(this).closest('.rowbalanceadjustment').children('.fieldsbankreconDate').val();
var reconciledes  = $(this).closest('.rowbalanceadjustment').children('.fieldsbankreconDes').val();
var reconciledebit = $(this).closest('.rowbalanceadjustment').children('.fieldsbankreconDebit').val();
var reconcilecredit = $(this).closest('.rowbalanceadjustment').children('.fieldsbankreconCredit').val();
var reconcilereqcode  = $(this).closest('.rowbalanceadjustment').children('.fieldsbankreconReq').val();



$.ajax
(
{
url:'update.php',
type:'POST',
data: {newdate:reconciledate,newdes:reconciledes,newdebit:reconciledebit,newreqcode:reconcilereqcode,newcredit:reconcilecredit,name:'addreconcile',acctype:'balanceadjustment'},
dataType:'json',

success: function(data)
{

                          

$('#testupdate').append(data);




}



});









       
var notreconciled  = $(this).closest('.rowbalanceadjustment').children('.notreconciled').val();
	   
	   if(notreconciled == 1)
	   {
	   
	   
	   
	   //alert("hi this is not reconcile checked");
	   
	    var  datenotreconcilebalanceadjustment    = $(this).closest('.rowbalanceadjustment').children('.fieldsbankreconDate').val();
        var  desnotreconcilebalanceadjustment     = $(this).closest('.rowbalanceadjustment').children('.fieldsbankreconDes').val();
        var  debitnotreconcilebalanceadjustment   = $(this).closest('.rowbalanceadjustment').children('.fieldsbankreconDebit').val();
        var  creditnotreconcilebalanceadjustment  = $(this).closest('.rowbalanceadjustment').children('.fieldsbankreconCredit').val();
        var reqcodenotreconcilebalanceadjustment = $(this).closest('.rowbalanceadjustment').children('.fieldsbankreconReq').val();
		 
		 alert(reqcodenotreconcilebalanceadjustment);
		 
          
       	   
	     
	   $.ajax(
			{
			url:'notreconcile.php',
			type:'POST',
			data: {datenotreconcileaccount:datenotreconcilebalanceadjustment,desnotreconcileaccount:desnotreconcilebalanceadjustment,debitnotreconcileaccount:debitnotreconcilebalanceadjustment,creditnotreconcileaccount:creditnotreconcilebalanceadjustment,reqcodenotreconcileaccount:reqcodenotreconcilebalanceadjustment,name:'accountnotreconcileddel',account:'balanceadjustment'},
			dataType:'text',
			success: function(data)
			{

		

			$('#testupdate').append(data);




			}


			});
	    
	   }
	   
        










}

}

});





         

$.ajax(
{
url:'notreconcile.php',
type:'POST',
data: {name:'accountnotreconciledmove',account:'balanceadjustment'},
dataType:'json',
success: function(data)
{

                          

$('#testupdate').append(data);




}


});


});






$('#reconcilechargeback').click(function(){ 
$("#reconcilechargeback").attr("disabled","disabled");
var startdate  = $('#datepickerbankstart').val();
var enddate = $('#datepickerbankend').val();
//alert ("hi");
alert(" chargeback  Account, Reconciled" + " \n" + " Saved for the dates  :" + startdate +" & " + enddate + " \n " + " You can click on  Reconciled Data on the top to view this Reconcilation");


var beginingbal = $('#openingbaltextchargeback').val();
var endingbal = $('#closingbaltextchargeback').val();
var clearedbal = $('#clearedbaltextchargeback').val();
var difference = $('#differencebaltextchargeback').val();



$.ajax(
{
url:'reconcile.php',
type:'POST',
data: {startdate:startdate,enddate:enddate, beginingbal:beginingbal,endingbal:endingbal,clearedbal:clearedbal, difference:difference,name:'accountreconcile',accounttype:'chargeback'},
dataType:'json',
success: function(data)
{

                          

$('#testupdate').append(data);




}


});




$('.rowchargeback :checkbox').each(function() {

var $this = $(this);

if ($this.is(':checked')) {

if(!isNaN(this.value) && this.value.length!=0) 
{

var reconciledate  = $(this).closest('.rowchargeback').children('.fieldsbankreconDate').val();
var reconciledes  = $(this).closest('.rowchargeback').children('.fieldsbankreconDes').val();
var reconciledebit = $(this).closest('.rowchargeback').children('.fieldsbankreconDebit').val();
var reconcilecredit = $(this).closest('.rowchargeback').children('.fieldsbankreconCredit').val();
var reconcilereqcode  = $(this).closest('.rowchargeback').children('.fieldsbankreconReq').val();



$.ajax
(
{
url:'update.php',
type:'POST',
data: {newdate:reconciledate,newdes:reconciledes,newdebit:reconciledebit,newreqcode:reconcilereqcode,newcredit:reconcilecredit,name:'addreconcile',acctype:'chargeback'},
dataType:'json',

success: function(data)
{

                          

$('#testupdate').append(data);




}



});









       
var notreconciled  = $(this).closest('.rowchargeback').children('.notreconciled').val();
	   
	   if(notreconciled == 1)
	   {
	   
	   
	   
	   //alert("hi this is not reconcile checked");
	   
	    var  datenotreconcilechargeback    = $(this).closest('.rowchargeback').children('.fieldsbankreconDate').val();
        var  desnotreconcilechargeback     = $(this).closest('.rowchargeback').children('.fieldsbankreconDes').val();
        var  debitnotreconcilechargeback   = $(this).closest('.rowchargeback').children('.fieldsbankreconDebit').val();
        var  creditnotreconcilechargeback  = $(this).closest('.rowchargeback').children('.fieldsbankreconCredit').val();
        var reqcodenotreconcilechargeback = $(this).closest('.rowchargeback').children('.fieldsbankreconReq').val();
		 
		 alert(reqcodenotreconcilechargeback);
		 
          
       	   
	     
	   $.ajax(
			{
			url:'notreconcile.php',
			type:'POST',
			data: {datenotreconcileaccount:datenotreconcilechargeback,desnotreconcileaccount:desnotreconcilechargeback,debitnotreconcileaccount:debitnotreconcilechargeback,creditnotreconcileaccount:creditnotreconcilechargeback,reqcodenotreconcileaccount:reqcodenotreconcilechargeback,name:'accountnotreconcileddel',account:'chargeback'},
			dataType:'text',
			success: function(data)
			{

		

			$('#testupdate').append(data);




			}


			});
	    
	   }
	   
        










}

}

});





         

$.ajax(
{
url:'notreconcile.php',
type:'POST',
data: {name:'accountnotreconciledmove',account:'chargeback'},
dataType:'json',
success: function(data)
{

                          

$('#testupdate').append(data);




}


});


});









$('#savereserve').click(function(){ 

var html = $("#reservediv").html();
 var namefile = $("#datepickerbankend").val();
 var accounttype = 'reserve';
 namefile = namefile + ".html";


$.ajax(
{
url:'filehanding.php',
type:'POST',
data: {filename:namefile,data:html,accounttype:accounttype},
dataType:'text',

success: function(data)
{

$('#history').html(data);



}


});

});


$('#savefunding').click(function(){ 

var html = $("#fundingaccountdiv").html();
 var namefile = $("#datepickerbankend").val();
 var accounttype = 'funding';
 namefile = namefile + ".html";


$.ajax(
{
url:'filehanding.php',
type:'POST',
data: {filename:namefile,data:html,accounttype:accounttype},
dataType:'text',

success: function(data)
{

$('#historyfunding').html(data);



}


});

});




$('#saveincome').click(function(){ 

var html = $("#incomediv").html();
 var namefile = $("#datepickerbankend").val();
 var accounttype = 'income';
 namefile = namefile + ".html";


$.ajax(
{
url:'filehanding.php',
type:'POST',
data: {filename:namefile,data:html,accounttype:accounttype},
dataType:'text',

success: function(data)
{

$('#historyincome').html(data);



}


});

});





$('#savesettlement').click(function(){ 

var html = $("#settlediv").html();
 var namefile = $("#datepickerbankend").val();
 var accounttype = 'settlement';
 namefile = namefile + ".html";


$.ajax(
{
url:'filehanding.php',
type:'POST',
data: {filename:namefile,data:html,accounttype:accounttype},
dataType:'text',

success: function(data)
{

$('#historysettlement').html(data);



}


});

});







$('#savecardholder').click(function(){ 

var html = $("#cardholderdiv").html();
 var namefile = $("#datepickerbankend").val();
 var accounttype = 'cardholder';
 namefile = namefile + ".html";


$.ajax(
{
url:'filehanding.php',
type:'POST',
data: {filename:namefile,data:html,accounttype:accounttype},
dataType:'text',

success: function(data)
{

$('#historycardholder').html(data);



}


});

});






$('#saveirn').click(function(){ 

var html = $("#irndiv").html();
 var namefile = $("#datepickerbankend").val();
 var accounttype = 'irn';
 namefile = namefile + ".html";


$.ajax(
{
url:'filehanding.php',
type:'POST',
data: {filename:namefile,data:html,accounttype:accounttype},
dataType:'text',

success: function(data)
{

$('#historyirn').html(data);



}


});

});







$('#savebalanceadjustment').click(function(){ 

var html = $("#balanceadjustmentdiv").html();
 var namefile = $("#datepickerbankend").val();
 var accounttype = 'balanceadjustment';
 namefile = namefile + ".html";


$.ajax(
{
url:'filehanding.php',
type:'POST',
data: {filename:namefile,data:html,accounttype:accounttype},
dataType:'text',

success: function(data)
{

$('#historybalanceadjustment').html(data);



}


});

});



$('#addrowreserve').click(function(){ 

//$("div.margin div.row").eq(2).after($('<div class="row"> <input class="ckbox" type="checkbox" value="0.01" name="checked" checked="checked">')); 


$('#adddivrowmain').show();


});



$('#cancelreserve').click(function(){ 

//$("div.margin div.row").eq(2).after($('<div class="row"> <input class="ckbox" type="checkbox" value="0.01" name="checked" checked="checked">')); 


$('#adddivrowmain').hide();


});






$('#okreserve').click(function(){ 

//if press ok button a new row will be added into the database 

var nwdate  = $('#newdate').val();
var nwdes   = $('#newdes').val();
var nwdebit = $('#newdebit').val();
var nwcredit = $('#newcredit').val();


$("#accountdetails").attr("disabled","disabled");
$.ajax(
{
url:'update.php',
type:'POST',
data: {newdate:nwdate,newdes:nwdes,newdebit:nwdebit,newcredit:nwcredit,name:'reserve'},
dataType:'json'


});


 backendcall('reserve');
 
$('#adddivrowmain').hide();


});




$('#addrowfunding').click(function(){ 

//$("div.margin div.row").eq(2).after($('<div class="row"> <input class="ckbox" type="checkbox" value="0.01" name="checked" checked="checked">')); 


$('#adddivrowmainfunding').show();


});



$('#cancelfunding').click(function(){ 

//$("div.margin div.row").eq(2).after($('<div class="row"> <input class="ckbox" type="checkbox" value="0.01" name="checked" checked="checked">')); 


$('#adddivrowmainfunding').hide();


});






$('#okfunding').click(function(){ 

//if press ok button a new row will be added into the database 

var nwdate  = $('#newdatefunding').val();
var nwdes   = $('#newdesfunding').val();
var nwdebit = $('#newdebitfunding').val();
var nwcredit = $('#newcreditfunding').val();
var nwreqcode = $('#newreqcodefunding').val();

$("#accountdetails").attr("disabled","disabled");
$.ajax(
{
url:'update.php',
type:'POST',
data: {newdate:nwdate,newdes:nwdes,newdebit:nwdebit,newcredit:nwcredit,newreqcode:nwreqcode,account:'funding',name:'addaccount'},
dataType:'json'


});


$('.rowfunding :checkbox').each(function() {

var $this = $(this);

if ($this.is(':checked')) {

if(!isNaN(this.value) && this.value.length!=0) 
{

 var chekretainfunddate  = $(this).closest('.rowfunding').children('.fieldsbankreconDate').val();
 var chekretainfunddes = $(this).closest('.rowfunding').children('.fieldsbankreconDes').val();
 var chekretainfunddebit = $(this).closest('.rowfunding').children('.fieldsbankreconDebit').val();
 var chekretainfundcredit = $(this).closest('.rowfunding').children('.fieldsbankreconCredit').val();
 var chekretainfundreqcode  = $(this).closest('.rowfunding').children('.fieldsbankreconReq').val();



var status = 'checked';


$.ajax
(
{
url:'update.php',
type:'POST',
data: {name:'checkretain',status:status,chekretainfunddate:chekretainfunddate,chekretainfunddes:chekretainfunddes,chekretainfunddebit:chekretainfunddebit,chekretainfundcredit:chekretainfundcredit,chekretainfundreqcode:chekretainfundreqcode,account:'funding'},
dataType:'json',

success: function(data)
{

                          

$('#testupdate').append(data);




}



});


}

}

});




 backendcall('funding');
 
$('#adddivrowmainfunding').hide();


});







$('#addrowincome').click(function(){ 

//$("div.margin div.row").eq(2).after($('<div class="row"> <input class="ckbox" type="checkbox" value="0.01" name="checked" checked="checked">')); 


$('#adddivrowmainincome').show();


});



$('#cancelincome').click(function(){ 

//$("div.margin div.row").eq(2).after($('<div class="row"> <input class="ckbox" type="checkbox" value="0.01" name="checked" checked="checked">')); 


$('#adddivrowmainincome').hide();


});





$('#okincome').click(function(){ 

//if press ok button a new row will be added into the database 

var nwdate  = $('#newdateincome').val();
var nwdes   = $('#newdesincome').val();
var nwdebit = $('#newdebitincome').val();
var nwcredit = $('#newcreditincome').val();
var nwreqcode = $('#newreqcodeincome').val();

$("#accountdetails").attr("disabled","disabled");
$.ajax(
{
url:'update.php',
type:'POST',
data: {newdate:nwdate,newdes:nwdes,newdebit:nwdebit,newcredit:nwcredit,newreqcode:nwreqcode,account:'income',name:'addaccount'},
dataType:'json'


});


$('.rowincome :checkbox').each(function() {

var $this = $(this);

if ($this.is(':checked')) {

if(!isNaN(this.value) && this.value.length!=0) 
{

 var chekretainfunddate  = $(this).closest('.rowincome').children('.fieldsbankreconDate').val();
 var chekretainfunddes = $(this).closest('.rowincome').children('.fieldsbankreconDes').val();
 var chekretainfunddebit = $(this).closest('.rowincome').children('.fieldsbankreconDebit').val();
 var chekretainfundcredit = $(this).closest('.rowincome').children('.fieldsbankreconCredit').val();
 var chekretainfundreqcode  = $(this).closest('.rowincome').children('.fieldsbankreconReq').val();



var status = 'checked';


$.ajax
(
{
url:'update.php',
type:'POST',
data: {name:'checkretain',status:status,chekretainfunddate:chekretainfunddate,chekretainfunddes:chekretainfunddes,chekretainfunddebit:chekretainfunddebit,chekretainfundcredit:chekretainfundcredit,chekretainfundreqcode:chekretainfundreqcode,account:'income'},
dataType:'json',

success: function(data)
{

                          

$('#testupdate').append(data);




}



});


}

}

});




 backendcall('income');
 
$('#adddivrowmainincome').hide();


});







$('#addrowsettlement').click(function(){ 

//$("div.margin div.row").eq(2).after($('<div class="row"> <input class="ckbox" type="checkbox" value="0.01" name="checked" checked="checked">')); 


$('#adddivrowmainsettlement').show();


});



$('#cancelsettlement').click(function(){ 

//$("div.margin div.row").eq(2).after($('<div class="row"> <input class="ckbox" type="checkbox" value="0.01" name="checked" checked="checked">')); 


$('#adddivrowmainsettlement').hide();


});






$('#oksettlement').click(function(){ 

//if press ok button a new row will be added into the database 

var nwdate  = $('#newdatesettlement').val();
var nwdes   = $('#newdessettlement').val();
var nwdebit = $('#newdebitsettlement').val();
var nwcredit = $('#newcreditsettlement').val();
var nwreqcode = $('#newreqcodesettlement').val();

$("#accountdetails").attr("disabled","disabled");
$.ajax(
{
url:'update.php',
type:'POST',
data: {newdate:nwdate,newdes:nwdes,newdebit:nwdebit,newcredit:nwcredit,newreqcode:nwreqcode,account:'settlement',name:'addaccount'},
dataType:'json'


});


$('.rowsettlement :checkbox').each(function() {

var $this = $(this);

if ($this.is(':checked')) {

if(!isNaN(this.value) && this.value.length!=0) 
{

 var chekretainfunddate  = $(this).closest('.rowsettlement').children('.fieldsbankreconDate').val();
 var chekretainfunddes = $(this).closest('.rowsettlement').children('.fieldsbankreconDes').val();
 var chekretainfunddebit = $(this).closest('.rowsettlement').children('.fieldsbankreconDebit').val();
 var chekretainfundcredit = $(this).closest('.rowsettlement').children('.fieldsbankreconCredit').val();
 var chekretainfundreqcode  = $(this).closest('.rowsettlement').children('.fieldsbankreconReq').val();



var status = 'checked';


$.ajax
(
{
url:'update.php',
type:'POST',
data: {name:'checkretain',status:status,chekretainfunddate:chekretainfunddate,chekretainfunddes:chekretainfunddes,chekretainfunddebit:chekretainfunddebit,chekretainfundcredit:chekretainfundcredit,chekretainfundreqcode:chekretainfundreqcode,account:'settlement'},
dataType:'json',

success: function(data)
{

                          

$('#testupdate').append(data);




}



});


}

}

});




 backendcall('settlement');
 
$('#adddivrowmainsettlement').hide();


});








$('#addrowcardholder').click(function(){ 

//$("div.margin div.row").eq(2).after($('<div class="row"> <input class="ckbox" type="checkbox" value="0.01" name="checked" checked="checked">')); 


$('#adddivrowmaincardholder').show();


});



$('#cancelcardholder').click(function(){ 

//$("div.margin div.row").eq(2).after($('<div class="row"> <input class="ckbox" type="checkbox" value="0.01" name="checked" checked="checked">')); 


$('#adddivrowmaincardholder').hide();


});





$('#okcardholder').click(function(){ 

//if press ok button a new row will be added into the database 

var nwdate  = $('#newdatecardholder').val();
var nwdes   = $('#newdescardholder').val();
var nwdebit = $('#newdebitcardholder').val();
var nwcredit = $('#newcreditcardholder').val();
var nwreqcode = $('#newreqcodecardholder').val();

$("#accountdetails").attr("disabled","disabled");
$.ajax(
{
url:'update.php',
type:'POST',
data: {newdate:nwdate,newdes:nwdes,newdebit:nwdebit,newcredit:nwcredit,newreqcode:nwreqcode,account:'cardholder',name:'addaccount'},
dataType:'json'


});


$('.rowcardholder :checkbox').each(function() {

var $this = $(this);

if ($this.is(':checked')) {

if(!isNaN(this.value) && this.value.length!=0) 
{

 var chekretainfunddate  = $(this).closest('.rowcardholder').children('.fieldsbankreconDate').val();
 var chekretainfunddes = $(this).closest('.rowcardholder').children('.fieldsbankreconDes').val();
 var chekretainfunddebit = $(this).closest('.rowcardholder').children('.fieldsbankreconDebit').val();
 var chekretainfundcredit = $(this).closest('.rowcardholder').children('.fieldsbankreconCredit').val();
 var chekretainfundreqcode  = $(this).closest('.rowcardholder').children('.fieldsbankreconReq').val();



var status = 'checked';


$.ajax
(
{
url:'update.php',
type:'POST',
data: {name:'checkretain',status:status,chekretainfunddate:chekretainfunddate,chekretainfunddes:chekretainfunddes,chekretainfunddebit:chekretainfunddebit,chekretainfundcredit:chekretainfundcredit,chekretainfundreqcode:chekretainfundreqcode,account:'cardholder'},
dataType:'json',

success: function(data)
{

                          

$('#testupdate').append(data);




}



});


}

}

});




 backendcall('cardholder');
 
$('#adddivrowmaincardholder').hide();


});








$('#addrowirn').click(function(){ 

//$("div.margin div.row").eq(2).after($('<div class="row"> <input class="ckbox" type="checkbox" value="0.01" name="checked" checked="checked">')); 


$('#adddivrowmainirn').show();


});



$('#cancelirn').click(function(){ 

//$("div.margin div.row").eq(2).after($('<div class="row"> <input class="ckbox" type="checkbox" value="0.01" name="checked" checked="checked">')); 


$('#adddivrowmainirn').hide();


});




$('#okirn').click(function(){ 

//if press ok button a new row will be added into the database 

var nwdate  = $('#newdateirn').val();
var nwdes   = $('#newdesirn').val();
var nwdebit = $('#newdebitirn').val();
var nwcredit = $('#newcreditirn').val();
var nwreqcode = $('#newreqcodeirn').val();

$("#accountdetails").attr("disabled","disabled");
$.ajax(
{
url:'update.php',
type:'POST',
data: {newdate:nwdate,newdes:nwdes,newdebit:nwdebit,newcredit:nwcredit,newreqcode:nwreqcode,account:'irn',name:'addaccount'},
dataType:'json'


});


$('.rowirn :checkbox').each(function() {

var $this = $(this);

if ($this.is(':checked')) {

if(!isNaN(this.value) && this.value.length!=0) 
{

 var chekretainfunddate  = $(this).closest('.rowirn').children('.fieldsbankreconDate').val();
 var chekretainfunddes = $(this).closest('.rowirn').children('.fieldsbankreconDes').val();
 var chekretainfunddebit = $(this).closest('.rowirn').children('.fieldsbankreconDebit').val();
 var chekretainfundcredit = $(this).closest('.rowirn').children('.fieldsbankreconCredit').val();
 var chekretainfundreqcode  = $(this).closest('.rowirn').children('.fieldsbankreconReq').val();



var status = 'checked';


$.ajax
(
{
url:'update.php',
type:'POST',
data: {name:'checkretain',status:status,chekretainfunddate:chekretainfunddate,chekretainfunddes:chekretainfunddes,chekretainfunddebit:chekretainfunddebit,chekretainfundcredit:chekretainfundcredit,chekretainfundreqcode:chekretainfundreqcode,account:'irn'},
dataType:'json',

success: function(data)
{

                          

$('#testupdate').append(data);




}



});


}

}

});




 backendcall('irn');
 
$('#adddivrowmainirn').hide();


});









$('#addrowbalanceadjustment').click(function(){ 

//$("div.margin div.row").eq(2).after($('<div class="row"> <input class="ckbox" type="checkbox" value="0.01" name="checked" checked="checked">')); 


$('#adddivrowmainbalanceadjustment').show();


});



$('#cancelbalanceadjustment').click(function(){ 

//$("div.margin div.row").eq(2).after($('<div class="row"> <input class="ckbox" type="checkbox" value="0.01" name="checked" checked="checked">')); 


$('#adddivrowmainbalanceadjustment').hide();


});




$('#okbalanceadjustment').click(function(){ 

//if press ok button a new row will be added into the database 

var nwdate  = $('#newdatebalanceadjustment').val();
var nwdes   = $('#newdesbalanceadjustment').val();
var nwdebit = $('#newdebitbalanceadjustment').val();
var nwcredit = $('#newcreditbalanceadjustment').val();
var nwreqcode = $('#newreqcodebalanceadjustment').val();

$("#accountdetails").attr("disabled","disabled");
$.ajax(
{
url:'update.php',
type:'POST',
data: {newdate:nwdate,newdes:nwdes,newdebit:nwdebit,newcredit:nwcredit,newreqcode:nwreqcode,account:'balanceadjustment',name:'addaccount'},
dataType:'json'


});


$('.rowbalanceadjustment :checkbox').each(function() {

var $this = $(this);

if ($this.is(':checked')) {

if(!isNaN(this.value) && this.value.length!=0) 
{

 var chekretainfunddate  = $(this).closest('.rowbalanceadjustment').children('.fieldsbankreconDate').val();
 var chekretainfunddes = $(this).closest('.rowbalanceadjustment').children('.fieldsbankreconDes').val();
 var chekretainfunddebit = $(this).closest('.rowbalanceadjustment').children('.fieldsbankreconDebit').val();
 var chekretainfundcredit = $(this).closest('.rowbalanceadjustment').children('.fieldsbankreconCredit').val();
 var chekretainfundreqcode  = $(this).closest('.rowbalanceadjustment').children('.fieldsbankreconReq').val();



var status = 'checked';


$.ajax
(
{
url:'update.php',
type:'POST',
data: {name:'checkretain',status:status,chekretainfunddate:chekretainfunddate,chekretainfunddes:chekretainfunddes,chekretainfunddebit:chekretainfunddebit,chekretainfundcredit:chekretainfundcredit,chekretainfundreqcode:chekretainfundreqcode,account:'balanceadjustment'},
dataType:'json',

success: function(data)
{

                          

$('#testupdate').append(data);




}



});


}

}

});




 backendcall('balanceadjustment');
 
$('#adddivrowmainbalanceadjustment').hide();


});









$('#addrowchargeback').click(function(){ 

//$("div.margin div.row").eq(2).after($('<div class="row"> <input class="ckbox" type="checkbox" value="0.01" name="checked" checked="checked">')); 


$('#adddivrowmainchargeback').show();


});



$('#cancelchargeback').click(function(){ 

//$("div.margin div.row").eq(2).after($('<div class="row"> <input class="ckbox" type="checkbox" value="0.01" name="checked" checked="checked">')); 


$('#adddivrowmainchargeback').hide();


});





$('#okchargeback').click(function(){ 

//if press ok button a new row will be added into the database 

var nwdate  = $('#newdatechargeback').val();
var nwdes   = $('#newdeschargeback').val();
var nwdebit = $('#newdebitchargeback').val();
var nwcredit = $('#newcreditchargeback').val();
var nwreqcode = $('#newreqcodechargeback').val();

$("#accountdetails").attr("disabled","disabled");
$.ajax(
{
url:'update.php',
type:'POST',
data: {newdate:nwdate,newdes:nwdes,newdebit:nwdebit,newcredit:nwcredit,newreqcode:nwreqcode,account:'chargeback',name:'addaccount'},
dataType:'json'


});


$('.rowchargeback :checkbox').each(function() {

var $this = $(this);

if ($this.is(':checked')) {

if(!isNaN(this.value) && this.value.length!=0) 
{

 var chekretainfunddate  = $(this).closest('.rowchargeback').children('.fieldsbankreconDate').val();
 var chekretainfunddes = $(this).closest('.rowchargeback').children('.fieldsbankreconDes').val();
 var chekretainfunddebit = $(this).closest('.rowchargeback').children('.fieldsbankreconDebit').val();
 var chekretainfundcredit = $(this).closest('.rowchargeback').children('.fieldsbankreconCredit').val();
 var chekretainfundreqcode  = $(this).closest('.rowchargeback').children('.fieldsbankreconReq').val();



var status = 'checked';


$.ajax
(
{
url:'update.php',
type:'POST',
data: {name:'checkretain',status:status,chekretainfunddate:chekretainfunddate,chekretainfunddes:chekretainfunddes,chekretainfunddebit:chekretainfunddebit,chekretainfundcredit:chekretainfundcredit,chekretainfundreqcode:chekretainfundreqcode,account:'chargeback'},
dataType:'json',

success: function(data)
{

                          

$('#testupdate').append(data);




}



});


}

}

});




 backendcall('chargeback');
 
$('#adddivrowmainchargeback').hide();


});




$('#reserveundo').click(function(){ 


$("#accountdetails").attr("disabled","disabled");
$.ajax(
{
url:'update.php',
type:'POST',
data: {name:'reserveundo'},
dataType:'json'


});


 backendcall('reserve');

});




$('#fundingundo').click(function(){ 


$("#accountdetails").attr("disabled","disabled");
$.ajax(
{
url:'update.php',
type:'POST',
data: {name:'fundingundo'},
dataType:'json'


});

 backendcall('funding');

});



$('#incomeundo').click(function(){ 


$("#accountdetails").attr("disabled","disabled");
$.ajax(
{
url:'update.php',
type:'POST',
data: {name:'incomeundo'},
dataType:'json'


});


 backendcall('income');

});





$('#settlementundo').click(function(){ 


$("#accountdetails").attr("disabled","disabled");
$.ajax(
{
url:'update.php',
type:'POST',
data: {name:'settlementundo'},
dataType:'json'


});


 backendcall('settlement');

});





$('#cardholderundo').click(function(){ 


$("#accountdetails").attr("disabled","disabled");
$.ajax(
{
url:'update.php',
type:'POST',
data: {name:'cardholderundo'},
dataType:'json'


});


 backendcall('cardholder');

});






$('#irnundo').click(function(){ 


$("#accountdetails").attr("disabled","disabled");
$.ajax(
{
url:'update.php',
type:'POST',
data: {name:'irnundo'},
dataType:'json'


});


 backendcall('irn');

});






$('#balanceadjustmentundo').click(function(){ 


$("#accountdetails").attr("disabled","disabled");
$.ajax(
{
url:'update.php',
type:'POST',
data: {name:'balanceadjustmentundo'},
dataType:'json'


});


 backendcall('balanceadjustment');

});






$('#chargebackundo').click(function(){ 


$("#accountdetails").attr("disabled","disabled");
$.ajax(
{
url:'update.php',
type:'POST',
data: {name:'chargebackundo'},
dataType:'json'


});


 backendcall('chargeback');

});




var nwdateglobal = '';
var nwdesglobal = '';
var nwdebitglobal = '';
var nwcreditglobal = '';


//above lines are to make global variable to capture original values from the changed div

$('.chngreserve').live("click", function(){ 

// This is to capture original values from the changing div


 nwdateglobal  = $(this).closest('.rowreserve').children('.fieldsbankreconDate').val();
 nwdesglobal  = $(this).closest('.rowreserve').children('.fieldsbankreconDes').val();
 nwdebitglobal = $(this).closest('.rowreserve').children('.fieldsbankreconDebit').val();
 nwcreditglobal = $(this).closest('.rowreserve').children('.fieldsbankreconCredit').val();
 
 nwdebitglobal = nwdebitglobal.substring(1);
 nwcreditglobal = nwcreditglobal.substring(1);
 
 //alert(nwcreditglobal);
 //alert(nwdebitglobal);
 
var thisrow = $(this);
dialogupdate('reserve',thisrow);

/*alert("This will change the database");

$(this).closest('.rowreserve').children('.chngreserve').hide();
$(this).closest('.rowreserve').children('.confirmreserve').show(); */





});



$('.confirmreserve').live("click", function(){ 

//This is capture new values from the div to be changed and to make a server side call with both global values ( original values ) and with the new values 

var nwdate = $(this).closest('.rowreserve').children('.fieldsbankreconDate').val();
var nwdes  = $(this).closest('.rowreserve').children('.fieldsbankreconDes').val();
var nwdebit = $(this).closest('.rowreserve').children('.fieldsbankreconDebit').val();
var nwcredit= $(this).closest('.rowreserve').children('.fieldsbankreconCredit').val();


alert("Are you sure to change the database");



$.ajax(
{
url:'update.php',
type:'POST',
data: {newdate:nwdate,newdes:nwdes, newdebit:nwdebit,newcredit:nwcredit,name:'change', olddate:nwdateglobal, olddes:nwdesglobal, olddebit:nwdebitglobal, oldcredit:nwcreditglobal},
dataType:'json',
success: function(data)
{

                          

$('#testupdate').append(data);




}


});




backendcall('reserve');








});


//-------------------------------------------------------------below is for update and confirm , yes or no dialog boxes and checkboxes restores----------------------------------------------------

function dialogupdate(account,thisrow)
{

$( "#dialog-confirm" ).dialog({
        resizable: false,
        height:140,
        modal: true,
        buttons: {
            Yes: function() {
                
				thisrow.closest('.row'+account).children('.chng'+account).hide();
                thisrow.closest('.row'+account).children('.confirm'+account).show();
                $( this ).dialog( "close" );
            },
            No: function() {
                $( this ).dialog( "close" );
            }
        }
    });








}








function dialogconfirm(account,thisrow)
{

$( "#dialog-confirm" ).dialog({
        resizable: false,
        height:140,
        modal: true,
        buttons: {
            Yes: function() {
                
				accountconfirm(account,thisrow);
				$( this ).dialog( "close" );
                
            },
            No: function() {
			    thisrow.closest('.row'+account).children('.chng'+account).show();
                thisrow.closest('.row'+account).children('.confirm'+account).hide();
                $( this ).dialog( "close" );
				backendcall(account);
            }
        }
    });








}





 nwdateglobalfunding = '';
 nwdesglobalfunding = '';
 nwdebitglobalfunding = '';
 nwcreditglobalfunding = '';
 nwreqcodeglobalfunding = '';


//above lines are to make global variable to capture original values from the changed div

$('.chngfunding').live("click", function(){ 

// This is to capture original values from the changing div


 nwdateglobalfunding  = $(this).closest('.rowfunding').children('.fieldsbankreconDate').val();
 nwdesglobalfunding  = $(this).closest('.rowfunding').children('.fieldsbankreconDes').val();
 nwdebitglobalfunding = $(this).closest('.rowfunding').children('.fieldsbankreconDebit').val();
 nwcreditglobalfunding = $(this).closest('.rowfunding').children('.fieldsbankreconCredit').val();
 nwreqcodeglobalfunding  = $(this).closest('.rowfunding').children('.fieldsbankreconReq').val();
 nwdebitglobalfunding = nwdebitglobalfunding.substring(1);
 nwcreditglobalfunding = nwcreditglobalfunding.substring(1);
 var thisrow = $(this);
 
 dialogupdate('funding',thisrow);








});



$('.confirmfunding').live("click", function(){ 

//This is capture new values from the div to be changed and to make a server side call with both global values ( original values ) and with the new values 


var thisrow = $(this); 
account = 'funding';


dialogconfirm('funding',thisrow);





});


function accountconfirm(account,thisrow)
{




//This is capture new values from the div to be changed and to make a server side call with both global values ( original values ) and with the new values 

var nwdate = thisrow.closest('.row'+account).children('.fieldsbankreconDate').val();
var nwdes  = thisrow.closest('.row'+account).children('.fieldsbankreconDes').val();
var nwdebit = thisrow.closest('.row'+account).children('.fieldsbankreconDebit').val();
var nwcredit= thisrow.closest('.row'+account).children('.fieldsbankreconCredit').val();
var nwreqcode = thisrow.closest('.row'+account).children('.fieldsbankreconReq').val();



var notreconciled  = thisrow.closest('.row'+account).children('.notreconciled').val();

if (notreconciled == 1)
{

var tabletype = 'accountchangenot';

}

else 

{


var tabletype = 'accountchange';


}






$.ajax(
{
url:'update.php',
type:'POST',
data: {newdate:nwdate,newdes:nwdes, newdebit:nwdebit,newcredit:nwcredit,newreqcode:nwreqcode,name:tabletype, olddate:eval("nwdateglobal"+account), olddes:eval("nwdesglobal"+account), olddebit:eval("nwdebitglobal"+account), oldcredit:eval("nwcreditglobal"+account),oldreqcode:eval("nwreqcodeglobal"+account),accounttype:account},
dataType:'json',
success: function(data)
{

                          

$('#testupdate').append(data);




}


});


$('.row'+account+' :checkbox').each(function() {

var $this = $(this);


if ($this.is(':checked')) {

if(!isNaN(this.value) && this.value.length!=0) 
{
  //alert("I am in checked section");
 var chekretainfunddate  = $(this).closest('.row'+account).children('.fieldsbankreconDate').val();
 var chekretainfunddes =  $(this).closest('.row'+account).children('.fieldsbankreconDes').val();
 var chekretainfunddebit = $(this).closest('.row'+account).children('.fieldsbankreconDebit').val();
 var chekretainfundcredit = $(this).closest('.row'+account).children('.fieldsbankreconCredit').val();
 var chekretainfundreqcode  = $(this).closest('.row'+account).children('.fieldsbankreconReq').val();
 //alert(chekretainfundreqcode);


var status = 'checked';


$.ajax
(
{
url:'update.php',
type:'POST',
data: {name:'checkretain',status:status,chekretainfunddate:chekretainfunddate,chekretainfunddes:chekretainfunddes,chekretainfunddebit:chekretainfunddebit,chekretainfundcredit:chekretainfundcredit,chekretainfundreqcode:chekretainfundreqcode,account:account},
dataType:'json',

success: function(data)
{

                          

$('#testupdate').append(data);




}



});


}

}

});


// the above ajax call is to retain the checkboxes checked status in the funding account. call is made to insert the data stsus and serial number into table

backendcall(account);






}









$('#ckrestorefunding').click(function()


{

checkboxstatusupdate('funding');

});


function checkboxstatusupdate(account)
{
$('.row'+account+' :checkbox').each(function() {


var chekretainfund  = $(this).closest('.row'+account).children('.checkboxretain'+account).val();

if(chekretainfund == 'checked')
{
        $(this).closest('.row'+account).children('.ckbox'+account).prop("checked", true);	
        $(this).closest('.row'+account).children('.fieldsbankreconDate').css("background","#A9BCF5"); 		
		$(this).closest('.row'+account).children('.fieldsbankreconDes').css("background","#A9BCF5");		
		$(this).closest('.row'+account).children('.fieldsbankreconReq').css("background","#A9BCF5"); 		
		$(this).closest('.row'+account).children('.fieldsbankreconDebit').css("background","#A9BCF5");
		$(this).closest('.row'+account).children('.fieldsbankreconCredit').css("background","#A9BCF5");
		$(this).closest('.row'+account).children('.fieldsbankrecon').css("background","#A9BCF5");




}

});





}








var nwdateglobalincome = '';
var nwdesglobalincome = '';
var nwdebitglobalincome = '';
var nwcreditglobalincome = '';
var nwreqcodeglobalincome = '';


//above lines are to make global variable to capture original values from the changed div

$('.chngincome').live("click", function(){ 

// This is to capture original values from the changing div


 nwdateglobalincome  = $(this).closest('.rowincome').children('.fieldsbankreconDate').val();
 nwdesglobalincome  = $(this).closest('.rowincome').children('.fieldsbankreconDes').val();
 nwdebitglobalincome = $(this).closest('.rowincome').children('.fieldsbankreconDebit').val();
 nwcreditglobalincome = $(this).closest('.rowincome').children('.fieldsbankreconCredit').val();
 nwreqcodeglobalincome  = $(this).closest('.rowincome').children('.fieldsbankreconReq').val();
 nwdebitglobalincome = nwdebitglobalincome.substring(1);
 nwcreditglobalincome = nwcreditglobalincome.substring(1);
 
 //alert(nwcreditglobal);
 //alert(nwdebitglobal);
var thisrow = $(this);
dialogupdate('income',thisrow);

/*alert("This will change the database");

$(this).closest('.rowincome').children('.chngincome').hide();
$(this).closest('.rowincome').children('.confirmincome').show(); */





});



$('.confirmincome').live("click", function(){ 

//This is capture new values from the div to be changed and to make a server side call with both global values ( original values ) and with the new values 


var thisrow = $(this); 



dialogconfirm('income',thisrow);





});


$('#ckrestoreincome').click(function()


{

checkboxstatusupdate('income');

});














var nwdateglobalsettlement = '';
var nwdesglobalsettlement = '';
var nwdebitglobalsettlement = '';
var nwcreditglobalsettlement = '';
var nwreqcodeglobalsettlement = '';


//above lines are to make global variable to capture original values from the changed div

$('.chngsettlement').live("click", function(){ 

// This is to capture original values from the changing div


 nwdateglobalsettlement  = $(this).closest('.rowsettlement').children('.fieldsbankreconDate').val();
 nwdesglobalsettlement  = $(this).closest('.rowsettlement').children('.fieldsbankreconDes').val();
 nwdebitglobalsettlement = $(this).closest('.rowsettlement').children('.fieldsbankreconDebit').val();
 nwcreditglobalsettlement = $(this).closest('.rowsettlement').children('.fieldsbankreconCredit').val();
 nwreqcodeglobalsettlement  = $(this).closest('.rowsettlement').children('.fieldsbankreconReq').val();
 nwdebitglobalsettlement = nwdebitglobalsettlement.substring(1);
 nwcreditglobalsettlement = nwcreditglobalsettlement.substring(1);
 
 //alert(nwcreditglobal);
 //alert(nwdebitglobal);
 

var thisrow = $(this);
dialogupdate('settlement',thisrow);

/*
alert("This will change the database");

$(this).closest('.rowsettlement').children('.chngsettlement').hide();
$(this).closest('.rowsettlement').children('.confirmsettlement').show(); */





});



$('.confirmsettlement').live("click", function(){ 

//This is capture new values from the div to be changed and to make a server side call with both global values ( original values ) and with the new values 


var thisrow = $(this); 



dialogconfirm('settlement',thisrow);





});


$('#ckrestoresettlement').click(function()


{

checkboxstatusupdate('settlement');

});









 nwdateglobalcardholder = '';
 nwdesglobalcardholder = '';
 nwdebitglobalcardholder = '';
 nwcreditglobalcardholder = '';
 nwreqcodeglobalcardholder = '';


//above lines are to make global variable to capture original values from the changed div

$('.chngcardholder').live("click", function(){ 

// This is to capture original values from the changing div


 nwdateglobalcardholder  = $(this).closest('.rowcardholder').children('.fieldsbankreconDate').val();
 nwdesglobalcardholder  = $(this).closest('.rowcardholder').children('.fieldsbankreconDes').val();
 nwdebitglobalcardholder = $(this).closest('.rowcardholder').children('.fieldsbankreconDebit').val();
 nwcreditglobalcardholder = $(this).closest('.rowcardholder').children('.fieldsbankreconCredit').val();
 nwreqcodeglobalcardholder  = $(this).closest('.rowcardholder').children('.fieldsbankreconReq').val();
 nwdebitglobalcardholder = nwdebitglobalcardholder.substring(1);
 nwcreditglobalcardholder = nwcreditglobalcardholder.substring(1);
 
 //alert(nwcreditglobal);
 //alert(nwdebitglobal);
 
var thisrow = $(this);
dialogupdate('cardholder',thisrow);

/*alert("This will change the database");

$(this).closest('.rowcardholder').children('.chngcardholder').hide();
$(this).closest('.rowcardholder').children('.confirmcardholder').show(); */





});



$('.confirmcardholder').live("click", function(){ 

//This is capture new values from the div to be changed and to make a server side call with both global values ( original values ) and with the new values 


var thisrow = $(this); 



dialogconfirm('cardholder',thisrow);





});


$('#ckrestorecardholder').click(function()


{

checkboxstatusupdate('cardholder');

});








 nwdateglobalirn = '';
 nwdesglobalirn = '';
 nwdebitglobalirn = '';
 nwcreditglobalirn = '';
 nwreqcodeglobalirn = '';


//above lines are to make global variable to capture original values from the changed div

$('.chngirn').live("click", function(){ 

// This is to capture original values from the changing div


 nwdateglobalirn  = $(this).closest('.rowirn').children('.fieldsbankreconDate').val();
 nwdesglobalirn  = $(this).closest('.rowirn').children('.fieldsbankreconDes').val();
 nwdebitglobalirn = $(this).closest('.rowirn').children('.fieldsbankreconDebit').val();
 nwcreditglobalirn = $(this).closest('.rowirn').children('.fieldsbankreconCredit').val();
 nwreqcodeglobalirn  = $(this).closest('.rowirn').children('.fieldsbankreconReq').val();
 nwdebitglobalirn = nwdebitglobalirn.substring(1);
 nwcreditglobalirn = nwcreditglobalirn.substring(1);
 
 //alert(nwcreditglobal);
 //alert(nwdebitglobal);
 
var thisrow = $(this);
dialogupdate('irn',thisrow);

/*alert("This will change the database");

$(this).closest('.rowirn').children('.chngirn').hide();
$(this).closest('.rowirn').children('.confirmirn').show(); */





});



$('.confirmirn').live("click", function(){ 

//This is capture new values from the div to be changed and to make a server side call with both global values ( original values ) and with the new values 


var thisrow = $(this); 



dialogconfirm('irn',thisrow);





});


$('#ckrestoreirn').click(function()


{

checkboxstatusupdate('irn');

});





 nwdateglobalchargeback = '';
 nwdesglobalchargeback = '';
 nwdebitglobalchargeback = '';
 nwcreditglobalchargeback = '';
 nwreqcodeglobalchargeback = '';


//above lines are to make global variable to capture original values from the changed div

$('.chngchargeback').live("click", function(){ 

// This is to capture original values from the changing div


 nwdateglobalchargeback  = $(this).closest('.rowchargeback').children('.fieldsbankreconDate').val();
 nwdesglobalchargeback  = $(this).closest('.rowchargeback').children('.fieldsbankreconDes').val();
 nwdebitglobalchargeback = $(this).closest('.rowchargeback').children('.fieldsbankreconDebit').val();
 nwcreditglobalchargeback = $(this).closest('.rowchargeback').children('.fieldsbankreconCredit').val();
 nwreqcodeglobalchargeback  = $(this).closest('.rowchargeback').children('.fieldsbankreconReq').val();
 nwdebitglobalchargeback = nwdebitglobalchargeback.substring(1);
 nwcreditglobalchargeback = nwcreditglobalchargeback.substring(1);
 
 //alert(nwcreditglobal);
 //alert(nwdebitglobal);
 
var thisrow = $(this);
dialogupdate('chargeback',thisrow);

/*alert("This will change the database");

$(this).closest('.rowchargeback').children('.chngchargeback').hide();
$(this).closest('.rowchargeback').children('.confirmchargeback').show(); */





});



$('.confirmchargeback').live("click", function(){ 

//This is capture new values from the div to be changed and to make a server side call with both global values ( original values ) and with the new values 


var thisrow = $(this); 



dialogconfirm('chargeback',thisrow);





});


$('#ckrestorechargeback').click(function()


{

checkboxstatusupdate('chargeback');

});








var nwdateglobalbalanceadjustment = '';
var nwdesglobalbalanceadjustment = '';
var nwdebitglobalbalanceadjustment = '';
var nwcreditglobalbalanceadjustment = '';
var nwreqcodeglobalbalanceadjustment = '';


//above lines are to make global variable to capture original values from the changed div

$('.chngbalanceadjustment').live("click", function(){ 

// This is to capture original values from the changing div


 nwdateglobalbalanceadjustment  = $(this).closest('.rowbalanceadjustment').children('.fieldsbankreconDate').val();
 nwdesglobalbalanceadjustment  = $(this).closest('.rowbalanceadjustment').children('.fieldsbankreconDes').val();
 nwdebitglobalbalanceadjustment = $(this).closest('.rowbalanceadjustment').children('.fieldsbankreconDebit').val();
 nwcreditglobalbalanceadjustment = $(this).closest('.rowbalanceadjustment').children('.fieldsbankreconCredit').val();
 nwreqcodeglobalbalanceadjustment  = $(this).closest('.rowbalanceadjustment').children('.fieldsbankreconReq').val();
 nwdebitglobalbalanceadjustment = nwdebitglobalbalanceadjustment.substring(1);
 nwcreditglobalbalanceadjustment = nwcreditglobalbalanceadjustment.substring(1);
 
 //alert(nwcreditglobal);
 //alert(nwdebitglobal);
 
var thisrow = $(this);
dialogupdate('balanceadjustment',thisrow);

/*alert("This will change the database");

$(this).closest('.rowbalanceadjustment').children('.chngbalanceadjustment').hide();
$(this).closest('.rowbalanceadjustment').children('.confirmbalanceadjustment').show(); */





});



$('.confirmbalanceadjustment').live("click", function(){ 

//This is capture new values from the div to be changed and to make a server side call with both global values ( original values ) and with the new values 


var thisrow = $(this); 



dialogconfirm('balanceadjustment',thisrow);





});


$('#ckrestorebalanceadjustment').click(function()


{

checkboxstatusupdate('balanceadjustment');

});



function subtotalcheckbox(date)
{





}



function subtotalcheckbox(account,classvariable)
{



 $('.'+classvariable).each(function() {
		// alert("hi");
		$(this).closest('.row'+account).children('.ckbox'+account).prop("checked", true);
		$(this).closest('.row'+account).children('.fieldsbankreconDate').css("background","#A9BCF5"); 		
		$(this).closest('.row'+account).children('.fieldsbankreconDes').css("background","#A9BCF5");		
		$(this).closest('.row'+account).children('.fieldsbankreconReq').css("background","#A9BCF5"); 		
		$(this).closest('.row'+account).children('.fieldsbankreconDebit').css("background","#A9BCF5");
		$(this).closest('.row'+account).children('.fieldsbankreconCredit').css("background","#A9BCF5");
		$(this).closest('.row'+account).children('.fieldsbankrecon').css("background","#A9BCF5");
		
		
		});






}




function subtotalcheckboxuncheck(account,classvariable)
{



 $('.'+classvariable).each(function() {
		// alert("hi");
		$(this).closest('.row'+account).children('.ckbox'+account).prop("checked", false);
		$(this).closest('.row'+account).children('.fieldsbankreconDate').css("background","#FFFFFF"); 		
		$(this).closest('.row'+account).children('.fieldsbankreconDes').css("background","#FFFFFF");		
		$(this).closest('.row'+account).children('.fieldsbankreconReq').css("background","#FFFFFF"); 		
		$(this).closest('.row'+account).children('.fieldsbankreconDebit').css("background","#FFFFFF");
		$(this).closest('.row'+account).children('.fieldsbankreconCredit').css("background","#FFFFFF");
		$(this).closest('.row'+account).children('.fieldsbankrecon').css("background","#FFFFFF");
		
		
		});






}




$(':checkbox').live("click", function(){ 

//This is capture new values from the div to be changed and to make a server side call with both global values ( original values ) and with the new values 

var $this = $(this);


var classsubtotal = $(this).closest('.rowckboxincome').children('.ckboxsubtotalincome').val();

		// $this will contain a reference to the checkbox
        //this is to change the background color of the div with checkboxes checked		
		if ($this.is(':checked')) {		







subtotalcheckbox('income',classsubtotal);
}





		else
		{
		
		subtotalcheckboxuncheck('income',classsubtotal)
		
		
		}
		
       
		
		
       


}); 






$('.:checkbox').live("click", function(){ 

//This is capture new values from the div to be changed and to make a server side call with both global values ( original values ) and with the new values 


var $this = $(this);

var classsubtotal = $(this).closest('.rowckboxcardholder').children('.ckboxsubtotalcardholder').val();
		// $this will contain a reference to the checkbox
        //this is to change the background color of the div with checkboxes checked		
	if ($this.is(':checked')) {				







subtotalcheckbox('cardholder',classsubtotal);
}
       
		
		else
		{
		
		subtotalcheckboxuncheck('cardholder',classsubtotal)
		
		
		}
		
       


}); 





$('.:checkbox').live("click", function(){ 

//This is capture new values from the div to be changed and to make a server side call with both global values ( original values ) and with the new values 

var $this = $(this);

		// $this will contain a reference to the checkbox
        //this is to change the background color of the div with checkboxes checked		
		if ($this.is(':checked')) {		




var classsubtotal = $(this).closest('.rowckboxfunding').children('.ckboxsubtotalfunding').val();


subtotalcheckbox('funding',classsubtotal);
       
		
		}
		
		
		
		else
		{
		
		subtotalcheckboxuncheck('funding',classsubtotal)
		
		
		}
       


}); 




$('.:checkbox').live("click", function(){ 

//This is capture new values from the div to be changed and to make a server side call with both global values ( original values ) and with the new values 

var $this = $(this);

		// $this will contain a reference to the checkbox
        //this is to change the background color of the div with checkboxes checked		
		if ($this.is(':checked')) {		




var classsubtotal = $(this).closest('.rowckboxsettlement').children('.ckboxsubtotalsettlement').val();


subtotalcheckbox('settlement',classsubtotal);
       
		
		}
		
		
		
		else
		{
		
		subtotalcheckboxuncheck('settlement',classsubtotal)
		
		
		}
       


}); 







$('.:checkbox').live("click", function(){ 

//This is capture new values from the div to be changed and to make a server side call with both global values ( original values ) and with the new values 

var $this = $(this);

		// $this will contain a reference to the checkbox
        //this is to change the background color of the div with checkboxes checked		
		if ($this.is(':checked')) {		




var classsubtotal = $(this).closest('.rowckboxirn').children('.ckboxsubtotalirn').val();


subtotalcheckbox('irn',classsubtotal);
       
		
		}
		
		
		
		else
		{
		
		subtotalcheckboxuncheck('irn',classsubtotal)
		
		
		}
       


}); 






$('.:checkbox').live("click", function(){ 

//This is capture new values from the div to be changed and to make a server side call with both global values ( original values ) and with the new values 

var $this = $(this);

		// $this will contain a reference to the checkbox
        //this is to change the background color of the div with checkboxes checked		
		if ($this.is(':checked')) {		




var classsubtotal = $(this).closest('.rowckboxbalanceadjustment').children('.ckboxsubtotalbalanceadjustment').val();


subtotalcheckbox('balanceadjustment',classsubtotal);
       
		
		}
		
		
		
		else
		{
		
		subtotalcheckboxuncheck('balanceadjustment',classsubtotal)
		
		
		}
       


}); 




$('.:checkbox').live("click", function(){ 

//This is capture new values from the div to be changed and to make a server side call with both global values ( original values ) and with the new values 

var $this = $(this);

		// $this will contain a reference to the checkbox
        //this is to change the background color of the div with checkboxes checked		
		if ($this.is(':checked')) {		




var classsubtotal = $(this).closest('.rowckboxchargeback').children('.ckboxsubtotalchargeback').val();


subtotalcheckbox('chargeback',classsubtotal);
       
		
		}
		
		
		
		else
		{
		
		subtotalcheckboxuncheck('chargeback',classsubtotal)
		
		
		}
       


}); 




$('.:checkbox').live("click", function(){ 

//This is capture new values from the div to be changed and to make a server side call with both global values ( original values ) and with the new values 

var $this = $(this);

		// $this will contain a reference to the checkbox
        //this is to change the background color of the div with checkboxes checked		
		if ($this.is(':checked')) {		




var classsubtotal = $(this).closest('.rowckboxreserve').children('.ckboxsubtotalreserve').val();


subtotalcheckbox('reserve',classsubtotal);
       
		
		}
		
		
		
		else
		{
		
		subtotalcheckboxuncheck('reserve',classsubtotal)
		
		
		}
       


}); 



});
