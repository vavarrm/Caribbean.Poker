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
		
		$this->load->model('caribbeanPoker_Model');
	}
	public function CaribbeanPokerDemo($run=10)
	{
		set_time_limit(60*10);
		ini_set('memory_limit', '256M');
		$bet = 5;
		// $playPoint =1000000;//只打對子
		$playPoint =154183;//AKJ83
		for($i=1;$i<=$run;$i++)
		{
			$odds = 1;
			$double=0;
			$winlose = 0;
			$winner ='';
			$output = $this->game->start();
			// $output['player'] = array(
				// 'h_5',
				// 'd_8',
				// 'h_4',
				// 's_9',
				// 'c_4',
			// );
			// $output['banker'] = array(
				// 'd_4',
				// 'h_9',
				// 'c_6',
				// 's_4',
				// 'h_7',
			// );
			$player_point = $this->game->getCardPoint($output['player']);
			$banker_point = $this->game->getCardPoint($output['banker']);
			// echo  'player bet'.$bet;
			// echo "<br>";
			// echo 'banker top card：'.$output['banker'][4];
			// echo "<br>";
			// echo 'banker：'.join('&nbsp; &nbsp; ' , $output['banker'])."&nbsp;&nbsp; point：".$banker_point['point']."&nbsp;&nbsp; crad：".$banker_point['pokerOutput'];
			// echo "<br>";
			// echo 'player：'.join('&nbsp; &nbsp; ' , $output['player'])."&nbsp;&nbsp; point：".$player_point['point']."&nbsp;&nbsp; crad：".$player_point['pokerOutput'];
			if($player_point['point'] >$playPoint)
			{
				// echo "<br>";
				$double = $bet*2;
				// echo "Double :".$double;
				
				if($banker_point['point'] >= 153000)
				{
					// echo "<br>";
					
					if($player_point['point'] > $banker_point['point'])
					{
						$winner  ="player";
						$odds = $this->game->getOdds($player_point['point']);
						// echo $odds."<br>";
						$winlose = $double*$odds+$bet;
					}elseif($player_point['point'] < $banker_point['point'])
					{
						$winner  ="banker";
						$winlose =-1*($double+$bet);
					}else{
						$winner  ="tie";
						echo "d";
						$winlose=0;
					}
				}else
				{
					$winner  ="player";
					$winlose = $bet*$odds ;
				}
			}else
			{
				$winner  ="banker";
				$winlose = -1*$bet;
			}
			// echo "<br>";
			// echo "winner:".$winner;
			// echo "<br>";
			// echo "winlose :".$winlose;
			$save =array(
				'banker' =>array(
					'hand_card' =>join(':',$output['banker']) ,
					'card_style'=>$banker_point['pokerOutput'],
					'card_point'=>$banker_point['point']
				),
				'player' =>array(
					'hand_card' =>join(':',$output['player']) ,
					'card_style'=>$player_point['pokerOutput'],
					'card_point'=>$player_point['point']
				),
				'bet'	=>$bet,
				'winner'	=>$winner,
				'winlose'	=>$winlose,
				'odds'		=>$odds,
				'double'	=>$double,
				'playPoint'	=>$playPoint
			);
			// echo "<hr>";
			$batch[] =array(
				'banker_hand_card' 	=>join(':',$output['banker']), 
				'banker_card_style' =>$banker_point['pokerOutput'], 
				'banker_card_point' =>$banker_point['point'], 
				'player_hand_card'	=>join(':',$output['player']), 
				'player_card_style' =>$player_point['pokerOutput'], 
				'player_card_point'	=>$player_point['point'], 
				'winner' 			=>$winner,
				'odds'				=>$odds,
				'bet'				=>$bet,
				'double'			=>$double,
				'winlose'			=>$winlose,
				'play_point'		=>$playPoint,
				'player_card_type'	=>$banker_point['type'],
				'banker_card_type'	=>$player_point['type'],
			);
			// echo $run%20000;
			// echo "<br>";
			if($run%20000 ==0)
			{
				$this->caribbeanPoker_Model->savebatch($batch);
				$batch =array();
			}
			// $this->caribbeanPoker_Model->save($save);
		}
		if(!empty($batch))
		{
			$this->caribbeanPoker_Model->savebatch($batch);
		}
	}
}
