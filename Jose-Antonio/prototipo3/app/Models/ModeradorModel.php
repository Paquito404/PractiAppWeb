<?php

namespace App\Models;
use CodeIgniter\Model;

class ModeradorModel extends Model
{
    protected $table = 'moderadores';
    protected $returnType = 'array';
    protected $primaryKey = 'ID';
    protected $allowedFields = ['nombre', 'departamento', 'correo', 'password'];

    protected $useTimestamps = false; 
}