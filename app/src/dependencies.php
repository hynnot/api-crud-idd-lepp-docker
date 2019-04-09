<?php
// DIC configuration

$container = $app->getContainer();

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// Eloquent ORM
$container['db'] = function ($container) {
    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($container['settings']['db']);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();
    return $capsule;
};

// Guzzle HTTP client
$container['httpClient'] = function() {
    return new \GuzzleHttp\Client([
        'base_uri' => 'https://api.hostaway.com/',
    ]);
};

// Services
$container['ValidateRequiredParametersFilledService'] = function($container) {
    return new \App\Domain\PhoneBooks\Services\ValidateRequiredParametersFilledService();
};
$container['ValidatePhoneService'] = function($container) {
    return new \App\Domain\PhoneBooks\Services\ValidatePhoneService();
};
$container['ApiService'] = function($container) {
    return new \App\Infrastructure\PhoneBooks\Services\ApiHostawayService($container->get('httpClient'));
};
$container['ApiValidatorService'] = function($container) {
    return new \App\Domain\PhoneBooks\Services\ApiValidatorService($container->get('ApiService'));
};
$container['ValidateCountryCodeService'] = function($container) {
    return new \App\Domain\PhoneBooks\Services\ValidateCountryCodeService($container->get('ApiValidatorService'));
};
$container['ValidateTimeZoneNameService'] = function($container) {
    return new \App\Domain\PhoneBooks\Services\ValidateTimeZoneNameService($container->get('ApiValidatorService'));
};

// Repositories
$container['PhoneBookRepository'] = function($container) {
    $table = $container->get('db')->table('phonebooks');
    return new \App\Infrastructure\PhoneBooks\Repositories\EloquentPhoneBookRepository($table);
};

// Actions
$container['StorePhoneBookItemAction'] = function($container) {
    return new \App\Domain\PhoneBooks\Actions\StorePhoneBookItemAction(
        $container->get('PhoneBookRepository'),
        $container->get('ValidatePhoneService'),
        $container->get('ValidateCountryCodeService'),
        $container->get('ValidateTimeZoneNameService'),
        $container->get('ValidateRequiredParametersFilledService')
    );
};
$container['GetOnePhoneBookItemAction'] = function($container) {
    return new \App\Domain\PhoneBooks\Actions\GetOnePhoneBookItemAction(
        $container->get('PhoneBookRepository')
    );
};
$container['DeleteOnePhoneBookItemAction'] = function($container) {
    return new \App\Domain\PhoneBooks\Actions\DeleteOnePhoneBookItemAction(
        $container->get('PhoneBookRepository')
    );
};

// Controllers
$container['PhoneBookController'] = function($container) {
    return new \App\Controllers\PhoneBookController(
        $container->get('StorePhoneBookItemAction'),
        $container->get('GetOnePhoneBookItemAction'),
        $container->get('DeleteOnePhoneBookItemAction')
    );
};