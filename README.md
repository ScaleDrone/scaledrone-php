# ScaleDrone PHP
Official ScaleDrone PHP pushing library. This is a wrapper around the REST API.

##Installation

Make sure you have [composer](https://getcomposer.org) installed.

Install it directly:

```
composer require scaledrone/scaledrone
```

Or add the following to your `composer.json`:

```json
{
    "require": {
        "scaledrone/scaledrone": "*"
    }
}
```

Then update your dependencies:

```bash
$ php composer.phar update
```

## Usage
Create a new instance of ScaleDrone passing it the `channel_id` and `secret_key` that you can find from the channel's page
```php
$auth = array(
    'channel_id' => 'CHANNEL_ID',
    'secret_key' => 'SECRET_KEY'
);

$client = ScaleDrone\Client::create($auth);
```

If you wish to connect using a [JSON Web Token](https://www.scaledrone.com/docs/jwt-authentication) you can set it like this:
```php
$auth = array(
    'channel_id' => 'CHANNEL_ID',
    'bearer' => 'GENERATED_JWT'
);

$client = ScaleDrone\Client::create($auth);
```

Publishing a message
```php
$room = 'notifications';
$message = ['email' => 'test2@foo.bar', 'name' => 'php name'];
$response = $client->publish($room, $message);
```

Channel stats
```php
$response = $client->channel_stats();
```

Connected users list
```php
$response = $client->users_list();
```

## Running Tests

Clone this repository and change directories to the repository root. Install all dependencies with `composer install`.
Then, just run `vendor/bin/phpunit`.
