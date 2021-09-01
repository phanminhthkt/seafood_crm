$('body').on('click','.ajax-form', function(){
	var data = data || {};
		data.url = $(this).data("url");
		data.title = $(this).data("title");
	$('#pre-loader').show();	
	loadFormItem(data);
});
$('body').on('click','.direct-form', function(){
	var data = data || {};
		data.url = $(this).data("url");
	window.location = data.url;	
});
$('body').on('click','#delete-all', function(){
	var data = data || {};
		data.url = $(this).data("url");
	var listId = "";
    $("input.select-checkbox").each(function(){
        if(this.checked) listId = listId+","+this.value;
    });
    listId = listId.substr(1);
    if(listId == "")
    {
    	notifyDialog("Bạn hãy chọn ít nhất 1 mục để xóa");
    	return false;
    }	
    data.listId = listId;
	confirmDialog("delete-all","Bạn có chắc muốn xóa mục này ?",data);
});
$('body').on('click','.delete-item', function(){
	var data = data || {};
		data.url = $(this).data("url");
		data.id = $(this).data("id");
	confirmDialog("delete-item","Bạn có chắc muốn xóa mục này ?",data);
});
$('body').on('click','.send-mail-item', function(){
	var data = data || {};
		data.url = $(this).data("url");
		data.id = $(this).data("id");
	confirmDialog("send-mail-item","Bạn có chắc muốn gửi mail thông tin này ?",data);
});



$('body').on('click','#selectall-checkbox', function(){
	var parentTable = $(this).parents('table');
	var input = parentTable.find('input.select-checkbox');
	if($(this).is(':checked'))
	{
		input.each(function(){
			$(this).prop('checked',true);
		});
	}
	else
	{
		input.each(function(){
			$(this).prop('checked',false); 
		});
	}
});

$('body').on('click','.dev-checkbox',function(){
	var id = $(this).data('id'),
		table = $(this).data('table'),
		kind = $(this).data('kind'),
		$this = $(this);
	$.ajax({
    	url:'ajax/status/'+id,
    	type: 'PUT',
    	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    	data: { id: id,table: table,kind: kind},
    	error:function(x,e) {
		    backErrorAjax(x,e);
		},
	    success: function(result){
	    }
	    
	});
})
$('body').on('keyup','.input-priority',function(){
	var id = $(this).data('id'),
		table = $(this).data('table'),
		token = $(this).data('token'),
		value = $(this).val(),
		$this = $(this);
	$.ajax({
    	url:'ajax/priority/'+id,
    	type: 'PUT',
    	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    	data: {id: id,table: table,value: value},
    	error:function(x,e) {
		    backErrorAjax(x,e);
		},
	    success: function(result){
	    }
	    
	});
	return false;
})
// Active menu third
if(URL.type!=''){
	$('.mm-active ul li a').each(function(i,v){
	    if($(this).attr('href').indexOf(URL.type) != -1){
	        $(this).addClass('waves-effect active');
	    }
	})
}
if(URL.current!=''){
		$('li.mm-active > a').addClass('active')
	$('li.mm-active ul li a').each(function(i,v){
	    if(URL.current.indexOf($(this).attr('href')) == 0){
	        $(this).addClass('waves-effect active');
	    }
	})
}


// End active menu third
// Change file
$('body').on('change','.custom-file-dev input[type=file]', function(){
	var fileName = $(this).val();
	fileName = fileName.substr(fileName.lastIndexOf('\\') + 1, fileName.length);
	$(this).siblings('label').html(fileName);
	$(this).parents("div.form-group").children(".change-photo").find("b.text-sm").html(fileName);
	$(this).parents("div.form-group  label").children(".change-file").find("b.text-sm").html(fileName);
});
// End change file

// datepicker
// $(document).ready(function(){
// 	$('.datepicker').datepicker();
// })
$(document).ready(function(){
	$(".flatpickr-input").flatpickr({
		enableTime:true,
		dateFormat: 'd-m-Y H:i',
	})

	
	
	$(".dropdown-custom .dropdown-toggle-custom").click(function(){
		if($('.dropdown-custom .dropdown-menu-custom').is(":hidden")){
			$('.dropdown-custom .dropdown-menu-custom').addClass("show");
		}else{
			$('.dropdown-custom .dropdown-menu-custom').removeClass("show");
		}
	})

})
$(document).on('click', function (e) {
    if ($(e.target).parents(".dropdown-custom").length === 0) {
        $(".dropdown-menu-custom").removeClass('show');
    }
});

// $(".ajax-form").
if($('#datatable-buttons').exists()){
	$(document).ready(function(){
		var oTable = $('#datatable-buttons').DataTable({
			initComplete: function( settings, json ) {
			    $(".container-fluid").css({'opacity':'1'});
			    $('#pre-loader').delay(250).fadeOut(function () {
			        // $('#pre-loader').remove();
			    });
			},
			language: {
		    	paginate: {
		      		previous: '<i class="mdi mdi-chevron-left"></i>',
		      		next: '<i class="mdi mdi-chevron-right"></i>'
		    	},
		    	sProcessing: '<span class="spinner-border spinner-border-sm mr-1"></span>Loading...',

		  	},
			pageLength: Datatable.pageLength,
			order: ['0', 'desc'],
			searching: false,
			lengthChange: false,
	        processing: true,
	        serverSide: true,
	        ajax: Datatable.ajax,
	        columns: Datatable.columns,
	    });

	    $('#search-form').on('submit', function(e) {
	        oTable.draw();
	        e.preventDefault();
	    });
	});

}else{
	$(window).on('load', function () {
		$(".container-fluid").css({'opacity':'1'});
	    $('#pre-loader').delay(250).fadeOut(function () {
	        // $('#pre-loader').remove();
	    });
	});
}
