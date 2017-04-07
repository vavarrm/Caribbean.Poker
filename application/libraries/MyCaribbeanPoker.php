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
			var_dump( $this->card);
			$this->basicShuffle();
			var_dump( $this->card);
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
			// rsort($this->card);
			
			return $output;
		}
		
		public function getOdds($point)
		{
			$odds = 1;
			if($point >= 9000000)
			{
				$odds  =100;//皇家同花順
			}elseif($point>=8000000 && $point<9000000){
				$odds  =50;//同花順
			}elseif($point>=7000000 && $point<8000000){
				$odds  =20;//四條
			}elseif($point>=6000000 && $point<7000000){
				$odds  =7;//葫蘆
			}elseif($point>=5000000 && $point<6000000){
				$odds  =5;//同花
			}elseif($point>=4000000 && $point<5000000){
				$odds  =4;//順子
			}elseif($point>=3000000 && $point<4000000){
				$odds  =3;//三條
			}elseif($point>=2000000 && $point<3000000){
				$odds  =2;//兩對
			}
			
			return $odds ;
			
		}
		
		public function getCardPoint($ary)
		{
			$flush = false;
			$straight =false; 
			$point = 0;
			$pokerOutput='';
			$AK=0;
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
			
			$number = array();
			$pair_ary = array();
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
			$straightStr ="A23456789TJQKATJQK";
			$straightTemp = '';
			sort($number);
			foreach($number as $value)
			{
				$straightTemp.= $cardAry[$value];
			}
			
		;
			
			if (strstr($straightStr,$straightTemp)) 
			{
			  	$straight = true;
			} 
			 
			//判斷是否同花順，同花打不打的過葫蘆house
			if($flush ==true && $straight ==true)
			{
				$pokerOutput ='Straight Flush';
				$point = 8000000;
				if($straightTemp=="ATJQK")
				{
					$type ="Royal Straight Flush"; 
					$point +=1000000;
				}else{
					$flush_straight_max =$number_max;
					$point+=$flush_straight_max;
					$type ="Straight Flush"; 
				}
				$output['point'] = $point;
				$output['type'] = $type;
				$output['pokerOutput'] = 	$pokerOutput;
				return $output;
			}
			
			//判斷是否為鐵支
			$same_count = max($pair_ary);
			$same_max = array_keys($pair_ary, max($pair_ary));
			if( $same_count  == 4)
			{
				$point = 7000000;
				$add = $addPointAry[$same_max[0]];
				$point+=$add;
				$four_of = $cardAry[$same_max[0]];
				$pokerOutput ='Four of a Kind of '.$four_of;
				$output['point'] = $point;
				$output['pokerOutput'] = 	$pokerOutput;
				$output['type'] = 'Four of a Kind';
				var_dump($output);
				return $output;
			}
			
			//判斷葫蘆
			if( $same_count  == 3 && count($pair_ary) == 2)
			{
				$point = 6000000;
				$add = $addPointAry[$same_max[0]];
				$point+=$add;
				$full_house_pair_point = array_keys($pair_ary, '2');
				$point+=$full_house_pair_point[0];
				$full_house_set = $cardAry[$same_max[0]];
				$full_house_pair = $cardAry[$full_house_pair_point[0]];
				$output['point'] = $point;
				$output['pokerOutput'] = 	$full_house_set.'-'.$full_house_pair.' Full house';
				$output['type'] = 'Full house';
				return $output;
			}
			
			//同花
			if($flush ==true)
			{
				$point = 5000000;
				
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
				$output['type'] = 'Flush';
				return $output;
			}
			
			
			//順子
			if($straight ==true)
			{
				$point = 4000000;
				
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
				$output['type'] = 'straight';
				return $output;
			}
			
			//三條
			if( $same_count  == 3)
			{
				$point = 3000000;
				$add = $addPointAry[$same_max[0]];
				$output['point'] = $point+$add;
				$set = $cardAry[$same_max[0]];
				$output['pokerOutput'] = $set.' set';
				$output['type'] = 'set';
				return $output;	
			}

			//兩對
			if( $same_count  == 2 && count($pair_ary) == 3)
			{
				
				$point = 2000000;
				$two_pair_ary =array();
				foreach($pair_ary as $key =>$value)
				{
					if($value ==2)
					{
						$two_pair_ary[$cardAry[$key]] =  $addPointAry[$key];
						$two_pair_point[]= $addPointAry[$key];
					}else{
						$kicked = $addPointAry[$key];
					}
				}
				ksort($two_pair_point);
				krsort($two_pair_ary);

				$two_pair_ary_str = join('-', array_keys($two_pair_ary));
				$point +=array_shift($two_pair_point)*10000;
				$point +=array_shift($two_pair_point)*1000;
				$point +=$kicked ;
				$output['point'] = $point;
				$output['pokerOutput'] = 	$two_pair_ary_str .' Two Pairs';
				$output['type'] = 'Two Pairs';
				return $output;	
			}
			
			//1對
			$pair_high = array();
			if( $same_count  == 2 && count($pair_ary) == 4)
			{
				$point = 1000000;
				foreach($pair_ary as $key =>$value)
				{
					if($value ==2)
					{
						$one_pair_ary_str =  $cardAry[$key];
						$add = $addPointAry[$key]*10000;
						$point+=$add;
					}else{
						$pair_high[] = $addPointAry[$key];
					}

					// echo "<hr>";
				}
				rsort($pair_high);
				$point+=$pair_high[0]*1000+$pair_high[1]*100+$pair_high[2]*100;
				$output['point'] = $point;
				$output['pokerOutput'] = 	$one_pair_ary_str .'  Pairs';
				$output['type'] = 'Pairs';
				return $output;	
			}
			
			//高牌
			
			$point = 0;
			$output['point'] = $point;
			$odds = 10000;

			if($number[0] =='1')
			{
				array_shift($number);
				rsort($number);
				array_unshift($number, '1');
			}else{
				rsort($number);
			}
			// var_dump($number);
			foreach($number as $key =>$value)
			{
				if($value == 1 || $value ==13)
				{
					$AK++;
				}
				$add = $addPointAry[$value]*$odds;
				$point+=$add;
				$odds*=0.1;
			}
			$output['point'] = $point;
			$output['pokerOutput'] = 	'High card';
			$output['type'] = 'High card';
			$outpput['AK']=$AK;
			return $output;	
		}
	}
?>