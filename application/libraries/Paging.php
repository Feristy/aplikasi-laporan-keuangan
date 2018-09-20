<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paging {
	public $link,
			$se;
	protected $CI;

    public function __construct(){
        $this->CI =& get_instance();
    }

    public function set_public_paging($table, $per_page, $key = null, $value = null){
		$value = implode(' ', explode('-', $value));
		$this->se = $value;

		$search = !empty($_GET['s']) ? 's='.$_GET['s'].'&': '';
	
    	$page = !empty($_GET['p']) ? (int)$_GET['p']: 1;

    	$start = ($page > 1) ? ($page * $per_page) - $per_page : 0;

    	if($value == ''){
		    $this->CI->db->limit($per_page, $start);
			$this->CI->db->order_by('id', 'DESC');
			$query = $this->CI->db->get($table);
			$query1 = $this->CI->db->get($table);
		}else{
		    $this->CI->db->like($key, $value);
		    $this->CI->db->limit($per_page, $start);
			$this->CI->db->order_by('id', 'DESC');
			$query = $this->CI->db->get($table);
			$this->CI->db->like($key, $value);
			$query1 = $this->CI->db->get($table);
		}

		$result = $query->result_array();
		$total_data = $query1->num_rows();
		$total_page = ceil($total_data / $per_page);
		$this->link('?'.$search.'p=', $page, $total_page, $per_page, $total_data);
		return $result;
    }

    public function link($url, $active_page, $total_page, $per_page, $total_data){
		$link_page = null;
		$prev = $active_page == 1 ? $active_page: $active_page - 1;
		$prev_ac = $active_page == 1 ? 'disabled="disabled"': 'href="'.$url.$prev.'"';
		$link_page .= '<a '.$prev_ac.' class="btn btn-default btn-sm btn-paging btn-paging">Prev</a>';
		
		$number = null;
		for($i = $active_page - 3; $i < $active_page; $i++){
			if($i < 1) continue;
			$number .= '<a href="'.$url.$i.'" class="btn btn-default btn-sm btn-paging">'.$i.'</a>';
		}

		$number .= '<a class="btn btn-style-default btn-sm">'.$active_page.'</a>';
		for($i = $active_page + 1; $i < 5; $i++){
			if($i > $total_page) break;
			$number .= '<a href="'.$url.$i.'" class="btn btn-default btn-sm btn-paging">'.$i.'</a>';
		}
		
		$link_page .= $number;
		$next = $active_page + 1;
		$next_ac = $active_page == $total_page ? 'disabled="disabled"': 'href="'.$url.$next.'"';
		$link_page .= '<a '.$next_ac.' class="btn btn-default btn-sm btn-paging">Next</a>';

		$this->link = $per_page < $total_data || $active_page < $total_page ? '<nav class="paging">'.$link_page.'</nav>': null;
	}

	public function get_paging(){
		return $this->link;
	}

	public function get_search(){
		return $this->se;
	}
}