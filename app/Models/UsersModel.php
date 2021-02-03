<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'user_id';

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['username', 'password', 'level'];

    protected $useTimestamps = false;
}
