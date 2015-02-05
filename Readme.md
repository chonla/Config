# Config Loader/Dumper

Config Loader/Dumper is an extension to [Noodlehaus/Config package](https://packagist.org/packages/noodlehaus/config).

## Supported configuration loader

PHP, INI, XML, JSON, and YAML

## Supported configuration dumper

JSON and YAML

## API

Like Noodlehause/Config, `Config` object can be statically created or instantiated from `Config`:

```php
$conf = Config::load('config.json');
$conf = new Config('config.json');
```

Use `get()` to retrieve values:
```php
// Get value using key
$debug  = $config->get('debug');

// Get value using nested key
$secret = $config->get('security.secret');

// Get a value with a fallback
$ttl    = $config->get('app.timeout', 3000);
```

Use `set()` to set values (doh!):
```php
$conf = Config::load('config.json');
$conf->set('app.timeout', 1000);
```

Use `save()` to export settings to file:
```php
$conf = Config::load('config.yaml');
$conf->set('app.timeout', 1000);
$conf->save('new-config.yaml');
```

## Examples (from Noodlehaus/Config)

Here's an example JSON file that we'll call `config.json`.

```json
{
    "app": {
        "host": "localhost",
        "port": 80,
        "base": "/my/app"
    },
    "security": {
        "secret": "s3cr3t-c0d3"
    },
    "debug": false
}
```

Here's the same config file in PHP format:

```php
<?php
return array(
    'app' => array(
        'host' => 'localhost',
        'port' => 80,
        'base' => '/my/app'
    ),
    'security' => array(
        'secret' => 's3cr3t-c0d3'
    ),
    'debug' => false
);
```

Or in a PHP file that returns a function that creates your config:

```php
return function () {
    // Normal callable function, returns array
    return array(
    'app' => array(
        'host' => 'localhost',
        'port' => 80,
        'base' => '/my/app'
    ),
    'security' => array(
        'secret' => 's3cr3t-c0d3'
    ),
    'debug' => false
    );
};
```

Or in an INI format:

```ini
debug = false

[app]
host = localhost
port = 80
base = /my/app

[security]
secret = s3cr3t-c0d3
```

Or in an XML format:

```xml
<?xml version="1.0" encoding="UTF-8"?>
<config>
    <app>
        <host>localhost</host>
        <port>80</port>
        <base>/my/app</base>
    </app>
    <security>
        <secret>s3cr3t-c0d3</secret>
    </security>
    <debug>false</debug>
</config>
```

Or in a YAML format:

```yaml
app:
    host: localhost
    port: 80
    base: /my/app
security:
    secret: s3cr3t-c0d3
debug: false
```

## license
MIT: <http://chonla.mit-license.org/>
