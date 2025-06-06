<?php

namespace App\Models;

use CodeIgniter\Model;

class Tabla3Model extends Model
{
    protected $table      = 'Tabla3';

    protected $primaryKey = 'ID';
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nombre'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;
}