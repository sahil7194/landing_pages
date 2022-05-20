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
                      	<div class="top"><div class="form_heading">Edit Profile</div></div>

                        <div class="form_container">
                          <form name="form_profile" id="form_profile" method="POST">
                          <div class="col-md-6">
                            <div class="error form_error form-error-profile_fname" id="form-error-profile_fname"></div>
                            <div class="form-row form-row-first validate-required ecommerce-invalid ecommerce-invalid-required-field">
                              <label for="profile_fname">First Name
                                <abbr class="required" title="required">*</abbr>
                              </label>
                              <input type="text" class="input-text" placeholder name="profile_fname" id="profile_fname" value="<?php echo $profile_info[0]->fname; ?>">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="error form_error form-error-profile_lname" id="form-error-profile_lname"></div>
                            <div class="form-row validate-required ecommerce-invalid ecommerce-invalid-required-field">
                              <label for="profile_lname">Last Name
                                <abbr class="required" title="required">*</abbr>
                              </label>
                              <input type="text" class="input-text" placeholder name="profile_lname" id="profile_lname" value="<?php echo $profile_info[0]->lname; ?>">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="error form_error form-error-profile_mobile" id="form-error-profile_mobile"></div>
                            <div class="form-row validate-required ecommerce-invalid ecommerce-invalid-required-field">
                              <label for="profile_mobile">Mobile
                                <abbr class="required" title="required">*</abbr>
                              </label>
                              <input type="text" class="input-text" placeholder name="profile_mobile" id="profile_mobile" value="<?php echo $profile_info[0]->mobile; ?>">
                            </div>
                          </div>

                          <div class="clear"></div>

                          <div class="col-md-12">
                            <div class="error form_error form-error-profile_gender" id="form-error-profile_gender"></div>
                            <div class="form-row validate-required ecommerce-invalid ecommerce-invalid-required-field">
                              <label for="profile_gender">Gender
                              </label>
                              <div class="radio_custom">
                                  <input id="male" name="profile_gender" type="radio" <?php if($profile_info[0]->gender=='male'){ echo 'checked'; } ?> value="male">
                                  <label for="male">Male</label>
                                  <input id="female" name="profile_gender" type="radio" <?php if($profile_info[0]->gender=='female'){ echo 'checked'; } ?> value="female">
                                  <label for="female">Female</label>
                                  <input id="transgender" name="profile_gender" type="radio" <?php if($profile_info[0]->gender=='transgender'){ echo 'checked'; } ?> value="transgender">
                                  <label for="transgender">Transgender</label>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-row form-row-last ">
                              <label for="submit"></label>
                              <input type="submit" name="" class="btn btn-lg btn-color btn_full" id="" value="Save">
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