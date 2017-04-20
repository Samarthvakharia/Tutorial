<?php
class Common extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	// Get single row 
	function get_row($data,$table,$field_name)	
	{
		return $this->db->select($field_name)->from($table)->where($data)->get()->row();
	}
	// Insert data 
	function insert($data,$table)
	{
		$this->db->insert($table,$data);
	}
	// Modify data
	function update($data,$table,$where)
	{
		$this->db->where($where)->update($table,$data);
	}
	// Delete data
	function delete($data,$table)
	{
		$this->db->where($data)->delete($table);
	}
	// Get multiple data in std object array
	function get_result($table,$field_name)
	{
		return $this->db->select($field_name)->from($table)->get()->result();
	}
	// Get multiple data based on order in std object array
	function get_whereresult_orderby($table,$data,$field_name,$order_by='')
	{
		if($order_by == '')
		{
		 	return $this->db->select($field_name)->from($table)->where($data)->get()->result();
		}
		else
		{
			return $this->db->select($field_name)->from($table)->order_by($order_by,'asc')->where($data)->get()->result();
		}
	}
}
?>