<?php

namespace Hollow3464\SmsApiHelper\Sms\Reports;

final class SmsReportResponse
{
    public function __construct(
        public readonly SentSmsReportsIterator $reports
    ) {
    }

    public function __serialize(): array
    {
        return [
            'reports' => serialize($this->reports)
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->reports = unserialize(
            $data['reports'],
            ['allowed_classes' => [SentSmsReportsIterator::class]]
        );
    }
}
