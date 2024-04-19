<?php

declare(strict_types=1);

namespace Hollow3464\SmsApiHelper\NumberContext;

use Hollow3464\SmsApiHelper\Error;
use Hollow3464\SmsApiHelper\Status;

final class NCResponseDetails
{
    public function __construct(
        public readonly string $to,
        public readonly string $mccMnc,
        public readonly string $imsi,
        public readonly Network $originalNetwork,
        public readonly bool $ported,
        public readonly Network $portedNetwork,
        public readonly bool $roaming,
        public readonly Network $roamingNetwork,
        public readonly string $servingMSC,
        public readonly Status $status,
        public readonly Error $error
    ) {}
}
