 $(document).ready(function(){
	$(document).on('click', '#checkAll', function() {          	
		$(".itemRow").prop("checked", this.checked);
	});	
	$(document).on('click', '.itemRow', function() {  	
		if ($('.itemRow:checked').length == $('.itemRow').length) {
			$('#checkAll').prop('checked', true);
		} else {
			$('#checkAll').prop('checked', false);
		}
	});  
	var count = $(".itemRow").length;
	
	$(document).on('click', '#addRows', function() { 
		count++;
		var htmlRows = '';
		htmlRows += '<tr>'; 
		htmlRows += '<td><div class="custom-control custom-checkbox"> <input type="checkbox" class="custom-control-input itemRow" id="itemRow_'+count+'"> <label class="custom-control-label" for="itemRow_'+count+'"></label> </div></td>';     
		htmlRows += '<td><input type="text" name="pelanggan[]" id="pelanggan_'+count+'" class="form-control pelanggan" autocomplete="off" value="0"></td>';	  		
		htmlRows += '<td><input type="number" name="bayar[]" id="bayar_'+count+'" class="form-control price" autocomplete="off" value="0"></td>';		 
		htmlRows += '<td><input type="number" name="bHutang[]" id="bHutang_'+count+'" class="form-control total" autocomplete="off" value="0"></td>';
		htmlRows += '<td><input type="number" name="hutang[]" id="hutang_'+count+'" class="form-control total" autocomplete="off" value="0"></td>';
		htmlRows += '<td><input type="number" name="bKupon[]" id="bKupon_'+count+'" class="form-control total" autocomplete="off" value="0"></td>'; 
		htmlRows += '<td><input type="number" name="BHK[]" id="BHK_'+count+'" class="form-control total" autocomplete="off" value="0"></td>';   
		htmlRows += '<td><input type="number" disabled name="harga[]" id="harga_'+count+'" class="form-control total" autocomplete="off" value="0"></td>';
		htmlRows += '<td><input type="number" name="total[]" id="total_'+count+'" class="form-control total" autocomplete="off" value="0"></td>';      
		htmlRows += '</tr>';
		$('#invoiceItem').append(htmlRows);
	}); 
	$(document).on('click', '#removeRows', function(){
		$(".itemRow:checked").each(function() {
			$(this).closest('tr').remove();
		});
		$('#checkAll').prop('checked', false);
		calculateTotal();
	});
	// kupon
	$(document).on('blur', "[id^=bKupon_]", function(){
		calculateKupon();
		calculateGalon()
	});	
	$(document).on('blur', "[id^=BHK_]", function(){
		calculateKupon();
	});	
	// input 
	$(document).on('blur', "[id^=bayar_]", function(){
		calculateTotal();
		calculateGalon()
		calculateGrandTotal()
	});
	$(document).on('blur', "[id^=hutang_]", function(){
		calculateGalon()
	});	
	$(document).on('blur', "[id^=bHutang_]", function(){
		calculateTotal();
		calculateGrandTotal()
	});	
	$(document).on('blur', "[id^=harga_]", function(){
		calculateTotal();
	});

	$(document).on('keyup','.pelanggan', function(){		
		$('[id^=pelanggan_').each(function(){
			var id = $(this).attr("id");
			id = id.replace('pelanggan_', '');
			var keyword = $(this).val();
			$.ajax({
				url:"data.php/",
				method:"POST",
				dataType: "json",	
				success:function(data) {
					$('#harga_'+id).val(data[0]);
					// console.log(data[0])
				}
			});// 
		});
	}); // end pelanggan
});	// document ready
function calculateKupon() {
	var totalKupon = 0;
	$('[id^=bKupon_]').each(function() {
		var id = $(this).attr('id');
		id	= id.replace('bKupon_', '');
		var bayarKupon = $('#bKupon_'+id).val();
		var BHK = $('#BHK_'+id).val();
		var total =12*(parseFloat(bayarKupon)+parseFloat(BHK));
		totalKupon += total;
		$('#kupon').val(totalKupon);		
		console.log(totalKupon);
	});
}

function calculateGalon(){
	var totalGalon = 0	
	$('[id^=bayar_]').each(function(){
		var id	= $(this).attr('id')
		id	= id.replace('bayar_', '')
		var bayar = $('#bayar_'+id).val();
		var hutang = $('#hutang_'+id).val()	
		var bayarKupon = $('#bKupon_'+id).val()

		var total = parseFloat(bayar)+parseFloat(hutang)+parseFloat(bayarKupon)
		totalGalon += total
		$('#galon').val(totalGalon)
	})
}

function calculateGrandTotal() {
	var grandTotal = 0;
	$('[id^=total_]').each(function() {
		var id = $(this).attr('id');
		id	= id.replace('total_', '');
		var total = $('#total_'+id).val();
		grandTotal += parseFloat(total);
		$('#total').val(grandTotal);
	});
}

function calculateTotal(){
	var totalAmount = 0; 
	$("[id^='bayar_']").each(function() {
		var id = $(this).attr('id');
		id = id.replace("bayar_",'');
		var harga = $('#harga_'+id).val();
		var bayar  = $('#bayar_'+id).val();
		var bHutang	= $('#bHutang_'+id).val();
		var total = harga*( parseFloat(bHutang) + parseFloat(bayar) );
		$('#total_'+id).val(parseInt(total));
		totalAmount += total;			
	});
}

 