<?php

require_once __DIR__ .'/../models/Mailing.php';
require_once __DIR__ .'/../helpers/Log.php';

class MailingController
{
    private Mailing $mailingModel;

    public function __construct()
    {
        $this->mailingModel = new Mailing();
    }

    public function create(string $title, string $content): string
    {
        try {
            $this->mailingModel->create($title, $content);
            return 'Success';
        } catch (\Exception $e) {
            logError($e->getMessage());
            return 'Internal Server Error';
        }
    }
}