<?php
require_once __DIR__ .'/../models/Mailing.php';
require_once __DIR__ .'/../models/User.php';

class MailingService
{
    protected Mailing $mailingModel;
    protected User $userModel;

    public function __construct()
    {
        $this->mailingModel = new Mailing();
        $this->userModel = new User();
    }

    /**
     * @throws Exception
     */
    public function sendMailings(): void
    {
        foreach ($this->mailingModel->getUnset() as $mailing) {
            $isSendSuccess = true;
            foreach ($this->userModel->getUnsetUsers($mailing['id']) as $user) {
                if ($this->sendToQueue($user, $mailing)) {
                    $this->userModel->saveSendMark($user['id'], $mailing['id']);
                } else {
                    $isSendSuccess = false;
                }
            }
            if ($isSendSuccess) {
                $this->mailingModel->saveSendMark($mailing['id']);
            }
        }
    }

    private function sendToQueue($user, $mailing): bool
    {
        try {
            return true;
        } catch (\Exception) {
            return false;
        }
    }
}