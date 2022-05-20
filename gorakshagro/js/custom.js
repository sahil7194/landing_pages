
$(document).ready(function(){
	$(".loader_overlay").fadeOut();
});

 
$(document).ajaxStart(function(){
 // Show image container
 //$(".loader_overlay").show();
 $('input[type="submit"]').prop("disabled", true);
});

$(document).ajaxComplete(function(){
 // Hide image container
 //$(".loader_overlay").hide();
 $('input[type="submit"]').prop("disabled", false);
});


$(document).ready(function(){	


	$('.register_login_btn').on('click', function(){
		$("#register_login_overlay").fadeIn();
	});

    $('.logout_btn').on('click', function(){

        $.ajax({
            type: "POST",
            url: BaseUrl.siteRoot+"account/logout",
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function(result) {
                location.href=BaseUrl.siteRoot;
            }
        });

    });

	$('.close_overlay').on('click', function(){
		$(".body_overlay").fadeOut();
	});


	/***Start Register***/
	$("#form_register").on('submit',(function(e){
        e.preventDefault();
        $(".form_error").html("");        

        $.ajax({
            type: "POST",
            url: BaseUrl.siteRoot+"customer/register",
            data:  new FormData(this),
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function(result) {
                // $(".form_register_box").css({'display':'none'});
                // $(".form_register_verify_email_box").fadeIn();
				$(".register_container").html('<div class="register_success"><div class="line1">Successful</div><div class="line2">Your account has been created.</div><div class="line2">Please login...</div></div>');
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
    /***End Register***/    


    /***Start New Email Verify***/
    $("#form_new_email_verify_otp").on('submit',(function(e){
        e.preventDefault();
        $(".form_error").html("");        

        $.ajax({
            type: "POST",
            url: BaseUrl.siteRoot+"customer/new_email_verify_otp",
            data:  new FormData(this),
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function(result) {
                $(".register_container").html('<div class="register_success"><div class="line1">Successful</div><div class="line2">Your account has been created.</div><div class="line2">Please login...</div></div>');
            },
            error: function(data){
                var responseData = data.responseJSON;
                if(responseData.error.error_type=='form'){
                    jQuery.each( responseData.error.errors, function( i, val ) {
                        $("#form-error-"+i).html(val);
                    });
                }else{
                    $("#form-error-new_email_otp").html(responseData.error.message);
                }
            }
        });

    }));
    /***End New Email Verify***/



    /***Start Login***/
	$("#form_login").on('submit',(function(e){
        e.preventDefault();
        $(".form_error").html("");        

        $.ajax({
            type: "POST",
            url: BaseUrl.siteRoot+"customer/authentication",
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
                	$(".notify_error").html(responseData.error.message);
                }
            }
        });

    }));
    /***End Login***/


    $('.forgot_password_btn').on('click', function(){
		$(".login_account_container").css({'display':'none'});
		$(".forgot_password_container").fadeIn();
	});

    /***Start Forgot Password***/
    $("#form_forgot_password_email").on('submit',(function(e){
        e.preventDefault();
        $(".form_error").html("");
        $("#forgot_password_submit_btn").val("Resend");

        $.ajax({
            type: "POST",
            url: BaseUrl.siteRoot+"customer/forgot_password_email_process",
            data:  new FormData(this),
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function(result) {
                $(".forgot_password_email_notify_error").html(result.success.message);
                $(".form_forgot_verify_otp_box").fadeIn();
            },
            error: function(data){
                var responseData = data.responseJSON;
                if(responseData.error.error_type=='form'){
                    jQuery.each( responseData.error.errors, function( i, val ) {
                        $("#form-error-"+i).html(val);
                    });
                }else{
                    $("#forgot_password_email_notify_error").html(responseData.error.message);
                }
            }
        });

    }));
    /***End Forgot Password***/

    /***Start Forgot Password Enter OTP***/
    $("#form_forgot_verify_otp").on('submit',(function(e){
        e.preventDefault();
        $(".form_error").html("");        

        $.ajax({
            type: "POST",
            url: BaseUrl.siteRoot+"customer/forgot_password_verify_otp",
            data:  new FormData(this),
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function(result) {
                $(".form_forgot_password_email_box").css({'display':'none'});
                $(".form_forgot_verify_otp_box").css({'display':'none'});
                $(".form_set_new_password_box").fadeIn();
                $(".forgot_subtitle").html('');
            },
            error: function(data){
                var responseData = data.responseJSON;
                if(responseData.error.error_type=='form'){
                    jQuery.each( responseData.error.errors, function( i, val ) {
                        $("#form-error-"+i).html(val);
                    });
                }else{
                    $("#otp_notify_error").html(responseData.error.message);
                }
            }
        });

    }));
    /***End Forgot Password Enter OTP***/

    /***Start Set new Password***/
    $("#form_set_new_password").on('submit',(function(e){
        e.preventDefault();
        $(".form_error").html("");        

        $.ajax({
            type: "POST",
            url: BaseUrl.siteRoot+"customer/set_new_password",
            data:  new FormData(this),
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function(result) {
                $(".forgot_password_container").css({'display':'none'});
                $(".login_account_container").fadeIn();
            },
            error: function(data){
                var responseData = data.responseJSON;
                if(responseData.error.error_type=='form'){
                    jQuery.each( responseData.error.errors, function( i, val ) {
                        $("#form-error-"+i).html(val);
                    });
                }
            }
        });

    }));
    /***End Set new Password***/


    /***Address new***/
    $(".form_address_new").on('submit',(function(e){
        e.preventDefault();
        $(".form_error").html("");        

        $.ajax({
            type: "POST",
            url: BaseUrl.siteRoot+"account/address_store",
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
                        $(".form-error-"+i).html(val);
                    });
                }else{
                    $(".notify_error").html(responseData.error.message);
                }
            }
        });

    }));
    /***End Address new***/    


    
    $('.address_edit_btn').on('click', function(){
        var form_id = $(this).data('id');
        $(".form_address_edit_container").css({'display':'none'});
        $("#address_row_"+form_id).css({'display':'none'});
        $("#form_id_"+form_id).fadeIn();
    });


    $('.add_to_wishlist').on('click', function(){
        var product_id = $(this).data('id');

        $.ajax({
            type: "POST",
            url: BaseUrl.siteRoot+"customer/add_to_wishlist",
            data: {product_id:product_id},
            dataType: 'json',
            success: function(result) {              
              if(result.success.message=='login_false'){
                $("#register_login_overlay").fadeIn();
              }else{
                location.reload(true);
              }
            },
            error: function(data){
              var errors = data.responseJSON;          
              jQuery.each( errors.errors, function( i, val ) {
                $("#form-error-"+i).html(val);
              }); 
             
            }
            
        });
    });

    $('.remove_wishlist_item').on('click', function(){
        var product_id = $(this).data('id');

        $.ajax({
            type: "POST",
            url: BaseUrl.siteRoot+"account/remove_wishlist_item",
            data: {product_id:product_id},
            dataType: 'json',
            success: function(result) {              
              $("#wi_"+product_id).closest('.product_details_row').remove();
            },
            error: function(data){
              var errors = data.responseJSON;          
              jQuery.each( errors.errors, function( i, val ) {
                $("#form-error-"+i).html(val);
              }); 
             
            }
            
        });

    });


    /***Start Edit Profile***/
    $("#form_profile").on('submit',(function(e){
        e.preventDefault();
        $(".form_error").html("");        

        $.ajax({
            type: "POST",
            url: BaseUrl.siteRoot+"account/profile_store",
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
    /***End Edit Profile***/


    /***Start Change Password***/
    $("#form_change_password").on('submit',(function(e){
        e.preventDefault();  
        $(".form_error").html("");

        $.ajax({
            type: "POST",
            url: BaseUrl.siteRoot+"account/change_password_process",
            data:  new FormData(this),
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                location.reload(true);
            },
            error: function(data){
                var responseData = data.responseJSON;
                if(responseData.error.error_type=='form'){
                    jQuery.each( responseData.error.errors, function( i, val ) {
                        $("#form-error-"+i).html(val);
                    });
                }else{
                    location.reload(true);
                }
            }
        });

    }));
    /***End Change Password***/

    $(".sort_opt_select").on('change', function(e) {
        var sort_option = $(this).find(":selected").val();
        
        $.ajax({

            type: "POST",
            url: BaseUrl.siteRoot+"products/set_sort_option",
            data: { sort_option:sort_option },
            dataType: 'json',
            success: function(result) {
              location.reload(true);
            },
            error: function(data){
              var responseData = data.responseJSON;

              if(responseData.error.error_type=='form'){
                  jQuery.each( responseData.error.errors, function( i, val ) {
                      $("#form-error-"+i).html(val);
                  });
              }
            }
        
        });
    });


    $("#select_location").on('change', function(e) {
        var selected_location = $(this).find(":selected").val();
        
        $.ajax({

            type: "POST",
            url: BaseUrl.siteRoot+"home/activate_select_location",
            data: { selected_location:selected_location },
            dataType: 'json',
            success: function(result) {
              location.reload(true);
            },
            error: function(data){
              var responseData = data.responseJSON;

              if(responseData.error.error_type=='form'){
                  jQuery.each( responseData.error.errors, function( i, val ) {
                      $("#form-error-"+i).html(val);
                  });
              }
            }
        
        });
    });

});

 