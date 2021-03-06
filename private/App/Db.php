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

    /**
     * @param string $sql
     * @param array $data
     * @return bool
     * @throws DbException
     */
    public function execute(string $sql, array $data = [])
    {
        $sth = $this->dbh->prepare($sql);
        $result = $sth->execute($data);

        if (false === $result) {
            throw new DbException('Ошибка запроса к БД');
        }

        return true;
    }

    /**
     * @param string $sql
     * @param array $data
     * @param null $class
     * @return array
     * @throws DbException
     */
    public function query(string $sql, array $data = [], $class = null)
    {
        $sth = $this->dbh->prepare($sql);
        $result = $sth->execute($data);

        if (false === $result) {
            throw new DbException('Ошибка запроса к БД');
        }

        if (null === $class) {
            return $sth->fetchAll();
        } else {
            return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
        }
    }

    /**
     * @return string
     */
    public function lastInsetId()
    {
        return $this->dbh->lastInsertId();
    }
}