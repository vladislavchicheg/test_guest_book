<?php

class DB
{
    protected $conn = null;
    private $host = HOST;
    private $dbname = DBNAME;
    private $user = USER;
    private $password = PASSWORD;
    private $error;

    public function __construct()
    {
        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname . ";charset=utf8";
        try {
            $this->conn = new \PDO($dsn, $this->user, $this->password);
        } catch (PDOException $e) {
            $this->conn = null;
            $this->error = $e->getMessage();
        }
    }

    public function getError()
    {
        return $this->_error;
    }
}
