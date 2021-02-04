<?php echo $this->extend('layouts/main'); ?>

<?php echo $this->section('main-content'); ?>

<!-- Default box -->
<div class="card">
        <div class="card-header">
        <h3 class="card-title my-3">Tambah Produk Baru</h3>
          <a href="<?php echo base_url('dashboard/daftar-produk') ?>" class="float-right btn btn-primary mt-1">Kembali</a>
        </div>
        <div class="card-body">
          
        <form action="<?= base_url('/dashboard/tambah-produk') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="nama_produk">Masukkan Nama Produk</label>
                <input type="text" class="form-control" id="nama_produk" aria-describedby="emailHelp" placeholder="Masukkan Nama Produk" name="nama_produk">
            </div>

            <div class="form-group">
                <label for="harga_produk">Masukkan Harga Produk</label>
                <input type="number" class="form-control" id="harga_produk" aria-describedby="emailHelp" placeholder="Masukkan Harga Produk" name="harga_produk">
            </div>

            <div class="form-group">
                <label for="kode_produk">Masukkan Kode Produk</label>
                <input type="file" class="form-control" id="kode_produk" name="kode_produk">
            </div>
            
            <button type="submit" class="btn btn-primary my-2">Input Produk Baru</button>
        </form>

        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

<?php echo $this->endSection(); ?>