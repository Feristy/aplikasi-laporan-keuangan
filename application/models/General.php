<?php

class General extends CI_Model{

	public function __construct()
	{
		$this->time->default_timezone('Asia/Jakarta');
	}

	public function read($table, $id = array())
	{
		if(empty($id)){
			$query = $this->db->get($table);
			return $query->result_array();
		}else{
			$query = $this->db->get_where($table, $id);
			return $query->row_array();
		}
	}

	public function read_by($table, $id, $by)
	{
		$this->db->order_by($id, $by);
		$query = $this->db->get($table);
		return $query->result_array();
	}

	public function update($table, $data = array(), $key_id, $val_id)
	{
		$this->db->where($key_id, $val_id);
		$this->db->update($table, $data);
	}

	public function last_id($table, $cols, $ai = '')
	{
		$this->db->order_by($cols, 'DESC');
		$query = $this->db->get($table);
		$query = $query->row_array();
		$nilai = '';
		if(!empty($query)){
			if(!empty($ai)){
				 $nilai = $query[$cols]+$ai;
			}else{
				$nilai = $query[$cols];
			}
		}else{
			$nilai = 1;
		}
		return $nilai;
	}

	public function reload($url, $input = array())
	{
		foreach ($input as $input_item) {
			if($this->input->post($input_item)){
				redirect(site_url($url));
			}
		}
	}

	public function total2()
	{
		$pos_akun = $this->read('post_akun');
		foreach ($pos_akun as $pos_akun_item) {
			$saldo = (int)$pos_akun_item['debit'] > (int)$pos_akun_item['kredit'] ? (int)$pos_akun_item['debit'] - (int)$pos_akun_item['kredit']: 0;
			$this->update('post_akun', array('saldo' => $saldo), 'name', $pos_akun_item['name']);
		}

		$pa_kas_ditangan = $this->read('post_akun', array('id' => '1'));
		$this->update('asset', array('total' => $pa_kas_ditangan['saldo']), 'id', '1');

		$pa_kas_dibank = $this->read('post_akun', array('id' => '2'));
		$this->update('asset', array('total' => $pa_kas_dibank['saldo']), 'id', '2');

		$pa_peralatan = $this->read('post_akun', array('id' => '3'));
		$this->update('asset', array('total' => $pa_peralatan['saldo']), 'id', '3');

		$pa_penjualan = $this->read('post_akun', array('id' => '4'));
		$this->update('penjualan_bersih', array('total' => $pa_penjualan['saldo']), 'id', '1');

		$pa_diskon = $this->read('post_akun', array('id' => '5'));
		$this->update('penjualan_bersih', array('total' => $pa_diskon['saldo']), 'id', '2');

		$pa_listrik = $this->read('post_akun', array('id' => '6'));
		$this->update('biaya', array('total' => $pa_listrik['saldo']), 'id', '1');

		$pa_telephone = $this->read('post_akun', array('id' => '7'));
		$this->update('biaya', array('total' => $pa_telephone['saldo']), 'id', '2');

		$pa_internet = $this->read('post_akun', array('id' => '8'));
		$this->update('biaya', array('total' => $pa_internet['saldo']), 'id', '3');

		$pa_gaji = $this->read('post_akun', array('id' => '9'));
		$this->update('biaya', array('total' => $pa_gaji['saldo']), 'id', '4');

		$pa_modal = $this->read('post_akun', array('id' => '10'));
		$this->update('modal', array('total' => $pa_modal['kredit']), 'id', '2');
		$this->update('modal', array('total' => $pa_modal['debit']), 'id', '3');

		$pa_pinjaman = $this->read('post_akun', array('id' => '11'));
		$jml_pinjaman = $pa_pinjaman['kredit'] > $pa_pinjaman['debit'] ? $pa_pinjaman['kredit'] - $pa_pinjaman['debit']: 0;
		$this->update('kewajiban_modal', array('total' => $jml_pinjaman), 'id', '2');

		$penjualan = $this->read('penjualan_bersih', array('name' => 'Penjualan'));
		$diskon_penjualan = $this->read('penjualan_bersih', array('name' => 'Diskon Penjualan'));

		$penjualan_bersih = (int)$penjualan['total'] - (int)$diskon_penjualan['total'];

		$total_biaya = 0;
		$biaya = $this->read('biaya');
		foreach ($biaya as $value_biaya) {
			$total_biaya += (int)$value_biaya['total'];
		}
		$laba = $penjualan_bersih > $total_biaya ? $penjualan_bersih - $total_biaya: $total_biaya - $penjualan_bersih;
		$this->update('modal', array('total' => $laba), 'id', '4');

		$total_modal = 0;
		$modal = $this->read('modal');
		foreach ($modal as $value_modal) {
			$total_modal += (int)$value_modal['total'];
		}
		$this->update('kewajiban_modal', array('total' => $total_modal), 'id', '1');
	}

	public function total()
	{
		$pos_akun = $this->read('post_akun');
		$debit = $this->read('debit');
		foreach ($pos_akun as $pos_akun_item) {
			$total_debit = 0;
			foreach ($debit as $val_debit) {
				if($pos_akun_item['name'] == $val_debit['debit']){
					$total_debit += (int)$val_debit['total'];
				}
			}
			$this->update('post_akun', array('debit' => $total_debit), 'name', $pos_akun_item['name']);
		}

		$kredit = $this->read('kredit');
		foreach ($pos_akun as $pos_akun_item) {
			$total_kredit = 0;
			foreach ($kredit as $val_kredit) {
				if($pos_akun_item['name'] == $val_kredit['kredit']){
					$total_kredit += (int)$val_kredit['total'];
				}
			}
			$this->update('post_akun', array('kredit' => $total_kredit), 'name', $pos_akun_item['name']);
		}

		$this->total2();
	}

	public function delete($data)
	{
		$data_jurnal_umum = $this->read('jurnal_umum', array('id' => $data));

		$data_debit = $this->read('debit', array('id' => $data_jurnal_umum['id_debit']));
		$data_kredit = $this->read('kredit', array('id' => $data_jurnal_umum['id_kredit']));

		$data_pos_akun_debit = $this->read('post_akun', array('name' => $data_debit['debit']));
		$data_pos_akun_kredit = $this->read('post_akun', array('name' => $data_kredit['kredit']));

		$data_pengurangan_debit = (int)$data_pos_akun_debit['debit'];
		$data_pengurangan_debit1 = (int)$data_debit['total'];

		$data_pengurangan_kredit = (int)$data_pos_akun_kredit['kredit'];
		$data_pengurangan_kredit1 = (int)$data_kredit['total'];

		$pengurangan_debit = $data_pengurangan_debit - $data_pengurangan_debit1;
		$pengurangan_kredit = $data_pengurangan_kredit - $data_pengurangan_kredit1;

		$this->update('post_akun', array('debit' => $pengurangan_debit), 'name', $data_pos_akun_debit['name']);
		$this->update('post_akun', array('kredit' => $pengurangan_kredit), 'name', $data_pos_akun_kredit['name']);

		$this->db->delete('debit', array('id' => $data_debit['id']));
		$this->db->delete('kredit', array('id' => $data_kredit['id']));
		$this->db->delete('jurnal_umum', array('id' => $data));
		
		$this->total2();
	}
}