<?php

require_once __DIR__ .'/../models/User.php';
require_once __DIR__ .'/../helpers/Log.php';

class UserController
{
    private User $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function import($fileTmpPath): string
    {
        try {
            if (($handle = fopen($fileTmpPath, "r")) !== false) {
                fgetcsv($handle);

                while (($data = fgetcsv($handle, 1000)) !== false) {
                    try {
                        $this->userModel->create($data[0], $data[1]);
                    } catch (Exception $e) {
                        logError($e->getMessage());
                    }
                }
                fclose($handle);
                return 'Success';
            }
        } catch (\Exception $e) {
            logError($e->getMessage());
        }
        return 'Internal Server Error';
    }
}