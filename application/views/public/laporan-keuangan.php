<h3>Laporan Keuangan</h3>
<br>
<h4>Asset</h4>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Nama</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($asset as $all_asset){?>
		<tr>
			<td><?=$all_asset['name']?></td>
			<td><?=$all_asset['total']?></td>
		</tr>
	<?php }?>
	</tbody>
</table>
<br>
<h4>Biaya</h4>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Nama</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($biaya as $all_biaya){?>
		<tr>
			<td><?=$all_biaya['name']?></td>
			<td><?=$all_biaya['total']?></td>
		</tr>
	<?php }?>
	</tbody>
</table>
<br>
<h4>Penjualan</h4>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Nama</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($penjualan_bersih as $all_penjualan_bersih){?>
		<tr>
			<td><?=$all_penjualan_bersih['name']?></td>
			<td><?=$all_penjualan_bersih['total']?></td>
		</tr>
	<?php }?>
	</tbody>
</table>
<br>
<h4>Modal</h4>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Nama</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($modal as $all_modal){?>
		<tr>
			<td><?=$all_modal['name']?></td>
			<td><?=$all_modal['total']?></td>
		</tr>
	<?php }?>
	</tbody>
</table>
<br>
<h4>Kewajiban Modal</h4>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Nama</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($kewajiban_modal as $all_kewajiban_modal){?>
		<tr>
			<td><?=$all_kewajiban_modal['name']?></td>
			<td><?=$all_kewajiban_modal['total']?></td>
		</tr>
	<?php }?>
	</tbody>
</table>