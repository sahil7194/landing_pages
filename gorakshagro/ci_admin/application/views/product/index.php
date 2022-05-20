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
                    <div class="col-sm-4">Records</div>
                    <div class="col-sm-5 float-right">
                        <?php echo form_open('product/search', array('name'=>'form_product_search', 'method'=>'GET')); ?>
                            <div class="col-sm-8">
                                <input type="text" name="product_name" id="product_name" placeholder="Enter product name" class="form-control">
                            </div>
                            <div class="col-sm-3">
                                <input type="submit" name="submit" class="btn btn-primary" value="Search">
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                    <div class="col-sm-3 buttons_panel float-right">                        
                        <?php echo anchor('product/create','<button class="btn btn-primary">Add New</button>');?>
                        <button class="btn btn-primary" id="delete_records">Delete</button>
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
                            <th class="col-sm-1">Id</th>
                            <th class="col-sm-2">Product Name</th>                            
                            <th class="col-sm-1">Action</th>
                        </tr>
                        <?php 
                        if(!empty($result)){
                            foreach($result as $row){
                        ?>
                        <tr>
                            <td><?php echo $row->id; ?></td>
                            <td><?php echo $row->product_name; ?></td>                            
                            <td>
                                <?php echo anchor('product/edit/'.$row->id,'<i class="fa fa-pencil fa-fw"></i>',array('class'=>'data_action','title'=>'Edit',));?>
                                <span class="checkbox">
                                    <input name="dataId" class="styled" type="checkbox" value="<?php echo $row->id; ?>">
                                    <label></label>
                                </span>
                            </td>
                        </tr>                               
                        <?php
                            }
                        }
                        ?>
                    </table>
                    
                </div>
                <div class="col-sm-12">
                   <div class="pagination"><?php  if(!empty($links)){ echo $links; } ?></div>                       
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
                url: '<?php echo base_url(); ?>index.php/product/delete',
                data: {dataId:dataId},
                dataType: 'json',
                success: function(response) {
                    location.reload(true);
                }
            });
        }

    }));

});
</script>