$(document).ready( function() {
	console.log('ready to go ! ');


 


					/* ========================================== image start ===================================================*/	
					// button test
					
					$(document).on('click', '#select-file', function () {
						$('#select-upload-me').children('input[type=file]').click();
						//runfis();
					});
					
					$(document).on('change', '#select-upload-me>input[type=file]', function() {
						$this = $('#image-up');
						parent = $($this).parent("div");	
						$('#modal').attr("to_this", "image-up");
				    	$('.progress-no-my').remove();

						
						$("#select-upload-me").ajaxForm({ 
				 
							cache: false,
							contentType: false,
							processData: false,
						        beforeSend : function() {
						        	////console.log("before");
						        	insert = '<div class="progress-no-my">'+
						    		'<div class="progress-bar progress-bar-success" id="progress-bar-now" role="progressbar" aria-valuenow="2" '+
						    		'aria-valuemin="0" aria-valuemax="100" style="min-width: 1em; width: 1%;">'+
						    		'1%</div></div>';		    		
						    		//progress-bar-now
						    		$(parent).append(insert);
							    },
							    uploadProgress : function(event, position, total, percentComplete) { 
						        	$('#progress-bar-now').css('width', percentComplete+"%");
						        	$('#progress-bar-now').text( percentComplete);  
							    },
							    success: function(response,statusText) {
							    	 ////console.log('success');  
										    		console.log(response);  
							    	 $url = window.location.href;  
							    	 $url  = $url.substring(0, $url.lastIndexOf('/'));
							    	 $url  = $url.substring(0, $url.lastIndexOf('/'));

							    	 response =$.parseJSON(response);
							    	if (response.success == 1) {

							    		response = response['data'];

							    		////console.log(response);  
							    		for (var i = 0;  i< response.length ; i++) { 
							    			$local = response[i];
							    			rand0 = Math.floor(Math.random()*1E16);
							    			$($this).prepend('<img src="" name="' +$local['name'] +'" class="img-thumbnail" id="' +rand0 + '" alt="Cinque Terre" width="130" height="130">');


									    setImage('#'+rand0,$url + "/" + $local['path']  );
							    		}


										
									}


								},
							    complete : function(response) {
							    	$('#progress-bar-now').parent('.progress-no-my').text('100%');
							    	////console.log('complete');
							    	//////console.log(response);
							    },
							    error : function() {
							    	$('#progress-bar-now').parent('.progress-no-my').text('0%');
							    }
							});

				  $('#select-upload-me input[type=submit]').click();  
					});

	if ($('#show-edit-crop').length >0) {


		var Cropper = window.Cropper;
		var URL = window.URL || window.webkitURL;
		var container = document.querySelector('.img-containers');
		var image = null;
		try {
		    image = container.getElementsByTagName('img').item(0);
		}
		catch(err) {

		}
 
		var download = document.getElementById('download');
		var actions = document.getElementById('actions');
		var dataX = document.getElementById('dataX');
		var dataY = document.getElementById('dataY');
		var dataHeight = document.getElementById('dataHeight');
		var dataWidth = document.getElementById('dataWidth');
		var dataRotate = document.getElementById('dataRotate');
		var dataScaleX = document.getElementById('dataScaleX');
		var dataScaleY = document.getElementById('dataScaleY');
		var options = {
		      aspectRatio: 342 / 450,
		      resetPreview: '.img-preview',
		      preview: '.img-preview',
		      ready: function (e) {
		        ////console.log(e.type);
		      },
		      cropstart: function (e) {
		        ////console.log(e.type, e.detail.action);
		      },
		      cropmove: function (e) {
		        ////console.log(e.type, e.detail.action);
		      },
		      cropend: function (e) {
		        ////console.log(e.type, e.detail.action);
		      },
		      crop: function (e) {
		        var data = e.detail;

		        ////console.log(e.type);
		        dataX.value = Math.round(data.x);
		        dataY.value = Math.round(data.y);
		        dataHeight.value = Math.round(data.height);
		        dataWidth.value = Math.round(data.width);
		        // dataRotate.value = typeof data.rotate !== 'undefined' ? data.rotate : '';
		        dataScaleX.value = typeof data.scaleX !== 'undefined' ? data.scaleX : '';
		        dataScaleY.value = typeof data.scaleY !== 'undefined' ? data.scaleY : '';
		      },
		      zoom: function (e) {
		        ////console.log(e.type, e.detail.ratio);
		      }
		    };
		var cropper = new Cropper(image, options);
		var originalImageURL = image.src;
		var uploadedImageURL;

		// Tooltip
		$('[data-toggle="tooltip"]').tooltip();


		// Buttons
		if (!document.createElement('canvas').getContext) {
		  $('button[data-method="getCroppedCanvas"]').prop('disabled', true);
		}

		if (typeof document.createElement('cropper').style.transition === 'undefined') {
		  $('button[data-method="rotate"]').prop('disabled', true);
		  $('button[data-method="scale"]').prop('disabled', true);
		}


		 
try{
		// Options
		actions.querySelector('.docs-toggles').onchange = function (event) {
		  var e = event || window.event;
		  var target = e.target || e.srcElement;
		  var cropBoxData;
		  var canvasData;
		  var isCheckbox;
		  var isRadio;

		  if (!cropper) {
		    return;
		  }

		  if (target.tagName.toLowerCase() === 'label') {
		    target = target.querySelector('input');
		  }

		  isCheckbox = target.type === 'checkbox';
		  isRadio = target.type === 'radio';

		  if (isCheckbox || isRadio) {
		    if (isCheckbox) {
		      options[target.name] = target.checked;
		      cropBoxData = cropper.getCropBoxData();
		      canvasData = cropper.getCanvasData();

		      options.ready = function () {
		        ////console.log('ready');
		        cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
		      };
		    } else {
		      options[target.name] = target.value;
		      options.ready = function () {
		        ////console.log('ready');
		      };
		    }

		    // Restart
		    cropper.destroy();
		    cropper = new Cropper(image, options);
		  }
		};

}
		catch(err) {

		}
		// Methods
		actions.querySelector('.docs-buttons').onclick = function (event) {
		  var e = event || window.event;
		  var target = e.target || e.srcElement;
		  var result;
		  var input;
		  var data;

		  if (!cropper) {
		    return;
		  }

		  while (target !== this) {
		    if (target.getAttribute('data-method')) {
		      break;
		    }

		    target = target.parentNode;
		  }

		  if (target === this || target.disabled || target.className.indexOf('disabled') > -1) {
		    return;
		  }

		  data = {
		    method: target.getAttribute('data-method'),
		    target: target.getAttribute('data-target'),
		    option: target.getAttribute('data-option'),
		    secondOption: target.getAttribute('data-second-option')
		  };

		  if (data.method) {
		    if (typeof data.target !== 'undefined') {
		      input = document.querySelector(data.target);

		      if (!target.hasAttribute('data-option') && data.target && input) {
		        try {
		          data.option = JSON.parse(input.value);
		        } catch (e) {
		          ////console.log(e.message);
		        }
		      }
		    }

		    if (data.method === 'getCroppedCanvas') {
		      data.option = JSON.parse(data.option);
		    }

		    result = cropper[data.method](data.option, data.secondOption);

		    switch (data.method) {
		      case 'scaleX':
		      case 'scaleY':
		        target.setAttribute('data-option', -data.option);
		        break;

		      case 'getCroppedCanvas':
		        if (result) {

		          // Bootstrap's Modal
		          $('#getCroppedCanvasModal').modal().find('.modal-body').html(result);

		          if (!download.disabled) {
		            download.href = result.toDataURL('image/jpeg');
		          }
		        }

		        break;

		      case 'destroy':
		        cropper = null;

		        if (uploadedImageURL) {
		          URL.revokeObjectURL(uploadedImageURL);
		          uploadedImageURL = '';
		          image.src = originalImageURL;
		        }

		        break;
		    }

		    if (typeof result === 'object' && result !== cropper && input) {
		      try {
		        input.value = JSON.stringify(result);
		      } catch (e) {
		        ////console.log(e.message);
		      }
		    }
		  }
		};




	}

	document.body.onkeydown = function (event) {
	  var e = event || window.event;

	  if (!cropper || this.scrollTop > 300) {
	    return;
	  }

	  switch (e.keyCode) {
	    case 37:
	      e.preventDefault();
	      cropper.move(-1, 0);
	      break;

	    case 38:
	      e.preventDefault();
	      cropper.move(0, -1);
	      break;

	    case 39:
	      e.preventDefault();
	      cropper.move(1, 0);
	      break;

	    case 40:
	      e.preventDefault();
	      cropper.move(0, 1);
	      break;
	  }
	};


						$(document).on('keyup', "#title", function(){ 
						    $('#show_icona').attr('class', 'fa');
						    $('#show_icona').addClass('fa-'+$(this).val());
						});












				  
				  $(document).on( 'click', '#image-up>img', function(){

	 				
				  fileNameIndex = $(this).attr('src').lastIndexOf("/") + 1;
				  filename = $(this).attr('src').substr(fileNameIndex);
				 
				  	if(filename != "default.png"){
				  			
				  		$("#show-edit-crop").show(1000);
				  		$('#modal-2').modal('show');

					  	image.src = uploadedImageURL = $(this).attr('src');
 

					  	cropper.destroy();
					  	cropper = new Cropper(image, options); 

					  	 $('#xname').val(filename);
				  		$("#show-edit-crop").attr('name-img',filename );
					  }
					  	setTimeout( function() {
					  		
					  		cropper.destroy();
					  		cropper = new Cropper(image, options); 

					  	}, 1000);

				  });

				    $(document).on( 'click', '.each-selected>img', function(){
				    fileNameIndex = $(this).attr('src').lastIndexOf("/") + 1;
				    filename = $(this).attr('src').substr(fileNameIndex);
				   
				    	if(filename != "default.png"){

				    		$("#show-edit-crop").show(1000);				    			
				    		$('#modal-2').modal('show');

				  	  	image.src = uploadedImageURL = $(this).attr('src');
				  	  	cropper.destroy();
				  	  	cropper = new Cropper(image, options); 
				  	  	 $('#xname').val(filename);
				    	$("#show-edit-crop").attr('name-img',filename );



				    	setTimeout( function() {
				    		
				    		cropper.destroy();
				    		cropper = new Cropper(image, options); 

				    	}, 1000);
					

				  	  }




				    });



				  $(document).on('click', '#clear-crop', function() {
				  		$("#show-edit-crop").attr('name-img','' );
				  	$("#show-edit-crop").hide(1000); 
				  		
				  	$('#modal-2').modal('hide');

		 
				  

				  });


	 

				  $(document).on('click', '#ok-crop',  function() {


				  	$url = window.location.href;  
				  	$url  = $url.substring(0, $url.lastIndexOf('/'));
				  	$url  = $url.substring(0, $url.lastIndexOf('/'));

				  	$("#show-edit-crop").attr('name-img','' );
				  	$("#show-edit-crop").hide(1000); 

				  	$('#modal-2').modal('hide');

				  	$src = "";
				  	$('#image-up').find('img').each( function() {
				  		if ($(this).attr('name') == $('#xname').val() ) { 
				  			$src = $(this).attr('src');
				  			$(this).remove();}
				  	});

				  	  	$('#image-up-ok').find('.each-selected').each( function() {
				  		if ($(this).children('img').attr('name') == $('#xname').val() ) { 
				  			$src = $(this).children('img').attr('src');
				  			$(this).closest('.each-selected').remove();}
				  	});
				 



	 
				  	  	name = $('#xname').val();
	  



				 	dataX = Math.round(cropper.getData().x);
				 	dataY = Math.round(cropper.getData().y);
				 	dataWidth = Math.round(cropper.getData().width);
				 	dataHeight = Math.round(cropper.getData().height);
				 	dataRotate = Math.round(cropper.getData().rotate);
				 	dataScaleX = Math.round(cropper.getData().scaleX);
				 	dataScaleY = Math.round(cropper.getData().scaleY);


				  	 

				  			$.post('../root/ajax.php',{action:'move-image',  
				  				fname:$src,
				  				name:name,
					  			dataX: dataX,
								dataY: dataY,
								dataWidth:dataWidth ,
								dataHeight:dataHeight ,
								dataRotate:dataRotate ,
								dataScaleX:dataScaleX ,
								dataScaleY :dataScaleY 
								 },function(response){ 
				  					response =$.parseJSON(response);
				  					response = response.success;
				  					if(response.success == 0){

				  					} else if(response.success  ==1){ 
						    			rand0 = Math.floor(Math.random()*1E16);
						    			$('#image-up-ok').prepend('<div class="col-md-3 each-selected"><img src="" name="' +name +'" class="img-thumbnail" id="' +rand0 + '" alt="Cinque Terre" width="130" height="130">'+
						    				'<i class="fa fa-times-circle-o close-remove-me" aria-hidden="true"></i>'+ 
						    				'</div>');


								    setImage('#'+rand0,$url + "/images/products/" + name  );


				  					}
				  				});	 

				  	
				  });


				  $(document).on( 'click', '.close-remove-me', function() {


				  	$this = $(this).closest('.each-selected');
				  	name = $($this).children('img').attr('name');

console.log(name);
				  	  			$.post('../root/ajax.php',{action:'remove-image',
				  	  				name:name
				  					 },function(response){
				  	  					 console.log(response);
				  	  					response =$.parseJSON(response); 
				  	  					if(response.success == 0){

				  	  					} else if(response.success  ==1){ 
				  	  						$($this).remove();
				  	  					}
				  	  				});	


				  });

				     
				/* ========================================== image end ===================================================*/
					

});