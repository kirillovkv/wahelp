<?php

require_once 'Model.php';

class User extends Model
{
    public function create(int $number, string $name): bool
    {
        $number = pg_escape_string($this->db, $number);
        $name = pg_escape_string($this->db, $name);


        $result = pg_query($this->db, "INSERT INTO users (number, name) VALUES ('$number', '$name')");

        if (!$result) {
            die("Ошибка выполнения запроса: " . pg_last_error($this->db));
        }

        return pg_affected_rows($result) > 0;
    }

    public function getUnsetUsers(int $mailingId): array
    {
        $id = pg_escape_string($this->db, $mailingId);

        $result = pg_query($this->db, "SELECT users.* FROM users
            LEFT JOIN sent_messages  ON users.id = sent_messages.user_id AND sent_messages.mailing_id = $id
            WHERE sent_messages.id IS NULL"
        );

        if (!$result) {
            throw new Exception("Ошибка выполнения запроса: " . pg_last_error($this->db));
        }

        return pg_fetch_all($result) ?? [];
    }


    public function saveSendMark(int $userId, int $mailingId): bool
    {
        $userId = pg_escape_string($this->db, $userId);
        $mailingId = pg_escape_string($this->db, $mailingId);


        $result = pg_query($this->db, "INSERT INTO sent_messages (user_id, mailing_id) VALUES ('$userId', '$mailingId')");

        if (!$result) {
            die("Ошибка выполнения запроса: " . pg_last_error($this->db));
        }

        return pg_affected_rows($result) > 0;
    }
}