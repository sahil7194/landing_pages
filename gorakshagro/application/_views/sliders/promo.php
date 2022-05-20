<!-- Promo Slider -->
      <section class="section-wrap shop-promo-slider bg-light pb-0 pb-mdm-80">
        <div id="owl-single" class="owl-carousel owl-theme">

          <?php foreach($promos as $promo){ ?>
          <div class="item text-center">
            <div class="container">
              <div class="row">
                <div class="col-md-6">
                  <img src="images/promo/<?php echo $promo->imagefile1; ?>" alt="">
                </div>
                <div class="col-md-6">
                  <h2 class="uppercase bottom-line style-2"><?php echo $promo->title; ?></h2>
                  <p><?php echo $promo->subtitle; ?></p>
                  <?php echo anchor($promo->url,'<span>view lookbook</span><i class="fa fa-angle-right"></i>', array('class'=>'btn btn-lg btn-color btn-icon mt-30')); ?>
                </div>                
              </div>              
            </div>
          </div>
          <?php } ?>


        </div> <!-- end owl -->
      </section> <!-- end promo slider -->