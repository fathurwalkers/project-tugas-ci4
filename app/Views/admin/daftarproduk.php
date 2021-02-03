<?php echo $this->extend('layouts/main'); ?>

<?php echo $this->section('main-content'); ?>

<!-- Default box -->
<div class="card">
        <div class="card-header">
          <h3 class="card-title">Daftar Produk</h3>
        </div>
          
        <div class="card-body">
        <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Produk</th>
                <th>Harga Produk</th>
                <th>Kode Produk</th>
                <th>Kelola Produk</th>
            </tr>
        </thead>
        <tbody>
        <?php $no = 1; ?>
        <?php 
        foreach($produks as $produk) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $produk['nama_produk']; ?></td>
                <td><?= $produk['harga_produk']; ?></td>
                <td>
                    <img src="<?= $produk['kode_produk']; ?>" alt="" width="250px">
                </td>
                <td class="text-center">
                    <a href="<?= $produk['produk_id']; ?>" class="btn btn-info">Edit</a>
                    <a href="<?= $produk['produk_id']; ?>" class="btn btn-success">Detail Produk</a>
                    <a href="<?= $produk['produk_id']; ?>" class="btn btn-danger">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

<?php echo $this->endSection(); ?>