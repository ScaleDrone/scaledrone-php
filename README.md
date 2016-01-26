# ScaleDrone PHP
Official ScaleDrone PHP pushing library. This is a wrapper around the REST API.

##Installation

Make sure you have [composer](https://getcomposer.org) installed.

Install it directly:
```
composer require scaledrone/scaledrone
```

Or add the following to your `composer.json`:

```js
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

##Usage
Create a new instance of ScaleDrone passing it the `channel_id` and `secret_key` that you can find from the channel's page
```php
$auth = array(
    'channel_id' => 'G3TYvCzXatrIuEtQ',
    'secret_key' => 'M7Oc1DYXFgkCaUh4XQFC3TRV1R3RThPd'
);

$client = new ScaleDrone\Client($auth);
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
