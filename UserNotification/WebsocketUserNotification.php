<?php

namespace UserNotification;


class WebsocketUserNotification implements IUserNotification
{

    public function notify($message)
    {
        // I can develop here, open the connection to the socket, send the message etc...
    }

}