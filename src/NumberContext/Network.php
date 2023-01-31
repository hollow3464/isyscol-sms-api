<?php

namespace Hollow3464\SmsApiHelper\NumberContext;

final class Network {
    public function __construct(
        public readonly string $networkName,
        public readonly string $networkPrefix,
        public readonly string $countryName,
        public readonly string $countryPrefix,
    ){}   
}