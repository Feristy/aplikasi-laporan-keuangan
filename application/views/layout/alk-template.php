<!DOCTYPE html>
<html lang="en">
	<head>
    	<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<title><?=$title?></title>
    	<link rel="stylesheet" href="assets/css/bootstrap/css/bootstrap.min.css">
    	<link rel="stylesheet" href="assets/css/fontawesome/css/all.css">
		<link rel="stylesheet" href="assets/css/main.css">
        <script type="text/javascript" src="assets/js/highchart/code/highcharts.js"></script>
        <script type="text/javascript" src="assets/js/highchart/code/modules/exporting.js"></script>
	</head>
	<body>
		<div class="top-bar">
            <div class="container-fluid">
                <div class="row">
                    <div class="btn-burger burger dib pointer"><i class="fas fa-bars"></i></div>
                    <div class="brands dib"><strong>Aplikasi Laporan Keuangan</strong></div>
                    <p class="navbar-text navbar-right" style="margin-right:15px">Masuk sebagei <?=$sign?></p>
                </div>
            </div>
        </div>
        <div class="admin-menu">
            <ul class="list-unstyled">
                <li id="home">
                    <a href="<?=site_url()?>" class="admin-menu-first" data-id="#home">
                        <i class="fa fa-tachometer-alt fa-fw"></i>
                        <span>Dashbord</span>
                    </a>
                </li>
                <li id="jurnal-umum">
                    <a href="jurnal-umum" class="admin-menu-first" data-id="#jurnal-umum">
                        <i class="fas fa-edit fa-fw"></i>
                        <span>Jurnal Umum</span>
                    </a>
                </li>
                <li id="pos-akun">
                    <a href="pos-akun" class="admin-menu-first" data-id="#pos-akun">
                        <i class="fas fa-tasks fa-fw"></i>
                        <span>Pos Akun</span>
                    </a>
                </li>
                <li id="laporan-keuangan">
                    <a href="laporan-keuangan" class="admin-menu-first" data-id="#laporan-keuangan">
                        <i class="fas fa-file-alt fa-fw"></i>
                        <span>Laporan Keuangan</span>
                    </a>
                </li>
                <li id="user">
                    <a href="pengguna" class="admin-menu-first" data-id="#user">
                        <i class="fas fa-user fa-fw"></i>
                        <span>Pengguna</span>
                    </a>
                </li>
                <li>
                    <a href="logout" class="admin-menu-first">
                        <i class="fas fa-sign-out-alt fa-fw"></i>
                        <span>Keluar</span>
                    </a>
                </li>
			</ul>
		</div>
		<div class="contents"><?=$content?></div>
        <div id="data" data-id="#<?=$btn?>"></div>
		<script type="text/javascript" src="assets/js/jquery.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap/bootstrap.min.js"></script>
        <script type="text/javascript" src="assets/js/datatables.min.js"></script>
		<script type="text/javascript" src="assets/js/main.js"></script>
    <?php if(!empty($dashboard)):?>
        <script type="text/javascript">
            Highcharts.chart('chart', {
                chart: {
                    type: 'area'
                },
                title: {
                    text: 'Traffic Penjualan Hari ini'
                },
                xAxis: {
                    categories: [
                        <?php
                            $chart_time = time();
                            $chart_times = array();
                            $tgl = date('d', $chart_time);
                            $tgl1 = array();
                            for($ch=0; $ch < 7; $ch++){
                                $tgl1[] = $tgl;
                                $chart_times[] = $chart_time;
                                $chart_time -= 86400;
                                $tgl--;
                            }
                            $tgl1 = array_reverse($tgl1);
                            $tgl2 = array_reverse($chart_times);
                            for($cht=0; $cht < 7; $cht++){
                                echo '"'.$tgl1[$cht].' '.date('M', $tgl2[$cht]).'",';
                            }
                        ?>
                    ],
                    tickmarkPlacement: 'on',
                    title: {
                        enabled: false
                    },
                },
                yAxis: {
                    title: {
                        text: 'Rupiah'
                    },
                    labels: {
                        formatter: function () {
                            return this.value / 1000;
                        }
                    }
                },
                tooltip: {
                    split: true,
                    valueSuffix: ' Rupiah'
                },
                plotOptions: {
                    area: {
                        stacking: 'normal',
                        lineColor: '#5cb85c',
                        lineWidth: 1,
                        marker: {
                            lineWidth: 1,
                            lineColor: '#5cb85c'
                        }
                    }
                },
                series: [{
                    name: 'Penjualan',
                    data: [
                        <?php
                          $chart_times = array_reverse($chart_times);
                          foreach ($chart_times as $value_chart_times) {
                            $chart_tgl = date('Y-m-d', $value_chart_times);
                            $chart_data = !empty($adm) ? $adm->read('traffic', array('date' => $chart_tgl)): null;
                            $chart_data = !empty($chart_data) && $chart_data['name'] == 'Penjualan' ? $chart_data['val']: 0;
                            echo $chart_data.',';
                          }
                        ?>
                    ],
                    color: '#5cb85c'
                }],
            });
        </script>
    <?php endif;?>
        <script type="text/javascript">
            $(document).ready(function(){
                var btn = '<button type="button" class="btn btn-default btn-del btn-add" data-toggle="modal" data-target=".tambah-data">Tambah</button>';
                var alink = '<a href="<?=@$btn_alink?>" class="btn btn-default btn-del">Tambah</a>';
                var btn_del = '<button class="btn btn-danger btn-del" type="submit" name="del-all" value="1">Hapus</button>';
                $('#myTable_wrapper').prepend(<?php if(!empty($btn_add)){if($btn_add == 'btn'){?>btn+<?php }elseif($btn_add == 'alink'){?>alink+<?php }}?>btn_del);
            });
        </script>
	</body>
</html>