<?php

declare(strict_types=1);

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\HttpFactory;
use Hollow3464\SmsApiHelper\SmsMessage;
use Hollow3464\SmsApiHelper\SmsApiHelper;

describe('sms helper', function () {
    $factory = new HttpFactory();

    $helper = new SmsApiHelper(
        client: new Client(),
        requests: $factory,
        uri: $factory,
        streams: $factory,
        username: $_ENV['SMS_USER'],
        password: $_ENV['SMS_PASS'],
    );

    it('sends sms messages', function () use ($helper) {
        expect($helper->sendSms(
            new SmsMessage([$_ENV['TEST_PHONE']], 'TEST MESSAGE'),
        ))->toBeObject();
    });
});
