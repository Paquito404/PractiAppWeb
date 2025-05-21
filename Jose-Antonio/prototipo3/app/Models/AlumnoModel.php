<?php

namespace App\Models;
use CodeIgniter\Model;

class AlumnoModel extends Model
{
    protected $table = 'alumnos';
    protected $returnType = 'array';
    protected $primaryKey = 'ID';
    protected $allowedFields = ['nombre', 'carrera', 'correo', 'password'];
}