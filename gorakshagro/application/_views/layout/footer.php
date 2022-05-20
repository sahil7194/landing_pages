<?php $this->load->view('account/register_login_overlay'); ?>

 <!-- Footer Type-3 -->
      <footer class="footer footer-type-3 bg-dark">
        <div class="container">
          <div class="footer-widgets">
            <div class="row">

              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="widget footer-about-us">
                  <h5 class="bottom-line left-align">About Us</h5>
                  <p class="mb-20">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
                </div>
              </div>

              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="widget footer-links">
                  <h5 class="bottom-line left-align">Information</h5>
                  <ul>
                    <li><?php echo anchor(base_url(),'Home'); ?></li>
                    <li><?php echo anchor('','About Us'); ?></li>
                    <li><?php echo anchor('privacy-policy','Privacy Policy'); ?></li>
                    <li><?php echo anchor('terms-and-condtions','Terms &amp; Conditions'); ?></li>
                  </ul>
                </div>
              </div>

              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="widget footer-links">
                  <h5 class="bottom-line left-align">Account</h5>
                  <ul>
                    <li><?php echo anchor('account/','My account'); ?></li>
                    <li><?php echo anchor('account/orders','Order History'); ?></li>
                    <li><?php echo anchor('account/wishlist','My Wishlist'); ?></li>
                  </ul>
                </div>
              </div>

              <div class="col-md-3 col-sm-6 col-xs-12 last">
                <div class="widget footer-about-us">
                  <h5 class="bottom-line left-align">Stay in Touch</h5>
                  <!-- <div class="social-icons dark rounded mt-20">
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-google-plus"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                    <a href="#"><i class="fa fa-vimeo"></i></a>
                  </div> -->
                  <form class="relative newsletter-form mt-30">
                    <input type="email" class="newsletter-input" placeholder="Enter your email">
                    <i class="icon_mail"></i>
                    <input type="submit" class="btn btn-lg btn-color newsletter-submit" value="Subscribe">
                  </form>
                </div>
              </div> <!-- end about us -->

            </div>
          </div>    
        </div> <!-- end container -->

        <!-- <div class="bottom-footer">
          <div class="container">
            <div class="row">

              <div class="col-sm-8 col-xs-12 copyright sm-text-center">
                <span>
                  © 2016 Syros Theme • Made by <a href="http://deothemes.com">DeoThemes</a>
                </span>
              </div>

              <div class="col-sm-4 col-xs-12 footer-payment-systems text-right sm-text-center mt-sml-10">
                <i class="fa fa-cc-paypal"></i>
                <i class="fa fa-cc-visa"></i>
                <i class="fa fa-cc-mastercard"></i>
                <i class="fa fa-cc-discover"></i>
                <i class="fa fa-cc-amex"></i>
              </div>

            </div>
          </div>
        </div> -->
        <!-- end bottom footer -->

        
      </footer> <!-- end footer -->


      <div id="back-to-top">
        <a href="#top"><i class="fa fa-angle-up"></i></a>
      </div>

    </div> <!-- end content wrapper -->
  </div> <!-- end main wrapper -->


<?php if($this->session->userdata('select_location')!='active'){ ?>
  <div class="body_overlay select_location_overlay" style="display: block;">
    <div class="notify_overlay_box">
      <div class="content">  
        <select class="form-control" id="select_location">
          <option value="">Select your location</option>
          <option value="Vartak Nagar, Thane">Vartak Nagar, Thane</option>
          <option value="Majiwada, Thane">Majiwada, Thane</option>
          <option value="Off Pokhran Road No. 1, Thane">Off Pokhran Road No. 1, Thane</option>
          <option value="Kolshet, Thane">Kolshet, Thane</option>
        </select>
      </div>
    </div> 
  </div>
<?php } ?>
  

  <!-- jQuery Scripts -->
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/plugins.js"></script>
  <script type="text/javascript" src="revolution/js/jquery.themepunch.tools.min.js"></script>
  <script type="text/javascript" src="revolution/js/jquery.themepunch.revolution.min.js"></script>
  <script type="text/javascript" src="js/scripts.js"></script>
  <script type="text/javascript" src="js/cart.js"></script>
  <script type="text/javascript" src="js/custom.js"></script>


  <script type="text/javascript" src="revolution/js/extensions/revolution.extension.video.min.js"></script>
  <script type="text/javascript" src="revolution/js/extensions/revolution.extension.carousel.min.js"></script>
  <script type="text/javascript" src="revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
  <script type="text/javascript" src="revolution/js/extensions/revolution.extension.actions.min.js"></script>
  <script type="text/javascript" src="revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
  <script type="text/javascript" src="revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
  <script type="text/javascript" src="revolution/js/extensions/revolution.extension.navigation.min.js"></script>
  <script type="text/javascript" src="revolution/js/extensions/revolution.extension.migration.min.js"></script>
  <script type="text/javascript" src="revolution/js/extensions/revolution.extension.parallax.min.js"></script>
    
</body>
</html>