<?php


namespace Controller;

use UserNotification\IUserNotification;

class UserController
{

    public function __construct(IUserNotification $userNotification)
    {
        $this->userNotification = $userNotification;
    }

    public function logoutAction()
    {
        $this->logoutCurrentUser();

        $this->userNotification->notify('Your user has been logged out!'); // New Feature
        $this->redirectToHome();
    }



    private function logoutCurrentUser()
    {
        echo "logging out!" . PHP_EOL;
    }

    private function redirectToHome()
    {
        echo "Redirecting to home!" . PHP_EOL;
    }

}