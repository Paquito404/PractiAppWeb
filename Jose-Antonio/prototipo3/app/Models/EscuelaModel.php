<?php

namespace App\Models;

use CodeIgniter\Model;

class EscuelaModel extends Model
{
    protected $table      = 'Practicas';

    protected $primaryKey = 'ID';
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['Titulo', 'Carrera', 'Estatus', 'Integrantes', 'Fase'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;
}