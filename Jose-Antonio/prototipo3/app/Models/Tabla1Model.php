<?php

namespace App\Models;

use CodeIgniter\Model;

class Tabla1Model extends Model
{
    protected $table      = 'Tabla1';

    protected $primaryKey = 'ID';
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nombre'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;
}