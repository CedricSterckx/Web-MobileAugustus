<?php
/**
 * Created by PhpStorm.
 * User: cedri
 * Date: 19-08-19
 * Time: 20:38
 */

namespace App\Model;

use \PDO;

class Connection
{
    private $pdo;

    public function __construct($dsn, $user = null, $password = null)
    {

        $this->pdo = new \PDO($dsn, $user, $password);
        $this->pdo->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );
    }

    public function getPdo()
    {
        return $this->pdo;
    }


}