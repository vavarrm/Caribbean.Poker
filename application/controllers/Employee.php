<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() 
	{
		parent::__construct();
		$this->load->model('Employee_Model', 'Employee');
    }
	
	public function index()
	{
		$data = $this->Employee->getList();
		$this->smarty->assign(array(
			'content'				=>'Employee/index.tpl',
			'Controller'			=>__CLASS__,
			'table_list'			=>$data['list']
		));
		$this->smarty->display('shared/frame.tpl');
	}
	
	public function add()
	{
		$this->smarty->assign(array(
			'content'				=>'Employee/add.tpl',
			'Controller'			=>__CLASS__
		));
		$this->smarty->display('shared/frame.tpl');
	}
	
	public function doadd()
	{
		$post = $this->input->post();
		$this->Employee->add($post);
		$this->myfunc->gotoUrl('/Employee/','add ok');
	}
	
}
