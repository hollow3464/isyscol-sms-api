<?php

namespace Hollow3464\SmsApiHelper\Sms\Logs;

final class LogOptions
{
    public function __construct(
        public readonly string $from,
        public readonly string $to,
        public readonly string $bulkId,
        public readonly string $messageId,
        public readonly string $generalStatus,
        public readonly string $sentSince,
        public readonly string $sentUntil,
        public readonly int $limit,
        public readonly string $mcc,
        public readonly string $mnc,
    ) {
    }

    public function __serialize()
    {
        $options = array_filter((array) $this, 'strlen');

        return join('&', array_map(
            fn ($k, $v) => "$k=$v",
            array_keys($options),
            array_values($options),
        ));
    }
}
