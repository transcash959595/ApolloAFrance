
$(document).ready(function() {




	

$('#submitform').ajaxForm( { beforeSubmit: validate } ); 

$('#createfolderform').ajaxForm( { beforeSubmit: validatecreatefolder } ); 

var directory = $('#postTpe').val();

showfolderdefault(directory);

$('.showfolderdefault').click( function()
 {
// var  directory  = $(this).closest('.uploaddiv').children('.directoryname').val();
   //alert("message1");
  // alert(directory);
  var directory = $('#postTpe').val();
 showfolderdefault(directory);

 
 });
 
 
 $('#submitbutton').click( function()
 {
 var  directory  = $(this).closest('.uploaddiv').children('.directoryname').val();
   //alert("message1");
  // alert(directory);
 showfolderdefault(directory);
  
 
 });
 
 
 $('.renamefolder').live("click", function(){
 
 
 var  directory  = $(this).closest('.folders').children('.changefolder').val();
   //alert("message1");
  //alert("rename  folder called");
  //alert("hi");
  //alert(directory);
   dialogrename(directory);
  
 });
 
 
 
 $('.deletefolder').live("click", function(){
 var  directory  = $(this).closest('.folders').children('.changefolder').val();
   //alert("delete folder called");
   //alert(directory);
    dialogdelete(directory);


 
 });
 
 
 


 
 
 /*$('.showfolderdefault').click( function()
 {
 //var  directory  = ('#userinput').val();
   //alert("message1");
  // alert(directory);
 //createfolder(directory);
  
 
 });*/
 
 function dialogrename(directory)
{

$( "#dialog-rename" ).dialog({
        resizable: false,
        height:140,
        modal: true,
        buttons: {
            Rename: function() {
                var newname = $('#renametextfield').val();
				  renamefolder(directory,newname);
                $( this ).dialog( "close" );
            },
           Cancel: function() {
                $( this ).dialog( "close" );
            }
        }
    });








}





function dialogdelete(directory)
{

$( "#dialog-delete" ).dialog({
        resizable: false,
        height:140,
        modal: true,
        buttons: {
            Delete: function() {
                
				  deletefolder(directory);
                $( this ).dialog( "close" );
            },
           Cancel: function() {
                $( this ).dialog( "close" );
            }
        }
    });








}


/*




*/
  
  
 function renamefolder(directory,newname)  
 {
  //alert(directory);
 
var parts = directory.split("/");
//alert(parts[parts.length-1]);
var replacevalue = parts[parts.length-1];
var newpath = directory.replace(replacevalue,"");
 //alert(value);
 
 var newname = newpath+newname;
 
 
 $.ajax(
{
url:'directory.php',
type:'POST',
data: {name:'renamefolder', directory:directory,newname:newname},
dataType:'json',
success: function(data)
{


//alert(directory);
alert("Folder has been renamed successfully");
var directory = $('#postTpe').val();

showfolderdefault(directory);

}

});
 
 }
 
 
 
 
 
 function deletefolder(directory,newname)  
 {
  
  $.ajax(
{
url:'directory.php',
type:'POST',
data: {name:'deletefolder', directory:directory},
dataType:'json',
success: function(data)
{


//alert(directory);
alert("Folder has been deleted successfully");

var directory = $('#postTpe').val();

showfolderdefault(directory);
}

});
 
 }
  
  
 
 function createfolder(directory)
{

 $.ajax(
{
url:'directory.php',
type:'POST',
data: {name:'createfolder', directory:directory},
dataType:'json',
success: function(data)
{


//alert(directory);
//alert("create folder called");


}

});
}
 
 
 
 function showfolderdefault(directory)
{
//alert(directory);
 $.ajax(
{
url:'directory.php',
type:'POST',
data: {name:'showdefaultfolder', directory:directory},
dataType:'json',
success: function(data)
{



$.each(data, function(key, val) {  

var text = val.filelist;
var text = text.replace(new RegExp("FS","g"), "/");
$('#files').html(text);
$('#folders').html(val.dirlist);



});


}

});
}

 
 $('#file').change(function(){
  $('#path').val($(this).val());
  $(".form input:text").css( "background-color", "#FFFFFF" );
});
 
 
 $( ".foldername" ).click(function() 
 {
 $(this).css( "background-color", "#FFFFFF" );
 
 });
 
 
 
 $( ".form input:text" ).click(function() 
 {
 $(this).css( "background-color", "#FFFFFF" );
 
 });
 
 
 
 
 
 $('#createfolderform').ajaxForm( { beforeSubmit: validatecreatefolder } ); 
 
 
 function validatecreatefolder(formData, jqForm, options) { 
    // jqForm is a jQuery object which wraps the form DOM element 
    // 
    // To validate, we can access the DOM elements directly and return true 
    // only if the values of both the username and password fields evaluate 
    // to true 
 
    var form = jqForm[0]; 
    if (!form.foldername.value ) { 
        
		$( ".foldername" ).css( "background-color", "red" );
		alert('Name of the folder required '); 
        return false; 
    } 
	
	var directoryname = $('#foldername').val();
	 var pathdirectory = $('#postTpe').val();
	//var pathdirectory = $('.uploaddiv').children('.directoryname').val();
	var directory = pathdirectory +'/' + directoryname;
	createfolder(directory);
	//alert(directory);
    alert('Folder is added  Successfully '); 
	$('#createfolderform').clearForm();
	location.reload();
	
}
 function validate(formData, jqForm, options) { 
    // jqForm is a jQuery object which wraps the form DOM element 
    // 
    // To validate, we can access the DOM elements directly and return true 
    // only if the values of both the username and password fields evaluate 
    // to true 
 
    var form = jqForm[0]; 
    if (!form.file.value ) { 
	   $(".form input:text").css( "background-color", "red" );
        alert('Please Select the file to upload'); 
		
        return false; 
    } 
    alert('File is Uploaded Successfully '); 
	$('#submitform').clearForm();
	location.reload();
	
}
 
});