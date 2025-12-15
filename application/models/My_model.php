<?php
defined('BASEPATH') or exit('No direct script access allowed');

class My_model extends CI_Model
{

	function __Construct()
	{ 		 # create constructor 
		$this->load->database();		 # load the database
	}

	function __Destruct(){
		$this->db->close();
	}

	# function for select data from database , with condition , limit , order , like and join clause
	function select_data($param)
	{
		extract($param);
		$this->db->select(($field) ? $field : '*');
		$this->db->from($table);

		if (isset($where)) {
			$this->db->where($where);
		}

		if (isset($join) && $join != '') {
			if (in_array('multiple', $join)) {
				foreach ($join['1'] as $joinArray) {
					if(isset($joinArray[2])){
						$this->db->join($joinArray[0], $joinArray[1] , $joinArray[2]);
					}else{
						$this->db->join($joinArray[0], $joinArray[1]);
					}
					
				}
			} else {
				if(isset($join[2])){
					$this->db->join($join[0], $join[1] , $join[2]);
				}else{
					$this->db->join($join[0], $join[1]);
				}
				
			}
		}

		if (isset($order)) {
		    if(is_array($order) && !empty($order)){
			    $this->db->order_by($order[0], $order[1]);
		    }else{
		        $this->db->order_by($order);
		    }
		}

		if (isset($group)) {
			$this->db->group_by($group);
		}

		if (isset($limit)) {
			if (is_array($limit)) {
				$this->db->limit($limit['limit'], $limit['offset']);
			} else {
				$this->db->limit($limit);
			}
		}

		return $this->db->get()->result_array();
		die();
	}

	# function for insert data in database  
	function insert_data($param)
	{
		extract($param);
		$this->db->insert($table, $data);
		return $this->db->insert_id();
		die();
	}

	# function for delete data from database 
	function delete_data($param)
	{
		extract($param);
		if (isset($limit)) {
			if (is_array($limit)) {
				$this->db->limit($limit['limit'], $limit['offset']);
			} else {
				$this->db->limit($limit);
			}
		}


		return $this->db->delete($table, $where);
		die();
	}

	# function for update data in database with limit
	function update_data($param)
	{
		extract($param);
		$this->db->where($where);
		if (isset($limit)) {
			if (is_array($limit)) {
				$this->db->limit($limit['limit'], $limit['offset']);
			} else {
				$this->db->limit($limit);
			}
		}

		if (isset($data[0])) { //in case of increment the value
			$this->db->set($data[0], $data[1], $data[2]);
		} else {
			$this->db->set($data);
		}

		return $this->db->update($table);
		die();
	}


	# function for call the aggregate function like as 'SUM' , 'COUNT' etc 
	function aggregate_data($param)
	{
		extract($param);
		$this->db->select($function . "(" . $field_name . ") AS MyFun");
		$this->db->from($table);
		if (isset($where) && $where != '') {
			$this->db->where($where);
		}
        
        
        
		if (isset($join) && $join != '') {
			if (in_array('multiple', $join)) {
				foreach ($join['1'] as $joinArray) {
					if(isset($joinArray[2])){
						$this->db->join($joinArray[0], $joinArray[1] , $joinArray[2]);
					}else{
						$this->db->join($joinArray[0], $joinArray[1]);
					}
					
				}
			} else {
				if(isset($join[2])){
					$this->db->join($join[0], $join[1] , $join[2]);
				}else{
					$this->db->join($join[0], $join[1]);
				}
				
			}
		}

		$query1 = $this->db->get();

		if ($query1->num_rows() > 0) {
			$res = $query1->row_array();
			return $res['MyFun'];
		} else {
			return array();
		}
		die();
	}

	# function for run custom query  
	function custom_query($query)
	{
		return $this->db->query($query);
		$this->db->insert_id();
		die();
	}

	#
	function get_schema_data($params){
		extract($params);
		$DBName = $this->db->database;
		echo $query = "SELECT $fields FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$DBName' AND TABLE_NAME = '$table'";
		return $this->db->query($query)->result_array()[0];
		die();
	}
}

// $this->my_model->select_data(['table' => 'tablename','field' => '*']);
// $this->my_model->insert_data(['table' => 	'tablename','data' => $data]);
// $this->my_model->update_data(['table' => 'tablename','data' => $data,'where' => ['id' => $id]]);