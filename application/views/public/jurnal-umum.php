<h3>Produk</h3>
<br>
<form method="post">
<table class="table table-striped table-bordered" id="myTable">
	<thead>
		<tr>
			<th class="tb-check"><input id="all-check" class="check-true" type="checkbox"></th>
			<th>Keterangan</th>
			<th>Debit</th>
			<th>Kredit</th>
			<th class="tb-act">Action</th>
		</tr>
	</thead>
	<tbody>
	  	<?php foreach ($jurnal_umum as $all_data) {
	  			$debit = $finm->read('debit', array('id' => $all_data['id_debit']));
	  			$debit1 = !empty($debit['debit']) ? $debit['debit'].', Rp.'.number_format($debit['total']): '';
	  			$in_id_debit = url_title($debit['debit']);
	  			
	  			$kredit =  $finm->read('kredit', array('id' => $all_data['id_kredit']));
	  			$kredit1 = !empty($kredit['kredit']) ? $kredit['kredit'].', Rp.'.number_format($kredit['total']): '';
	  			$in_id_kredit = url_title($kredit['kredit']);
	  		?>
	  	<tr>
	      <td><input class="check in-check" type="checkbox" name="<?=$all_data['id']?>" value="<?=$all_data['id']?>"></td>
	      <td><?=$all_data['name']?></td>
	      <td><?=$debit1?></td>
	      <td><?=$kredit1?></td>
	      <td class="tb-act">
				<div class="btn-group btn-group-xs">
					<button type="button" class="btn btn-success btn-sm btn-edit" data-toggle="modal" data-target=".edit-data" data-id="<?=$all_data['id']?>" data-name="<?=$all_data['name']?>" data-iddebit="<?=$all_data['id_debit']?>" data-debit="<?=$in_id_debit?>" data-totaldebit="<?=$debit['total']?>" data-idkredit="<?=$all_data['id_kredit']?>" data-kredit="<?=$in_id_kredit?>" data-totalkredit="<?=$kredit['total']?>" title="Edit">
						<i class="fa fa-pencil-alt fa-fw"></i></button>
					<button type="submit" class="btn btn-danger btn-xs" title="Hapus" name="del" value="<?=$all_data['id']?>">
						<i class="fa fa-times fa-fw"></i></button>
				</div>
			</td>
	    </tr>
	    <?php }?>
	</tbody>
</table>
<input type="hidden" class="in-del" name="in-del-all">
<input type="hidden" name="<?=$csrf['name']?>" value="<?=$csrf['hash']?>">
</form>
<div class="modal fade tambah-data" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="title-modal">Tambah Jurnal Umum <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
      </div>
      <div class="modal-body">
      	<form method="post">
      		<div class="form-group">
				<label>Keterangan</label>
				<input type="text" class="form-control" name="name">
			</div>
			<div class="form-group">
				<label>Debit</label>
				<div class="clear"></div>
				<select class="form-control dib" name="debit" style="width:auto">
					<option value="">Nama Pos Akun</option>
					<?php foreach ($pos_akun as $pos_akun_item) {
						echo '<option>'.$pos_akun_item['name'].'</option>';
					}?>
				</select>
				<input type="number" class="form-control dib" name="total-debit" style="width:auto" placeholder="Rp.-">
			</div>
			<div class="form-group">
				<label>Kredit</label>
				<div class="clear"></div>
				<select class="form-control dib" name="kredit" style="width:auto">
					<option value="">Nama Pos Akun</option>
					<?php foreach ($pos_akun as $pos_akun_item) {
						echo '<option>'.$pos_akun_item['name'].'</option>';
					}?>
				</select>
				<input type="number" class="form-control dib" name="total-kredit" style="width:auto" placeholder="Rp.-">
			</div>
			<input type="hidden" name="<?=$csrf['name']?>" value="<?=$csrf['hash']?>">
			<button type="submit" class="btn btn-success btn-block" name="add" value="1" style="margin-top:30px;">Tambah</button>
		</form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade edit-data" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="title-modal">Edit Jurnal Umum <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
      </div>
      <div class="modal-body">
      	<form method="post">
      		<div class="form-group">
				<label>Keterangan</label>
				<input type="text" class="form-control edit-name" name="name">
			</div>
			<div class="form-group">
				<label>Debit</label>
				<div class="clear"></div>
				<input type="hidden" class="id-debit" name="id-debit">
				<select class="form-control dib edit-debit" name="debit" style="width:auto">
					<option class="debit-default" value="">Nama Pos Akun</option>
					<?php foreach ($pos_akun as $pos_akun_item) {
						$id_debit = url_title($pos_akun_item['name']);
						echo '<option class="'.$id_debit.'">'.$pos_akun_item['name'].'</option>';
					}?>
				</select>
				<input type="number" class="form-control dib edit-total-debit" name="total-debit" style="width:auto" placeholder="Rp.-">
			</div>
			<div class="form-group">
				<label>Kredit</label>
				<div class="clear"></div>
				<input type="hidden" class="id-kredit" name="id-kredit">
				<select class="form-control dib edit-kredit" name="kredit" style="width:auto">
					<option class="kredit-default" value="">Nama Pos Akun</option>
					<?php foreach ($pos_akun as $pos_akun_item1) {
						$id_kredit = url_title($pos_akun_item1['name']);
						echo '<option class="'.$id_kredit.'">'.$pos_akun_item1['name'].'</option>';
					}?>
				</select>
				<input type="number" class="form-control dib edit-total-kredit" name="total-kredit" style="width:auto" placeholder="Rp.-">
			</div>
			<input type="hidden" name="<?=$csrf['name']?>" value="<?=$csrf['hash']?>">
			<button type="submit" class="btn btn-success btn-block id" name="edit" value="1" style="margin-top:30px;">Edit</button>
		</form>
      </div>
    </div>
  </div>
</div>