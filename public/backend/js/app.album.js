if($('.multiple-image').exists()){
	var mUploadImage =  document.querySelector('.multiple-image');
	mUploadImage.addEventListener('change', uploadMultipleImage);
	function uploadMultipleImage() {
		var curFiles = mUploadImage.files;
		for(var i = 0; i < curFiles.length; i++) {
			if(curFiles[i].name.match(/.(jpg|jpeg|png|gif)$/i)) // Check type image
			{
				var size = parseInt(curFiles[i].size) / 1024; // get size image
				if(size <= 4096)
				{
					var reader = new FileReader();
					reader.onload = function(e){
						
						addValueImgTemp('#multi-images-pattern','.img-child',e.target.result);
						$(".row-preview").append($("#multi-images-pattern").html());
					}
					reader.readAsDataURL(curFiles[i]);
				}
			}
		}
	}
	function removeImage(e){
		e.parentNode.parentNode.parentNode.parentNode.remove();
	}
}