$(document).ready( function() {


	$(document).on( 'click', '#select-file-1-1', function(){
		$('#modal-1').attr('class', 'modal fade dmodel');
		$('#select-upload-me-1-1').children('input[type=file]').click();		 
	});

	$(document).on( 'change', '#select-upload-me-1-1>input[type=file]', function() {
		$this = $('#image-up');
		parent = $($this).parent("div");	
		$('#modal-1').attr("to_this", "image-up");
		$('.progress-no-my').remove();


		$("#select-upload-me-1-1").ajaxForm({ 

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
$url = window.location.href;  
$url  = $url.substring(0, $url.lastIndexOf('/'));
 

response =$.parseJSON(response);
if (response.success == 1) {

	response = response['data'];

	$local = response[0];
	rand0 = Math.floor(Math.random()*1E16); 

	$('.img-container > img').attr('src', $url + "/" + $local['path']);
	$('#setImg').click();
	$('body').removeClass("modal-x");
	$('body').removeClass("loading");




}


},
complete : function(response) {
	$('#progress-bar-now').parent('.progress-no-my').text('100%'); 
},
error : function() {
	$('#progress-bar-now').parent('.progress-no-my').text('0%');
}
});

		$('#select-upload-me-1-1 input[type=submit]').click();  



		$('body').addClass("modal-x");
		$('body').addClass("loading");     

	});




	var cropBoxData;
	var cropBoxData;
	var canvasData;
	var cropper;
	var Cropper = window.Cropper;

	$(document).on('shown.bs.modal', '#modal-1.dmodel', function () {  
		image = document.getElementById('image-1'); 

		cropper = new Cropper(image,  {  
			aspectRatio: 16 / 16,
			guides: true,
			minContainerWidth :350,
			minContainerHeight : 350,
			ready: function () { 
				cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);           
			}, crop: function(e) {
				updateCoords(e);
			}
		});


	}).on('hidden.bs.modal','#modal-1.dmodel',  function () {

		cropBoxData = cropper.getCropBoxData();
		canvasData = cropper.getCanvasData();
		cropper.destroy(); 


		$url = window.location.href;  
		$url  = $url.substring(0, $url.lastIndexOf('/')); 

		var TARGET_W = 300;
		var TARGET_H = 300;
		var photo_url_ = $('#image-1').attr('src');
		photo_url_ = photo_url_.substr(3);
		photo_url_ = photo_url_.replace(/^.*[\\\/]/, ''); 



		dataX = $('#x').val();
		dataY = $('#y').val();
		dataWidth = $('#w').val();
		dataHeight = $('#h').val(); 
		dataRotate = 0;
		dataScaleX = 1;
		dataScaleY = 1;


		id = $('#name').attr('data-id');
		type = $('#name').attr('data-type');



		$.post('root/ajax.php',{action:'move-image-custo',  
			name:photo_url_,
			dataX: dataX,
			dataY: dataY,
			dataWidth:dataWidth ,
			dataHeight:dataHeight ,
			dataRotate:dataRotate ,
			dataScaleX:dataScaleX ,
			dataScaleY :dataScaleY,
			id:id ,
			type :type,


		},function(response){
			console.log(response);
			response =$.parseJSON(response);
			response = response.success;
			if(response.success == 0){

			} else if(response.success  ==1){ 


				setImage('.my_image_here_cust',$url +  "/customer/media/images/" + photo_url_  );
				var input = $('#user_image');
				$('.name-image-r').val(photo_url_);
 
 
}
});	





	});





				
				







}); 














function updateCoords(e) {
	$('#x').val(e.detail.x);
	$('#y').val(e.detail.y);
	$('#w').val(e.detail.width);
	$('#h').val(e.detail.height);

	$('#r').val(e.detail.rotate);
	$('#sx').val(e.detail.scaleX);
	$('#sy').val(e.detail.scaleY);
}


function setImage($this, $url) {

	url= window.location.href;  
	url = url.substring(0, url.lastIndexOf('/')); 
	$string_trturn = url+"/assets/images/default.png";


	$.ajax({
		url:$url,
		type:'HEAD',
		error: function()
		{
			$($this).attr("src",$string_trturn);
		},
		success: function()
		{ 
			$($this).attr("src",$url);
		}
	});

}