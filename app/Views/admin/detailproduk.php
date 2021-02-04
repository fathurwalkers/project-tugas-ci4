<?php echo $this->extend('layouts/main'); ?>

<?php echo $this->section('main-content'); ?>

<!-- Default box -->
<div class="card">
        <div class="card-header">
          <h3 class="card-title">Detail Produk</h3>
        </div>
        <div class="card-body">
        <div class="card text-center">
  <div class="card-header">
    DETAIL PRODUK 
  </div>
  <div class="card-body">
  <img class="my-3" src="<?= base_url('/'); ?>/<?php echo $produk['gambar_produk']; ?>" alt="">
    <h2 class="card-text"><?= $produk['nama_produk']; ?></h2>
    <h4 class="card-text">Rp. <?= number_format($produk['harga_produk']); ?> ,-</h4>
    <h4 class="card-text">Kode Produk : <?= $produk['kode_produk']; ?></h4>
    <a href="#" class="btn btn-primary mt-4 mb-2">Go somewhere</a>
  </div>
</div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

<?php echo $this->endSection(); ?>