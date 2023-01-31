<?php

namespace Hollow3464\SmsApiHelper\Sms;

final class Price
{
    public function __construct(
        public readonly float $pricePerMessage,
        public readonly string $currency
    ) {
    }
}
