<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AjaxApi extends CI_Controller {
	public function __construct() 
	{
		parent::__construct();
		$this->load->model('Player_Model', 'Player');	
    }
	
	public function getPlayerJson($query)
	{
		$output =array(
			'status'	=>000,
			'Message'		=>''
		);
		$where = array(
			'p_name'	=>array('value' =>$query ,'operand'=>'like')
		);
		try {
			$myException = new myException();
			$data = $this->Player->getList($where);
			if(empty($data['list']))
			{
				$output['Message'] ="no data";
				$output['status'] ="001";
				$myException->setParams($output);
				throw $myException;
			}
			
		
			
			$output['data'] = $data;
			$output['status'] = 100;
		} catch (Exception $e) {
			// echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		echo json_encode($output);
	}
	
}
