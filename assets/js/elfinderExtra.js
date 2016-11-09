$(document).ready(function() {


var options = {resizable:true};
var $elfinder = $('#elfinder').elfinder(options);
var $window = $(window);
$window.resize(function(){
    var win_height = $window.height();
    if( $elfinder.height() != win_height ){
        $elfinder.height(win_height).resize();
    }
});
	  
	  
	    }); 