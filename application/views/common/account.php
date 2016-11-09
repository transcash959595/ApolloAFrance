<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/-transcash-2011.dwt" codeOutsideHTMLIsLocked="False" -->
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>

<meta http-equiv="pragma" content="no-cache" />


<title>  TransCash Reconciliation  </title>

<head>

<link rel="stylesheet" type='text/css'  href="<?php echo base_url('/assets/stylesheets/bankreconv2.css')?>" media="all"/>
<script type="text/javascript" src="<?php echo base_url('/assets/js/jquery.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/js/transcashreconl1.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/js/printElementmin.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/js/jquercustommin.js')?>"></script>

</head>

<body>

<div id="MainMenu" >
<div id="transcashlogodivision">

<img id="transcashlogo" src="<?php echo base_url('/assets/images/logo.png')?>" />

</div>
<ul id="heading">
<li class="listitem"> <p class="paddtittle"><a href="<?php echo site_url('Main')?>" target='_blank' > <img src="<?php echo base_url('/assets/images/home.png')?>" alt="" class="imgheader" > </a>  </p></li>
<li class="listitem"> <p class="paddtittle"><a href="<?php echo site_url('Account')?>"  >  <img src="<?php echo base_url('/assets/images/reconciliation.png')?>" alt="" class="imgheader" > </a>  </p></li>
<li class="listitem"> <p class="paddtittle"><a href="<?php echo site_url('Reconciled')?>" target='_blank'> <img src="<?php echo base_url('/assets/images/reconciled.png')?>" alt="" class="imgheader" > </a>  </p></li>
<li class="listitem"> <p class="paddtittle"><a href="<?php echo site_url('Undoreconciliation')?>" target='_blank'> <img src="<?php echo base_url('/assets/images/undoreconciliation.png')?>" alt="" class="imgheader" > </a>  </p></li>

</ul>

</div>


<script>
	$(function() {
		$( "#datepickerbankstart" ).datepicker();
		$("#datepickerbankend").datepicker();
		//$("#reportOutput").append($("#datepicker").val());
	});
	</script>
	
	
<div id="selectdate">

<div class="dateinnerdiv"><p>Start Date: <input id="datepickerbankstart" type="text"></p></div>

<div class="dateinnerdiv"><p>End Date: <input id="datepickerbankend" type="text"></p></div>
<input type="submit" value="Account Details" id="accountdetails" />



<!-- <input type="text" value="" id="inputdetails" /> -->



</div><!-- End demo -->


