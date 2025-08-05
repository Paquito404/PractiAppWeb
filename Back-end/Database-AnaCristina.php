<?php

namespace Config;

use CodeIgniter\Database\Config;
use PDO;

class Database extends Config
{
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;

    public string $defaultGroup = 'default';

    /**
     * The default database connection.
     *
     * @var array<string, mixed>
     */
    
        public array $default = [
            'DSN'        => '',
            'servername' => 'ANACRISTINA',
            'hostname'   => 'localhost',
            'username'   => 'sa',
            'password'   => 'Santiago00',
            'database'   => 'Escuela',
            'schema'     => 'dbo',
            'DBDriver'   => 'SQLSRV',
            'DBPrefix'   => '',
            'pConnect'   => false,
            'DBDebug'    => true,
            'charset'    => 'UTF-8',
            'swapPre'    => '',
            'encrypt'    => false,
            'failover'   => [],
            'port'       => 1433,
            'TrustServerCertificate' => true,
            'dateFormat' => [
                'date'     => 'Y-m-d',
                'datetime' => 'Y-m-d H:i:s',
                'time'     => 'H:i:s',
            ],
            'encoding'   => 'SQLSRV_ENC_CHAR', // Especificar encoding explícitamente
            'options' => [
             ]
        ];

    /**
     * This database connection is used when running PHPUnit database tests.
     *
     * @var array<string, mixed>
     */

    public function __construct()
    {
        parent::__construct();

        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }
    }
}