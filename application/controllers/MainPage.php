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
		set_time_limit(60*ˊ60);
		ini_set('memory_limit', '512M');
		parent::__construct();
		$this->load->library(array(
			'MyCaribbeanPoker'	=> 'game'
		));
		
		$this->load->model('caribbeanPoker_Model');
	}
	
	public function test($rum = 1)
	{
		for($j=0;$j<=$rum  ;$j++)
		{
			$this->game->initCard();
			$this->game->basicShuffle();
			$output = array();
			
			$card_index = 0;
			$next_card_index = $card_index+5;

			for($i=$card_index ; $i< $next_card_index ; $i++)
			{
				$output['player'][] = $this->game->card[$card_index];

				$card_index++;
			}
			
			$next_card_index+=5;
			for($i=$card_index ; $i< $next_card_index ; $i++)
			{
				$output['banker'][] = $this->game->card[$card_index];

				$card_index++;
			}
			
			// var_dump($output);
			
			$player_point = $this->game->getCardPoint($output['player']);
			$banker_point = $this->game->getCardPoint($output['banker']);
			
			$total_player_table[$player_point['type']]++;
			$total_banker_table[$banker_point['type']]++;
		}
		
		// var_dump($this->game->card);
		
		var_dump($total_player_table);
		var_dump($total_banker_table);
	}
	
	public function initProbabilityTable()
	{
		$this->load->model('caribbeanPoker_Model');
		$pr = array(
			'sf'	=>15/15,
			'fk'	=>240/15,
			'fh'	=>1440/15,
			'fl'	=>1970/15,
			'st'	=>3920/15,
			'tk'	=>21100/15,
			'tp'	=>47500/15,
			'op'	=>422600/15,
			'hc'	=>501215/15,
		);
		
		// foreach($pr)
		// return ;
		$this->caribbeanPoker_Model->delProbabilityTable();
		foreach($pr as $key=> $value)
		{	
			for($i=1;$i<=$value;$i++)
			{

				$batch[] = array(
					'card_style'	=>$key
				);
				
				if($run%200000==0)
				{
					$this->caribbeanPoker_Model->addProbabilityTable($batch);
					unset($batch);
				}
			}
		}
		
		if(!empty($batch))
		{
			$this->caribbeanPoker_Model->addProbabilityTable($batch);
		}
	}
	
	public function CaribbeanPokerDemo($run=5)
	{
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
			// 
			
			// var_dump($output['player']);
			// echo "<hr>";
			// var_dump($output['banker']);
			// var_dump($this->game->card);
			// echo "<hr>";
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
			// var_dump($output['player']);
			$player_point = $this->game->getCardPoint($output['player']);
			$banker_point = $this->game->getCardPoint($output['banker']);
			
			// var_dump($player_point);
			
			// var_dump($banker_point);
			// var_dump($this->game->card);
			// echo "<hr>";
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
				// echo "D";
				$this->caribbeanPoker_Model->savebatch($batch);
				// $batch =array();
				unset($batch);
			}
			// $this->caribbeanPoker_Model->save($save);
		}
		if(!empty($batch))
		{
			$this->caribbeanPoker_Model->savebatch($batch);
		}
	}
}
