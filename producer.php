<?php

require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('task_queue', false, true, false, false);

$task = implode(' ', array_slice($argv, 1));
if (empty($task)) {
    $task = 'Default task';
}

$message = new AMQPMessage($task, ['delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT]);

$channel->basic_publish($message, '', 'task_queue');

echo ' [x] Sent ', $task, "\n";

$channel->close();
$connection->close();
