<div class="content-wrapper oh">

	<!-- Page Title -->
      <section class="page-title style-2">
        <div class="container relative clearfix">
          <div class="title-holder">
            <div class="title-text">
              <h1>Order Status</h1>
              <ol class="breadcrumb">
                <li>
                  <?php echo anchor(base_url(),'Home'); ?>
                </li>                
              </ol>
            </div>
          </div>
        </div>
      </section> <!-- end page title --> 
      
      <!-- 404 -->
      <section class="section-wrap">
        <div class="container">

          <div class="row text-center">
            <div class="col-md-6 col-md-offset-3">
              <h1>
              	<?php
              	if($this->session->userdata('order_status')=='success'){
              		echo strtoupper('Your order has been placed.');
              	}else if($this->session->userdata('order_status')=='failed'){
              		echo strtoupper('Your order has been failed.');
              	}              	
              	?>              	
              </h1>
              <h2 class="mb-50 order_id"><?php echo 'Order ID #'.$this->session->userdata('order_ref_id');?></h2>
              <p class="mb-20">We will deliver at the earliest. You can go back to <?php echo anchor(base_url(),'Home'); ?> or use search</p>
              <!-- <form class="relative">
                <input type="search" placeholder="Search" class="mb-0">
                <button type="submit" class="search-button"><i class="fa fa-search"></i></button>
              </form> -->
            </div>
          </div>

        </div>
      </section> 