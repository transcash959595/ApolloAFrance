$(document).ready(function() {



$.ajax(
		{
		url:'customerservicemodel.php',
		type:'POST',
		data: {nametrasaction:'fetchcustomerdetailsrow'},
		dataType:'json',
		success: function(data)
		{

								  
		$.each(data, function(key, val) {                                
        $('#resulttransactions').html(val.activitydetailsfields);
		$('#resulttransactions').append(val.transactions);

		});
				




		}
		});



$('#fetchdata').click( function()
 {
 
var fetchdatavarname = $('#optioncustomerservice').val();
var fetchdatavar = $('#searchtext').val();
alert("Fetch customer details  with  " +fetchdatavar );
alert("Fetch customer details  with  " +fetchdatavarname );
$.ajax(
{
url:'customerservicemodel.php',
type:'POST',
data: {fetchdatavar:fetchdatavar,fetchdatavarname:fetchdatavarname},
dataType:'json',

success: function(data)
{

$.each(data, function(key, val) {                                

$('#result').html(val.activitydetailsfields);

});
}

});





});



$('.inputxtfetchdataTrans').live("click", function(){ 
 
        
         var $this = $(this);
         address  = $(this).closest('.rowdetails').children('.inputxtfetchdatanmaddress').val();
         city  = $(this).closest('.rowdetails').children('.inputxtfetchdatanmcity').val();
         number = $(this).closest('.rowdetails').children('.inputxtfetchdatanmnumber').val();
         zip = $(this).closest('.rowdetails').children('.inputxtfetchdatanmzip').val();
		 status = $(this).closest('.rowdetails').children('.inputxtfetchdatanmstatus').val();
         pan  = $(this).closest('.rowdetails').children('.inputxtfetchdatanmpan').val();
		 phone  = $(this).closest('.rowdetails').children('.inputxtfetchdatanmtelephone').val();
		 first  = $(this).closest('.rowdetails').children('.inputxtfetchdatanmfirst').val();
		 last  = $(this).closest('.rowdetails').children('.inputxtfetchdatanmlast').val();
		 
		// alert(address);
		 //alert(city);
		// alert( number);
		
		
		
		
		
		$.ajax(
		{
		url:'customerservicemodel.php',
		type:'POST',
		data: {name:'customerdetailsrow',address:address,city:city, number:number,zip:zip,status:status, pan:pan, phone:phone, first:first, last:last},
		dataType:'json',
		success: function(data)
		{

								  

		




		}
		
		


});

		 
		 
		         alert("New Tab will Open for Customer trasaction details");
		 
		         window.open("customerservicetransactions.html");
		 
		 
		 });




});