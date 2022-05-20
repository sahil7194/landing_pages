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
                      	<div class="top"><div class="form_heading">Add New Address</div></div>

                        <div class="form_container">
                          <form name="form_address_new" id="form_address_new" class="form_address_new">
                          <div class="col-md-6">
                            <div class="error form_error form-error-contact_name" id="form-error-contact_name"></div>
                            <div class="form-row form-row-first validate-required ecommerce-invalid ecommerce-invalid-required-field">
                              <label for="contact_name">Name
                                <abbr class="required" title="required">*</abbr>
                              </label>
                              <input type="text" class="input-text" placeholder value name="contact_name" id="contact_name">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="error form_error form-error-mobile" id="form-error-mobile"></div>
                            <div class="form-row validate-required ecommerce-invalid ecommerce-invalid-required-field">
                              <label for="mobile">Mobile
                                <abbr class="required" title="required">*</abbr>
                              </label>
                              <input type="text" class="input-text" placeholder value name="mobile" id="mobile">
                            </div>
                          </div>
                          <div class="clear"></div>

                          <div class="col-md-6">
                            <div class="error form_error form-error-pincode" id="form-error-pincode"></div>
                            <div class="form-row validate-required ecommerce-invalid ecommerce-invalid-required-field">
                              <label for="pincode">Pincode
                                <abbr class="required" title="required">*</abbr>
                              </label>
                              <input type="text" class="input-text" placeholder value name="pincode" id="pincode">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="error form_error form-error-locality" id="form-error-locality"></div>
                            <div class="form-row validate-required ecommerce-invalid ecommerce-invalid-required-field">
                              <label for="locality">Locality
                                <abbr class="required" title="required">*</abbr>
                              </label>
                              <input type="text" class="input-text" placeholder value name="locality" id="locality">
                            </div>
                          </div>
                          <div class="clear"></div>

                          <div class="col-md-12">
                            <div class="error form_error form-error-address" id="form-error-address"></div>
                            <div class="form-row validate-required ecommerce-invalid ecommerce-invalid-required-field">
                              <label for="address">Address
                                <abbr class="required" title="required">*</abbr>
                              </label>
                              <textarea class="input-text" placeholder value name="address" id="address"></textarea>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="error form_error form-error-city" id="form-error-city"></div>
                            <div class="form-row validate-required ecommerce-invalid ecommerce-invalid-required-field">
                              <label for="city">City/District/Town
                                <abbr class="required" title="required">*</abbr>
                              </label>
                              <input type="text" class="input-text" placeholder value name="city" id="city">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="error form_error form-error-state" id="form-error-state"></div>
                            <div class="form-row validate-required ecommerce-invalid ecommerce-invalid-required-field">
                              <label for="state">State
                                <abbr class="required" title="required">*</abbr>
                              </label>
                              <select name="state">
                                <option value="">--Select State--</option>
                                <?php foreach($states as $state){ ?>
                                  <option value="<?php echo $state->name; ?>"><?php echo $state->name; ?></option>  
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                          <div class="clear"></div>

                          <div class="col-md-6">
                            <div class="error form_error form-error-landmark" id="form-error-landmark"></div>
                            <div class="form-row validate-required ecommerce-invalid ecommerce-invalid-required-field">
                              <label for="landmark">Landmark
                              </label>
                              <input type="text" class="input-text" placeholder value name="landmark" id="landmark">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="error form_error form-error-alternate_phone" id="form-error-alternate_phone"></div>
                            <div class="form-row validate-required ecommerce-invalid ecommerce-invalid-required-field">
                              <label for="alternate_phone">Alternate Phone Number
                              </label>
                              <input type="text" class="input-text" placeholder value name="alternate_phone" id="alternate_phone">
                            </div>
                          </div>
                          <div class="clear"></div>

                          <div class="col-md-6">
                            <div class="error form_error form-error-address_code" id="form-error-address_code"></div>
                            <div class="form-row validate-required ecommerce-invalid ecommerce-invalid-required-field">
                              <label for="state">Area Code
                                <abbr class="required" title="required">*</abbr>
                              </label>
                              <select name="address_code">
                                <option value="">--Select Code--</option>
                                <?php foreach($addresse_codes as $addresse_code){ ?>
                                  <option value="<?php echo $addresse_code->code; ?>"><?php echo $addresse_code->code; ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-12">
                            <div class="error form_error form-error-address_type" id="form-error-address_type"></div>
                            <div class="form-row validate-required ecommerce-invalid ecommerce-invalid-required-field">
                              <label for="address_type">Address Type
                              </label>
                              <div class="radio_custom">
                                  <input id="home" name="address_type" type="radio" value="Home">
                                  <label for="home">Home</label>
                                  <input id="work" name="address_type" type="radio" value="Work">
                                  <label for="work">Work</label>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-row form-row-last ">
                              <label for="submit"></label>
                              <input type="submit" name="" class="btn btn-lg btn-color btn_full" id="" value="Add">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-row form-row-last ">
                              <label for="submit"></label>
                              <a class="btn btn-lg btn-color2 btn_full" id="">Cancel</a>
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