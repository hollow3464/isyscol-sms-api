<?php

declare(strict_types=1);

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\HttpFactory;
use Hollow3464\SmsApiHelper\Sms\Messages\SmsMessage;
use Hollow3464\SmsApiHelper\SmsApiHelper;

describe('sms helper', function () {
    $factory = new HttpFactory();

    $helper = new SmsApiHelper(
        new Client(),
        $factory,
        $factory,
        $factory,
        $_ENV['SMS_URL'],
        $_ENV['SMS_USER'],
        $_ENV['SMS_PASS'],
    );

    it('sends sms messages', function () use ($helper) {
        expect($helper->sendSms(
            new SmsMessage([$_ENV['TEST_PHONE']], 'TEST MESSAGE'),
        ))->toBeObject();
    });
});
