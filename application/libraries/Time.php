<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Time {
	protected $CI;

    public function __construct(){
        $this->CI =& get_instance();
    }

    public function default_timezone($data = 'null'){
    	date_default_timezone_set($data);
    }

    public function get($waktu){
    	if($waktu < 60){
			$waktu = date('s', $waktu).' seconds ago';
		}elseif($waktu < 3600){
			$waktu = date('i', $waktu).' minutes ago';
		}elseif($waktu < 86400){
			$waktu = date('G', $waktu).' hours ago';
		}elseif($waktu < 604800){
			$waktu = date('d', $waktu).' days ago';
		}else{
			$waktu = date('d M Y', $waktu);
		}
		return $waktu;
    }
}