if($('.row-wms').exists()){
	var method = $(".method").attr('data-method');
	var stt_price = method == 'import' ?  4:3;
	var name_price = method == 'import' ? 'import_price':'export_price';
	function addProduct(temp){
		$(".first-same-item").append($(temp).html());
		$('.price--format').mask('000,000,000,000',{reverse: true});
	}
	function calulateTotal(){
    	var total = 0;
    	var ship = ($("#ship_price").exists() && $("#ship_price").val()!=='') ? $("#ship_price").val().replaceAll(',','') :  0;
    	var reduce = ($("#reduce_price").exists() && $("#reduce_price").val()!=='') ? $("#reduce_price").val().replaceAll(',','') :  0;
    	$(".first-same-item tr").each(function(){
    		total+=(parseFloat($(this).find('input[name="data_child[quantity][]"]').val()) * parseInt($(this).find('input[name="data_child['+name_price+'][]"]').val().replaceAll(',','')));
    	});
    	total = total + parseInt(ship) - parseInt(reduce);
    	total = total > 0 ? total : 0;
    	return number_format(total, 0,'',',');
    }
	var bool = false;
	$(".btn-modal--product").click(function(){
		$("input.select-checkbox").each(function(){
			$(this).prop('checked',false); 
		});
	})
	$(".btn--add__product").click(function(){
		var listId = "";
		
	    $("input.select-checkbox").each(function(k,v){
	        if(this.checked){
	        	var data = {};
	        	data.id = $(this).val();
	        	data.name = $(this).closest('tr').find('td:nth-child(2)').text();
	        	data.price = $(this).closest('tr').find('td:nth-child('+stt_price+')').text();
	        	data.unit = $(this).closest('tr').find('td:nth-child(5)').text();
	        	addTextTemp('#product-pattern','.name-product',data.name);
	        	addValueTemp('#product-pattern','input[name="data_child[product_id][]"]',data.id);
	        	addValueTemp('#product-pattern','input[name="data_child['+name_price+'][]"]',data.price);
	        	addTextTemp('#product-pattern','.unit-val',data.unit);
	        	addTextTemp('#product-pattern','.into-money',data.price);
	        	addProduct('#product-pattern');
	        }
	    });
	    $(".total-price").text(calulateTotal());
	    // listId = listId.substr(1);
	})
	$(document).on("click keyup",'.dev-touchspin-btn,.price--format,input[name="data_child[quantity][]"]',function(){
		var button = $(this);
		var parent = $(this).parents('tr');
		var price  = parent.find('.price--format').val();
		var intoMoney = parseFloat(parent.find('input[name="data_child[quantity][]"]').val()) * parseInt(price.replaceAll(',',''));
		parent.find('.into-money').text(number_format(intoMoney, 0,'',','));
		$(".total-price").text(calulateTotal());
	});
	$(document).on('click','.btn_remove--row-child', function(){
		$(this).parents('tr').remove();
		$(".total-price").text(calulateTotal());
	})
	$(document).on('keyup','#reduce_price,#ship_price', function(){
		$(".total-price").text(calulateTotal());
	})

}
if($("#store_from").exists()){
	$("#store_from").change(function(){
		window.location ="?store_from_id="+$(this).val();
	})
}