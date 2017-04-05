<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainPage extends CI_Controller {

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
	public function index()
	{
		
		$this->smarty->assign(array(
			'content'	=>'MainPage/index.tpl',
			'Controller'			=>__CLASS__,
		));
		$this->smarty->display('shared/frame.tpl');
	}
	
	public function table()
	{
		$this->smarty->assign(array(
			'content'	=>'MainPage/table.tpl',
			'Controller'			=>__CLASS__,
		));
		$this->smarty->display('shared/frame.tpl');
	}
	
	public function handCardLog()
	{
		$position = array(
			'BTN' =>'BTN',
			'SB' =>'SB',
			'BB' =>'BB',
			'EP' =>'EP',
			'MP5' =>'MP',
			'MP4' =>'MP',
			'MP3' =>'MP',
			'MP2' =>'MP',
			'MP1' =>'MP',
			'HJ' =>'HJ',
			'CO' =>'CO',
		);
		$this->smarty->assign(array(
			'content'	=>'MainPage/handCardLog.tpl',
			'position'	=>$position,
			'Controller'			=>__CLASS__,
		));
		$this->smarty->display('shared/frame.tpl');
	}
}
