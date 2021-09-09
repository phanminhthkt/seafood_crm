if($('#all-attribute').exists()){
	// $(document).on('click','.add-attr-pattern',function(){

	$('.add-attr-pattern').click(function(){
		$(".first-attribute").append($("#attr-pattern").html());
		$("select").select2();
		checkSelectedSelect2();
	})
	$(document).on('click','.btn_remove--row-attribute', function(){
		$(this).parents('.item-attribute').remove();
	})
	
	var allAttribute = $("#all-attribute").data('value');
	$(document).on('change','.group_attribute.select2', function(){
		var group_id = $(this).val();
		var item  = $(this).parents('.item-attribute');
		if(group_id!=''){
			var group_attribute =  allAttribute.filter(value => { return parseInt(value.id) === parseInt(group_id);})
			item.find('.btn-attribute').attr('data-url',URL.base_url+'/admin/attribute/add/group/'+group_id);
			item.find('.attribute').find('option').remove();
			item.find('input[type="hidden"]').val(group_id);
			item.find('.attribute').attr('name','attribute'+group_id+'[id][]');
			item.find('.attribute').attr('id','attribute'+group_id);
			group_attribute[0].attributes.forEach(function(value){ 
				item.find('.attribute').append('<option value="'+value.id+'" checked>'+value.name+'</option>');
			});
		}else{
			item.find('.btn-attribute').attr('data-url','');
			item.find('.attribute').find('option').remove();
			item.find('input[type="hidden"]').val('');
			item.find('.attribute').attr('name','');
			item.find('.attribute').attr('id','');
		}
		checkSelectedSelect2();
	});
	var check_group_attribute_id = [];
	var group_attribute_id = [];
	$(document).on('change','.attribute.select2', function(){

		var root = $(this);
		var attribute_id = [];
		var name_group_id = "attribute"+root.parents('.item-attribute').find('.group_attribute option:selected').val().toString();
		var attribute_text = [];
		if(check_group_attribute_id.indexOf($(this).attr('id')) == -1){
			check_group_attribute_id.push($(this).attr('id'));
			group_attribute_id.push({id:$(this).attr('id'),list_id:[],list_text:[]});
		}
		group_attribute_id.forEach(function(value){ 
			if((value.id.toString() === name_group_id) && (value.list_id.indexOf(root.val()) == -1)){
				value.list_id = root.val();
				value.list_text = root.select2('data').map(function(elem){ return elem.text });
			}
		});
		var new_group_attribute_id = group_attribute_id;
		new_group_attribute_id = new_group_attribute_id.filter(function(value){return value.list_text.length > 0;})
		var fAttribute = new_group_attribute_id[0].list_text;
		$(".first-same-item").html('');
		for (var i = 0; i < fAttribute.length; i++) {
			if(new_group_attribute_id.length < 2){ 
				$(".first-same-item").append($("#attr-same-item").text().replace('textname', fAttribute[i]));
			};
			for (var j = 1; j < new_group_attribute_id.length; j++) {
				var f2Attribute = new_group_attribute_id[j].list_text;
				for(var e = 0;e < f2Attribute.length;e++){
					$(".first-same-item").append($("#attr-same-item").text().replace('textname', fAttribute[i]+'-'+f2Attribute[e]));
				}
			}
		}
		// console.log(group_attribute_id);
		// group_attribute_id.forEach(function(value,index){
		// 	alert(index);
		// 	alert(value.id);
		// })


		// $(".group_attribute option:selected").each(function(){
		// 	group_attribute_id.push($(this).val());
		// })
		// $(".attribute option:selected").each(function(){
		// 	attribute_id.push($(this).val());
		// 	attribute_text.push($(this).text());
		// })
		// alert(attribute_text);
	});
}
$(document).on('click','.ajax-form', function(){
	//Check Attribute
	if($('#all-attribute').exists()){
		if($(this).hasClass('btn-attribute')){if($(this).attr('data-url')==''){notifyDialog("Bạn chưa chọn nhóm thuộc tính");return false;}}
		if($(this).parents(".input-group").find('select').hasClass('group_attribute') && $(this).parents(".input-group").find('.group_attribute').attr('id') == ''){
			$(this).parents(".input-group").find('.group_attribute').attr('id',getRndInteger(10000,20000));
		}
	}
	// End check attribute
	var data = data || {};
		data.id = "#"+$(this).parents(".input-group").find("select").attr("id");
		data.url = $(this).attr("data-url");
		data.title = $(this).data("title");
		data.formsize = $(this).data("form-size");
		data.formrel = $(this).data("form-rel");
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
