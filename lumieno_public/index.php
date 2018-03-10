<?php
include_once( 'path.php' ); 

?>


<html lang="eng" ng-app="lumieno">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Production Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
	Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />


	<base href="<?php echo DIRECTORY ; ?>">

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui"> 
	<title><?php  echo DISPLAY_NAME; ?></title>

	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-touch-fullscreen" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="default">

	<link rel="apple-touch-icon" sizes="57x57" href="assets/images/favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="assets/images/favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="assets/images/favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="assets/images/favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="assets/images/favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="assets/images/favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="assets/images/favicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="assets/images/favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="assets/images/favicon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/images/favicon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon/favicon-16x16.png">
	<link rel="manifest" href="assets/images/favicon/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="assets/images/favicon/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">


 <link rel="stylesheet" href="assets/css/datepicker.css" >


	<script src="assets/lib/angular.min.js"></script>
	<script src="assets/lib/angular-route.min.js"></script>
	<script src="assets/lib/angular-animate.min.js"></script> 
	<script src="assets/lib/angular-sanitize.min.js"></script> 





	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css"  type="text/css" media="all" / >
	<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css" type="text/css" media="all" />
	<link rel="stylesheet" href="assets/font-awesome/css/font-awesome-animation.min.css" type="text/css" media="all" />
	<!--   faa-wrench animated  faa-wrench animated-hover  faa-wrench  // fa-spin //-->






	<link href="assets/css/style.css?v={random number/string}" rel="stylesheet" type="text/css" media="all" />
	<link rel="stylesheet" href="assets/css/jquery.countdown.css" />
	<link href="assets/css/fasthover.css" rel="stylesheet" type="text/css" media="all" />
	<link href="assets/css/popuo-box.css" rel="stylesheet" type="text/css" property="" media="all" />

	<link href="assets/css/animate.min.css" rel="stylesheet" type="text/css" property="" media="all" />

	<link href="assets/css/cropper.css" rel="stylesheet" type="text/css" property="" media="all" />







	<link href="assets/css/style_001.css?v={random number/string}" rel="stylesheet" type="text/css" media="all" />


	<link href="assets/css/popuo-box.css" rel="stylesheet" type="text/css" property="" media="all" />
	<link href="assets/css/flickerplate.css"  type="text/css" rel="stylesheet" media="all" />
	<!-- js -->
	<script type="text/javascript" src="assets/js/jquery-2.1.4.min.js"></script>
	<!-- //js -->


	<link href='//fonts.googleapis.com/css?family=Fjalla+One' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>



	<link rel="stylesheet" href="assets/css/ngprogress-lite.css"  type="text/css" media="all" / >


	<link rel="stylesheet" href="assets/css/flexslider.css" type="text/css" media="screen" property="" />


	<link href="assets/css/style_0.css" rel="stylesheet" type="text/css" media="all" />




</head>

<body ng-controller="LumienoControllerBoady" ng-cloak>
	<!-- header -->
	<div class="header" id="headd-sho-b">
		<div class="container containerv">
 
			<nav class="navbar navbar-default">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<div class="navbar-toggle collapsed iamge-hidesho">
						
						<input class="login_box" type="checkbox" id="login_boxz">
											<label class="icon-login vx01 login-utr" id="icon-logi-head" for="login_boxz"  ng-show="logUser.show"> 
											  <img ng-src="{{logUser.image}}" alt=""  onerror="javascript:this.src='assets/images/default.png'"  > 
											   
											   <span class="showCartu" ng-show="gCart.show"><i class="fa fa-shopping-cart " aria-hidden="true"></i>{{gCart.count}}</span>
											</label>

					<label class="icon-login login-utr"   for="login_box" ng-show="!logUser.show"> <i class="fa fa-user-circle-o class-hoed" aria-hidden="true" ng-click="gotoLogin()"></i>					   
					</label>
											<div class="login_form"  ng-show="logUser.show">
											  <form action="#" method="post">  
											 
					   <a ng-click="gotoCart('vx01')"  ><i class="fa fa-shopping-cart  pull-right" aria-hidden="true"></i>Cart<span  ng-show="gCart.show" class="color-reds"><i class="fa fa-inr" aria-hidden="true"></i>{{gCart.price}}</span></a>

											  <a class="text-center" href="" >  <img  style=" width: 145px; height: auto; " ng-src="{{logUser.image}}" alt=""  onerror="javascript:this.src='assets/images/default.png'"  > <string>  </strong></a>
											  <a  ng-href="{{logUser.url}}"  ng-click="totoGo(logUser.type, 'vx01')" > {{logUser.name}} </a> 
											  <a  ng-click="exitMe()" ><i class="fa fa-sign-out pull-right"></i> Log Out</a>
											  </form>
											</div>
					</div>
					<div class="logo">

						<h1><a class="navbar-brand" href="index.html"> <span class="login-img">  <img src="assets/images/logo.png"></span> <?php  echo DISPLAY_NAME; ?></a></h1>
					</div>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse nav-wil" id="bs-example-navbar-collapse-1">
					<nav>
						<ul class="nav navbar-nav active-finder">
							<li class=""><a href="home"  class="hvr-sweep-to-bottom"  ng-click="selectMe($event)">Home</a></li>
							<li><a href="products" class="hvr-sweep-to-bottom" ng-click="selectMe($event)">Products</a></li>
							<li><a href="about" class="hvr-sweep-to-bottom" ng-click="selectMe($event)">About Us</a></li>
							<li><a href="team" class="hvr-sweep-to-bottom" ng-click="selectMe($event)">Our Team</a></li>
							<li><a href="contact" class="hvr-sweep-to-bottom" ng-click="selectMe($event)">Contact Us</a></li>

						<li ng-hide="false" class="mobile-hide show-width-he"><input class="login_box" type="checkbox" id="login_box" >
					<label class="icon-login  vx02 login-utr" id="icon-logi-head" for="login_box" ng-show="logUser.show"> 
					  <img ng-src="{{logUser.image}}" alt=""  onerror="javascript:this.src='assets/images/default.png'"  > 
					   <span class="showCartu" ng-show="gCart.show"><i class="fa fa-shopping-cart " aria-hidden="true"></i>{{gCart.count}}</span>
					</label>

					<label class="icon-login login-utr"  for="login_box" ng-show="!logUser.show"> <i class="fa fa-user-circle-o class-hoe" aria-hidden="true" ng-click="gotoLogin()"></i>					   
					</label>

					<div class="login_form" ng-show="logUser.show">
					  <form action="#" method="post">  
					   <a ng-click="gotoCart('vx02')"  ><i class="fa fa-shopping-cart  pull-right" aria-hidden="true"></i>Cart<span  ng-show="gCart.show" class="color-reds"><i class="fa fa-inr" aria-hidden="true"></i>{{gCart.price}}</span></a>

					  <a class="text-center" href="" >  <img style=" width: 145px; height: auto; " ng-src="{{logUser.image}}" alt=""  onerror="javascript:this.src='assets/images/default.png'"  > <string>  </strong></a>
					  <a ng-href="{{logUser.url}}" ng-click="totoGo(logUser.type, 'vx02')"> {{logUser.name}} </a> 
					  <a  ng-click="exitMe()"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
					  </form>
					</div>
					         
					     


					         </li> 
 

 
						</ul>
						 	 
					</nav>
						 
				</div>

				<!-- /.navbar-collapse -->
			</nav>
		</div>
	</div>
	<!-- //header -->


	<main ng-view></main>







	<div class="w3l_related_products w3l_related_products-relt  dipsly_on_yHome">
		<div class="container">
			<!-- <h3>Products</h3> -->
			<ul id="flexiselDemo2" class="flexslider"  style="max-height: 500px;">			
				<li   ng-repeat="product in oproducts" >
					<div class="w3l_related_products_grid">
						<div class="agile_ecommerce_tab_left dresses_grid">
							<div class="hs-wrapper hs-wrapper3">
								<img  style="width: 100%;"  ng-repeat="image in product.images" ng-src="images/products/{{image.name}}" alt=" " class="img-responsive"  onerror="javascript:this.src='assets/images/default.png'"  />	
								<div class="w3_hs_bottom" ng-hide="{{product.soon}}">
									<ul>						
									<li class=" animated infinite swing comming-soon-a imake-midd">
											<span>
											<h5>COMING SOON</h5>
											</span>
											</li>
									</ul>
								</div>
								 
							</div>
								<h5><a   ng-click="go( product.name )"  ng-attr-title="{{product.name}}"> {{product.name | limitTo:70:' ...' }}<span ng-if="product.name.length > 70">...</span></a></h5>
							<div class="simpleCart_shelfItem">								
								<p  class="flexisel_ecommerce_cart"><span ng-show="{{product.oprice}}"><i class="fa fa-inr" aria-hidden="true"></i>{{product.oprice}}</span> <i class="item_price"><i class="fa fa-inr" aria-hidden="true"></i>{{product.nprice}}</i></p>
								<p><a class="item_add"   ng-click="buy( product.name )"   ng-show="{{product.soon}}">buy now</a></p>
											<p style="height: 35px;"   ng-hide="{{product.soon}}"></p>
							</div>
						</div>
					</div>

	

				</li>
	
	 
			</ul>
			 
		</div>
	</div>




	<!-- newsletter -->
	<div class="newsletter dipsly_on_yHome">
		<div class="container">
			<h3>Connect With Us</h3>
			<p class="qui">A pleasure that has nothing to</p>
			<form action="#" method="post">
				<input type="email" name="Email" ng-model="subscribed.email" value="Enter your email address" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Enter your email address';}" required="">
				<input type="button" value=" " ng-click="subscribe( subscribed.email )">
			</form>
				<p class="hemail-error  animated fadeOutRightBig" > You're Already Subscribed! </p>
			<div class="agileits_social_icons_grids">
				<ul class="agileits_social_icons">


					<li class="icon icon--{{link.icon}}" ng-repeat="link in links">
						<a ng-href="{{link.url}}">
							<span class="icon__name text-capitalize">{{link.name}}</span>
						</a>
					</li>
				 
				</ul>
			</div>
		</div>
	</div>
	<!-- //newsletter -->






<div class="jus-a-height">
	
</div>
	<!-- footer -->
	<div class="footer">
		<div class="container">
			<div class="col-md-4 agileinfo_footer_grid">
				<h4>Admin</h4>
				<ul class="info"> 
					<li><img ng-show="admin.image" ng-src="{{admin.image}}" class="main-admin-img"></li> 
					<li><span class="glyphicon glyphicon-user" aria-hidden="true"></span> {{admin.name}}</li>
					<li><span class="glyphicon glyphicon-home" aria-hidden="true"></span> {{admin.address}}</li>
					<li><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span><a ng-href="mailto:{{admin.email}}">{{admin.email}}</a></li>
					<li><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>{{admin.mobile}}</li>
					<li ng-show="admin.landline"><span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span>{{admin.landline}}</li>
					<li ng-show="admin.website"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span><a ng-href="{{admin.website}}">{{admin.websiteName}}</a></li>
				</ul>

			</div>
			<div class="col-md-4 agileinfo_footer_grid">
				<h4>Information</h4>
				<ul class="info"> 
				  

					<li><a href="home">Home</a></li>
					<li><a href="products">SProducts</a></li>
					<li><a href="about">About Us</a></li>
					<li><a href="contact">Contact Us</a></li>
					<li><a href="team">Our Team</a></li> 
				</ul>
				<div class="clearfix"> </div>
			</div>
			<div class="col-md-4 agileinfo_footer_grid">
				<h4>Address</h4>
				<ul>
					<li><span class="glyphicon glyphicon-home" aria-hidden="true"></span>{{basic.basicAddress}} </li>
					<li><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span><a href="mailto:{{basic.basicEmail}}">{{basic.basicEmail}}</a></li>
					<li><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>{{basic.basicMobile}}</li>
					<li ng-show="basic.basicLandline"><span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span>{{basic.basicLandline}}</li>

				</ul>
			</div>
			<div class="clearfix"> </div>
			<div class="w3agile_footer_copy">
				<p>&copy; 2017  <?php  echo DISPLAY_NAME; ?>. All rights reserved | Design by <a href="http://w3layouts.com/">W3layouts</a> <span class="nowu">and copied and modified by </span><a href="<?php echo PATH; ?>"><?php  echo DISPLAY_NAME; ?></a>  </p>
			</div>
		</div>
	</div>
	<!-- //footer -->	


















	<form    method="post" class="hidden" action="root/upladimage.php" enctype="multipart/form-data" id="select-upload-me-1-1">
	    <input type="file" name="image[]"   class="hidden"  multiple="false" accept="image/x-png,image/gif,image/jpeg"  />
	    <input type="submit" name="upload" value="Upload" class="hidden"/>
	</form>  



 

	 <div>
	  <!-- Button trigger modal -->
	  <button type="button" id="setImg" class="btn btn-primary hidden" data-target="#modal-1" data-toggle="modal"> </button>

	  <!-- Modal -->
	  <div class="modal fade dmodel" id="modal-1" role="dialog" aria-labelledby="modalLabel" tabindex="-1" to_this=""   >
	   <div class="modal-dialog" role="document">
	     <div class="modal-content" >
	       <div class="modal-header">
	         <h5 class="modal-title" id="modalLabel">Crop image</h5>
	         <button type="button" class="close hidden" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	       </div>
	       <div class="modal-body  ">
	         <div class="img-container " style="max-height: 400px !important;">
	           <img id="image-1" src="assets/images/loding.gif" alt="Picture" style="max-width: 570px; width: auto; height: auto; max-height: 400px;">
	         </div>
	       </div>
	       <div class="modal-footer"> 

	         <input type="hidden" id="x" name="x" />
	         <input type="hidden" id="y" name="y" />
	         <input type="hidden" id="w" name="w" />
	         <input type="hidden" id="h" name="h" />

	         <input type="hidden" id="r" name="r" />
	         <input type="hidden" id="sx" name="sx" />
	         <input type="hidden" id="sy" name="sy" />
	         <button type="button" id="crop_btn" class="btn btn-default" data-dismiss="modal">save</button>
	       </div>
	     </div>
	   </div>
	 </div>
	 </div>
	<!-- for bootstrap working -->

	<!-- start-smoth-scrolling -->
	<script type="text/javascript" src="assets/js/move-top.js"></script>
	<script type="text/javascript" src="assets/js/easing.js"></script>

 


	<script defer src="assets/js/jquery.flexslider.js"></script>


	<script src="assets/js/jquery.magnific-popup.js" type="text/javascript"></script>

	<script  src="assets/js/jquery.form.js"></script>  

	<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/jquery.validate.js"></script>  











	<script type="text/javascript" src="assets/js/simpleCart.min.js"></script> 
	<script type="text/javascript" src="assets/js/jquery.magnific-popup.js"  ></script>
	<script type="text/javascript" src="assets/js/easyResponsiveTabs.js"  ></script>

	<script type="text/javascript" src="assets/js/jquery.countdown.js"></script>

	<script type="text/javascript" src="assets/js/jquery.wmuSlider.js"></script>  
	<script type="text/javascript" src="assets/js/jquery.flexisel.js"></script> 




	<script type="text/javascript" src="assets/js/ngprogress-lite.min.js"></script>


    <script type="text/javascript" src="assets/js/bootstrap-datepicker.min.js"></script>
    
    <script type="text/javascript" src="assets/js/bootstrap-datepicker.min.js"></script>


	<script src="assets/js/flickerplate.min.js" type="text/javascript"></script>
	<script src="assets/js/cropper.min.js" type="text/javascript"></script>
	<script src="assets/js/javascript_001.js" type="text/javascript"></script>


	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } 
	</script>


	<script>




		$(window).load(function(){

			$('.flexslider').flexslider({
				animation: "slide",
				start: function(slider){
					$('body').removeClass('loading');
				}
			});

			doThisFirst ();

		});


		$(document).ready( function() {
			$showb = true;
			$(window).scroll(function() {

				if ($(window).scrollTop() > 50 ){  

//$('#header-action').fadeOut();
if($showb ){
	$('#header-action').parent().fadeOut();
	$('#headd-sho-b').addClass("main-new-class"); 
	$('#header-action').parent().fadeIn();
}
$showb = false;

}
else{
	if(!$showb ){
		$('#headd-sho-b').removeClass("main-new-class"); 
	}
	$showb = true;
} 
});


		});


		$(document).ready(function() {
			refrshslid();
/*
var defaults = {
containerID: 'toTop', // fading element id
containerHoverID: 'toTopHover', // fading element hover id
scrollSpeed: 1200,
easingType: 'linear' 
};
*/

$(".scroll").click(function(event){		
	event.preventDefault();
	$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
});




$dop = $('.flicker-example');
$dop.flicker();


$('.popup-with-zoom-anim').magnificPopup({
	type: 'inline',
	fixedContentPos: false,
	fixedBgPos: true,
	overflowY: 'auto',
	closeBtnInside: true,
	preloader: false,
	midClick: true,
	removalDelay: 300,
	mainClass: 'my-mfp-zoom-in'
});

$().UItoTop({ easingType: 'easeOutQuart' });




$(document).on('click', '.active-finder>li>a', function() {
	refrshslid();
});


$(document).on('click', '.active-finder>li', function() {
	refrshslid();
});


	 

		$(document).on('click', '.custmenuHfu>li>a', function(){
			$(this).closest('ul').find('.active').removeClass('active');
			$(this).closest('li').addClass('active');
		});


















});




$(function() {


    var url = window.location;
    var element = $('ul.nav a').filter(function() {
        return this.href == url || url.href.indexOf(this.href) == 0;
    }).addClass('active').parent().parent().addClass('in').parent();
    if (element.is('li')) {
        element.addClass('active');
    }


 
});



function refrshslid() {

 

	setTimeout(function() {

		console.log('loading');

		$('.flexslider').flexslider();	
		$('.flexslider').flexslider({
			animation: "slide",
			start: function(slider){
				$('body').removeClass('loading');
			}
		});


	}, 4000);
	//$("#flexiselDemo2").flexisel();
	// $("#flexiselDemo2").flexisel({
	// 	visibleItems:4,
	// 	animationSpeed: 1000,
	// 	autoPlay: true,
	// 	autoPlaySpeed: 3000,    		
	// 	pauseOnHover: true,
	// 	enableResponsiveBreakpoints: true,
	// 	responsiveBreakpoints: { 
	// 		portrait: { 
	// 			changePoint:480,
	// 			visibleItems: 1
	// 		}, 
	// 		landscape: { 
	// 			changePoint:640,
	// 			visibleItems:2
	// 		},
	// 		tablet: { 
	// 			changePoint:768,
	// 			visibleItems: 3
	// 		}
	// 	}
	// });
	


}



var $key504 = 0;





function doThisFirst () {

	var nVer = navigator.appVersion;
	var nAgt = navigator.userAgent;
	var browserName  = navigator.appName;
	var fullVersion  = ''+parseFloat(navigator.appVersion); 
	var majorVersion = parseInt(navigator.appVersion,10);
	var nameOffset,verOffset,ix;

	var OSName="Unknown OS";

	try {
		// In Opera, the true version is after "Opera" or after "Version"
		if ((verOffset=nAgt.indexOf("Opera"))!=-1) {
		 browserName = "Opera";
		 fullVersion = nAgt.substring(verOffset+6);
		 if ((verOffset=nAgt.indexOf("Version"))!=-1) 
		   fullVersion = nAgt.substring(verOffset+8);
		}
		// In MSIE, the true version is after "MSIE" in userAgent
		else if ((verOffset=nAgt.indexOf("MSIE"))!=-1) {
		 browserName = "Microsoft Internet Explorer";
		 fullVersion = nAgt.substring(verOffset+5);
		}
		// In Chrome, the true version is after "Chrome" 
		else if ((verOffset=nAgt.indexOf("Chrome"))!=-1) {
		 browserName = "Chrome";
		 fullVersion = nAgt.substring(verOffset+7);
		}
		// In Safari, the true version is after "Safari" or after "Version" 
		else if ((verOffset=nAgt.indexOf("Safari"))!=-1) {
		 browserName = "Safari";
		 fullVersion = nAgt.substring(verOffset+7);
		 if ((verOffset=nAgt.indexOf("Version"))!=-1) 
		   fullVersion = nAgt.substring(verOffset+8);
		}
		// In Firefox, the true version is after "Firefox" 
		else if ((verOffset=nAgt.indexOf("Firefox"))!=-1) {
		 browserName = "Firefox";
		 fullVersion = nAgt.substring(verOffset+8);
		}
		// In most other browsers, "name/version" is at the end of userAgent 
		else if ( (nameOffset=nAgt.lastIndexOf(' ')+1) < 
		          (verOffset=nAgt.lastIndexOf('/')) ) 
		{
		 browserName = nAgt.substring(nameOffset,verOffset);
		 fullVersion = nAgt.substring(verOffset+1);
		 if (browserName.toLowerCase()==browserName.toUpperCase()) {
		  browserName = navigator.appName;
		 }
		}
		// trim the fullVersion string at semicolon/space if present
		if ((ix=fullVersion.indexOf(";"))!=-1)
		   fullVersion=fullVersion.substring(0,ix);
		if ((ix=fullVersion.indexOf(" "))!=-1)
		   fullVersion=fullVersion.substring(0,ix);

		majorVersion = parseInt(''+fullVersion,10);
		if (isNaN(majorVersion)) {
		 fullVersion  = ''+parseFloat(navigator.appVersion); 
		 majorVersion = parseInt(navigator.appVersion,10);
		}


if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
    OSName="is mobile";
} else {
	 	if (window.navigator.userAgent.indexOf("Windows NT 10.0")!= -1) OSName="Windows 10";
	 	if (window.navigator.userAgent.indexOf("Windows NT 6.2") != -1) OSName="Windows 8";
	 	if (window.navigator.userAgent.indexOf("Windows NT 6.1") != -1) OSName="Windows 7";
	 	if (window.navigator.userAgent.indexOf("Windows NT 6.0") != -1) OSName="Windows Vista";
	 	if (window.navigator.userAgent.indexOf("Windows NT 5.1") != -1) OSName="Windows XP";
	 	if (window.navigator.userAgent.indexOf("Windows NT 5.0") != -1) OSName="Windows 2000";
	 	if (window.navigator.userAgent.indexOf("Mac")            != -1) OSName="Mac/iOS";
	 	if (window.navigator.userAgent.indexOf("X11")            != -1) OSName="UNIX";
	 	if (window.navigator.userAgent.indexOf("Linux")          != -1) OSName="Linux";
}

	}
	catch(err) {
	    

	}



	 





 


	$.ajax({
	    type: 'POST', 
	    url: 'root/ajax.php',
	    data: {action:'set-first',  
		browserName :browserName ,
		fullVersion : fullVersion ,
		majorVersion : majorVersion,
		appName : navigator.appName ,
		userAgent : navigator.userAgent,
		OSName : OSName
	 },
	 success: function(response) { 
	 	response =$.parseJSON(response); 
	 	$key504 = response.success;}
	});

}


$(window).bind("beforeunload", function() { 
 be4lod();

});

$( window ).unload(function() {
 be4lod();
});


function be4lod() {

	 var nVer = navigator.appVersion;
	 var nAgt = navigator.userAgent;
	 var browserName  = navigator.appName;
	 var fullVersion  = ''+parseFloat(navigator.appVersion); 
	 var majorVersion = parseInt(navigator.appVersion,10);
	 var nameOffset,verOffset,ix;

	 var OSName="Unknown OS";

	 try {
	 	// In Opera, the true version is after "Opera" or after "Version"
	 	if ((verOffset=nAgt.indexOf("Opera"))!=-1) {
	 	 browserName = "Opera";
	 	 fullVersion = nAgt.substring(verOffset+6);
	 	 if ((verOffset=nAgt.indexOf("Version"))!=-1) 
	 	   fullVersion = nAgt.substring(verOffset+8);
	 	}
	 	// In MSIE, the true version is after "MSIE" in userAgent
	 	else if ((verOffset=nAgt.indexOf("MSIE"))!=-1) {
	 	 browserName = "Microsoft Internet Explorer";
	 	 fullVersion = nAgt.substring(verOffset+5);
	 	}
	 	// In Chrome, the true version is after "Chrome" 
	 	else if ((verOffset=nAgt.indexOf("Chrome"))!=-1) {
	 	 browserName = "Chrome";
	 	 fullVersion = nAgt.substring(verOffset+7);
	 	}
	 	// In Safari, the true version is after "Safari" or after "Version" 
	 	else if ((verOffset=nAgt.indexOf("Safari"))!=-1) {
	 	 browserName = "Safari";
	 	 fullVersion = nAgt.substring(verOffset+7);
	 	 if ((verOffset=nAgt.indexOf("Version"))!=-1) 
	 	   fullVersion = nAgt.substring(verOffset+8);
	 	}
	 	// In Firefox, the true version is after "Firefox" 
	 	else if ((verOffset=nAgt.indexOf("Firefox"))!=-1) {
	 	 browserName = "Firefox";
	 	 fullVersion = nAgt.substring(verOffset+8);
	 	}
	 	// In most other browsers, "name/version" is at the end of userAgent 
	 	else if ( (nameOffset=nAgt.lastIndexOf(' ')+1) < 
	 	          (verOffset=nAgt.lastIndexOf('/')) ) 
	 	{
	 	 browserName = nAgt.substring(nameOffset,verOffset);
	 	 fullVersion = nAgt.substring(verOffset+1);
	 	 if (browserName.toLowerCase()==browserName.toUpperCase()) {
	 	  browserName = navigator.appName;
	 	 }
	 	}
	 	// trim the fullVersion string at semicolon/space if present
	 	if ((ix=fullVersion.indexOf(";"))!=-1)
	 	   fullVersion=fullVersion.substring(0,ix);
	 	if ((ix=fullVersion.indexOf(" "))!=-1)
	 	   fullVersion=fullVersion.substring(0,ix);

	 	majorVersion = parseInt(''+fullVersion,10);
	 	if (isNaN(majorVersion)) {
	 	 fullVersion  = ''+parseFloat(navigator.appVersion); 
	 	 majorVersion = parseInt(navigator.appVersion,10);
	 	}

if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
    OSName="is mobile";
} else {
	 	if (window.navigator.userAgent.indexOf("Windows NT 10.0")!= -1) OSName="Windows 10";
	 	if (window.navigator.userAgent.indexOf("Windows NT 6.2") != -1) OSName="Windows 8";
	 	if (window.navigator.userAgent.indexOf("Windows NT 6.1") != -1) OSName="Windows 7";
	 	if (window.navigator.userAgent.indexOf("Windows NT 6.0") != -1) OSName="Windows Vista";
	 	if (window.navigator.userAgent.indexOf("Windows NT 5.1") != -1) OSName="Windows XP";
	 	if (window.navigator.userAgent.indexOf("Windows NT 5.0") != -1) OSName="Windows 2000";
	 	if (window.navigator.userAgent.indexOf("Mac")            != -1) OSName="Mac/iOS";
	 	if (window.navigator.userAgent.indexOf("X11")            != -1) OSName="UNIX";
	 	if (window.navigator.userAgent.indexOf("Linux")          != -1) OSName="Linux";
}
	 }
	 catch(err) {
	     

	 }
	 


			$.ajax({
			    type: 'POST', 
			    url: 'root/ajax.php',
			    data: {action:'set-last',  
				browserName :browserName ,
				fullVersion : fullVersion ,
				majorVersion : majorVersion,
				appName : navigator.appName ,
				userAgent : navigator.userAgent,
				OSName : OSName, 
				key : $key504
			 }
			});

return 1;
}





</script>



<script type="text/javascript"   src="assets/js/app.js"></script>

<!-- //flicker -->



<script type="text/javascript">
	
	$(window).load(function(){


		setTimeout( function(){

			
			$("#flexiselDemo2").flexisel({
				visibleItems:4,
				animationSpeed: 1000,
				autoPlay: true,
				autoPlaySpeed: 3000,    		
				pauseOnHover: true,
				enableResponsiveBreakpoints: true,
				responsiveBreakpoints: { 
					portrait: { 
						changePoint:480,
						visibleItems: 1
					}, 
					landscape: { 
						changePoint:640,
						visibleItems:2
					},
					tablet: { 
						changePoint:768,
						visibleItems: 3
					}
				}
			}); 


			
		}, 3000);


	});

</script>
</body>
</html>