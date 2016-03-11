<?php

namespace UserNotification;


class WebsocketUserNotification implements IUserNotification
{

    public function notify($message)
    {
        echo 'Using real implementation' . PHP_EOL;;
        // I can develop here, open the connection to the socket, send the message etc...
    }

}