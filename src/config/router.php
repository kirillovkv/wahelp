<?php

require_once __DIR__ .'/../controllers/UserController.php';
require_once __DIR__ .'/../controllers/MailingController.php';
require_once __DIR__ .'/../helpers/HttpResponse.php';

header('Content-Type: application/json');


$requestUri = $_SERVER['REQUEST_URI'];
$requestUri = explode('?', $requestUri)[0];
$action = str_replace('/api/', '', $requestUri);

switch ($action) {
    case 'import':
        $controller = new UserController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_FILES['file'])) {
                $filePath = $_FILES['file']['tmp_name'];
                echo $controller->import($filePath);;
            } else {
                HttpResponse::sendError("Bad Request", 400);
            }
        } else {
            HttpResponse::sendError("Method Not Allowed.", 405);
        }
        break;
    case 'mailing':
        $controller = new MailingController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['title']) && isset($_POST['content'])) {
                echo $controller->create($_POST['title'], $_POST['content']);
            } else {
                HttpResponse::sendError("Bad Request", 400);
            }
        } else {
            HttpResponse::sendError("Method Not Allowed.", 405);
        }
        break;
    default:
        HttpResponse::sendError("Not Found.", 404);
        break;
}