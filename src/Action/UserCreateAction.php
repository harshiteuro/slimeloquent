<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use Illuminate\Database\Connection;

final class UserCreateAction
{
     /**
     * @var Connection
     */
    private $connection;

    /**
     * The constructor.
     *
     * @param Connection $connection The database connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    // Add your custom query methods here...
    public function all(){
        $rows = $this->connection->table('users')->get();
        return $rows;
    }
}