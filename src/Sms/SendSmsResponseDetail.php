<?php

namespace Hollow3464\SmsApiHelper\Sms;

use Hollow3464\SmsApiHelper\Status;

final class SendSmsResponseDetail
{
    public function __construct(
        public readonly string $to,
        public readonly Status $status,
        public readonly int $smsCount,
        public readonly string $messageId
    ) {
    }
}
