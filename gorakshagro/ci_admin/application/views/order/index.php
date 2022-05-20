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
                        <?php echo form_open('order/filter', array('METHOD'=>'GET')); ?>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="error form_error" id="form-error-date_created"></div>
                                <input type="text" name="date_created" id="date_created" class="form-control datepicker" value="<?php if($this->input->get('date_created')){ echo $this->input->get('date_created'); } ?>" placeholder="Order Date">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="error form_error" id="form-error-address_code"></div>
                                <select class="form-control" name="address_code">
                                    <option value="">Select Address Code</option>
                                    <?php foreach($result_address_codes as $row_address_codes){ ?>
                                    <option value="<?php echo $row_address_codes->code; ?>" <?php if($this->input->get('address_code')==$row_address_codes->code){ echo 'selected'; } ?>><?php echo $row_address_codes->code; ?></option> <?php } ?>                          
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="error form_error" id="form-error-order_ref_id"></div>
                                <input type="text" name="order_ref_id" id="order_ref_id" class="form-control" value="<?php if($this->input->get('order_ref_id')){ echo $this->input->get('order_ref_id'); } ?>" placeholder="Order ID / Invoice No">
                            </div>
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
                        <!-- <button class="btn btn-primary" id="delete_records">Delete</button> -->
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
                            <th class="col-sm-2">Order Id</th>
                            <th class="col-sm-2">Customer</th>                            
                            <th class="col-sm-1">Add. Code</th>
                            <th class="col-sm-1">Amount</th>
                            <th class="col-sm-2">Order Status</th>
                            <th class="col-sm-1">Invoice</th>
                            <th class="col-sm-1">Action</th>
                        </tr>
                        <?php foreach($result as $row){ ?>
                        <tr>
                            <td><?php echo date('d M Y', strtotime($row->date_created)); ?></td>
                            <td><?php echo $row->order_ref_id; ?></td>
                            <td><?php echo $row->firstname.' '.$row->lastname; ?></td>
                            <td><?php echo $row->address_code; ?></td>
                            <td>Rs. <?php echo $row->total; ?></td>
                            <td><?php echo $row->status; ?></td>
                            <td><?php echo anchor('order/invoice/'.$row->order_ref_id,'Invoice',array('title'=>'Invoice','target'=>'_blank')); ?></td>
                            <td>
                                <?php echo anchor('order/view/'.$row->order_ref_id,'<i class="fa fa-eye fa-fw"></i>',array('class'=>'data_action','title'=>'View',));?>
                                <?php echo anchor('order/edit/'.$row->order_ref_id,'<i class="fa fa-pencil fa-fw"></i>',array('class'=>'data_action','title'=>'Edit',));?>
                                <!-- <span class="checkbox">
                                    <input name="dataId" class="styled" type="checkbox" value="<?php echo $row->id; ?>">
                                    <label></label>
                                </span> -->
                            </td>
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