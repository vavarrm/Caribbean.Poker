<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	require_once(APPPATH."libraries/MyPoker.php");
	require_once(APPPATH."libraries/poker_Interface/CaribbeanPokerInterface.php");
	class MyCaribbeanPoker extends MyPoker implements CaribbeanPokerInterface
	{
		
		public function __construct()
		{
			parent::__construct();
		}
		
		public function start()
		{
			$output = array();
			$this->initCard($this->cardNums);
			$this->basicShuffle();
			for($i=1 ;$i<=5;$i++)
			{
				$card = array_shift( $this->card);
				$output['player'][] = $card;
			}
			
			for($i=1 ;$i<=5;$i++)
			{
				$card = array_shift( $this->card);
				$output['banker'][] = $card;
			}
			return $output;
		}
		
		public function getCardPoint($ary)
		{
			$flush = false;
			$straight =false; 
			$point = 0;
			$pokerOutput='';
			
			// $m
			
			$cardAry =array(
				'1'		=>'A',
				'2'		=>'2',
				'3'		=>'3',
				'4'		=>'4',
				'5'		=>'5',
				'6'		=>'6',
				'7'		=>'7',
				'8'		=>'8',
				'9'		=>'9',
				'10'	=>'T',
				'11'	=>'J',
				'12'	=>'Q',
				'13'	=>'K',
			);
			
			$addPointAry =array(
				'1'		=>'14',
				'2'		=>'2',
				'3'		=>'3',
				'4'		=>'4',
				'5'		=>'5',
				'6'		=>'6',
				'7'		=>'7',
				'8'		=>'8',
				'9'		=>'9',
				'10'	=>'10',
				'11'	=>'11',
				'12'	=>'12',
				'13'	=>'13',
			);
			
			if(count($ary) != 5)
			{
				return false ;
			}
			
			foreach($ary as $value)
			{
				$temp = explode('_', $value);
				$number[] = $temp[1];
				$color[$temp[0]] = $color[$temp[0]]+1;
				$pair_ary[$temp[1]] = $pair_ary[$temp[1]]+1;
			}
			$number_max =max($number);
			$number_min =min($number);
			//判斷是否為同花
			if(count($color) == 1)
			{
				$flush = true;
			}
		
			//判斷是否為順子
			sort($number);
			$straightStr ="A23456789TJQKATJQK";
			$straightTemp = '';
			foreach($number as $value)
			{
				$straightTemp.= $cardAry[$value];
			}
			

			if (strstr($straightStr,$straightTemp)) 
			{
			  	$straight = true;
			} 
			 
			//判斷是否同花順，同花打不打的過葫蘆house
			if($flush ==true && $straight ==true)
			{
				$pokerOutput ='Straight Flush';
				$point = 800;
				if($straightTemp=="ATJQK")
				{
					$point +=100;
				}else{
					$flush_straight_max =$number_max;
					$point+=$flush_straight_max;
				}
				$output['point'] = $point;
				$output['pokerOutput'] = 	$pokerOutput;
				return $output;
			}
			
			//判斷是否為鐵支
			// rsort($pair_ary);
			// var_dump($pair_ary);
			$same_count = max($pair_ary);
			$same_max = array_keys($pair_ary, max($pair_ary));
			if( $same_count  == 4)
			{
				$point = 700;
				$add = $addPointAry[$same_max[0]];
				$point+=$add;
				$four_of = $cardAry[$same_max[0]];
				$pokerOutput ='Four of a Kind of '.$four_of;
				$output['point'] = $point;
				$output['pokerOutput'] = 	$pokerOutput;
				return $output;
			}
			
			//判斷葫蘆
			if( $same_count  == 3 && count($pair_ary) == 2)
			{
				// echo $addPointAry[$same_max[1]];
				// var_dump($same_max);
				$point = 600;
				$add = $addPointAry[$same_max[0]];
				$point+=$add;
				$full_house_pair_point = array_keys($pair_ary, '2');
				$point+=$full_house_pair_point[0];
				$full_house_set = $cardAry[$same_max[0]];
				$full_house_pair = $cardAry[$full_house_pair_point[0]];
				$output['point'] = $point;
				$output['pokerOutput'] = 	$full_house_set.'-'.$full_house_pair.' Full house';
				return $output;
			}
			
			//同花
			if($flush ==true)
			{
				$point = 500;
				
				if(in_array('1', $number))
				{
					$flush_max = $cardAry[1];
					$add = $addPointAry[1];
				}else{
					$flush_max = $cardAry[$number_max];
					$add = $addPointAry[$number_max];
				}
				$point+=$add;
				$output['point'] = $point;
				$output['pokerOutput'] = $flush_max.' flush';
				return $output;
			}
			
			
			//順子
			if($straight ==true)
			{
				$point = 400;
				
				if($straightTemp=="ATJQK")
				{
					$add =14;
					$straigh_max_min ='A'.'-'.$cardAry[$number_min];
				}else{
					$add = $addPointAry[$number_max];
					$straigh_max_min =$cardAry[$number_max].'-'.$cardAry[$number_min];
				}
				$point+=$add;
				$output['point'] = $point;
				$output['pokerOutput'] = $straigh_max_min.' straight';
				return $output;
			}
			
			//三條
			if( $same_count  == 3)
			{
				$point = 300;
				$add = $addPointAry[$same_max[0]];
				$output['point'] = $point+$add;
				$set = $cardAry[$same_max[0]];
				$output['pokerOutput'] = $set.' set';
				return $output;	
			}

			//兩對
			if( $same_count  == 2 && count($pair_ary) == 3)
			{
				
				$point = 200;
				$two_pair_ary =array();
				foreach($pair_ary as $key =>$value)
				{
					if($value ==2)
					{
						$two_pair_ary[$cardAry[$key]] =  $addPointAry[$key];
					}
					$add = $addPointAry[$key];
					$point+=$add;
					// echo "<hr>";
				}
				ksort($two_pair_ary);
				$two_pair_ary_str = join('-', array_keys($two_pair_ary));
				$output['point'] = $point;
				$output['pokerOutput'] = 	$two_pair_ary_str .' Two Pairs';
				return $output;	
			}
			
			//1對
		
			if( $same_count  == 2 && count($pair_ary) == 4)
			{
				$point = 100;
				$output['point'] = $point;
				foreach($pair_ary as $key =>$value)
				{
					if($value ==2)
					{
						$one_pair_ary_str =  $cardAry[$key];
					}
					$add = $addPointAry[$key];
					$point+=$add;
					// echo "<hr>";
				}
				$output['point'] = $point;
				$output['pokerOutput'] = 	$one_pair_ary_str .'  Pairs';
				return $output;	
			}
			
			//高牌
			
			var_dump()
			
		}
	}
?>