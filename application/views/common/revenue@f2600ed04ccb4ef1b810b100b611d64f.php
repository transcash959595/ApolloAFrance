<!DOCTYPE html>
<html>
<head>
	<title></title>

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
     <div class="container">
       <header id="head"> <!-- <img src="Logo.png">
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
			<a href='<?php echo site_url('loginController/logout')?>'><img src="<?php echo base_url('/assets/images/logout.png')?>" alt='' class='img'></a>
       	   	 
       	   </div>

       </div>
       </header>
       <br><br><br><br><br>
        <div class="row" style="border: 1px solid black;">
           <div class="col-lg-12" style="text-align: center;"> Revenue Report for France For Date....</div>    
       </div>
       <br> <br>
       <div class="row">
       	    <div class="col-lg-1 col-md-1 col-sm-1 thead">Months</div>
       	    <div class="col-lg-2 col-md-2 col-sm-1 thead"> <a href='<?php echo site_url('account/cardsales')?>'> Card Sold</a>  </div>
       	    <div class="col-lg-1 col-md-1 col-sm-1 thead"> <a href='<?php echo site_url('account/loading')?>'> Loading</a> </div>
       	    <div class="col-lg-2 col-md-2 col-sm-2 thead"> <a href='<?php echo site_url('account/interchangefees')?>'> Interchange & fees </a> </div>
       	    <div class="col-lg-1 col-md-1 col-sm-1 thead"> <a href='<?php echo site_url('account/misc')?>'>  Misc </a></div>
       	    <div class="col-lg-2 col-md-2 col-sm-2 thead"> <a href='<?php echo site_url('account/negbal')?>'>Negative Balance  </a> </div>
       	    <div class="col-lg-2 col-md-2 col-sm-2 thead"> Total Revenue </div>
       	    <div class="col-lg-1 col-md-1 col-sm-2 thead"> Royality </div>

       </div>

       <?php  $cardsales = 0; $loading = 0; $interchangefees = 0; $misc = 0; $Negbal  = 0; $total = 0; $royalityus = 0; // intitializing the variables for the last div with total?> 
	   <?php foreach($rowrevenue as $rowrevenue) : ?>
	   <?php  $cardsales = $cardsales + $rowrevenue->cardsales; $loading = $loading + $rowrevenue->loading; $interchangefees = $interchangefees + $rowrevenue->interchangefees; $misc = $misc + $rowrevenue->misc; $Negbal  = $Negbal +$rowrevenue->Negbal; $total = $total + $rowrevenue->total; $royalityus = $royalityus + $rowrevenue->royalityus; ?>
       <div class="row">
       	    <div class="col-lg-1 col-md-1 col-sm-1 thead"> <?php echo $rowrevenue->month ?></div>
       	    <div class="col-lg-2 col-md-2 col-sm-1 thead"> <?php echo $rowrevenue->cardsales ?></div>
       	    <div class="col-lg-1 col-md-1 col-sm-1 thead"> <?php echo $rowrevenue->loading ?></div>
       	    <div class="col-lg-2 col-md-2 col-sm-2 thead"> <?php echo $rowrevenue->interchangefees?></div>
       	    <div class="col-lg-1 col-md-1 col-sm-1 thead"> <?php echo $rowrevenue->misc ?> </div>
       	    <div class="col-lg-2 col-md-2 col-sm-2 thead"> <?php echo $rowrevenue->Negbal ?> </div>
       	    <div class="col-lg-2 col-md-2 col-sm-2 thead"> <?php echo $rowrevenue->total ?></div>
       	    <div class="col-lg-1 col-md-1 col-sm-2 thead"> <?php echo $rowrevenue->royalityus ?></div>

       </div>

       <?php endforeach; ?>
       
       <div class="row">
       	    <div class="col-lg-1 col-md-1 col-sm-1 thead" > <b> TOTAL </b> </div>
       	    <div class="col-lg-2 col-md-2 col-sm-1 thead" > <?php echo $cardsales ?></div>
       	    <div class="col-lg-1 col-md-1 col-sm-1 thead" > <?php echo $loading ?></div>
       	    <div class="col-lg-2 col-md-2 col-sm-2 thead" ><?php echo $interchangefees ?></div>
       	    <div class="col-lg-1 col-md-1 col-sm-1 thead" ><?php echo $misc ?> </div>
       	    <div class="col-lg-2 col-md-2 col-sm-2 thead"> <?php echo $Negbal ?></div>
       	    <div class="col-lg-2 col-md-2 col-sm-2 thead"><?php echo $total ?> </div>
       	    <div class="col-lg-1 col-md-1 col-sm-2 thead"><?php echo $royalityus ?> </div>

       </div>
       <br> <br>
     </div>
</body>
</html>