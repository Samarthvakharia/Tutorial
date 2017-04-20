<?php
class Search_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
   function employee_search()
   {
	   $sql = "SELECT employee_name, employee_salary, department_name, gender, city_name, state_name, address, employee_id
			   FROM employee as e
			   INNER JOIN emp_department as d
			   ON d.department_id = e.department_id
			   INNER JOIN city as c
			   ON c.city_id = e.city_id
			   INNER JOIN state as s
			   ON s.state_id = c.state_id
			  ";
	   return $this->db->query($sql)->result();
   }
   function chart()
   {
	   $sql = "SELECT SUM(`employee_salary`) as salary, e.department_id, department_name FROM `employee` as e INNER JOIN emp_department as d ON d.department_id = e.department_id Group By e.department_id
			  ";
	   return $this->db->query($sql)->result();
   }
}
?>