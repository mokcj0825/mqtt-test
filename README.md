To create an MQTT controller within the Laravel framework, you will need to follow these steps to set up and integrate MQTT functionalities:

### 1. Install Required Packages

You will need to install an MQTT library that is compatible with Laravel. One of the commonly used libraries is `php-mqtt/client`. Install it using Composer:

```bash

composer require php-mqtt/client

```

### 2. Configure MQTT

Create a configuration file for MQTT in your Laravel project. You can place this under `config/mqtt.php`. Add the necessary configuration parameters like host, port, client id, and credentials:

```php

return [

    'host' => 'your-mqtt-broker-host',

    'port' => 1883, // default port for MQTT

    'client_id' => 'laravel_mqtt_client',

    'username' => 'your_username', // optional

    'password' => 'your_password', // optional

    'certfile' => 'path_to_certificate_file', // optional for SSL connection

    'local_cert' => 'path_to_local_cert_file', // optional for SSL connection

    'local_key'  => 'path_to_local_key_file', // optional for SSL connection

    'logger' => env('MQTT_LOGGER', true), // Optional: Enable logging for debugging purposes

];

```

### 3. Create the MQTT Service

Create a service class that handles the MQTT connection and communication. This class will utilize the `php-mqtt/client` library to publish and subscribe to topics.

```php

namespace App\Services;

use PhpMqtt\Client\MQTTClient;

class MqttService

{

    protected $mqttClient;

    public function __construct()

    {

        $this->mqttClient = new MQTTClient(

            config('mqtt.host'),

            config('mqtt.port'),

            config('mqtt.client_id')

        );

        if (config('mqtt.username') && config('mqtt.password')) {

            $this->mqttClient->setAuthentication(config('mqtt.username'), config('mqtt.password'));

        }

        if (config('mqtt.certfile')) {

            $this->mqttClient->setSecureConnection(config('mqtt.certfile'));

        }

        $this->mqttClient->connect();

    }

    public function publish($topic, $message)

    {

        $this->mqttClient->publish($topic, $message, 0);

    }

    public function subscribe($topic, $callback)

    {

        $this->mqttClient->subscribe($topic, $callback, 0);

        while ($this->mqttClient->wait_for_packet()) {

            $this->mqttClient->loop();

        }

    }

    public function __destruct()

    {

        $this->mqttClient->disconnect();

    }

}

```

### 4. Create MQTT Controller

Generate a new controller that will handle MQTT requests:

```bash

php artisan make:controller MqttController

```

Inside the controller, utilize the `MqttService` to publish and subscribe to MQTT topics.

```php

namespace App\Http\Controllers;

use App\Services\MqttService;

use Illuminate\Http\Request;

class MqttController extends Controller

{

    protected $mqttService;

    public function __construct(MqttService $mqttService)

    {

        $this->mqttService = $mqttService;

    }

    public function publish(Request $request)

    {

        $topic = $request->input('topic');

        $message = $request->input('message');

        $this->mqttService->publish($topic, $message);

        return response()->json(['success' => true]);

    }

    public function subscribe($topic)

    {

        $callback = function ($topic, $message) {

            echo sprintf("Received message on topic [%s]: %s\n", $topic, $message);

        };

        $this->mqttService->subscribe($topic, $callback);

    }

}

```

### 5. Testing

Test your MQTT controller methods by invoking them through routes or using a tool like Postman. Make sure your MQTT broker is accessible and configured properly.

### 6. Error Handling

Implement error handling and logging within your MQTT service to handle and debug connection issues or data errors efficiently.

With this setup, you have a basic MQTT controller in Laravel that can publish to and subscribe from MQTT topics. Adjust the configurations and functionalities based on your specific requirements and the capabilities of your MQTT broker.

# Setup MQTT Controller in Laravel
To create an MQTT controller within the Laravel framework, you will need to follow these steps to set up and integrate MQTT functionalities:


### 1. Install Required Packages


You will need to install an MQTT library that is compatible with Laravel. One of the commonly used libraries is `php-mqtt/client`. Install it using Composer:


```bash
composer require php-mqtt/client
```


### 2. Configure MQTT


Create a configuration file for MQTT in your Laravel project. You can place this under `config/mqtt.php`. Add the necessary configuration parameters like host, port, client id, and credentials:


```php
return [
    'host' => 'your-mqtt-broker-host',
    'port' => 1883, // default port for MQTT
    'client_id' => 'laravel_mqtt_client',
    'username' => 'your_username', // optional
    'password' => 'your_password', // optional
    'certfile' => 'path_to_certificate_file', // optional for SSL connection
    'local_cert' => 'path_to_local_cert_file', // optional for SSL connection
    'local_key'  => 'path_to_local_key_file', // optional for SSL connection
    'logger' => env('MQTT_LOGGER', true), // Optional: Enable logging for debugging purposes
];
```


### 3. Create the MQTT Service


Create a service class that handles the MQTT connection and communication. This class will utilize the `php-mqtt/client` library to publish and subscribe to topics.


```php
namespace App\Services;


use PhpMqtt\Client\MQTTClient;


class MqttService
{
    protected $mqttClient;


    public function __construct()
    {
        $this->mqttClient = new MQTTClient(
            config('mqtt.host'),
            config('mqtt.port'),
            config('mqtt.client_id')
        );
        if (config('mqtt.username') && config('mqtt.password')) {
            $this->mqttClient->setAuthentication(config('mqtt.username'), config('mqtt.password'));
        }
        if (config('mqtt.certfile')) {
            $this->mqttClient->setSecureConnection(config('mqtt.certfile'));
        }
        $this->mqttClient->connect();
    }


    public function publish($topic, $message)
    {
        $this->mqttClient->publish($topic, $message, 0);
    }


    public function subscribe($topic, $callback)
    {
        $this->mqttClient->subscribe($topic, $callback, 0);
        while ($this->mqttClient->wait_for_packet()) {
            $this->mqttClient->loop();
        }
    }


    public function __destruct()
    {
        $this->mqttClient->disconnect();
    }
}
```


### 4. Create MQTT Controller


Generate a new controller that will handle MQTT requests:


```bash
php artisan make:controller MqttController
```


Inside the controller, utilize the `MqttService` to publish and subscribe to MQTT topics.


```php
namespace App\Http\Controllers;


use App\Services\MqttService;
use Illuminate\Http\Request;


class MqttController extends Controller
{
    protected $mqttService;


    public function __construct(MqttService $mqttService)
    {
        $this->mqttService = $mqttService;
    }


    public function publish(Request $request)
    {
        $topic = $request->input('topic');
        $message = $request->input('message');
        $this->mqttService->publish($topic, $message);


        return response()->json(['success' => true]);
    }


    public function subscribe($topic)
    {
        $callback = function ($topic, $message) {
            echo sprintf("Received message on topic [%s]: %s\n", $topic, $message);
        };


        $this->mqttService->subscribe($topic, $callback);
    }
}
```


### 5. Testing


Test your MQTT controller methods by invoking them through routes or using a tool like Postman. Make sure your MQTT broker is accessible and configured properly.


### 6. Error Handling


Implement error handling and logging within your MQTT service to handle and debug connection issues or data errors efficiently.


With this setup, you have a basic MQTT controller in Laravel that can publish to and subscribe from MQTT topics. Adjust the configurations and functionalities based on your specific requirements and the capabilities of your MQTT broker.
