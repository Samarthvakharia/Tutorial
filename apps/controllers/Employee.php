<?php
class Employee extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('search_model','search');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>'); 
	}
	function index()
	{
		$this->listing(); 
	}
	// listing of employee detailts 
	function listing()
	{
		$data['employee_detail'] = $employee_detail = $this->search->employee_search();
		$ed = 0;
		foreach($employee_detail as $employee_details)
		{
			$data['employee_encode_id'][$ed] = base64_encode(urlencode($employee_details->employee_id)); // encode employee id
			$ed++;
		}
		$this->load->view('employee/listing',$data);
	}
	// Add employee detail 
	function addnew()
	{
		$data['department_data'] = $this->common->get_result('emp_department','department_id, department_name'); // get department data
		$data['state_data'] = $this->common->get_result('state','state_id, state_name'); // get State data
		
		$this->form_validation->set_rules('department_id', 'Department', 'required');
		$this->form_validation->set_rules('employee_name', 'Employee name', 'required');
		$this->form_validation->set_rules('employee_salary', 'Employee salary', 'required');
		$this->form_validation->set_rules('state_id', 'State name', 'required');
		$this->form_validation->set_rules('city_id', 'City name', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('gender', 'Gender', 'required');
		if($this->form_validation->run() == FALSE)
		{
			$state_id = $this->input->post('state_id');
			if($state_id != '')
			{
				// Get city details based on states
				$data['city_detail'] = $this->common->get_whereresult_orderby('city', array('state_id' => $state_id),'city_name, city_id', 'city_name');
			}
			$data['error'] = validation_errors();
			$this->load->view('employee/addnew',$data);
		}
		else
		{
		    $employee_exists = $this->common->get_row(array('employee_name'  => $this->input->post('employee_name'),'department_id'  => $this->input->post('department_id')),'employee','employee_id');
			// Check duplication based on employee name and department
			if(isset($employee_exists) && count($employee_exists))
			{
				$state_id = $this->input->post('state_id');
				if($state_id != '')
				{
					// Get city details based on states
					$data['city_detail'] = $this->common->get_whereresult_orderby('city', array('state_id' => $state_id),'city_name, city_id' , 'city_name');
				}				
				$data['display_message'] = "Employee already exists.";
				$this->load->view('employee/addnew',$data);
			}
			else
			{
				$insert_data = array(
				   'department_id'   => $this->input->post('department_id'),
				   'employee_name'   => $this->input->post('employee_name'),
				   'employee_salary' => $this->input->post('employee_salary'),
				   'state_id'        => $this->input->post('state_id'),
				   'city_id'         => $this->input->post('city_id'),
				   'gender'          => $this->input->post('gender'),
				   'address'         => $this->input->post('address'),
				);
				$this->common->insert($insert_data,'employee'); // insert data
				$this->session->set_flashdata('succMsg','Successfully added Employee.');
				redirect('employee');
			}
		}
	}
	// Edit employee detail
	function edit($employee_encode_id = '')
	{
		$employee_id = urldecode(base64_decode($employee_encode_id)); // decode employee id
		$data['department_data'] = $this->common->get_result('emp_department','department_id, department_name'); // get department data
		$data['state_data'] = $this->common->get_result('state','state_id, state_name'); // get State data
		
		$row_data = array(
		    'employee_id' => $employee_id
		);
		$data['employee_detail'] = $employee_detail = $this->common->get_row($row_data,'employee','*');// Get emplyee data
		$data['city_detail'] = $this->common->get_whereresult_orderby('city', array('state_id' => $employee_detail->state_id),'city_name, city_id' , 'city_name'); // Get city based on states
		if(isset($employee_detail) && count($employee_detail))
		{
			$data['employee_encode_id'] = $employee_encode_id;
		}
		if(!$data['employee_detail'])
		show_404();
		$this->form_validation->set_rules('department_id', 'Department', 'required');
		$this->form_validation->set_rules('employee_name', 'Employee name', 'required');
		$this->form_validation->set_rules('employee_salary', 'Employee salary', 'required');
		$this->form_validation->set_rules('state_id', 'State name', 'required');
		$this->form_validation->set_rules('city_id', 'City name', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('gender', 'Gender', 'required');
		if($this->form_validation->run() == FALSE)
		{
			$state_id = $this->input->post('state_id');
			if($state_id != '')
			{
				$data['city_detail'] = $this->common->get_whereresult_orderby('city', array('state_id' => $state_id),'city_name, city_id' , 'city_name');
			}
			$data['error'] = validation_errors();
			$this->load->view('employee/edit',$data);
		}
		else
		{
			$where = array(
		    	'employee_id' => $employee_id
		    );
			$row_data = array(
			    'employee_name'  => $this->input->post('employee_name'),
			    'department_id'  => $this->input->post('department_id'),
			); 
		    $employee_exists = $this->common->get_row($row_data,'employee','employee_id');
			$update_data = array(
				 'department_id'   => $this->input->post('department_id'),
				 'employee_name'   => $this->input->post('employee_name'),
				 'employee_salary' => $this->input->post('employee_salary'),
				 'state_id'        => $this->input->post('state_id'),
				 'city_id'         => $this->input->post('city_id'),
				 'gender'          => $this->input->post('gender'),
				 'address'         => $this->input->post('address'),
			);
			if(count($employee_exists))
			{
				$row_data2 = array(
				   'employee_id'    => $employee_id,
				   'employee_name'  => $this->input->post('employee_name'),
			   	   'department_id'  => $this->input->post('department_id'),
				);
				$employee_exists_in_db = $this->common->get_row($row_data2,'employee','employee_id');
				if(count($employee_exists_in_db))
				{
					$this->common->update($update_data,'employee',$where);
					$this->session->set_flashdata('succMsg','Successfully updated Employee.');
					redirect('employee');
				}
				else
				{
					$state_id = $this->input->post('state_id');
					if($state_id != '')
					{
						$data['city_detail'] = $this->common->get_whereresult_orderby('city', array('state_id' => $state_id),'city_name, city_id' , 'city_name');
					}					
				    $data['display_message'] = "Employee already exists.";
				    $this->load->view('employee/edit',$data);
				}
			}
			else
			{	
				$this->common->update($update_data,'employee',$where);  // update employee
				$this->session->set_flashdata('succMsg','Successfully updated Employee.');
				redirect('employee');
			}
		}
	}
	// Delete data
	function delete($employee_encode_id = '')
	{
		$employee_id = urldecode(base64_decode($employee_encode_id));  // decode employee id
		$this->common->delete(array('employee_id' => $employee_id), 'employee');  // Delete employee
		$this->session->set_flashdata('succMsg','Successfully deleted.');
		redirect('employee');
	}
	//Ajax: State based get city data
	function get_city()
	{
		$state_id = $_POST['state_id'];  //State id get
		$city_detail = $this->common->get_whereresult_orderby('city', array('state_id' => $state_id),'city_name, city_id', 'city_name'); //State id get
		echo '<option value="">City</option>';
		if(isset($city_detail) && count($city_detail))
		{
			foreach($city_detail as $city_details)
			{
				echo '<option value="'.$city_details->city_id.'">'.$city_details->city_name.'</option>';
			}
		}			
		exit;
	}
	// Chart Function
	function chart()
	{
		$data['chart_detail'] = $this->search->chart(); // get Department 
		$this->load->view('employee/chart', $data);
	}
	/*
	function ajax_addnew()
	{
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('category_name','Category Name', 'required');
		$this->form_validation->set_rules('parent_category_id','Parent Category', 'required');
		
		if ($this->form_validation->run() == FALSE) {
			echo validation_errors();
		} 
		else {
			
			$input_name = 'category_images';
			$path = './uploads/';
			if($_FILES[$input_name]['name'] != "")
			{
				$config['upload_path']     = $path;
				$config['allowed_types'] = 'jpg|jpeg|png|gif';
				//$config['allowed_types']   = '*';
				$config['remove_spaces']   = true;
				$config['encrypt_name']    = true;
				$config['max_width']       = '';
				$config['max_height']      = '';
		
				$this->load->library('upload', $config);
				$this->upload->initialize($config);	
		
				if (!$this->upload->do_upload($input_name))
				{
					
					$error = array('error' => $this->upload->display_errors());
					echo $path.'<br />';
					print_r($error);			
				}
				else
				{
					$image = $this->upload->data();
					$image['file_name'];
				}
			}
			$category_row = $this->common->get_row(array('category_name' => $this->input->post('category_name')), 'category', 'category_name, category_id');
			if(isset($category_row) && count($category_row))
			{
				$message = 'Duplicate';
			}
			else
			{
				$insert_data = array(
				   'category_name'      => $this->input->post('category_name'),
				   'category_images'    => $image['file_name'],
				   'parent_category_id' => $this->input->post('parent_category_id'),
				   'is_parent'          => $this->input->post('is_parent'),
				);
				$this->common->insert($insert_data,'category'); // insert data
				$message = 'Success';
			}
		}
		echo $message;
	}
	*/
}
?>
