<div class="content-wrapper oh">
      
      <!-- Page Title -->
      <section class="page-title style-2">
        <div class="container relative clearfix">
          <div class="title-holder">
            <div class="title-text">
              <h1>My Account</h1>
              <ol class="breadcrumb">
                <li>
                  <a href="index.html">Home</a>
                </li>
                <li class="active">
                  My Account
                </li>
              </ol>
            </div>
          </div>
        </div>
      </section> <!-- end page title -->


      <!-- My Account -->
      <section class="section-wrap">

        <div class="container">
        <?php 
          if($this->session->flashdata('response')){
            $response = $this->session->flashdata('response');
            if(array_key_exists('error', $response)){
                echo '<div class="notification"><p class="alert '.$response['error']['class'].'">'.$response['error']['message'].'</p></div>';
            }else{
                echo '<div class="notification"><p class="alert '.$response['success']['class'].'">'.$response['success']['message'].'</p></div>';
            }
          }
        ?>
        </div>

        <div class="container relative">
          <div class="row">

            <div class="ecommerce col-xs-12 my_account_section">              

              <div class="col-md-2">
                <?php $this->load->view('account/links');?>
              </div> <!-- end col -->

              <div class="col-md-10">

                <div class="my_account_details">
                    
                    <div class="addresses">

                      <div class="addresses_row">
                      	<div class="top"><div class="form_heading">Change Password</div></div>                        

                        <div class="form_container">
                          <form method="POST" name="form_change_password" id="form_change_password">
                          <div class="col-md-6">
                            <div class="error form_error form-error-current_password" id="form-error-current_password"></div>
                            <div class="form-row form-row-first validate-required ecommerce-invalid ecommerce-invalid-required-field">
                              <label for="current_password">Current Password
                                <abbr class="required" title="required">*</abbr>
                              </label>
                              <input type="password" class="input-text" placeholder="Enter Current Password" value name="current_password" id="current_password">
                            </div>
                          </div>

                          <div class="clear"></div>

                          <div class="col-md-6">
                            <div class="error form_error form-error-new_password" id="form-error-new_password"></div>
                            <div class="form-row validate-required ecommerce-invalid ecommerce-invalid-required-field">
                              <label for="new_password">New Password
                                <abbr class="required" title="required">*</abbr>
                              </label>
                              <input type="password" class="input-text" placeholder="Enter New Password" value name="new_password" id="new_password">
                            </div>
                          </div>

                          <div class="clear"></div>

                          <div class="col-md-6">
                            <div class="error form_error form-error-confirm_password" id="form-error-confirm_password"></div>
                            <div class="form-row validate-required ecommerce-invalid ecommerce-invalid-required-field">
                              <label for="confirm_password">Confirm Password
                                <abbr class="required" title="required">*</abbr>
                              </label>
                              <input type="password" class="input-text" placeholder="Re-enter New Password" value name="confirm_password" id="confirm_password">
                            </div>
                          </div>

                          <div class="clear"></div>

                          <div class="col-md-6">
                            <div class="form-row form-row-last ">
                              <label for="submit"></label>
                              <input type="submit" class="btn btn-lg btn-color btn_full" id="" value="Change Password">
                            </div>
                          </div>
                        </form>

                          <div class="clear"></div>
                        </div>
                        
                        <div class="clear"></div>

                      </div>
                      <div class="clear"></div>

                    </div>



                </div>

              </div>


            </div> <!-- end ecommerce -->

          </div> <!-- end row -->
        </div> <!-- end container -->
      </section> <!-- end checkout -->