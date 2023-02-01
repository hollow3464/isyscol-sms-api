<?php

namespace Hollow3464\SmsApiHelper\Sms\Reports;

final class SmsReportResponse
{
    public function __construct(
        public readonly SentSmsReportsIterator $reports
    ) {
    }

    public static function fromJson(string $data): static
    {
        $data = json_decode($data, true);

        return new static(
            SentSmsReportsIterator::fromArray($data['reports'])
        );
    }
}
