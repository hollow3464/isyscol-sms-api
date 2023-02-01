<?php
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\HttpFactory;
use Hollow3464\SmsApiHelper\Sms\Messages\SmsMessage;
use Hollow3464\SmsApiHelper\SmsApiHelper;

Dotenv\Dotenv::createImmutable(__DIR__ . '/..')->load();

$factory = new HttpFactory();

$helper = new SmsApiHelper(
    new Client(),
    $factory,
    $factory,
    $factory,
    $_ENV['SMS_URL'],
    $_ENV['SMS_USER'],
    $_ENV['SMS_PASS']
);

test('send sms message', function () use ($helper) {
    expect($helper->sendSms(
        new SmsMessage(
            [$_ENV['TEST_PHONE']],
            'TEST MESSAGE'
        )
    ))->toBeObject();
});
