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
                    <div class="col-sm-8">Records</div>
                    <div class="col-sm-4 buttons_panel float-right">
                        <?php echo anchor('category/create','<button class="btn btn-primary">Add New</button>');?>
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
                            <th>Vendor</th>
                            <th class="col-sm-1">Action</th>
                        </tr>
                        

                        <?php
                        foreach($result as $row_categories){ 

                            if($row_categories->parent_id==0){
                        ?>
                                <tr>
                                    <td><?php echo $row_categories->category; ?></td>
                                    <td>
                                        <?php echo anchor('category/edit/'.$row_categories->id,'<i class="fa fa-pencil fa-fw"></i>',array('class'=>'data_action','title'=>'Edit',));?>
                                        <span class="checkbox">
                                            <input name="dataId" class="styled" type="checkbox" value="<?php echo $row_categories->id; ?>">
                                            <label></label>
                                        </span>
                                    </td>
                                </tr>
                        <?php
                                foreach($result as $row_subcategories){

                                    if($row_categories->id==$row_subcategories->parent_id){

                        ?>
                                        <tr>
                                            <td><?php echo $row_categories->category.' >> '.$row_subcategories->category; ?></td>
                                            <td>
                                                <?php echo anchor('category/edit/'.$row_subcategories->id,'<i class="fa fa-pencil fa-fw"></i>',array('class'=>'data_action','title'=>'Edit',));?>
                                                <span class="checkbox">
                                                    <input name="dataId" class="styled" type="checkbox" value="<?php echo $row_subcategories->id; ?>">
                                                    <label></label>
                                                </span>
                                            </td>
                                        </tr>

                        <?php
                                    }

                                }

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

  $("#delete_records").on('click',(function(){
    var dataId = [];
    $.each($("input[name='dataId']:checked"), function(){            
        dataId.push($(this).val());
    });    
    
    if (confirm('Are you sure you want to delete these records?')) {
        $.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>index.php/category/delete',
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