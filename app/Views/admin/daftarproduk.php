<?php echo $this->extend('layouts/main'); ?>

<?php echo $this->section('main-content'); ?>

<!-- Default box -->
<div class="card">
        <div class="card-header">
          <h3 class="card-title my-3">Daftar Produk</h3>
          <a href="<?php echo base_url('dashboard/tambah-produk') ?>" class="float-right btn btn-primary mt-1">Tambah Produk</a>
        </div>
          
        <div class="card-body">
        <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Produk</th>
                <th>Harga Produk</th>
                <th>Kode Produk</th>
                <!-- <th>Gambar Produk</th> -->
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
                <td><?= number_format($produk['harga_produk']); ?></td>
                <td><?= $produk['kode_produk']; ?></td>
                <!-- <td>
                    <img src="<?php echo base_url('/'); ?>/<?= $produk['kode_produk']; ?>" alt="" width="45px">
                </td> -->
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