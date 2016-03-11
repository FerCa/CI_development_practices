<?php

namespace UserNotification;

class NullUserNotification implements IUserNotification
{

    public function notify($message)
    {
        echo 'Using null implementation' . PHP_EOL;;
    }

}