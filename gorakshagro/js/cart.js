
$(document).ready(function(){


  $(".product_option_select").on('change', function(e) {
    var amount = $(this).find(":selected").data('amount');
    $("#product_price").val(amount);
    $("#special_price_display").html(amount);
  });


	$("#cart_add_form").on('submit',(function(e){
        e.preventDefault();
        $(".form_error").html("");

        $.ajax({
            type: "POST",
            url: BaseUrl.siteRoot+"cart/add",
            data:  new FormData(this),
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function(result) {
                location.reload(true);
            },
            error: function(data){
                var responseData = data.responseJSON;
                if(responseData.error.error_type=='form'){
                    jQuery.each( responseData.error.errors, function( i, val ) {
                        $("#form-error-"+i).html(val);
                    });
                }else{
                    $("#code_error").html(responseData.error.message);
                    $("#code_error").addClass('alert-danger');
                }
            }
        });

    }));


	 $(".cart_qty_minus").on('click', function(e) {
      e.preventDefault();
      var quantityInput = jQuery(this).parents('.quantity').find('input.qty'),
        newValue = parseInt(quantityInput.val(), 10) - 1,
        minValue = parseInt(quantityInput.attr('min'), 10);
        var row_id = $(this).data('row_id');
      
      if (!minValue) {
        minValue = 1;
      }

      	if ( newValue >= minValue ) {
        	quantityInput.val(newValue);

	        $.ajax({
	            type: "POST",
	            url: BaseUrl.siteRoot+"cart/update",
	            data: {row_id:row_id,qty:newValue},
	            dataType: 'json',
	            success: function(result) {
	              location.reload(true);
	            },
	            error: function(data){
	              var errors = data.responseJSON;          
	              jQuery.each( errors.errors, function( i, val ) {
	                $("#form-error-"+i).html(val);
	              }); 
	             
	            }
	            
	        });

        	quantityInput.change();
      	}
    });

    $(".cart_qty_plus").on('click', function(e) {
      	e.preventDefault();
      	var quantityInput = jQuery(this).parents('.quantity').find('input.qty'),
        newValue = parseInt(quantityInput.val(), 10) + 1,
        maxValue = parseInt(quantityInput.attr('max'), 10);
        var row_id = $(this).data('row_id');


      	if (!maxValue) {
        	maxValue = 9999999999;
      	}

      	if ( newValue <= maxValue ) {
        	quantityInput.val(newValue);

        	$.ajax({
	            type: "POST",
	            url: BaseUrl.siteRoot+"cart/update",
	            data: {row_id:row_id,qty:newValue},
	            dataType: 'json',
	            success: function(result) {
	              location.reload(true);
	            },
	            error: function(data){
	              var errors = data.responseJSON;          
	              jQuery.each( errors.errors, function( i, val ) {
	                $("#form-error-"+i).html(val);
	              }); 
	             
	            }
	            
	        });

        	quantityInput.change();
      	}

    });


    $(".remove_item").on('click', function(e) {
    	e.preventDefault();
      var row_id = $(this).data('row_id');
      var qty = 0;

      $.ajax({
        type: "POST",
        url: BaseUrl.siteRoot+"cart/update",
        data: {row_id:row_id,qty:qty},
        dataType: 'json',
        success: function(result) {
          location.reload(true);
        },
        error: function(data){
          var errors = data.responseJSON;          
          jQuery.each( errors.errors, function( i, val ) {
            $("#form-error-"+i).html(val);
          }); 
         
        }
        
      });

    });

    $(".checkout_btn").on('click', function() {

      $.ajax({
        type: "POST",
        url: BaseUrl.siteRoot+"customer/checkout",
        data: {},
        dataType: 'json',
        success: function(result) {
          if(result.success.message=='login_false'){
            $("#register_login_overlay").fadeIn();
          }else{
            location.href=BaseUrl.siteRoot+"checkout";
          }
        }
        
      });

    });


    $('.delivery_address_options').on('click', function(){
        var address_id = $(this).val();

        $.ajax({
          type: "POST",
          url: BaseUrl.siteRoot+"order/set_delivery_address",
          data: {address_id:address_id},
          dataType: 'json',
          success: function(result) {
            
          }
          
        });

    });


    $("#payment_mode").on('change', function(e) {
      var payment_mode = $(this).find(":selected").val();
      if(payment_mode=='COD'){
        $(".upi_transaction_id_field").css({'display':'none'});
      }else{
        $(".upi_transaction_id_field").css({'display':'table-row'});
      }
    });


    $('#order_save').on('click', function(){
      
      $(".form_error").html("");
      var payment_mode = $("#payment_mode").find(":selected").val();
      var upi_transaction_id = $("#upi_transaction_id").val();

      $.ajax({
        type: "POST",
        url: BaseUrl.siteRoot+"order/save",
        data: { payment_mode:payment_mode,upi_transaction_id:upi_transaction_id},
        dataType: 'json',
        success: function(result) {
          location.href=BaseUrl.siteRoot+"order/status/success";
        },
        error: function(data){
          var responseData = data.responseJSON;

          if(responseData.error.error_type=='form'){
              jQuery.each( responseData.error.errors, function( i, val ) {
                  $("#form-error-"+i).html(val);
              });
          }else if(responseData.error.error_type=='delivery_address'){
			$('html, body').animate({
				scrollTop: $(".address_notification").offset().top
			}, 2000);
			$(".address_notification").html('<p class="alert alert-danger">Please select delivery address.</p>');
          }
        }
        
      });

    });
    


});

 