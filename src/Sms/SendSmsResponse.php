<?php

declare(strict_types=1);

namespace Hollow3464\SmsApiHelper\Sms;

final class SendSmsResponse
{
    public function __construct(
        public readonly ?string $bulkId,
        public readonly SendSmsResponseDetailsIterator $messages
    ) {}

    public static function fromJson(string $data): static
    {
        $data = json_decode($data, true);

        return new SendSmsResponse(
            $data['bulkId'] ?? '',
            SendSmsResponseDetailsIterator::fromArray($data['messages'])
        );
    }
}
