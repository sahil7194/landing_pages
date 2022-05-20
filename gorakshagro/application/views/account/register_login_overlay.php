<div class="body_overlay" id="register_login_overlay">
  <div class="register_login_box">
    <div class="col-md-7">
    	<div class="register_container">            
    		<div class="heading">New Customer?</div>
    		<div class="sub_title">Hurry! Sign Up Now and Get Exciting Offers.</div>
    		<div class="form_register_box">
                <form name="form_register" id="form_register" method="POST">
    			<div class="form_row">
    				<div class="c-6">
                        <div class="error form_error" id="form-error-email"></div>
    					<div class="material-input">
							<input name="email" id="email" class="input_text" required="" type="text" autocomplete="off">
							<span></span>
							<label>Email*</label>			
						</div>
					</div>
					<div class="c-6">
                        <div class="error form_error" id="form-error-mobile"></div>
    					<div class="material-input">
							<input name="mobile" id="mobile" class="input_text" required="" type="text" autocomplete="off">
							<span></span>
							<label>Mobile*</label>			
						</div>
					</div>
					<div class="clr"></div>
    			</div>    			
    			<div class="form_row">
					<div class="c-6">
                        <div class="error form_error" id="form-error-fname"></div>
    					<div class="material-input">
							<input name="fname" id="fname" class="input_text" required="" type="text" autocomplete="off">
							<span></span>
							<label>First Name*</label>			
						</div>
					</div>
					<div class="c-6">
                        <div class="error form_error" id="form-error-lname"></div>
    					<div class="material-input">
							<input name="lname" id="lname" class="input_text" required="" type="text" autocomplete="off">
							<span></span>
							<label>Last Name*</label>			
						</div>
					</div>
					<div class="clr"></div>
    			</div>
    			<div class="form_row">
    				<div class="c-12">
                        <div class="error form_error" id="form-error-password"></div>
						<div class="material-input">
							<input name="password" id="password" class="input_text" required="" type="password" autocomplete="off">
							<span></span>
							<label>Password*</label>			
						</div>
					</div>
					<div class="clr"></div>
    			</div>
    			<div class="form_row">
    				<div class="c-12">
                        <div class="error form_error" id="form-error-gender"></div>
						<div class="radio_custom">
                            <input id="male" name="gender" type="radio" value="male">
                            <label for="male">Male</label>
                            <input id="female" name="gender" type="radio" value="female">
                            <label for="female">Female</label>                            
                            <input id="transgender" name="gender" type="radio" value="transgender">
                            <label for="transgender">Transgender</label>
                        </div>
					</div>
					<div class="clr"></div>
    			</div>
    			<div class="form_row">
    				<div class="form-row">
    					<input type="submit" name="" class="btn btn-lg btn-color btn_full" id="" value="Register">
    				</div>
    			</div> 
                </form>
    		</div>

            <div class="form_register_verify_email_box" id="form_register_verify_email_box">
                <form name="form_new_email_verify_otp" id="form_new_email_verify_otp" method="POST">
                <div class="form_row">
                    <div class="c-12">
                        <div class="error form_error" id="form-error-new_email_otp"></div>
                        <div class="material-input">
                            <input name="new_email_otp" id="new_email_otp" class="input_text" required="" type="text" autocomplete="off">
                            <span></span>
                            <label>OTP*</label>           
                        </div>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="form_row">
                    <div class="form-row">
                        <input type="submit" name="" class="btn btn-lg btn-color btn_full" id="" value="Verify">
                    </div>
                </div> 
                </form>
            </div>

            
    	</div>
    </div>
    <div class="col-md-5">

    	<div class="login_container login_account_container">
    		<div class="heading">Already Have An Account?</div>
    		<div class="sub_title">Login To Track Your Order, Use Wishlist & More.</div>
    		<div class="form_login_box">
                <form name="form_login" id="form_login" method="POST">
    			<div class="form_row">
                    <div class="notify_error"></div>
    				<div class="c-12">
                        <div class="error form_error" id="form-error-login_email"></div>
    					<div class="material-input">
							<input name="login_email" id="login_email" class="input_text" required="" type="text" autocomplete="off">
							<span></span>
							<label>Email ID*</label>			
						</div>
					</div>
					<div class="c-12">
                        <div class="error form_error" id="form-error-login_password"></div>
    					<div class="material-input">
							<input name="login_password" id="login_password" class="input_text" required="" type="password" autocomplete="off">
							<span></span>
							<label>Password*</label>			
						</div>
					</div>
					<div class="clr"></div>
    			</div>
    			<div class="form_row">
    				<div class="c-12">
						<div class="checkbox_custom">
                            <input id="remember" name="remember" type="checkbox" class="styled">
                            <label for="remember">Remember me?</label>
                        </div>
					</div>
					<div class="clr"></div>
    			</div>
    			<div class="form_row">
    				<div class="form-row">
    					<input type="submit" name="" class="btn btn-lg btn-color2 btn_full" id="" value="Login">
    				</div>
    			</div>
                </form>
                <a class="forgot_password_btn">Forgot Password?</a>

    		</div>
    	</div>



        <div class="login_container forgot_password_container">
            <div class="heading">Forgot Password?</div>
            <div class="sub_title forgot_subtitle">Enter an email to reset password</div>

            <div class="form_forgot_password_email_box">
                <div class="notify_error" id="forgot_password_email_notify_error"></div>
                <form name="form_forgot_password_email" id="form_forgot_password_email" method="POST">
                <div class="form_row">                    
                    <div class="c-12">
                        <div class="error form_error" id="form-error-forgot_password_email"></div>
                        <div class="material-input">
                            <input name="forgot_password_email" id="forgot_password_email" class="input_text" required="" type="text" autocomplete="off">
                            <span></span>
                            <label>Email ID*</label>            
                        </div>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="form_row">
                    <div class="form-row">
                        <input type="submit" name="" class="btn btn-lg btn-color2 btn_full" id="forgot_password_submit_btn" value="Submit">
                    </div>
                </div>
                </form>
                <div class="clr"></div>
            </div>

            <div class="form_forgot_verify_otp_box">
                <div class="notify_error" id="otp_notify_error"></div>
                <form name="form_forgot_verify_otp" id="form_forgot_verify_otp" method="POST">
                <div class="form_row">                    
                    <div class="c-12">
                        <div class="error form_error" id="form-error-otp_forgot_password"></div>
                        <div class="material-input">
                            <input name="otp_forgot_password" id="otp_forgot_password" class="input_text" required="" type="text" autocomplete="off">
                            <span></span>
                            <label>OTP*</label>
                        </div>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="form_row">
                    <div class="form-row">
                        <input type="submit" name="" class="btn btn-lg btn-color btn_full" id="otp_forgot_password_submit_btn" value="Verify">
                    </div>
                </div>
                </form>
                <div class="clr"></div>
            </div>            

            <div class="form_set_new_password_box">
                <div class="notify_error" id="otp_notify_error"></div>
                <form name="form_set_new_password" id="form_set_new_password" method="POST">
                <div class="form_row">                    
                    <div class="c-12">
                        <div class="error form_error" id="form-error-new_password"></div>
                        <div class="material-input">
                            <input name="new_password" id="new_password" class="input_text" required="" type="password" autocomplete="off">
                            <span></span>
                            <label>New Password*</label>
                        </div>
                    </div>
                    <div class="clr"></div>
                    <div class="c-12">
                        <div class="error form_error" id="form-error-confirm_new_password"></div>
                        <div class="material-input">
                            <input name="confirm_new_password" id="confirm_new_password" class="input_text" required="" type="password" autocomplete="off">
                            <span></span>
                            <label>Confirm Password*</label>
                        </div>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="form_row">
                    <div class="form-row">
                        <input type="submit" name="" class="btn btn-lg btn-color btn_full" id="form_set_new_password_submit_btn" value="Submit">
                    </div>
                </div>
                </form>
            </div>

        </div>


    </div>
    <div class="clear"></div>

    <a class="close_overlay"></a>
  </div>  
</div>