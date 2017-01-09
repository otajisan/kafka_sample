<?php

if ($argc < 2) {
    exit('送信メッセージを指定してください'.PHP_EOL);
}
$message = $argv[1];

$kafka = new Kafka('localhost:9092');
try {
    // メッセージを送信
    $kafka->produce('hello_topic', $message);
} catch (Exception $e) {
    exit($e->getMessage().PHP_EOL);
}

$kafka->disconnect(Kafka::MODE_PRODUCER);
exit('done send message. message='.$message.PHP_EOL);
