$(document).ready(function() {

 
//alert("hi jquery  test");
$('.listelementdelete').live("click", function(){ 

//alert("test delete");

var unlinkvar  = $(this).closest('.dirlist').children('.listelementdel').val();

//alert(unlinkvar);

$.ajax(
{
url:'del.php',
type:'POST',
data: {delfile:unlinkvar},
dataType:'text',
success: function(data)
{

                          
location.reload();





}





});





});




});


