<?php $this->load->view('require/header');?>

<?php if($this->session->flashdata('succMsg') || isset($display_message)) {?>
<div class="alert <?php if($this->session->flashdata('succMsg')) { echo 'alert-success'; }
   if(isset($display_message)){ echo 'alert-danger'; }?>">
  <?php if($this->session->flashdata('succMsg')){ echo $this->session->flashdata('succMsg'); }
     if(isset($display_message)){ echo $display_message; }?>
  <a data-dismiss="alert" class="close" href="#">×</a> </div>
<?php }?>
<div class="mainborder">
  <h4>Employee
    <div class="addnewbut">
      <a class="btn btn-default" href="<?php echo base_url(); ?>employee/addnew">Add new</a>
    </div>
  </h4>
  <div class="profilebox">
    <?php  if(isset($employee_detail) && $employee_detail != '' && count($employee_detail)){ ?>
    <div class="table-responsive">
      <table id="employee_table" class="table table-bordered">
        <thead>
          <tr>
            <th>Sr. no.</th>
            <th>Employee Name</th>
            <th>Department</th>
            <th>Salary</th>
            <th>Gender</th>
            <th>City name</th>
            <th>State name</th>
            <th>Address</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php for($i=0;$i<count($employee_detail);$i++) {?>
          <tr>
            <td><?php echo ($i+1); ?></td>
            <td><?php if(isset($employee_detail[$i]->employee_name) && $employee_detail[$i]->employee_name != '') {echo $employee_detail[$i]->employee_name;}?></td>
            <td><?php if(isset($employee_detail[$i]->department_name) && $employee_detail[$i]->department_name != '') {echo $employee_detail[$i]->department_name;}?></td>
            <td><?php if(isset($employee_detail[$i]->employee_salary) && $employee_detail[$i]->employee_salary != '') {echo $employee_detail[$i]->employee_salary;}?></td>
            
            <td><?php if($employee_detail[$i]->gender == 1) { echo 'Male'; } else {  echo 'Female';} ?></td>
            <td><?php if(isset($employee_detail[$i]->state_name) && $employee_detail[$i]->state_name != '') {echo $employee_detail[$i]->state_name;}?></td>
            <td><?php if(isset($employee_detail[$i]->city_name) && $employee_detail[$i]->city_name != '') {echo $employee_detail[$i]->city_name;}?></td>
            <td><?php if(isset($employee_detail[$i]->address) && $employee_detail[$i]->address != '') {echo $employee_detail[$i]->address;}?></td>
            <td><div class="btn-group btn-group-xs">
               
                <a title="Edit" rel="tooltip" data-placement="left" data-toggle="tooltip" class="btn btn-default" href="<?php if(isset($employee_detail) &&  $employee_detail[$i]->employee_id != ''){echo base_url(); ?>employee/edit/<?php echo $employee_encode_id[$i]; }?>"><i class="glyphicon glyphicon-pencil"></i> </a>
               
                
                <a onclick="return confirmDialog();" title="Delete" rel="tooltip" data-placement="left" data-toggle="tooltip" class="btn btn-danger" href="<?php if(isset($employee_detail) &&  $employee_detail[$i]->employee_id != ''){echo base_url(); ?>employee/delete/<?php echo $employee_encode_id[$i];}?>"><i class="glyphicon glyphicon-remove"></i> </a>
              </div></td>
          </tr>
          <?php }?>
        </tbody>
      </table>
      <?php }  else  { 
			echo '<p class="not-found">not found.</p>'; } ?>
    </div>
  </div>
</div>
<?php $this->load->view('require/footer');?>