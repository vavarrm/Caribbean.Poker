<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GameAPI extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array(
			'MyCaribbeanPoker'	=> 'game'
		));
		$this->load->model('caribbeanPoker_Model');
		$this->status_ary = array(
			'100'	=>'OK',
			'001'	=>'input empty',
			'901'	=>'hard card is null',
		);
	}
	
	public function start()
	{
		$post_json = json_decode(trim(file_get_contents('php://input'), 'r'), true);
		$player = $post_json['player'];
		$body =array();
		
		try 
		{
			
			if($player =="")
			{
				throw new Exception('001');
			}
			
			$card = $this->game->start();
			
			if(empty($card))
			{
				throw new Exception('901');
			}
			
			$body['card']['player']  = $this->game->getCardPoint($card['player']);
			$body['card']['player']['handcard']= $card['player'];
			$body['card']['banker'] = $this->game->getCardPoint($card['banker']);
			$body['card']['banker']['handcard']= $card['banker'];
			
			
			$status ='100';
			$body['status'] = $status;
			$body['msg'] = $this->status_ary[$status];
		} catch (Exception $e) 
		{
			$status =  $e->getMessage();
			$body['status'] = $status;
			$body['msg']  = $this->status_ary[$status];
		} finally {
			$this->output($body);
		}
	}
	
	private function output($body){
		$output =array(
			'body'	=>$body,
			'head'	=>array(
				time =>date('Y-m-d H:i:s')
			),
		);
		header('Content-Type: application/json');
		echo json_encode($output);
		exit;
	}
}
?>