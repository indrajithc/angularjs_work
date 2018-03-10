var lumieno = angular.module( 'lumieno', ['ngRoute', 'ngAnimate', 'ngProgressLite']); 

var config = {
	headers : {
		'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;',
		'X-Requested-With': 'XMLHttpRequest'
	}
}



lumieno.config([ '$routeProvider', '$locationProvider', function( $routeProvider, $locationProvider ) {
	$routeProvider
	.when('/dashboard', {
		templateUrl: 'pages/home.html',
		controller: 'LumienoController0'
	})
	.when('/about', {
		templateUrl: 'pages/about.html',
		controller: 'LumienoController1'
	})
	.when('/profile', {
		templateUrl: 'pages/profile.html',
		controller: 'LumienoControllerProfile'
	})
	.when('/basic', {
		templateUrl: 'pages/basic.html',
		controller: 'LumienoControllerBasic'
	})
	.when('/email', {
		templateUrl: 'pages/email.html',
		controller: 'LumienoControllerEmail'
	})
	.when('/category', {
		templateUrl: 'pages/category.html',
		controller: 'LumienoControllerCategory'
	})
	.when('/product', {
		templateUrl: 'pages/product.html',
		controller: 'LumienoControllerProduct'
	})
	.when('/details', {
		templateUrl: 'pages/details.html',
		controller: 'LumienoControllerDetails'
	})
	.when('/team', {
		templateUrl: 'pages/team.html',
		controller: 'LumienoControllerTeam'
	})
	.when('/editteam', {
		templateUrl: 'pages/editteam.html',
		controller: 'LumienoControllerEditteam'
	})
	.when('/links', {
		templateUrl: 'pages/links.html',
		controller: 'LumienoControllerLinks'
	})
	.when('/look', {
		templateUrl: 'pages/look.html',
		controller: 'LumienoControllerLook'
	})
	.when('/view', {
		templateUrl: 'pages/view.html',
		controller: 'LumienoControllerView'
	})
	.when('/distributor', {
		templateUrl: 'pages/distributor.html',
		controller: 'LumienoControllerDistributor'
	})
	.when('/editdistributor', {
		templateUrl: 'pages/editdistributor.html',
		controller: 'LumienoControllerEditdistributor'
	})
	.when('/instructions', {
		templateUrl: 'pages/instructions.html',
		controller: 'LumienoControllerInstructions'
	})
	.when('/customer', {
		templateUrl: 'pages/customer.html',
		controller: 'LumienoControllerCustomer'
	})
	.when('/viewcustomer', {
		templateUrl: 'pages/viewcustomer.html',
		controller: 'LumienoControllerViewcustomer'
	})
	.when('/cart', {
		templateUrl: 'pages/cart.html',
		controller: 'LumienoControllerCart'
	})
	.when('/carthistory', {
		templateUrl: 'pages/carthistory.html',
		controller: 'LumienoControllerCartHistory'
	})
	.otherwise({
		redirectTo: '/dashboard'
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
	});


});


/*==================================================>>======================================================*/



lumieno.directive('showTab',
	function () {
		return {
			link: function (scope, element, attrs) {
				element.bind('click', function(e) {
					e.preventDefault();
					$(element).tab('show');
				})

			}
		};
	});


lumieno.controller( 'LumienoControllerProfile', function($timeout, $scope, $http){
	$scope.data = {};
	$scope.disabled = true;
	$scope.images = [];
	$scope.imagesSrc = "../assets/images/default.png";
	$scope.login = {repassword: null};
	$scope.login = {newpassword: null};

	$scope.loginLog = [];





	$timeout( function() {


		var data = $.param({
			action: 'get-Image' 
		});	
		$http.post("../root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data.success;	 

			data.forEach(function(entry) { 
				$scope.images.push({ name: entry });
			});

		}, function myError(response) { 
			console.log(response);
		});

	}, 100);

	$scope.updateImage =  function( userImagesSrc ) { 
		$scope.imagesSrc = "media/images/" + userImagesSrc;
	}

	$timeout( function() {


		var data = $.param({
			action: 'get-admin' 
		});	
		$http.post("../root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			response = response.data.success;
			success = response.success;	
			if(success == 1){
				data = response.data[0];

				$scope.display = data;

				data.mobile = parseInt(data.mobile);
				data.landline = parseInt(data.landline);
				$scope.user = data;

				$scope.imagesSrc = "media/images/" + data.image;
				$scope.displayImags = "media/images/" + data.image;
			}

		}, function myError(response) { 
			console.log(response);
		});

	}, 10);









	$scope.adminProfileSubmit =  function() { 
		var exdata = {
			action: 'update-admin',
			name: $scope.user.name,
			email: $scope.user.email,
			mobile: $scope.user.mobile,
			landline: $scope.user.landline,
			address: $scope.user.address, 
			description: $scope.user.description,
			image: $('#user_image').val()	  

		}
		var data = $.param(exdata);	



		$http.post("../root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data;  
			$scope.display = exdata;
			$scope.displayImags = "media/images/" + exdata.image;

			Lobibox.notify('success', {
				size: 'mini',
				showClass: 'zoomInLeft',
				hideClass: 'zoomOutRight',
				msg: 'successfully updated' ,
				img: $("#loged_in_image").attr("src")
			});

		}, function myError(response) { 
			Lobibox.notify('error', {
				size: 'mini',
				showClass: 'zoomInLeft',
				hideClass: 'zoomOutRight',
				msg: 'make sure that all details are correct, or refresh' ,
				img: $("#loged_in_image").attr("src")
			});
		});
	}





	$scope.$watch( 'login.repassword', function(newdata) {		
		$scope.misMPassword = null; 
		var a =	$scope.login.repassword ;
		var b = $scope.login.newpassword ;
		if ( a && b) 
			if (a != b) { 
				$scope.misMPassword = "Password mismatch";
				$scope.adminLogin.repassword.$invalid = true;
				$scope.adminLogin.$invalid = true;
			}
		});



	$scope.$watch( 'login.newpassword', function(newdata) {		
		$scope.misMPassword = null; 
		var a =	$scope.login.repassword ;
		var b = $scope.login.newpassword ;
		if ( a && b) 
			if (a != b) { 
				$scope.misMPassword = "Password mismatch";
				$scope.adminLogin.repassword.$invalid = true;
				$scope.adminLogin.$invalid = true;
			}
		});


	$scope.$watch( 'login.password', function(newdata) {	
		$scope.errorPassword = null;
	});


	$scope.adminLoginSubmit = function () {


		if ($scope.login.newpassword != $scope.login.repassword) { 
			$scope.misMPassword = "Password mismatch";
			$scope.adminLogin.repassword.$invalid = true;
			$scope.adminLogin.$invalid = true;			 
			return;
		}



		var exdata = {
			action: 'update-login',
			username: $scope.login.username,
			password: $scope.login.password,
			newpassword: $scope.login.newpassword,
			repassword: $scope.login.repassword
		}
		var data = $.param(exdata);	



		$http.post("../root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);


			response = response.data.success;
			success = response.success;	
			if(success == 1){
				Lobibox.notify('success', {
					size: 'mini',
					showClass: 'zoomInLeft',
					hideClass: 'zoomOutRight',
					msg: 'successfully updated' ,
					img: $("#loged_in_image").attr("src")
				});
				$scope.login = {dname: "test"};
			}

			if(success == -1){ 
				$scope.errorPassword = "Your current password is missing or incorrect";
				$scope.adminLogin.password.$invalid = true;
				$scope.adminLogin.$invalid = true;		

			}

			if(success == 0){ 
				Lobibox.notify('error', {
					size: 'mini',
					showClass: 'zoomInLeft',
					hideClass: 'zoomOutRight',
					msg: 'make sure that all details are correct, or refresh' ,
					img: $("#loged_in_image").attr("src")
				});
			}


		}, function myError(response) { 
			Lobibox.notify('error', {
				size: 'mini',
				showClass: 'zoomInLeft',
				hideClass: 'zoomOutRight',
				msg: 'make sure that all details are correct, or refresh' ,
				img: $("#loged_in_image").attr("src")
			});
		});
	}



	$timeout( function() {


		var data = $.param({
			action: 'get-loginlog' 
		});	
		$http.post("../root/ajax.php", data, config)
		.then(function mySuccess(response) { 

			response =angular.fromJson(response);
			response = response.data.success;
			data = response.data;
			success = response.success;	

//	console.log(data);  
if(success == 1){

	data.forEach(function(entry) { 

		$scope.loginLog.push(entry);
	});
}

//console.log($scope.loginLog);








}, function myError(response) { 
	console.log(response);
});

	}, 200);



});



/*==============================================<<==========================================================*/




lumieno.controller( 'LumienoControllerBasic',function($timeout, $scope, $http){


	$timeout( function() {


		var data = $.param({
			action: 'get-basic' 
		});	
		$http.post("../root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			response = response.data.success;
			success = response.success;	
			if(success == 1){
				data = response.data[0]; 
				data.mobile = parseInt(data.mobile);
				data.landline = parseInt(data.landline);
				data.image =  '../images/home/' + data.image;


				$scope.basic = data;


			}

		}, function myError(response) { 
			console.log(response);
		});

	}, 10);




	$scope.adminBasicSubmit =  function() { 
		var exdata = {
			action: 'update-basic',
			address: $scope.basic.address,
			email: $scope.basic.email,
			mobile: $scope.basic.mobile,
			landline: $scope.basic.landline,
			description1: $scope.basic.description1,
			description2: $scope.basic.description2,
			description3: $scope.basic.description3,
			description4: $scope.basic.description4,
			features1H: $scope.basic.features1H,
			features1M: $scope.basic.features1M,
			features2H: $scope.basic.features2H,
			features2M: $scope.basic.features2M,
			features3H: $scope.basic.features3H,
			features3M: $scope.basic.features3M,
			aboutH: $scope.basic.aboutH,
			aboutM: $scope.basic.aboutM,
			aboutHH: $scope.basic.aboutHH,
			aboutMM: $scope.basic.aboutMM,
			vision: $scope.basic.vision,
			mission: $scope.basic.mission, 
			team: $scope.basic.team,
			map: $scope.basic.map,
			mapMsg: $scope.basic.mapMsg,
			image: $('#user_image').val()	  

		}
		var data = $.param(exdata);	



		$http.post("../root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data;   
			Lobibox.notify('success', {
				size: 'mini',
				showClass: 'zoomInLeft',
				hideClass: 'zoomOutRight',
				msg: 'successfully updated' ,
				img: $("#loged_in_image").attr("src")
			});

		}, function myError(response) { 
			Lobibox.notify('error', {
				size: 'mini',
				showClass: 'zoomInLeft',
				hideClass: 'zoomOutRight',
				msg: 'make sure that all details are correct, or refresh' ,
				img: $("#loged_in_image").attr("src")
			});
		});
	}





});





lumieno.controller( 'LumienoControllerEmail',function($timeout, $scope, $http, $filter){
	$timeout( function(){
		var data = $.param({
			action: 'get-emails' 
		});	
		$http.post("../root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data.success;	 

			if(data.success == 1) { 
				$scope.emails = []; 
				data.data.forEach(function(entry) { 

					$scope.emails.push({ name: entry.name,
						email: entry.email,
						telephone: entry.telephone, 
						message: entry.message,
						client: entry.client,    				   						 
						date: entry.datea
					});
				});

			}

		}, function myError(response) { 
			console.log(response);
		});

	}, 100);


	$scope.sortTable = function( name, order = false) {
		$scope.emails = $filter('orderBy')($scope.emails, name, order);
		$scope.emailss = {temp: true };
		switch( name) {
			case 'name' :
			$scope.emailss = {name: true };
			break;
			case 'email' :
			$scope.emailss = {email: true };
			break;
			case 'telephone' :
			$scope.emailss = {telephone: true };
			break;
			case 'message' :
			$scope.emailss = {message: true };
			break;
			case 'client' :
			$scope.emailss = {client: true };
			break;

			case 'date' :
			$scope.emailss = {date: true };
		}

		return !order;	 

	}

});



lumieno.controller( 'LumienoControllerCategory', function($timeout, $scope, $http){

	$scope.disabled = true;

	$scope.images = [];
	$scope.imagesSrc2 = $scope.imagesSrc1 = "../assets/images/default.png";


	$timeout( function() {


		var data = $.param({
			action: 'get-cat-Image' 
		});	
		$http.post("../root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data.success;	 

			data.forEach(function(entry) { 
				$scope.images.push({ name: entry });
			});

		}, function myError(response) { 
			console.log(response);
		});

	}, 100);


	$scope.updateImage =  function( userImagesSrc ) { 
		$scope.imageSrc1 = "../images/category/" + userImagesSrc;

	}

	$scope.updateEditImage =  function( categoryy, userImagesSrc ) { 
		categoryy.imageName = "../images/category/" + userImagesSrc;
	}

	$timeout( function(){
		var data = $.param({
			action: 'get-category' 
		});	
		$http.post("../root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data.success;	  
			if(data.success == 1) { 
				$scope.categorys = []; 
				data.data.forEach(function(entry) { 

					$scope.categorys.push({ id: entry.name,
						name: entry.name,
						description: entry.description,
						image: entry.image, 
						imageName: '../images/category/' + entry.image,  
						client: entry.client,    				   						 
						date: entry.datea,
						delete: entry.deleted
					});
				});

			}

		}, function myError(response) { 
			console.log(response);
		});

	}, 100);








	$scope.categorySubmit =  function() { 
		var exdata = {
			action: 'add-category',
			name: $scope.category.name, 
			description: $scope.category.description,
			image: $('#user_image').val()	  

		}
		var data = $.param(exdata);	


		$scope.categoryProfile.$invalid = false;


		$http.post("../root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data;   
			success = data.success;	 
			if(success == 1){

				$scope.categorys.push({ 
					name:  $scope.category.name,
					description: $scope.category.description,
					image: $('#user_image').val(), 
					imageName: '../images/category/' + $('#user_image').val(),  
					client: 'refresh',    				   						 
					date: getFormattedDate(),
					delete: $scope.category.delete
				});


				$scope.imageSrc1 = '../assets/images/default.png';
				$('#user_image').val("");

				$scope.category = {temp:true}; 
				Lobibox.notify('success', {
					size: 'mini',
					showClass: 'zoomInLeft',
					hideClass: 'zoomOutRight',
					msg: 'successfully added' ,
					img: $("#loged_in_image").attr("src")
				});

				$scope.categoryProfile.$invalid = true;
			} 

			if(success == -1){
				console.log(success);
				Lobibox.notify('warning', {
					size: 'mini',
					showClass: 'zoomInLeft',
					hideClass: 'zoomOutRight',
					msg: 'category already exists' ,
					img: $("#loged_in_image").attr("src")
				});
				$scope.nameError = "category already exists ";

			}



		}, function myError(response) { 
			Lobibox.notify('error', {
				size: 'mini',
				showClass: 'zoomInLeft',
				hideClass: 'zoomOutRight',
				msg: 'make sure that all details are correct, or refresh' ,
				img: $("#loged_in_image").attr("src")
			});
		});
	}




	$scope.editCategory = function(categoryz) {
		$scope.categorys.forEach(function(item) {
			if (item.show) { item.show = false;}
		});
		categoryz['show'] = true;
	}

	$scope.dismissThis =  function(categoryy) {
		categoryy.show = false;
	}


	$scope.categoryUpdateSubmit = function( categoryu) {

		$scope.categorys.forEach(function(item) {
			if (item.show) { item.show = false;}
		});

		var exdata = {
			action: 'edit-category',
			name: categoryu.name, 
			description: categoryu.description,
			delete: categoryu.delete,
			image: categoryu.image	  

		}
		var data = $.param(exdata);	




		$http.post("../root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data;   

			success = data.success;	 
			if(success == 1){ 

				$scope.category = {temp:true}; 
				Lobibox.notify('success', {
					size: 'mini',
					showClass: 'zoomInLeft',
					hideClass: 'zoomOutRight',
					msg: 'successfully updated' ,
					img: $("#loged_in_image").attr("src")
				});

			} else if(success == -1){

				$scope.nameError = "category already exists ";
				Lobibox.notify('warning', {
					size: 'mini',
					showClass: 'zoomInLeft',
					hideClass: 'zoomOutRight',
					msg: 'category already exists' ,
					img: $("#loged_in_image").attr("src")
				});
			}



		}, function myError(response) { 
			Lobibox.notify('error', {
				size: 'mini',
				showClass: 'zoomInLeft',
				hideClass: 'zoomOutRight',
				msg: 'make sure that all details are correct, or refresh' ,
				img: $("#loged_in_image").attr("src")
			});
		});








	}


});




lumieno.controller( 'LumienoControllerProduct', function($timeout, $scope, $http, $location, myservice){
	$scope.myservice = myservice;
// /
$timeout( function(){
	var data = $.param({
		action: 'get-product' 
	});	
	$http.post("../root/ajax.php", data, config)
	.then(function mySuccess(response) { 
		response =angular.fromJson(response);
		data = response.data.success;	  
		if(data.success == 1) { 
			$scope.productzs = []; 
			data.data.forEach(function(entry) {  
				if( entry.deleted !=1 )
					$scope.productzs.push({ 
						name: entry.name,
						category: entry.category,
						oprice: entry.oprice, 
						nprice: entry.nprice,  
						count: entry.count,    				   						 
						new: entry.new,
						rate: entry.rate,
						date: entry.date,
						deletes: entry.deletes
					});

			});

		}

	}, function myError(response) { 
		console.log(response);
	});

}, 100);		


$timeout( function(){
	var data = $.param({
		action: 'get-category' 
	});	
	$http.post("../root/ajax.php", data, config)
	.then(function mySuccess(response) { 
		response =angular.fromJson(response);
		data = response.data.success;	  
		if(data.success == 1) { 
			$scope.categorys = []; 
			data.data.forEach(function(entry) { 
				if( entry.deleted !=1 )
					$scope.categorys.push({ id: entry.id,
						name: entry.name,
						description: entry.description,
						image: entry.image, 
						imageName: '../images/category/' + entry.image,  
						client: entry.client,    				   						 
						date: entry.datea,
						delete: entry.deleted
					});
			});

		}

	}, function myError(response) { 
		console.log(response);
	});

}, 100);

// ===========================================================//



$scope.productSubmit = function() {

	eGimages = [];
	$images = null;
	$('.gallery-upladed').find('img').each(function() {
		eGimages.push({ name: this.name});
	});
	$images = JSON.stringify(eGimages);




	var exdata = {
		action: 'add-product',
		category: $scope.product.categoryl.id ,
		name: $scope.product.name ,
		oldPrice: $scope.product.oldPrice ,
		newPrice: $scope.product.newPrice ,
		count: $scope.product.count ,
		new: $scope.product.new ,
		rating: $scope.product.rating ,
		description: $scope.product.description ,
		images: $images

	}
	var data = $.param(exdata);	


	$http.post("../root/ajax.php", data, config)
	.then(function mySuccess(response) { 
		response =angular.fromJson(response);
		data = response.data;   
		console.log(data);
		success = data.success;	 
		if(success == 1){ 

			$scope.productzs.push({ 
				name: $scope.product.name,
				category: $scope.product.categoryl.name,
				oprice: $scope.product.oldPrice, 
				nprice: $scope.product.newPrice,  
				count: $scope.product.count,    				   						 
				new: ($scope.product.new == true ? 1: 0) ,
				rate: $scope.product.rating ,
				date: getFormattedDate(),
				deletes: '0'
			});


			$scope.product = {temp:true}; 
			$('.gallery-upladed').empty();
			Lobibox.notify('success', {
				size: 'mini',
				showClass: 'zoomInLeft',
				hideClass: 'zoomOutRight',
				msg: 'successfully updated' ,
				img: $("#loged_in_image").attr("src")
			});

		} else if(success == -1){

			$scope.nameError = "product already exists ";
			Lobibox.notify('warning', {
				size: 'mini',
				showClass: 'zoomInLeft',
				hideClass: 'zoomOutRight',
				msg: 'category already exists' ,
				img: $("#loged_in_image").attr("src")
			});
		}



	}, function myError(response) { 
		Lobibox.notify('error', {
			size: 'mini',
			showClass: 'zoomInLeft',
			hideClass: 'zoomOutRight',
			msg: 'make sure that all details are correct, or refresh' ,
			img: $("#loged_in_image").attr("src")
		});
	});



}



$scope.editproductz = function( productz ) {
	$scope.myservice.name = productz.name;
	$location.path('details');
}



});


lumieno.service('myservice', function() {
	this.name = null;
});


lumieno.controller( 'LumienoControllerDetails', function($timeout, $scope, $http, $location,  myservice){
	$scope.myservice = myservice;
	product = $scope.myservice.name;
	if(product == null){		
		$location.path('product');
		return;
	}

	$scope.myservice.name =  null;

	$scope.backToPro = function() {
		$location.path('product');
	}
	$timeout( function(){
		var data = $.param({
			action: 'get-category' 
		});	
		$http.post("../root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data.success;	  
			if(data.success == 1) { 
				$scope.categorys = []; 
				data.data.forEach(function(entry) { 
					if( entry.deleted !=1 )
						$scope.categorys.push({ id: entry.id,
							name: entry.name,
							description: entry.description,
							image: entry.image, 
							imageName: '../images/category/' + entry.image,  
							client: entry.client,    				   						 
							date: entry.datea,
							delete: entry.deleted
						});
				});

			}

		}, function myError(response) { 
			console.log(response);
		});

	}, 100);



	$timeout( function(){
		var data = $.param({
			action: 'get-product-details' ,
			product: product
		});	
		$http.post("../root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data.success;	  
			if(data.success == 1) { 
				entry = data.data[0];
				console.log(entry);
				$scope.display = { 
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
					client: entry.client,
					date: entry.date,
					deletes: entry.deletes,
					deletedd:(entry.deletes == 1 ? true: false)
				};


			}


			$scope.images = []; 

			if( data.image) 
				data.image.forEach(function(entry) { 
					$scope.images.push({  
						name: entry.name ,
						path: '../images/products/' + entry.name 
					});
				});

			console.log($scope.images);



		}, function myError(response) { 
			console.log(response);
		});

	}, 100);


	$timeout( function(){
		var data = $.param({
			action: 'get-product-specification' ,
			product: product
		});	
		$http.post("../root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data.success;
			$scope.specificationb = [];	  
			if(data.success == 1) { 
				data = data.data; 
				if( data) 
					data.forEach(function(entry) { 
						$scope.specificationb.push({  
							name: entry.name ,
							value: entry.value 
						});
					});

			}




		}, function myError(response) { 
			console.log(response);
		});

	}, 100);




	$scope.updateSubmit = function(){

		eGimages = [];
		$images = null;
		$('.gallery-upladed').find('img').each(function() {
			eGimages.push({ name: this.name});
		});
		$images = JSON.stringify(eGimages);

		var exdata = {
			action: 'update-product',
			category: $scope.display.category_id ,
			name: $scope.display.name ,
			oldPrice: $scope.display.oprice ,
			newPrice: $scope.display.nprice ,
			count: $scope.display.count ,
			new: $scope.display.new ,
			rating: $scope.display.rate ,
			description: $scope.display.description ,
			images: $images,
			delete: $scope.display.deletedd 


		}
		var data = $.param(exdata);	


		$http.post("../root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data;   
			console.log(data);
			success = data.success;	 
			if(success == 1){ 

				$scope.display = {temp:true}; 
				$('.gallery-upladed').empty();
				Lobibox.notify('success', {
					size: 'mini',
					showClass: 'zoomInLeft',
					hideClass: 'zoomOutRight',
					msg: 'successfully updated' ,
					img: $("#loged_in_image").attr("src")
				});
				$location.path('product');

			} else if(success == -1){

				$scope.nameError = "product not exists ";
				Lobibox.notify('warning', {
					size: 'mini',
					showClass: 'zoomInLeft',
					hideClass: 'zoomOutRight',
					msg: 'category already exists' ,
					img: $("#loged_in_image").attr("src")
				});
			}



		}, function myError(response) { 
			Lobibox.notify('error', {
				size: 'mini',
				showClass: 'zoomInLeft',
				hideClass: 'zoomOutRight',
				msg: 'make sure that all details are correct, or refresh' ,
				img: $("#loged_in_image").attr("src")
			});
		});







	}

	$scope.specificationSubmit = function() {

		var exdata = {
			action: 'add-specification',
			product: $scope.display.name ,
			name: $scope.specificationz.name ,
			value: $scope.specificationz.value  

		}
		var data = $.param(exdata);	

		$http.post("../root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data;   
			console.log(data);
			success = data.success;	 
			if(success == 1){ 
				$scope.specificationb.push({  
					name: $scope.specificationz.name ,
					value: $scope.specificationz.value 
				});
				$scope.specificationz = {temp:true}; 

				Lobibox.notify('success', {
					size: 'mini',
					showClass: 'zoomInLeft',
					hideClass: 'zoomOutRight',
					msg: 'successfully updated' ,
					img: $("#loged_in_image").attr("src")
				}); 

			} else if(success == -1){

				$scope.nameError = "product not exists ";
				Lobibox.notify('warning', {
					size: 'mini',
					showClass: 'zoomInLeft',
					hideClass: 'zoomOutRight',
					msg: 'category already exists' ,
					img: $("#loged_in_image").attr("src")
				});
			}



		}, function myError(response) { 
			Lobibox.notify('error', {
				size: 'mini',
				showClass: 'zoomInLeft',
				hideClass: 'zoomOutRight',
				msg: 'make sure that all details are correct, or refresh' ,
				img: $("#loged_in_image").attr("src")
			});
		});






	}




	$scope.removeAspecifications =  function( specification ) {


		var exdata = {
			action: 'remove-specification',
			product: $scope.display.name ,
			name: specification.name ,
			value: specification.value  

		}
		var data = $.param(exdata);	

		$http.post("../root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data;   
			console.log(data);
			success = data.success;	 
			if(success == 1){ 

				var index = $scope.specificationb.indexOf(specification);
				$scope.specificationb.splice(index, 1);   

				Lobibox.notify('success', {
					size: 'mini',
					showClass: 'zoomInLeft',
					hideClass: 'zoomOutRight',
					msg: 'successfully updated' ,
					img: $("#loged_in_image").attr("src")
				}); 

			} else if(success == -1){

				$scope.nameError = "product not exists ";
				Lobibox.notify('warning', {
					size: 'mini',
					showClass: 'zoomInLeft',
					hideClass: 'zoomOutRight',
					msg: 'product not exists ' ,
					img: $("#loged_in_image").attr("src")
				});
			}



		}, function myError(response) { 
			Lobibox.notify('error', {
				size: 'mini',
				showClass: 'zoomInLeft',
				hideClass: 'zoomOutRight',
				msg: 'make sure that all details are correct, or refresh' ,
				img: $("#loged_in_image").attr("src")
			});
		});






	}





});







lumieno.controller( 'LumienoControllerTeam', function($timeout, $scope, $http, $location, myservice){
	$scope.myservice = myservice; 

	$scope.editTeam = function( team ) {
		$scope.myservice.name = team.email;
		$location.path('editteam');
	}

	$scope.editLinks = function( team ) {
		$scope.myservice.name = team.email;
		$location.path('links');
	}



	$timeout( function(){
		var data = $.param({
			action: 'get-team' 
		});	
		$http.post("../root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data.success;	  
			if(data.success == 1) { 
				$scope.teams = []; 
				data.data.forEach(function(entry) {   		
					$scope.teams.push({ 
						name: entry.name,
						type: entry.type,
						position: entry.position,
						email: entry.email,
						mobile: entry.mobile,
						landline: entry.landline,
						address: entry.address,
						website: entry.website,
						description: entry.description,
						image: entry.image, 
						imageName: '../images/team/' + entry.image,   
						delete: entry.deletes,
						date: entry.date
					});
				});

			}

			console.log($scope.teams);

		}, function myError(response) { 
			console.log(response);
		});

	}, 100);


	$scope.teamProfileSubmit = function(){
		var exdata = {
			action: 'add-team',
			name: $scope.user.name,
			position: $scope.user.position,
			email: $scope.user.email,
			mobile: $scope.user.mobile,
			landline: $scope.user.landline,
			address: $scope.user.address,
			website: $scope.user.website,
			description: $scope.user.description,
			image: $('#user_image').val()	  

		}
		var data = $.param(exdata);	
		$http.post("../root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data;    
			success = data.success;	 
			if(success == 1){ 
				$scope.teams.push({ 
					name: $scope.user.name,
					type: 3,
					position: $scope.user.position,
					email: $scope.user.email,
					mobile: $scope.user.mobile,
					landline: $scope.user.landline,
					address: $scope.user.address,
					website: $scope.user.website,
					description: $scope.user.description,
					image: $('#user_image').val(), 
					imageName: '../images/team/' + $('#user_image').val(),   
					delete: 0,
					date: getFormattedDate()
				});
				$('#user_image').val("?");

				$scope.imagesSrc = "../assets/images/default.png";

				Lobibox.notify('success', {
					size: 'mini',
					showClass: 'zoomInLeft',
					hideClass: 'zoomOutRight',
					msg: 'successfully updated' ,
					img: $("#loged_in_image").attr("src")
				}); 

			} else {

				$scope.nameError = " ";
				Lobibox.notify('warning', {
					size: 'mini',
					showClass: 'zoomInLeft',
					hideClass: 'zoomOutRight',
					msg: 'email or mobile already exists' ,
					img: $("#loged_in_image").attr("src")
				});
			}



		}, function myError(response) { 
			Lobibox.notify('error', {
				size: 'mini',
				showClass: 'zoomInLeft',
				hideClass: 'zoomOutRight',
				msg: 'make sure that all details are correct, or refresh' ,
				img: $("#loged_in_image").attr("src")
			});
		});


	};
});





lumieno.controller( 'LumienoControllerEditteam', function($timeout, $scope, $http, $location, myservice){
	$scope.myservice = myservice;
	member = $scope.myservice.name;
	if(member == null){		
		$location.path('team');
		return;
	}

	$scope.myservice.name =  null;

	$scope.backToPro = function() {
		$location.path('team');
	}

	$timeout( function(){
		var data = $.param({
			action: 'get-team-one' ,
			member: member
		});	
		$http.post("../root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data.success;	  
			if(data.success == 1) { 
				entry = data.data[0];



				$scope.user = { 
					name: entry.name,
					type: entry.type,
					position: entry.position,
					email: entry.email,
					mobile: parseInt(entry.mobile),
					landline: parseInt(entry.landline),
					address: entry.address,
					website: entry.website,
					description: entry.description,
					image: entry.image, 
					imageName: '../images/team/' + entry.image,   
					delete: entry.deletes,
					date: entry.date,
					deletedd:(entry.deletes == 1 ? true: false),
					images:[{name: entry.image}]
				};
				$scope.imagesSrc = '../images/team/' + entry.image;

			}

			console.log($scope.user);

		}, function myError(response) { 
			console.log(response);
		});

	}, 100);




	$scope.teamUpdateSubmit =  function() {
		var exdata = {
			action: 'update-team',
			name: $scope.user.name,
			position: $scope.user.position,
			email: $scope.user.email,
			mobile: $scope.user.mobile,
			landline: $scope.user.landline,
			address: $scope.user.address,
			website: $scope.user.website,
			description: $scope.user.description,
			delete:$scope.user.deletedd ,
			image: $('#user_image').val()	  

		}
		var data = $.param(exdata);	
		$http.post("../root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data;    
			console.log(data);
			success = data.success;	 
			if(success == 1){ 

				$scope.backToPro();

				Lobibox.notify('success', {
					size: 'mini',
					showClass: 'zoomInLeft',
					hideClass: 'zoomOutRight',
					msg: 'successfully updated' ,
					img: $("#loged_in_image").attr("src")
				}); 

			} else {

				$scope.nameError = " ";
				Lobibox.notify('warning', {
					size: 'mini',
					showClass: 'zoomInLeft',
					hideClass: 'zoomOutRight',
					msg: 'email not exists' ,
					img: $("#loged_in_image").attr("src")
				});
			}



		}, function myError(response) { 
			Lobibox.notify('error', {
				size: 'mini',
				showClass: 'zoomInLeft',
				hideClass: 'zoomOutRight',
				msg: 'make sure that all details are correct, or refresh' ,
				img: $("#loged_in_image").attr("src")
			});
		});




	}









});




lumieno.controller( 'LumienoControllerLinks', function($timeout, $scope, $http, $location, myservice){
	$scope.myservice = myservice;
	member = $scope.myservice.name;
	if(member == null){		
		$scope.member = null;
		$scope.memberName = 'lumieno';
	}
	$scope.myservice.name =  null;

	$scope.backToPro = function() {
		$location.path('team');
	}

	$timeout( function(){
		var data = $.param({
			action: 'get-team-one' ,
			member: member
		});	
		$http.post("../root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data.success;	  
			if(data.success == 1) { 
				entry = data.data[0];



				$scope.user = { 
					name: entry.name,
					type: entry.type,
					position: entry.position,
					email: entry.email,
					mobile: parseInt(entry.mobile),
					landline: parseInt(entry.landline),
					address: entry.address,
					website: entry.website,
					description: entry.description,
					image: entry.image, 
					imageName: '../images/team/' + entry.image,   
					delete: entry.deletes,
					date: entry.date,
					deletedd:(entry.deletes == 1 ? true: false),
					images:[{name: entry.image}]
				};

				$scope.memberName = entry.name;

			}


		}, function myError(response) { 
			console.log(response);
		});

	}, 100);


	$timeout( function(){
		var data = $.param({
			action: 'get-link',
			user:  member

		});	
		$http.post("../root/ajax.php", data, config)
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
							icon: entry.icon,   				   						 
							date: entry.date 
						});
				});

			}

		}, function myError(response) { 
			console.log(response);
		});

	}, 100);








	$scope.linkSubmit = function() {


		var exdata = {
			action: 'add-link',
			name: $scope.link.name, 
			url: $scope.link.url ,
			icon: $scope.link.icon,
			user:  member

		}
		var data = $.param(exdata);	


		$scope.linkProfile.$invalid = false;


		$http.post("../root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data;   
			success = data.success;	 
			if(success == 1){

				$scope.links.push({ 
					name: $scope.link.name,
					url: $scope.link.url,
					icon: $scope.link.icon,   				   						 
					date: getFormattedDate()
				});

				$scope.link = {temp:true}; 
				Lobibox.notify('success', {
					size: 'mini',
					showClass: 'zoomInLeft',
					hideClass: 'zoomOutRight',
					msg: 'successfully added' ,
					img: $("#loged_in_image").attr("src")
				});

				$scope.linkProfile.$invalid = true;
			} 

			if(success == -1){
				console.log(success);
				Lobibox.notify('warning', {
					size: 'mini',
					showClass: 'zoomInLeft',
					hideClass: 'zoomOutRight',
					msg: 'link already exists' ,
					img: $("#loged_in_image").attr("src")
				});
				$scope.nameError = "category already exists ";

			}



		}, function myError(response) { 
			Lobibox.notify('error', {
				size: 'mini',
				showClass: 'zoomInLeft',
				hideClass: 'zoomOutRight',
				msg: 'make sure that all details are correct, or refresh' ,
				img: $("#loged_in_image").attr("src")
			});
		});

	}


	$scope.removelink =  function( link) {



		var exdata = {
			action: 'update-link',
			name: link.name,  
			user:  member

		}
		var data = $.param(exdata);	


		$scope.linkProfile.$invalid = false;


		$http.post("../root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data;    
			success = data.success;	 
			if(success == 1){




				var index = $scope.links.indexOf(link);
				$scope.links.splice(index, 1); 


				$scope.link = {temp:true}; 
				Lobibox.notify('success', {
					size: 'mini',
					showClass: 'zoomInLeft',
					hideClass: 'zoomOutRight',
					msg: 'successfully added' ,
					img: $("#loged_in_image").attr("src")
				});

				$scope.linkProfile.$invalid = true;
			} 

			if(success == -1){
				console.log(success);
				Lobibox.notify('warning', {
					size: 'mini',
					showClass: 'zoomInLeft',
					hideClass: 'zoomOutRight',
					msg: 'user doesn`t exists' ,
					img: $("#loged_in_image").attr("src")
				});
				$scope.nameError = "category already exists ";

			}



		}, function myError(response) { 
			Lobibox.notify('error', {
				size: 'mini',
				showClass: 'zoomInLeft',
				hideClass: 'zoomOutRight',
				msg: 'make sure that all details are correct, or refresh' ,
				img: $("#loged_in_image").attr("src")
			});
		});



	}



});





lumieno.controller( 'LumienoControllerLook', function($timeout, $scope, $http, $location, myservice){

	$timeout( function(){
		var data = $.param({
			action: 'get-look' 
		});	
		$http.post("../root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data.success;	  
			if(data.success == 1) {
				$scope.look = []; 
				products = data.products;
				data = data.data[0]; 
				$scope.look = {

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

					image1 : data.image1,
					image2 : data.image2,
					image3 : data.image3,

					products: products.data

				};

			}

		}, function myError(response) { 
			console.log(response);
		});

	}, 100);		







	$scope.lookSubmit = function() {




		var exdata = {
			action: 'update-look',
			product1: $scope.look.name1,
			product2: $scope.look.name2,
			product3: $scope.look.name3,

			description1: $scope.look.description1,
			description2: $scope.look.description2,
			description3: $scope.look.description3,
			description4: $scope.look.description4,

			description5: $scope.look.description5,
			description6: $scope.look.description6,
			description7: $scope.look.description7,
			description8: $scope.look.description8,

			description9: $scope.look.description9,
			description10: $scope.look.description10,
			description11: $scope.look.description11,
			description12: $scope.look.description12,
			description13: $scope.look.description13,
			description14: $scope.look.description14,

			image1:  $('#user_image1').val(),
			image2: $('#user_image2').val(),
			image3: $('#user_image3').val()

		}
		var data = $.param(exdata);	


		$scope.lookProfile.$invalid = false;


		$http.post("../root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);

			data = response.data.success;     
			success = data.success;	 
			if(success == 1){


				$scope.link = {temp:true}; 
				Lobibox.notify('success', {
					size: 'mini',
					showClass: 'zoomInLeft',
					hideClass: 'zoomOutRight',
					msg: 'successfully added' ,
					img: $("#loged_in_image").attr("src")
				});

				$scope.lookProfile.$invalid = true;
			} 

			if(success == -1){
				console.log(success);
				Lobibox.notify('warning', {
					size: 'mini',
					showClass: 'zoomInLeft',
					hideClass: 'zoomOutRight',
					msg: 'value doesn`t exists' ,
					img: $("#loged_in_image").attr("src")
				});
				$scope.nameError = "category already exists ";

			}



		}, function myError(response) { 
			Lobibox.notify('error', {
				size: 'mini',
				showClass: 'zoomInLeft',
				hideClass: 'zoomOutRight',
				msg: 'make sure that all details are correct, or refresh' ,
				img: $("#loged_in_image").attr("src")
			});
		});





	}


});





lumieno.controller( 'LumienoControllerView', function($timeout, $scope, $http, $location, $filter, myservice){

	$timeout( function(){
		var data = $.param({
			action: 'get-views' 
		});	
		$http.post("../root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data.success;	  
			if(data.success == 1) { 
				$scope.views = []; 
				$id = 1;
				data.data.forEach(function(entry) { 

					$scope.views.push({  id:$id,
						ip: entry.client,
						tf: entry.ffdate,
						tt: entry.lldate, 
						t: entry.dtime,
						browser: entry.browser,    				   						 
						os: entry.os
					});
					$id++;
				});

			}

		}, function myError(response) { 
			console.log(response);
		});

	}, 100);



	$scope.sortTable = function( name, order = false) {
		$scope.views = $filter('orderBy')($scope.views, name, order);
		$scope.viewss = {temp: true };
		switch( name) {
			case 'ip' :
			$scope.viewss = {ip: true };
			break;
			case 'tf' :
			$scope.viewss = {tf: true };
			break;
			case 'tt' :
			$scope.viewss = {tt: true };
			break;
			case 't' :
			$scope.viewss = {t: true };
			break;
			case 'browser' :
			$scope.viewss = {browser: true };
			break;

			case 'os' :
			$scope.viewss = {os: true };
		}

		return !order;	 

	}


});







lumieno.controller( 'LumienoControllerDistributor', function($timeout, $scope, $http, $location, myservice){
	$scope.myservice = myservice; 

	$scope.editdistributor = function( distributor ) {
		$scope.myservice.name = distributor.email;
		$location.path('editdistributor');
	}





	$timeout( function(){
		var data = $.param({
			action: 'get-distributor' 
		});	
		$http.post("../root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response); 
			data = response.data.success;	  
			if(data.success == 1) { 
				$scope.distributors = []; 
				data.data.forEach(function(entry) {   		
					$scope.distributors.push({ 
						name: entry.name, 
						dob: entry.dob,
						email: entry.email,
						mobile: entry.mobile,
						landline: entry.landline,
						address: entry.address,
						pin: entry.pin,
						description: entry.description,
						image: entry.image, 
						imageName: '../distributor/media/images/' + entry.image,   
						delete: entry.deletes,
						date: entry.date
					});
				});

			}


		}, function myError(response) { 
			console.log(response);
		});

	}, 100);





	$scope.distributorProfileSubmit = function(){
		var exdata = {
			action: 'add-distributor',
			password: $scope.distributor.password,
			name: $scope.distributor.name,
			dob: $('#dob').val(),
			email: $scope.distributor.email,
			mobile: $scope.distributor.mobile,
			landline: $scope.distributor.landline,
			address: $scope.distributor.address,
			pin: $scope.distributor.pin,
			description: $scope.distributor.description,
			image: $('#user_image').val()	  

		}
		var data = $.param(exdata);	
		$http.post("../root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data;    
			success = data.success;	 
			if(success == 1){ 
				$scope.distributors.push({ 
					name: $scope.distributor.name, 
					dob: $('#dob').val(),
					email: $scope.distributor.email,
					mobile: $scope.distributor.mobile,
					landline: $scope.distributor.landline,
					address: $scope.distributor.address,
					pin: $scope.distributor.pin,
					description: $scope.distributor.description,
					image: $('#user_image').val(), 
					imageName: '../distributor/media/images/' + $('#user_image').val(),   
					delete: 0,
					date: getFormattedDate()
				});
				$('#user_image').val("?");
				$('#dob').val("");
				$scope.imagesSrc = "../assets/images/default.png";

				Lobibox.notify('success', {
					size: 'mini',
					showClass: 'zoomInLeft',
					hideClass: 'zoomOutRight',
					msg: 'successfully updated' ,
					img: $("#loged_in_image").attr("src")
				}); 

			} else {

				$scope.nameError = " ";
				Lobibox.notify('warning', {
					size: 'mini',
					showClass: 'zoomInLeft',
					hideClass: 'zoomOutRight',
					msg: 'email or mobile already exists' ,
					img: $("#loged_in_image").attr("src")
				});
			}



		}, function myError(response) { 
			Lobibox.notify('error', {
				size: 'mini',
				showClass: 'zoomInLeft',
				hideClass: 'zoomOutRight',
				msg: 'make sure that all details are correct, or refresh' ,
				img: $("#loged_in_image").attr("src")
			});
		});


	};


});






lumieno.controller( 'LumienoControllerEditdistributor', function($timeout, $scope, $http, $location, myservice){
	$scope.myservice = myservice;
	member = $scope.myservice.name;
	if(member == null){		
		$location.path('distributor');
		return;
	}
	$scope.myservice.name =  null;


	$scope.backToPro = function() {
		$location.path('distributor');
	}

	$timeout( function(){
		var data = $.param({
			action: 'get-distributor-one' ,
			member: member
		});	
		$http.post("../root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data.success;	  
			if(data.success == 1) { 
				entry = data.data[0];


				$scope.distributor = { 
					name: entry.name, 
					dob: entry.dob,
					email: entry.email,
					mobile: parseInt(entry.mobile),
					landline: parseInt(entry.landline),
					address: entry.address,
					pin: entry.pin,
					description: entry.description,
					image: entry.image, 
					imageName: '../distributor/media/images/' + entry.image,   
					delete: entry.deletes,
					date: entry.date,
					deletedd:(entry.deletes == 1 ? true: false),
					images:[{name: entry.image}]
				};
				$scope.imagesSrc = '../distributor/media/images/' + entry.image;

			}

			console.log($scope.distributor);

		}, function myError(response) { 
			console.log(response);
		});

	}, 100);




	$scope.distributorUpdateSubmit =  function() {
		var exdata = {
			action: 'update-distributor',
			password: $scope.distributor.password,
			name: $scope.distributor.name,
			dob: $('#dob').val(),
			email: $scope.distributor.email,
			mobile: $scope.distributor.mobile,
			landline: $scope.distributor.landline,
			address: $scope.distributor.address,
			pin: $scope.distributor.pin,
			description: $scope.distributor.description, 
			delete:$scope.distributor.deletedd ,
			image: $('#user_image').val()	  

		}
		var data = $.param(exdata);	
		$http.post("../root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data;    
			console.log(data);
			success = data.success;	 
			if(success == 1){ 

				$scope.backToPro();

				Lobibox.notify('success', {
					size: 'mini',
					showClass: 'zoomInLeft',
					hideClass: 'zoomOutRight',
					msg: 'successfully updated' ,
					img: $("#loged_in_image").attr("src")
				}); 

			} else {

				$scope.nameError = " ";
				Lobibox.notify('warning', {
					size: 'mini',
					showClass: 'zoomInLeft',
					hideClass: 'zoomOutRight',
					msg: 'email not exists' ,
					img: $("#loged_in_image").attr("src")
				});
			}



		}, function myError(response) { 
			Lobibox.notify('error', {
				size: 'mini',
				showClass: 'zoomInLeft',
				hideClass: 'zoomOutRight',
				msg: 'make sure that all details are correct, or refresh' ,
				img: $("#loged_in_image").attr("src")
			});
		});




	}












});






lumieno.controller( 'LumienoControllerInstructions', function($timeout, $scope, $http, $location, myservice){
	$scope.instructions = [];

	$timeout( function(){ 

		var data = $.param({
			action: 'get-instructions-admin' 
		});	
		$http.post("../root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data.success;
			console.log(response.data);	  
			if(data.success == 1) { 
				$scope.instructions = data.data;

			}

			console.log($scope.distributor);

		}, function myError(response) { 
			console.log(response);
		});



	}, 100);

	$scope.removeMe =  function(instruction) {

		var exdata = {
			action: 'remove-instructions', 
			description: instruction.description

		}
		var data = $.param(exdata);	
		$http.post("../root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);

			data = response.data;   



			success = data.success;	 
			if(success == 1){ 


				var index = $scope.instructions.indexOf(instruction);
				$scope.instructions.splice(index, 1); 

				Lobibox.notify('success', {
					size: 'mini',
					showClass: 'zoomInLeft',
					hideClass: 'zoomOutRight',
					msg: 'successfully updated' ,
					img: $("#loged_in_image").attr("src")
				}); 


			} else {

				$scope.nameError = " ";
				Lobibox.notify('warning', {
					size: 'mini',
					showClass: 'zoomInLeft',
					hideClass: 'zoomOutRight',
					msg: 'email not exists' ,
					img: $("#loged_in_image").attr("src")
				});
			}



		}, function myError(response) { 
			Lobibox.notify('error', {
				size: 'mini',
				showClass: 'zoomInLeft',
				hideClass: 'zoomOutRight',
				msg: 'make sure that all details are correct, or refresh' ,
				img: $("#loged_in_image").attr("src")
			});
		});



	}



	$scope.instructionSubmit = function() {
		var exdata = {
			action: 'add-instructions',
			type: $scope.instruction.type,
			description: $scope.instruction.description

		}
		var data = $.param(exdata);	
		$http.post("../root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data;     
			success = data.success;	 
			if(success == 1){ 

				$scope.instructions.push({
					type: $scope.instruction.type,
					description: $scope.instruction.description
				});
				$scope.instruction = {temp: true};

				Lobibox.notify('success', {
					size: 'mini',
					showClass: 'zoomInLeft',
					hideClass: 'zoomOutRight',
					msg: 'successfully updated' ,
					img: $("#loged_in_image").attr("src")
				}); 


			} else {

				$scope.nameError = " ";
				Lobibox.notify('warning', {
					size: 'mini',
					showClass: 'zoomInLeft',
					hideClass: 'zoomOutRight',
					msg: 'email not exists' ,
					img: $("#loged_in_image").attr("src")
				});
			}



		}, function myError(response) { 
			Lobibox.notify('error', {
				size: 'mini',
				showClass: 'zoomInLeft',
				hideClass: 'zoomOutRight',
				msg: 'make sure that all details are correct, or refresh' ,
				img: $("#loged_in_image").attr("src")
			});
		});



	}




});






lumieno.controller( 'LumienoControllerCustomer', function($timeout, $scope, $http, $location, myservice){
	$scope.myservice = myservice; 

	$scope.editcustomer = function( customer ) {
		$scope.myservice.name = customer.email;
		$location.path('viewcustomer');
	}


	$scope.customers = []; 


	$timeout( function(){
		var data = $.param({
			action: 'get-customers' 
		});	
		$http.post("../root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response); 
			data = response.data.success;	
			console.log(response.data);				
			if(data.success == 1) { 
				data.data.forEach(function(entry) {   		
					$scope.customers.push({ 
						name: entry.name, 
						dob: entry.dob,
						email: entry.email,
						mobile: entry.mobile,
						landline: entry.landline,
						address: entry.address,
						pin: entry.pin,
						description: entry.description,
						image: entry.image, 
						imageName: '../customer/media/images/' + entry.image,   
						delete: entry.deletes,
						date: entry.date
					});
				});

			}
			console.log($scope.customers);

		}, function myError(response) { 
			console.log(response);
		});

	}, 100);




});




lumieno.controller( 'LumienoControllerViewcustomer', function($timeout, $scope, $http, $location, myservice){
	$scope.myservice = myservice;
	member = $scope.myservice.name;
	if(member == null){		
		$location.path('customer');
		return;
	}

	$scope.myservice.name =  null;

	$scope.backToPro = function() {
		$location.path('customer');
	}

	$scope.loginLog = [];

	$timeout( function() {


		var data = $.param({
			action: 'get-loginlog-cu' 
		});	
		$http.post("../root/ajax.php", data, config)
		.then(function mySuccess(response) { 

			response =angular.fromJson(response);
			response = response.data.success;
			data = response.data;
			success = response.success;	

//	console.log(data);  
if(success == 1){

	data.forEach(function(entry) { 

		$scope.loginLog.push(entry);
	});
}

//console.log($scope.loginLog);








}, function myError(response) { 
	console.log(response);
});

	}, 200);


	$timeout( function(){
		var data = $.param({
			action: 'get-customer-one' ,
			member: member
		});	
		$http.post("../root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data.success;	  
			if(data.success == 1) { 
				entry = data.data[0];


				$scope.customer = { 
					name: entry.name, 
					dob: entry.dob,
					email: entry.email,
					mobile: parseInt(entry.mobile),
					landline: parseInt(entry.landline),
					address: entry.address,
					pin: entry.pin,
					description: entry.description,
					image: entry.image, 
					imageName: '../customer/media/images/' + entry.image,   
					delete: entry.deletes,
					date: entry.date,
					deletedd:(entry.deletes == 1 ? true: false),
					login:(entry.login == 1 ? true: false),
					images:[{name: entry.image}]
				};
				$scope.imagesSrc = '../customer/media/images/' + entry.image;

			}


		}, function myError(response) { 
			console.log(response);
		});

	}, 100);






	$scope.canLogin = function (customer, login) {

		var exdata = {
			action: 'change-login',
			email: customer.email,
			login: login

		}
		var data = $.param(exdata);	
		$http.post("../root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data;     
			console.log( data);
			success = data.success;	 
			if(success == 1){ 
				customer.login = login;
				Lobibox.notify('success', {
					size: 'mini',
					showClass: 'zoomInLeft',
					hideClass: 'zoomOutRight',
					msg: 'successfully updated' ,
					img: $("#loged_in_image").attr("src")
				}); 


			} else {

				customer.login = !login;

				$scope.nameError = " ";
				Lobibox.notify('warning', {
					size: 'mini',
					showClass: 'zoomInLeft',
					hideClass: 'zoomOutRight',
					msg: 'email not exists' ,
					img: $("#loged_in_image").attr("src")
				});
			}



		}, function myError(response) { 
			Lobibox.notify('error', {
				size: 'mini',
				showClass: 'zoomInLeft',
				hideClass: 'zoomOutRight',
				msg: 'make sure that all details are correct, or refresh' ,
				img: $("#loged_in_image").attr("src")
			});
		});


	}





});







lumieno.controller( 'LumienoControllerCart', function($timeout, $scope, $http, $location, $filter, myservice){
	$scope.myservice = myservice;


	$scope.limitShow = 30;
	$scope.carts = []; 


	var doToRefresh = function(){
		var data = $.param({
			action: 'get-carts' ,
			limit: $scope.limitShow
		});	
		$http.post("../root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data.success;	 

			console.log(response.data);
			if(data.success == 1) { 
				$scope.carts = []; 
				data.data.forEach(function(entry) { 

					$scope.carts.push({ id: entry.id ,  
						product: entry.product , 
						pdelete: (entry.productdelete == 1 ? true: false) , 
						cid: entry.customerid , 
						cemail: entry.customeremail , 
						cname: entry.customername , 
						cdelete: (entry.customerdelete == 1 ? true: false) , 
						clogin: (entry.customerlogin == 1 ? true: false) , 
						count: entry.count ,  
						success: (entry.success == 1 ? true: false) , 
						payment: entry.payment , 
						buy: (entry.buy == 1 ? true: false) , 
						client: entry.client , 
						delete: (entry.delete_status == 1 ? true: false) , 
						date: entry.date 
					});
				}); 
			}

			console.log($scope.carts);

		}, function myError(response) { 
			console.log(response);
		});

	};


	$timeout(doToRefresh, 120);



	$scope.sortTable = function( name, order = false) {
		$scope.carts = $filter('orderBy')($scope.carts, name, order);
		$scope.cartss = {temp: true };
		switch( name) {
			case 'product' :
			$scope.cartss = {product: true };
			break;
			case 'cname' :
			$scope.cartss = {cname: true };
			break;
			case 'cemail' :
			$scope.cartss = {cemail: true };
			break;
			case 'clogin' :
			$scope.cartss = {clogin: true };
			break;
			case 'count' :
			$scope.cartss = {count: true };
			break;
			case 'success' :
			$scope.cartss = {success: true };
			break;
			case 'buy' :
			$scope.cartss = {buy: true };
			break; 
			case 'client' :
			$scope.cartss = {client: true };
			break;

			case 'date' :
			$scope.cartss = {date: true };
		}

		return !order;	 

	}




	$scope.clickToPro =  function( productz ) {
		$scope.myservice.name = productz;
		$location.path('details');
	}

	$scope.editcustomer = function( customer ) {
		$scope.myservice.name = customer;
		$location.path('viewcustomer');
	}

	$scope.moreT = function() {
		$scope.limitShow = $scope.limitShow + 20 ;
		$timeout(doToRefresh, 120);
	}


	$scope.detailed = function(cart) {



	}

});





lumieno.controller( 'LumienoControllerCartHistory', function($timeout, $scope, $http, $location, $filter, myservice){


	$timeout( function(){

		var data = $.param({
			action: 'get-all-cart'
		});	
		$http.post("../root/ajax.php", data, config)
		.then(function mySuccess(response) { 
			response =angular.fromJson(response);
			data = response.data.success; 

			console.log(data); 
			if(data.success == 1){ 
				$scope.carts = data.data;  

			} else if(data.success == -1) {
				$location.path('login');

			}else if(data.success == -2) {
				$location.path('login');

			} else {	 				
					//$location.path('customer-history');
				}


				console.log($scope.carts);


			}, function myError(response) { 
				console.log(response);
			});

	}, 100);





});





lumieno.controller( 'LumienoController0', function($timeout, $scope, $http, $location, $filter, myservice){

});



//


lumieno.controller( 'LumienoController1', function($timeout, $scope, $http, $location, myservice){
	$scope.wlcm = "hello lumieno";
});

function getFormattedDate() {
	var date = new Date();
	var str = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate() + " " +  date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds();

	return str;
}