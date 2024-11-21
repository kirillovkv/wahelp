<?php

require_once 'Model.php';

class Mailing extends Model
{
    public function create(string $title, string $content): bool
    {
        $title = pg_escape_string($this->db, $title);
        $content = pg_escape_string($this->db, $content);


        $result = pg_query($this->db, "INSERT INTO mailings (title, content) VALUES ('$title', '$content')");

        if (!$result) {
            die("Ошибка выполнения запроса: " . pg_last_error($this->db));
        }

        return pg_affected_rows($result) > 0;
    }

    /**
     * @throws Exception
     */
    public function getUnset(): array
    {
        $result = pg_query($this->db, "SELECT * FROM mailings WHERE is_send = 'false';");

        if (!$result) {
            throw new Exception("Ошибка выполнения запроса: " . pg_last_error($this->db));
        }

        return pg_fetch_all($result) ?? [];
    }

    /**
     * @throws Exception
     */
    public function saveSendMark(int $mailingId): bool
    {
        $mailingId = pg_escape_string($this->db, $mailingId);

        $result = pg_query($this->db, "UPDATE mailings SET is_send = true WHERE id = $mailingId;");

        if ($result) {
            return true;
        } else {
            throw new Exception("Ошибка выполнения запроса: " . pg_last_error($this->db));
        }
    }
}