
var lumieno = angular.module( 'lumieno', ['ngRoute', 'ngAnimate', 'ngProgressLite', 'ngSanitize', 'ngtimeago']); 


var config = {
	headers : {
		'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;',
		'X-Requested-With': 'XMLHttpRequest'
	}
}
// urlz= window.location.href;  
// urlz = urlz.substring(0, urlz.lastIndexOf('/')); 


lumieno.directive('flexslider', function () {
	
	return {
		link: function (scope, element, attrs) {
			
			element.flexslider({
				animation: "slide"
			});
		}
	}
});



lumieno.config([ '$routeProvider', '$locationProvider', function( $routeProvider, $locationProvider ) {
	$routeProvider
	.when('/home', {
		templateUrl: 'pages/home.html',
		controller: 'LumienoControllerHome'
	})
	.when('/about', {
		templateUrl: 'pages/about.html',
		controller: 'LumienoControllerAbout'
	})
	.when('/products', {
		templateUrl: 'pages/products.html',
		controller: 'LumienoControllerProducts'
	})
	.when('/team', {
		templateUrl: 'pages/team.html',
		controller: 'LumienoControllerTeam'
	})
	.when('/contact', {
		templateUrl: 'pages/contact.html',
		controller: 'LumienoControllerContact'
	})
	.when('/login', {
		templateUrl: 'pages/login.html',
		controller: 'LumienoControllerLogin'
	})
	.when('/newcustomer', {
		templateUrl: 'pages/newcustomer.html',
		controller: 'LumienoControllerNewcustomer'
	})
	.when('/single/:product', {
		templateUrl: 'pages/single.html',
		controller: 'LumienoControllerSingle'
	})
	.when('/confirm/:key', {
		templateUrl: 'pages/confirm.html',
		controller: 'LumienoControllerConfirm'
	})
	.when('/confirm', {
		templateUrl: 'pages/newcustomer.html',
		controller: 'LumienoControllerNewcustomer'
	})
	.when('/newpassword/:key', {
		templateUrl: 'pages/newpassword.html',
		controller: 'LumienoControllerNewpassword'
	})
	.when('/newpassword', {
		templateUrl: 'pages/newpassword.html',
		controller: 'LumienoControllerNewpassword'
	})
	.when('/checkout', {
		templateUrl: 'pages/checkout.html',
		controller: 'LumienoControllerCheckout',
		resolve:{
			loggedIn:onlyLoggedIn
		}
	})  
	.when('/payment', {
		templateUrl: 'pages/payment.html',
		controller: 'LumienoControllerPayment',
		resolve:{
			loggedIn:onlyLoggedIn
		}
	}) 
	.when('/customer', {
		templateUrl: 'customer/home.html',
		controller: 'LumienoControllerCustomerHome',
		resolve:{
			loggedIn:onlyLoggedIn
		}
	})
	.when('/customer-home', {
		templateUrl: 'customer/home.html',
		controller: 'LumienoControllerCustomerHome',
		resolve:{
			loggedIn:onlyLoggedIn
		}
	})
	.when('/customer-history', {
		templateUrl: 'customer/history.html',
		controller: 'LumienoControllerCustomerHistory',
		resolve:{
			loggedIn:onlyLoggedIn
		}
	})
	.when('/customer-profile', {
		templateUrl: 'customer/profile.html',
		controller: 'LumienoControllerCustomerProfile',
		resolve:{
			loggedIn:onlyLoggedIn
		}
	})
	.when('/customer-complaint', {
		templateUrl: 'customer/complaint.html',
		controller: 'LumienoControllerCustomerComplaint',
		resolve:{
			loggedIn:onlyLoggedIn
		}
	})
	.when('/buy', {
		templateUrl: 'pages/buy.html',
		controller: 'LumienoControllerBuy',
		resolve:{
			loggedIn:onlyLoggedIn
		}
	}) 		
	.otherwise({
		redirectTo: '/home'
	});




	$locationProvider.html5Mode({
		enabled: true,
		requireBase: false
	});

}]);

lumieno.run( function($rootScope, ngProgressLite) {
	
	$rootScope.$on('$routeChangeStart', function() {
		ngProgressLite.start();
	});

	$rootScope.$on('$routeChangeSuccess', function() {
		ngProgressLite.done();
		$("body").animate({scrollTop: 0}, "slow");
	});
	

	
});



lumieno.service('myservice', function() {
	this.name = null;
	this.value = null;
});

var onlyLoggedIn = function ($location,$q,$http) { 
	var deferred = $q.defer();  
	var data = $.param({
		action: 'check-User'
	});	 
	$http.post("root/ajax.php", data, config).then(function (response) {
		response =angular.fromJson(response);
		data = response.data.success.success;	 
		if(data == 1){  
			deferred.resolve();
		}else{  
			deferred.reject();
			$location.url('login');
		}
	}); 
	return deferred.promise;

};




lumieno.directive("compareTo", function() {
	return {
		require: "ngModel",
		scope: {
			otherModelValue: "=compareTo"
		},
		link: function(scope, element, attributes, ngModel) {

			ngModel.$validators.compareTo = function(modelValue) {
				return modelValue == scope.otherModelValue;
			};

			scope.$watch("otherModelValue", function() {
				ngModel.$validate();
			});
		}
	};
}
);


lumieno.controller( 'LumienoController', function($scope){

});



lumieno.controller( 'LumienoControllerBoady',  function($timeout, $location, $scope, $http, $sce){ 
	$scope.gCart = {
		show:false
	}

	$scope.logUser = { show: false,
		name: null,
		image: null,
		url: null};


		$scope.gotoLogin =  function() {
			$location.path('login');
		}

		$scope.totoGo = function( userAre, clia) { 
			$location.path(userAre);
			$('.'+clia).click();

		}

		$scope.selectMe = function( $event) {

			var myEl = angular.element( document.querySelector( '.active-finder>li.active' ) );
			myEl.removeClass('active');		 
			$(event.target).parent('li').addClass('active'); 
		}
		
		$scope.trustSrc = function(src) {
			return $sce.trustAsResourceUrl(src);
		}

		$timeout( function() {
			

			var data = $.param({
				action: 'get-site-basic' 
			});	
			$http.post("root/ajax.php", data, config)
			.then(function mySuccess(response) { 
				response =angular.fromJson(response);
				data = response.data.success;	 
				$scope.admin= { name: data.adminName,
					email: data.adminEmail,
					address: data.adminAddress,
					landline: data.adminLandline,
					mobile: data.adminMobile,
					image: data.adminImage,
					website: data.adminWebsite,
					websiteName: extractHostname(data.adminWebsite)


				} ;  
				$scope.basic= { basicAddress: data.basicAddress,
					basicEmail: data.basicEmail,
					basicMobile: data.basicMobile,
					basicLandline: data.basicLandline,
					basicDescription1: data.basicDescription1,
					basicDescription2: data.basicDescription2,
					basicDescription3: data.basicDescription3,
					basicDescription4: data.basicDescription4,
					basicFeatures1H: data.basicFeatures1H,
					basicFeatures1M: data.basicFeatures1M,
					basicFeatures2H: data.basicFeatures2H,
					basicFeatures2M: data.basicFeatures2M,
					basicFeatures3H: data.basicFeatures3H,
					basicFeatures3M: data.basicFeatures3M,
					basicAboutH: data.basicAboutH,
					basicAboutM: data.basicAboutM,
					basicAboutHH: data.basicAboutHH,
					basicAboutMM: data.basicAboutMM,
					basicVision: data.basicVision,
					basicMission: data.basicMission,
					basicDescriptionteam: data.basicDescriptionteam,
					basicMap: data.basicMap,
					basicMapmsg: data.basicMapmsg,
					basicAboutImage: data.basicAboutImage


				} ; 
				


		   	// data.forEach(function(entry) { 
		   	//     $scope.images.push({ name: entry });
		   	// });

		   }, function myError(response) { 
		   	console.log(response);
		   });

		}, 100);



		$scope.subscribe =  function( email) {
			var data = $.param({
				action: 'subscribe-email' ,
				email: email
			});	
			$http.post("root/ajax.php", data, config)
			.then(function mySuccess(response) { 
				response =angular.fromJson(response);
				data = response.data.success;	 
				console.log(data);

				if(data == 0){

				} else if(data  == 1){ 

					$scope.subscribed = {email: "Enter your email address"}
					$('#success-submitted').modal('toggle');
					$('#success-submitted').modal('show');

					
					$timeout(function() {  $('#success-submitted').modal('hide');}, 5000);

					



				} else if(data  == -1){ 
					$('.hemail-error').css('display', 'block');
					$timeout( function() {  
						$('.hemail-error').removeClass('fadeInLeftBig');
						$('.hemail-error').addClass('fadeOutRightBig');
					}, 3000);

					$('.hemail-error').addClass('fadeInLeftBig');
					$('.hemail-error').removeClass('fadeOutRightBig');

				}

			}, function myError(response) { 
				console.log(response);
			});
		}

		
		$timeout( function() { 
			var data = $.param({
				action: 'check-login'
			});	
			$http.post("root/ajax.php", data, config)
			.then(function mySuccess(response) { 
				response =angular.fromJson(response);
				data = response.data.success;	  
				if(data.success == 1){
					dataValue = data.data;
					$scope.logUser = { show: true,
						name: dataValue.name,
						email: dataValue.email,
						type: dataValue.type,
						image: '' + dataValue.type + '/media/images/' + dataValue.image,
						url: '' + dataValue.type + '-home' };
					}
					

					console.log($scope.logUser);


				}, function myError(response) { 
					console.log(response);
				});


		}, 100);



		$scope.exitMe =  function() {
			var data = $.param({
				action: 'exit'
			});	
			$http.post("root/ajax.php", data, config)
			.then(function mySuccess(response) { 
				response =angular.fromJson(response);
				data = response.data.success;	  
				if(data == 1){				

					console.log("login");
					$location.path('login');
					$scope.logUser = { show: false,
						name: null,
						image: null,
						url: null};
						$scope.gCart = { show:false };

					}
					
					

				}, function myError(response) { 
					console.log(response);
				});


		}



		$scope.gotoCart = function(clia) {
			$location.path('checkout');
			$('.'+clia).click();
		}



		$timeout( function(){
			var data = $.param({
				action: 'get-product-0' 
			});	
			$http.post("root/ajax.php", data, config)
			.then(function mySuccess(response) { 
				response =angular.fromJson(response);
				data = response.data.success;	 
				if(data.success == 1) { 
					$scope.nproducts = []; 
					$scope.oproducts = []; 
					data.data.forEach(function(entry) {  
						productx = entry.product; 
						if(productx.new == 1)
							$scope.nproducts.push({ 
								name: productx.name,
								category: productx.category,
								oprice: productx.oprice, 
								nprice: productx.nprice,  
								count: productx.count,    				   						 
								new: productx.new,
								soon:(productx.count >0 ? 1: 0 ),
								rate: productx.rate,
								date: productx.date,
								images: entry.images
							});
						if(productx.new == 0)
							$scope.oproducts.push({ 
								name: productx.name,
								category: productx.category,
								oprice: productx.oprice, 
								nprice: productx.nprice,  
								count: productx.count,    				   						 
								new: productx.new,
								soon:(productx.count >0 ? 1: 0 ),
								rate: productx.rate,
								date: productx.date,
								images: entry.images
							});
						
					});
					
					
				}

			}, function myError(response) { 
				console.log(response);
			});

		}, 1);		




		$timeout( function() {

			var data = $.param({
				action: 'get-cart'
			});	
			$http.post("root/ajax.php", data, config)
			.then(function mySuccess(response) { 
				response =angular.fromJson(response);
				data = response.data.success; 
				if(data.success == 1){ 
					$scope.carts = data.data; 
					total = 0;  
					angular.forEach($scope.carts, function(value, key) {
						total += (parseInt(value.product.nprice) * parseInt(value.count)) + parseInt(value.charge)
					});
					$scope.gCart = {
						show:true,
						price: total,
						count:$scope.carts.length
					}
				} 
				

				console.log($scope.carts);


			}, function myError(response) { 
				console.log(response);
			});
			

		}, 200);








	});



lumieno.controller( 'LumienoControllerLogin', function($location, $timeout, $scope, $http, myservice){
	$scope.myservice = myservice;
	$scope.product = $scope.myservice.name;  


	$scope.myservice.name = null; 
	$scope.myservice.value = null; 



	toCart = false;
	if( !( $scope.product === null)) { 	 	
		toCart = true;
	} 


	$scope.$watch('$parent.logUser', function() {
		$scope.logUser =  $scope.$parent.logUser;
		$scope.loginCheck();
	});
	$scope.loginCheck = function() {
		if ($scope.logUser.url) { location.href = $scope.logUser.url;}
	}

	$scope.login =  {customer:true}; 
	$scope.loginMe =  function( loginD) {
		console.log(loginD);
		$scope.login =  {customer:loginD}; 
		
	}
	$scope.error = {customer: false};
	$scope.error = {distributor: false};
	$scope.errorDistributorEmail = false;
	$scope.errorDistributorPassword = false;
	$scope.errorCustomerEmail = false;
	$scope.errorCustomerPassword = false;


	
	$scope.loginForCustomer =  function() {
		emailCustomer = $scope.emailCustomer;
		passwordCustomer = $scope.passwordCustomer;

		if(!validateEmail(emailCustomer)){
			$scope.errorCustomerEmail = true;
			return;
		}
		if(passwordCustomer.length <6){			
			$scope.errorCustomerPassword = true;
			return;
		}
		$scope.disabledCustomer = true;
		var data = $.param({
			action: 'customer-login' ,
			email: emailCustomer,
			password: passwordCustomer
		});	
		$http.post("root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response); 
			data = response.data.success;				 	
			checkLogin($scope.$parent);	  
			if(data == 1) {
				if(toCart) {
					$scope.myservice.name = $scope.product;
					$location.path('/checkout');

				} else {
					$location.path('customer-home'); 
				}
			} else { 
				$scope.error = {customer: true};
			}
			
			
			$scope.disabledCustomer = false;

		}, function myError(response) { 
			console.log(response);
		});
		
	}
	
	$scope.loginForDistributor =  function() {
		emailDistributor = $scope.emailDistributor;
		passwordDistributor = ""+$scope.passwordDistributor;

		if(!validateEmail(emailDistributor)){
			$scope.errorDistributorEmail = true;
			return;
		}
		if(passwordDistributor.length <6){			
			$scope.errorDistributorPassword = true;
			return;
		}

		$scope.disabledDistributor = true;
		var data = $.param({
			action: 'distributor-login' ,
			email: emailDistributor,
			password: passwordDistributor
		});	
		$http.post("root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);  
			data = response.data.success;

			checkLogin($scope.$parent);
			if(data == 1) {
				location.href="distributor";
			} else { 
				$scope.error = {distributor: true};
			}
			
			$scope.disabledDistributor = false;

		}, function myError(response) { 
			console.log(response);
		});
		
	}


	function checkLogin( parent ) { 
		var data = $.param({
			action: 'check-User'
		});	
		$http.post("root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data.success;	 
			if(data.success == 1){
				parent.logUser = []; 
				dataValue = data.data;
				parent.logUser = { show: true,
					name: dataValue.name,
					email: dataValue.email,
					type: dataValue.type,
					image: '' + dataValue.type + '/media/images/' + dataValue.image,
					url: '' + dataValue.type + '-home' };
					
				} else {
					$location.path('login');
				} 


			}, function myError(response) { 
				console.log(response);
			}); 
		
	}

});


lumieno.controller( 'LumienoControllerContact', function($timeout, $scope, $http){ 

	$scope.disabled = true;
	$scope.addNewMsg =  function () { 

		var data = $.param({
			action: 'add-email' ,
			name: $scope.contact.name,  
			email: $scope.contact.email ,  
			telephone: $scope.contact.number ,  
			message: $scope.contact.message
		});	
		$http.post("root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data.success;	 
			console.log(data);
			if(data == 0){

			} else if(data  == 1){ 
				
				$scope.contact = {emails: "Enter your email address"}
				$('#success-submitted').modal('toggle');
				$('#success-submitted').modal('show');

				
				$timeout(function() {  $('#success-submitted').modal('hide');}, 5000);

				



			} 

			

		}, function myError(response) { 
			console.log(response);
		});
	}
	
});




lumieno.controller( 'LumienoControllerTeam', function($scope, $timeout, $http){ 
	
	$scope.team = [];
	$timeout( function() {
		

		var data = $.param({
			action: 'get-team-basic' 
		});	
		$http.post("root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data.success;	 
			
			if (data.success == 1) {
				
				data.data.forEach(function(entry) {  
					$scope.team.push({
						name: entry.name,
						mobile: entry.mobile,
						image: 'images/team/' + entry.image,
						links:entry.links
					});

				});

			} 

		}, function myError(response) { 
			console.log(response);
		});

	}, 100);




});




lumieno.controller( 'LumienoControllerHome',  function($timeout, $scope, $http, $filter, $location, $routeParams, myservice){
	$scope.product = decodeURIComponent($routeParams.product);	
	$scope.myservice = myservice;


	$scope.myservice.name = null; 
	$scope.myservice.value = null; 


	$scope.buy = function( product) {
		$scope.myservice.name = product;
		$location.path('/buy');
	}




	$timeout( function(){
		var data = $.param({
			action: 'get-look' 
		});	
		$http.post("root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data.success;	  
			if(data.success == 1) {
				$scope.home = []; 
				products = data.products;
				data = data.data[0]; 
				$scope.home = {

					name1 : data.product1,
					name2 : data.product2,
					name3 : data.product3,

					description1 : data.description1,
					description2 : data.description2,
					description3 : data.description3,
					description4 : data.description4,
					description5 : data.description5,
					description6 : data.description6,
					description7 : data.description7,
					description8 : data.description8,
					description9 : data.description9,
					description10 : data.description10,
					description11 : data.description11,
					description12 : data.description12,
					description13: data.description13,
					description14 : data.description14,

					image1 : 'images/look/' + data.image1,
					image2 : 'images/look/' + data.image2,
					image3 : 'images/look/' + data.image3,
					

				};
				
			}

		}, function myError(response) { 
			console.log(response);
		});

	}, 100);	





	$timeout( function(){
		var data = $.param({
			action: 'get-link-0'

		});	
		$http.post("root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data.success;	  
			if(data.success == 1) { 
				$scope.links = []; 
				data.data.forEach(function(entry) { 
					if( entry.deleted !=1 )
						$scope.links.push({ 
							name: entry.name,
							url: entry.url,
							icon: entry.icon 
						});
				}); 
				
			}

		}, function myError(response) { 
			console.log(response);
		});

	}, 100);


	
	$timeout( function(){
		var data = $.param({
			action: 'get-product-0' 
		});	
		$http.post("root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data.success;	 
			if(data.success == 1) { 
				$scope.nproducts = []; 
				$scope.oproducts = []; 
				data.data.forEach(function(entry) {  
					productx = entry.product; 
					if(productx.new == 1)
						$scope.nproducts.push({ 
							name: productx.name,
							category: productx.category,
							oprice: productx.oprice, 
							nprice: productx.nprice,  
							count: productx.count,    				   						 
							new: productx.new,
							soon:(productx.count >0 ? 1: 0 ),
							rate: productx.rate,
							date: productx.date,
							images: entry.images
						});
					if(productx.new == 0)
						$scope.oproducts.push({ 
							name: productx.name,
							category: productx.category,
							oprice: productx.oprice, 
							nprice: productx.nprice,  
							count: productx.count,    				   						 
							new: productx.new,
							soon:(productx.count >0 ? 1: 0 ),
							rate: productx.rate,
							date: productx.date,
							images: entry.images
						});
					
				});
				
				
			}

		}, function myError(response) { 
			console.log(response);
		});

	}, 1);		







	$scope.go = function( product) {
		console.log(encodeURIComponent(product), product);
		$location.path('/single/' + encodeURIComponent(product));
	}

			// $scope.buy = function( product) {
			// 	console.log(encodeURIComponent(product), product);
			// 	$location.path('/single/' + encodeURIComponent(product));
			// }





			
		});


lumieno.controller( 'LumienoControllerProducts', function($timeout, $scope, $http, $filter, $location, $routeParams, myservice){
	$scope.product = decodeURIComponent($routeParams.product);	
	$scope.myservice = myservice;


	$scope.myservice.name = null; 
	$scope.myservice.value = null; 



	$scope.buy = function( product) {
		$scope.myservice.name = product;
		$location.path('/buy');
	}

	
	$timeout( function(){
		var data = $.param({
			action: 'get-product-0' 
		});	
		$http.post("root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data.success;	 
			if(data.success == 1) { 
				$scope.nproducts = [];  
				data.data.forEach(function(entry) {  
					productx = entry.product; 

					$scope.nproducts.push({ 
						name: productx.name,
						category: productx.category,
						oprice: parseInt(productx.oprice), 
						nprice: parseInt(productx.nprice),  
						count: parseInt(productx.count),    				   						 
						new: parseInt(productx.new),
						neww:(parseInt(productx.new) >0 ? true: false),
						soon:(parseInt(productx.count) >0 ? 1: 0),
						rate: parseInt(productx.rate),
						date: productx.date,
						images: entry.images
					});
					

					
				});
				
				
			}

		}, function myError(response) { 
			console.log(response);
		});

	}, 100);		



	$scope.updateSort = function( sort) {
		switch( sort) {
			case "0": 

			$scope.nproducts = $filter('orderBy')($scope.nproducts, "name", false);

			break;
			case "1": 
			$scope.nproducts = $filter('orderBy')($scope.nproducts, "rate", false); 

			break;
			case "2": 
			$scope.nproducts = $filter('orderBy')($scope.nproducts, "new", true); 

			break;
			case "3": 
			$scope.nproducts = $filter('orderBy')($scope.nproducts, "nprice", false); 

			break;
			case "4": 
			$scope.nproducts = $filter('orderBy')($scope.nproducts, "nprice", true); 

			break;

		}
		
	}



	$scope.go = function( product) {
		console.log(encodeURIComponent(product), product);
		$location.path('/single/' + encodeURIComponent(product));
	}


		// $scope.buy = function( product) {
		// 	console.log(encodeURIComponent(product), product);
		// 	$location.path('/single/' + encodeURIComponent(product));
		// }



	});


lumieno.controller( 'LumienoControllerSingle', function( $location, $timeout, $scope, $http, $filter, $routeParams, myservice){
	$scope.product = decodeURIComponent($routeParams.product);	
	$scope.myservice = myservice;

	$scope.myservice.name = null; 
	$scope.myservice.value = null; 


	$scope.buy = function( product) {
		$scope.myservice.name = product;
		$location.path('/buy');
	}

	$timeout( function(){
		var data = $.param({
			action: 'get-product-1' ,
			product: $scope.product
		});	
		$http.post("root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data.success;	  
			if(data.success == 1) { 
				entry = data.data[0]; 
				$scope.products = { 
					name: entry.name,
					category: entry.category,
					category_id: parseInt(entry.category_id),
					oprice: parseInt(entry.oprice), 
					nprice: parseInt(entry.nprice),  
					count: parseInt(entry.count),    				   						 
					new: (entry.new == 1 ? true: false),
					newa: entry.new,
					rate: parseInt(entry.rate),
					description: entry.description,
					soon:(parseInt(entry.count) >0 ? false: true),
					client: entry.client,
					date: entry.date, 
				};

				
			}


			console.log($scope.products);
			$scope.images = []; 
			
			if( data.image) 
				data.image.forEach(function(entry) { 
					$scope.images.push({  
						name: entry.name ,
						path: 'images/products/' + entry.name 
					});
				});



			$scope.specifications = []; 

			if( data.specification) 
				data.specification.forEach(function(entry) { 
					$scope.specifications.push({  
						name: entry.name ,
						value: entry.value 
					});
				});


			console.log($scope.specifications);



		}, function myError(response) { 
			console.log(response);
		});

	}, 100);


	

	$scope.range = function(min, max, step){
		step = step || 1;
		var input = [];
		for (var i = min; i <= max; i += step) input.push(i);
			return input;
	};



	

	function getCats() {

		var data = $.param({
			action: 'get-cart'
		});	
		$http.post("root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data.success; 
			if(data.success == 1){ 
				$scope.carts = data.data; 



			} else if(data.success == -1) {
				$location.path('login');

			}else if(data.success == -2) {
				$location.path('login');

			} else {
				console.log('sorry');
			}
			

			console.log($scope.carts);


		}, function myError(response) { 
			console.log(response);
		});

	}


	$timeout( function() { 

		getCats();

	}, 100);





	$scope.removeThisCart = function( cart){  

		var index = $scope.carts.indexOf(cart); 
		if(index >-1) { 
			var data = $.param({
				action: 'remove-cart',
				cart: cart.cart
			});	

			$http.post("root/ajax.php", data, config)
			.then(function mySuccess(response) { 
				response =angular.fromJson(response);
				data = response.data.success;  
				if(data == 1){ 	 	  				
					$scope.carts.splice(index, 1);  
				}  else {
					console.log('sorry');
				}

			}, function myError(response) { 
				console.log(response);
			});




		}




	} 
	;
	
	$scope.getTotal =  function( carts ) {
		total = 0; 
		angular.forEach(carts, function(value, key) {
			total += (parseInt(value.product.nprice) * parseInt(value.count)) + parseInt(value.charge)
		});
		
		if( total == 0) $scope.$parent.gCart = { show:false };
		else
			$scope.$parent.gCart = {
				show:true,
				price: total,
				count:carts.length
			};
			

			return total;
		}

		$scope.addPrice = function (charge, nprice, count) {
			return (parseInt(nprice) * parseInt(count)) + parseInt(charge);
		}

		


		$scope.go = function( product) {
			console.log(encodeURIComponent(product), product);
			$location.path('/single/' + encodeURIComponent(product));
		}

		

		$scope.cart = function(products) {
			

			$('.cjekleft_r').addClass('box-shd-h');
			$timeout(function(){$('.cjekleft_r').removeClass('box-shd-h');}, 1500);

			addToCart(products, 1); 
		}



		function addToCart(product, count) {

			
			var exdata = {
				action: 'cart-product' ,
				product: $scope.product,
				count: count
			}

			var data = $.param(exdata);
			$http.post("root/ajax.php", data, config)
			.then(function mySuccess(response) { 
				response =angular.fromJson(response);
				data = response.data.success;	 
				console.log(data);  
				if(data == 1) { 
					getCats();	 	   				 
				} else if(data == -1) {
					$scope.myservice.name = $scope.product;
					$location.path('/login');
				}





			}, function myError(response) { 
				console.log(response);
			});

		}





	});





lumieno.controller( 'LumienoControllerNewcustomer', function($timeout, $scope, $http, $filter, $routeParams){
	
	$scope.showInitioal = true;
	$scope.msg = {temp: true};












	$scope.customerProfileSubmit =  function() {
		password =  $scope.customer.password;
		repassword =  $scope.customer.repassword;

		if(password !== repassword){
			
			$scope.customerProfile.repassword.$invalid = true;
			$scope.customerProfile.$invalid = true;
			return true;
		}

		var exdata = {
			action: 'add-customer',
			password: $scope.customer.password,
			name: $scope.customer.name, 
			email: $scope.customer.email,
			mobile: $scope.customer.mobile, 
			address: $scope.customer.address,
			pin: $scope.customer.pin 

		}
		var data = $.param(exdata);	
		$http.post("root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data;    
			success = data.success;	

			console.log(data);		 
			if(success == -1){ 
				
				
				$scope.customerProfile.email.$invalid = true;
				$scope.customerProfile.$invalid = true;
				$scope.emailError = "email already exists";
				
			} else  if(success == -2){ 
				
				
				$scope.customerProfile.mobile.$invalid = true;
				$scope.customerProfile.$invalid = true;
				$scope.mobileError = "mobile number already exists";
				
			} else if(success == 1){ 

				
				$scope.showInitioal = false;
				$scope.msg = {
					show: true,
					class: 'alert alert-success', 
					icon: 'fa-check-circle',
					sub: ' success ',
					msg: 'In the email we send you, click the Confirm your email button to complete the confirmation process.'
				};
				

				$scope.customer ={temp: true};
			} else {
				$scope.showInitioal = false;
				$scope.msg = {
					show: true,
					class: 'alert alert-danger', 
					icon: 'fa-exclamation-triangle',
					sub: ' something is wrong  ',
					msg: 'contact to administrator : phone - ' + $scope.$parent.admin.mobile
				};

			}
			

		}, function myError(response) { 
			window.location.href = "/";
		});




		

	}



});




lumieno.controller( 'LumienoControllerConfirm', function($timeout, $scope, $http, $routeParams, $location){ 
	$scope.key = decodeURIComponent($routeParams.key);

	
	



	var exdata = {
		action: 'confirm-customer',
		key: $scope.key 

	}
	var data = $.param(exdata);	
	$http.post("root/ajax.php", data, config)
	.then(function mySuccess(response) { 
		response =angular.fromJson(response);
		data = response.data;    
		success = data.success;	

		console.log(data);		  
		if(success == 1){ 

			
			$scope.msg = {
				show: true,
				class: 'alert alert-success', 
				icon: 'fa-check-circle',
				sub: ' success ',
				msg: 'your email has been successfully verified  you can now login',
				href: ' you can now login'
			};
			
			
		} else { 
			$scope.msg = {
				show: true,
				class: 'alert alert-danger', 
				icon: 'fa-exclamation-triangle',
				sub: ' something is wrong / Invalid Link /timeout  ',
				msg: 'contact to administrator  ' ,
				href: ''
			};

		}
		

	}, function myError(response) { 
		window.location.href = "/";
	});







});




lumieno.controller( 'LumienoControllerNewpassword', function($timeout, $scope, $http, $routeParams, $location){
	$scope.key = decodeURIComponent($routeParams.key);
	$scope.request = true;
	$scope.setEmail = true;
	$scope.isNewPass = false;
	
	if( !( $scope.key === "undefined")) {
		checkKey($scope.key);
		$scope.setEmail = false;
	} 

	$scope.msg = { show: false  };

	$scope.msg1 = {
		show: true,
		class: 'alert alert-warning', 
		icon: 'fa fa-spinner fa-spin',
		sub: ' please wait ',
		msg: '.......',
		href: ''
	};




	
	$scope.userProfileSubmit = function() {


		var exdata = {
			action: 'new-password',
			type: $scope.user.type, 
			email: $scope.user.email
		}
		var data = $.param(exdata);	
		$http.post("root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data;    
			success = data.success;	
			
			if(success == -1){ 
				
				
				$scope.userProfile.email.$invalid = true;
				$scope.userProfile.$invalid = true;
				$scope.emailError = "can't find email";

				
			}   else if(success == 1){ 

				$scope.request = false;

				$scope.msg = {
					show: true,
					class: 'alert alert-success', 
					icon: 'fa-check-circle',
					sub: ' success ',
					msg: 'In the email we send you, click the `reset your password` button to complete the confirmation process.'
				};
				
				
			} else {
				$scope.request = false;
				$scope.msg = {
					show: true,
					class: 'alert alert-danger', 
					icon: 'fa-exclamation-triangle',
					sub: ' something is wrong  ',
					msg: 'contact to administrator  ' + $scope.$parent.admin.mobile ,
					href: ''
				};
			}
			

		}, function myError(response) { 
			window.location.href = "/";
		});




		
	}




	function checkKey(ukey) {

		var exdata = {
			action: 'confirm-new-password',
			key: ukey 

		}
		var data = $.param(exdata);	
		$http.post("root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data;    
			success = data.success;	

			console.log(data);		  
			if(success == 1){ 

				$scope.isNewPass = true;
				
				
			} else { 
				$scope.msg1 = {
					show: true,
					class: 'alert alert-danger', 
					icon: 'fa-exclamation-triangle',
					sub: ' something is wrong / Invalid Link /timeout  ',
					msg: 'contact to administrator  ' ,
					href: ''
				};

			}
			

		}, function myError(response) { 
			window.location.href = "/";
		});



	}


	$scope.newPassProfileSubmit =  function() {

		password =  $scope.customer.password;
		repassword =  $scope.customer.repassword;

		if(password !== repassword){
			
			$scope.newPassProfile.repassword.$invalid = true;
			$scope.newPassProfile.$invalid = true;
			return true;
		}

		var exdata = {
			action: 'new-pass-success',
			password: $scope.customer.password,
			key: $scope.key

		}
		var data = $.param(exdata);	
		$http.post("root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data;    
			success = data.success;	

			console.log(data);		 
			
			if(success == 1){ 

				
				$scope.isNewPass = false; 
				$scope.msg1 = {
					show: true,
					class: 'alert alert-success', 
					icon: 'fa-check-circle',
					sub: ' success ',
					msg: 'Your password has been reset successfully!'
				};
				

				$scope.customer ={temp: true};
			} else {
				
				$scope.isNewPass = false;
				$scope.msg1 = {
					show: true,
					class: 'alert alert-danger', 
					icon: 'fa-exclamation-triangle',
					sub: ' something is wrong  ',
					msg: 'contact to administrator : phone - ' + $scope.$parent.admin.mobile
				};

			}
			

		}, function myError(response) { 
			window.location.href = "/";
		});




	}


});






lumieno.controller( 'LumienoControllerCustomerHome', function($timeout, $scope, $http, $routeParams, $location){
	
	$scope.instructions = [];

	$timeout( function() { 
		var data = $.param({
			action: 'check-User'
		});	
		$http.post("root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data.success;	  
			if(data.success == 1){
				dataValue = data.data;
				$scope.customerUser = { show: true,
					name: dataValue.name,
					oldEmail: dataValue.email,
					email: dataValue.email,
					type: dataValue.type,
					dob: dataValue.dob,
					mobile: parseInt(dataValue.mobile),
					landline: parseInt(dataValue.landline),
					address: dataValue.address,
					pin: parseInt(dataValue.pin), 
					image: dataValue.image, 
					imagePath: '' + dataValue.type + '/media/images/' + dataValue.image,
					url: '' + dataValue.type + '-home' };


					$scope.$parent.logUser = { show: true,
						name: dataValue.name,
						email: dataValue.email,
						type: dataValue.type,
						image: '' + dataValue.type + '/media/images/' + dataValue.image,
						url: '' + dataValue.type + '-home' };
						
					} else {
						$location.path('login');
					}
					

					console.log($scope.customerUser);


				}, function myError(response) { 
					console.log(response);
				});


	}, 100);



	
	$timeout( function() { 
		var data = $.param({
			action: 'get-instructions'
		});	
		$http.post("root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data.success;	 
			if(data.success == 1){
				$scope.instructions = data.data;

				
			} else {
				$location.path('login');
			}
			

			console.log($scope.instructions);


		}, function myError(response) { 
			console.log(response);
		});


	}, 100);



	
});




lumieno.controller( 'LumienoControllerCustomerProfile', function(dateFilter, $timeout, $scope, $http, $routeParams, $location){

	$scope.customerUser = [];
	gideAll();
	$scope.errorShow = null;



	$timeout( function() { 
		var data = $.param({
			action: 'check-User'
		});	
		$http.post("root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data.success;	  
			if(data.success == 1){
				dataValue = data.data;
				$scope.customerUser = { show: true,
					name: dataValue.name,
					oldEmail: dataValue.email,
					email: dataValue.email,
					type: dataValue.type,
					dob: dataValue.dob,
					mobile: parseInt(dataValue.mobile),
					landline: parseInt(dataValue.landline),
					address: dataValue.address,
					pin: parseInt(dataValue.pin), 
					image: dataValue.image, 
					imagePath: '' + dataValue.type + '/media/images/' + dataValue.image,
					url: '' + dataValue.type + '-home' };
				} else {
					$location.path('login');
				}
				

				console.log($scope.customerUser);


			}, function myError(response) { 
				console.log(response);
			});


	}, 100);
	
	function gideAll() {		

		$('.datepicker-dropdown').fadeOut();
		$timeout(function() {	 $('.datepicker-dropdown').hide();}, 111);
		$scope.showEditName =  false;
		$scope.showEditemail =  false;
		$scope.showEditmobile =  false;
		$scope.showEditdob =  false;
		$scope.showEditlandline =  false;
		$scope.showEditpin =  false;
		$scope.showEditaddress =  false;
		$scope.errorShow =  false;

	}


	$scope.showData =  function(updatedData ) {
		gideAll();
		switch(updatedData) {
			case 'a':
			$scope.showEditName =   true;
			break;
			case 'b':
			$scope.showEditemail =   true;
			break;
			case 'c':
			$scope.showEditmobile =   true;
			break;
			case 'd':
			$scope.showEditdob =   true;
			break;
			case 'e':
			$scope.showEditlandline =   true;
			break;
			case 'f':
			$scope.showEditpin =   true;
			break;
			case 'g':
			$scope.showEditaddress =   true;
			break;
		}
	}

	$(document).on('change', '#udob', function(){
		$scope.customerUser['dob'] = $('#udob').val() ;
	});

	$scope.update_Data =  function( updatedData){
		gideAll();
		if(updatedData.name.length < 2) { 
			$scope.errorShow = "Invalid name";
			return 1;
		}
		if(!validateEmail(updatedData.email)) { 
			$scope.errorShow = "Invalid email";
			return 1;
		}

		if((''+updatedData.mobile).length != 10) { 
			console.log(updatedData.mobile);	
			$scope.errorShow = "Invalid mobile";
			return 1;
		}
		if ( isNaN(updatedData.mobile) ) {	 		
			$scope.errorShow = "Invalid mobile";
			return 1;
		}


		if((''+updatedData.pin).length != 6) {
			$scope.errorShow = "Invalid pin";
			return 1;
		}
		if(updatedData.address.length < 6) {
			$scope.errorShow = "Invalid address";
			return 1;
		}
		

		var exdata = {
			action: 'update-customer', 
			name: updatedData.name, 
			email: updatedData.email,
			oldEmail: updatedData.oldEmail,
			mobile: updatedData.mobile, 
			address: updatedData.address,
			landline: updatedData.landline,
			dob: updatedData.dob, 
			pin: updatedData.pin 

		}
		var data = $.param(exdata);	
		$http.post("root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data;    
			success = data.success;	

			console.log(data);		 
			if(success == -1){ 
				$scope.errorShow = "email already exists"; 
				
			} else  if(success == -2){ 
				
				
				$scope.errorShow = "mobile number already exists";  
				
			} else if(success == 1){ 
				$scope.errorShow =  false;

				$scope.customer ={temp: true};
			} else {

				$scope.errorShow = 'contact to administrator : phone - ' + $scope.$parent.admin.mobile; 
				
			}
			

		}, function myError(response) { 
			window.location.href = "/";
		});




	}

});







lumieno.controller( 'LumienoControllerCheckout',function($timeout, $scope, $http, $routeParams, $location, myservice){
	$scope.myservice = myservice;
	$scope.product = $scope.myservice.name; 

	$scope.myservice.name = null; 
	$scope.myservice.value = null; 

	$scope.carts = [];
	if( !( $scope.product === null)) { 
		addToCart($scope.product, 1); 
	} 

	$timeout( function() { 
		var data = $.param({
			action: 'check-User'
		});	
		$http.post("root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data.success;	  
			if(data.success == 1){
				dataValue = data.data; 
				$scope.$parent.logUser = { show: true,
					name: dataValue.name,
					email: dataValue.email,
					type: dataValue.type,
					image: '' + dataValue.type + '/media/images/' + dataValue.image,
					url: '' + dataValue.type + '-home' };
					
				} else {
					$location.path('login');
				}
				console.log($scope.customerUser);
			}, function myError(response) { 
				console.log(response);
			});
	}, 0);


	function addToCart(product, count) {

		
		var exdata = {
			action: 'cart-product' ,
			product: $scope.product,
			count: count
		}

		var data = $.param(exdata);
		$http.post("root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data.success;	 
			console.log(data);  
			if(data == 1) { 
				getCats();	 	   				 
			} else if(data == -1) {
				$scope.myservice.name = $scope.product;
				$location.path('/login');
			}





		}, function myError(response) { 
			console.log(response);
		});

	}


	function getCats() {

		var data = $.param({
			action: 'get-cart'
		});	
		$http.post("root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data.success; 
			if(data.success == 1){ 
				$scope.carts = data.data; 



			} else if(data.success == -1) {
				$location.path('login');

			}else if(data.success == -2) {
				$location.path('login');

			} else {
				console.log('sorry');
			}
			

			console.log($scope.carts);


		}, function myError(response) { 
			console.log(response);
		});

	}


	$timeout( function() { 

		getCats();

	}, 100);






	$scope.removeThisCart = function( cart){ 

		var index = $scope.carts.indexOf(cart); 
		if(index >-1) { 
			var data = $.param({
				action: 'remove-cart',
				cart: cart.cart
			});	

			$http.post("root/ajax.php", data, config)
			.then(function mySuccess(response) { 
				response =angular.fromJson(response);
				data = response.data.success;  
				if(data == 1){ 	 	  				
					$scope.carts.splice(index, 1);  
				}  else {
					console.log('sorry');
				}

			}, function myError(response) { 
				console.log(response);
			});




		}




	}



	$scope.$watch('carts', function(newVal, oldVal) {
		console.log( $scope.carts);
	});


	$scope.getTotal =  function( carts ) {
		total = 0; 
		angular.forEach(carts, function(value, key) {
			total += (parseInt(value.product.nprice) * parseInt(value.count)) + parseInt(value.charge)
		});
		
		if( total == 0) $scope.$parent.gCart = { show:false };
		else
			$scope.$parent.gCart = {
				show:true,
				price: total,
				count:carts.length
			};
			

			return total;
		}

		$scope.addPrice = function (charge, nprice, count) {
			return (parseInt(nprice) * parseInt(count)) + parseInt(charge);
		}


		$scope.addCount = function(cart, add) {  
			cartMax =  Math.max(parseInt(cart['count']) + add , 1); 
			cart['count'] =  Math.min(cartMax, 20); 
			updateCoutCart(cart);
		}


		$scope.go = function( product) {
			console.log(encodeURIComponent(product), product);
			$location.path('/single/' + encodeURIComponent(product));
		}

		










		function updateCoutCart(cart) {
			cartid = cart['cart'];
			cartcount = cart['count'];

			var data = $.param({
				action: 'cart-count',
				id: cartid,
				count: cartcount

			});	

			$http.post("root/ajax.php", data, config)
			.then(function mySuccess(response) { 
				response =angular.fromJson(response); 
				data = response.data.success;   
				if(data >0){ 	 	  				
					cart['count'] =  data;  
				}  else {
					console.log('sorry');
				}

			}, function myError(response) { 
				console.log(response);
			});



		}


		$scope.gotoPaymnt =  function() {
			$scope.myservice.value = false;
			$scope.myservice.name = null;
			$location.path('payment');
		}



	});



lumieno.controller( 'LumienoControllerPayment',  
	function( $timeout, $scope, $http, $routeParams, $location, myservice){

		$scope.myservice = myservice;
		$scope.checkout = $scope.myservice.value; 
		$scope.product = $scope.myservice.name; 

		$scope.isAtag = 0;


		$scope.myservice.name = null; 
		$scope.myservice.value = null; 

		var isCheckoutBy = false;

		$scope.carts = [];
		if( !( $scope.checkout === null) ) {  
			

			if($scope.checkout ==  1 ){
				isCheckoutBy = true;

				if(( $scope.product === null)) 
					$location.path('buy');
				
			}

		} else { 
			isCheckoutBy = -1;
			$location.path('checkout');
		}
		


		
		

		function getCats() {


			if(isCheckoutBy){

				var data = $.param({
					action: 'get-buy',
					product: $scope.product
				});	

			} else {
				var data = $.param({
					action: 'get-cart'
				});
			}	


			$http.post("root/ajax.php", data, config)
			.then(function mySuccess(response) { 
				response =angular.fromJson(response);
				console.log(response.data);
				data = response.data.success; 
				if(data.success == 1){ 
					$scope.carts = data.data;  
					
					if(data.data[0].buy)
						if(data.data[0].buy == 1)
							$scope.isAtag = $scope.product;

						
					} else if(data.success == -1) {
						$location.path('login');

					}else if(data.success == -2) {
						$location.path('login');

					} else {	 				
						$location.path('customer-history');
					}
					

					console.log($scope.carts);


				}, function myError(response) { 
					console.log(response);
				});

		}


		$timeout( function() { 

			getCats();

		}, 100);




		


		$scope.$watch('carts', function(newVal, oldVal) {
			console.log( $scope.carts);
		});


		$scope.getTotal =  function( carts ) {
			total = 0; 
			angular.forEach(carts, function(value, key) {
				total += (parseInt(value.product.nprice) * parseInt(value.count)) + parseInt(value.charge)
			});
			
	 		// if( total == 0) $scope.$parent.gCart = { show:false };
	 		// 	else
	 	 //     $scope.$parent.gCart = {
	 	 //     	show:true,
	 	 //     	price: total,
	 	 //     	count:carts.length
	 	 //     };
	 	 

	 	 return total;
	 	}

	 	$scope.addPrice = function (charge, nprice, count) { 
	 		return (parseInt(nprice) * parseInt(count)) + parseInt(charge);
	 	}


	 	$scope.cashOnDeliv  = function() {

	 		var totot = $scope.getTotal( $scope.carts ); 
	 		
	 		var data = $.param({
	 			action: 'cash-on-delivery',
	 			type:$scope.isAtag,
	 			total:totot
	 		});	
	 		$http.post("root/ajax.php", data, config)
	 		.then(function mySuccess(response) { 
	 			response =angular.fromJson(response); 
	 			data = response.data.success;  
	 			console.log(response.data);
	 			if(data.success == 1){ 	

	 				if(!  isCheckoutBy){
	 					removeCar($scope.$parent);
	 				}	




	 				$scope.myservice.name = 'success';			
	 				$location.path('customer-history');


	 				
	 			} else if(data.success == -1) {
	 				$location.path('login');

	 			}else if(data.success == -2) {
	 				$location.path('login');

	 			} else {
	 				console.log('sorry');
	 			}
	 			
	 			


	 		}, function myError(response) { 
	 			console.log(response);
	 		});
	 	}



	 	
	 	function removeCar(parent) {

	 		console.log(parent.gCart); 
	 		console.log(parent.gCart);
	 		$timeout(function() {
	 			parent.gCart = { show:false };
	 		}, 100);

	 	}

	 });






lumieno.controller( 'LumienoControllerCustomerHistory', function($timeout, $scope, $http, $routeParams, $location, myservice){
	$scope.myservice = myservice;
	$scope.success = $scope.myservice.name; 

	$scope.myservice.name = null; 
	$scope.myservice.value = null; 

	success = false;
	if( !( $scope.success === null)) { 	 	
		success = true;
	} 
	
	$scope.carts = [];
	$scope.hideToOne = true;
	$scope.oneItem = [];
	$scope.oneCart = [];






	$scope.go = function( product) {
		console.log(encodeURIComponent(product), product);
		$location.path('/single/' + encodeURIComponent(product));
	}



	$timeout( function(){

		var data = $.param({
			action: 'get-success-cart'
		});	
		$http.post("root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data.success;  
			if(data.success == 1){ 
				$scope.carts = data.data;  
				
			} else if(data.success == -1) {
				$location.path('login');

			}else if(data.success == -2) {
				$location.path('login');

			} else {	 				
				$location.path('customer-history');
			}
			

			console.log($scope.carts);


		}, function myError(response) { 
			console.log(response);
		});

	}, 100);




	$scope.addPrice = function (charge, nprice, count) {
		return (parseInt(nprice) * parseInt(count)) + parseInt(charge);
	}

	$scope.bakto =  function() {	 	
		$scope.hideToOne = true;
		$timeout(function(){  $("body").animate({scrollTop: 0}, "slow");},10);
	}


	$scope.gotoDetails =  function( product, cart) {
		$scope.hideToOne = false;
		console.log(product);
		$scope.oneItem = product;
		$scope.oneCart = cart;

		$timeout(function(){  $("body").animate({scrollTop: 0}, "slow");},10);


	}


	$scope.gotoComplaint = function(key, name ) {

		$scope.myservice.name = key;			
		$scope.myservice.value = name;			
		$location.path('customer-complaint');
	}

	

});





lumieno.controller( 'LumienoControllerCustomerComplaint',  function($timeout, $scope, $http, $routeParams, $location, myservice){
	$scope.myservice = myservice;
	$scope.key = $scope.myservice.name; 
	$scope.name = $scope.myservice.value; 
	$scope.myservice.name = null; 
	$scope.myservice.value = null; 
	$scope.complaintSuccess =  false;

	console.log($scope.key);
	console.log($scope.name);






	$scope.go = function( product) {
		console.log(encodeURIComponent(product), product);
		$location.path('/single/' + encodeURIComponent(product));
	}


	$scope.addNewMsg = function() {


		var data = $.param({
			action: 'add-complaint' ,
			key: $scope.key,  
			product: $scope.name ,  
			subject: $scope.contact.subject ,  
			complaint: $scope.contact.message
		});	
		$http.post("root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data.success;	 
			console.log(response.data);
			if(data == 0){

			} else if(data  == 1){ 
				
				$scope.complaints.push({
					product:$scope.name,
					idkey: $scope.key,
					subject: $scope.contact.subject,
					complaint: $scope.contact.message,
					date: 'now'
				});



				$scope.key = null;
				$scope.name = null;
				$scope.complaintSuccess =  true;				
				$timeout(function(){  $("body").animate({scrollTop: 0}, "slow");},9);

			} 

			

		}, function myError(response) { 
			console.log(response);
		});


	}



	$scope.complaints = [];

	$timeout( function() {


		var data = $.param({
			action: 'get-complaint'
		});	
		$http.post("root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data.success; 
			if(data.success == 1){ 
				$scope.complaints = data.data; 
			}  
		}, function myError(response) { 
			console.log(response);
		});
		

	}, 99);









	
});







lumieno.controller( 'LumienoControllerBuy', function($timeout, $scope, $http, $routeParams, $location, myservice){
	$scope.myservice = myservice;
	$scope.product = $scope.myservice.name; 

	$scope.myservice.name = null; 
	$scope.myservice.value = null; 

	$scope.carts = [];
	if( !( $scope.product === null)) { 
		addToCart($scope.product, 1); 
	} else {
		$location.path('checkout');
	}

	$timeout( function() { 
		var data = $.param({
			action: 'check-User'
		});	
		$http.post("root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data.success;	  
			if(data.success == 1){
				dataValue = data.data; 
				if(dataValue)
					$scope.$parent.logUser = { show: true,
						name: dataValue.name,
						email: dataValue.email,
						type: dataValue.type,
						image: '' + dataValue.type + '/media/images/' + dataValue.image,
						url: '' + dataValue.type + '-home' };
						
					} else {
						$location.path('login');
					} 
				}, function myError(response) { 
					console.log(response);
				});
	}, 0);


	function addToCart(product, count) {

		
		var exdata = {
			action: 'buy-product' ,
			product: $scope.product,
			count: count
		}

		var data = $.param(exdata);
		$http.post("root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data.success;	 
			console.log(data);  
			if(data == 1) { 
				getCats( $scope.product );	 	   				 
			} else if(data == -1) {
				$scope.myservice.name = $scope.product;
				$location.path('/login');
			}





		}, function myError(response) { 
			console.log(response);
		});

	}

	
	

	function getCats( scopeproduct ) {

		var data = $.param({
			action: 'get-buy',
			product: scopeproduct
		});	
		$http.post("root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data.success; 

			console.log(response.data);

			console.log( data );


			if(data.success == 1){ 
				
				$scope.carts = data.data; 



			} else if(data.success == -1) {
				$location.path('login');

			}else if(data.success == -2) {
				$location.path('login');

			} else {
				console.log('sorry');
			}
			

			console.log($scope.carts);


		}, function myError(response) { 
			console.log(response);
		});

	}


	$timeout( function() { 

	 	//getCats();

	 }, 100);



	$scope.removeThisCart = function( cart){ 

		var index = $scope.carts.indexOf(cart); 
		if(index >-1) { 
			var data = $.param({
				action: 'remove-cart',
				cart: cart.cart
			});	

			$http.post("root/ajax.php", data, config)
			.then(function mySuccess(response) { 
				response =angular.fromJson(response);
				data = response.data.success;  
				if(data == 1){ 	 	  				
					$scope.carts.splice(index, 1);  
				}  else {
					console.log('sorry');
				}

			}, function myError(response) { 
				console.log(response);
			});




		}




	}



	$scope.$watch('carts', function(newVal, oldVal) {
		console.log( $scope.carts);
	});


	$scope.getTotal =  function( carts ) {
		total = 0; 
		angular.forEach(carts, function(value, key) {
			total += (parseInt(value.product.nprice) * parseInt(value.count)) + parseInt(value.charge)
		});
		
	 	 // if( total == 0) $scope.$parent.gCart = { show:false };
	 	 // 	else
	 	 //     $scope.$parent.gCart = {
	 	 //     	show:true,
	 	 //     	price: total,
	 	 //     	count:carts.length
	 	 //     };
	 	 

	 	 return total;
	 	}

	 	$scope.addPrice = function (charge, nprice, count) {
	 		return (parseInt(nprice) * parseInt(count)) + parseInt(charge);
	 	}


	 	$scope.addCount = function(cart, add) {  
	 		cartMax =  Math.max(parseInt(cart['count']) + add , 1); 
	 		cart['count'] =  Math.min(cartMax, 20); 
	 		updateCoutCart(cart);
	 	}


	 	$scope.go = function( product) {
	 		console.log(encodeURIComponent(product), product);
	 		$location.path('/single/' + encodeURIComponent(product));
	 	}

	 	










	 	function updateCoutCart(cart) {
	 		cartid = cart['cart'];
	 		cartcount = cart['count'];

	 		var data = $.param({
	 			action: 'cart-count',
	 			id: cartid,
	 			count: cartcount

	 		});	

	 		$http.post("root/ajax.php", data, config)
	 		.then(function mySuccess(response) { 
	 			response =angular.fromJson(response); 
	 			data = response.data.success;   
	 			if(data >0){ 	 	  				
	 				cart['count'] =  data;  
	 			}  else {
	 				console.log('sorry');
	 			}

	 		}, function myError(response) { 
	 			console.log(response);
	 		});



	 	}


	 	$scope.gotoPaymnt =  function() {
	 		$scope.myservice.value = true;
	 		$scope.myservice.name = $scope.product;
	 		$location.path('payment');
	 	}



	 });








lumieno.controller( 'LumienoControllerAbout', function($scope){ 
	
});







function extractHostname(url) {
	var hostname;
    //find & remove protocol (http, ftp, etc.) and get hostname

    if (url.indexOf("://") > -1) {
    	hostname = url.split('/')[2];
    }
    else {
    	hostname = url.split('/')[0];
    }

    //find & remove port number
    hostname = hostname.split(':')[0];
    //find & remove "?"
    hostname = hostname.split('?')[0];

    return hostname;
}


function validateEmail(email) {
	var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}

















