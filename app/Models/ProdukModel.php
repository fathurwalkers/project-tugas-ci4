<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table      = 'produk';
    protected $primaryKey = 'produk_id';

    protected $returnType     = 'array';

    protected $allowedFields = [
        'nama_produk', 
        'harga_produk', 
        'kode_produk'
    ];

    protected $useTimestamps = false;
}
