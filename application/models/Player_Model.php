<?php
	class Player_Model extends CI_Model 
	{
		function __construct()
		{
			
			parent::__construct();
			$this->load->database();
			$this->table_name = 'player';
		}
		
		public function getList($where)
		{
			$output =array();
			$bind = array();
			$str = $this->getWhere($where, $bind);
			
			$sql=sprintf("SELECT * FROM %s %s", $this->table_name , $str);
			
			$query = $this->db->query($sql, $bind);
			$output['list'] = $query->result_array() ;
			return $output;
		}
		
		private function getWhere($where, &$bind)
		{
			$str ="WHERE 1 = 1 ";
			if(!empty($where))
			{
				foreach($where as $key => $row)
				{
					switch ($row['operand']) {
						case 'like':
							$str.=sprintf(" AND %s LIKE '%s'", $key, "%".$row['value']."%");
							break;
						default:
							$str.=sprintf(" AND %s %s %s", $key, $row['operand'], $row['value']);
							$bind[] = $row['value'];
					}
					
				}
			}
			return $str;
		}

	}
?>