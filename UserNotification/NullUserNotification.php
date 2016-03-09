<?php

namespace UserNotification;

class NullUserNotification implements IUserNotification
{

    public function notify($message)
    {
    }

}