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
	public function CaribbeanPokerDemo($run=1)
	{
		set_time_limit(60*ˊ60);
		ini_set('memory_limit', '512M');
		$bet = 1;
		// $playPoint =1000000;//只打對子
		$playPoint =141311083;//AKJ83
		for($i=1;$i<=$run;$i++)
		{
			$odds = 1;
			$double=0;
			$winlose = 0;
			$winner ='';
			$output = $this->game->start();
			// var_dump($output['player']);
			// $output['player'] = array(
				// 's_10',
				// 's_11',
				// 's_12',
				// 's_13',
				// 's_1',
			// );
			// $output['banker'] = array(
				// 'h_9',
				// 'h_10',
				// 'h_11',
				// '5_12',
				// 'h_13',
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
			// echo $this->game->zeor_number;
			if($player_point['point'] >=$playPoint)
			{
				// echo "<br>";
				$double = $bet*2;
				// echo "Double :".$double;
				// echo "D";
				// var_dump($banker_point);
				// echo "<br>";
				// echo 1*$this->game->zeor_number;
				
				// if( $banker_point['point'] >=1*$this->game->zeor_number || $banker_point['AK'] >= 2)
				if( $banker_point['point'] >=141304032)
				{
					// echo "<br>";
					// echo "D";
					
					if($player_point['point'] > $banker_point['point'])
					{
						$winner  ="player";
						$odds = $this->game->getOdds($player_point['point']);
						// echo $odds."<br>";
						// echo $double;
						$winlose = $double*$odds+$bet;
					}elseif($player_point['point'] < $banker_point['point'])
					{
						$winner  ="banker";
						$winlose =-1*($double+$bet);
					}else{
						$winner  ="tie";
						// echo "d";
						$winlose=0;
					}
				}else
				{
					$winner  ="player";
					$double = 0;
					$winlose = $bet ;
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
				'player_card_type'	=>$player_point['type'],
				'banker_card_type'	=>$banker_point['type'],
				'version'			=>$this->game->version
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
