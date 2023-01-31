<?php

namespace Hollow3464\SmsApiHelper\Sms\Logs;

final class SmsLogsResponse
{
    public function __construct(
        public readonly SentSmsLogsIterator $results
    ) {
    }
}
