<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php if($title){ echo $title; }else{ echo 'Admin';} ?> Sales</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="col-sm-8">Search</div>
                    <div class="clr"></div>
                </div>
                <div class="panel-body">
                    <?php echo form_open('reports/filter_sales', array('Method'=>'GET'));?>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="col-form-label">Group By</label>
                            <select class="form-control" id="filter_group" name="filter_group">
                                <option value="">Group By</option>
                                <option value="day" <?php if($this->input->get('filter_group')=='day'){ echo 'selected'; }?>>Day</option>
                                <option value="week" <?php if($this->input->get('filter_group')=='week'){ echo 'selected'; }?>>Week</option>
                                <option value="month" <?php if($this->input->get('filter_group')=='month'){ echo 'selected'; }?>>Month</option>
                                <option value="year" <?php if($this->input->get('filter_group')=='year'){ echo 'selected'; }?>>Year</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="col-form-label">Start Date</label>
                            <input type="text" name="filter_date_start" id="filter_date_start" class="form-control datepicker" placeholder="Start Date" value="<?php if($this->input->get('filter_date_start')){ echo $this->input->get('filter_date_start'); }?>">
                        </div>
                    </div>  
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="col-form-label">End Date</label>
                            <input type="text" name="filter_date_end" id="filter_date_end" class="form-control datepicker" placeholder="End Date" value="<?php if($this->input->get('filter_date_end')){ echo $this->input->get('filter_date_end'); }?>">
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="col-form-label">Order Status</label>
                            <select class="form-control" name="filter_order_status_id" id="filter_order_status_id">
                                <option value="" disabled>Select status</option>
                                <?php foreach($order_status_list as $order_status){ ?>
                                <option value="<?php echo $order_status->id; ?>" <?php if($this->input->get('filter_order_status_id')==$order_status->id){ echo 'selected'; } ?>><?php echo $order_status->status; ?></option> <?php } ?>                          
                            </select>
                        </div>
                    </div>                     
                    <div class="col-sm-3">
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" id="submit" name="search" value="Search">
                        </div>
                    </div>                    
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>

    
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="col-sm-8">Records</div>
                    <div class="col-sm-4 buttons_panel float-right">
                        <?php //echo anchor('users/create','<button class="btn btn-primary">Add New</button>');?>
                        <?php //echo anchor('users','<button class="btn btn-primary" id="delete_records">Delete</button>');?>
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
                            <th>Date Start</th>
                            <th>Date End</th>
                            <th>No. of orders</th>
                            <!-- <th>Quantity</th> -->
                            <th>Total</th>
                        </tr>
                        <?php 
                        if(isset($result)){
                            foreach($result as $row){
                        ?>                        
                        <tr>
                            <td><?php echo date('d-M-Y', strtotime($row->date_start)); ?></td>
                            <td><?php echo date('d-M-Y', strtotime($row->date_end)); ?></td>
                            <td><?php echo $row->no_of_orders; ?></td>
                            <!-- <td><?php echo $row->products; ?></td> -->
                            <td><?php echo $row->total; ?></td>
                        </tr>                               
                        <?php 
                            }
                        }
                        ?>
                    </table>
                    
                </div>
                <div class="col-sm-12">
                   <div class="pagination"><?php echo $links; ?></div>                       
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

    $("#state_id").on('change', function(){
            
        var state_id = $(this).val();        

        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>index.php/filter/getData_city_ByState",
            data:  {state_id:state_id},
            dataType: 'json',
            success: function(result) {
                $("#city_id option").remove();
                $("#city_id").append('<option value="">Select City</option>');
                jQuery.each( result.success, function( i, val ) {                    
                    $("#city_id").append('<option value="'+val['id']+'">'+val['name']+'</option>');
                });
            },
            error: function(data){
                
            }
        });

    });

});
</script>