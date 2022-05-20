<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php if($title){ echo $title; }else{ echo 'Admin';} ?></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="col-sm-8">
                        <?php echo form_open('order/order_ByProducts', array('METHOD'=>'GET')); ?>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="error form_error" id="form-error-date_created"></div>
                                <input type="text" name="date_created" id="date_created" class="form-control datepicker" value="<?php if($this->input->get('date_created')){ echo $this->input->get('date_created'); } ?>" placeholder="Order Date">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="error form_error" id="form-error-product_id"></div>
                            <select name="product_id" id="product_id" class="form-control">
                                <option value="">Select</option>
                            <?php foreach($result_products as $row_products){ ?>
                                <option value="<?php echo $row_products->id; ?>" data-product_name="<?php echo $row_products->product_name; ?>" <?php if($this->session->userdata('product_id')==$row_products->id){ echo 'selected'; } ?>><?php echo $row_products->product_name; ?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" id="submit" value="Filter">
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                    <div class="col-sm-4 buttons_panel float-right">
                        <?php echo anchor('order/create','<button class="btn btn-primary">Add New</button>');?>
                        <?php echo anchor('order/print_order_ByProducts?date_created='.$this->input->get('date_created').'&product_id='.$this->input->get('product_id'),'<button class="btn btn-primary">Print</button>');?>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="panel-body">
                    <?php 
                    if($this->session->flashdata('response')){ 
                        $response = $this->session->flashdata('response');
                        
                        if(array_key_exists('error', $response)){
                            echo '<p class="alert '.$response['error']['class'].'">'.$response['error']['message'].'</p>';
                        }else{
                            echo '<p class="alert '.$response['success']['class'].'">'.$response['success']['message'].'</p>';
                        }
                    }
                    ?>                    
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th class="col-sm-1">Date</th>
                            <th class="col-sm-2">Product Name</th>
                            <th class="col-sm-2">Option</th>
                            <th class="col-sm-2">Qty</th>
                        </tr>
                        <?php foreach($result as $row){ ?>
                        <tr>
                            <td><?php echo date('d M Y', strtotime($row->date_created)); ?></td>
                            <td><?php echo $row->product_name; ?></td>
                            <td><?php echo $row->product_options; ?></td>
                            <td><?php echo $row->cnt; ?></td>
                        </tr>                               
                        <?php } ?>
                    </table>
                    
                </div>
                <div class="col-sm-12">
                   <div class="pagination"><?php if(!empty($links)){ echo $links; } ?></div>                       
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

<script type="text/javascript">
$(document).ready(function() {

  $("#delete_records").on('click',(function(){
    var dataId = [];
    $.each($("input[name='dataId']:checked"), function(){            
        dataId.push($(this).val());
    });    
    
    if (confirm('Are you sure you want to delete these records?')) {
        $.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>index.php/order/delete',
            data: {dataId:dataId},
            dataType: 'json',
            success: function(response) {
                window.location.reload();
            }
        });
    }  

  }));

});
</script>