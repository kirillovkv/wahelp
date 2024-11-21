<?php
require_once __DIR__ . '/../services/MailingService.php';
require_once __DIR__ . '/../helpers/Log.php';

try {
    $service = new MailingService();
    $service->sendMailings();
} catch (Exception $e) {
    logError($e->getMessage());
}
