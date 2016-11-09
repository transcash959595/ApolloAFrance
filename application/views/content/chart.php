
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/-transcash-2011.dwt" codeOutsideHTMLIsLocked="False" -->
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>

<meta http-equiv="pragma" content="no-cache" />


<title>  TransCash Monthly Sales  </title>

<head>
<link rel="stylesheet" type='text/css'  href="<?php echo base_url('/assets/stylesheets/bankreconv2.css')?>" media="all"/>
<link REL="STYLESHEET" TYPE="text/css" HREF="<?php echo base_url('/assets/stylesheets/chart.css')?>" media="all"/> 



<script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.7/angular.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/js/chart.js')?>"></script>

	</head>
	<body>
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
<div ng-app="myApp">
    <bars data="40,4,55,15,16,33,52,20"></bars>
</div>

	</body>
</html>

