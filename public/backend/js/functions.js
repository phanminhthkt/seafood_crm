// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'
  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  
})()
function ValidationFormSelf(ele)
{
    var forms = document.querySelectorAll(ele)
  // Loop over them and prevent submission
  	Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }
        form.classList.add('was-validated')
      }, false)
    })
}
ValidationFormSelf('.needs-validation');
$.fn.exists = function(){
    return this.length;
};

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    
// Alert
function notifyDialog(text)
{
	const swalconst = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-info text-sm',
		},
		buttonsStyling: false
	})
	swalconst.fire({
		text: text,
		icon: "warning",
		confirmButtonText: '<i class="fas fa-check mr-2"></i>Đồng ý',
		showClass: {
			popup: 'animated fadeIn faster'
		},
		hideClass: {
			popup: 'animated fadeOut faster'
		}
	})
}	
function notifyError(text)
{
	const swalconst = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-danger text-sm',
		},
		buttonsStyling: false
	})
	swalconst.fire({
		text: text,
		icon: "error",
		confirmButtonText: '<i class="fas fa-times mr-2"></i>Xảy ra lỗi',
		showClass: {
			popup: 'animated fadeIn faster'
		},
		hideClass: {
			popup: 'animated fadeOut faster'
		}
	})
}	
function confirmDialog(action,text,value)
{
	const swalconst = Swal.mixin({
		customClass: {
			confirmButton: 'btn  btn-info text-sm mr-2',
			cancelButton: 'btn  btn-danger text-sm'
		},
		buttonsStyling: false
	})
	swalconst.fire({
		text: text,
		icon: "warning",
		showCancelButton: true,
		confirmButtonText: '<i class="fas fa-check mr-1"></i>Đồng ý',
		cancelButtonText: '<i class="mdi mdi-close mr-1"></i>Hủy',
		showClass: {
			popup: 'animated zoomIn faster'
		},
		hideClass: {
			popup: 'animated fadeOut faster'
		}
	}).then((result) => {
		if(result.value)
		{
			if(action == "delete-item") deleteItem(value);
			if(action == "delete-all") deleteAll(value);
			if(action == "send-mail-item") sendMail(value);
		}
	})
}
// End alert

function backErrorAjax(x,e){
	$('#pre-loader').delay(250).fadeOut();
    if (x.status==0) {
        notifyError('You are offline!!\n Please Check Your Network.');
    } else if(x.status==404) {
        notifyError('Requested URL not found.');
    } else if(x.status==500) {
        notifyError('Internel Server Error.');
    } else if(e=='parsererror') {
        notifyError('Error.\nParsing JSON Request failed.');
    } else if(e=='timeout'){
        notifyError('Request Time out.');
    } else {
        notifyError('Unknow Error.\n'+x.responseText);
    }
}
/* Delete */
function sendMail(data)
{
    $.ajax({
    	url:data.url,
    	type: 'GET',
    	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    	data: { id: data.id },
	    beforeSend: function() {
	        // setting a timeout

	        $('.send-mail-item-'+data.id).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
	    },
    	error:function(x,e) {
		    $('.send-mail-item-'+data.id).html('<i class="mdi mdi-cancel"></i>');
		},
	    success: function(result){
	    	$('meta[name="csrf-token"]').attr('content',result.token);
	    	$.ajaxSetup({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});
			if(result.status == "true"){
				$('.send-mail-item-'+data.id).html('<i class="mdi mdi-check-circle-outline"></i>');
			}
			else{
				$('.send-mail-item-'+data.id).html('<i class="mdi mdi-cancel"></i>');
			}
	    }
	});
}
/* Delete */
function ajaxFormItem(){
	if($('.dev-form').exists()){
		$(document).ready(function() {
			$('.dev-form').on('submit', function(e){
				e.preventDefault();
				var form = $(this);
				var url = form.attr('action');
				$.ajax({
				   	type: "POST",
				   	url: url,
				   	data: form.serialize(), // serializes the form's elements.
					beforeSend: function() {
				        $('.dev-form').find("button[type='submit']").html('<span class="spinner-border spinner-border-sm"></span>');
				    },
					error:function(x,e) {
					    backErrorAjax(x,e);
					    $('.dev-form').find("button[type='submit']").html('<i class="fa fa-plus-square mr-1"></i> Tạo');
					},
				   success: function(data)
				   {
				    	$.ajaxSetup({
						    headers: {
						        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						    }
						});
				       	$('.dev-form').find("button[type='submit']").html('<i class="mdi mdi-check"></i>');
				       	$('.dev-form').removeClass('was-validated');
				       	$('#datatable-buttons').DataTable().ajax.reload();
				       	setTimeout(function(){ 
				       		var textBtn = 'Sửa';
				       		if(!form.find('input[name="_method"]').val()){
				       			form.find('.selectpicker').val('');
				       			form.find('.selectpicker').selectpicker('refresh');
				       			form.trigger("reset");
				       			textBtn = 'Tạo';
				       		}
				       		$('.dev-form').find("button[type='submit']").html('<i class="fa fa-plus-square mr-1"></i> '+textBtn+''); }
				       		, 1000);
				   }
			 	});
	  		});
		});
	}
}
function loadFormItem(data)
{	
	 $.ajax({
        url: data.url,
        type: 'GET',
    	error:function(x,e) {
		    backErrorAjax(x,e);
		},
        success:function(result){
        	if(typeof data.formsize =='undefined'){
        		$(".modal-dialog").removeClass('modal-md').removeClass('modal-lg').addClass('modal-lg');  
        	}else{
        		$(".modal-dialog").removeClass('modal-md').removeClass('modal-lg').addClass(data.formsize);  
        	}
            $(".modal-header h4").html(data.title);  
            $(".modal-body").html(result);  
        	$('.selectpicker').selectpicker('refresh');
        	$('#pre-loader').delay(250).fadeOut();
        	$("#con-close-modal").modal();
        	ValidationFormSelf('.needs-validation');
        	if(typeof data.formrel =='undefined'){
        		// Use index page
        		ajaxFormItem();
        	}else{
        		// Use create page
        		ajaxFormInItem(data.id);
        	}
        	
        }
    });
}

/* Delete */
function deleteItem(data)
{
    $.ajax({
    	url:data.url,
    	type: 'DELETE',
    	// headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    	data: { id: data.id },
    	error:function(x,e) {
		    backErrorAjax(x,e);
		},
	    success: function(result){
	    	$('#datatable-buttons').DataTable().ajax.reload();
	    }
	});
}

/* Delete all */
function deleteAll(data)
{
    $.ajax({
    	url:data.url+'/'+data.listId,
    	type: 'DELETE',
    	// headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    	data: { listId: data.listId },
    	beforeSend: function() {
	        $('#pre-loader').show();
	    },
    	error:function(x,e) {
		    backErrorAjax(x,e);
		},
	    success: function(result){
	    	location.reload();
	    }
	});
}

function login(id)
{
	event.preventDefault();
	$.ajax({
		url: 'login',
		type: 'post',
		data:$(id).serialize(),
		dataType: 'json',
		beforeSend: function() {
	        // setting a timeout
	        $("#form-login button[type='submit']").html('<span class="spinner-border spinner-border-sm mr-1"></span>Loading...');
	    },
		error:function(x,e) {
		    backErrorAjax(x,e);
		},
	    success: function(result){
	    	$('meta[name="csrf-token"]').attr('content',result.token);
	    	$.ajaxSetup({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});
			$("#form-login button[type='submit']").html('Đăng nhập');
			if(result.status=='true'){
				$(".text-response").html('<span class="d-block alert alert-success mt-2"></span>');
				window.location = result.url_intended;
			}else{
				$(".text-response").html('<span class="d-block alert alert-danger mt-2"></span>');
			}
			$(".text-response span").text(result.msg);
	    }
	});
}

function getRndInteger(min, max) {
    return Math.floor(Math.random() * (max - min) ) + min;
}
function addOptionTemp(eMain,eFind,value){
	container = $('<dev/>').html($(eMain).html());
	container.find(eFind).append(value);
	$(eMain).html(container.html());
}
function addValueTemp(eMain,eFind,value){
	container = $('<dev/>').html($(eMain).html());
	container.find(eFind).attr('value',value);
	$(eMain).html(container.html());
}
function addTextTemp(eMain,eFind,value){
	container = $('<dev/>').html($(eMain).html());
	container.find(eFind).text(value);
	$(eMain).html(container.html());
}
function number_format(number, decimals, dec_point, thousands_point) {
    if (number == null || !isFinite(number)) {
        throw new TypeError("number is not valid");
    }
    if (!decimals) {
        var len = number.toString().split('.').length;
        decimals = len > 1 ? len : 0;
    }
    if (!dec_point) {
        dec_point = '.';
    }
    if (!thousands_point) {
        thousands_point = ',';
    }
    number = parseFloat(number).toFixed(decimals);
    number = number.replace(".", dec_point);
    var splitNum = number.split(dec_point);
    splitNum[0] = splitNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_point);
    number = splitNum.join(dec_point);
    return number;
}
function loadOtherPage(url) {
	$("<iframe>").hide().attr("src",url).appendTo("body");
	$('#pre-loader').show();
	setTimeout(function(){ $('#pre-loader').delay(250).fadeOut(function () {}); }, 2000);
}