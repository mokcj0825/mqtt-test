# MQTT Test Project

This project is a Laravel-based application designed to publish and subscribe to messages using MQTT. It showcases how to integrate MQTT messaging into a web application environment.

## Project Overview

The `mqtt-test` application is configured to send a timestamp via MQTT every time a specific endpoint is triggered. This can be used to demonstrate real-time data handling and communication between different parts of a distributed system.

## Prerequisites

Before you can run this project, you'll need the following installed:

- PHP 7.4 or higher

- Composer

- Laravel 8.x

- MQTT Broker (e.g., Mosquitto)

## Installation

Follow these steps to get your development environment set up:

1\. Clone the repository:

```bash

git clone https://github.com/your-username/mqtt-test.git

cd mqtt-test

```

2\. Install dependencies:

```bash

composer install

```

3\. Set up the environment file:

Copy the `.env.example` file to `.env` and adjust the database and MQTT broker settings accordingly.

```bash

cp .env.example .env

```

Update these lines in your `.env` file:

```plaintext

MQTT_HOST=localhost

MQTT_PORT=1883

```

4\. Generate an application key:

```bash

php artisan key:generate

```

5\. Run migrations (if applicable):

```bash

php artisan migrate

```

6\. Start the Laravel development server:

```bash

php artisan serve

```

## Usage

To publish a timestamp message to the MQTT broker:

1\. Navigate to `http://localhost:8000/publish-timestamp` in your web browser or use a tool like curl to trigger the endpoint:

```bash

curl http://localhost:8000/publish-timestamp

```

2\. Check your MQTT client to see the message that was published.

## Setting Up Mosquitto MQTT Broker

Mosquitto is a lightweight and open-source MQTT broker that is easy to install and configure. Follow these steps to set up Mosquitto on your system and integrate it with the `mqtt-test` Laravel application.

### Installation

#### On Ubuntu

```bash

sudo apt-get update

sudo apt-get install mosquitto mosquitto-clients

```

#### On Windows

Download the Mosquitto broker from mosquitto.org and follow the installation instructions provided on the website.

#### On macOS

You can install Mosquitto using Homebrew:

```bash

brew install mosquitto

```

### Configuration

After installing Mosquitto, you will need to configure it to work with your `mqtt-test` application.

1\. Edit the Mosquitto Configuration File:

Typically, the configuration file is located at `/etc/mosquitto/mosquitto.conf` on Linux and at `/usr/local/etc/mosquitto/mosquitto.conf` on macOS.

Add the following lines to enable basic communication:

```plaintext

listener 1883

allow_anonymous true

```

This configuration sets Mosquitto to listen on port 1883 and allows anonymous connections. For development purposes, this is usually sufficient.

2\. Restart Mosquitto:

After changing the configuration, restart Mosquitto to apply the changes.

On Linux:

```bash

sudo systemctl restart mosquitto

```

On macOS:

```bash

brew services restart mosquitto

```

### Verifying the Installation

To ensure Mosquitto is running correctly, you can subscribe to a test topic using the Mosquitto client:

```bash

mosquitto_sub -h localhost -t test/topic

```

Open another terminal and publish a message:

```bash

mosquitto_pub -h localhost -t test/topic -m "Hello MQTT"

```

If the setup is correct, you should see "Hello MQTT" appear in the terminal where you subscribed.

## Integrating with Laravel

Ensure that your Laravel `.env` file contains the correct settings to connect to Mosquitto:

```plaintext

MQTT_HOST=localhost

MQTT_PORT=1883

```

Your Laravel application should now be able to publish messages to the Mosquitto broker.

## Security Note

For production environments, consider securing your MQTT communication:

- Set up user authentication.

- Consider using TLS/SSL for encrypted communication.

Refer to the Mosquitto documentation for detailed instructions on security configurations.

