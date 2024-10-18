<?php

declare(strict_types=1);

namespace Hollow3464\SmsApiHelper;

use JsonSerializable;
use Exception;

final class SmsMessage implements JsonSerializable
{
    /**
     * @param array<string> $to
     */
    public function __construct(
        public readonly array $to,
        public readonly string $text,
        public readonly ?string $from = null,
    ) {
        if (!count($this->to)) {
            throw new Exception("There must be at least one receipt");
        }
    }

    /**
     * @return array{to: array<string>, text: string, from?: string}
     */
    public function jsonSerialize(): array
    {
        $data = [
            'to' => $this->to,
            'text' => $this->text,
        ];

        if ($this->from) {
            $data['from'] = $this->from;
        }

        return $data;
    }
}
