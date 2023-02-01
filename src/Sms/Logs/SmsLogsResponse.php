<?php

namespace Hollow3464\SmsApiHelper\Sms\Logs;

final class SmsLogsResponse
{
    public function __construct(
        public readonly SentSmsLogsIterator $results
    ) {
    }

    public static function fromJson(string $data): SmsLogsResponse
    {
        $data = json_decode($data, true);

        return new SmsLogsResponse(
            SentSmsLogsIterator::fromArray($data['results'])
        );
    }
}
