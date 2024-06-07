<?php

namespace App\Http\Controllers;

use App\Services\MqttClient;
use Bluerhinos\phpMQTT;
use Illuminate\Support\Facades\Log;

class MqttController extends Controller
{
    protected $mqttClient;

    public function __construct(MqttClient $mqttClient)
    {
        $this->mqttClient = $mqttClient;
    }

    public function publishTimestamp()
    {
        $topic = 'test/topic';
        $timestamp = time();  // 获取当前时间戳
        $announcement = 'Publishing timestamp ' . $timestamp;
        $message = ['announcement' => $announcement];

        if ($this->mqttClient->publish($topic, $message)) {
            return response()->json(['status' => 'Success', 'message' => $message]);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'Failed to publish message']);
        }
    }
}
