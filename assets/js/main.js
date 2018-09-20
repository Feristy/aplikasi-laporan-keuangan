$(document).ready(function(){
	
    $('#myTable').DataTable();
    $('.dataTables_info').remove();

	var burger = 0;
	$(document).on('click', '.burger', function(){
		if(burger == 0){
			$('.admin-menu').addClass('side-in');
			$('.contents').addClass('content-in');
			burger++;
		}else{
			$('.admin-menu').removeClass('side-in');
			$('.contents').removeClass('content-in');
			burger--;
		}
	});

	var adminmenu = $('#data').attr('data-id');
	$(adminmenu+' .submenu').css({'max-height':'initial'});
	$(adminmenu+' .admin-menu-first').removeClass('admin-menu-first').addClass('admin-menu-active');

	$(document).on('click', '.admin-menu-first', function(){
		var panel = this.nextElementSibling;
		$('.admin-menu-active').removeClass('admin-menu-active').addClass('admin-menu-first');
		$('.submenu').css({'max-height':'0px'});
		$(this).removeClass('admin-menu-first').addClass('admin-menu-active');
		panel.style.maxHeight = panel.scrollHeight + "px";
	});
	$(document).on('click', '.admin-menu-active', function(){
		$('.submenu').css({'max-height':'0px'});
		$('.admin-menu-active').removeClass('admin-menu-active').addClass('admin-menu-first');
	});

	var checkid = document.getElementsByClassName('check');

	function check(){
	    for(var i = 0; i < checkid.length; i++){
	    	checkid[i].checked=true
	    }
	}
	
	function uncheck(){
	    for(var i = 0; i < checkid.length; i++){
	    	checkid[i].checked=false
	    }
	}

	var inputChecked = document.getElementsByClassName('in-check');

	function inputCheck(){
		var inc = [];
		for(var i = 0; i < inputChecked.length; i++){
			var sinc = inputChecked[i].checked;
			if(sinc != false){
				inc[i] = inputChecked[i].value;
			}
		}

		return inc;
	}

	$(document).on('click', '.check-true', function(){
		$('.check-true').removeClass('check-true').addClass('check-false');
		check();
		$('.in-del').val(inputCheck());
	});

	$(document).on('click', '.check-false', function(){
		$('.check-false').removeClass('check-false').addClass('check-true');
		uncheck();
		$('.in-del').val(inputCheck());
	});

	$('.check', this).click(function(){
		$('.check-false').removeClass('check-false').addClass('check-true');
		document.getElementById('all-check').checked=false
		$('.in-del').val(inputCheck());
	});

	$('.btn-add').click(function(){
		$('.tambah .modal-title').text('Tambah Kategori Produk');
		$('.id-ktg').val('');
		$('.nama-ktg').val('');
		$('.submit-ktg').attr('name', 'add');
		$('.submit-ktg').text('Tambah');
	});

	$('.btn-edit').click(function(){
		var id = $(this).attr('data-id');
		var name = $(this).attr('data-name');
		var id_debit = $(this).attr('data-iddebit') != '' ? $(this).attr('data-iddebit'): '';
		var debit = $(this).attr('data-debit') != '' ? $(this).attr('data-debit'): '';
		var total_debit = $(this).attr('data-totaldebit') != '' ? $(this).attr('data-totaldebit'): '';
		var id_kredit = $(this).attr('data-idkredit') != '' ? $(this).attr('data-idkredit'): '';
		var kredit = $(this).attr('data-kredit') != '' ? $(this).attr('data-kredit'): '';
		var total_kredit = $(this).attr('data-totalkredit') != '' ? $(this).attr('data-totalkredit'): '';

		$('.id').val(id);
		$('.edit-name').val(name);

		if(id_debit != ''){
			$('.id-debit').val(id_debit);
		}else{
			$('.id-debit').val('');			
		}

		if(debit != ''){
			$('.edit-debit .'+debit).attr('selected', 'selected');
		}else{
			$('.edit-debit option[selected]').removeAttr('selected');
			$('.debit-default').attr('selected', 'selected');
		}

		if(total_debit != ''){
			$('.edit-total-debit').val(total_debit);
		}else{
			$('.edit-total-debit').val('');
		}

		if(id_kredit != ''){
			$('.id-kredit').val(id_kredit);
		}else{
			$('.id-kredit').val('');
		}

		if(kredit != ''){
			$('.edit-kredit .'+kredit).attr('selected', 'selected');
		}else{
			$('.edit-kredit option[selected]').removeAttr('selected');
			$('.kredit-default').attr('selected', 'selected');
		}

		if(total_kredit != ''){
			$('.edit-total-kredit').val(total_kredit);
		}else{
			$('.edit-total-kredit').val('');
		}
	});

	$('.btn-edit-user').click(function(){
		var username = $(this).attr('data-name');
		var id = $(this).attr('data-id');
		$('.edit-data input[type="text"]').val(username);
		$('.edit-id').val(id);
	});

	$('.btn-history').click(function(){
		var name = '<dt>Keterangan</dt><dd>'+$(this).attr('data-name')+'</dd>';
		var debit = $(this).attr('data-debit') != '' ? '<dt>Debit</dt><dd>'+$(this).attr('data-debit')+'</dd>': '';
		var kredit = $(this).attr('data-kredit') != '' ? '<dt>Kredit</dt><dd>'+$(this).attr('data-kredit')+'</dd>': '';
		var date = '<dt>Tanggal</dt><dd>'+$(this).attr('data-date')+'</dd>';

		$('.detail .modal-body').html('<dl class="dl-horizontal">'+name+debit+kredit+date+'</dl>');
	});
});