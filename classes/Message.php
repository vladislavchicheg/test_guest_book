<?php

class Message extends DB
{
    public $id;
    public $email;
    public $name;
    public $message;

    public function save()
    {
        $stmt = $this->conn->prepare('INSERT INTO guest_book(`email`, `name`, `body`, `dtime`) VALUES(:email, :name, :body, :dtime)');
        $stmt->execute(array('email' => $this->email, 'name' => $this->name, 'body' => $this->message, 'dtime' => date('Y-m-d H:i:s')));
        $this->id = $this->conn->lastInsertId();
        return $this->id;
    }

    public function findAll()
    {
        $stmt = $this->conn->prepare('SELECT * FROM guest_book ORDER BY id DESC LIMIT 0, 5');
        $stmt->execute();
        $comments = [];
        while ($row = $stmt->fetch(\PDO::FETCH_LAZY)) {
            $messages[] = ['id' => $row->id, 'name' => $row->name, 'email' => $row->email, 'message' => $row->body, 'created_at' => $row->dtime];
        }
        return $messages;
    }
}
