<?php

namespace App\Services;

use Bluerhinos\phpMQTT;

class MqttClient
{
    protected $mqtt;

    public function __construct()
    {
        $this->mqtt = new phpMQTT('localhost', 1883, 'Laravel MQTT Client');
    }

    public function publish($topic, $message)
    {
        // 确保消息已经是一个 JSON 字符串
        $jsonMessage = json_encode($message);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return false;
        }

        if ($this->mqtt->connect()) {
            $this->mqtt->publish($topic, $jsonMessage, 0);
            $this->mqtt->close();
            return true;
        } else {
            return false;
        }
    }
}
