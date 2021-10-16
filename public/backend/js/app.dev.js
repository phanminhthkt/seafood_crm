$(document).on('click','.ajax-form', function(){
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
// if(URL.type!=''){
// 	$('.mm-active ul li a').each(function(i,v){
// 	    if($(this).attr('href').indexOf(URL.type) != -1){
// 	        $(this).addClass('waves-effect active');
// 	    }
// 	})
// }
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
	$(".flatpickr-input.flatpickr-input-range").flatpickr({
		mode: "range",
		enableTime:false,
		dateFormat: 'd-m-Y',
	})
	$(".flatpickr-input.flatpickr-only-year").flatpickr({
		enableTime:false,
		dateFormat: 'Y',
	})
	$('#khoanggia').ionRangeSlider({
        skin: "flat",
        min     : 0,
        max     : 10000000,
        from    : 0,
        to      : 10000000,
        type    : 'double',
        step    : 1,
        // prefix  : 'đ ',
        postfix : ' đ',
        prettify: true,
        hasGrid : true
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
	if($('.row-product').exists()){
		var template = Handlebars.compile($("#details-template").html());
	}
	$(document).ready(function(){
		var oTable = $('#datatable-buttons').DataTable({
			initComplete: function( settings, json ) {
			    $(".container-fluid").css({'opacity':'1'});
			    $('#pre-loader').delay(250).fadeOut(function () {
			        // $('#pre-loader').remove();
			    });
			},
			autoWidth: false,
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
		$('.btn-destroy__filter').click(function(){
			$(".select2").val('').trigger('change');
			$('.search-form').each(function(){
				$(this)[0].reset();
			})
			oTable.draw();
		});
		if($('.has-inventory-number').exists()){
			oTable.on( 'draw', function () {
			    $('tbody tr').each(function (){
			    	if(parseFloat($(this).find('td:nth-child(6)').text()) < 0.1){
				        $(this).addClass('no-event');
				    }
			    });
			});
		}
	    $('.search-form').on('submit', function(e) {
	        oTable.draw();
	        e.preventDefault();
	    });
	    if($(".row-product").exists()){
			$('body').on('click', 'td.details-control', function () {
		        var tr = $(this).closest('tr');
		        var row = oTable.row(tr);
		        var tableId = 'products-' + row.data().id;
		        if (row.child.isShown()) {
		            // This row is already open - close it
		            row.child.hide();
		            tr.removeClass('shown');
		        } else {
		            // Open this row
		            row.child(template(row.data())).show();
		            initTable(tableId, row.data());
		            tr.addClass('shown');
		            tr.next().find('td').addClass('pd-1 bg-gray');
		        }
		    });
	    }
    });
    function initTable(tableId, data) {
        $('#' + tableId).DataTable({
            processing: true,
            serverSide: true,
            ajax: data.details_url,
            language: {
		    	paginate: {
		      		previous: '<i class="mdi mdi-chevron-left"></i>',
		      		next: '<i class="mdi mdi-chevron-right"></i>'
		    	},
		    	sProcessing: '<span class="spinner-border spinner-border-sm mr-1"></span>Loading...',

		  	},
			order: ['0', 'desc'],
			searching: false,
			lengthChange: false,
			pageLength: 5,
            columns: [
            	{data: 'id',name: 'id', visible: false},
                {data: 'checkbox', orderable: false, searchable: false},
		        {data: 'priority',name: 'priority', orderable: false, searchable: false},
		        {data: 'name',name: 'name'},
		        {data: 'export_price',name: 'export_price'},
		        {data: 'import_price',name: 'import_price'},
		        {data: 'status',name: 'status', orderable: false, searchable: false},
		        {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        })
    }
}else{
	$(window).on('load', function () {
		$(".container-fluid").css({'opacity':'1'});
	    $('#pre-loader').delay(250).fadeOut(function () {
	        // $('#pre-loader').remove();
	    });
	});
}	

$(document).on("click",'.dev-touchspin-btn',function(){
	var $button = $(this);
	var value = $button.parent().find("input").val();
	if($(this).attr('data-type') == 'plus'){
		value++;
		if(value > $button.parent().find("input").attr('max')){
			value = $button.parent().find("input").attr('max');
		}
	}else{
		value--;
		if(value < $button.parent().find("input").attr('min')){
			value = $button.parent().find("input").attr('min');
		}
	}
	$button.parent().find("input").val(value);
})
if($("#customer").exists()){
function formatRepo(repo) {
	
    if (repo.loading) return 'Đang tìm kiếm thông tin...';
 	if(repo.name!=undefined){
    	var markup = '<div class="media">' + '<div class="user-avatar mr-2 d-none"></div>' + '<div class="media-body">' + '<h6 class="my-0">' + repo.name + '</h6>';
    	markup += '<div class="small text-muted"><i class=" mdi mdi-map-marker-outline"></i>' + repo.address + '</div>';
    	markup += '<ul class="list-inline small text-muted">' + '<li class="list-inline-item"><i class="mdi mdi-phone"></i> ' + repo.phone + ' </li></ul>' + '</div></div>';
    	return markup;
	}else{return 'Chưa tồn tại khách hàng';}
};
function formatRepoSelection(repo) {
	if(repo.name==undefined){return 'Chọn khách hàng';}
	if( repo.id == "" || !parseInt(repo.id)){
		return 'Khách hàng chưa có trong hệ thống';
	}else{
		return '<div class="user-avatar user-avatar-xs mr-2  d-none"></div>' + repo.name +' - '+ repo.phone;
	}
  
};	
$(document).ready(function(){

	var selected = [];
    var initials = [];
    if($('#data-customer').exists()){
		var dataCus = JSON.parse($('#data-customer').attr("data-value"));
		initials.push({id: dataCus.id, name: dataCus.name, phone: dataCus.phone, address: dataCus.address});
    	selected.push(dataCus.id);
    	$("input[name='customer[name]']").val(dataCus.name);
      	$("input[name='customer[address]']").val(dataCus.address);
      	$("input[name='customer[phone]']").val(dataCus.phone);
	}
	$('#customer').select2({
		data: initials,
		ajax: {
          url: URL.base_url + '/admin/customer/show',
          type: 'GET',
          dataType: 'json',
          delay: 250,
          data: function data(params) {
            return {
              term: params.term,
              page: params.page
            };
          },
          processResults: function processResults(data, params) {
            params.page = params.page || 1;
            return {
		        results: data.items,
		        pagination: {
		          more: (params.page * 30) < data.total_count
		        }
	      	};
          },

        },
        escapeMarkup: function escapeMarkup(markup) {
          return markup;
        },
        minimumInputLength: 1,
		allowClear: true,
		placeholder: 'Chọn khách hàng',
		templateResult: formatRepo,
		templateSelection: formatRepoSelection    
    });
    $('#customer').val(selected).trigger('change');
    $('#customer').on('change',function(){
      var customer_id = $(this).val();
      if(customer_id){
      	var data = $(this).select2('data')[0];
      	$("input[name='customer[name]']").val(data.name);
      	$("input[name='customer[address]']").val(data.address);
      	$("input[name='customer[phone]']").val(data.phone);
      }else{
      	$("input[name='customer[name]']").val('');
      	$("input[name='customer[address]']").val('');
      	$("input[name='customer[phone]']").val('');
      }
    });
})
}

$(document).ready(function(){
	$(".nav-link-ajax").click(function(){
		var href = $(this).attr('data-href');
		$('#pre-loader').show();	
		$.ajax({
	        url: href,
	        type: 'GET',
	        error:function(x,e) {
			    backErrorAjax(x,e);
			},
			success:function(result){
				$('#pre-loader').delay(250).fadeOut(function () {});
				$('.report-html').html($(result).find('.report-html').html());
			},
	    });
	})
	photoZone("#photo-zone","#file-zone","#photoUpload-preview img");
})
