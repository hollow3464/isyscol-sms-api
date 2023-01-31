<?php

namespace Hollow3464\SmsApiHelper\Sms\Reports;

final class ReportOptions
{
    public function __construct(
        public readonly string $bulkId,
        public readonly string $messageId,
        public readonly string $limit,
    ) {
    }

    public function __serialize(): string
    {
        $options = array_filter((array) $this, 'strlen');

        return join('&', array_map(
            fn ($k, $v) => "$k=$v",
            array_keys($options),
            array_values($options),
        ));
    }
}
