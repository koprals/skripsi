<style>
tr{
	height:30px;
	vertical-align:middle;
	padding-left:10px;
}
tr.header{
	background-color:#999999;
	font-weight:bold;
	font-size:16px;
}

tr.ganjil{
	background-color:#ffffff;
	font-weight:normal;
	font-size:14px;
}
tr.genap{
	background-color:#F0F0F0;
	font-weight:normal;
	font-size:14px;
}


</style>

<h2 style="text-align:left;">Laporan Hasil Akhir Rangking Karyawan Kandidat</h2>
<table width="850" border="1" cellspacing="0" cellpadding="0">
	<tr class="header">
		<td style="text-align:center;">No</td>
		<td width="150">Jabatan Kosong</td>
		<td width="150">Nama Karyawan</td>
		<td width="250">Total Pengetahuan</td>
		<td width="150">Total Sikap Kerja</td>
		<td width="150">Total Prilaku</td>
		<td width="150">Total Akhir</td>
	</tr>

	<?php if(!empty($data)):?>
	<?php $count = 0;?>
	<?php foreach($data as $data): ?>
	<?php $count++;?>
	<?php $no		=	(($page-1)*$viewpage) + $count;?>
	<?php $class = ($count % 2 == 0) ? "ganjil" : "genap";?>
  	<tr class="<?php echo $class?>">
		<td style="text-align:center;"><?php echo $no ?></td>
		<td><?php echo $data['Gap']['ProfilKaryawan']['ProfilJabatan']['nama_jabatan']?></td>
		<td><?php echo $data['Gap']['ProfilKaryawan']['Karyawan']['nama']?></td>
		<td><?php echo $data[$ModelName]['total_pengetahuan'] ?></td>
		<td><?php echo $data[$ModelName]['total_sikap_kerja'] ?></td>
		<td><?php echo $data[$ModelName]['total_prilaku'] ?></td>
		<td><?php echo $data[$ModelName]['total_akhir'] ?></td>
	</tr>
	<?php endforeach;?>
	<?php else:?>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<?php endif;?>
</table>

<h2 style="text-align:left;">Pembobotan Karyawan</h2>
<table width="850" border="1" cellspacing="0" cellpadding="0">
	<tr class="header">
		<td width="150">Jabatan Kosong</td>
		<td width="150">Nama Karyawan</td>
		<td width="150">Common Sense</td>
		<td width="150">Verbalisasi Ide</td>
		<td width="150">Sistematika Berpikir</td>
		<td width="150">Penalaran</td>
		<td width="150">Konsentrasi</td>
		<td width="150">Logika Praktis</td>
		<td width="150">Fleksibilitas Berpikir</td>
		<td width="150">Imajinasi</td>
		<td width="150">Antisipasi</td>
		<td width="150">IQ</td>
		<td width="150">Energi Psikis</td>
		<td width="150">Ketelitian</td>
		<td width="150">Kehati-hatian</td>
		<td width="150">Pengendalian Perasaan</td>
		<td width="150">Dorongan Prestasi</td>
		<td width="150">Perencanaan</td>
		<td width="150">Kepemimpinan</td>
		<td width="150">Pengaruh</td>
		<td width="150">Keteguhan Hati</td>
		<td width="150">Pemenuhan</td>
	</tr>

	<?php if(!empty($datar)):?>
	<?php $count = 0;?>
	<?php foreach($datar as $datar):?>
	<?php $count++;?>
	<?php $no		=	(($page-1)*$viewpage) + $count;?>
	<?php $class = ($count % 2 == 0) ? "ganjil" : "genap";?>
  	<tr class="<?php echo $class?>">
		<td><?php echo $datar['Gap']['ProfilKaryawan']['ProfilJabatan']['nama_jabatan']?></td>
		<td><?php echo $datar['Gap']['ProfilKaryawan']['Karyawan']['nama']?></td>
		<td><?php echo $datar['Gap']['common_sense'] ?></td>
		<td><?php echo $datar['Gap']['verbalisasi_ide'] ?></td>
		<td><?php echo $datar['Gap']['sistematika_berpikir'] ?></td>
		<td><?php echo $datar['Gap']['penalaran'] ?></td>
		<td><?php echo $datar['Gap']['konsentrasi'] ?></td>
		<td><?php echo $datar['Gap']['logika_praktis'] ?></td>
		<td><?php echo $datar['Gap']['fleksibilitas_berpikir'] ?></td>
		<td><?php echo $datar['Gap']['imajinasi'] ?></td>
		<td><?php echo $datar['Gap']['antisipasi'] ?></td>
		<td><?php echo $datar['Gap']['iq'] ?></td>
		<td><?php echo $datar['Gap']['energi_sikis'] ?></td>
		<td><?php echo $datar['Gap']['ketelitian'] ?></td>
		<td><?php echo $datar['Gap']['kehatian'] ?></td>
		<td><?php echo $datar['Gap']['pengendalian_perasaan'] ?></td>
		<td><?php echo $datar['Gap']['dorongan_prestasi'] ?></td>
		<td><?php echo $datar['Gap']['perencanaan'] ?></td>
		<td><?php echo $datar['Gap']['kekuasaan'] ?></td>
		<td><?php echo $datar['Gap']['pengaruh'] ?></td>
		<td><?php echo $datar['Gap']['keteguhan_hati'] ?></td>
		<td><?php echo $datar['Gap']['pemenuhan'] ?></td>
	</tr>
	<?php endforeach;?>
	<?php else:?>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<?php endif;?>
</table>

<h3 style="backgorund-color:red">Rekomendasi Karyawan Pengisi Jabatan Karyawan Pada Peringkat Pertama</h3>