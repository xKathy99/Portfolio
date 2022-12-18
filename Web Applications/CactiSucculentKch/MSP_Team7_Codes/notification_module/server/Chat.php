<?php

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

$flag=0;
$flag2=0;
function setInterval($f, $milliseconds)
{
    $seconds=(int)$milliseconds/1000;
    while(true)
    {
        $f();
        sleep($seconds);    
    }
}

class Chat implements MessageComponentInterface
{
    protected $clients;
    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
$this->user="hi";      
    }

    public function onOpen(ConnectionInterface $conn)
    {
        
        $this->clients->attach($conn);
        // Store the new connection to send messages to later
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        echo "new message";
        foreach ($this->clients as $client) {
                // The sender is not the receiver, send to each client connected
                $client->send($msg);
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}
