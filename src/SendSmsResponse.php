<?php

declare(strict_types=1);

namespace Hollow3464\SmsApiHelper;

final class SendSmsResponse
{
    /**
    * @param array<SendSmsResponseDetail> $messages
    */
    public function __construct(
        public readonly ?string $bulkId,
        public readonly array $messages,
    ) {}
}
