<div class="content-wrapper oh">
      
      <!-- Revolution Slider -->
      <section>
         <div id="owl-main_banner" class="owl-carousel owl-theme">
            <?php foreach($banners as $banner){ ?>
            <div class="banner_row">
              <div class=""><a href="<?php echo $banner->url; ?>"><img src="images/banners/<?php echo $banner->imagefile1; ?>"></a></div>
            </div>
            <?php } ?>            
         </div>
      </section>

      <!-- Promo Banners -->
      <section class="section-wrap promo-banners pt-0 pb-60">
        <div class="container">
			<div class="row">
			
				<div id="owl-category-slider" class="owl-carousel owl-theme">
				
					<div class="mt-30 promo-banner">              
					  <?php echo anchor('products/c/vegetables','<img src="images/category/vegitable.jpg" alt=""><div class="work-overlay"><div class="promo-inner valign"><h2 class="uppercase">Vegetables</h2></div></div>'); ?>
					</div> <!-- end banner -->

					<div class="mt-30 promo-banner">
					  <?php echo anchor('products/c/leafy-vegetables','<img src="images/category/leafy-vegitable.jpg" alt=""><div class="work-overlay"><div class="promo-inner valign"><h2 class="uppercase">Leafy Vegetables</h2></div></div>'); ?>
					</div> <!-- end banner -->

					<div class="mt-30 promo-banner">
					 <?php echo anchor('products/c/exotic','<img src="images/category/exotic-vegetables.jpg" alt=""><div class="work-overlay"><div class="promo-inner valign"><h2 class="uppercase">Exotic Vegetables</h2></div></div>'); ?>
					</div> <!-- end banner -->
					
					<div class="mt-30 promo-banner">
					 <?php echo anchor('products/c/cuts','<img src="images/category/cuts.jpg" alt=""><div class="work-overlay"><div class="promo-inner valign"><h2 class="uppercase">Cuts</h2></div></div>'); ?>
					</div> <!-- end banner -->

					<div class="mt-30 promo-banner">
					 <?php echo anchor('products/c/mixes--ready-to-cook','<img src="images/category/mixes.jpg" alt=""><div class="work-overlay"><div class="promo-inner valign"><h2 class="uppercase">Mixes</h2></div></div>'); ?>
					</div> <!-- end banner -->

          <div class="mt-30 promo-banner">
           <?php echo anchor('products/c/fruits','<img src="images/category/fruits.jpg" alt=""><div class="work-overlay"><div class="promo-inner valign"><h2 class="uppercase">Fruits</h2></div></div>'); ?>
          </div> <!-- end banner -->
				
				</div>
				
			</div>
        </div>
      </section> <!-- end promo banners -->

      <!-- New Arrivals -->
      <section class="section-wrap new-arrivals pt-0 pb-20 product_list_container">
        <div class="container">

          <div class="row heading-row">
            <div class="col-md-12 text-center">
              <h2 class="heading uppercase bottom-line"><small>Featured Items</small></h2>
            </div>
          </div>

          <div class="row items-grid">              

            <?php 
              foreach($featured_products as $product){
            ?>
                <div class="col-md-3 col-xs-6">
                  <div class="product-item">
                    <div class="product-img hover-1">                            

                      <?php echo anchor('products/details/'.$product->slug, '<img src="images/uploads/products/thumbs/'.$product->product_image.'" alt="'.$product->product_name.'">'); ?>

                      <!-- <span class="sold-out valign">out of stock</span> -->
                      <!-- <div class="product-label">
                        <span class="sale">sale</span>
                      </div> -->
                      <div class="product-actions">
                        <!-- <a href="#" class="product-add-to-compare" data-toggle="tooltip" data-placement="bottom" title="Add to compare">
                          <i class="fa fa-exchange"></i>
                        </a> -->
                        <a class="product-add-to-wishlist add_to_wishlist" data-id="<?php echo $product->id; ?>" data-toggle="tooltip" data-placement="bottom" title="Add to wishlist">
                          <i class="fa fa-heart"></i>
                        </a>                    
                      </div>
                      <!-- <a href="#" class="product-quickview">Quick View</a> -->
                    </div>

                    <div class="product-details">
                      <h3>
                        <?php echo anchor('products/details/'.$product->slug,$product->product_name, array('class'=>'product-title')); ?>
                      </h3>                      
                      <span class="price">
                        <del>
                          <span>Rs.<?php echo $product->price; ?></span>
                        </del>
                        <ins>
                          <span class="ammount">Rs.<?php echo $product->special_price; ?></span>
                        </ins>
                      </span>
                    </div>                                    

                    <!-- <div class="product-list-details">
                      <ul class="product-actions clearfix">
                        <li>
                          <a href="#" class="btn btn-color btn-md left">Add to Cart</a>
                        </li>
                        <li>
                          <div class="icon-add-to-wishlist left">
                            <a href="#"><i class="fa fa-heart"></i></a>
                          </div>
                        </li>                                 
                      </ul>
                    </div> -->

                  </div>
                </div>
            <?php
              }
            ?>



          </div> <!-- end row -->
        </div>
      </section> <!-- end new arrivals -->



      <?php //$this->load->view('sliders/promo'); ?>


      <?php //$this->load->view('sliders/best_seller.php'); ?>


      <!-- Icon Boxes -->
      <section class="section-wrap benefits bg-light pb-50 pb-sml-80">
        <div class="container">
          <div class="row">

            <div class="col-md-4 col-sm-6 wow fadeIn mb-40" data-wow-duration="2s" data-wow-delay="0.1s">
              <div class="service-item-box style-4 clearfix">
                <a href="#">
                  <i class="icon-diamond"></i>
                </a>
                <div class="service-text">
                  <h3 class="uppercase">free shipping </h3>
                </div>
              </div>            
            </div> <!-- end service item -->

            <div class="col-md-4 col-sm-6 wow fadeIn mb-40" data-wow-duration="2s" data-wow-delay="0.2s">
              <div class="service-item-box style-4 clearfix">
                <a href="#">
                  <i class="icon-layers"></i>
                </a>
                <div class="service-text">
                  <h3 class="uppercase">24/7 customers support</h3>
                </div>  
              </div>            
            </div> <!-- end service item -->

            <div class="col-md-4 col-sm-6 wow fadeIn mb-40" data-wow-duration="2s" data-wow-delay="0.3s">
              <div class="service-item-box style-4 clearfix">
                <a href="#">
                  <i class="icon-support"></i>
                </a>
                <div class="service-text">
                  <h3 class="uppercase">fastest delivery</h3>
                </div>  
              </div>            
            </div> <!-- end service item -->        

           <!--  <div class="col-md-3 col-sm-6 wow fadeIn" data-wow-duration="2s" data-wow-delay="0.4s">
              <div class="service-item-box style-4 clearfix">
                <a href="#">
                  <i class="icon-handbag"></i>
                </a>
                <div class="service-text">
                  <h3 class="uppercase">money back guarantee</h3>
                </div>
              </div>            
            </div> --> <!-- end service item -->

          </div>
        </div>
      </section> <!-- end icon boxes -->

     

      <?php //$this->load->view('blog_testimonials_box.php'); ?>



      <?php //$this->load->view('sliders/partners'); ?>
	  
	<!--<div class="body_overlay notify_overlay" style="display: block;">
		<div class="notify_overlay_box">
		  <div class="content">  
			<p>Hi, Welcome to Goraksh Agro. Its our pleasure to serve you better. Currently we delivering at limited locations. Delivery pincodes are 400067, 400063, 400065. <br/><br/>Thank you.</p>
		  </div>
		  <a class="close_overlay"></a>
		</div> 
	</div>-->