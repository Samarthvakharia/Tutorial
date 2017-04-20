<?php $this->load->view('require/header'); ?>

<?php if(isset($display_message)) { ?>
<div class="alert alert-danger">
  <?php if(isset($display_message)) { echo $display_message; } ?>
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
</div>
<?php }?>

<div class="mainborder">
  <h4>Edit Employee </h4>
  <div class="profilebox">
    <form name="editrole" enctype="multipart/form-data" method="POST" action="<?php echo base_url(); ?>employee/edit/<?php echo $employee_encode_id; ?>" class=" form" autocomplete="off">
      <div class="row">
        
         <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
          <label class="control-label">Employee name<span class="astrics">*</span></label>
          <input type="text" value="<?php if(isset($employee_detail) && $employee_detail->employee_name != '') { echo set_value('employee_name',$employee_detail->employee_name);} ?>" name="employee_name" id="employee_name" class="form-control">
          <?php echo form_error('employee_name'); ?> 
        </div>
        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
          <label class="control-label">Department<span class="astrics">*</span></label>
          <select class="form-control chosen-select" name="department_id" id="department_id">
            <?php if(isset($department_data) && count($department_data)) {
					  foreach($department_data as $department_datas) { ?>
            			<option value="<?php echo $department_datas->department_id; ?>" <?php if(set_select('department_id', $department_datas->department_id) !='') { echo set_select('department_id',$department_datas->department_id, TRUE); }?>><?php echo $department_datas->department_name; ?></option>
            <?php }  } ?>
          </select>
          <?php echo form_error('department_id'); ?> </div>
        
        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
          <label class="control-label">employee salary<span class="astrics">*</span></label>
          <input type="text" value="<?php if(isset($employee_detail) && $employee_detail->employee_salary != '') { echo set_value('employee_salary',$employee_detail->employee_salary);} ?>" name="employee_salary" id="employee_salary" class="form-control" onkeypress="return isNumberKey(event);">
          <?php echo form_error('employee_salary'); ?> </div>
        
        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
          <label class="control-label">State<span class="astrics">*</span></label>
          <select class="form-control chosen-select edit_state_id" name="state_id" id="state_id">
          	<option value="">State</option>
            <?php if(isset($state_data) && count($state_data)) {
					  foreach($state_data as $state_datas) { ?>
            			<option value="<?php echo $state_datas->state_id; ?>" <?php if(set_select('state_id', $state_datas->state_id) !='') { echo set_select('state_id',$state_datas->state_id, TRUE); } elseif($employee_detail->state_id == $state_datas->state_id) { echo set_select('state_id', $state_datas->state_id,TRUE); } ?>><?php echo $state_datas->state_name; ?></option>
            <?php }  } ?>
          </select>
          <?php echo form_error('state_id'); ?> </div>
          
        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
          <label class="control-label">City<span class="astrics">*</span></label>
          <select class="form-control chosen-select edit_city_id" name="city_id" id="city_id">
            <option value="">City</option>
            <?php if(isset($city_detail) && count($city_detail)) {
					  foreach($city_detail as $city_details) { ?>
            			<option value="<?php echo $city_details->city_id; ?>" <?php if(set_select('city_id', $city_details->city_id) !='') { echo set_select('city_id',$city_details->city_id, TRUE); }  elseif($employee_detail->city_id == $city_details->city_id) { echo set_select('city_id', $city_details->city_id,TRUE); } ?>><?php echo $city_details->city_name; ?></option>
            <?php }  } ?>
          </select>
          <?php echo form_error('city_id'); ?> </div>
        
        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
          <label class="control-label">employee address<span class="astrics">*</span></label>
          <textarea type="text" name="address" id="address" class="form-control"><?php if(isset($employee_detail) && $employee_detail->address != '') { echo set_value('address',$employee_detail->address);} ?></textarea>
          <?php echo form_error('address'); ?> </div>
          
        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
          <label class="control-label">gender</label>
          <label class="radio-inline">
            <input type="radio" name="gender" value="1" <?php if(set_radio('gender', '1') !='') { echo set_radio('gender', '1'); } elseif($employee_detail->gender == 1) {echo set_radio('gender', '1', TRUE); }  ?>>Male
          </label>
          <label class="radio-inline">
            <input type="radio" name="gender" value="0" <?php if(set_radio('gender', '0') !='') { echo set_radio('gender', '0'); } elseif($employee_detail->gender == 0) {echo set_radio('gender', '0', TRUE); }  ?>>Female
          </label>
          
          <?php echo form_error('gender'); ?> </div>
         <div class="clearfix"></div>
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <div class="pull-right">
            <input type="submit" value="submit" name="submit" class="btn btn-primary">
            <a class="btn btn-primary" href="<?php  echo base_url();?>employee">cancel</a> </div>
        </div>
      </div>
    </form>
  </div>
</div>
<?php
$this->load->view('require/footer');
?>