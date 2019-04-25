<?php

namespace App;

class Db
{
    protected $dbh;

    /**
     * Db constructor.
     * @throws DbException
     */
    public function __construct()
    {
        $config = new Config();
        $dns = $config->data['db']['driver']. ':dbname=' . $config->data['db']['dbname'] . ';host=' . $config->data['db']['host'];
        try {
            $this->dbh = new \PDO($dns, $config->data['db']['user'], $config->data['db']['password']);
        } catch (\PDOException $e) {
            throw new DbException('Ошибка соединения с БД');
        }
    }
}