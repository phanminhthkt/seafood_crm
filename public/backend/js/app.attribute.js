if($('#all-attribute').exists()){
	//$("#attr-pattern").html() chưa dom nên bọc nó vào 1 tag rồi call như dom

function checkSelectedSelect2(){
	$(".group_attribute.select2 option").each(function(i){
		$(this).prop('disabled',false);
	});
	$(".group_attribute.select2").each(function(i){
		var val = $(this).val();
		if(val!=''){
			$(".group_attribute.select2 option[value='"+val+"']").prop('disabled',true);
		}
	});
	$(".group_attribute.select2").select2();
}
function multiArray(array_first,array_second,char){
    var result = [];
    array_first.forEach(function(first){
    	array_second.forEach(function(second){
    		result.push(first+char+second);
    	})
    })
    return result;
}
function generate(array,char){
    var result = array.shift();
    array.forEach(function(arr){
    	result = multiArray(result,arr,char);
    })
    return result;
}
function addValueGroupAttributeId(){
	group_attribute_id = [];
	$('.attribute.select2').each(function(){
		if($(this).val()!=''){
			group_attribute_id.push({
				id:$(this).attr('id'),
				list_id:$(this).val(),
				list_text:$(this).select2('data').map(function(elem){ return elem.text })
			});
		}
	})
}
function addChildProduct(){
	var group_attribute_list_text = [];
	var group_attribute_list_id = [];
	group_attribute_id.forEach(function(value){
		if(value.list_text.length > 0){group_attribute_list_text.push(value.list_text);} 
	});
	group_attribute_id.forEach(function(value){
		if(value.list_id.length > 0){group_attribute_list_id.push(value.list_id);} 
	});
	group_attribute_list_text = generate(group_attribute_list_text,' ');
	group_attribute_list_id = generate(group_attribute_list_id,',');

	$(".first-same-item").html('');
	if(!$.isEmptyObject(group_attribute_list_text)){
		for (var i = 0; i < group_attribute_list_text.length; i++) {
			addValueTemp('#attr-same-item','input[name="data_child[name][]"]',$('input[name="name"]').val()+' '+group_attribute_list_text[i]);
			addValueTemp('#attr-same-item','input[name="data_child[attribute_id][]"]',group_attribute_list_id[i].split(','));
			$(".first-same-item").append($('#attr-same-item').html());
		}
	}
	$('.price--format').mask('000,000,000,000',{reverse: true});
}
function ajaxFormInItem(element){
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
						//Check element append select option
						$(element).append('<option value="'+data.item.id+'" checked>'+data.item.name+'</option>');
				       	if($('#all-attribute').exists()){
				       		if(data.type=='group'){
					       		addOptionTemp('#attr-pattern','.group_attribute','<option value="'+data.item.id+'" checked>'+data.item.name+'</option>');
					       		allAttribute.push({id:data.item.id,name:data.item.name,attributes:[]});
					       		$('select.group_attribute').not(element).append('<option value="'+data.item.id+'" checked>'+data.item.name+'</option>');
					       		$(element).val(data.item.id);
					       		$(element).parents('.item-attribute').find('.btn-attribute').attr('data-url',URL.base_url+'/admin/attribute/add/group/'+data.item.id);
								$(element).parents('.item-attribute').find('.attribute').attr('id','group_attribute'+data.item.id);
								$(element).parents('.item-attribute').find('.attribute').find('option').remove();
					       		$(element).parents('.item-attribute').find('.select2.attribute').select2({multiple: true}).val(null).trigger("change");
					       		checkSelectedSelect2();
					       	}else if(data.type=='item'){
					       		allAttribute.forEach(function(value){ 
					       			if(parseInt(value.id) === parseInt(data.item.group_id)){
					       				value.attributes.push({id:data.item.id,name:data.item.name,group_id:data.item.group_id});
					       			}
								});

					       	}else{
					       		$(element).val(data.item.id);
					       	}
				       	}
				       	//Reload form
				       	$('.dev-form').find("button[type='submit']").html('<i class="mdi mdi-check"></i>');
				       	$('.dev-form').removeClass('was-validated');
				       	setTimeout(function(){ 
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
//Add attribute pattern
$('.add-attr-pattern').click(function(){
	$(".first-attribute").append($("#attr-pattern").html());
	$("select").select2();
	if($('.attribute__child--edit').exists()){$('.attribute__child--edit').select2({maximumSelectionLength: 1});}
	checkSelectedSelect2();
})
//Remove attribute pattern
$(document).on('click','.btn_remove--row-attribute', function(){
	$(this).parents('.item-attribute').remove();
	addValueGroupAttributeId();
	addChildProduct();
})
$(document).on('click','.btn_remove--row-child', function(){
	$(this).parents('tr').remove();
})

//Event select group attribute
var allAttribute = $("#all-attribute").data('value');
$(document).on('change','.group_attribute.select2', function(){
	var group_id = $(this).val();
	var item  = $(this).parents('.item-attribute');
	if(group_id!=''){
		var group_attribute =  allAttribute.filter(value => { return parseInt(value.id) === parseInt(group_id);})
		item.find('.btn-attribute').attr('data-url',URL.base_url+'/admin/attribute/add/group/'+group_id);
		item.find('.attribute').find('option').remove();
		item.find('input[type="hidden"]').val(group_id);
		item.find('.attribute').attr('id','attribute'+group_id);
		group_attribute[0].attributes.forEach(function(value){ 
			item.find('.attribute').append('<option value="'+value.id+'" checked>'+value.name+'</option>');
		});
	}else{
		item.find('.btn-attribute').attr('data-url','');
		item.find('.attribute').find('option').remove();
		item.find('input[type="hidden"]').val('');
		item.find('.attribute').attr('id','');
	}
	checkSelectedSelect2();
});

//Event select attribute item
var group_attribute_id = [];
$(document).on('change','.attribute.select2', function(){
	var root = $(this);
	var attribute_id = [];
	var name_group_id = "attribute"+root.parents('.item-attribute').find('.group_attribute option:selected').val().toString();
	var attribute_text = [];
	addValueGroupAttributeId();
	addChildProduct();
});
if($('.attribute__child--edit').exists()){
	$(document).ready(function(){
		$('.attribute__child--edit').select2({maximumSelectionLength: 1});
	});
}

}