<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="<?= base_url('template/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
</head>

<body>
	<h1 class="text-center">Laporan Barang<?php echo ($title != null ? " " . $title : "") ?></h1>
	<div class="container">
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>No.</th>
					<th>ID Barang</th>
					<th>Nama Barang</th>
					<th>Merk Barang</th>
					<?php if (!empty($barang)) {
						$i = 1;
						foreach ($barang as $key => $row) : ?>
							<?php if ($key == 0 && $row['stok_masuk']) : ?>
								<th>Stok Masuk</th>
								<th>Stok Keluar</th>
							<?php endif; ?>
					<?php endforeach;
					} ?>
					<th>Stok</th>
					<th>Keterangan</th>
					<th>Tanggal</th>
				</tr>
			</thead>
			<tbody>
				<?php if (!empty($barang)) {
					$i = 1;
					foreach ($barang as $row) : ?>
						<tr>
							<td><?= $i++; ?></td>
							<td><?= $row['id']; ?></td>
							<td><?= $row['nama_barang']; ?></td>
							<td><?= $row['merk_barang']; ?></td>
							<?php if ($row['stok_masuk']) : ?>
								<td><?= $row['stok_masuk'] ?></td>
								<td><?= $row['stok_keluar'] ?></td>
							<?php endif; ?>
							<td><?= $row['stok']; ?></td>
							<td><?php echo ($row['stok'] < 50 ? "Stok Rendah" : "") ?></td>
							<td><?= $row['tanggal'] ?? "" ?></td>
						</tr>
				<?php endforeach;
				} ?>
			</tbody>
		</table>
	</div>
</body>
<script>
	window.print();
</script>

</html>
