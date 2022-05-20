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
                  <p><strong>Hello <?php echo $this->session->userdata('fname');?></strong><br/>
                  From your account dashboard you can view your recent orders, manage your shipping and billing addresses and edit your password and account details.</p>
                </div>
              </div>


            </div> <!-- end ecommerce -->

          </div> <!-- end row -->
        </div> <!-- end container -->
      </section> <!-- end checkout -->