<script type="text/javascript">
  
  $().ready(function() {
  
  var serveraddr = $('#serveraddr').val();
  alert(serveraddr);
    var elf = $('#elfinder').elfinder({
      // set your elFinder options here
      url: 'http://'+ serveraddr +'/index.php/elfinderController/elfinder_/customerservice'  // connector URL
      
    }).elfinder('instance');  

alert(url);    
  });
  
  
  
  
</script>


<link REL="STYLESHEET" TYPE="text/css" HREF="<?php echo base_url('/assets/stylesheets/customerserviceNew.css')?>"media="all"/> 
	</head>
	<body>
	<ul id="heading" >









</ul>
	
	<div id="MainMenu">

<div id="transcashlogodivision">

<img id="transcashlogo" src="<?php echo base_url('/assets/images/logo.png')?>" />
<input type='hidden' id="serveraddr" value="<?php echo $_SERVER['SERVER_ADDR'] ?>" />

</div>
<ul id="heading">

<li class="listitemtittleleft"> <p class="paddtittle"><a href="<?php echo site_url('Main')?>"><img src="<?php echo base_url('/assets/images/home.png')?>" alt="" class="imgheader" ></a>  </p></li>
<li class="listitemtittle"> <p class="paddtittle"><a href="<?php echo site_url('Customerservice/pageview/account-functions')?>"><img src="<?php echo base_url('/assets/images/csa.png')?>" alt="" class="imgheader" ></a>  </p></li>

<li class="listitemtittleright"> <p class="paddtittle"><a href="<?php echo site_url('Login/logout')?>"><img src="<?php echo base_url('/assets/images/logout.png')?>" alt="" class="imgheader" ></a>  </p></li>




</ul>

</div>
<div id="mainContainer">
		<!-- Element where elFinder will be created (REQUIRED) -->
		<div id="elfinder"></div>
		
		</div>

	</body>
</html>

