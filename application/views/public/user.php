<?=$errors?>
<h3>History</h3>
<br>
<form method="post">
<table class="table table-striped table-bordered" id="myTable">
	<thead>
		<tr>
			<th class="tb-check"><input id="all-check" class="check-true" type="checkbox"></th>
			<th>Nama Pengguna</th>
			<th class="tb-act">Action</th>
		</tr>
	</thead>
	<tbody>
	  	<?php foreach ($user as $all_data) {?>
	  	<tr>
	      <td><input class="check in-check" type="checkbox" name="<?=$all_data['id']?>" value="<?=$all_data['id']?>"></td>
	      <td><?=$all_data['username']?></td>
	      <td class="tb-act">
	      	<div class="btn-group btn-group-xs">
		      	<button type="button" class="btn btn-success btn-sm btn-edit-user" data-toggle="modal" data-target=".edit-data" data-id="<?=$all_data['id']?>" data-name="<?=$all_data['username']?>"><i class="fa fa-pencil-alt fa-fw"></i></button>
  				<button type="submit" class="btn btn-danger btn-xs" title="Hapus" name="del" value="<?=$all_data['id']?>"><i class="fa fa-times fa-fw"></i></button>
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
        <div class="title-modal">Edit Pengguna <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
      </div>
      <div class="modal-body">
      	<form method="post">
      		<div class="form-group">
      			<label>Nama Pengguna</label>
      			<input type="text" class="form-control" name="username">
      		</div>
      		<div class="form-group">
      			<label>Password</label>
      			<input type="password" class="form-control" name="password">
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
        <div class="title-modal">Edit Pengguna <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
      </div>
      <div class="modal-body">
      	<form method="post">
      		<div class="form-group">
      			<label>Nama Pengguna</label>
      			<input type="text" class="form-control" name="username">
      		</div>
      		<div class="form-group">
      			<label>Password Lama</label>
      			<input type="password" class="form-control" name="last-password">
      		</div>
      		<div class="form-group">
      			<label>Password Baru</label>
      			<input type="password" class="form-control" name="new-password">
      		</div>
          <input type="hidden" class="edit-id" name="id">
    			<input type="hidden" name="<?=$csrf['name']?>" value="<?=$csrf['hash']?>">
    			<button type="submit" class="btn btn-success btn-block" name="edit" value="1" style="margin-top:30px;">Edit</button>
    		</form>
      </div>
    </div>
  </div>
</div>