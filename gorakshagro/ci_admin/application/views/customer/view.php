<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">View <?php if($title){ echo $title; }else{ echo 'Admin';} ?></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">                            
                    <div class="col-sm-8">Name: <?php echo $result[0]->fname.' '.$result[0]->lname; ?></div>
                    <div class="col-sm-4 buttons_panel float-right">
                        <?php //echo anchor('customer/edit/'.$result[0]->id,'<button class="btn btn-primary">Edit</button>');?>
                        <?php echo anchor('customer','<button class="btn btn-primary">Back</button>');?>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="row_details">
                            <label class="col-sm-3 col-form-label">Account created on</label>
                            <div class="col-sm-9 col_details">
                                <?php echo date('d M Y H:i:s', strtotime($result[0]->date_created)); ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row_details">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9 col_details">
                                <?php echo $result[0]->email; ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row_details">
                            <label class="col-sm-3 col-form-label">Gender</label>
                            <div class="col-sm-9 col_details">
                                <?php echo $result[0]->gender; ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>                                        

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">                            
                    <div class="col-sm-8">Addresses</div>
                    <div class="col-sm-4 buttons_panel float-right">
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="panel-body">
                    
                    <?php foreach($result_address as $address){ ?>
                    <div class="col-sm-6">
                        <div class="panel-body-block address">
                            <p><strong><?php echo $address->contact_name; ?></strong></p>
                            <p><strong>Address :</strong> <?php echo $address->address; ?></p>
                            <p><strong>Locality :</strong> <?php echo $address->locality; ?></p>
                            <p><strong>Pincode :</strong> <?php echo $address->pincode; ?>, 
                                <strong>City :</strong> <?php echo $address->city; ?>, 
                                <strong>State :</strong> <?php echo $address->state; ?></p>                        
                            <p><strong>Landmark :</strong> <?php echo $address->landmark; ?></p>                            
                            <p><strong>Mobile :</strong> <?php echo $address->mobile; ?></p>                            
                            <p><strong>Alternate Phone :</strong> <?php echo $address->alternate_phone; ?></p>                            
                            <p><strong>Address type :</strong> <?php echo $address->address_type; ?></p>
                        </div>
                    </div>
                    <?php } ?>

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->


</div>
<!-- /#page-wrapper -->
