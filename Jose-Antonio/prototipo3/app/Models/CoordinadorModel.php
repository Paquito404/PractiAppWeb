<?php

namespace App\Models;
use CodeIgniter\Model;

class CoordinadorModel extends Model
{
    protected $table = 'coordinadores';
    protected $returnType = 'array';
    protected $primaryKey = 'ID';
    protected $allowedFields = ['nombre', 'departamento', 'correo', 'password'];

    protected $useTimestamps = false; 
}