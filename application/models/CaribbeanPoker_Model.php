<?php
	class caribbeanPoker_Model extends CI_Model 
	{
		function __construct()
		{
			parent::__construct();
			$this->load->database();
		}
		
		public function savebatch($ary)
		{
			$this->db->insert_batch('caribbean_poker_income', $ary); 
		}
		
		public  function save($ary)
		{
			$sql ="INSERT INTO caribbean_poker_income (
					`banker_hand_card`, 
					`banker_card_style`, 
					`banker_card_point`, 
					`player_hand_card`, 
					`player_card_style`, 
					`player_card_point`, 
					`winner`,
					`odds`,
					`bet`,
					`double`,
					`winlose`,
					`play_point`
				)VALUES(
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?
				)";
			$bind = array(
				$ary['banker']['hand_card'],
				$ary['banker']['card_style'],
				$ary['banker']['card_point'],
				$ary['player']['hand_card'],
				$ary['player']['card_style'],
				$ary['player']['card_point'],
				$ary['winner'],
				$ary['odds'],
				$ary['bet'],
				$ary['double'],
				$ary['winlose'],
				$ary['playPoint'],
			);
			// $this->db->query($sql, $bind);
		}

	}
?>