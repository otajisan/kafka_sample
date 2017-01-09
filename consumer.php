<?php

$kafka = new Kafka('localhost:9092');
$partitions = $kafka->getPartitionsForTopic('hello_topic');
$kafka->setPartition($partitions[0]);
$offset = 1;
$size = 1;

while (1) {
    try {
        // メッセージを受信
        $messages = $kafka->consume('hello_topic', $offset, $size);
        if (count($messages) > 0) {
            foreach ($messages as $message) {
                echo $message.PHP_EOL;
                $offset += 1;
            }
        }
    } catch (Exception $e) {
        echo $e->getMessage().PHP_EOL;
        break;
    }
}

$kafka->disconnect();
