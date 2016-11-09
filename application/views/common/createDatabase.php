<!DOCTYPE html>
<html class="nojs html" lang="en-US">
 <head>

  
  <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
  <meta name="generator" content="2015.1.1.343"/>
  <title>Import Database</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <!-- CSS -->
  
 <link rel="stylesheet" type='text/css'  href="<?php echo base_url('/assets/stylesheets/muse/site_global.css')?>" media="all"/>
  <link rel="stylesheet" type='text/css'  href="<?php echo base_url('/assets/stylesheets/muse/master_a-master.css')?>" media="all"/>
  <link rel="stylesheet" type='text/css'  href="<?php echo base_url('/assets/stylesheets/muse/apply-fee.css')?>" media="all"/>
  <link REL="STYLESHEET" TYPE="text/css" HREF="<?php echo base_url('/assets/stylesheets/bankreconv2.css')?>" media="all"/>
  <!-- Other scripts -->
  <div id="MainMenu">

<div id="transcashlogodivision">

<img id="transcashlogo" src="<?php echo base_url('/assets/images/logo.png')?>" />
<input type='hidden' id="serveraddr" value="<?php echo $_SERVER['SERVER_ADDR'] ?>" />

</div>
<ul id="heading">

<li class="listitemtittleleft"> <p class="paddtittle"><a href="<?php echo site_url('Main')?>"><img src="<?php echo base_url('/assets/images/home.png')?>" alt="" class="imgheader" ></a>  </p></li>

<li class="listitemtittleright"> <p class="paddtittle"><a href="<?php echo site_url('Login/logout')?>"><img src="<?php echo base_url('/assets/images/logout.png')?>" alt="" class="imgheader" ></a>  </p></li>





</ul>

</div>  
   </head>
 <body>

  <div class="clearfix borderbox" id="page"><!-- column -->
   <div class="browser_width colelem" id="u136-bw">
    
   </div>
   <div class="clearfix colelem" id="u2147-7"><!-- content -->
   
   </div>
   <div class="clearfix colelem" id="u2177"><!-- column -->
    <div class="position_content" id="u2177_position_content">
     <div class="clearfix colelem" id="pu2178-4"><!-- group -->
	 <p><?php echo 'Import is done for the Date : '.$Date;?>  </br> </p>
     <p><?php echo 'Import is done for : '.$Authadv;?>  </br> </p>
	  <p><?php echo 'Import is done for : '.$Adjust;?>  </br> </p>
	   <p><?php echo 'Import is done for : '.$Authrev;?>  </br> </p>
	    <p><?php echo 'Import is done for : '.$Cardload;?>  </br> </p>
		<p><?php echo 'Import is done for : '.$Cardunload;?>  </br> </p>
		<p><?php echo 'Import is done for : '.$Chargeback;?>  </br> </p>
		<p><?php echo 'Import is done for : '.$Fee;?>  </br> </p>
		<p><?php echo 'Import is done for : '.$Finadv;?>  </br> </p>
     </div>
    
    </div>
   </div>
  
   <div class="verticalspacer"></div>
  </div>
  
  <!-- Other scripts -->
  
   
   </body>
</html>
