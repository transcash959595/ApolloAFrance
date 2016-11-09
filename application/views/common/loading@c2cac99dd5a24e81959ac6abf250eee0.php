<!DOCTYPE html>
<html>
<head>
	<title>Loading </title>

	 <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
   	
	<style type="text/css">
        
        .thead
        {
        	border: 1px solid grey;
        	height: 50px;
        	padding-left: 5px;
            
        }
        #head
        {
        	background-color: #30483A;
        	margin-left: -10px;
        	margin-right: -10px;
        	height: 120px;
        	/*margin-bottom: -10px;*/
        }
	

	</style>
</head>
<body>
<!-- header --> 
     <div class="container-fluid">
       <header id="head"> <!-- <img src="Logo.png     ">
       <img src="Logo.png">
       <img src="Logo.png"> -->
       <div class="row">
       	   <div class="col-lg-4 col-md-4 col-sm-4">
       	   	 <img src="<?php echo base_url('/assets/images/logo.png')?>">
       	   </div>
       	    <div class="col-lg-4 col-md-4 col-sm-4">
       	   	 <a href="<?php echo site_url('Main')?>" target='_blank' > <img src="<?php echo base_url('/assets/images/home.png')?>" alt="" class="imgheader" > </a>
       	   </div>
       	    <div class="col-lg-4 col-md-4 col-sm-4">
			<a href='<?php echo site_url('loginController/logout')?>'><img src="<?php echo base_url('/assets/images/logout.png')?>" alt='' class='imgheader'></a>
       	   	 
       	   </div>

       </div>
       </header>
       <br><br><br><br><br>
        <div class="row" style="border: 1px solid black;">
           <div class="col-lg-12" style="text-align: center;"> Revenue Report for France For Date....</div>    
       </div>
       <br> <br>
       <div class="row"  style=" font-size:10px;  font-weight:bold;">
       	    <div class="col-lg-1 col-md-1 col-sm-1 thead"> Date</div>
       	    <div class="col-lg-1 col-md-1 col-sm-1 thead"> <div class="row"  ">
             <div class="col-lg-6 col-md-6 col-sm-6"> V20 Num </div>
             <div class="col-lg-6 col-md-6 col-sm-6"> V20 Sum </div>
			 </div> </div>			 
			 <div class="col-lg-1 col-md-1 col-sm-1 thead"> <div class="row" >
             <div class="col-lg-6 col-md-6 col-sm-6"> V50 Num </div>
             <div class="col-lg-6 col-md-6 col-sm-6"> V50 Sum </div>
			 </div> </div> 			 
			 <div class="col-lg-1 col-md-1 col-sm-1 thead"> <div class="row" >
             <div class="col-lg-6 col-md-6 col-sm-6"> V100 Num </div>
             <div class="col-lg-6 col-md-6 col-sm-6"> V100 Sum </div>
			 </div> </div>			 
			 <div class="col-lg-1 col-md-1 col-sm-1 thead"> <div class="row" >
             <div class="col-lg-6 col-md-6 col-sm-6"> V150 Num </div>
             <div class="col-lg-6 col-md-6 col-sm-6"> V150 Sum </div>
			 </div> </div>
			 <div class="col-lg-1 col-md-1 col-sm-1 thead"> <div class="row" >
             <div class="col-lg-6 col-md-6 col-sm-6"> V200 Num </div>
             <div class="col-lg-6 col-md-6 col-sm-6"> V200 Sum </div>
			 </div> </div>
			 <div class="col-lg-1 col-md-1 col-sm-1 thead"> <div class="row" >
             <div class="col-lg-6 col-md-6 col-sm-6"> V300 Num </div>
             <div class="col-lg-6 col-md-6 col-sm-6"> V300 Sum </div>
			 </div> </div>			 
			 <div class="col-lg-1 col-md-1 col-sm-1 thead"> <div class="row" >
             <div class="col-lg-6 col-md-6 col-sm-6"> V500 Num </div>
             <div class="col-lg-6 col-md-6 col-sm-6"> V500 Sum </div>
			 </div> </div>			 
			 <div class="col-lg-2 col-md-2 col-sm-2 thead"> <div class="row" >
             <div class="col-lg-6 col-md-6 col-sm-6"> Bank Transfer Num </div>
             <div class="col-lg-6 col-md-6 col-sm-6"> Bank Transfer Sum </div>
			 </div> </div>			 
			 <div class="col-lg-1 col-md-1 col-sm-1 thead"> <div class="row" >
             <div class="col-lg-6 col-md-6 col-sm-6"> Credit Card Num </div>
             <div class="col-lg-6 col-md-6 col-sm-6"> Credit Card Sum </div>
			 </div> </div>       	    
            <div class="col-lg-1 col-md-1 col-sm-1 thead"> Total</div>

       </div>

    <?php  $v20 = 0; $v50 = 0; $v100 = 0; $v150 = 0; $v200  = 0; $v300 = 0; $v500 = 0;  $nobktrn= 0; $creditcard = 0; $sum20 = 0; $sum50 = 0; $sum100 = 0; $sum150 = 0; $sum200  = 0; $sum300 = 0; $sum500 = 0;  $sumbktrn= 0; $sumcreditcard = 0; $grandtotal =0;// initializing the variables for the last div with total?> 
      
	   <?php foreach($loading as $loading) : ?>

	   <?php  $v20 = $v20 + $loading->v20; $v50 = $v50 + $loading->v50; $v100 = $v100 + $loading->v100; $v150 = $v150 + $loading->v150; $v200  = $v200 +$loading->v200; $v300 = $v300 + $loading->v300; $v500 = $v500 + $loading->v500;  $nobktrn = $nobktrn + $loading->nobktrn; $creditcard = $creditcard + $loading->creditcard;
      $sum20 = $sum20 + $loading->sum20; $sum50 = $sum50 + $loading->sum50; $sum100 = $sum100 + $loading->sum100; $sum150 = $sum150 + $loading->sum150; $sum200  = $sum200 +$loading->sum200; $sum300 = $sum300 + $loading->sum300; $sum500 = $sum500 + $loading->sum500;  $sumbktrn = $sumbktrn + $loading->sumbktrn; $sumcreditcard = $sumcreditcard + $loading->sumcreditcard; $total =  $sum20 + $sum50 + $sum100 + $sum200 + $sum150 + $sum200 + $sum300 + $sum500 +$sumbktrn; + $sumcreditcard; $grandtotal = $grandtotal + $total?>

     <div class="row"  style=" font-size:10px;  font-weight:bold;">
        <div class="col-lg-1 col-md-1 col-sm-1 thead"> <?php echo $loading->DATERANGE ?></div>
        <div class="col-lg-1 col-md-1 col-sm-1 thead"> <div class="row"  ">
        <div class="col-lg-6 col-md-6 col-sm-6"><?php echo $loading->v20 ?> </div>
        <div class="col-lg-6 col-md-6 col-sm-6"> <?php echo $loading->sum20 ?></div>
        </div> </div>       
       <div class="col-lg-1 col-md-1 col-sm-1 thead"> <div class="row" >
             <div class="col-lg-6 col-md-6 col-sm-6"> <?php echo $loading->v50 ?> </div>
             <div class="col-lg-6 col-md-6 col-sm-6"> <?php echo $loading->sum50 ?></div>
       </div> </div>       
       <div class="col-lg-1 col-md-1 col-sm-1 thead"> <div class="row" >
             <div class="col-lg-6 col-md-6 col-sm-6"> <?php echo $loading->v100 ?> </div>
             <div class="col-lg-6 col-md-6 col-sm-6"> <?php echo $loading->sum100 ?> </div>
       </div> </div>       
       <div class="col-lg-1 col-md-1 col-sm-1 thead"> <div class="row" >
             <div class="col-lg-6 col-md-6 col-sm-6"> <?php echo $loading->v150 ?> </div>
             <div class="col-lg-6 col-md-6 col-sm-6"> <?php echo $loading->sum150 ?> </div>
       </div> </div>
       <div class="col-lg-1 col-md-1 col-sm-1 thead"> <div class="row" >
             <div class="col-lg-6 col-md-6 col-sm-6"> <?php echo $loading->v200 ?> </div>
             <div class="col-lg-6 col-md-6 col-sm-6"> <?php echo $loading->sum200 ?> </div>
       </div> </div>
       <div class="col-lg-1 col-md-1 col-sm-1 thead"> <div class="row" >
             <div class="col-lg-6 col-md-6 col-sm-6"> <?php echo $loading->v300 ?> </div>
             <div class="col-lg-6 col-md-6 col-sm-6"> <?php echo $loading->sum300 ?> </div>
       </div> </div>       
       <div class="col-lg-1 col-md-1 col-sm-1 thead"> <div class="row" >
             <div class="col-lg-6 col-md-6 col-sm-6"> <?php echo $loading->v500 ?> </div>
             <div class="col-lg-6 col-md-6 col-sm-6"> <?php echo $loading->sum500 ?> </div>
       </div> </div>       
       <div class="col-lg-2 col-md-2 col-sm-2 thead"> <div class="row" >
             <div class="col-lg-6 col-md-6 col-sm-6"> <?php echo $loading->nobktrn ?></div>
             <div class="col-lg-6 col-md-6 col-sm-6"> <?php echo $loading->sumbktrn ?> </div>
       </div> </div>       
       <div class="col-lg-1 col-md-1 col-sm-1 thead"> <div class="row" >
             <div class="col-lg-6 col-md-6 col-sm-6"> <?php echo $loading->creditcard ?> </div>
             <div class="col-lg-6 col-md-6 col-sm-6"> <?php echo $loading->sumcreditcard ?> </div>
       </div> </div>            
            <div class="col-lg-1 col-md-1 col-sm-1 thead"> <?php echo $total ?></div>

       </div>
       

       <?php endforeach; ?>
       
       <div class="row"  style=" font-size:10px;  font-weight:bold;">
        <div class="col-lg-1 col-md-1 col-sm-1 thead"> <?php echo "Total";?></div>
        <div class="col-lg-1 col-md-1 col-sm-1 thead"> <div class="row"  ">
        <div class="col-lg-6 col-md-6 col-sm-6"><?php echo $v20 ?> </div>
        <div class="col-lg-6 col-md-6 col-sm-6"> <?php echo $sum20 ?></div>
        </div> </div>       
       <div class="col-lg-1 col-md-1 col-sm-1 thead"> <div class="row" >
             <div class="col-lg-6 col-md-6 col-sm-6"> <?php echo $v50 ?> </div>
             <div class="col-lg-6 col-md-6 col-sm-6"> <?php echo $sum50 ?></div>
       </div> </div>       
       <div class="col-lg-1 col-md-1 col-sm-1 thead"> <div class="row" >
             <div class="col-lg-6 col-md-6 col-sm-6"> <?php echo $v100 ?> </div>
             <div class="col-lg-6 col-md-6 col-sm-6"> <?php echo $sum100 ?> </div>
       </div> </div>       
       <div class="col-lg-1 col-md-1 col-sm-1 thead"> <div class="row" >
             <div class="col-lg-6 col-md-6 col-sm-6"> <?php echo $v150 ?> </div>
             <div class="col-lg-6 col-md-6 col-sm-6"> <?php echo $sum150 ?> </div>
       </div> </div>
       <div class="col-lg-1 col-md-1 col-sm-1 thead"> <div class="row" >
             <div class="col-lg-6 col-md-6 col-sm-6"> <?php echo $v200 ?> </div>
             <div class="col-lg-6 col-md-6 col-sm-6"> <?php echo $sum200 ?> </div>
       </div> </div>
       <div class="col-lg-1 col-md-1 col-sm-1 thead"> <div class="row" >
             <div class="col-lg-6 col-md-6 col-sm-6"> <?php echo $v300 ?> </div>
             <div class="col-lg-6 col-md-6 col-sm-6"> <?php echo $sum300 ?> </div>
       </div> </div>       
       <div class="col-lg-1 col-md-1 col-sm-1 thead"> <div class="row" >
             <div class="col-lg-6 col-md-6 col-sm-6"> <?php echo $v500 ?> </div>
             <div class="col-lg-6 col-md-6 col-sm-6"> <?php echo $sum500 ?> </div>
       </div> </div>       
       <div class="col-lg-2 col-md-2 col-sm-2 thead"> <div class="row" >
             <div class="col-lg-6 col-md-6 col-sm-6"> <?php echo $nobktrn ?></div>
             <div class="col-lg-6 col-md-6 col-sm-6"> <?php echo $sumbktrn ?> </div>
       </div> </div>       
       <div class="col-lg-1 col-md-1 col-sm-1 thead"> <div class="row" >
             <div class="col-lg-6 col-md-6 col-sm-6"> <?php echo $creditcard ?> </div>
             <div class="col-lg-6 col-md-6 col-sm-6"> <?php echo $sumcreditcard ?> </div>
       </div> </div>            
            <div class="col-lg-1 col-md-1 col-sm-1 thead"> <?php echo $grandtotal ?></div>

       </div>
       <br> <br>
     </div>
</body>
</html>