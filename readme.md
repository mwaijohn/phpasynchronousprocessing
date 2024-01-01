## To set up this project follow below steps

Install the php-amqplib library using Composer:

```composer require php-amqplib/php-amqplib```

Running the worker

```php worker.php```

Producing messages

```php producer.php Message to process```


The worker script will process the task in the background without blocking the main application.
