# GlobalPayBundle

## Installation

### Install the package

```bash
composer req wildan99/global-pay
```

### Add to config/bundles.php

```php
Daniil\GlobalPayBundle\GlobalPayBundle::class => ['all' => true],
```
### Copy routes
```php
/vendor/wildan99/global-pay/config/routes/global_pay.yaml to config/routes/global_pay.yaml
```

### Run in console
```php
php bin/console doctrine:migrations:diff
php bin/console doctrine:migrations:migrate --no-interaction
```

### Add next lines to your .env file

```dotenv
###> GlobalPay ###
GLOBAL_PAY_URL=<get it in GlobalPay>
GLOBAL_PAY_AUTH_URL=<get it in GlobalPay>
GLOBAL_PAY_SERVICE_ID=<get it in GlobalPay>
GLOBAL_PAY_CLIENT_ID=<get it in GlobalPay>
GLOBAL_PAY_GRANT_TYPE=<get it in GlobalPay>
GLOBAL_PAY_SCOPE=<get it in GlobalPay>
GLOBAL_PAY_CLIENT_SECRET=<get it in GlobalPay>
GLOBAL_PAY_USERNAME=<get it in GlobalPay>
GLOBAL_PAY_PASSWORD=<get it in GlobalPay>

###< GlobalPay ###
```

## How to use
You need to use this service in construct method of class
### Example of simple using
```php

class MyClass 
{
    public function __construct(private \Daniil\GlobalPayBundle\Service\Client $client) 
    {
    }
    
    public function prepare(): void
    {
        $this->client->prepare(new PrepareRequest(shopTransactionId: 'test', sum: 1000, currency: Currency::UZS, description: ''))
    }
}
````