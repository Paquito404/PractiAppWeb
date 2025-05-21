<?php

namespace App\Models;
use CodeIgniter\Model;

class MaestroModel extends Model
{
    protected $table = 'maestros';
    protected $returnType = 'array';
    protected $primaryKey = 'ID';
    protected $allowedFields = ['nombre', 'departamento', 'correo', 'password'];

    protected $useTimestamps = false; 
}