<?php

namespace App\Models;

use CodeIgniter\Model;

class Authdb extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'username', 'password'];
}
