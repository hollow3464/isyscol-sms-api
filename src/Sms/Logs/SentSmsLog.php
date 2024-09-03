<?php

declare(strict_types=1);

namespace Hollow3464\SmsApiHelper\Sms\Logs;

use Hollow3464\SmsApiHelper\Status;
use Hollow3464\SmsApiHelper\Error;
use Hollow3464\SmsApiHelper\Sms\Price;

final class SentSmsLog
{
    public function __construct(
        public readonly string $bulkId,
        public readonly string $messageId,
        public readonly string $to,
        public readonly string $from,
        public readonly string $text,
        public readonly string $sentAt,
        public readonly string $doneAt,
        public readonly int $smsCount,
        public readonly string $mmcmnc,
        public readonly string $callbackData,
        public readonly ?Price $price = null,
        public readonly ?Status $status = null,
        public readonly ?Error $error = null,
    ) {}
}
