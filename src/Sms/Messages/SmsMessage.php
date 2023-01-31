<?php

namespace Hollow3464\SmsApiHelper\Sms\Messages;

use JsonSerializable;

final class SmsMessage implements JsonSerializable
{
    public function __construct(
        public readonly array $to,
        public readonly string $text,
        public readonly ?string $from = null,
    ) {
        if (!count($this->to)) {
            throw new \Exception("There must be at least one receipt");
        }
    }

    public function jsonSerialize()
    {
        $data = [
            'to' => $this->to,
            'text' => $this->text
        ];

        if ($this->from) {
            $data['from'] = $this->from;
        }

        return $data;
    }
}
