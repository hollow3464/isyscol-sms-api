<?php

declare(strict_types=1);

namespace Hollow3464\SmsApiHelper;

final class SendSmsResponseDetail
{
    public function __construct(
        public readonly string $to,
        public readonly Status $status,
        public readonly int $smsCount,
        public readonly string $messageId,
    ) {}
}
