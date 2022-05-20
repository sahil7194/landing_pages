<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php if($title){ echo $title; }else{ echo 'Admin';} ?> Users</h1>
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
                    <?php echo form_open('filter/search_user');?>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <select class="form-control" id="gender" name="gender">
                                <option value="">Select Gender</option>
                                <option value="Male" <?php if($this->input->post('gender')=='Male'){ echo 'selected'; }?>>Male</option>
                                <option value="Female" <?php if($this->input->post('gender')=='Female'){ echo 'selected'; }?>>Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <select class="form-control" id="state_id" name="state_id">
                                <option value="">Select State</option>
                                <?php foreach($result_states as $row_states){ ?>                                    
                                    <option value="<?php echo $row_states->id; ?>" <?php if($this->input->post('state_id')==$row_states->id){ echo 'selected'; }?>><?php echo $row_states->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <select class="form-control" id="city_id" name="city_id">
                                <option value="">Select City</option>
                                <?php foreach($result_cities as $row_cities){ ?>                                    
                                    <option value="<?php echo $row_cities->id; ?>" <?php if($this->input->post('city_id')==$row_cities->id){ echo 'selected'; }?>><?php echo $row_cities->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <select class="form-control" id="religion_id" name="religion_id">
                                <option value="">Select Religion</option>
                                <?php foreach($result_religion as $row_religion){ ?>                                    
                                    <option value="<?php echo $row_religion->id; ?>" <?php if($this->input->post('religion_id')==$row_religion->id){ echo 'selected'; }?>><?php echo $row_religion->religion; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <select class="form-control" id="block_status" name="block_status">
                                <option value="">Blocked?</option>
                                <option value="b_y">Yes</option>
                                <option value="b_n">No</option>
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
                            <th>FB-PSID</th>
                            <th>Name</th>
                            <th>Photo</th>
                            <th class="col-sm-1">Action</th>
                        </tr>
                        <?php 
                        if(isset($result)){
                            foreach($result as $row){
                        ?>                        
                        <tr>
                            <td><?php echo $row->fb_id; ?></td>
                            <td><?php echo $row->first_name.' '.$row->last_name; ?></td>
                            <td><img src="<?php echo $row->profile_pic; ?>" width="50"></td>
                            <td>
                                <?php echo anchor('users/view/'.$row->fb_id,'<i class="fa fa-eye fa-fw"></i>',array('class'=>'data_action','title'=>'View','target'=>'_blank'));?>
                                <?php echo anchor('users/edit/'.$row->id,'<i class="fa fa-pencil fa-fw"></i>',array('class'=>'data_action','title'=>'Edit'));?>
                                <!-- <span class="checkbox">
                                    <input name="dataId" class="styled" type="checkbox" value="<?php echo $row->id; ?>">
                                    <label></label>
                                </span> -->
                            </td>
                        </tr>                               
                        <?php 
                            }
                        }
                        ?>
                    </table>
                    
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