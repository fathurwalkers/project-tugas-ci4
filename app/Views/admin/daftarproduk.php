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
            <tr>
                <td>1</td>
                <td>Buku Pemrograman PHP</td>
                <td>10.000.000</td>
                <td>
                    <img src="#" alt="" width="250px">
                </td>
                <td class="text-center">
                    <a href="#" class="btn btn-info">Edit</a>
                    <a href="#" class="btn btn-success">Detail Produk</a>
                    <a href="#" class="btn btn-danger">Hapus</a>
                </td>
            </tr>
        </tbody>
    </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

<?php echo $this->endSection(); ?>