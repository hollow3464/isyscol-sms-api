<?php

namespace Hollow3464\SmsApiHelper\Sms;

final class SendSmsResponse
{
    public function __construct(
        public readonly ?string $bulkId,
        public readonly SendSmsResponseDetailsIterator $messages
    ) {
    }
}
