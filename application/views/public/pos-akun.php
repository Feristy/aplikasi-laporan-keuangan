<h3>Pos Akun</h3>
<br>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Pos Akun</th>
			<th>Debit</th>
			<th>Kredit</th>
			<th>Saldo</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($pos_akun as $all_data){?>
		<tr>
			<td><?=$all_data['name']?></td>
			<td><?=$all_data['debit']?></td>
			<td><?=$all_data['kredit']?></td>
			<td><?=$all_data['saldo']?></td>
		</tr>
	<?php }?>
	</tbody>
</table>