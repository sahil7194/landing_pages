                <div class="my_account_links">
                  <ul>
                    <li <?php if($selected_menu=='dashboard'){ echo 'class="active"'; } ?>><i class="fa fa-home" aria-hidden="true"></i><?php echo anchor('account/','Dashboard'); ?></li>                    
                    <li <?php if($selected_menu=='orders'){ echo 'class="active"'; } ?>><i class="fa fa-th-list" aria-hidden="true"></i><?php echo anchor('account/orders','My Orders'); ?></li>
                    <li <?php if($selected_menu=='wishlist'){ echo 'class="active"'; } ?>><i class="fa fa-heart" aria-hidden="true"></i><?php echo anchor('account/wishlist','My Wishlist'); ?></li>
                    <li <?php if($selected_menu=='addresses'){ echo 'class="active"'; } ?>><i class="fa fa-location-arrow" aria-hidden="true"></i><?php echo anchor('account/addresses','Addresses'); ?></li>
                    <li <?php if($selected_menu=='profile'){ echo 'class="active"'; } ?>><i class="fa fa-user" aria-hidden="true"></i><?php echo anchor('account/profile','My Profile'); ?></li>
                    <li <?php if($selected_menu=='change_password'){ echo 'class="active"'; } ?>><i class="fa fa-key" aria-hidden="true"></i><?php echo anchor('account/change_password','Change Password'); ?></li>
                    <li><i class="fa fa-sign-out" aria-hidden="true"></i><a class="logout_btn">Logout</a></li>
                  </ul>
                </div>