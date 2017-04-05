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
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array(
			'MyCaribbeanPoker'	=> 'game'
		));
	}
	public function CaribbeanPokerDemo()
	{
		for($i=1;$i<=10;$i++)
		{
			$output = $this->game->start();
			$output['player'] = array(
				's_1',
				'h_3',
				'd_12',
				'c_12',
				's_8',
			);
			$player_point = $this->game->getCardPoint($output['player']);
			// echo $player_point;
			var_dump($player_point);
			// echo "<br>";
			var_dump($output['player']);
			echo "<hr>";
		}
	}
}
