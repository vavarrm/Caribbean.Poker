<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class MyPoker
	{
		
		public function __construct()
		{

			$this->card = array();
			$this->cardNums = 1;
			$this->suit = array(
				's',
				'h',
				'c',
				'd',
			);

			$this->cardAry =array(
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
			
			$this->addPointAry =array(
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
			
			// $this->initProbabilityTable();
			// var_dump($rand_table);
			
		}
		
		
		public function initProbabilityTable()
		{
		
		
		}
		
		//基本洗牌法
		public function basicShuffle()
		{
			// shuffle($this->card);
			// shuffle($this->card);
			// srand(mktime()*rand(0,9999));
			// shuffle($this->card);
			// shuffle($this->card);
			// shuffle($this->card);
			// rsort($this->card);
			// var_dump($this->card);
			// for($i=1;$i<=3;$i++)
			// {
				// $a = array_slice($this->card, 0 , 26);
				// $b = array_slice($this->card, 26 , 26);
				// $temp = array();
				// foreach($a as $key => $value)
				// {
					// $temp[] = $a[$key];
					// $temp[] = $b[$key];
				// }
					// $this->card = $temp;
			// }
			// shuffle($this->card);
			// rsort($this->card);
			// var_dump($this->card);
		}
		
		
		//牌初始化
		public function  initCard($num = 1)
		{
			$this->card = array();
			for ($i=0 ;$i<$num ;$i++)
			{
				$k = 0;
				for($j=1;$j<=52;$j++)
				{
					$number =  $j-13*$k;
					$suit = $this->suit[$k];
					$this->card[] = $suit.'_'.$number ;
					if($j%13==0)
					{
						$k++;
					}
				}
			}
		}
	}
?>