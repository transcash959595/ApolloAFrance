$(document).ready(function() {



$('#activitydetails').click( function() {
var datevar = $("#datepicker").val();


$.ajax(
{
url:'gnretports.php',
type:'POST',
data: {input:'ActivityDetailsDaily', date: datevar },
dataType:'json',
success: function(data)
{

$.each(data, function(key, val) {
                                 
								$('#activitysubtotal').append(val.activitysub);
                                $('#outactivitydetails').append(val.activitydetailsfields);
                                
  								});
								
								
					
}

});
});















$('#vssreport').click( function() {
var datevar = $("#datepicker").val();
$.ajax(
{
url:'gnretports.php',
type:'POST',
data: {input:'vssreport', date: datevar },
dataType:'json',
success: function(data)
{

$.each(data, function(key, val) {
                                 
								$('#outactivitydetails').append(val.vssdetails);                                
                                
  								});

}

});
});










$('#MonetaryFull').click( function() {
var datevar = $("#datepicker").val();
$.ajax(
{
url:'gnretports.php',
type:'POST',
data: {input:'MonetaryFull' , date: datevar},
success: function(data)
{

$('#reportOutputm').append(data);}

});
});





$('#NonMonetaryFull').click( function() {
var datevar = $("#datepicker").val();
$.ajax(
{
url:'gnretports.php',
type:'POST',
data: {input:'NonMonetaryFull' , date: datevar},
success: function(data)
{

$('#reportOutputnm').append(data);}

});
});




$('#balancenegative').click( function() {
var startdatevar = $("#datepickerbankstart").val();
var enddatevar = $("#datepickerbankend").val();
$('#reportcontainer').show();

$.ajax(
{
url:'gnretports.php',
type:'POST',
data: {input:'negativebalance',startdate:startdatevar, enddate: enddatevar },
success: function(data)
{


$('#reportoutput').append(data);}

});


});











});