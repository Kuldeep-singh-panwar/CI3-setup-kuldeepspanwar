<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

	// $data = $this->my_model->select_data([
	// 	'field' => '*',
	// 	'table' => 'tablename',
	// 	'where' => ['user_id' => $_SESSION['id'], 'id' => $id],
	// 	'group' => 'coloumn name',
	// 	'order' => ['id', 'ASC']
	// ]);
	// $add = $this->my_model->insert_data([
	// 	'table' => 'tablename',
	// 	'data' => $data
	// ]);
	// $update = $this->my_model->insert_data([
	// 	'table' => 'tablename',
	// 	'data' => $data,
	// 	'where' => ['user_id' => $_SESSION['id'], 'id' => $id],
	// ]);
}
