<!DOCTYPE HTML>

<html>

<title>  Home  </title>

<head>

<link rel="stylesheet" type='text/css'  href="<?php echo base_url('/assets/stylesheets/index.css')?>" media="all"/>
<link rel="stylesheet" type='text/css'  href="<?php echo base_url('/assets/stylesheets/myaccount.css')?>" media="all"/>

</head>

<body>
<div id="container">
<div id="MainMenuManpage" class="center">

<div id="transcashlogodivision" >



<p id="transcashlogop">  <img id="transcashlogo" src="<?php echo base_url('/assets/images/logo.png')?>"/> </p>

<ul style='margin-left: 75%;'>
		  
		  
		  
		  
		  <li> <div class='listnavtext'><a href='<?php echo site_url('loginController/logout')?>'><img src="<?php echo base_url('/assets/images/logout.png')?>" alt='' class='img'></a></div> </li>
		  
           </ul> 
</div>
<ul id="heading">

</ul>

</div>


<div id="mainContainer" class="center">

<div id="centerTable" class="center"  >

<div id="manitabsdiv">
<ul class="loginul">

<li class="loginlistmain"> <a href='<?php echo site_url('accountController')?>'><input  type="submit" id="accountdetails" class="mainsubmit" value="Account Details"></a> </li>




<li class="loginlistmain"> <a href='<?php echo site_url('balanceController')?>'><input  type="submit" id="transfermoney" class="mainsubmit" value="Transfer Money"> </a></li>

</ul>
</div>





</body>

</html>
