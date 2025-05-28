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
            'servername' => 'DESKTOP-UAB8ENP',
            'hostname'   => 'localhost',
            'username'   => 'paquito',
            'password'   => '1234',
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
            PDO::SQLSRV_ATTR_ENCODING => PDO::SQLSRV_ENCODING_BINARY,
            PDO::SQLSRV_ATTR_DIRECT_QUERY => true
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